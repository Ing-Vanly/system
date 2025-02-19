@extends('backends.layouts.app')

@section('content')
    <div class="card">
        <form action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-6">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name"
                            placeholder="Enter your product name">
                    </div>
                    <div class="form-group col-6">
                        <label for="user_id">Select User</label>
                        <select class="form-control" id="user_id" name="user_id">
                            <option value="">Select a user</option> <!-- Default Option -->
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-12">
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
                <a href="{{ route('category.index') }}" class="btn btn-secondary">Back</a>
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
