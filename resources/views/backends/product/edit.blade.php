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
                        <label for="category_id">Category</label>
                        <select class="form-control" id="category_id" name="category_id">
                            <option value="">Select the category</option> <!-- Default option -->
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ isset($product->category_id) && $product->category_id == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-6">
                        <label for="user_id">Created by</label>
                        <select class="form-control" id="user_id" name="user_id">
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}" {{ $product->user_id == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }}
                                </option>
                            @endforeach
                        </select>
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
