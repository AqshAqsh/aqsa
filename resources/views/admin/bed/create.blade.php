@extends('layouts.admin-app')

@section('content')
<div class="content-wrapper">
    <div class="row" id="proBanner">
        <div class="col-12">
            <span class="d-flex align-items-center purchase-popup">
                <h3 class="mt-2 mr-3">Bed Create</h3>
                <a href="{{ route('admin.bed.list') }}" class="btn purchase-button">Go Back</a>
            </span>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Create Bed Form</h4>
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('admin.bed.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="room_id">Room No</label>
                            <select name="room_id" id="room_id" class="form-control" required>
                                <option value="">Select a room</option>
                                @foreach ($rooms as $room)
                                    <option value="{{ $room->id }}" {{ old('room_id') == $room->id ? 'selected' : '' }}>
                                        {{ $room->room_no }} 
                                        ({{ $room->number_of_members ?? 0 }} beds)
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('room_id'))
                                <span class="text-danger">{{ $errors->first('room_id') }}</span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="bed_no">Number of Beds</label>
                            <input type="number" name="bed_no" class="form-control" id="bed_no" value="{{ old('bed_no') }}" min="1" max="4" required>
                            @if ($errors->has('bed_no'))
                                <span class="text-danger">{{ $errors->first('bed_no') }}</span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" class="form-control" id="description" rows="4" required>{{ old('description') }}</textarea>
                            @if ($errors->has('description'))
                                <span class="text-danger">{{ $errors->first('description') }}</span>
                            @endif
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
