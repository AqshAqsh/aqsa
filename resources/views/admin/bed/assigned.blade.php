@extends('layouts.admin-app')

@section('content')
<div class="container">
    <h1 class="my-4">Assigned Beds</h1>

    <!-- Success Message -->
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <!-- Error Message -->
    @if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif

    <!-- Beds Table -->
    <table class="table table-bordered">
        <thead>
            <tr>
            <th>#</th>
                <th>Bed No.</th>
                <th>Room ID</th>
                <th>User ID</th>
                <th>Occupied</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($beds as $bed)
            <tr>
            <td>{{ $loop->iteration }}</td>

                <td>{{ $bed->bed_no }}</td>
                <td>{{ $bed->room->room_no }}</td>
                <td>{{ $bed->user_id ? $bed->user_id : 'No user Assign' }}</td>

                <td>
                    @if ($bed->is_occupied)
                    <span class="badge badge-success">Occupied</span>
                    @else
                    <span class="badge badge-danger">Available</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection