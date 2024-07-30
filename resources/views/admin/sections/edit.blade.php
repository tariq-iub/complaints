@extends('layouts.powereye')

@section('content')
    <nav class="mb-3" aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/sections') }}">Sections</a></li>
            <li class="breadcrumb-item active">Edit Handler</li>
        </ol>
    </nav>

    <form id="edit-handler-form" method="POST" action="{{ route('handlers.update', $handler->id) }}">
        @csrf
        @method('PUT')
        <div class="row g-3 flex-between-end mb-5">
            <div class="col-auto">
                <h2 class="mb-2">Edit Handler</h2>
                <h5 class="text-body-tertiary fw-semibold">
                    Update the handler information.
                </h5>
            </div>
            <div class="col-auto">
                <button class="btn btn-phoenix-secondary me-2 mb-2 mb-sm-0" type="reset">Discard</button>
                <button class="btn btn-primary mb-2 mb-sm-0" type="submit">Update Handler</button>
            </div>
        </div>

        <div class="row g-5">
            <div class="col-12 col-xl-8">
                <div class="mb-5">
                    <h5>Handler Name</h5>
                    <input class="form-control" type="text" id="handler-name" name="name" placeholder="Handler Name"
                           value="{{ old('name', $handler->user->name) }}" required>
                </div>

                <div class="mb-5">
                    <h5>Email</h5>
                    <input class="form-control" type="email" id="handler-email" name="email" placeholder="Email"
                           value="{{ old('email', $handler->user->email) }}" required>
                </div>

                <div class="mb-5">
                    <h5>Is Head</h5>
                    <input class="form-check-input" type="checkbox" id="is-head" name="is_head" {{ $handler->is_head ? 'checked' : '' }}>
                </div>
            </div>
        </div>
    </form>
@endsection
