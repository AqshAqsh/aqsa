<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    <li class="nav-item nav-category">Main</li>

    <!-- Dashboard Menu -->
    <li class="nav-item">
      <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
        <span class="icon-bg"><i class="mdi mdi-access-point menu-icon"></i></span>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>



    <!-- Residents Menu -->
    <li class="nav-item">
      <a class="nav-link {{ request()->routeIs('admin.user.create') || request()->routeIs('admin.user.list') ? 'active' : '' }}" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
        <span class="icon-bg"><i class="mdi mdi-contacts menu-icon"></i></span>
        <span class="menu-title">Residents</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse {{ request()->routeIs('admin.user.create') || request()->routeIs('admin.user.list') ? 'show' : '' }}" id="ui-basic">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.user.create') ? 'active' : '' }}" href="{{ route('admin.user.create') }}">Add Residents</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.user.list') ? 'active' : '' }}" href="{{ route('admin.user.list') }}">List Residents</a>
          </li>
        </ul>
      </div>
    </li>

    <li class="nav-item">
      <a class="nav-link {{ request()->routeIs('admin.room_category.list') || request()->routeIs('admin.room.list') || request()->routeIs('admin.bed.list') ? 'active' : '' }}" data-toggle="collapse" href="#bedmanager" aria-expanded="false" aria-controls="bedmanager">
        <span class="icon-bg"><i class="mdi mdi-hotel menu-icon"></i></span>
        <span class="menu-title">Room/Bed Manage</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse {{ request()->routeIs('admin.room_category.list') || request()->routeIs('admin.room.list') || request()->routeIs('admin.bed.list') ? 'show' : '' }}" id="bedmanager">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.room_category.list') ? 'active' : '' }}" href="{{ route('admin.room_category.list') }}">Category</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.room.list') ? 'active' : '' }}" href="{{ route('admin.room.list') }}">Room</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.bed.list') ? 'active' : '' }}" href="{{ route('admin.bed.list') }}">Bed</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.facility.list') ? 'active' : '' }}" href="{{ route('admin.facility.list') }}">Facility</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.bed.show') ? 'active' : '' }}" href="{{ route('admin.bed.show') }}">Bed Assigned</a>
          </li>
        </ul>
      </div>
    </li>


    <!-- Booking Menu -->
    <li class="nav-item">
      <a class="nav-link {{ request()->routeIs('admin.bookings.list') ? 'active' : '' }}" data-toggle="collapse" href="#booking" aria-expanded="false" aria-controls="booking">
        <span class="icon-bg"><i class="mdi mdi-clipboard-list menu-icon"></i></span>
        <span class="menu-title">Booking</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse {{ request()->routeIs('admin.bookings.list') ? 'show' : '' }}" id="booking">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.bookings.list') ? 'active' : '' }}" href="{{ route('admin.bookings.list') }}">Booking List</a>
          </li>
        </ul>
      </div>
    </li>

    <!-- Feedbacks Menu -->
    <li class="nav-item">
      <a class="nav-link {{ request()->routeIs('admin.feedback.list') ? 'active' : '' }}" data-toggle="collapse" href="#feedback" aria-expanded="false" aria-controls="feedback">
        <span class="icon-bg"><i class="mdi mdi-comment menu-icon"></i></span>
        <span class="menu-title">Feedbacks</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse {{ request()->routeIs('admin.feedback.list') ? 'show' : '' }}" id="feedback">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.feedback.list') ? 'active' : '' }}" href="{{ route('admin.feedback.list') }}">Feedbacks List</a>
          </li>
        </ul>
      </div>
    </li>

    <!-- Notice Menu -->
    <li class="nav-item">
      <a class="nav-link {{ request()->routeIs('admin.notice.create') || request()->routeIs('admin.notice.list') ? 'active' : '' }}" data-toggle="collapse" href="#notice" aria-expanded="false" aria-controls="notice">
        <span class="icon-bg"><i class="mdi mdi-bullhorn menu-icon"></i></span>
        <span class="menu-title">Notice</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse {{ request()->routeIs('admin.notice.create') || request()->routeIs('admin.notice.list') ? 'show' : '' }}" id="notice">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.notice.create') ? 'active' : '' }}" href="{{ route('admin.notice.create') }}">Add Notice</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.notice.list') ? 'active' : '' }}" href="{{ route('admin.notice.list') }}">List Notice</a>
          </li>
        </ul>
      </div>
    </li>
    <!-- Live Stream Menu -->
    <li class="nav-item">
      <a class="nav-link {{ request()->routeIs('live-stream') ? 'active' : '' }}" href="{{ route('live-stream') }}">
        <span class="icon-bg"><i class="mdi mdi-webcam menu-icon"></i></span>
        <span class="menu-title">Watch Live Stream</span>
      </a>
    </li>

    <!-- Documentation Link -->
    <li class="nav-item documentation-link">
      <a class="nav-link" href="{{ route('admin.documentation') }}" target="_blank">
        <span class="icon-bg">
          <i class="mdi mdi-file-document-box menu-icon"></i>
        </span>
        <span class="menu-title">Documentation</span>
      </a>
    </li>

    <!-- User Profile Section -->
    <li class="nav-item sidebar-user-actions">
      <div class="user-details">
        <div class="d-flex justify-content-between align-items-center">
          <div>
            <div class="d-flex align-items-center">
              <div class="sidebar-profile-img">
                <img class="img-avatar img-avatar48 img-avatar-thumb"
                  src="{{ Auth::user()->profile_picture ? asset('storage/' . Auth::user()->profile_picture) : asset('assets/images/faces/defaultprofile.png') }}"
                  alt="{{ Auth::user()->name }}">
              </div>
              <div class="sidebar-profile-text">
                <p class="mb-1 m-3">{{ Auth::user()->name }}</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </li>

    <li class="nav-item sidebar-user-actions">
      <div class="sidebar-user-menu">
        <form action="{{ route('admin.logout') }}" method="POST" style="display: inline;">
          @csrf
          <button type="submit" class="nav-link">
            <i class="mdi mdi-logout ml-1"></i>
            <span class="menu-title">Logout</span>
          </button>
        </form>
      </div>
    </li>

  </ul>
</nav>