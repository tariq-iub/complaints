@extends('layouts.app')

@section('content')
    <nav class="mb-3" aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/users') }}">Users</a></li>
            <li class="breadcrumb-item active">Edit User</li>
        </ol>
    </nav>

    <form class="mb-9" method="POST" action="{{ route('users.update', $user) }}" enctype="multipart/form-data">
        @csrf
        @method("PUT")
        <div class="row g-3 flex-between-end mb-5">
            <div class="col-auto">
                <h2 class="mb-2">Edit a user</h2>
                <h5 class="text-body-tertiary fw-semibold">
                    Edit a system user for allowing your employees or clients to utilize the system.
                </h5>
            </div>
            <div class="col-auto">
                <a href="{{ route('users.index') }}" class="btn btn-phoenix-secondary me-2 mb-2 mb-sm-0">Discard</a>
                <button class="btn btn-primary mb-2 mb-sm-0" type="submit">Update User</button>
            </div>
        </div>

        <div class="row g-5">
            <div class="col-12 col-xl-8">
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
                    <h5>User Name</h5>
                    <input class="form-control" type="text" name="name" placeholder="User Name"
                           value="{{ old('name', $user->name) }}" required>
                    @if($errors->has('name'))
                        <div class="text-danger small">
                            {{ $errors->first('name') }}
                        </div>
                    @endif
                </div>

                <div class="mb-5">
                    <h5>Email</h5>
                    <input class="form-control" type="email" id="email" name="email" placeholder="User Email"
                           value="{{ old('email', $user->email) }}" required>
                    @if($errors->has('email'))
                        <div class="text-danger small">
                            {{ $errors->first('email') }}
                        </div>
                    @endif
                </div>

                <div class="mb-5">
                    <h5>CNIC No</h5>
                    <input class="form-control" type="text" id="cnic_no" name="cnic_no" placeholder="CNIC No"
                           value="{{ old('cnic_no', $user->cnic_no) }}" required>
                    @if($errors->has('cnic_no'))
                        <div class="text-danger small">
                            {{ $errors->first('cnic_no') }}
                        </div>
                    @endif
                </div>

                <div class="mb-5">
                    <h5>Contact No</h5>
                    <input class="form-control" type="text" id="contact_no" name="contact_no" placeholder="Contact No"
                           value="{{ old('contact_no', $user->contact_no) }}" required>
                    @if($errors->has('contact_no'))
                        <div class="text-danger small">
                            {{ $errors->first('contact_no') }}
                        </div>
                    @endif
                </div>

                <div class="card p-3">
                    <div class="form-check form-switch mb-3">
                        <input type="checkbox" class="form-check-input" id="changePasswordCheck" name="changePasswordCheck" {{ is_null(old('changePasswordCheck')) ? '' : 'checked' }}>
                        <label class="form-check-label" for="changePasswordCheck">Change Password</label>
                    </div>

                    <div class="mb-5">
                        <h5>Password</h5>
                        <input class="form-control" type="password" name="password" placeholder="Password"
                               value="{{ old('password') }}">
                        @if($errors->has('password'))
                            <div class="text-danger small">
                                {{ $errors->first('password') }}
                            </div>
                        @endif
                    </div>

                    <div class="mb-5">
                        <h5>Confirm Password</h5>
                        <input class="form-control" type="password" name="password_confirmation" placeholder="Confirm Password"
                               value="{{ old('password_confirmation') }}">
                    </div>
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
                                                    <option value="{{ $row->id }}" {{ ($user->role_id == $row->id) ? 'selected' : '' }}>
                                                        {{ $row->title }}
                                                    </option>
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
                                                <option value="1" {{ ($user->status) ? 'selected' : '' }}>Active</option>
                                                <option value="0" {{ (!$user->status) ? 'selected' : '' }}>Blocked</option>
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
    <script>
        $(document).ready(function()
        {
            $('#cnic_no').mask('00000-0000000-0', {
                translation: {
                    '0': { pattern: /[0-9]/, optional: false }
                }
            });

            $('#contact_no').mask('0000-0000000', {
                translation: {
                    '0': { pattern: /[0-9]/, optional: false }
                }
            });
        });
    </script>
@endpush
