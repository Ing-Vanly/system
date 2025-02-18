@extends('backends.layouts.app')

@section('content')
    <div class="card">
        <form action="{{ route('product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-6">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name"
                            value="{{ old('name', $product->name) }}" placeholder="Enter your product name">
                    </div>
                    <div class="form-group col-6">
                        <label for="brand">Brand</label>
                        <input type="text" class="form-control" id="brand" name="brand"
                            value="{{ old('brand', $product->brand) }}" placeholder="Enter your product's brand">
                    </div>
                    <div class="form-group col-6">
                        <label for="price">Price</label>
                        <input type="text" class="form-control" id="price" name="price"
                            value="{{ old('price', $product->price) }}" placeholder="Enter your product's price">
                    </div>
                    <div class="form-group col-6">
                        <label for="quantity">Quantity</label>
                        <input type="number" class="form-control" id="quantity" name="quantity"
                            value="{{ old('quantity', $product->quantity) }}" placeholder="Enter your quantity">
                    </div>
                    <div class="form-group col-6">
                        <label for="weight">Weight</label>
                        <input type="text" class="form-control" id="weight" name="weight"
                            value="{{ old('weight', $product->weight) }}" placeholder="Enter the weight">
                    </div>
                    <div class="form-group col-6">
                        <label for="warranty">Warranty</label>
                        <input type="text" class="form-control" id="warranty" name="warranty"
                            value="{{ old('warranty', $product->warranty) }}" placeholder="Enter the warranty">
                    </div>
                    <div class="form-group col-6">
                        <label for="image">Upload Image</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="image" name="image">
                                <label class="custom-file-label" for="image">
                                    @if ($product->image)
                                        {{ $product->image }}
                                    @else
                                        Choose file
                                    @endif
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('product.index') }}" class="btn btn-secondary">Back</a>
            </div>
        </form>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById("image").addEventListener("change", function(event) {
                let fileName = event.target.files[0] ? event.target.files[0].name : "Choose file";
                event.target.nextElementSibling.innerText = fileName;
            });
        });
    </script>
@endsection
