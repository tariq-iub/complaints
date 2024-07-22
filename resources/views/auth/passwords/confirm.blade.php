@extends('layouts.app')

@section('content')
    <div class="px-xxl-5">
        <div class="text-center mb-6">
            <h4 class="text-body-highlight">Password Confirmation</h4>
            <p class="text-body-tertiary mb-5">Please confirm your password before continuing.</p>
            <form class="d-flex align-items-center mb-5" method="POST" action="{{ route('password.confirm') }}">
                @csrf

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
                <button type="submit" class="btn btn-primary w-100 mb-3">Confirm Password</button>
                @if (Route::has('password.request'))
                    <div class="col-auto">
                        <a class="fs-9 fw-semibold" href="{{ route('password.request') }}">
                            Forgot your Password?
                        </a>
                    </div>
                @endif
            </form>
        </div>
    </div>
@endsection
