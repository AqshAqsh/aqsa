@extends('layouts.app')
@section('content')

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
</head>
<style>
    .custom-bg {
        background-color: var(--teal);
        border: 1px solid var(--teal);
    }
</style>
<title>Reside Me - Rooms</title>

<div class="bg-light">
    <div class="my-5 px-4">
        <h2 class="fw-bold h-font text-center">OUR ROOMS</h2>
        <div class="h-line bg-dark"></div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-12 mb-lg-0 mb-4 px-lg-0">
                <nav class="navbar navbar-expand-lg navbar-light bg-white rounded shadow">
                    <div class="container-fluid flex-lg-column align-items-stretch">
                        <h4 class="mt-2">FILTER</h4>
                        <hr><br>
                        <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#filterdropdown" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse flex-column mt-2 align-items-stretch" id="filterdropdown">
                            <div class="border bg-light p-3 rounded mb-3">
                                <h5 class="mb-3" style="font-size: 18px;">CHECK AVAILABILITY</h5>
                                <h5 class="mb-3" style="font-size: 18px;">FACILITIES</h5>
                                @foreach (['one', 'two', 'three', 'four', 'five'] as $facility)
                                <div class="mb-2">
                                    <input type="checkbox" id="f{{ $facility }}" class="form-check-input shadow-none me-1">
                                    <label class="form-check-label" for="f{{ $facility }}">FACILITY {{ $facility }}</label>
                                </div>
                                @endforeach
                                <div class="d-flex">
                                    <div class="me-3">
                                        <label class="form-label">Members</label>
                                        <input type="number" class="form-control shadow-none">
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <div class="me-3">
                                        <label class="form-label">Building Storey</label>
                                        <input type="number" class="form-control shadow-none">
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <div class="me-3">
                                        <label class="form-label">Room No</label>
                                        <input type="number" class="form-control shadow-none">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>

            <div class="col-lg-9 col-md-12 px-4">
                @foreach ($rooms as $room)
                <div class="card mb-5 border-0 shadow">
                    <div class="row g-0 p-3 align-items-center">
                        <div class="col-md-5 mb-lg-0 mb-md-0 mb-3">
                            <img src="{{ asset('images/3.png') }}" class="img-fluid rounded-start" alt="Room Image">
                        </div>
                        <div class="col-md-5 px-lg-3 px-md-3 px-0">
                            <h5 class="mb-3">{{ $room->room_no }} - {{ $room->category->name }}</h5>
                            <!-- Facilities Section -->
                            <div class="facilities mb-3">
                                <h6 class="mb-1">Facilities</h6>
                                @if($room->facilities && $room->facilities->isNotEmpty())
                                @foreach ($room->facilities as $facility)
                                <span class="badge rounded-pill bg-light text-dark text-wrap">{{ $facility->name }}</span>
                                @endforeach
                                @else
                                <p>No facilities available</p>
                                @endif
                            </div>

                            <div class="Guests">
                                <div class="row mb-2">
                                    <div class="col-lg-6">
                                        <h6 class="mt-2">Guests</h6>
                                        <span class="badge rounded-pill bg-light text-dark text-wrap">
                                            {{ $room->number_of_members }} Members
                                        </span>
                                    </div>
                                    <div class="col-lg-6">
                                        <h6 class="mt-2">Beds</h6>
                                        <span class="badge rounded-pill bg-light text-dark text-wrap">
                                            {{ $room->beds_count }} Beds
                                        </span>
                                    </div>


                                </div>
                            </div>
                            <div class="description">
                                <h6 class="mt-1">Description</h6>
                                <span class="badge rounded-pill bg-light text-dark text-wrap">
                                    {{ $room->description }}
                                </span>

                            </div>

                        </div>
                        <div class="col-md-2 mt-lg-0 mt-md-0 mt-4 text-center">
                            <h5 class="mb-4">RS.{{ $room->room_charge }}  Per Day</h5>
                            <a href="{{ route('room.booking', $room->id) }}" class="btn btn-sm text-white bg-warning shadow-none w-100 mb-2">Book Now</a>
                            <a href="{{ route('room.details', $room->id) }}" class="btn btn-sm btn-outline-dark shadow-none w-100">More Details</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
</div>
@endsection