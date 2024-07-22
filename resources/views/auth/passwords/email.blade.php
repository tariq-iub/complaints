@extends('layouts.auth')

@section('content')
    <div class="px-xxl-5">
        <div class="text-center mb-6">
            <h4 class="text-body-highlight">Forgot your password?</h4>
            <p class="text-body-tertiary mb-5">Enter your email below and we will send <br class="d-sm-none" />you a reset link</p>
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <form class="d-flex align-items-center mb-5" method="POST" action="{{ route('password.email') }}">
                @csrf
                <input class="form-control flex-1 @error('email') is-invalid @enderror" id="email" type="email" placeholder="Email"
                       name="email" value="{{ old('email') }}" required autocomplete="email" autofocus />
                <button class="btn btn-primary ms-2" type="submit" title="Send Password Reset Link">
                    Send<span class="fas fa-chevron-right ms-2"></span>
                </button>
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </form>
        </div>
    </div>
@endsection
