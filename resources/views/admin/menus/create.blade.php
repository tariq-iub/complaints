@extends('layouts.powereye')

@section('content')
    <nav class="mb-3" aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('menus.index') }}">Menus</a></li>
            <li class="breadcrumb-item active">Create Menu</li>
        </ol>
    </nav>

    <div class="mb-5">
        <h2 class="text-bold text-body-emphasis">Create Menu</h2>
        <p class="text-body-tertiary lead">Add a new menu item.</p>
    </div>

    <form action="{{ route('menus.store') }}" method="POST">
        @csrf
        <!-- Add your form fields here -->
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="mb-3">
            <label for="icon" class="form-label">Icon</label>
            <input type="text" class="form-control" id="icon" name="icon">
        </div>
        <div class="mb-3">
            <label for="route" class="form-label">Route</label>
            <input type="text" class="form-control" id="route" name="route">
        </div>
        <div class="mb-3">
            <label for="parent_id" class="form-label">Parent Menu</label>
            <select class="form-select" id="parent_id" name="parent_id">
                <option value="">None</option>
                @foreach($menus as $menu)
                    <option value="{{ $menu->id }}">{{ $menu->title }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="display_order" class="form-label">Display Order</label>
            <input type="number" class="form-control" id="display_order" name="display_order">
        </div>
        <div class="mb-3">
            <label for="level" class="form-label">Level</label>
            <select class="form-select" id="level" name="level" required>
                <option value="admin">Admin</option>
                <option value="client">Client</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select class="form-select" id="status" name="status" required>
                <option value="1">Active</option>
                <option value="0">Inactive</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Save Menu</button>
    </form>
@endsection
