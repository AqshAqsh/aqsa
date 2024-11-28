@extends('layouts.admin-app')

@section('title')
Facility List
@endsection

@section('content')
<div class="content-wrapper">
    <div class="row" id="proBanner">
        <div class="col-12">
            <span class="d-flex align-items-center purchase-popup">
                <h3 class="mt-2 mr-3">Facilities</h3>
                <a href="{{ route('admin.facility.create') }}" class="btn purchase-button">Add New</a>
            </span>
        </div>
    </div>
    <div class="row d-flex align-items-center justify-content-center">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Facility List</h4>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Facility Name</th>
                                <th>Room No</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($facilities as $facility)
                            <tr>
                                <td>{{ $facility->id }}</td>
                                <td>
                                    @if($facility->icon)
                                    <img src="{{ asset('storage/' . $facility->icon) }}" alt="{{ $facility->name }}" width="50" height="50">
                                    @endif
                                    {{ $facility->name }}
                                </td class="description-scroll">
                                <td>@if($facility->rooms->isNotEmpty())
                                    @foreach ($facility->rooms as $room)
                                    {{ $room->room_no }}{{ !$loop->last ? ', ' : '' }}
                                    @endforeach
                                    @else
                                    N/A
                                    @endif
                                </td>

                                <td class="description-scroll">{{ $facility->description }}</td>
                                <td>
                                    <a href="{{ route('admin.facility.edit', ['id' => $facility->id]) }}" class="btn btn-success">Edit</a>
                                    <a href="{{ route('admin.facility.delete', ['id' => $facility->id]) }}" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection