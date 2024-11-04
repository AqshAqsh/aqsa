@extends('layouts.admin-app')

@section('title')
Member Update
@endsection

@section('content')
<div class="content-wrapper">
    <div class="row " id="proBanner">
        <div class="col-12">
            <span class="d-flex align-items-center purchase-popup">
                <h3>Member Update</h3>
                <a href="{{ route('admin.member.list') }}" class="btn purchase-button">Go Back</a>
            </span>
        </div>
    </div>
    <div class="row d-flex aling-items-center justify-content-center">
        <div class="col-md-8 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Update Member</h4>
                    <form method="POST" action="{{ route('admin.member.update',['id'=>$members->id]) }}" enctype="multipart/form-data"
                        class="forms-sample">
                        @csrf

                        <div class="form-group row">
                            <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Name</label>
                            <div class="col-sm-9">
                                <input type="text" name="name" class="form-control" id="exampleInputUsername2"
                                    placeholder="Enter name" value="{{ $members->name }}">
                                @error('name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Email</label>
                            <div class="col-sm-9">
                                <input type="text" name="email" class="form-control" id="exampleInputUseremail2"
                                    placeholder="Enter email" value="{{ $members->email }}">
                                @error('email')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputUsername2" class="col-sm-3 col-form-label">UserName</label>
                            <div class="col-sm-9">
                                <input type="text" name="username" class="form-control" id="exampleInputUserusername2"
                                    placeholder="Enter username" value="{{ $members->username }}">
                                @error('username')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Reigion</label>
                            <div class="col-sm-9">
                                <input type="text" name="religion" class="form-control" id="exampleInputUserreligion2"
                                    placeholder="Enter religion" value="{{ $members->religion }}">
                                @error('religion')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Gender</label>
                            <div class="col-sm-9">
                                <input type="text" name="gender" class="form-control" id="exampleInputUsergender2"
                                    placeholder="Enter gender" value="{{ $members->gender }}">
                                @error('gender')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Date Of Birth</label>
                            <div class="col-sm-9">
                                <input type="date" name="dob" class="form-control" id="exampleInputUserdob2"
                                    placeholder="Enter dob of birth" value="{{ $members->dob }}">
                                @error('dob')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Guardian Name</label>
                            <div class="col-sm-9">
                                <input type="text" name="guardian_name" class="form-control" id="exampleInputUserguardian_name2"
                                    placeholder="Enter guardian_name" value="{{ $members->guardian_name }}">
                                @error('guardian_name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Guardian Number</label>
                            <div class="col-sm-9">
                                <input type="text" name="guardian_number" class="form-control" id="exampleInputUserguardian_number2"
                                    placeholder="Enter guardian_number" value="{{ $members->guardian_number }}">
                                @error('guardian_number')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Guardian Relation</label>
                            <div class="col-sm-9">
                                <input type="text" name="guardian_relation" class="form-control" id="exampleInputUserguardian_relation2"
                                    placeholder="Enter guardian_relation" value="{{ $members->guardian_relation }}">
                                @error('guardian_relation')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Address</label>
                            <div class="col-sm-9">
                                <input type="text" name="address" class="form-control" id="exampleInputUseraddress2"
                                    placeholder="Enter address" value="{{ $members->address }}">
                                @error('address')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputUserimage2" class="col-sm-3 col-form-label">Image</label>
                            <div class="col-sm-9 d-flex align-items-center">
                                <!-- Show existing file -->
                                @if($members->image)
                                <div class="me-3">
                                    <img src="{{ asset('storage/' . $members->image) }}" alt="Existing Image" style="max-width: 100px; max-height: 100px;">
                                </div>
                                @endif
                                <input type="file" name="image" class="form-control" id="exampleInputUserimage2">
                                @error('image')
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