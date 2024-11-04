@extends('layouts.app')
<!DOCTYPE html>
<html>
    <head>
        
        @include('layouts.links') 
        <link rel="stylesheet"href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    </head>
    <style>
        .custom-bg{
            background-color: var(--teal);
            border: 1px solid var(--teal);
            
        }
        span{
            font-size: large;
        }
        

    </style>

    <title>Reside Me _ rooms</title>
    <body class="bg-light">
       
        <div class="my-5 px-4">
            <h2 class="fw-bold h-font text-center">ROOMS Detail</h2>
            <div class="h-line bg-dark">
            </div>
            
        </div>
        <div class="col-lg-12 col-md-12 px-5 ">
            <div class="card mb-4 border-0 shadow align-items-center" >
                <div class="row g-0 p-3 align-items-center">
                    <div class="col-md-12 mb-lg-0 mb-md-0 mb-3 px-4">
                        <img src="images/3.png" class="img-fluid rounded-start w-100 h-100" alt="...">
                    </div>

                    <div class="col-lg-12 col-md-12 px-5 ">
                        <div class="card mb-4 border-0 shadow align-items-center" >
                            <div class="row g-0 p-3 align-items-center">
                                <div class="col-md-12  px-lg-3 px-md-3 px-4">
                                    <h3 class="mb-3">Simple Room Name</h3>
                                </div>
                            </div>

                            <div class="row g-0 p-3 align-items-center">
                                <div class="col-md-4  px-lg-3 px-md-3 px-4">
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
                                </div>
                                   
                                <div class="col-md-4 px-lg-3 px-md-3 px-4">
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
                                </div>

                                <div class="col-md-4  px-lg-3 px-md-3 px-4">
                                    <div class="Guests">
                                        <h6 class="mb-1">Guests

                                        </h6>
                                    </div>
                                    <span class="badge rounded-pill bg-light text-dark text-wrap">
                                        5 Members 
                                    </span>                     
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row g-0 p-3 align-items-center">

                        <div class="col-md-12 mt-lg-0 mt-md-0 mt-4 text-center">
                            <h5 class="mb-4"> $20 Per Day </h5>
                            <a href="{{url('/room-1')}}" class="btn btn-sm text-white bg-warning shadow-none w-100 mb-2">Book Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
