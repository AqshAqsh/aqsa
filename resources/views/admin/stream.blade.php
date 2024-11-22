@extends('layouts.admin-app')

@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Live Stream</title>
    <link href="https://vjs.zencdn.net/7.10.2/video-js.css" rel="stylesheet" />
    <script src="https://vjs.zencdn.net/7.10.2/video.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/videojs-contrib-hls@5.15.1/dist/videojs-contrib-hls.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/hls.js@latest"></script>


    <link href="https://vjs.zencdn.net/7.14.3/video-js.css" rel="stylesheet" />
    <style>
        video {
            width: 100%;
            height: 100%;
            object-fit: cover;
            /* This will scale the video to cover the entire player area */
        }
    </style>
</head>

<body>
    <div class="content-wrapper">
        <div class="row " id="proBanner">
            <div class="col-12">
                <span class="d-flex align-items-center purchase-popup">
                    <h1>Live Stream</h1>
                </span>
            </div>
        </div>
        <div class="row d-flex aling-items-center justify-content-center">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Streaming</h4>
                        <video id="live-stream" class="video-js vjs-default-skin" controls autoplay width="640" height="360" data-setup='{}'>
                            <source src="http://localhost:8080/hls/mystream.m3u8" type="application/x-mpegURL">
                            Your browser does not support HLS playback.
                        </video>
                    </div>
                </div>
            </div>
        </div>


        <script src="https://vjs.zencdn.net/7.14.3/video.min.js"></script>
        <script>
            var player = videojs('live-stream');
            player.play();
        </script>
</body>

</html>
@endsection