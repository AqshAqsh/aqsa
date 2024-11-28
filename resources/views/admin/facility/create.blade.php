@extends('layouts.admin-app')

@section('content')
<div class="content-wrapper">
    <div class="row" id="proBanner">
        <div class="col-12">
            <span class="d-flex align-items-center purchase-popup">
                <h3 class="mt-2 mr-3">Create Facility</h3>
                <a href="{{ route('admin.facility.list') }}" class="btn purchase-button">Go Back</a>
            </span>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Create Facility Form</h4>
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

                    <form method="POST" action="{{ route('admin.facility.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="room_ids">Room</label>
                            <select name="room_ids[]" id="room_ids" class="form-control" multiple required>
                                @foreach ($rooms as $room)
                                <option value="{{ $room->id }}"
                                    @if(isset($facility) && $facility->rooms->contains($room->id)) selected @endif>
                                    {{ $room->room_no }}
                                </option>
                                @endforeach
                            </select>
                        </div>


                        <div class="form-group">
                            <label for="name">Facility Name</label>
                            <input type="text" name="name" id="name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="icon">Facility Icon</label>
                            <input type="file" name="icon" id="icon" class="form-control" accept=".jpg,.jpeg,.png,.gif,.svg">
                        </div>


                        <div class="form-group">
                            <label for="description">Description</label>
                            <input type="text" name="description" id="description" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Create Facility</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection