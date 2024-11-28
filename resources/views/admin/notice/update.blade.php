@extends('layouts.admin-app')

@section('title')
Notice Update
@endsection

@section('content')
<div class="content-wrapper">
    <div class="row " id="proBanner">
        <div class="col-12">
            <span class="d-flex align-items-center purchase-popup">
                <h3 class="mt-2 mr-3">Notice Update</h3>
                <a href="{{ route('admin.notice.list') }}" class="btn purchase-button">Go Back</a>
            </span>
        </div>
    </div>
    <div class="row d-flex aling-items-center justify-content-center">
        <div class="col-md-8 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Update Notice Form</h4>
                    <form method="POST" action="{{ route('admin.notice.update',['id'=>$notice->id]) }}" enctype="multipart/form-data"
                        class="forms-sample">
                        @csrf
                        @method('PUT')
                        <div class="form-group row">
                            <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Title</label>
                            <div class="col-sm-9">
                                <input type="title" name="title" class="form-control" id="exampleInputUsertitle2"
                                    placeholder="Enter title" value="{{ $notice->title }}">
                                @error('title')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Expiry Date</label>
                            <div class="col-sm-9">
                                <input type="expiry_date" name="expiry_date" class="form-control" id="exampleInputUserexpiry_date2"
                                    placeholder="Enter expiry_Date" value="{{ $notice->expiry_date }}">
                                @error('expiry_date')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="content" class="col-sm-3 col-form-label">Notice</label>
                            <div class="col-sm-9">
                                <textarea name="content" id="content" cols="30" rows="10" class="form-control" required>{{ $notice->content }}</textarea>
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