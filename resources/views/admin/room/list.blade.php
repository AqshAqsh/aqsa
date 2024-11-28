@extends('layouts.admin-app')

@section('title')
Rooms List
@endsection

@section('content')
<div class="content-wrapper">
    <div class="row " id="proBanner">
        <div class="col-12">
            <span class="d-flex align-items-center purchase-popup">
                <h3 class="mt-2 mr-3">Rooms</h3>
                <a href="{{ route('admin.room.create') }}" class="btn purchase-button">Add New</a>
            </span>
        </div>
    </div>
    <div class="row d-flex aling-items-center justify-content-center">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Rooms List</h4>
                    </p>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                            <th>#</th>

                                <th>Room Picture</th>
                                <th>Room No</th>
                                <th>Room Category</th>
                                <th>Description</th>
                                <th>Room Charge</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rooms as $room)
                            <tr>
                            <td>{{ $loop->iteration }}</td>

                                <td> @if($room->picture)
                                    <img src="{{ asset('storage/' . $room->picture) }}" alt="Room pic" width="50" height="50">
                                    @endif
                                    {{ $room->name }}
                                </td>

                                <td>{{ $room->room_no }}</td>
                                <td>{{ $room->category->name }}</td>
                                <td class="description-scroll">{{ $room->description }}</td>
                                <td>{{ $room->room_charge }}</td>


                                <td>
                                    <a href="{{ route('admin.room.edit', ['id' => $room->id]) }}"
                                        class="btn btn-success">Edit</a>
                                    <a href="{{ route('admin.room.delete', ['id' => $room->id]) }}"
                                        class="btn btn-danger">Delete</a>
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