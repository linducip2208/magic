<?php

namespace App\Services\PaymentGateways;

use App\Actions\CreateActivity;
use App\Events\IpaymuWebhookEvent;
use App\Models\Currency;
use App\Models\Gateways;
use App\Models\Plan;
use App\Models\Setting;
use App\Models\UserOrder;
use App\Services\PaymentGateways\Contracts\CreditUpdater;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Laravel\Cashier\Subscription as Subscriptions;

class IpaymuService
{
    use CreditUpdater;

    protected static $GATEWAY_CODE = 'ipaymu';

    protected static $GATEWAY_NAME = 'iPaymu';

    protected static $SANDBOX_URL = 'https://sandbox.ipaymu.com/api/v2';

    protected static $PRODUCTION_URL = 'https://my.ipaymu.com/api/v2';

    public static function saveAllProducts()
    {
        return true;
    }

    public static function saveProduct($plan)
    {
        return true;
    }

    public static function getPlansPriceIdsForMigration(): void
    {
    }

    public static function getUsersCustomerIdsForMigration(Subscriptions $subscription): null
    {
        return null;
    }

    public static function subscribe($plan)
    {
        $gateway = Gateways::where('code', self::$GATEWAY_CODE)
            ->where('is_active', 1)
            ->first() ?? abort(404);

        $user = Auth::user();
        $settings = Setting::getCache();

        try {
            DB::beginTransaction();

            $currency = Currency::where('id', $gateway->currency)->first()->code;
            $taxRate = $gateway->tax;
            $taxValue = taxToVal($plan->price, $taxRate);
            $coupon = checkCouponInRequest();

            $newDiscountedPrice = $plan->price;
            if ($coupon && $plan->price != 0) {
                $newDiscountedPrice = $plan->price - ($plan->price * ($coupon->discount / 100));
                if ($newDiscountedPrice != floor($newDiscountedPrice)) {
                    $newDiscountedPrice = number_format($newDiscountedPrice, 2);
                }
                $newDiscountedPrice -= $taxValue;
            }

            $orderId = 'IPY-' . strtoupper(Str::random(13));

            $payment = new UserOrder;
            $payment->order_id = $orderId;
            $payment->plan_id = $plan->id;
            $payment->user_id = $user->id;
            $payment->payment_type = self::$GATEWAY_CODE;
            $payment->price = $newDiscountedPrice;
            $payment->affiliate_earnings = ($newDiscountedPrice * $settings->affiliate_commission_percentage) / 100;
            $payment->status = 'Waiting';
            $payment->country = $user->country ?? 'Unknown';
            $payment->type = 'subscription';
            $payment->save();

            DB::commit();

            $totalAmount = $newDiscountedPrice + $taxValue;

            [$va] = self::getVaAndKey();

            $response = self::createPayment([
                'account'     => $va,
                'product'     => [$plan->name],
                'qty'         => ['1'],
                'price'       => [(string) $totalAmount],
                'returnUrl'   => route('dashboard.user.payment.subscription.checkout', ['gateway' => 'ipaymu']) . '?ipaymu_order=' . $orderId,
                'cancelUrl'   => route('dashboard.user.payment.subscription') . '?ipaymu_cancel=' . $orderId,
                'notifyUrl'   => url('/webhook/ipaymu'),
                'referenceId' => $orderId,
                'buyerName'   => $user->name . ' ' . ($user->surname ?? ''),
                'buyerEmail'  => $user->email,
                'buyerPhone'  => $user->phone ?? '081234567890',
            ]);

            if (! isset($response['Status']) || $response['Status'] != 200) {
                $payment->delete();
                $msg = $response['Message'] ?? __('iPaymu payment creation failed.');

                return back()->with(['message' => $msg, 'type' => 'error']);
            }

            $paymentUrl = $response['Data']['Url'];
            $sessionId = $response['Data']['SessionID'];

            $payment->update([
                'payload' => ['session_id' => $sessionId, 'order_id' => $orderId],
            ]);

            session(['ipaymu_session_id' => $sessionId]);
            session(['ipaymu_order_id' => $orderId]);
            session(['ipaymu_plan_id' => $plan->id]);

            return view(
                'panel.user.finance.subscription.' . self::$GATEWAY_CODE,
                compact('plan', 'taxRate', 'taxValue', 'newDiscountedPrice', 'paymentUrl', 'orderId', 'gateway')
            );
        } catch (Exception $ex) {
            DB::rollBack();
            Log::error(self::$GATEWAY_CODE . '-> subscribe(): ' . $ex->getMessage());

            return back()->with(['message' => Str::before($ex->getMessage(), ':'), 'type' => 'error']);
        }
    }

    public static function subscribeCheckout(Request $request, $referral = null)
    {
        $user = Auth::user();

        $orderId = $request->input('orderID')
            ?? $request->query('ipaymu_order')
            ?? session('ipaymu_order_id');

        if (! $orderId) {
            return redirect()->route('dashboard.' . $user->type->value . '.index')
                ->with(['message' => __('Order not found. Please try again.'), 'type' => 'error']);
        }

        $payment = UserOrder::where('order_id', $orderId)->first();

        if (! $payment) {
            return redirect()->route('dashboard.' . $user->type->value . '.index')
                ->with(['message' => __('Order not found.'), 'type' => 'error']);
        }

        if ($payment->status === 'Success') {
            session()->forget(['ipaymu_session_id', 'ipaymu_order_id', 'ipaymu_plan_id']);

            return redirect()->route('dashboard.' . $user->type->value . '.index')
                ->with([
                    'message' => __('Thank you for your purchase. Enjoy your remaining words and images.'),
                    'type'    => 'success',
                ]);
        }

        if ($payment->status === 'Waiting') {
            return view('panel.user.finance.partials.ipaymu-processing', [
                'orderId'   => $orderId,
                'checkUrl'  => route('dashboard.user.payment.subscription.checkout', ['gateway' => 'ipaymu']) . '?ipaymu_order=' . $orderId,
                'dashUrl'   => route('dashboard.' . $user->type->value . '.index'),
            ]);
        }

        if ($payment->status === 'Cancelled') {
            return redirect()->route('dashboard.user.payment.subscription')
                ->with(['message' => __('Payment was cancelled.'), 'type' => 'error']);
        }

        return redirect()->route('dashboard.' . $user->type->value . '.index')
            ->with(['message' => __('Something went wrong. Please contact support.'), 'type' => 'error']);
    }

    public static function prepaid($plan)
    {
        $gateway = Gateways::where('code', self::$GATEWAY_CODE)
            ->where('is_active', 1)
            ->first() ?? abort(404);

        $user = Auth::user();
        $settings = Setting::getCache();

        try {
            DB::beginTransaction();

            $taxRate = $gateway->tax;
            $taxValue = taxToVal($plan->price, $taxRate);

            $newDiscountedPrice = $plan->price;
            $coupon = checkCouponInRequest();
            if ($coupon) {
                $newDiscountedPrice = $plan->price - ($plan->price * ($coupon->discount / 100));
                if ($newDiscountedPrice != floor($newDiscountedPrice)) {
                    $newDiscountedPrice = number_format($newDiscountedPrice, 2);
                }
                $newDiscountedPrice -= $taxValue;
            }

            $orderId = 'IPY-' . strtoupper(Str::random(13));

            $payment = new UserOrder;
            $payment->order_id = $orderId;
            $payment->plan_id = $plan->id;
            $payment->user_id = $user->id;
            $payment->payment_type = self::$GATEWAY_CODE;
            $payment->price = $newDiscountedPrice;
            $payment->affiliate_earnings = ($newDiscountedPrice * $settings->affiliate_commission_percentage) / 100;
            $payment->status = 'Waiting';
            $payment->country = $user->country ?? 'Unknown';
            $payment->type = 'prepaid';
            $payment->save();

            DB::commit();

            $totalAmount = $newDiscountedPrice + $taxValue;

            [$va] = self::getVaAndKey();

            $response = self::createPayment([
                'account'     => $va,
                'product'     => [$plan->name],
                'qty'         => ['1'],
                'price'       => [(string) $totalAmount],
                'returnUrl'   => route('dashboard.user.payment.prepaid.checkout', ['gateway' => 'ipaymu']) . '?ipaymu_prepaid=' . $orderId,
                'cancelUrl'   => route('dashboard.user.payment.subscription') . '?ipaymu_cancel=' . $orderId,
                'notifyUrl'   => url('/webhook/ipaymu'),
                'referenceId' => $orderId,
                'buyerName'   => $user->name . ' ' . ($user->surname ?? ''),
                'buyerEmail'  => $user->email,
                'buyerPhone'  => $user->phone ?? '081234567890',
            ]);

            if (! isset($response['Status']) || $response['Status'] != 200) {
                $payment->delete();
                $msg = $response['Message'] ?? __('iPaymu payment creation failed.');

                return back()->with(['message' => $msg, 'type' => 'error']);
            }

            $paymentUrl = $response['Data']['Url'];
            $sessionId = $response['Data']['SessionID'];

            $payment->update([
                'payload' => ['session_id' => $sessionId, 'order_id' => $orderId],
            ]);

            session(['ipaymu_session_id' => $sessionId]);
            session(['ipaymu_order_id' => $orderId]);
            session(['ipaymu_plan_id' => $plan->id]);

            return view(
                'panel.user.finance.prepaid.' . self::$GATEWAY_CODE,
                compact('plan', 'newDiscountedPrice', 'taxValue', 'taxRate', 'orderId', 'paymentUrl', 'gateway')
            );
        } catch (Exception $th) {
            DB::rollBack();
            Log::error(self::$GATEWAY_CODE . '-> prepaid(): ' . $th->getMessage());

            return back()->with(['message' => Str::before($th->getMessage(), ':'), 'type' => 'error']);
        }
    }

    public static function prepaidCheckout(Request $request)
    {
        $user = Auth::user();

        $orderId = $request->input('orderID')
            ?? $request->query('ipaymu_prepaid')
            ?? session('ipaymu_order_id');

        if (! $orderId) {
            return redirect()->route('dashboard.' . $user->type->value . '.index')
                ->with(['message' => __('Order not found. Please try again.'), 'type' => 'error']);
        }

        $payment = UserOrder::where('order_id', $orderId)->first();

        if (! $payment) {
            $planId = session('ipaymu_plan_id');
            $plan = $planId ? Plan::find($planId) : null;

            return view('panel.user.finance.partials.ipaymu-processing', [
                'orderId'   => $orderId,
                'checkUrl'  => route('dashboard.user.payment.prepaid.checkout', ['gateway' => 'ipaymu']) . '?ipaymu_prepaid=' . $orderId,
                'dashUrl'   => route('dashboard.' . $user->type->value . '.index'),
            ]);
        }

        if ($payment->status === 'Success') {
            session()->forget(['ipaymu_session_id', 'ipaymu_order_id', 'ipaymu_plan_id']);

            return redirect()->route('dashboard.' . $user->type->value . '.index')
                ->with([
                    'message' => __('Thank you for your purchase. Enjoy your remaining words and images.'),
                    'type'    => 'success',
                ]);
        }

        if ($payment->status === 'Waiting') {
            return view('panel.user.finance.partials.ipaymu-processing', [
                'orderId'   => $orderId,
                'checkUrl'  => route('dashboard.user.payment.prepaid.checkout', ['gateway' => 'ipaymu']) . '?ipaymu_prepaid=' . $orderId,
                'dashUrl'   => route('dashboard.' . $user->type->value . '.index'),
            ]);
        }

        if ($payment->status === 'Cancelled') {
            return redirect()->route('dashboard.user.payment.subscription')
                ->with(['message' => __('Payment was cancelled.'), 'type' => 'error']);
        }

        return redirect()->route('dashboard.' . $user->type->value . '.index')
            ->with(['message' => __('Something went wrong. Please contact support.'), 'type' => 'error']);
    }

    public static function getSubscriptionDaysLeft()
    {
        $user = Auth::user();
        $activeSub = getCurrentActiveSubscription($user->id);
        if ($activeSub != null) {
            return Carbon::now()->diffInDays(Carbon::parse($activeSub->ends_at));
        }

        return null;
    }

    public static function getSubscriptionRenewDate()
    {
        $user = Auth::user();
        $activeSub = getCurrentActiveSubscription($user->id);
        if ($activeSub != null) {
            return Carbon::parse($activeSub->ends_at)->format('F jS, Y');
        }

        return null;
    }

    public static function getSubscriptionStatus()
    {
        $user = Auth::user();
        $activeSub = getCurrentActiveSubscription($user->id);
        if ($activeSub != null) {
            if ($activeSub->stripe_status == 'active') {
                return true;
            }

            return false;
        }

        return null;
    }

    public static function cancelSubscribedPlan($planId, $subsId)
    {
        $currentSubscription = Subscriptions::where('id', $subsId)->first();
        if ($currentSubscription != null) {
            $currentSubscription->stripe_status = 'cancelled';
            $currentSubscription->ends_at = Carbon::now();
            $currentSubscription->save();

            return true;
        }

        return false;
    }

    public static function subscribeCancel(?User $internalUser = null)
    {
        $user = $internalUser ?? Auth::user();
        $activeSub = getCurrentActiveSubscription($user->id);
        if ($activeSub != null) {
            $plan = Plan::where('id', $activeSub->plan_id)->first();

            $activeSub->stripe_status = 'cancelled';
            $activeSub->ends_at = Carbon::now();
            $activeSub->save();

            self::creditDecreaseCancelPlan($user, $plan);

            CreateActivity::for($user, 'Cancelled', 'Subscription plan');

            return back()->with([
                'message' => __('Your subscription is cancelled succesfully.'),
                'type'    => 'success',
            ]);
        }

        return back()->with([
            'message' => __('Could not find active subscription. Nothing changed!'),
            'type'    => 'error',
        ]);
    }

    public static function checkIfTrial()
    {
        return false;
    }

    public static function handleWebhook(Request $request)
    {
        try {
            $payload = $request->all();
            $contentType = $request->header('Content-Type', '');

            if (str_contains($contentType, 'application/json')) {
                $rawBody = $request->getContent();
                $payload = json_decode($rawBody, true);
            }

            if (empty($payload)) {
                Log::warning('iPaymu webhook: empty payload');

                return response()->json(['status' => 'error', 'message' => 'Empty payload'], 400);
            }

            $receivedSignature = $request->header('X-Signature');

            if ($receivedSignature && ! self::isValidWebhookSignature($payload, $receivedSignature)) {
                Log::warning('iPaymu webhook: invalid signature');

                return response()->json(['status' => 'error', 'message' => 'Invalid signature'], 400);
            }

            event(new IpaymuWebhookEvent($payload));

            return response()->json(['status' => 'ok']);
        } catch (Exception $ex) {
            Log::error(self::$GATEWAY_CODE . '-> handleWebhook(): ' . $ex->getMessage());

            return response()->json(['status' => 'error', 'message' => $ex->getMessage()], 500);
        }
    }

    private static function isValidWebhookSignature(array $payload, string $receivedSignature): bool
    {
        $gateway = Gateways::where('code', self::$GATEWAY_CODE)
            ->where('is_active', 1)
            ->first();

        if (! $gateway) {
            return false;
        }

        $va = $gateway->mode == 'sandbox'
            ? $gateway->sandbox_app_id
            : $gateway->live_app_id;

        $data = $payload;
        unset($data['signature']);

        array_walk_recursive($data, function (&$value, $key) {
            if (is_numeric($value) && $key === 'trx_id') {
                $value = (int) $value;
            }
            if (is_numeric($value) && $key === 'status_code') {
                $value = (int) $value;
            }
            if (is_numeric($value) && $key === 'paid_off') {
                $value = (int) $value;
            }
            if (is_numeric($value) && $key === 'total') {
                $value = (int) $value;
            }
            if (is_numeric($value) && $key === 'amount') {
                $value = (int) $value;
            }
            if (is_numeric($value) && $key === 'fee') {
                $value = (int) $value;
            }
            if (($key === 'is_escrow') && ($value === 'true' || $value === 'false')) {
                $value = $value === 'true';
            }
            if ($key === 'additional_info' && $value === []) {
                $value = (object) [];
            }
        });

        ksort($data, SORT_STRING);

        $jsonString = json_encode($data, JSON_UNESCAPED_SLASHES);

        $expectedSignature = hash_hmac('sha256', $jsonString, $va);

        return hash_equals($expectedSignature, $receivedSignature);
    }

    private static function getClientUrl(): string
    {
        $gateway = Gateways::where('code', self::$GATEWAY_CODE)
            ->where('is_active', 1)
            ->first();

        if ($gateway && $gateway->mode == 'sandbox') {
            return self::$SANDBOX_URL;
        }

        return self::$PRODUCTION_URL;
    }

    private static function getVaAndKey(): array
    {
        $gateway = Gateways::where('code', self::$GATEWAY_CODE)
            ->where('is_active', 1)
            ->first() ?? abort(404, __('iPaymu gateway not found or not active.'));

        if ($gateway->mode == 'sandbox') {
            $va = $gateway->sandbox_app_id;
            $apiKey = $gateway->sandbox_client_secret;
        } else {
            $va = $gateway->live_app_id;
            $apiKey = $gateway->live_client_secret;
        }

        if (empty($va) || empty($apiKey)) {
            abort(500, __('iPaymu gateway is not configured (VA/API Key missing). Please contact admin.'));
        }

        return [$va, $apiKey];
    }

    private static function generateSignature(array $body, string $va, string $apiKey): array
    {
        $jsonBody = json_encode($body, JSON_UNESCAPED_SLASHES);
        $requestBody = strtolower(hash('sha256', $jsonBody));
        $timestamp = now()->format('YmdHis');
        $stringToSign = 'POST:' . $va . ':' . $requestBody . ':' . $apiKey;
        $signature = hash_hmac('sha256', $stringToSign, $apiKey);

        return [$signature, $timestamp];
    }

    private static function curlReq(string $endpoint, array $body): array
    {
        [$va, $apiKey] = self::getVaAndKey();
        [$signature, $timestamp] = self::generateSignature($body, $va, $apiKey);

        $jsonBody = json_encode($body, JSON_UNESCAPED_SLASHES);
        $baseUrl = self::getClientUrl();

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $baseUrl . $endpoint);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonBody);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'va: ' . $va,
            'signature: ' . $signature,
            'timestamp: ' . $timestamp,
        ]);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $error = curl_error($ch);
        curl_close($ch);

        if ($error) {
            Log::error(self::$GATEWAY_CODE . ' cURL error: ' . $error);
            abort(400, 'iPaymu: ' . $error);
        }

        $result = json_decode($response, true);

        Log::info(self::$GATEWAY_CODE . ' API response', [
            'endpoint'    => $endpoint,
            'http_code'   => $httpCode,
            'response'    => $result,
        ]);

        return $result ?? [];
    }

    private static function createPayment(array $data): array
    {
        return self::curlReq('/payment', $data);
    }

    public static function checkTransaction(string $transactionId): array
    {
        return self::curlReq('/transaction', [
            'transactionId' => $transactionId,
        ]);
    }

    public static function gatewayDefinitionArray(): array
    {
        return [
            'code'                  => 'ipaymu',
            'title'                 => 'iPaymu',
            'link'                  => 'https://ipaymu.com/',
            'active'                => 0,
            'available'             => 1,
            'img'                   => '/assets/img/payments/ipaymu.svg',
            'whiteLogo'             => 0,
            'mode'                  => 1,
            'sandbox_client_id'     => 0,
            'sandbox_client_secret' => 1,
            'sandbox_app_id'        => 1,
            'live_client_id'        => 1,
            'live_client_secret'    => 1,
            'live_app_id'           => 1,
            'currency'              => 1,
            'currency_locale'       => 0,
            'notify_url'            => 0,
            'base_url'              => 0,
            'sandbox_url'           => 0,
            'locale'                => 0,
            'validate_ssl'          => 0,
            'webhook_secret'        => 0,
            'logger'                => 0,
            'tax'                   => 1,
            'bank_account_details'  => 0,
            'bank_account_other'    => 0,
            'automate_tax'          => 0,
        ];
    }
}
