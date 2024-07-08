@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Image Gallery</h1>
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <div class="row">
        @foreach ($images as $image)
            <div class="col-md-4">
                <div class="card mb-4">
                    <img src="{{ asset('storage/' . $image->image_url) }}" class="card-img-top" alt="{{ $image->title }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $image->title }}</h5>
                        <p class="card-text">Tag: {{ $image->tag }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
