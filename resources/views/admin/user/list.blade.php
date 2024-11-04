@extends('layouts.admin-app')

@section('content')
    <!DOCTYPE html>
    <html lang="en">
        <head>
            <title>View Records</title>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
            <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
        </head>
        <body>
            <div class="container-fluid">
                <h1 class="text-center " >Residents Record View</h1>
                <br>
            </div>
            <div class="content-wrapper">
        <div class="row " id="proBanner">
            <div class="col-12">
                <span class="d-flex align-items-center purchase-popup">
                    <h3>User</h3>
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
                            <th>Password</th> <!-- Consider removing this -->
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($user as $value)
                        <tr>
                            <td>{{ $value->user_id }}</td>
                            <td>{{ $value->name }}</td>
                            <td>{{ $value->email }}</td>
                            <td>********</td> <!-- Masked Password for security -->
                            <td>
                                <a href="{{ route('admin.user.delete', $value->id) }}" class="btn btn-danger p-1">Delete</a>
                                <a href="{{ route('admin.user.edit', $value->id) }}" class="btn btn-primary p-1">Edit</a> 
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </body>
    </html>
@endsection