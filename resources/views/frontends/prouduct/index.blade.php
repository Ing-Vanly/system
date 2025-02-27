@extends('frontends.layouts.app')
@section('contend')
    <div class="container" id="home">
        <div id="demo" class="carousel slide" data-bs-ride="carousel">

            <!-- Indicators/dots -->
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active"></button>
                <button type="button" data-bs-target="#demo" data-bs-slide-to="1"></button>
                <button type="button" data-bs-target="#demo" data-bs-slide-to="2"></button>
            </div>

            <!-- The slideshow/carousel -->
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="{{ asset('assets/banner.jpg') }}" alt="Los Angeles" class="d-block"
                        style="width:100%">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('assets/banner_02.jpg') }}" alt="Chicago" class="d-block"
                        style="width:100%">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('assets/banner_03.jpg') }}" alt="New York" class="d-block"
                        style="width:100%">
                </div>
            </div>

            <!-- Left and right controls/icons -->
            <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
            </button>
        </div>
    </div>
    <div class="center_text" id="product">
        <h2>Popular Food</h2>
    </div>
    <div class="container">
        <div class="row">
            @foreach ($products as $product)
                <div class="col-2">
                    <div class="card">
                        <div class="image_product">
                            <img src="{{ asset('storage/' . $product->image) }}" alt="Product Image">
                        </div>
                        <h3>{{ $product->name }}</h3>
                        <p>Healthy Food</p>
                        <p>Price: {{ $product->price }}</p>
                        <a href="{{ route('front.show', $product->id) }}" class="btn btn-primary">View all Detail</a>
                        <button>Add to Cart</button>
                    </div>
                </div>
            @endforeach
        </div>
        </div>
    @endsection
