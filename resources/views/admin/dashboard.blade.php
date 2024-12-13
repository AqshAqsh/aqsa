@extends('layouts.admin-app')

@section('title')
Dashboard
@endsection

@section('content')
<style>
    .section-title {
        font-size: 24px;
        font-weight: bold;
        color: #021a4d;
        margin-top: 30px;
        text-align: center;
        text-transform: uppercase;
        letter-spacing: 1px;
        animation: fadeIn 1s ease-in-out;
    }

    .card-body {
        font-size: 24px;
        font-weight: bold;
        margin-top: 30px;
        text-align: center;
        animation: fadeIn 1s ease-in-out;

    }

    .facilities-list,
    .rooms-list {
        list-style-type: none;
        padding: 0;
        margin: 0;
        animation: fadeIn 2s ease-in-out;
    }

    .facility-item,
    .room-item {
        background: #f8f9fa;
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 12px 20px;
        margin-bottom: 10px;
        transition: transform 0.3s, background-color 0.3s;
    }

    .facility-item:hover,
    .room-item:hover {
        transform: scale(1.05);
        background-color: #e0e0e0;
    }

    .facility-name,
    .room-no {
        font-weight: bold;
        color: #021a4d;
    }

    .facility-room-count,
    .bookings-count {
        color: #888;
    }

    /* Adding a hover effect for list items */
    .facility-item:hover,
    .room-item:hover {
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        background-color: #f1f1f1;
    }

    /* Animation for page load */
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>
<div class="content-wrapper">
    <div class="d-xl-flex justify-content-between align-items-start">
        <h2 class="text-dark font-weight-bold mb-2"> Overview dashboard </h2>
        <div class="d-sm-flex justify-content-xl-between align-items-center mb-2">
            <div class="dropdown ml-0 ml-md-4 mt-2 mt-lg-0">

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="d-sm-flex justify-content-between align-items-center transaparent-tab-border ">
                <ul class="nav nav-tabs tab-transparent" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link" id="bookings-tab" data-toggle="tab" href="#bookings-1" role="tab" aria-selected="true" style="color: #021a4d;">Bookings</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" id="performance-tab" data-toggle="tab" href="#performance-1" role="tab" aria-selected="false" style="color: #021a4d;">Performance</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="Activities-tab" data-toggle="tab" href="#Activities-1" role="tab" aria-selected="false" style="color: #021a4d;">Activities</a>
                    </li>
                </ul>
            
            </div>
            <div class="tab-content tab-transparent-content">
                <div class="tab-pane fade show active" id="performance-1" role="tabpanel" aria-labelledby="performance-tab">
                    <div class="row">
                        <div class="col-xl-3 col-lg-6 col-sm-6 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body text-center">
                                    <h5 class="mb-2 text-dark font-weight-normal">Total Residents</h5>
                                    <h2 class="mb-4 text-dark font-weight-bold">{{ $totalResidents }}</h2>
                                    <div class="dashboard-progress dashboard-progress-2 d-flex align-items-center justify-content-center item-parent"><i class="mdi mdi-account-circle icon-md absolute-center" style="color: #d5af07;"></i></div>
                                    <p class="mt-4 mb-0">Residents In our Hostel</p>
                                    <h3 class="mb-0 font-weight-bold mt-2 text-dark">{{ number_format($residentPercentage)}}%</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-6 col-sm-6 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body text-center">
                                    <h5 class="mb-2 text-dark font-weight-normal">Total Rooms</h5>
                                    <h2 class="mb-4 text-dark font-weight-bold">{{ $totalRooms }}</h2>
                                    <div class="dashboard-progress dashboard-progress-2 d-flex align-items-center justify-content-center item-parent"><i class="mdi mdi-bed icon-md absolute-center" style="color: #d5af07;"></i></div>
                                    <p class="mt-4 mb-0">Rooms In our Hostel</p>
                                    <h3 class="mb-0 font-weight-bold mt-2 text-dark">{{ number_format($roomPercentage) }}%</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-6 col-sm-6 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body text-center">
                                    <h5 class="mb-2 text-dark font-weight-normal">Total Feedbacks</h5>
                                    <h2 class="mb-4 text-dark font-weight-bold">{{ $totalFeedbacks }}</h2>
                                    <div class="dashboard-progress dashboard-progress-2 d-flex align-items-center justify-content-center item-parent"><i class="mdi mdi-comment-text icon-md absolute-center" style="color: #d5af07;"></i></div>
                                    <p class="mt-4 mb-0">Rooms In our Hostel</p>
                                    <h3 class="mb-0 font-weight-bold mt-2 text-dark">{{ number_format($feedbackPercentage) }}%</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-6 col-sm-6 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body text-center">
                                    <h5 class="mb-2 text-dark font-weight-normal">Total Booking</h5>
                                    <h2 class="mb-4 text-dark font-weight-bold">{{ $totalBookings }}</h2>
                                    <div class="dashboard-progress dashboard-progress-2 d-flex align-items-center justify-content-center item-parent"><i class="mdi mdi-book icon-md absolute-center" style="color: #d5af07;"></i></div>
                                    <p class="mt-4 mb-0">Rooms In our Hostel</p>
                                    <h3 class="mb-0 font-weight-bold mt-2 text-dark">{{ number_format($bookingPercentage) }}%</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 grid-margin">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="d-flex justify-content-between align-items-center mb-4">
                                                <h4 class="card-title mb-0" style="color: #021a4d;">Recent Activity</h4>
                                                <div class="dropdown dropdown-arrow-none">
                                                    <button class="btn p-0 text-dark dropdown-toggle" type="button" id="dropdownMenuIconButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: #021a4d;">
                                                        <i class="mdi mdi-dots-vertical"></i>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuIconButton1">
                                                        <h6 class="dropdown-header" style="color: #021a4d;">Settings</h6>
                                                        <a class="dropdown-item" href="#" style="color: #021a4d;">Action</a>
                                                        <a class="dropdown-item" href="#" style="color: #021a4d;">Another action</a>
                                                        <a class="dropdown-item" href="#" style="color: #021a4d;">Something else here</a>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item" href="#" style="color: #021a4d;">Separated link</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Displaying Recent Activities -->
                                    <ul class="list-group">
                                        @foreach ($recentActivities as $activity)
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            {{ $activity['description'] }}
                                            <span class="badge badge-info badge-pill">{{ \Carbon\Carbon::parse($activity['created_at'])->diffForHumans() }}</span>
                                        </li>
                                        @endforeach
                                    </ul>
                                    {{ $recentActivities->links('vendor.pagination.default') }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="dashboard">
                        <div class="chart-container">
                            {!! $facilitiesChart->container() !!}
                        </div>
                        {!! $facilitiesChart->script() !!}

                        <!-- Revenue Breakdown -->
                        <div class="revenue-breakdown">
                            <h3>Total Revenue: <span class="highlight">${{ $totalRevenue }}</span></h3>
                            <h3>Monthly Revenue: <span class="highlight">${{ $monthlyRevenue }}</span></h3>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <h3 class="section-title">Underutilized Facilities</h3>
                                <ul class="facilities-list">
                                    @foreach ($facilities as $facility)
                                    <li class="facility-item">
                                        <span class="facility-name">{{ $facility->name }}</span> -
                                        <span class="facility-room-count">{{ $facility->rooms_count }} Rooms</span>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="col-lg-6">
                                <h3 class="section-title">Top Booked Rooms</h3>
                                <ul class="rooms-list">
                                    @foreach ($topBookedRooms as $room)
                                    <li class="room-item">
                                        <span class="room-no">{{ $room->room_no }}</span> -
                                        <span class="bookings-count">Bookings: {{ $room->bookings_count }}</span>
                                    </li>
                                    @endforeach
                                </ul>

                            </div>
                        </div>

                        <!-- System Status -->
                        <div class="system-status">
                            <h3 class="section-title">System Status</h3>
                            <ul>
                                <li class="room-item"><strong>CPU Usage:</strong> {{ $cpuUsage }}%</li>
                                <li class="room-item"><strong>Memory Usage:</strong> {{ $memoryUsage }}MB</li>
                            </ul>
                        </div>
                    </div>
                    @push('scripts')
                    {!! $facilitiesChart->script() !!}
                    @endpush
                </div>
                <div class="tab-pane fade" id="Activities-1" role="tabpanel" aria-labelledby="Activities-tab">
                    <div class="row">
                        <div class="col-12 grid-margin">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="d-flex justify-content-between align-items-center mb-4">
                                                <h4 class="card-title mb-0" style="color: #021a4d;">Recent Activity</h4>
                                                <div class="dropdown dropdown-arrow-none">
                                                    <button class="btn p-0 text-dark dropdown-toggle" type="button" id="dropdownMenuIconButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: #021a4d;">
                                                        <i class="mdi mdi-dots-vertical"></i>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuIconButton1">
                                                        <h6 class="dropdown-header" style="color: #021a4d;">Settings</h6>
                                                        <a class="dropdown-item" href="#" style="color: #021a4d;">Action</a>
                                                        <a class="dropdown-item" href="#" style="color: #021a4d;">Another action</a>
                                                        <a class="dropdown-item" href="#" style="color: #021a4d;">Something else here</a>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item" href="#" style="color: #021a4d;">Separated link</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <ul class="list-group">
                                        @foreach ($recentActivities as $activity)
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            {{ $activity['description'] }}
                                            <span class="badge badge-info badge-pill">{{ \Carbon\Carbon::parse($activity['created_at'])->diffForHumans() }}</span>
                                        </li>
                                        @endforeach
                                    </ul>
                                    {{ $recentActivities->links('vendor.pagination.default') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="tab-pane fade" id="bookings-1" role="tabpanel" aria-labelledby="bookings-tab">
                    <div class="dashboard">
                        <!--<div class="chart-container">
                            {!! $facilitiesChart->container() !!}
                        </div>
                        {!! $facilitiesChart->script() !!}
                        @push('scripts')
                        {!! $facilitiesChart->script() !!}
                        @endpush-->

                        <div class="row">
                            <div class="col-lg-6">
                                <h3 class="section-title">Underutilized Facilities</h3>
                                <ul class="facilities-list">
                                    @foreach ($facilities as $facility)
                                    <li class="facility-item">
                                        <span class="facility-name">{{ $facility->name }}</span> -
                                        <span class="facility-room-count">{{ $facility->rooms_count }} Rooms</span>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="col-lg-6">
                                <h3 class="section-title">Top Booked Rooms</h3>
                                <ul class="rooms-list">
                                    @foreach ($topBookedRooms as $room)
                                    <li class="room-item">
                                        <span class="room-no">{{ $room->room_no }}</span> -
                                        <span class="bookings-count">Bookings: {{ $room->bookings_count }}</span>
                                    </li>
                                    @endforeach
                                </ul>

                            </div>
                        </div>

                    </div>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection