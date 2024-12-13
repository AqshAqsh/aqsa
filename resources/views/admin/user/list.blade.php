@extends('layouts.admin-app')

@section('content')
<div class="container-fluid">
    <h1 class="text-center">Residents Record View</h1>
    <br>
</div>

<div class="content-wrapper">
    <div class="row" id="proBanner">
        <div class="col-12">
            <span class="d-flex align-items-center purchase-popup">
                <h3 class="mt-2 mr-3">User Records </h3>
                <a href="{{ route('admin.user.create') }}" class="btn purchase-button">Add New</a>
            </span>
        </div>
    </div>

    <div class="container">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>

                    <th>User ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $value)
                <tr>
                    <td>{{ $loop->iteration }}</td>

                    <td>{{ $value->user_id }}</td>
                    <td>{{ $value->name }}</td>
                    <td>{{ $value->email }}</td>
                    <td>
                        <a class="btn btn-danger p-1">

                            <form action="{{ route('admin.user.delete', $value->user_id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger p-1">Delete</button>
                            </form>
                        </a>
                        <a href="{{ route('admin.user.edit', $value->user_id) }}" class="btn btn-primary p-2">Edit</a>



                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>
    </div>
</div>
<script>
    $(document).ready(function() {
        // Handle click event on the delete button
        $('.delete-user-btn').click(function() {
            // Get the user ID from the button's data attribute
            var userId = $(this).data('id');

            // Confirm deletion
            if (confirm('Are you sure you want to delete this user?')) {
                // AJAX request to delete user
                $.ajax({
                    url: '/admin/user/delete/' + userId,
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        alert('User deleted successfully');
                        // Optionally, remove the user row from the table
                        $('#user-' + userId).remove();
                    },
                    error: function(xhr) {
                        alert('Error deleting user');
                    }
                });
            }
        });

    });
</script>
@endsection