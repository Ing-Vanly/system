@extends('backends.layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3>Product Details</h3>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <strong>Name:</strong>
                    <p>{{ $product->name }}</p>
                </div>

                <div class="col-md-6">
                    <strong>Price:</strong>
                    <p>{{ $product->price }}</p>
                </div>
                <div class="col-md-6">
                    <strong>Quantity:</strong>
                    <p>{{ $product->quantity }}</p>
                </div>
                <div class="col-md-6">
                    <strong>Created by:</strong>
                    <p>{{ $product->user->name }}</p>
                </div>

                <div class="col-md-6">
                    <strong>Image:</strong><br>
                    @if ($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="Product Image" width="150">
                    @else
                        <p>No Image</p>
                    @endif
                </div>
            </div>
        </div>

        <div class="card-footer">
            <a href="{{ route('product.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>
@endsection
