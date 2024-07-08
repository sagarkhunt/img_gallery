@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Upload Image</h1>
    <form action="/images" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" class="form-control" id="image" name="image" required>
        </div>
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description" required></textarea>
        </div>
        <div class="form-group">
            <label for="tag">Tag</label>
            <input type="text" class="form-control" id="tag" name="tag" required>
        </div>
        <button type="submit" class="btn btn-primary">Upload</button>
        <a href="{{ url('/') }}" class="btn btn-secondary">Cancel</a>
    </form>
@endsection
