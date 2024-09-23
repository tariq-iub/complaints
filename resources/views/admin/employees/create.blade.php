@extends('layouts.app')

@section('content')
    <nav class="mb-3" aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/employees') }}">Employees</a></li>
            <li class="breadcrumb-item active">Add Employee</li>
        </ol>
    </nav>

    <form class="mb-9" method="POST" action="{{ route('employees.store') }}">
        @csrf
        <div class="row g-3 flex-between-end mb-5">
            <div class="col-auto">
                <h2 class="mb-2">Add New Employee</h2>
                <h5 class="text-body-tertiary fw-semibold">
                    Fill in the details below to add a new employee.
                </h5>
            </div>
            <div class="col-auto">
                <a href="{{ route('employees.index') }}" class="btn btn-phoenix-secondary me-2 mb-2 mb-sm-0">Discard</a>
                <button class="btn btn-primary mb-2 mb-sm-0" type="submit">Add Employee</button>
            </div>
        </div>

        <div class="row g-5">
            <div class="col-12 col-xl-8">
                <div class="mb-5">
                    <h5>Name</h5>
                    <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}" required>
                    @error('name')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-5">
                    <h5>Father's Name</h5>
                    <input type="text" id="father_name" name="father_name" class="form-control" value="{{ old('father_name') }}" required>
                    @error('father_name')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-5">
                    <h5>CNIC</h5>
                    <input type="text" id="cnic" name="cnic" class="form-control" value="{{ old('cnic') }}" required>
                    @error('cnic')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-5">
                    <h5>Email</h5>
                    <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" required>
                    @error('email')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-5">
                    <h5>Mobile Number</h5>
                    <input type="text" id="mobile_no" name="mobile_no" class="form-control" value="{{ old('mobile_no') }}" required>
                    @error('mobile_no')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-5">
                    <h5>Address Line 1</h5>
                    <input type="text" id="address_line1" name="address_line1" class="form-control" value="{{ old('address_line1') }}" required>
                    @error('address_line1')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-5">
                    <h5>Address Line 2</h5>
                    <input type="text" id="address_line2" name="address_line2" class="form-control" value="{{ old('address_line2') }}">
                    @error('address_line2')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-12 col-xl-4">
                <div class="card mb-3">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Organize</h4>
                        <div class="row gx-3">
                            <div class="col-12 col-sm-6 col-xl-12 mb-3">
                                <label for="gender" class="form-label">Gender</label>
                                <select id="gender" name="gender" class="form-select" required>
                                    <option value="">Select Gender</option>
                                    <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                                    <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                                    <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Other</option>
                                </select>
                                @error('gender')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12 col-sm-6 col-xl-12 mb-3">
                                <label for="designation_id" class="form-label">Designation</label>
                                <select id="designation_id" name="designation_id" class="form-select" required>
                                    <option value="">Select Designation</option>
                                    @foreach($designations as $designation)
                                        <option value="{{ $designation->id }}" {{ old('designation_id') == $designation->id ? 'selected' : '' }}>
                                            {{ $designation->title }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('designation_id')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12 col-sm-6 col-xl-12 mb-3">
                                <label for="joining_date" class="form-label">Joining Date</label>
                                <input type="date" id="joining_date" name="joining_date" class="form-control" value="{{ old('joining_date') }}" required>
                                @error('joining_date')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12 col-sm-6 col-xl-12 mb-3">
                                <label for="birth_date" class="form-label">Birth Date</label>
                                <input type="date" id="birth_date" name="birth_date" class="form-control" value="{{ old('birth_date') }}" required>
                                @error('birth_date')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
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
        $(document).ready(function() {
            $('#cnic').mask('00000-0000000-0', { translation: { '0': { pattern: /[0-9]/, optional: false }}});
            $('#mobile_no').mask('0000-0000000', { translation: { '0': { pattern: /[0-9]/, optional: false }}});
        });
    </script>
@endpush
