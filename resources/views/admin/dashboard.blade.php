@extends('layouts.admin-app')

@section('title')
Dashboard
@endsection

@section('content')
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
                        <a class="nav-link" id="home-tab" data-toggle="tab" href="#" role="tab" aria-selected="true" style="color: #021a4d;">Users</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" id="business-tab" data-toggle="tab" href="#business-1" role="tab" aria-selected="false" style="color: #021a4d;">Performance</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="conversion-tab" data-toggle="tab" href="#" role="tab" aria-selected="false" style="color: #021a4d;">Conversion</a>
                    </li>
                </ul>
                <div class="d-md-block d-none">
                    <a href="#" class="text-dark p-1"><i class="mdi mdi-view-dashboard" style="color: #021a4d;"></i></a>
                    <a href="#" class="text-dark p-1"><i class="mdi mdi-dots-vertical" style="color: #021a4d;"></i></a>
                </div>
            </div>
            <div class="tab-content tab-transparent-content">
                <div class="tab-pane fade show active" id="business-1" role="tabpanel" aria-labelledby="business-tab">
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
                        </div><div class="col-xl-3 col-lg-6 col-sm-6 grid-margin stretch-card">
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
                                    <!-- Additional Content Here -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
