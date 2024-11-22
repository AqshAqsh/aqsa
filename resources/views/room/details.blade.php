@extends('layouts.app')

@section('content')

<head>
    @include('layouts.links')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <title>ResideMe - Room Details</title>
</head>

<style>
    .custom-bg {
        background-color: var(--teal);
        border: 1px solid var(--teal);
    }

    span {
        font-size: large;
    }
</style>

<div class="my-5 px-4">
    <h2 class="fw-bold h-font text-center">ROOM Details</h2>
    <div class="h-line bg-dark"></div>
</div>

<div class="col-lg-12 col-md-12 px-5">
    <div class="card mb-4 border-0 shadow align-items-center">
        <div class="row g-0 p-3 align-items-center">

            <!-- Room Image -->
            <div class="col-md-12 mb-3 px-4">
                <img src="{{ asset('images/3.png') }}" class="img-fluid rounded-start w-100 h-100" alt="Room Image">
            </div>

            <!-- Room Category and Details -->
            <div class="col-lg-12 col-md-12 px-5">
                <h3 class="mb-3">{{ $room->category->name ?? 'No Category' }}</h3>
            </div>

            <div class="facilities mb-3">
                <h6 class="mb-1">Facilities</h6>
                @if($room->facilities && $room->facilities->isNotEmpty())
                @foreach ($room->facilities as $facility)
                <span>{{ $facility->name }}</span>
                @endforeach
                @else
                <p>No facilities available</p>
                @endif
            </div>

            <div class="col-md-6 px-4">
                <h6 class="mb-1">Guests</h6>
                <span class="badge rounded-pill bg-light text-dark text-wrap">
                    {{ $room->number_of_members }} Members
                </span>
                <span class="badge rounded-pill bg-light text-dark text-wrap">
                    {{ $room->beds_count }} Beds
                </span>
            </div>
            <div class="description">
                <h6 class="mt-1">Description</h6>
                <span class="badge rounded-pill bg-light text-dark text-wrap">
                    {{ $room->description }}
                </span>

            </div>

            <!-- Room Charge and Booking -->
            <div class="col-md-12 text-center mt-4">
                <h5 class="mb-4">${{ $room->room_charge }} Per Day</h5>
                <a href="" class="btn btn-sm text-white bg-warning shadow-none w-100 mb-2">Book Now</a>
                <a href="{{ route('room.details', ['id' => $room->id]) }}" class="btn btn-sm btn-outline-dark shadow-none w-100">More Details</a>
            </div>
        </div>
    </div>
</div>

@endsection