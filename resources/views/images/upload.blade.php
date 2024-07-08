@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Upload Images</h1>
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <form action="{{ route('image.upload') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="images">Choose Images</label>
            <input type="file" class="form-control-file" id="images" name="images[]" accept="image/*" multiple required>
        </div>
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="form-group">
            <label for="tag">Tag</label>
            <input type="text" class="form-control" id="tag" name="tag" required>
        </div>
        <button type="submit" class="btn btn-primary">Upload</button>
    </form>
@endsection
