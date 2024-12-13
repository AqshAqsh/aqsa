<!DOCTYPE html>
<html>

<head>
    <style>
        .availability-form {
            margin-top: -50px;
            z-index: 2;
            position: relative;
        }

        @media screen and (max-width: 575px) {
            .availability-form {
                margin-top: 25px;
                padding: 0 35px;
            }
        }

        .facility-checkbox {
            width: 48%;
            margin-bottom: 10px;
        }
    </style>
    @include('layouts.links')
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="shortcut icon" href="{{ asset('images/logo.jpg') }}" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">


</head>


<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-light bg-white px-lg-3 py-lg-2 shadow-sm sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand me-5 fw-bold fs-3 h-font" href="{{ url('/') }}">
                <img src="{{ asset('images/logo.jpg') }}" alt="Logo" style="height: 50px; width:55px"><b>ResideMe</b>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }} me-2" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('room') ? 'active' : '' }} me-2" href="{{ route('room') }}">Rooms</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('facilities') ? 'active' : '' }} me-2" href="{{ route('facilities') }}">Facilities</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }} me-2" href="{{ route('contact') }}">Contact us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }} me-2" href="{{ route('about') }}">About</a>
                    </li>

                </ul>

                <ul class="navbar-nav navbar-nav-right">
                    <li class="nav-item">
                        <a href="{{ route('auth.login') }}" class="btn btn-outline-dark shadow-none me-3 me-lg-2">Login</a>
                    </li>

                </ul>
            </div>
        </div>
    </nav>
    <div class="container-fluid pl-lg-3 ">
        <div class="swiper Swiper-container">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <img src="{{ asset('images/welcomebanner.jpg') }}" class="w-100 d-block" />
                </div>
                <div class="swiper-slide">
                    <img src="{{ asset('images/building.jpg') }}" class="w-100 d-block" />
                </div>
                <div class="swiper-slide">
                    <img src="{{ asset('images/outside.jpg') }}" class="w-100 d-block" />
                </div>
                <div class="swiper-slide">
                    <img src="{{ asset('images/dininghall.jpg') }}" class="w-100 d-block" />
                </div>
                <div class="swiper-slide">
                    <img src="{{ asset('images/reception.jpg') }}" class="w-100 d-block" />
                </div>
                <div class="swiper-slide">
                    <img src="{{ asset('images/studyroom.jpg') }}" class="w-100 d-block" />
                </div>
            </div>
        </div>
    </div>
    <div class="container availability-form">
        <div class="row">
            <div class="col-lg-12 bg-white shadow p-4 rounded">
                <h5 class="mb-4">Check Room Availability</h5>

                <!-- Filter Form -->
                @if(!request()->category)
                <!-- Show Form if the category is not selected -->
                <form action="{{ route('check.availability') }}" method="GET">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="category" class="form-label" style="font-weight: 500;">Room Category</label>
                            <select name="category" id="category" class="form-control">
                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label for="room_no">Room Number:</label>
                            <select name="room_no" id="room_no" class="form-control">
                                <option value="">Select Room Number</option>
                                @if(request()->category)
                                @foreach($roomNumbers as $room)
                                <option value="{{ $room->room_no }}" {{ request('room_no') == $room->room_no ? 'selected' : '' }}>
                                    {{ $room->room_no }}
                                </option>
                                @endforeach
                                @endif
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label for="facilities" class="form-label" style="font-weight: 500;">Facilities</label>
                            <select name="facilities[]" id="facilities" class="form-control" multiple>
                                @foreach($facilities as $facility)
                                <option value="{{ $facility->id }}" {{ in_array($facility->id, request('facilities', [])) ? 'selected' : '' }}>
                                    {{ $facility->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Button in the same row -->
                        <div class="col-md-3 d-flex align-items-center" style="font-weight: 800;">
                            <button type="submit" class="btn btn-warning w-100">Check Availability</button>
                        </div>
                    </div>
                </form>

                @else
                <!-- Show Results if the form has been submitted -->
                <div class="mt-4">
                    <h3>Available Rooms</h3>

                    @if(isset($rooms) && $rooms->isEmpty())
                    <p>No rooms available for the selected criteria.</p>
                    @elseif(isset($rooms) && $rooms->isNotEmpty())
                    <div class="row">
                        @foreach($rooms as $room)
                        <div class="col-md-4 mb-3">
                            <div class="card shadow">
                                <div class="card-body">
                                    <h5 class="card-title">Room {{ $room->room_no }}</h5>
                                    <p class="card-text">
                                        <strong>Category:</strong> {{ $room->category->name }} <br>
                                        <strong>Capacity:</strong> {{ $room->number_of_members }} <br>
                                        <strong>Facilities:</strong>
                                        @foreach($room->facilities as $facility)
                                        {{ $facility->name }}@if(!$loop->last), @endif
                                        @endforeach
                                    </p>
                                    <a href="{{ route('room.booking', ['room_no' => $room->room_no]) }}" class="btn btn-primary">Book Now</a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <p>Please select criteria to check room availability.</p>
                    @endif
                </div>
                @endif




            </div>

        </div>
    </div>

    <section id="testimonials-section">
        <div class="testimonials-container mt-5">
            <div class="my-5 px-4">
                <h2 class="fw-bold h-font text-center">See What Makes ResideMe Special</h2>
                <div class="h-line bg-dark"></div>
            </div>
            <div class="swiper-container testimonials-swiper">
                <div class="swiper-wrapper mb-15">
                    <div class="swiper-slide">
                        <div class="testimonial-item">
                            <img src="{{ asset('images/cctv.jpg') }}" width="30px">
                            <h6 class="m-0 ms-0">CCTV </h6>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="testimonial-item">
                            <img src="{{ asset('images/Laundaryroom.jpg') }}" width="30px">
                            <h6 class="m-0 ms-0">Laundary Room</h6>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="testimonial-item">
                            <img src="{{ asset('images/garden.jpg') }}" width="30px">
                            <h6 class="m-0 ms-0">Our Garden</h6>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="testimonial-item">
                            <img src="{{ asset('images/corridor.jpg') }}" width="30px">
                            <h6 class="m-0 ms-0">ResideMe CorriDoor</h6>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="testimonial-item">
                            <img src="{{ asset('images/safety.jpg') }}" width="30px">
                            <h6 class="m-0 ms-0">ResideMe Safety</h6>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="testimonial-item">
                            <img src="{{ asset('images/dininghall.jpg') }}" width="30px">
                            <h6 class="m-0 ms-0">ResideMe Safety</h6>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="testimonial-item">
                            <img src="{{ asset('images/outside.jpg') }}" width="30px">
                            <h6 class="m-0 ms-0">outside</h6>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="testimonial-item">
                            <img src="{{ asset('images/studyroom.jpg') }}" width="30px">
                            <h6 class="m-0 ms-0">Student's StudyRoom</h6>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="testimonial-item">
                            <img src="{{ asset('images/welcomebanner.jpg') }}" width="30px">
                            <h6 class="m-0 ms-0">ResideMe Enterance</h6>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="testimonial-item">
                            <img src="{{ asset('images/reception.jpg') }}" width="30px">
                            <h6 class="m-0 ms-0">ResideMe Reception</h6>
                        </div>
                    </div>
                </div>
                <div class="swiper-pagination"></div>

            </div>

        </div>
    </section>

    <div class="my-5 px-4">
        <h2 class="fw-bold h-font text-center">Our Facilities</h2>
        <div class="h-line bg-dark"></div>
    </div>

    <div class="container">
        <div class="row justify-content-evenly px-lg-0 px-md-0 px-5">
            <div class="col-lg-2 col-md-2 bg-white rounded shadow py-4 my3 text-center">
                <img src="{{ asset('images/wifi.svg') }}" width="80px">
                <h5 class="mt-3"> wifi</h5>
            </div>
            <div class="col-lg-2 col-md-2 bg-white rounded shadow py-4 my3 text-center">
                <img src="{{ asset('images/ac.svg') }}" width="80px">
                <h5 class="mt-3"> AC</h5>
            </div>
            <div class="col-lg-2 col-md-2 bg-white rounded shadow py-4 my3 text-center">
                <img src="{{ asset('images/heater.svg') }}" width="80px">
                <h5 class="mt-3"> Heater</h5>
            </div>
            <div class="col-lg-2 col-md-2 bg-white rounded shadow py-4 my3 text-center">
                <img src="{{ asset('images/television.svg') }}" width="80px">
                <h5 class="mt-3"> Television</h5>
            </div>
            <div class="col-lg-2 col-md-2 bg-white rounded shadow py-4 my3 text-center">
                <img src="{{ asset('images/cooler.svg') }}" width="80px">
                <h5 class="mt-3"> Cooler</h5>
            </div>
            <div class="col-lg-12 text-center mt-5">
                <a href="{{ route('facilities') }}" class="btn btn-sm btn-outline-dark fw-bold shadow-none rounded-0 ">MORE Facilities>>></a>
            </div>

        </div>
    </div>
    <div class="my-5 px-4">
        <h2 class="fw-bold h-font text-center">What Our Users Say</h2>
        <div class="h-line bg-dark"></div>
    </div>

    <div class="container mt-5">
        <div class="swiper swiper-testimonial ">
            <div class="swiper-wrapper mb-5">
                <div class="swiper-slide bg-white p-4">
                    <div class="profile d-flex align-items-right mb-3">

                        <div class="nav-profile-img1">
                            <img src="{{ asset('images/face5.jpg') }}" alt="image">
                        </div>
                        <div class="nav-profile-text1">
                            <p class="mb-1 text-black"> Aqsa Rahman, Resident </p>
                        </div>

                    </div>
                    <p>ResideMe has made my booking process seamless and stress-free.
                        I no longer need to worry about finding the perfect room!</p>
                    <div class="rating">
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                    </div>
                </div>
                <div class="swiper-slide bg-white p-4">
                    <div class="profile d-flex align-items-center mb-3">

                        <div class="nav-profile-img1">
                            <img src="{{ asset('images/face4.jpg') }}" alt="image">
                        </div>
                        <div class="nav-profile-text1">
                            <p class="mb-1 text-black"> Ali Khan, Hostel Manager</p>
                        </div>

                    </div>

                    <p>As a hostel manager, ResideMe has simplified the way I handle bookings,
                        facilities, and communication with residents. It's an invaluable tool!</p>
                    <div class="rating">
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                    </div>
                </div>
                <div class="swiper-slide bg-white p-4">
                    <div class="profile d-flex align-items-center mb-3">

                        <div class="nav-profile-img1">
                            <img src="{{ asset('images/face6.jpg') }}" alt="image">
                        </div>
                        <div class="nav-profile-text1">
                            <p class="mb-1 text-black"> Sarah Lee, Resident</p>
                        </div>

                    </div>
                    <p>The best part of ResideMe is the user-friendly interface.
                        It’s easy to navigate, even for those who aren’t tech-savvy!</p>
                    <div class="rating">
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                    </div>
                </div>
            </div>
            <div class="swiper-pagination"></div>
        </div>
        <div class="col-lg-12 text-center mt-5">
            <a href="{{route('about')}}" class="btn btn-sm btn-outline-dark fw-bold shadow-none rounded-0  ">KNOW MORE>>></a>
        </div>
    </div>
    <div class="my-5 px-4">
        <h2 class="fw-bold h-font text-center">Reach Us</h2>
        <div class="h-line bg-dark"></div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-8 bg-white rounded mb-lg-0 p-4 ">
                <iframe class="w-100 rounded" height="320px" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3377.5295951066378!2d74.19896347543325!3d32.16299082392641!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x391f2a1b7a50fc9b%3A0x202625f2cca04e32!2sGovernment%20College%2C%20Gujranwala!5e0!3m2!1sen!2s!4v1720677886636!5m2!1sen!2s" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
            <div class="col-lg-4 col-md-4">
                <div class="bg-white p-4 rounded mb-4 ">
                    <h5>CALL US</h5>
                    <i class="bi bi-telephone-fill"></i>
                    <a href="tel: +923127557097" class="d-inline-block mb-2 text-decoration-none text-dark">+9230012345678</a>

                    <br>
                    <i class="bi bi-telephone-fill"></i>
                    <a href="tel: +923127557097" class="d-inline-block text-decoration-none text-dark">+923000050090</a>

                </div>
                <div class="bg-white p-4 rounded mb-4 ">
                    <h5>Follow US</h5>
                    <a href="https://www.facebook.com/" class="d-inline-block mb-3">
                        <i class="bi bi-facebook"></i><span class="badge bg-light text-dark fs-6 p-2">Facebook</span>
                    </a>
                    <br>
                    <a href="https://www.linkedin.com/" class="d-inline-block mb-3">
                        <i class="bi bi-linkedin"></i><span class="badge bg-light text-dark fs-6 p-2">LinkedIn</span>
                    </a>
                    <br>
                    <a href="https://www.instagram.com/" class="d-inline-block mb-3">
                        <i class="bi bi-instagram"></i><span class="badge bg-light text-dark fs-6 p-2">Instagram</span>
                    </a>

                    <br>


                </div>
            </div>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        // This script dynamically updates room numbers based on the selected category
        document.getElementById('category').addEventListener('change', function() {
            const categoryId = this.value;
            const roomNoSelect = document.getElementById('room_no');

            // Clear existing room options
            roomNoSelect.innerHTML = '<option value="">Select Room Number</option>';

            if (categoryId) {
                // Fetch room numbers related to the selected category via AJAX
                fetch(`/api/rooms/${categoryId}`)
                    .then(response => response.json())
                    .then(data => {
                        data.rooms.forEach(room => {
                            const option = document.createElement('option');
                            option.value = room.room_no;
                            option.textContent = room.room_no;
                            roomNoSelect.appendChild(option);
                        });
                    })
                    .catch(error => {
                        console.error('Error fetching room numbers:', error);
                    });
            }
        });
    </script>


    <script>
        var swiper = new Swiper(".Swiper-container", {
            spaceBetween: 30,
            effect: "fade",
            loop: true,
            autoplay: {
                delay: 3500,
                disableOnInteraction: false,
            }

        });
        // Initialize the Swiper for the Testimonials Section
        document.addEventListener('DOMContentLoaded', function() {
            const testimonialSwiper = new Swiper('.testimonials-swiper', {
                effect: "coverflow",
                loop: true,
                grabCursor: true,
                slidesPerView: 1,
                spaceBetween: 30,
                coverflowEffect: {
                    rotate: 25,
                    stretch: 0,
                    depth: 100,
                    modifier: 1,
                    slideShadows: false,
                },
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                autoplay: {
                    delay: 2000,
                    disableOnInteraction: false,
                },
                breakpoints: {
                    320: {
                        slidesPerView: 1,
                    },
                    640: {
                        slidesPerView: 1,
                    },
                    768: {
                        slidesPerView: 2,
                    },
                    1024: {
                        slidesPerView: 3,
                    },
                },
            });
        });


        var swiper = new Swiper(".swiper-testimonial", {
            effect: "coverflow",
            grabCursor: true,
            centeredSlides: true,
            slidesPerView: "auto",
            slidesPerView: "3",
            coverflowEffect: {
                rotate: 50,
                stretch: 0,
                depth: 100,
                modifier: 1,
                slideShadows: false,
            },
            pagination: {
                el: ".swiper-pagination",
            },
            breakpoints: {
                320: {
                    slidesPerView: 1,
                },
                640: {
                    slidesPerView: 1,
                },
                768: {
                    slidesPerView: 2,
                },
                1024: {
                    slidesPerView: 3,
                }
            }
        });
    </script>
    @extends('layouts.footer')

</body>

</html>