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


<title>Reside Me _ About</title>

<body class="bg-light">
    <div class="my-5 px-4">
        <h2 class="fw-bold h-font text-center">ABOUT US</h2>
        <div class="h-line bg-dark">
        </div>
        <p class="text-center mt-3">Lorem ipsum dolor sit amet consectetur, adipisicing elit. In, dolorem delectus!<br>
            Error, deleniti est rerum, cum quisquam autem ipsum molestias, <br>
            odio nisi maiores ad blanditiis quam natus quasi! Veniam, illum!</p>
    </div>
    <div class="container">
        <div class="row justify-content-between align-items-center">
            <div class="col-lg-6 col-lg-5 mb-4 order-lg-1 order-md-1 order-2">
                <h3 class="mb-3">lorem</h3>
                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Placeat
                    hic tempore sint magnam a, iure perferendis animi in necessitatibus
                    aperiam minus officia ullam voluptatum earum atque quidem, labore
                    officiis sunt.</p>
            </div>
            <div class="col-lg-5 col-md-5 mb-4 order-lg-2 order-md-2 order-1">
                <img src="images/p1.jpg" alt="" class="w-100">
            </div>
        </div>
    </div>
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-3 col-md-6 mb-4 px-4">
                <div class="bg-white rounded shdow p-4 border-top border-4 text-center box">
                    <img src="images/hotel.svg" alt="" width="70px">
                    <h2 class="mt-3">100+ Rooms</h2>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4 px-4">
                <div class="bg-white rounded shdow p-4 border-top border-4 text-center box">
                    <img src="images/staff.svg" alt="" width="70px">
                    <h2 class="mt-3">100+ staffs</h2>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4 px-4">
                <div class="bg-white rounded shdow p-4 border-top border-4 text-center box">
                    <img src="images/customers.svg" alt="" width="70px">
                    <h2 class="mt-3">200+ customers</h2>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4 px-4">
                <div class="bg-white rounded shdow p-4 border-top border-4 text-center box">
                    <img src="images/rating.svg" alt="" width="70px">
                    <h2 class="mt-3">150+ Reviews</h2>
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
                    <img src="images/p.jpg" alt="" class="w-100">
                    <h2 class="mt-2">Rendom Name</h2>
                </div>
                <div class="swiper-slide bg-white text-center overflow-hidden rounded">
                    <img src="images/p.jpg" alt="" class="w-100">
                    <h2 class="mt-2">Rendom Name</h2>
                </div>
                <div class="swiper-slide bg-white text-center overflow-hidden rounded">
                    <img src="images/p.jpg" alt="" class="w-100">
                    <h2 class="mt-2">Rendom Name</h2>
                </div>
                <div class="swiper-slide bg-white text-center overflow-hidden rounded">
                    <img src="images/p.jpg" alt="" class="w-100">
                    <h2 class="mt-2">Rendom Name</h2>
                </div>
                <div class="swiper-slide bg-white text-center overflow-hidden rounded">
                    <img src="images/p.jpg" alt="" class="w-100">
                    <h2 class="mt-2">Rendom Name</h2>
                </div>
                <div class="swiper-slide bg-white text-center overflow-hidden rounded">
                    <img src="images/p.jpg" alt="" class="w-100">
                    <h2 class="mt-2">Rendom Name</h2>
                </div>
                <div class="swiper-slide bg-white text-center overflow-hidden rounded">
                    <img src="images/p.jpg" alt="" class="w-100">
                    <h2 class="mt-2">Rendom Name</h2>
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