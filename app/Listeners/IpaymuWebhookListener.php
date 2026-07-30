<?php

namespace App\Listeners;

use App\Events\IpaymuWebhookEvent;
use App\Models\Plan;
use App\Models\UserOrder;
use App\Models\WebhookHistory;
use App\Services\PaymentGateways\Contracts\CreditUpdater;
use Carbon\Carbon;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Laravel\Cashier\Subscription as Subscriptions;
use Throwable;

class IpaymuWebhookListener implements ShouldQueue
{
    use CreditUpdater;
    use InteractsWithQueue;

    public bool $afterCommit = true;

    public string $queue = 'default';

    public int $delay = 0;

    public function __construct()
    {
    }

    public function handle(IpaymuWebhookEvent $event): void
    {
        try {
            $payload = $event->payload;

            $status = $payload['status'] ?? '';
            $statusCode = $payload['status_code'] ?? null;
            $referenceId = $payload['reference_id'] ?? '';
            $trxId = $payload['trx_id'] ?? '';

            Log::info('iPaymu webhook received', [
                'trx_id'       => $trxId,
                'reference_id' => $referenceId,
                'status'       => $status,
                'status_code'  => $statusCode,
            ]);

            $webhook = new WebhookHistory;
            $webhook->gatewaycode = 'ipaymu';
            $webhook->webhook_id = (string) $trxId;
            $webhook->event_type = $status;
            $webhook->resource_id = $referenceId;
            $webhook->resource_type = 'payment';
            $webhook->status = 'check';
            $webhook->summary = 'iPaymu webhook: ' . $status . ' (trx_id: ' . $trxId . ')';
            $webhook->incoming_json = json_encode($payload);
            $webhook->create_time = $payload['paid_at'] ?? Carbon::now()->toDateTimeString();
            $webhook->resource_state = $status;
            $webhook->save();

            if ($status !== 'berhasil' && $statusCode !== 1) {
                if ($status === 'expired' || $statusCode === -2) {
                    $order = UserOrder::where('order_id', $referenceId)->first();
                    if ($order && $order->status === 'Waiting') {
                        $order->status = 'Cancelled';
                        $order->save();
                        Log::info('iPaymu webhook: order marked as cancelled (expired)', ['order_id' => $referenceId]);
                    }
                }

                Log::info('iPaymu webhook: payment not successful', ['status' => $status]);

                return;
            }

            $order = UserOrder::where('order_id', $referenceId)->first();
            if (! $order) {
                Log::warning('iPaymu webhook: order not found', ['reference_id' => $referenceId]);

                return;
            }

            if ($order->status === 'Success') {
                Log::info('iPaymu webhook: order already processed', ['order_id' => $order->order_id]);

                return;
            }

            $plan = Plan::find($order->plan_id);
            if (! $plan) {
                Log::warning('iPaymu webhook: plan not found', ['plan_id' => $order->plan_id]);

                return;
            }

            $user = $order->user;

            if ($order->type === 'prepaid') {
                $order->status = 'Success';
                $order->save();

                $webhook->status = 'checked';
                $webhook->save();

                self::creditIncreaseSubscribePlan($user, $plan);
            } else {
                $subscription = new Subscriptions;
                $subscription->user_id = $user->id;
                $subscription->name = $plan->id;
                $subscription->quantity = 1;
                $subscription->plan_id = $plan->id;
                $subscription->paid_with = 'ipaymu';
                $subscription->stripe_id = 'IPY-' . strtoupper(\Illuminate\Support\Str::random(13));
                $subscription->stripe_price = $plan->id;
                $subscription->stripe_status = 'active';
                $subscription->ends_at = $plan->trial_days != 0
                    ? Carbon::now()->addDays($plan->trial_days)
                    : Carbon::now()->addDays(30);
                $subscription->total_amount = $order->price;
                $subscription->save();

                $order->status = 'Success';
                $order->save();

                $webhook->status = 'checked';
                $webhook->save();

                self::creditIncreaseSubscribePlan($user, $plan);
            }

            Log::info('iPaymu webhook: payment processed successfully', ['order_id' => $order->order_id]);
        } catch (Exception $ex) {
            Log::error("IpaymuWebhookListener::handle()\n" . $ex->getMessage());
        }
    }

    public function failed(IpaymuWebhookEvent $event, Throwable $exception): void
    {
        $space = '*****';
        $msg = '\n' . $space . '\n' . $space;
        $msg .= json_encode($event->payload, JSON_THROW_ON_ERROR);
        $msg .= '\n' . $space . '\n';
        $msg .= '\n' . $exception . '\n';
        $msg .= '\n' . $space . '\n' . $space;
        Log::error($msg);
    }
}
