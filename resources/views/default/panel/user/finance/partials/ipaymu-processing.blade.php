@extends('panel.layout.app')
@section('title', __('Payment Processing'))
@section('titlebar_actions', '')

@section('content')
    <div class="py-10">
        <div class="container-xl">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body text-center py-6">
                            <div class="spinner-border text-primary mb-4" role="status" style="width:3rem;height:3rem;">
                                <span class="visually-hidden">{{ __('Loading...') }}</span>
                            </div>
                            <h3 class="mb-2">{{ __('Menunggu Konfirmasi Pembayaran') }}</h3>
                            <p class="text-muted mb-1">{{ __('Pembayaran Anda sedang diproses oleh iPaymu.') }}</p>
                            <p class="text-muted small mb-4">{{ __('Halaman ini akan otomatis dialihkan setelah pembayaran terkonfirmasi.') }}</p>
                            <p class="text-muted small">
                                {{ __('Order ID') }}: <code>{{ $orderId }}</code>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        setTimeout(function () {
            window.location.reload();
        }, 3000);
    </script>
@endpush
