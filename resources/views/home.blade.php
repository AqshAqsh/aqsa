@extends('layouts.app')
@section('title', 'Reside Me _ Home')
@section('content')
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
    </style>
    @include('layouts.links')

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

</head>


<body class="bg-light">
    <div class="container-fluid px-lg-4 mt-4">
        <div class="swiper Swiper-container">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <img src="{{ asset('images/a.png') }}" class="w-100 d-block" />
                </div>
                <div class="swiper-slide">
                    <img src="{{ asset('images/b.png') }}" class="w-100 d-block" />
                </div>
                <div class="swiper-slide">
                    <img src="{{ asset('images/c.png') }}" class="w-100 d-block" />
                </div>
                <div class="swiper-slide">
                    <img src="{{ asset('images/d.png') }}" class="w-100 d-block" />
                </div>
                <div class="swiper-slide">
                    <img src="{{ asset('images/e.png') }}" class="w-100 d-block" />
                </div>
                <div class="swiper-slide">
                    <img src="{{ asset('images/f.png') }}" class="w-100 d-block" />
                </div>
            </div>
        </div>
    </div>
    <!-- chech avail-->
    <div class="container availability-form">
        <div class="row">
            <div class="col-lg-12 bg-white shadow p-4 rounded">
                <h5 class="mb-4">Check Booking Availability</h5>
                <form>
                    <div class="row align-items-end">
                        <div class="col-lg-3 mb-3">
                            <label class="form-label " style="font-weight: 500;">Check-in</label>
                            <input type="date" class="form-control shadow-none">
                        </div>
                        <div class="col-lg-3 mb-3">
                            <label class="form-label " style="font-weight: 500;">Check-out</label>
                            <input type="date" class="form-control shadow-none">
                        </div>
                        <div class="col-lg-4 mb-3">
                            <label class="form-label " style="font-weight: 500;">Members</label>
                            <select class="form-select shadow-none">
                                <option selected>Open this select menu</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>

                        <div class="col-lg-2 mb-lg-3 mt-2">
                            <button type="submit" class="btn text-white shadow-none btn-warning">submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- our rooms-->
    <h2 class="mt-5 pt-4 mb-4 text-center fw-bold">Our Rooms
    </h2>
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6 my-3">
                <div class="card border-0 shadow" style="max-width: 350px; margin: auto;">
                    <img src="{{ asset('images/a.png') }}" class="card-img-top">

                    <div class="card-body">
                        <h5> simple room</h5>
                        <h5 class="mb-4"> $20</h5>
                        <div class="features mb-4">
                            <h6 class="mb-1"> Features</h6>
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
                                1 BatrRoom
                            </span>
                        </div>
                        <div class="facilities mb-4">
                            <h6 class="mb-1">Facilities</h6>
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
                        <div class="rating mb-4">
                            <h6 class="mb-1">Rating</h6>
                            <span>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                            </span>
                        </div>
                        <div class="d-flex justify-content-evenly mb-2">
                            <a href="#" class="btn btn-sm text-white custom-bg shadow-none">Send Request</a>
                            <a href="#" class="btn btn-sm btn-outline-dark custom-bg shadow-none">Send Request</a>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 my-3">
                <div class="card border-0 shadow" style="max-width: 350px; margin: auto;">
                    <img src="{{ asset('images/a.png') }}" class="card-img-top">

                    <div class="card-body">
                        <h5> simple room</h5>
                        <h5 class="mb-4"> $20</h5>
                        <div class="features mb-4">
                            <h6 class="mb-1"> Features</h6>
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
                        <div class="facilities mb-4">
                            <h6 class="mb-1">Facilities</h6>
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
                        <div class="rating mb-4">
                            <h6 class="mb-1">Rating</h6>
                            <span>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                            </span>
                        </div>
                        <div class="d-flex justify-content-evenly mb-2">
                            <a href="#" class="btn btn-sm text-white custom-bg shadow-none">Send Request</a>
                            <a href="#" class="btn btn-sm btn-outline-dark custom-bg shadow-none">Send Request</a>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 my-3">
                <div class="card border-0 shadow" style="max-width: 350px; margin: auto;">
                    <img src="{{ asset('images/a.png') }}"class="card-img-top">

                    <div class="card-body">
                        <h5> simple room</h5>
                        <h5 class="mb-4"> $20</h5>
                        <div class="features mb-4">
                            <h6 class="mb-1"> Features</h6>
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
                                1 BatrRoom
                            </span>
                        </div>
                        <div class="facilities mb-4">
                            <h6 class="mb-1">Facilities</h6>
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
                        <div class="rating mb-4">
                            <h6 class="mb-1">Rating</h6>
                            <span>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                            </span>
                        </div>
                        <div class="d-flex justify-content-evenly mb-2">
                            <a href="#" class="btn btn-sm text-white custom-bg shadow-none">Send Request</a>
                            <a href="#" class="btn btn-sm btn-outline-dark custom-bg shadow-none">Send Request</a>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-lg-12 text-center mt-5">
                <a href="#" class="btn btn-sm btn-outline-dark fw-bold shadow-none rounded-0 ">MORE ROOMS>>></a>
            </div>
        </div>
    </div>
    <!-- our Facilities-->
    <h2 class="mt-5 pt-4 mb-4 text-center fw-bold">Our Facilities
    </h2>

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
                <a href="#" class="btn btn-sm btn-outline-dark fw-bold shadow-none rounded-0 ">MORE Facilities>>></a>
            </div>

        </div>
    </div>
    <h2 class="mt-5 pt-4 mb-4 text-center fw-bold">TESTIMONIALS
    </h2>

    <div class="container mt-5">
        <div class="swiper swiper-testimonial ">
            <div class="swiper-wrapper mb-5">


                <div class="swiper-slide bg-white p-4">
                    <div class="profile d-flex align-items-center mb-3">
                        <img src="{{ asset('images/wifi.svg') }}" width="30px">
                        <h6 class="m-0 ms-0">Random userl</h6>
                    </div>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ratione, odit voluptate dolor, atque amet non totam officiis repellat facere ea corrupti inventore sit, esse nulla porro quam voluptates ullam necessitatibus?</p>
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
                        <img src="{{ asset('images/wifi.svg') }}" width="30px">
                        <h6 class="m-0 ms-0">Random userl</h6>
                    </div>
                    <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quisquam veritatis at voluptate eveniet, fugit doloribus nesciunt placeat neque, molestiae, quae dolores enim veniam! Incidunt repellat tempora beatae, error voluptatum unde.</p>
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
                        <img src="{{ asset('images/wifi.svg') }}" width="30px">
                        <h6 class="m-0 ms-0">Random userl</h6>
                    </div>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Impedit nihil id sunt accusantium possimus, blanditiis voluptatibus excepturi incidunt eum? Repellat enim qui iste dicta architecto, quo cupiditate cum! Sequi, voluptatibus.</p>
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
            <a href="#" class="btn btn-sm btn-outline-dark fw-bold shadow-none rounded-0  ">KNOW MORE>>></a>
        </div>

    </div>

    <!-- reach us -->
    <h2 class="mt-5 pt-4 mb-4 text-center fw-bold">REACH US
    </h2>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-8 bg-white rounded mb-lg-0 p-4 ">
                <iframe class="w-100 rounded" height="320px" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3377.5295951066378!2d74.19896347543325!3d32.16299082392641!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x391f2a1b7a50fc9b%3A0x202625f2cca04e32!2sGovernment%20College%2C%20Gujranwala!5e0!3m2!1sen!2s!4v1720677886636!5m2!1sen!2s" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
            <div class="col-lg-4 col-md-4">
                <div class="bg-white p-4 rounded mb-4 ">
                    <h5>CALL US</h5>
                    <i class="bi bi-telephone-fill"></i>
                    <a href="tel: +923127557097" class="d-inline-block mb-2 text-decoration-none text-dark">+923127557097</a>

                    <br>
                    <i class="bi bi-telephone-fill"></i>
                    <a href="tel: +923127557097" class="d-inline-block text-decoration-none text-dark">+923127557097</a>

                </div>
                <div class="bg-white p-4 rounded mb-4 ">
                    <h5>Follow US</h5>
                    <a href="#" class="d-inline-block mb-3">
                        <i class="bi bi-twitter"></i><span class="badge bg-light text-dark fs-6 p-2">Twitter</span>
                    </a>
                    <br>
                    <a href="#" class="d-inline-block mb-3">
                        <i class="bi bi-facebook"></i><span class="badge bg-light text-dark fs-6 p-2">Facebook</span>
                    </a>
                    <br>
                    <a href="#" class="d-inline-block mb-3">
                        <i class="bi bi-instagram"></i><span class="badge bg-light text-dark fs-6 p-2">Instagram</span>
                    </a>

                    <br>


                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <!-- Initialize Swiper -->
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
</body>

</html>

@endsection