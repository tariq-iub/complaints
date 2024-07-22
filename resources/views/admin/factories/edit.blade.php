@extends('layouts.powereye')

@section('content')
    <nav class="mb-3" aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/factories') }}">Factories</a></li>
            <li class="breadcrumb-item active">Edit Factory</li>
        </ol>
    </nav>

    <form class="mb-9" method="POST" action="{{ route('factories.update', $factory->id) }}">
        @csrf
        @method('PUT')
        <div class="row g-3 flex-between-end mb-5">
            <div class="col-auto">
                <h2 class="mb-2">Edit Factory</h2>
                <h5 class="text-body-tertiary fw-semibold">
                    Update the factory information for your clients.
                </h5>
            </div>
            <div class="col-auto">
                <button class="btn btn-phoenix-secondary me-2 mb-2 mb-sm-0" type="reset">Discard</button>
                <button class="btn btn-primary mb-2 mb-sm-0" type="submit">Update Factory</button>
            </div>
        </div>

        <div class="row g-5">
            <div class="col-12 col-xl-8">
                <div class="mb-5">
                    <h5>Factory Title</h5>
                    <input class="form-control" type="text" id="title" name="title" placeholder="Factory Title"
                           value="{{ old('title', $factory->title) }}" required>
                </div>

                <div class="mb-5">
                    <h5>Factory Address</h5>
                    <input class="form-control" type="text" id="address" name="address" placeholder="Factory Address"
                           value="{{ old('address', $factory->address) }}" required>
                </div>

                <div class="mb-5">
                    <h5>Owner Name</h5>
                    <input class="form-control" type="text" id="owner_name" name="owner_name" placeholder="Owner Name"
                           value="{{ old('owner_name', $factory->owner_name) }}" required>
                </div>

                <div class="mb-5">
                    <h5>Owner's CNIC</h5>
                    <input class="form-control" type="text" id="owner_cnic" name="owner_cnic"
                           placeholder="Owner's CNIC"
                           value="{{ old('owner_cnic', $factory->owner_cnic) }}">
                </div>

                <div class="mb-5">
                    <h5>Email</h5>
                    <input class="form-control" type="email" id="email" name="email" placeholder="Email"
                           value="{{ old('email', $factory->email) }}" required>
                </div>

                <div class="mb-5">
                    <h5>Contact No</h5>
                    <input class="form-control" type="text" id="contact_no" name="contact_no" placeholder="Contact No"
                           value="{{ old('contact_no', $factory->contact_no) }}">
                </div>

                <div class="mb-5">
                    <h5>Fax</h5>
                    <input class="form-control" type="text" id="fax" name="fax" placeholder="Fax"
                           value="{{ old('fax', $factory->fax) }}">
                </div>
            </div>
        </div>
    </form>
@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            $('#owner_cnic').mask('00000-0000000-0');
            $('#contact_no').mask('0000-0000000');
        });
    </script>
@endpush
