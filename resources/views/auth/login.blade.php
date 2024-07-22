@extends('layouts.auth')

@section('content')
    <div class="text-center mb-7">
        <h3 class="text-body-highlight">Sign In</h3>
        <p class="text-body-tertiary">Get access to your account</p>
    </div>
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="mb-3 text-start">
            <label class="form-label" for="email">Email Address</label>
            <div class="form-icon-container">
                <input class="form-control form-icon-input @error('email') is-invalid @enderror"
                       id="email" name="email" type="email" placeholder="name@example.com"
                       value="{{ old('email') }}" required autocomplete="email" autofocus/>
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
            <div class="form-icon-container" data-password="data-password">
                <input class="form-control form-icon-input pe-6 @error('password') is-invalid @enderror"
                       id="password" name="password" type="password" placeholder="Password"
                       data-password-input="data-password-input" required autocomplete="current-password"/>
                <span class="fas fa-key text-body fs-9 form-icon"></span>
                <button type="button" class="btn px-3 py-0 h-100 position-absolute top-0 end-0 fs-7 text-body-tertiary" data-password-toggle="data-password-toggle">
                    <span class="uil uil-eye show"></span>
                    <span class="uil uil-eye-slash hide"></span>
                </button>
                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
        <div class="row flex-between-center mb-7">
            <div class="col-auto">
                <div class="form-check mb-0">
                    <input class="form-check-input" id="basic-checkbox" type="checkbox"
                           name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}/>
                    <label class="form-check-label mb-0" for="basic-checkbox">Remember me</label>
                </div>
            </div>
            @if (Route::has('password.request'))
            <div class="col-auto">
                <a class="fs-9 fw-semibold" href="{{ route('password.request') }}">Forgot Password?</a>
            </div>
            @endif
        </div>
        <button type="submit" class="btn btn-primary w-100 mb-3">Sign In</button>
    </form>
    <div class="text-center">
        <a class="fs-9 fw-bold" href="{{ route('register') }}">Create an account</a>
    </div>
@endsection
