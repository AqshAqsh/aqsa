<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    @include('layouts.links')
    <link rel="shortcut icon" href="{{ asset('images/logo.jpg') }}" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito|Poppins:wght@400;500;600|Merienda:wght@700&display=swap" rel="stylesheet">

    <link href="https://cdn.materialdesignicons.com/5.4.55/css/materialdesignicons.min.css" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

</head>

<body class="bg-light">
    <div id="app">
        <!-- Navbar -->
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
                        @guest
                        <li class="nav-item">
                            <a href="{{ route('auth.login') }}" class="btn btn-outline-dark shadow-none me-3 me-lg-2">Login</a>
                        </li>
                        @else

                        <li class="nav-item nav-profile dropdown">
                            <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" role="button" data-bs-toggle="dropdown" data-bs-offset="0,10" aria-expanded="false">
                                <div class="profile align-items-center">

                                    <div class="nav-profile-img">
                                        <img src="{{ Auth::user()->user_picture ? asset('storage/' . Auth::user()->user_picture) : asset('images/defaultprofile.png') }}"
                                            alt="{{ Auth::user()->name }}">
                                    </div>
                                    <div class="nav-profile-text">
                                        <p class="mb-1 text-black">{{ Auth::user()->name }}</p>
                                    </div>

                                </div>

                            </a>
                            <div class="dropdown-menu navbar-dropdown dropdown-menu-end p-0 border-0 font-size-sm" aria-labelledby="profileDropdown" data-x-placement="bottom-end">
                                <div class="p-3 text-center nav-profile-img" style="background-color: #010142;">
                                    <img class="img-avatar img-avatar48 img-avatar-thumb" src="{{ Auth::user()->user_picture ? asset('storage/' . Auth::user()->user_picture) : asset('images/defaultprofile.png') }}"
                                        alt="{{ Auth::user()->name }}">

                                </div>
                                <div class="p-2">
                                    <h2 class="dropdown-header text-uppercase pl-2 text-dark">User Options</h2>
                                    <a class="dropdown-item py-1 d-flex align-items-center justify-content-between" href="{{route('notice') }}">
                                        <span>NoticeBoard</span>
                                        <span class="p-0">
                                            <span class="badge badge-danger"></span>
                                            <i class="mdi mdi-email-open-outline ml-1"></i>
                                        </span>
                                    </a>
                                    <a class="dropdown-item py-1 d-flex align-items-center justify-content-between" href="{{route('profile.show') }}">
                                        <span>Profile</span>
                                        <span class="p-0">
                                            <span class="badge badge-success"></span>
                                            <i class="bi bi-person-fill"></i> </span>
                                    </a>
                                    <a class="dropdown-item py-1 d-flex align-items-center justify-content-between" href="{{route('user.notifications') }}">
                                        <span>Alerts</span>
                                        <span class="p-0">
                                            <span class="badge badge-danger">{{ Auth::user()->unreadNotifications->count() }}</span>
                                            <i class="bi bi-bell"></i>
                                        </span>
                                    </a>
                                    <div role="separator" class="dropdown-divider"></div>
                                    <h5 class="dropdown-header text-uppercase  pl-2 text-dark mt-2">Actions</h5>
                                    <a class="dropdown-item" href="{{ route('user.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Log Out</a>

                                    <form id="logout-form" action="{{ route('user.logout') }}" method="POST" style="display: inline;" class="d-none">
                                        @csrf
                                        <button type="submit" class="dropdown-item py-1 d-flex align-items-center justify-content-between" style="background: none; border: none; padding: 0;">
                                            <a class="dropdown-item py-1 d-flex align-items-center justify-content-between" href="#">
                                                <span>Log Out</span>
                                                <i class="mdi mdi-logout ml-1"></i>
                                            </a>
                                        </button>
                                    </form>

                                </div>
                            </div>
                        </li>
                        @endguest

                    </ul>
                </div>

            </div>
        </nav>
    </div>


    <!-- Main Content -->
    <main class="py-4">
        @yield('content')
    </main>
    </div>

    <!-- Bootstrap Bundle JS (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- Footer -->
    @include('layouts.footer')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>


    <!-- Vendor JS -->
    <script src="{{ asset('assets/vendors/js/vendor.bundle.base.js') }}" defer></script>
    <script src="{{ asset('assets/vendors/chart.js/Chart.min.js') }}" defer></script>


    <script>
        // Check if session_id is already stored in localStorage
        if (!localStorage.getItem('session_id')) {
            // Generate a unique session ID based on the timestamp
            localStorage.setItem('session_id', 'tab_' + Date.now());
        }

        // Retrieve the session ID
        let sessionId = localStorage.getItem('session_id');
        console.log('Session ID for this tab:', sessionId); // Check it in the console

        // Optionally, you can send this session ID with AJAX requests or form submissions
        // For example, you can attach it to an HTTP request header or include it in your form data
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>
    <style>
        /* Force dropdown to fit within its container */
        .nav-profile .dropdown-menu {
            right: 0;
            /* Align it to the right of the container */
            left: auto;
            /* Remove default left alignment */
            width: 250px;
            /* Adjust width as needed */
            overflow: hidden;
            /* Prevent content overflow */
        }

        .nav-profile .dropdown-menu img {
            max-width: 100%;
            /* Ensure images scale correctly */
            height: auto;
        }
    </style>


</body>

</html>