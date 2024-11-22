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
                <th>Bed No.</th>
                <th>Room ID</th>
                <th>User ID</th>
                <th>Occupied</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($beds as $bed)
            <tr>
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
                <td>
                    @if (!$bed->is_occupied)
                    <!-- Assign Bed Form -->
                    <form action="{{ route('admin.bed.assigned', $bed->id) }}" method="POST">
                        @csrf
                        <input type="text" name="user_id" placeholder="User ID" class="form-control mb-2" required>
                        <button type="submit" class="btn btn-primary btn-sm">Assign Bed</button>
                    </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection