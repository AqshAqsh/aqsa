<nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
  <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
    <a class="navbar-brand brand-logo" href="dashboard"><img src="{{ asset('images/logo.jpg') }}" alt="new logo" /> ResideMe</a>
  </div>
  <div class="navbar-menu-wrapper d-flex align-items-stretch">
    <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
      <span class="mdi mdi-menu"></span>
    </button>
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
          <div class="nav-profile-img">
            <img src="{{ asset('assets/images/faces/face28.png') }} " alt="image">
          </div>
          <div class="nav-profile-text">
            <p class="mb-1 text-black">{{ Auth::user()->name }}</p>
          </div>
        </a>
        <div class="dropdown-menu navbar-dropdown dropdown-menu-right p-0 border-0 font-size-sm" aria-labelledby="profileDropdown" data-x-placement="bottom-end">
          <div class="p-3 text-center" style="background-color: #010142;">
            <img class="img-avatar img-avatar48 img-avatar-thumb" src="{{ asset('assets/images/faces/face28.png') }} " alt="">
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
                <span class="badge badge-success">1</span>
                <i class="mdi mdi-account-outline ml-1"></i>
              </span>
            </a>
            <a class="dropdown-item py-1 d-flex align-items-center justify-content-between" href="javascript:void(0)">
              <span>Settings</span>
              <i class="mdi mdi-settings"></i>
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

        <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
          <h6 class="p-3 mb-0 text-white py-4" style="background-color: #010142;">Notifications</h6>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item preview-item">
            <div class="preview-thumbnail">
              <img src="assets/images/faces/face4.jpg" alt="image" class="profile-pic">
            </div>
            <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
              <h6 class="preview-subject ellipsis mb-1 font-weight-normal">Mark send you a message</h6>
              <p class="text-gray mb-0"> 1 Minutes ago </p>
            </div>
          </a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link count-indicator dropdown-toggle" id="messageDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
          <i class="mdi mdi-email-outline"></i>
          <span class="count-symbol bg-success"></span>
        </a>
        <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="messageDropdown">
          <h6 class="p-3 mb-0 text-white py-4" style="background-color: #010142;">Feedbacks</h6>
          <div class="dropdown-divider"></div>


          @if (isset($notifications) && $notifications->isNotEmpty())
          @foreach ($notifications as $notification)
          <a class="dropdown-item preview-item">
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
          <p>No new notifications.</p>
          @endif

          <h6 class="p-3 mb-0 text-center">
            <a href="{{ route('admin.notifications') }}">See all notifications</a>
          </h6>
        </div>
      </li>



    </ul>
    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
      <span class="mdi mdi-menu"></span>
    </button>
  </div>
</nav>