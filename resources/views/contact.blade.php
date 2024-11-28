@extends('layouts.app')
@section('title', 'ResideMe _ contactus')
@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.links')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
</head>

<style>
    .custom-bg {
        background-color: var(--teal);
        border: 1px solid var(--teal);
    }
</style>

<body class="bg-light">
    <div class="my-5 px-4">
        <h2 class="fw-bold h-font text-center">CONTACT US</h2>
        <div class="h-line bg-dark"></div>
        <p class="text-center mt-3">
        We’d love to hear from you! Whether you have a question about our hostel,<br> 
        need assistance with booking, or want to share feedback, we are here to help. 
        Your comfort and satisfaction are our top priorities,<br> and our team is always ready to assist you with any inquiries or concerns.
        </p>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 mb-5 px-4">
                <div class="bg-white rounded shadow p-4">
                    <iframe class="w-100 rounded mb-4" height="320px" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3377.5295951066378!2d74.19896347543325!3d32.16299082392641!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x391f2a1b7a50fc9b%3A0x202625f2cca04e32!2sGovernment%20College%2C%20Gujranwala!5e0!3m2!1sen!2s!4v1720677886636!5m2!1sen!2s" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

                    <h5 class="">Address</h5>
                    <a href="https://maps.app.goo.gl/t3KJhv2xsngSkszL8" target="_blank" class="d-line-block text-decoration-none text-dark mb-2">
                        <i class="bi bi-geo-alt-fill"></i> Govt. Post Graduate College Gujranwala, Satellite Town
                    </a>
                    <h5>CALL US</h5>
                    <i class="bi bi-telephone-fill"></i>
                    <a href="tel:+923127557097" class="d-inline-block mb-2 text-decoration-none text-dark">+920000000097</a>

                    <h5 class="mt-4">Email</h5>
                    <a href="mailto:aqshaqsh01234@gmail.com" class="d-line-block text-decoration-none text-dark ">
                        <i class="bi bi-envelope-fill"></i> aqshaqsh34@gmail.com
                    </a>

                    <h5 class="mt-4">Follow US</h5>
                    <a href="" class="d-inline-block mb-3 text-dark fs-6 me-2"><i class="bi bi-twitter"></i></a>
                    <a href="https://www.facebook.com/" class="d-inline-block mb-3 text-dark fs-6 me-2"><i class="bi bi-facebook"></i></a>
                    <a href="https://www.instagram.com/" class="d-inline-block text-dark fs-6"><i class="bi bi-instagram"></i></a>
                </div>
            </div>

            <div class="col-lg-6 col-md-6 mb-5 px-4">
                <div class="bg-white rounded shadow p-4">
                    <form action="{{ route('feedback.store') }}" method="POST">
                        @csrf
                        <div class="container">
                            @if(Auth::check())
                            <h1>Welcome, {{ Auth::user()->name }}</h1>
                            @else
                            <h1>Welcome, Guest</h1>
                            @endif

                            <div class="form-group">
                                <label for="message">Your Feedback:</label>
                                <textarea id="message" name="message" class="form-control" rows="5" required></textarea>
                                @error('message')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-warning">Submit Feedback</button>
                        </div>
                    </form>

                    <h2>Your Feedback Status</h2>
                    <div>
                        @if(Auth::check() && Auth::user()->feedbacks->count() > 0)
                        <ul class="list-group">
                            @foreach(Auth::user()->feedbacks as $feedback)
                            <li class="list-group-item">
                                <strong>Message:</strong> {{ $feedback->message }} <br>
                                <strong>Status:</strong> {{ $feedback->status }}
                            </li>
                            @endforeach
                        </ul>
                        @else
                        <p>No feedback submitted yet.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
</body>

</html>
@endsection