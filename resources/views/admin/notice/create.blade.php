@extends('layouts.admin-app')

@section('title')
Notice Create
@endsection

@section('content')
<div class="content-wrapper">
    <div class="row" id="proBanner">
        <div class="col-12">
            <span class="d-flex align-items-center purchase-popup">
                <h3 class="mt-2 mr-3">Notice Create</h3>
                <a href="{{ route('admin.notice.list') }}" class="btn purchase-button">Go Back</a>
            </span>
        </div>
    </div>
    <div class="row d-flex align-items-center justify-content-center">
        <div class="col-md-8 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Create Notice Form</h4>
                    <form method="POST" action="{{ route('admin.notice.store') }}" enctype="multipart/form-data" class="forms-sample">
                        @csrf
                        <div class="form-group row">
                            <label for="title" class="col-sm-3 col-form-label">Title</label>
                            <div class="col-sm-9">
                                <input type="text" name="title" class="form-control" id="title" placeholder="Enter Title" value="{{ old('title') }}" required>
                                @error('title')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="expiry_date" class="col-sm-3 col-form-label">Expiry Date</label>
                            <div class="col-sm-9">
                                <input type="date" name="expiry_date" class="form-control" id="expiry_date" value="{{ old('expiry_date') }}" required>
                                @error('expiry_date')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="content" class="col-sm-3 col-form-label">Notice</label>
                            <div class="col-sm-9">
                                <textarea name="content" id="content" cols="30" rows="10" class="form-control" required>{{ old('content') }}</textarea>
                                @error('content')
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