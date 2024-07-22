@extends('layouts.auth')

@section('content')
    <div class="px-xxl-5">
        <div class="text-center mb-6">
            <h4 class="text-body-highlight">Verify Your Email Address</h4>
            @if (session('resent'))
                <div class="alert alert-success" role="alert">
                    {{ __('A fresh verification link has been sent to your email address.') }}
                </div>
            @endif

            {{ __('Before proceeding, please check your email for a verification link.') }}
            {{ __('If you did not receive the email') }},
            <form class="d-flex align-items-center mb-5" method="POST" action="{{ route('verification.resend') }}">
                @csrf
                <button type="submit" class="btn btn-primary w-100 mb-3">Click here to request another</button>
            </form>
        </div>
    </div>
@endsection
