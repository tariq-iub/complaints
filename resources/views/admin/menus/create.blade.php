@extends('layouts.app')

@section('content')
    <nav class="mb-3" aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('menus.index') }}">Menus</a></li>
            <li class="breadcrumb-item active">Add Menu</li>
        </ol>
    </nav>

    <form action="{{ route('menus.store') }}" method="POST">
        @csrf
        <div class="row g-3 flex-between-end mb-5">
            <div class="col-auto">
                <h2 class="mb-2">Create Menu</h2>
                <h5 class="text-body-tertiary fw-semibold">
                    Add a new menu item for navigation.
                </h5>
            </div>
            <div class="col-auto">
                <a href="{{ route('menus.index') }}" class="btn btn-phoenix-secondary me-2 mb-2 mb-sm-0">Discard</a>
                <button class="btn btn-primary mb-2 mb-sm-0" type="submit">Add Menu</button>
            </div>
        </div>

        <div class="row g-5">
            <div class="col-12 col-xl-8">
                <div class="mb-5">
                    <h5>Title</h5>
                    <input type="text" class="form-control" id="title" name="title"
                           value="{{ old('title') }}" required>
                    @if($errors->has('title'))
                        <div class="text-danger small">
                            {{ $errors->first('title') }}
                        </div>
                    @endif
                </div>

                <div class="mb-5">
                    <h5>Icon</h5>
                    <input type="text" class="form-control" id="icon" name="icon"
                           value="{{ old('icon') }}">
                </div>

                <div class="mb-5">
                    <h5>Route</h5>
                    <input type="text" class="form-control" id="route" name="route"
                           value="{{ old('route') }}">
                </div>

                <div class="mb-5">
                    <h5>Display Order</h5>
                    <input type="number" class="form-control" id="display_order" name="display_order"
                           value="{{ old('display_order') }}">
                </div>

                <div class="mb-5">
                    <h5>Status</h5>
                    <select class="form-select" id="status" name="status" required>
                        <option value="1" {{ old('status') ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ old('status') ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
            </div>

            <div class="col-12 col-xl-4">
                <div class="row g-2">
                    <div class="col-12 col-xl-12">
                        <div class="card mb-3">
                            <div class="card-body">
                                <h4 class="card-title mb-4">Parent Menu</h4>
                                <div class="row gx-3">
                                    <div class="col-12 col-sm-6 col-xl-12">
                                        <div class="mb-4">
                                            <div class="d-flex flex-wrap mb-2">
                                                <h5 class="mb-0 text-body-highlight me-2">Select Parent Menu</h5>
                                            </div>
                                            <select class="form-select" id="parent_id" name="parent_id">
                                                <option value="">None</option>
                                                @foreach($menus as $menu)
                                                    <option value="{{ $menu->id }}">{{ $menu->title }}</option>
                                                @endforeach
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
