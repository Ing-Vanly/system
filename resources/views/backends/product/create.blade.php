@extends('backends.layouts.app')

@section('content')
    <div class="card">
        <form action="{{route('product.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-6">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name"
                            placeholder="Enter your product name">
                    </div>
                    <div class="form-group col-6">
                        <label for="brand">Brand</label>
                        <input type="text" class="form-control" id="brand" name="brand"
                            placeholder="Enter your product's brand">
                    </div>
                    <div class="form-group col-6">
                        <label for="price">Price</label>
                        <input type="text" class="form-control" id="price" name="price"
                            placeholder="Enter your product's price">
                    </div>
                    <div class="form-group col-6">
                        <label for="quantity">Quantity</label>
                        <input type="number" class="form-control" id="quantity" name="quantity"
                            placeholder="Enter your quantity">
                    </div>
                    <div class="form-group col-6">
                        <label for="weight">Weight</label>
                        <input type="text" class="form-control" id="weight" name="weight"
                            placeholder="Enter the weight">
                    </div>
                    <div class="form-group col-6">
                        <label for="warranty">Warranty</label>
                        <input type="text" class="form-control" id="warranty" name="warranty"
                            placeholder="Enter the warranty">
                    </div>
                    <div class="form-group col-6">
                        <label for="image">Upload Image</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="image" name="image">
                                <label class="custom-file-label" for="image">Choose file</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
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
