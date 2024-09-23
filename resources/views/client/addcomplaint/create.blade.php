@extends('layouts.powereye')

@section('content')
    <h5 class="fs-5 mb-2 text-body-emphasis">Create a Complaint</h5>

    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <form action="{{ route('client.complaints.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}">
            @error('title')
                <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label for="detail" class="form-label">Detail</label>
            <textarea name="detail" id="detail" class="form-control">{{ old('detail') }}</textarea>
            @error('detail')
                <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label for="category_id" class="form-label">Category</label>
            <select name="category_id" id="category_id" class="form-control">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}"{{ old('category_id') == $category->id ? ' selected' : '' }}>{{ $category->title }}</option>
                @endforeach
            </select>
            @error('category_id')
                <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label for="priority" class="form-label">Priority</label>
            <select name="priority" id="priority" class="form-control">
                <option value="normal"{{ old('priority') == 'normal' ? ' selected' : '' }}>Normal</option>
                <option value="urgent"{{ old('priority') == 'urgent' ? ' selected' : '' }}>Urgent</option>
                <option value="express"{{ old('priority') == 'express' ? ' selected' : '' }}>Express</option>
            </select>
            @error('priority')
                <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label for="photo_path" class="form-label">Photo</label>
            <input type="file" name="photo_path" id="photo_path" class="form-control">
            @error('photo_path')
                <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Submit Complaint</button>
    </form>
@endsection
