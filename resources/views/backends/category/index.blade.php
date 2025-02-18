    @extends('backends.layouts.app')

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
                            <th>Brand</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Image</th>
                            <th>Add by</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categorys as $category)
                            <tr>
                                <td>{{ $category->id }}</td>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->brand }}</td>
                                <td>{{ $category->price }}</td>
                                <td>{{ $category->quantity }}</td>
                                <td>
                                    @if ($category->image)
                                        <img src="{{ asset('storage/' . $category->image) }}" alt="Category Image"
                                            width="50" height="50">
                                    @else
                                        No Image
                                    @endif
                                </td>
                                <td>
                                    {{ $category->user->name ?? 'Unknown' }}
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
                                        <button type="submit" class="btn btn-danger btn-sm"
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
                            <th>Brand</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Image</th>
                            <th>Add by</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        @if (session('success'))
            <script>
                Swal.fire({
                    title: 'Success!',
                    text: '{{ session('success') }}',
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
            </script>
        @endif
        <script>
            @foreach ($categorys as $category)
                document.getElementById('deleteBtn{{ $category->id }}').addEventListener('click', function(e) {
                    e.preventDefault();
                    console.log('test');
                    Swal.fire({
                        title: 'Are you sure?',
                        text: 'You won\'t be able to revert this!',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Yes, delete it!',
                        cancelButtonText: 'No, cancel!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            this.closest('form').submit();
                        }
                    });
                });
            @endforeach
        </script>
    @endsection
