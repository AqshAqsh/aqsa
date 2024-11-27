@extends('layouts.app')
@section('content')
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
</head>

<title>ResideMe_FACILITIES</title>

<body class="bg-light">
    <div class="my-5 px-4">
        <h2 class="fw-bold h-font text-center">OUR FACILITIES</h2>
        <div class="h-line bg-dark"></div>
        <p class="text-center mt-3">Discover the facilities available to make your stay comfortable and enjoyable.<br> We offer high-speed WiFi,
        air conditioning, entertainment, and more, all tailored to provide you with a hassle-free experience.<br>
            
        
    </div>

    <div class="container">
        <div class="row">
            @foreach($facilities as $facility)
            <div class="col-lg-4 col-md-4 mb-5 px-4">
                <div class="bg-white pop rounded shadow p-4 border-top border-4 border-dark">
                    <div class="d-flex align-items-center mb-2">
                        <!-- Display the facility icon -->
                        <img src="{{ asset('storage/' . $facility->icon) }}" alt="{{ $facility->name }}" width="40px">
                        <h5 class="m-0 ms-3">{{ $facility->name }}</h5>
                    </div>
                    <p>{{ $facility->description }}</p>
                </div>
            </div>
            @endforeach
        </div>
        @if($facilities->isEmpty())
        <p class="text-center">No facilities available at the moment.</p>
        @endif

    </div>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
</body>

</html>
@endsection