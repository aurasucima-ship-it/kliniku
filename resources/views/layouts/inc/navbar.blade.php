<nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center"
     id="layout-navbar"
     style="background-color: #FCE7F3;">

  <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
    <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
      <i class="ti ti-menu-2 ti-md" style="color:#9d174d;"></i>
    </a>
  </div>

  <div class="navbar-nav ms-auto d-flex align-items-center" id="navbar-collapse">
    <li class="nav-item navbar-dropdown dropdown-user dropdown">
      <a class="nav-link dropdown-toggle hide-arrow p-0 d-flex align-items-center" href="javascript:void(0);" data-bs-toggle="dropdown">
        <div class="avatar avatar-online me-2">
          <img src="{{ Auth::user()->foto ? asset('storage/' . Auth::user()->foto) : asset('img/avatars/default-avatar.png') }}" 
               alt="User Avatar" class="rounded-circle" />
        </div>
        <span style="color:#9d174d;">{{ Auth::user()->name ?? 'Guest' }}</span>
      </a>

      <ul class="dropdown-menu dropdown-menu-end" style="background-color:#FCE7F3;">
        <li>
          <a class="dropdown-item mt-0" href="{{ route('profile.edit') }}">
            <div class="d-flex align-items-center">
              <div class="flex-shrink-0 me-2">
                <div class="avatar avatar-online">
                  <img src="{{ Auth::user()->foto ? asset('storage/' . Auth::user()->foto) : asset('img/avatars/default-avatar.png') }}" 
                       alt="User Avatar" class="rounded-circle" />
                </div>
              </div>
              <div class="flex-grow-1">
                <h6 class="mb-0" style="color:#9d174d;">{{ Auth::user()->name ?? 'Guest' }}</h6>
                <small class="text-pink-600">{{ Auth::user()->role ?? '-' }}</small>
              </div>
            </div>
          </a>
        </li>

        <li><div class="dropdown-divider my-1 mx-n2"></div></li>

        <li>
          <a class="dropdown-item" href="{{ route('profile.edit') }}">
            <i class="ti ti-user me-3 ti-md" style="color:#9d174d;"></i>
            <span class="align-middle" style="color:#9d174d;">Ubah Profil</span>
          </a>
        </li>

        <li>
          <div class="d-grid px-2 pt-2 pb-1">
            <a class="btn d-flex justify-content-between align-items-center"
               style="background-color:#db2777; color:#fff;"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();" href="#">
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
  </div>
</nav>

<style>
  .dropdown-menu .dropdown-item:hover {
      background-color: #FBCFE8;
      color: #6B0F42;
  }
</style>
