@extends('layouts.admin-app')

@section('title')
Bed Update
@endsection

@section('content')
<div class="content-wrapper">
    <div class="row" id="proBanner">
        <div class="col-12">
            <span class="d-flex align-items-center purchase-popup">
                <h3>Bed Update</h3>
                <a href="{{ route('admin.bed.list') }}" class="btn purchase-button">Go Back</a>
            </span>
        </div>
    </div>
    <div class="row d-flex align-items-center justify-content-center">
        <div class="col-md-8 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Update Bed Form</h4>
                    <form method="POST" enctype="multipart/form-data"
                        action="{{ route('admin.bed.update', ['id' => $bed->id]) }}"
                        class="forms-sample">
                        @csrf
                        @method('PUT') <!-- Adding method spoofing for PUT request -->

                        <div class="form-group row">
                            <label for="bed_no" class="col-sm-3 col-form-label">Bed Number</label>
                            <div class="col-sm-9">
                                <input type="number" name="bed_no" class="form-control"
                                    id="bed_no" placeholder="Enter Bed Number"
                                    value="{{ old('bed_no', $bed->bed_no) }}" min="1" max="4" required>
                                @error('bed_no')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="room_id" class="col-sm-3 col-form-label">Room</label>
                            <div class="col-sm-9">
                                <select name="room_id" id="room_id" class="form-control" required>
                                    <option value="">Select the Room</option>
                                    @foreach ($rooms as $room)
                                    <option value="{{ $room->id }}" {{ $room->id == $bed->room_id ? 'selected' : '' }}>{{ $room->room_no }}</option>
                                    @endforeach
                                </select>
                                @error('room_id')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-sm-3 col-form-label">Description</label>
                            <div class="col-sm-9">
                                <input type="text" name="description" class="form-control"
                                    id="description" placeholder="Enter Description"
                                    value="{{ old('description', $bed->description) }}" required>
                                @error('description')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary mr-2">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection