@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Image Gallery</h1>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <a href="/images/create" class="btn btn-primary mb-3">Add Image</a>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Tag</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($images as $image)
                    <tr>
                        <td><img src="{{ asset('storage/' . $image->image_url) }}" alt="{{ $image->title }}"
                                class="img-thumbnail" width="150"></td>
                        <td>{{ $image->title }}</td>
                        <td>{{ $image->description }}</td>
                        <td>{{ $image->tag }}</td>
                        <td>
                            <a href="/images/{{ $image->id }}/edit" class="btn btn-secondary btn-sm">Edit</a>
                            <form action="/images/{{ $image->id }}" method="POST" class="d-inline"
                                onsubmit="return confirmDelete()">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
@section('scripts')
    <script>
        function confirmDelete() {
            return confirm('Are you sure you want to delete this image?');
        }
    </script>
@endsection
