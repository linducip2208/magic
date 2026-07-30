@extends('panel.layout.app')
@section('title', __('Prepaid Payment'))
@section('titlebar_actions', '')

@section('content')
    <div class="py-10">
        <div class="container-xl">
            <div class="row row-cards">
                <div class="col-sm-8 col-lg-8">
                    <div class="text-center p-6">
                        <h3 class="mb-3">{{ __('Redirecting to iPaymu...') }}</h3>
                        <p class="text-muted mb-4">{{ __('Please wait while we redirect you to the secure payment page.') }}</p>
                        <div class="spinner-border text-primary mb-3" role="status">
                            <span class="visually-hidden">{{ __('Loading...') }}</span>
                        </div>
                        <p class="small text-muted">
                            {{ __('If you are not redirected automatically,') }}
                            <a href="{{ $paymentUrl }}" class="fw-semibold">{{ __('click here') }}</a>.
                        </p>
                    </div>
                    <p class="text-center text-muted small">
                        {{ __('By purchasing you confirm our') }}
                        <a href="{{ url('/') . '/terms' }}">{{ __('Terms and Conditions') }}</a>
                    </p>
                </div>
                <div class="col-sm-4 col-lg-4">
                    @include('panel.user.finance.partials.plan_card')
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        window.location.href = "{{ $paymentUrl }}";
    </script>
@endpush
