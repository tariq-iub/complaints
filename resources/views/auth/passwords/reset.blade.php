@extends('layouts.auth')

@section('content')
    <div class="px-xxl-5">
        <div class="text-center mb-6">
            <h4 class="text-body-highlight">Reset Password</h4>
            <p class="text-body-tertiary mb-5">Enter your email and password below and change your <br class="d-sm-none" />password.</p>
            <form class="d-flex align-items-center mb-5" method="POST" action="{{ route('password.update') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">

                <div class="mb-3 text-start">
                    <label class="form-label" for="email">Email Address</label>
                    <div class="form-icon-container">
                        <input class="form-control form-icon-input @error('email') is-invalid @enderror"
                               id="email" name="email" type="email" placeholder="name@example.com"
                               value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus/>
                        <span class="fas fa-user text-body fs-9 form-icon"></span>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="mb-3 text-start">
                    <label class="form-label" for="password">Password</label>
                    <div class="form-icon-container">
                        <input class="form-control form-icon-input @error('password') is-invalid @enderror"
                               id="password" name="password" type="password" placeholder="Password"
                               required autocomplete="current-password"/>
                        <span class="fas fa-key text-body fs-9 form-icon"></span>
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="mb-3 text-start">
                    <label class="form-label" for="password">Confirm Password</label>
                    <div class="form-icon-container">
                        <input class="form-control form-icon-input" type="password"
                               id="password-confirm" name="password_confirmation" required autocomplete="new-password"/>
                        <span class="fas fa-key text-body fs-9 form-icon"></span>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary w-100 mb-3">Reset Password</button>
            </form>
        </div>
    </div>
@endsection
