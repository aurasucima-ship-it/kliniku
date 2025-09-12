<nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">

  <!-- Sidebar Toggle (Mobile) -->
  <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
    <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
      <i class="ti ti-menu-2 ti-md"></i>
    </a>
  </div>

  <!-- Navbar Right -->
  <div class="navbar-nav ms-auto d-flex align-items-center" id="navbar-collapse">

    <!-- User Dropdown -->
    <li class="nav-item navbar-dropdown dropdown-user dropdown">
      <a class="nav-link dropdown-toggle hide-arrow p-0 d-flex align-items-center" href="javascript:void(0);" data-bs-toggle="dropdown">
        <div class="avatar avatar-online me-2">
          @if(Auth::user()->foto)
            <img src="{{ asset('storage/' . Auth::user()->foto) }}" alt="User Avatar" class="rounded-circle" />
          @else
            <img src="{{ asset('img/avatars/1.png') }}" alt="User Avatar" class="rounded-circle" />
          @endif
        </div>
        <span class="fw-medium">{{ Auth::user()->name }}</span>
      </a>

      <ul class="dropdown-menu dropdown-menu-end">
        <!-- User Info -->
        <li>
          <a class="dropdown-item mt-0" href="{{ route('profile.edit') }}">
            <div class="d-flex align-items-center">
              <div class="flex-shrink-0 me-2">
                <div class="avatar avatar-online">
                  @if(Auth::user()->foto)
                    <img src="{{ asset('storage/' . Auth::user()->foto) }}" alt="User Avatar" class="rounded-circle" />
                  @else
                    <img src="{{ asset('img/avatars/1.png') }}" alt="User Avatar" class="rounded-circle" />
                  @endif
                </div>
              </div>
              <div class="flex-grow-1">
                <h6 class="mb-0">{{ Auth::user()->name }}</h6>
                <small class="text-muted">Admin</small>
              </div>
            </div>
          </a>
        </li>

        <li><div class="dropdown-divider my-1 mx-n2"></div></li>

        <!-- Ubah Profil -->
        <li>
          <a class="dropdown-item" href="{{ route('profile.edit') }}">
            <i class="ti ti-user me-3 ti-md"></i>
            <span class="align-middle">Ubah Profil</span>
          </a>
        </li>

        <!-- Logout -->
        <li>
          <div class="d-grid px-2 pt-2 pb-1">
            <a class="btn btn-sm btn-danger d-flex align-items-center" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" href="javascript:void(0);">
              <small class="align-middle">Logout</small>
              <i class="ti ti-logout ms-2 ti-14px"></i>
            </a>
            <form id="logout-form" method="POST" action="{{ route('logout') }}">
              @csrf
            </form>
          </div>
        </li>
      </ul>
    </li>
    <!-- /User Dropdown -->

  </div>
</nav>
