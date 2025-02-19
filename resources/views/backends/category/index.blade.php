    @extends('backends.layouts.app')

    @push('css')
        <style>
        </style>
    @endpush

    @section('content')
        <div class="card">
            <div class="d-flex justify-content-between pt-3 px-3 align-items-center">
                <h3 class="card-title">DataTable with default features</h3>
                <a type="button" class="btn bg-gradient-primary" href="{{ route('category.create') }}">Add Category</a>
            </div>

            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Created by</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categorys as $category)
                            <tr>
                                <td>{{ $category->id }}</td>
                                <td>{{ $category->name }}</td>
                                <td>
                                    {{ $category->user->name ?? 'Unknown' }}
                                </td>
                                <td>
                                    @if ($category->image)
                                        <img src="{{ asset('storage/' . $category->image) }}" alt="Category Image"
                                            class="rounded-circle bg-light" width="50" height="50">
                                    @else
                                        No Image
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('category.show', $category->id) }}"
                                        class="btn btn-info btn-sm">Show</a>
                                    <a href="{{ route('category.edit', $category->id) }}"
                                        class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('category.destroy', $category->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm delete-btn"
                                            id="deleteBtn{{ $category->id }}">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Created by</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    @endsection
    @push('js')
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                // Success message alert
                @if (session('success'))
                    Swal.fire({
                        title: 'Success!',
                        text: '{{ session('success') }}',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    });
                @endif

                // Handle delete confirmation for all delete buttons
                document.querySelectorAll('.delete-btn').forEach(button => {
                    button.addEventListener('click', function(e) {
                        e.preventDefault(); // Prevent form submission before confirmation
                        let form = this.closest('form');
                        Swal.fire({
                            title: 'Are you sure?',
                            text: 'This action cannot be undone!',
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#d33',
                            cancelButtonColor: '#3085d6',
                            confirmButtonText: 'Yes, delete it!',
                            cancelButtonText: 'No, cancel!',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                form.submit(); // Only submit the form if confirmed
                            }
                        });
                    });
                });
            });
        </script>
    @endpush
