@extends('backends.layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3>Category Details</h3>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <strong>Name:</strong>
                    <p>{{ $category->name }}</p>
                </div>
                <div class="col-md-6">
                    <strong>Created by:</strong>
                    <p>{{ $category->user->name }}</p>
                </div>
                <div class="col-md-6">
                    <strong>Profile Picture:</strong><br>
                    @if ($category->image)
                        <img src="{{ asset('storage/' . $category->image) }}" alt="Category Image" width="150">
                    @else
                        <p>No Image</p>
                    @endif
                </div>
            </div>
        </div>

        <div class="card-footer">
            <a href="{{ route('category.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>
@endsection
