@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Hostel NotesBoard</h2>

    <!-- Display Active Notices -->
    @if($activeNotices->isNotEmpty())
    <div class="notices">
        <h3>Active Notices</h3>
        <ul>
            @foreach($activeNotices as $notice)
            <div class="notice">
                <h4>{{ $notice->title }}</h4>
                <p>{{ $notice->content }}</p>
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