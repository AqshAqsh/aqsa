<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    @include('layouts.links')


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app">


        <!DOCTYPE html>
        <html>

        <head>

            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
            <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
            <link href="https://fonts.googleapis.com/css2?family=Merienda:wght@700&display=swap" rel="stylesheet">
            <link href="https://fonts.googleapis.com/css2?family=Merienda&display=swap" rel="stylesheet">
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

        </head>
        <title>Reside Me</title>

        <body class="bg-light">
            <nav class="navbar navbar-expand-lg navbar-light bg-white px-lg-3 py-lg-2 shadow-sm sticky-top">
                <div class="container-fluid">
                    <a class="navbar-brand me-5 fw-bold fs-3 h-font" href="#"><b>Reside Me</b></a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                            @endif

                            <li class="nav-item">
                                <a class="nav-link active me-2" aria-current="page" href="{{route('home1')}}">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link me-2" href="{{route('room')}}">Rooms</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link me-2" href="{{route('facilities')}}">Facilities</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link me-2" href="{{route('contact')}}">Contect us</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link me-2" href="{{route('about')}}">About</a>
                            </li>
                        </ul>
                        <div class="d-flex">
                            @guest
                            @if (Route::has('login'))
                            <button type="button" class="btn btn-outline-dark shadow-none me-3 me-lg-2" data-bs-toggle="modal" data-bs-target="#loginmodal">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            </button>

                            @endif
                            @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('user.logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('user.logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                            @endguest
                            <!-- Button trigger modal 
                            <button type="button" class="btn btn-outline-dark shadow-none me-3 me-lg-2" data-bs-toggle="modal" data-bs-target="#loginmodal">
                                Login-->
                            <!--<button type="button" class="btn btn-outline-dark shadow-none" data-bs-toggle="modal" data-bs-target="#registermodal">
                        Register
                        </button>-->
                        </div>
                    </div>
                </div>
            </nav>




            <div class="modal fade" id="loginmodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form>
                            <div class="modal-header">
                                <h5 class="modal-title d-flex align-items-center">
                                    <i class="bi bi-person fs-3 me-1"></i>User Login
                                </h5>
                                <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label class="form-label">Email address</label>
                                    <input type="email" class="form-control shadow-none">

                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Password</label>
                                    <input type="password" class="form-control shadow-none">

                                </div>
                                <div class="d-flex align-items-center justify-content-between mb">
                                    <button type="submit" class="btn btn-dark shadow-none">login</button>
                                    <a href="javascript: void(0)" class="text-secondary text-deoration-none ">Forget Password ?</a>

                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>






            <main class="py-4">
                @yield('content')
            </main>
    </div>
    @include('layouts.footer')


    <!-- Scripts -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
</body>

</html>