<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    <li class="nav-item nav-category">Main</li>
    <li class="nav-item">
      <a class="nav-link" href="index.html">
        <span class="icon-bg"><i class="mdi mdi-cube menu-icon"></i></span>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#notice" aria-expanded="false" aria-controls="notice">
        <span class="icon-bg"><i class="mdi mdi-crosshairs-gps menu-icon"></i></span>
        <span class="menu-title">Booking</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="notice">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="{{route('admin.bookings.list')}}">Booking List</a>
          </li>
        </ul>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#notice" aria-expanded="false" aria-controls="notice">
        <span class="icon-bg"><i class="mdi mdi-crosshairs-gps menu-icon"></i></span>
        <span class="menu-title">Member</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="notice">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="{{ route('admin.member.create') }}">Add Member</a>
          </li>
          <li class="nav-item"> <a class="nav-link" href="{{ route('admin.member.list') }}">List Member</a>
          </li>
        </ul>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
        <span class="icon-bg"><i class="mdi mdi-crosshairs-gps menu-icon"></i></span>
        <span class="menu-title">UI Role</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="ui-basic">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="{{ route('admin.user.create') }} ">Add Residents</a></li>
          <li class="nav-item"> <a class="nav-link" href="{{ route('admin.user.list') }}">List Residents</a></li>
        </ul>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#notice" aria-expanded="false" aria-controls="notice">
        <span class="icon-bg"><i class="mdi mdi-crosshairs-gps menu-icon"></i></span>
        <span class="menu-title">Notice</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="notice">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="{{ route('admin.notice.create') }}">Add Notice</a>
          </li>
          <li class="nav-item"> <a class="nav-link" href="{{ route('admin.notice.list') }}">List Notice</a>
          </li>
        </ul>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#bedmanager" aria-expanded="false"
        aria-controls="bedmanager">
        <span class="icon-bg"><i class="mdi mdi-crosshairs-gps menu-icon"></i></span>
        <span class="menu-title">Bed Manager</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="bedmanager">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> 
            <a class="nav-link" href="{{ route('admin.room_category.list') }}">Category</a></li>
          <li class="nav-item"> <a class="nav-link" href="{{ route('admin.room.list') }}">Room</a></li>
          <li class="nav-item"> <a class="nav-link" href="{{ route('admin.bed.list') }}">Bed</a></li>
          <li class="nav-item"> <a class="nav-link" href="{{ route('admin.facility.list') }}">Facility</a></li>
          <li class="nav-item"> <a class="nav-link" href="{{ route('admin.notice.create') }}">Assign
              Bed</a></li>
        </ul>
      </div>
    </li>
  </ul>
</nav>