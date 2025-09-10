<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
  <div class="app-brand demo">
    <a href="{{ route('home') }}" class="app-brand-link" aria-label="Beranda INKLINIK">
      <span class="app-brand-logo demo" aria-hidden="true">
        <!-- Logo Klinik -->
        <svg width="32" height="32" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg" role="img">
          <title>Logo INKLINIK</title>
          <circle cx="32" cy="32" r="30" fill="#FFFFFF" stroke="#7367F0" stroke-width="4"/>
          <rect x="28" y="16" width="8" height="32" rx="2" fill="#7367F0"/>
          <rect x="16" y="28" width="32" height="8" rx="2" fill="#7367F0"/>
        </svg>
      </span>
      <span class="app-brand-text demo menu-text fw-bold">INKLINIK</span>
    </a>

    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto" aria-label="Toggle menu">
      <i class="ti menu-toggle-icon d-none d-xl-block align-middle"></i>
      <i class="ti ti-x d-block d-xl-none ti-md align-middle"></i>
    </a>
  </div>

  <div class="menu-inner-shadow"></div>

  <ul class="menu-inner py-1">
    <!-- Dashboard -->
    <li class="menu-item {{ request()->routeIs('home') ? 'active' : '' }}">
      <a href="{{ route('home') }}" class="menu-link">
        <i class="menu-icon tf-icons ti ti-home"></i>
        <div>Dashboard</div>
      </a>
    </li>

    {{-- ✅ Menu untuk Admin --}}
    @if(Auth::user()->role === 'admin')
      <li class="menu-item {{ request()->routeIs('pasien.*') ? 'active' : '' }}">
        <a href="{{ route('pasien.index') }}" class="menu-link">
          <i class="menu-icon tf-icons ti ti-users-group"></i>
          <div>Data Pasien</div>
        </a>
      </li>

      <li class="menu-item {{ request()->routeIs('dokter.*') ? 'active' : '' }}">
        <a href="{{ route('dokter.index') }}" class="menu-link">
          <i class="menu-icon tf-icons ti ti-stethoscope"></i>
          <div>Data Dokter</div>
        </a>
      </li>

      <li class="menu-item {{ request()->routeIs('rekam_medis.*') ? 'active' : '' }}">
        <a href="{{ route('rekam_medis.index') }}" class="menu-link">
          <i class="menu-icon tf-icons ti ti-file-text"></i>
          <div>Rekam Medis</div>
        </a>
      </li>
    @endif

    {{-- ✅ Menu untuk Dokter --}}
    @if(Auth::user()->role === 'dokter')
      <li class="menu-item {{ request()->routeIs('pasien.index') ? 'active' : '' }}">
        <a href="{{ route('pasien.index') }}" class="menu-link">
          <i class="menu-icon tf-icons ti ti-users-group"></i>
          <div>Data Pasien</div>
        </a>
      </li>

      <li class="menu-item {{ request()->routeIs('rekam_medis.index') ? 'active' : '' }}">
        <a href="{{ route('rekam_medis.index') }}" class="menu-link">
          <i class="menu-icon tf-icons ti ti-file-text"></i>
          <div>Rekam Medis</div>
        </a>
      </li>
    @endif

    {{-- ✅ Menu untuk Pasien --}}
    @if(Auth::user()->role === 'pasien')
      <li class="menu-item {{ request()->routeIs('pasien.pendaftaran.create') ? 'active' : '' }}">
        <a href="{{ route('pasien.pendaftaran.create') }}" class="menu-link">
          <i class="menu-icon tf-icons ti ti-edit"></i>
          <div>Pendaftaran</div>
        </a>
      </li>

      <li class="menu-item {{ request()->routeIs('pasien.rekam_medis') ? 'active' : '' }}">
        <a href="{{ route('pasien.rekam_medis') }}" class="menu-link">
          <i class="menu-icon tf-icons ti ti-file-text"></i>
          <div>Rekam Medis Saya</div>
        </a>
      </li>
    @endif
  </ul>
</aside>
