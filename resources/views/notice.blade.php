@extends('layouts.app')

@section('content')
<div class="container">
<div class="row">
        <div class="col-lg-12 col-md-12 px-4">
            <div class="card mb-5 border-0 shadow">
                <div class="row g-0 p-1 align-items-center">
                    <h2><b>Hostel NoticeBoard</b></h2>
                </div>
            </div>
        </div>
    </div>
    @if($activeNotices->isNotEmpty())
    <div class="notices">
        <h3>Active Notices</h3>
        <ul>
            @foreach($activeNotices as $notice)
            <div class="notice">
                <h4>Title: {{ $notice->title }}</h4>
                <p>Content: {{ $notice->content }}</p>
                <p>Dated: {{ \Carbon\Carbon::parse($notice->date)->format('Y-m-d') }}</p>

            </div>
            @endforeach
        </ul>
    </div>
    @else
    <p>No active notices at the moment.</p>
    @endif
</div>
@endsection