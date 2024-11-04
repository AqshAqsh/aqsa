@extends('layouts.app')
@section('content')
<!DOCTYPE html>
<html>
    <head>
        
        <link rel="stylesheet"href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    </head>
    <style>
        .custom-bg{
            background-color: var(--teal);
            border: 1px solid var(--teal);
            
        }
        

    </style>

    <title>Reside Me _ rooms</title>
    <body class="bg-light">
        <div class="my-5 px-4">
            <h2 class="fw-bold h-font text-center">OUR ROOMS</h2>
            <div class="h-line bg-dark">
            </div>
            
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-12 mb-lg-0 mb-4 px-lg-0">
                    <nav class="navbar navbar-expand-lg navbar-light bg-white rounded shadow">
                        <div class="container-fluid flex-lg-column align-items-stretch">
                            <h4 class="mt-2">FILTER</h4><hr><br>
                            <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#filterdropdown" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse flex-column mt-2 align-items-stretch" id="filterdropdown">
                                <div class="border bg-light p-3 rounded mb-3">
                                    <h5 class="mb-3" style="font-size: 18px;">CHECK AVAILABILITY</h5>
                                    <label class="form-label ">Check-in</label>
                                    <input type="date" class="form-control shadow-none mb-3">
                                    <label class="form-label ">Check-out</label>
                                    <input type="date" class="form-control shadow-none">
                                </div>
                                <div class="border bg-light p-3 rounded mb-3">
                                    <h5 class="mb-3" style="font-size: 18px;">FACILITIES</h5>
                                    <div class="mb-2">
                                        <input type="checkbox" id="f1" class="form-check-input shadow-none me-1">
                                        <label class="form-check-label " for="f1">FACILITY one</label>
                                    </div>
                                    <div class="mb-2">
                                        <input type="checkbox" id="f2" class="form-check-input shadow-none me-1">
                                        <label class="form-check-label " for="f2">FACILITY two</label>
                                    </div>
                                    <div class="mb-2">
                                        <input type="checkbox" id="f3" class="form-check-input shadow-none me-1">
                                        <label class="form-check-label " for="f3">FACILITY three</label>
                                    </div>
                                    <div class="mb-2">
                                        <input type="checkbox" id="f4" class="form-check-input shadow-none me-1">
                                        <label class="form-check-label " for="f4">FACILITY four</label>
                                    </div>
                                    <div class="mb-2">
                                        <input type="checkbox" id="f4" class="form-check-input shadow-none me-1">
                                        <label class="form-check-label " for="f4">FACILITY five</label>
                                    </div>
                                </div>
                                <div class="border bg-light p-3 rounded mb-3">
                                    <h5 class="mb-3" style="font-size: 18px;">GUESTS</h5>
                                    <div class="d-flex">
                                        <div class="me-3">
                                            <label class="form-label ">Members</label>
                                            <input type="number" class="form-control shadow-none">

                                        </div>
                                       
    
                                    </div>
                               </div>
                            
                            </div>
                        </div>
                    </nav>
                </div>

                <div class="col-lg-9 col-md-12 px-4">
                    <div class="card mb-4 border-0 shadow" >
                        <div class="row g-0 p-3 align-items-center">
                            <div class="col-md-5 mb-lg-0 mb-md-0 mb-3">
                                <img src="images/3.png" class="img-fluid rounded-start" alt="...">
                            </div>
                            <div class="col-md-5  px-lg-3 px-md-3 px-0">
                                <h5 class="mb-3">Simple Room Name</h5>
                                <div class="features mb-3">
                                    <h6 class="mb-1">
                                         Features
                                    </h6>
                                        <span class="badge rounded-pill bg-light text-dark text-wrap">
                                            2 Rooms  
                                        </span>
                                        <span class="badge rounded-pill bg-light text-dark text-wrap">
                                            2 BedRooms  
                                        </span>
                                        <span class="badge rounded-pill bg-light text-dark text-wrap">
                                            3 Sofas  
                                        </span>
                                        <span class="badge rounded-pill bg-light text-dark text-wrap">
                                            1 BathRoom  
                                        </span>
                                </div>
                                <div class="facilities mb-3">
                                    <h6 class="mb-1">
                                        Facilities
                                    </h6>
                                    <span class="badge rounded-pill bg-light text-dark text-wrap">
                                            wifi  
                                        </span>
                                        <span class="badge rounded-pill bg-light text-dark text-wrap">
                                            television  
                                        </span>
                                        <span class="badge rounded-pill bg-light text-dark text-wrap">
                                            AC  
                                        </span>
                                        <span class="badge rounded-pill bg-light text-dark text-wrap">
                                            Room Heater 
                                        </span>
                                </div>
                                <div class="Guests">
                                    <h6 class="mb-1">Guests

                                    </h6>
                                    <span class="badge rounded-pill bg-light text-dark text-wrap">
                                        5 Members 
                                    </span>
                                    
                                </div>
                            </div>
                            <div class="col-md-2 mt-lg-0 mt-md-0 mt-4 text-center">
                                <h5 class="mb-4"> $20 Per Day </h5>
                                <a href="{{url('/room-1')}}" class="btn btn-sm text-white bg-warning shadow-none w-100 mb-2">Book Now</a>
                                <a href="{{url('/room-1')}}" class="btn btn-sm btn-outline-dark shadow-none w-100">More Details</a>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-4 border-0 shadow" >
                        <div class="row g-0 p-3 align-items-center">
                            <div class="col-md-5 mb-lg-0 mb-md-0 mb-3">
                                <img src="images/4.png" class="img-fluid rounded-start" alt="...">
                            </div>
                            <div class="col-md-5  px-lg-3 px-md-3 px-0">
                                <h5 class="mb-3">Simple Room Name</h5>
                                <div class="features mb-3">
                                    <h6 class="mb-1">
                                         Features
                                    </h6>
                                        <span class="badge rounded-pill bg-light text-dark text-wrap">
                                            2 Rooms  
                                        </span>
                                        <span class="badge rounded-pill bg-light text-dark text-wrap">
                                            2 BedRooms  
                                        </span>
                                        <span class="badge rounded-pill bg-light text-dark text-wrap">
                                            3 Sofas  
                                        </span>
                                        <span class="badge rounded-pill bg-light text-dark text-wrap">
                                            1 BathRoom  
                                        </span>
                                </div>
                                <div class="facilities mb-3">
                                    <h6 class="mb-1">
                                        Facilities
                                    </h6>
                                    <span class="badge rounded-pill bg-light text-dark text-wrap">
                                            wifi  
                                        </span>
                                        <span class="badge rounded-pill bg-light text-dark text-wrap">
                                            television  
                                        </span>
                                        <span class="badge rounded-pill bg-light text-dark text-wrap">
                                            AC  
                                        </span>
                                        <span class="badge rounded-pill bg-light text-dark text-wrap">
                                            Room Heater 
                                        </span>
                                </div>
                                <div class="Guests">
                                    <h6 class="mb-1">Guests

                                    </h6>
                                    <span class="badge rounded-pill bg-light text-dark text-wrap">
                                        5 Members 
                                    </span>
                                    
                                </div>
                            </div>
                            <div class="col-md-2 mt-lg-0 mt-md-0 mt-4 text-center">
                                <h5 class="mb-4"> $20 Per Day </h5>
                                <a href="{{url('/room-1')}}" class="btn btn-sm text-white bg-warning shadow-none w-100 mb-2">Book Now</a>
                                <a href="{{url('/room-1')}}" class="btn btn-sm btn-outline-dark shadow-none w-100">More Details</a>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-4 border-0 shadow" >
                        <div class="row g-0 p-3 align-items-center">
                            <div class="col-md-5 mb-lg-0 mb-md-0 mb-3">
                                <img src="images/2.png" class="img-fluid rounded-start" alt="...">
                            </div>
                            <div class="col-md-5 px-lg-3 px-md-3 px-0">
                                <h5 class="mb-3">Simple Room Name</h5>
                                <div class="features mb-3">
                                    <h6 class="mb-1">
                                         Features
                                    </h6>
                                        <span class="badge rounded-pill bg-light text-dark text-wrap">
                                            2 Rooms  
                                        </span>
                                        <span class="badge rounded-pill bg-light text-dark text-wrap">
                                            2 BedRooms  
                                        </span>
                                        <span class="badge rounded-pill bg-light text-dark text-wrap">
                                            3 Sofas  
                                        </span>
                                        <span class="badge rounded-pill bg-light text-dark text-wrap">
                                            1 BathRoom  
                                        </span>
                                </div>
                                <div class="facilities mb-3">
                                    <h6 class="mb-1">
                                        Facilities
                                    </h6>
                                    <span class="badge rounded-pill bg-light text-dark text-wrap">
                                            wifi  
                                        </span>
                                        <span class="badge rounded-pill bg-light text-dark text-wrap">
                                            television  
                                        </span>
                                        <span class="badge rounded-pill bg-light text-dark text-wrap">
                                            AC  
                                        </span>
                                        <span class="badge rounded-pill bg-light text-dark text-wrap">
                                            Room Heater 
                                        </span>
                                </div>
                                <div class="Guests">
                                    <h6 class="mb-1">Guests

                                    </h6>
                                    <span class="badge rounded-pill bg-light text-dark text-wrap">
                                        5 Members 
                                    </span>
                                    
                                </div>
                            </div>
                            <div class="col-md-2 mt-lg-0 mt-md-0 mt-4 text-center">
                                <h5 class="mb-4"> $20 Per Day </h5>
                                <a href="{{url('/room-1')}}" class="btn btn-sm text-white bg-warning shadow-none w-100 mb-2">Book Now</a>
                                <a href="{{url('/room-1')}}" class="btn btn-sm btn-outline-dark shadow-none w-100">More Details</a>
                            </div>
                        </div>
                    </div>
                    
                </div>

            </div>
        </div>


        @include('layouts.footer') 
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    </body>
</html>
@endsection