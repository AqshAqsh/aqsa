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
                <h3>User Records</h3>
                <a href="{{ route('admin.user.create') }}" class="btn purchase-button">Add New</a>
            </span>
        </div>
    </div>

    <div class="container">
        <table class="table">
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Password</th> <!-- You may want to reconsider showing password -->
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $value)
                <tr>
                    <td>{{ $value->user_id }}</td>
                    <td>{{ $value->name }}</td>
                    <td>{{ $value->email }}</td>
                    <td>********</td> <!-- Masked Password for security -->
                    <td>
                        <a href="{{ route('admin.user.delete', $value->id) }}" class="btn btn-danger p-1" onclick="return confirm('Are you sure you want to delete this user?')">Delete</a>
                        <a href="{{ route('admin.user.edit', $value->id) }}" class="btn btn-primary p-1">Edit</a>
                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>
    </div>
</div>
@endsection