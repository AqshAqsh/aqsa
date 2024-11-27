@extends('layouts.app')
@section('content')
<!DOCTYPE html>
<html>

<head>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

</head>
<style>
    .box {
        border-top-color: var(--teal) !important;
    }
</style>


<title>ResideMe _ About</title>

<body class="bg-light">
    <div class="my-5 px-4">
        <h2 class="fw-bold h-font text-center">ABOUT US</h2>
        <div class="h-line bg-dark">
        </div>
        <p class="text-center mt-3">Our mission is to provide a reliable and user-friendly platform that connects residents with the best living spaces,<br>
         while making hostel management efficient for administrators. We strive to enhance the hostel living experience <br>by offering a platform that focuses on convenience, communication, and community.

</p>
    </div>
    <div class="container">
        <div class="row justify-content-between align-items-center">
            <div class="col-lg-6 col-lg-5 mb-4 order-lg-1 order-md-1 order-2">
                <h3 class="mb-3">Meet Our Team</h3>
                <p>At ResideMe, we are a close-knit team of three dynamic professionals,
                     each bringing a wealth of expertise and a shared passion for creating seamless 
                     hostel management experiences. With a commitment to innovation, excellence, 
                     and user-centric design, our team works tirelessly to build a platform that
                      is not only efficient but also intuitive and reliable. Every member contributes
                       unique skills and insights, driving our mission to revolutionize
                        the way hostels are managed and experienced. Together, we are dedicated 
                        to making hostel living simpler, more connected, and more enjoyable for
                         both residents and administrators alike.

</p>
            </div>
            <div class="col-lg-5 col-md-5 mb-4 order-lg-2 order-md-2 order-1">
                <img src="{{asset('images/about.jpg')}}" alt="" class="w-100">
            </div>
        </div>
    </div>
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-3 col-md-6 mb-4 px-4">
                <div class="bg-white rounded shdow p-4 border-top border-4 text-center box">
                    <img src="{{asset('images/hotel.svg')}}" alt="" width="70px">
                    <h2 class="mt-3">75+ Rooms</h2>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4 px-4">
                <div class="bg-white rounded shdow p-4 border-top border-4 text-center box">
                    <img src="{{asset('images/staff.svg')}}" alt="" width="70px">
                    <h2 class="mt-3">100+ staffs</h2>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4 px-4">
                <div class="bg-white rounded shdow p-4 border-top border-4 text-center box">
                    <img src="{{asset('images/customers.svg')}}" alt="" width="70px">
                    <h3 class="mt-3">300+ Residents</h3>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4 px-4">
                <div class="bg-white rounded shdow p-4 border-top border-4 text-center box">
                    <img src="{{asset('images/facilities.svg')}}" alt="" width="70px">
                    <h2 class="mt-3">20+ Facilities</h2>
                </div>
            </div>
        </div>
    </div>
    <h3 class="my-5 fw-bols h-font text-center">MANAGEMENT TEAM</h3>

    <div class="container px-4 ">
        <!-- Swiper -->
        <div class="swiper mySwiper ">
            <div class="swiper-wrapper mb-5">
                <div class="swiper-slide bg-white text-center overflow-hidden rounded">
                    <img src="{{asset('images/person1.jpg')}}" alt="" class="w-100">
                    <h2 class="mt-2">Ayesha</h2>
                </div>
                <div class="swiper-slide bg-white text-center overflow-hidden rounded">
                    <img src="{{asset('images/person2.jpg')}}" alt="" class="w-100">
                    <h2 class="mt-2">Aqsa Shehzadi</h2>
                </div>
                <div class="swiper-slide bg-white text-center overflow-hidden rounded">
                    <img src="{{asset('images/person3.jpg')}}" alt="" class="w-100">
                    <h2 class="mt-2">Attika</h2>
                </div>
                <div class="swiper-slide bg-white text-center overflow-hidden rounded">
                    <img src="{{asset('images/person1.jpg')}}" alt="" class="w-100">
                    <h2 class="mt-2">Ayesha</h2>
                </div>
                <div class="swiper-slide bg-white text-center overflow-hidden rounded">
                    <img src="{{asset('images/person2.jpg')}}" alt="" class="w-100">
                    <h2 class="mt-2">Aqsa Shehzadi</h2>
                </div>
                <div class="swiper-slide bg-white text-center overflow-hidden rounded">
                    <img src="{{asset('images/person3.jpg')}}" alt="" class="w-100">
                    <h2 class="mt-2">Attika</h2>
                </div>
                <div class="swiper-slide bg-white text-center overflow-hidden rounded">
                    <img src="{{asset('images/person1.jpg')}}" alt="" class="w-100">
                    <h2 class="mt-2">Ayesha</h2>
                </div>

            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>





    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <!-- Initialize Swiper -->
    <script>
        var swiper = new Swiper(".mySwiper", {
            slidesPerView: 3,
            spaceBetween: 40,

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