@extends('layouts.admin-app')

@section('title')
Room Category Create
@endsection

@section('content')
<div class="content-wrapper">
    <div class="row " id="proBanner">
        <div class="col-12">
            <span class="d-flex align-items-center purchase-popup">
                <h3 class="mt-2 mr-3">Room Category Create</h3>
                <a href="{{ route('admin.room_category.list') }}" class="btn purchase-button">Go Back</a>
            </span>
        </div>
    </div>
    <div class="row d-flex aling-items-center justify-content-center">
        <div class="col-md-8 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Create Room Category</h4>
                    <form id="myForm" method="POST" action="{{ route('admin.room_category.store') }}" class="forms-sample">
                        @csrf
                        <div class="form-group row">
                            <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Name</label>
                            <div class="col-sm-9">
                                <input type="text" name="name" class="form-control" id="exampleInputUsername2"
                                    placeholder="Enter Name" value="{{ old('name') }}">
                                @error('name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection