<nav class="
    navbar navbar-expand navbar-light
    topbar
    mb-4
    static-top
    shadow
    " style="background-color: #f8f9fc; color:black">
  <!-- Sidebar Toggle (Topbar) -->
  <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
    <i class="fa fa-bars"></i>
  </button>

  <!-- Topbar Navbar -->
  <ul class="navbar-nav ml-auto">
    <li class="nav-item dropdown no-arrow">
      <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false">
        <span class="mr-2 d-lg-inline text-dark">
          <strong>{{ Auth::user()->name }}</strong>
        </span>
        <img class="img-profile rounded-circle"
          src="{{ (Auth::user()->image_name) ? asset('/public/profile/'.Auth::user()->image_name) : asset('/userAdmin/img/undraw_profile.svg')  }}" />
      </a>
      <!-- Dropdown - User Information -->
      <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
        @if (Request::segment(1) != 'soal')
        <a class="dropdown-item" href="{{ route('profil') }}">
          <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>Profile
        </a>
        <div class="dropdown-divider"></div>
        @endif
        <a class="dropdown-item" href="{{ route('logut-auth')}}">
          <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
          Logout
        </a>
      </div>
    </li>
  </ul>
</nav>
<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">
          Ready to Leave?
        </h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        Select "Logout" below if you are ready to end your
        current session.
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">
          Cancel
        </button>
        <a class="btn btn-primary" href="javascript:void();"
          onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
            class="bx bx-power-off font-size-16 align-middle mr-1 text-danger"></i>
          {{ __('Logout') }}</a>
        <form id="logout-form" action="{{ route('logut-auth') }}" method="POST" style="display: none;">
          @csrf
        </form>
      </div>
    </div>
  </div>
</div>