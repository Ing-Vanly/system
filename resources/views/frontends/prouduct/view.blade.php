@extends('frontends.layouts.app')
@section('contend')
    <div class="product-container">
        <div class="product-image">
            <img src="{{ asset('storage/' . $product->image) }}" alt="Product Image">
        </div>
        <div class="product-details">
            <h1 class="product-title">{{ $product->name }}</h1>
            <p class="product-description">
                This is a detailed description of the product. It includes information about the features,
                materials, and benefits of the product. You can add as much text as needed here.
            </p>
            <div class="price-section">
                <p>Price: {{ $product->price }}</p>
                {{-- <p class="discounted-price">$99.99</p>
                    <p class="savings">You save $50.00 (33%)</p> --}}
            </div>
            <button class="add-to-cart">Add to Cart</button>
            <button class="add-to-cart">Buy Now</button>
        </div>
    </div>

@endsection
