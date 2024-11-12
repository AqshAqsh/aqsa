@extends('layouts.admin-app')

@section('title')
Room Update
@endsection

@section('content')
<div class="content-wrapper">
    <div class="row" id="proBanner">
        <div class="col-12">
            <span class="d-flex align-items-center purchase-popup">
                <h3>Room Update</h3>
                <a href="{{ route('admin.room.list') }}" class="btn purchase-button">Go Back</a>
            </span>
        </div>
    </div>
    <div class="row d-flex align-items-center justify-content-center">
        <div class="col-md-8 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Update Room</h4>
                    <form method="POST" action="{{ route('admin.room.update', $room->id) }}" enctype="multipart/form-data" class="forms-sample">
                        @csrf
                        
                        <div class="form-group row">
                            <label for="room_no" class="col-sm-3 col-form-label">Room No</label>
                            <div class="col-sm-9">
                                <input type="text" name="room_no" class="form-control" id="room_no" placeholder="Enter Room No" value="{{ old('room_no', $room->room_no) }}">
                                @error('room_no')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="room_category_id" class="col-sm-3 col-form-label">Room Category</label>
                            <div class="col-sm-9">
                                <select name="room_category_id" id="room_category_id" class="form-control">
                                    <option value="">Select the category</option>
                                    @foreach ($room_categories as $category) <!-- Corrected variable name -->
                                    <option value="{{ $category->id }}" {{ (old('room_category_id', $room->room_category_id) == $category->id) ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('room_category_id')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-sm-3 col-form-label">Description</label>
                            <div class="col-sm-9">
                                <textarea name="description" id="description" cols="30" rows="10" class="form-control">{{ old('description', $room->description) }}</textarea>
                                @error('description')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="room_charge" class="col-sm-3 col-form-label">Room Charge</label>
                            <div class="col-sm-9">
                                <input type="number" name="room_charge" class="form-control" id="room_charge" placeholder="Enter Room Charge" value="{{ old('room_charge', $room->room_charge) }}">
                                @error('room_charge')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Add block_id field -->
                        <div class="form-group row">
                            <label for="block_id" class="col-sm-3 col-form-label">Block ID</label>
                            <div class="col-sm-9">
                                <input type="text" name="block_id" class=" form-control" id="block_id" placeholder="Block ID" value="{{ old('block_id', $room->block_id) }}" readonly>
                                @error('block_id')
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