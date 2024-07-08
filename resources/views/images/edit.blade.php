@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Edit Image</h1>
    <form action="/images/{{ $image->id }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="current_image">Current Image</label><br>
            <img src="{{ asset('storage/' . $image->image_url) }}" alt="{{ $image->title }}" class="img-thumbnail"
                width="200">
        </div>
        <div class="form-group">
            <label for="image">New Image</label>
            <input type="file" class="form-control" id="image" name="image">
            <small class="form-text text-muted">Leave blank to keep the current image.</small>
        </div>
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ $image->title }}" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description" required>{{ $image->description }}</textarea>
        </div>
        <div class="form-group">
            <label for="tag">Tag</label>
            <input type="text" class="form-control" id="tag" name="tag" value="{{ $image->tag }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ url('/') }}" class="btn btn-secondary">Cancel</a>
    </form>
@endsection
