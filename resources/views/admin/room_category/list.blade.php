@extends('layouts.admin-app')

@section('title')
Room Category List
@endsection

@section('content')
<div class="content-wrapper">
    <div class="row " id="proBanner">
        <div class="col-12">
            <span class="d-flex align-items-center purchase-popup">
                <h3 class="mt-2 mr-3">Room_Category</h3>
                <a href="{{ route('admin.room_category.create') }}" class="btn purchase-button">Add New</a>
            </span>
        </div>
    </div>
    <div class="row d-flex aling-items-center justify-content-center">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">room_category List</h4>
                    </p>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>No. #</th>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($room_categorys as $room_category)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $room_category->name }}</td>
                                <td>
                                    <a href="{{ route('admin.room_category.edit', ['id' => $room_category->id]) }}"
                                        class="btn btn-success">Edit</a>
                                    <a class="btn btn-danger p-1">

                                        <form action="{{ route('admin.room_category.delete', ['id' => $room_category->id]) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger p-1">Delete</button>
                                        </form>
                                    </a>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection