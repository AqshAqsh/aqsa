@extends('layouts.admin-app')

@section('title')
Member Create
@endsection

@section('content')
<div class="content-wrapper">
    <div class="row " id="proBanner">
        <div class="col-12">
            <span class="d-flex align-items-center purchase-popup">
                <h3>Member Create</h3>
                <a href="{{ route('admin.member.list') }}" class="btn purchase-button">Go Back</a>
            </span>
        </div>
    </div>
    <div class="row d-flex aling-items-center justify-content-center">
        <div class="col-md-8 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Create Member</h4>
                    <form method="POST" action="{{ route('admin.member.store') }}" enctype="multipart/form-data"
                        class="forms-sample">
                        @csrf
                        <div class="form-group row">
                            <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Name</label>
                            <div class="col-sm-9">
                                <input type="text" name="name" class="form-control" id="exampleInputUsername2"
                                    placeholder="Enter name" value="{{ old('name') }}">
                                @error('name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Email</label>
                            <div class="col-sm-9">
                                <input type="text" name="email" class="form-control" id="exampleInputUseremail2"
                                    placeholder="Enter email" value="{{ old('email') }}">
                                @error('email')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Password</label>
                            <div class="col-sm-9">
                                <input type="text" name="password" class="form-control" id="exampleInputUserpassword2"
                                    placeholder="Enter password" value="{{ old('password') }}">
                                @error('password')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputUsername2" class="col-sm-3 col-form-label">UserName</label>
                            <div class="col-sm-9">
                                <input type="text" name="username" class="form-control" id="exampleInputUserusername2"
                                    placeholder="Enter username" value="{{ old('username') }}">
                                @error('username')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Reigion</label>
                            <div class="col-sm-9">
                                <select name="religion" id="religion" class="form-control">
                                    <option value="">Select Religion</option>
                                    <option value="Muslim">Muslim</option>
                                    <option value="Non-Muslim">Non-Muslim</option>
                                </select>
                                @error('religion')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Gender</label>
                            <div class="col-sm-9">
                                <select name="gender" id="gender" class="form-control">
                                    <option value="">Select Option</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                                @error('gender')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Date Of Birth</label>
                            <div class="col-sm-9">
                                <input type="date" name="dob" class="form-control" id="exampleInputUserdob2"
                                    placeholder="Enter dob of birth" value="{{ old('dob') }}">
                                @error('dob')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Guardian Name</label>
                            <div class="col-sm-9">
                                <input type="text" name="guardian_name" class="form-control" id="exampleInputUserguardian_name2"
                                    placeholder="Enter guardian_name" value="{{ old('guardian_name') }}">
                                @error('guardian_name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Guardian Number</label>
                            <div class="col-sm-9">
                                <input type="text" name="guardian_number" class="form-control" id="exampleInputUserguardian_number2"
                                    placeholder="Enter guardian_number" value="{{ old('guardian_number') }}">
                                @error('guardian_number')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Guardian Relation</label>
                            <div class="col-sm-9">
                                <input type="text" name="guardian_relation" class="form-control" id="exampleInputUserguardian_relation2"
                                    placeholder="Enter guardian_relation" value="{{ old('guardian_relation') }}">
                                @error('guardian_relation')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Address</label>
                            <div class="col-sm-9">
                                <input type="text" name="address" class="form-control" id="exampleInputUseraddress2"
                                    placeholder="Enter address" value="{{ old('address') }}">
                                @error('address')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputUsername2" class="col-sm-3 col-form-label">image</label>
                            <div class="col-sm-9">
                                <input type="file" name="image" class="form-control" id="exampleInputUserimage2"
                                    placeholder="Enter image" value="{{ old('image') }}">
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