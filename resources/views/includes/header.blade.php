<nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
  <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
    <a class="navbar-brand brand-logo" href="dashboard"><img src="{{ asset('images/logo.jpg') }}" alt="new logo" /> ResideMe</a>
  </div>
  <div class="navbar-menu-wrapper d-flex align-items-stretch">
    <div class="container">
      @auth('admin')
      @if (session('status'))
      <div class="alert alert-success" role="alert">
        {{ session('status') }}
      </div>
      @endif

      @endauth
    </div>
    <ul class="navbar-nav navbar-nav-right">
      <li class="nav-item nav-profile dropdown">
        <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
          <img class="img-avatar img-avatar48 img-avatar-thumb"
            src="{{ Auth::user()->profile_picture ? asset('storage/' . Auth::user()->profile_picture) : asset('assets/images/faces/defaultprofile.png') }}"
            alt="{{ Auth::user()->name }}">

          <div class="nav-profile-text">
            <p class="mb-1 text-black">{{ Auth::user()->name }}</p>
          </div>
        </a>
        <div class="dropdown-menu navbar-dropdown dropdown-menu-right p-0 border-0 font-size-sm" aria-labelledby="profileDropdown" data-x-placement="bottom-end">
          <div class="p-3 text-center" style="background-color: #010142;">
            <img class="img-avatar img-avatar48 img-avatar-thumb" src="{{ Auth::user()->profile_picture ? asset('storage/' . Auth::user()->profile_picture) : asset('assets/images/faces/defaultprofile.png') }}"
              alt="{{ Auth::user()->name }}">

          </div>
          <div class="p-2">
            <h5 class="dropdown-header text-uppercase pl-2 text-dark">Admin Options</h5>
            <a class="dropdown-item py-1 d-flex align-items-center justify-content-between" href="{{route('admin.notifications') }}">
              <span>Inbox</span>
              <span class="p-0">
                <span class="badge badge-danger">{{ Auth::user()->unreadNotifications->count() }}</span>
                <i class="mdi mdi-email-open-outline ml-1"></i>
              </span>
            </a>
            <a class="dropdown-item py-1 d-flex align-items-center justify-content-between" href="{{route('admin.profile') }}">
              <span>Profile</span>
              <span class="p-0">
                <span class="badge badge-success"></span>
                <i class="mdi mdi-account-outline ml-1"></i>
              </span>
            </a>
            <div role="separator" class="dropdown-divider"></div>
            <h5 class="dropdown-header text-uppercase  pl-2 text-dark mt-2">Actions</h5>
            @auth('admin')
            <form action="{{ route('admin.logout') }}" method="POST" style="display: inline;">
              @csrf
              <button type="submit" class="dropdown-item py-1 d-flex align-items-center justify-content-between" style="background: none; border: none; padding: 0;">
                <a class="dropdown-item py-1 d-flex align-items-center justify-content-between" href="#">
                  <span>Log Out</span>
                  <i class="mdi mdi-logout ml-1"></i>
                </a>
              </button>
            </form>
            @endauth

          </div>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">
          <i class="mdi mdi-bell-outline"></i>
          <span class="count-symbol bg-danger"></span>
        </a>

        <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown" style="max-height: 523px; overflow-y: auto;">
          <h6 class="p-3 mb-0 text-white py-4" style="background-color: #010142;">Notifications</h6>
          <div class="dropdown-divider"></div>

          @if ($notifications->isNotEmpty())
          @foreach ($notifications as $notification)
          @php
          switch ($notification->type) {
          case 'NewBookingNotification':
          $route = route('admin.bookings.list');
          break;
          case 'FeedbackNotification':
          $route = route('admin.feedback.list');
          break;
          default:
          $route = route('admin.notifications');
          }
          @endphp

          <a class="dropdown-item preview-item" href="{{ $route }}">
            <div class="preview-thumbnail">
              <div class="preview-icon bg-warning">
                <i class="mdi mdi-calendar"></i>
              </div>
            </div>
            <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
              <h6 class="preview-subject font-weight-normal mb-1">{{ $notification->data['message'] }}</h6>
              <p class="text-gray ellipsis mb-0">{{ $notification->created_at->diffForHumans() }}</p>
            </div>
          </a>
          <div class="dropdown-divider"></div>
          @endforeach
          @else
          <p class="p-3 mb-0">No new notifications.</p>
          @endif

          <h6 class="p-3 mb-0 text-center">
            <a href="{{ route('admin.notifications') }}">See all notifications</a>
          </h6>
        </div>
      </li>



    </ul>
    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-bs-toggle="offcanvas">
      <span class="mdi mdi-menu"></span>
    </button>
  </div>
</nav>