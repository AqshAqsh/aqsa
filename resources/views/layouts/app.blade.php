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

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
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
                            <a class="nav-link active me-2" href="{{ route('home') }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link me-2" href="{{ route('room') }}">Rooms</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link me-2" href="{{ route('facilities') }}">Facilities</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link me-2" href="{{ route('contact') }}">Contact us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link me-2" href="{{ route('about') }}">About</a>
                        </li>
                    </ul>

                    <ul class="navbar-nav navbar-nav-right">
                        @guest
                        <li class="nav-item">
                            <a href="{{ route('auth.login') }}" class="btn btn-outline-dark shadow-none me-3 me-lg-2">Login</a>
                        </li>
                        @else
                        
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="nav-profile-img">
                                    <img src="{{ asset('assets/images/faces/face28.png') }}" alt="image">
                                </div>
                                <div class="nav-profile-text">
                                    <p class="mb-1 text-black">{{ Auth::user()->name }}</p>
                                </div>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                                <h2 class="dropdown-header text-uppercase pl-2 text-dark">User Options</h2>
                                <li><a class="dropdown-item" href="{{ route('notice') }}">{{ __('NoticeBoard') }}</a></li>
                                <li><a class="dropdown-item" href="{{ route('profile.show') }}">{{ __('Profile') }}</a></li>
                                <li><a class="dropdown-item" href="{{  route('notifications')  }}">{{ __('Alerts') }}</a></li>
                                <div class="dropdown-divider"></div>
                                <li>
                                    <a class="dropdown-item" href="{{ route('user.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Log Out</a>
                                    <form id="logout-form" action="{{ route('user.logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            </ul>

                        </li>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
                            <h6 class="p-3 mb-0 bg-primary text-white py-4">Notifications</h6>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item preview-item">
                                <div class="preview-thumbnail">
                                    <div class="preview-icon bg-success">
                                        <i class="mdi mdi-calendar"></i>
                                    </div>
                                </div>
                                <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                                    <h6 class="preview-subject font-weight-normal mb-1">Event today</h6>
                                    <p class="text-gray ellipsis mb-0"> Just a reminder that you have an event today </p>
                                </div>
                            </a>
                            <div class="dropdown-divider"></div>
                            <h6 class="p-3 mb-0 text-center">See all notifications</h6>
                        </div>
                        @endguest
                    </ul>
                </div>

            </div>
        </nav>

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

    <!-- JavaScript to generate unique session_id per tab -->
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
</body>

</html>