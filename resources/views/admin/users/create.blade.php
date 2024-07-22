@extends('layouts.powereye')

@section('content')
    <nav class="mb-3" aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/users') }}">Users</a></li>
            <li class="breadcrumb-item active">Add User</li>
        </ol>
    </nav>

    <form class="mb-9" method="POST" action="{{ route('users.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="row g-3 flex-between-end mb-5">
            <div class="col-auto">
                <h2 class="mb-2">Add a user</h2>
                <h5 class="text-body-tertiary fw-semibold">
                    Add a system user for allowing your employees or clients to utilize the system.
                </h5>
            </div>
            <div class="col-auto">
                <a href="{{ route('users.index') }}" class="btn btn-phoenix-secondary me-2 mb-2 mb-sm-0">Discard</a>
                <button class="btn btn-primary mb-2 mb-sm-0" type="submit">Add user</button>
            </div>
        </div>

        <div class="row g-5">
            <div class="col-12 col-xl-8">
                <div class="mb-5">
                    <h5>User Name</h5>
                    <input class="form-control" type="text" name="name" placeholder="User Name"
                           value="{{ old('name') }}" required>
                    @if($errors->has('name'))
                    <div class="text-danger small">
                        {{ $errors->first('name') }}
                    </div>
                    @endif
                </div>
                <div class="mb-5">
                    <h5>User Image</h5>
                    <input type="file" class="form-control" id="photo_path" name="photo_path" accept="image/*">
                    @if($errors->has('photo_path'))
                        <div class="text-danger small">
                            {{ $errors->first('photo_path') }}
                        </div>
                    @endif
                </div>

                <div class="mb-5">
                    <h5>Email</h5>
                    <input class="form-control" type="email" name="email" placeholder="User Email"
                           value="{{ old('email') }}" required>
                    @if($errors->has('email'))
                        <div class="text-danger small">
                            {{ $errors->first('email') }}
                        </div>
                    @endif
                </div>

                <div class="mb-5">
                    <h5>Password</h5>
                    <input class="form-control" type="password" name="password" placeholder="Password"
                           value="{{ old('password') }}" required>
                    @if($errors->has('password'))
                        <div class="text-danger small">
                            {{ $errors->first('password') }}
                        </div>
                    @endif
                </div>

                <div class="mb-5">
                    <h5>Confirm Password</h5>
                    <input class="form-control" type="password" name="password_confirmation" placeholder="Confirm Password"
                           value="{{ old('password_confirmation') }}" required>
                </div>

            </div>
            <div class="col-12 col-xl-4">
                <div class="row g-2">
                    <div class="col-12 col-xl-12">
                        <div class="card mb-3">
                            <div class="card-body">
                                <h4 class="card-title mb-4">Organize</h4>
                                <div class="row gx-3">
                                    <div class="col-12 col-sm-6 col-xl-12">
                                        <div class="mb-4">
                                            <div class="d-flex flex-wrap mb-2">
                                                <h5 class="mb-0 text-body-highlight me-2">Role</h5>
                                            </div>
                                            <select class="form-select" aria-label="role" name="role_id" required>
                                                <option value="">Select Role</option>
                                                @foreach($roles as $row)
                                                    <option value="{{ $row->id }}">{{ $row->title }}</option>
                                                @endforeach
                                            </select>
                                            @if($errors->has('role_id'))
                                                <div class="text-danger small">
                                                    {{ $errors->first('role_id') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6 col-xl-12">
                                        <div class="mb-4">
                                            <div class="d-flex flex-wrap mb-2">
                                                <h5 class="mb-0 text-body-highlight me-2">Status</h5>
                                            </div><select class="form-select mb-3" aria-label="status" name="status" required>
                                                <option value="1">Active</option>
                                                <option value="0">Blocked</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@push('scripts')

@endpush
