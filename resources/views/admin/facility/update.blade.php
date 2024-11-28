@extends('layouts.admin-app')

@section('title')
Facility Update
@endsection

@section('content')
<div class="content-wrapper">
    <div class="row" id="proBanner">
        <div class="col-12">
            <span class="d-flex align-items-center purchase-popup">
                <h3 class="mt-2 mr-3">Facility Update</h3>
                <a href="{{ route('admin.facility.list') }}" class="btn purchase-button">Go Back</a>
            </span>
        </div>
    </div>
    <div class="row d-flex align-items-center justify-content-center">
        <div class="col-md-8 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Update Facility Form</h4>
                    <form method="POST" action="{{ route('admin.facility.update', ['id' => $facility->id]) }}" enctype="multipart/form-data" class="forms-sample">
                        @csrf
                        <!-- Adding method spoofing for PUT request -->
                        @method('PUT')
                        <div class="form-group row">
                            <label for="name" class="col-sm-3 col-form-label">Facility Name</label>
                            <div class="col-sm-9">
                                <input type="text" name="name" class="form-control" id="name" placeholder="Enter Facility Name" value="{{ old('name', $facility->name) }}" required>
                                @error('name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="room_id" class="col-sm-3 col-form-label">Room</label>
                            <div class="col-sm-9">
                                <select name="room_ids[]" id="room_ids" class="form-control" multiple required>
                                    @foreach ($rooms as $room)
                                    <option value="{{ $room->id }}"
                                        @if(isset($facility) && $facility->rooms->contains($room->id)) selected @endif>
                                        {{ $room->room_no }}
                                    </option>
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
                                <input type="text" name="description" class="form-control" id="description" placeholder="Enter Description" value="{{ old('description', $facility->description) }}" required>
                                @error('description')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="icon" class="col-sm-3 col-form-label">Facility Icon</label>
                            <div class="col-sm-9">
                                @if($facility->icon)
                                <img src="{{ asset('storage/' . $facility->icon) }}" alt="{{ $facility->name }}" style="width: 50px; height: 50px; margin-bottom: 10px;">
                                @endif
                                <input type="file" name="icon" id="icon" class="form-control" accept="image/*">
                                <small class="text-muted">Upload a new icon (optional). Existing icon will be kept if no new icon is uploaded.</small>
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