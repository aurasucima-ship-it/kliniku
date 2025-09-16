<aside id="layout-menu" class="layout-menu menu-vertical menu bg-white border-r border-pink-200 shadow-sm">
  <!-- Brand Klinik -->
  <div class="app-brand demo">
    <a href="{{ route('home') }}" class="app-brand-link d-flex align-items-center gap-2" aria-label="Beranda INKLINIK">
      <!-- Logo Lingkaran Pink + Tanda Plus -->
      <span class="app-brand-logo demo" aria-hidden="true">
        <svg width="36" height="36" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg" role="img">
          <title>Logo INKLINIK</title>
          <circle cx="32" cy="32" r="30" fill="#EC4899" stroke="#EC4899" stroke-width="4"/>
          <rect x="28" y="16" width="8" height="32" rx="2" fill="#FFFFFF"/>
          <rect x="16" y="28" width="32" height="8" rx="2" fill="#FFFFFF"/>
        </svg>
      </span>
      <span class="app-brand-text fw-bold text-pink-600" style="font-family: 'Poppins', sans-serif;">KLINIKU</span>
    </a>

    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto" aria-label="Toggle menu">
      <i class="ti menu-toggle-icon d-none d-xl-block align-middle"></i>
      <i class="ti ti-x d-block d-xl-none ti-md align-middle"></i>
    </a>
  </div>

  <div class="menu-inner-shadow"></div>

  <!-- Menu Items -->
  <ul class="menu-inner py-1">
    <!-- Dashboard -->
    <li class="menu-item {{ request()->routeIs('home') ? 'active' : '' }}">
      <a href="{{ route('home') }}" class="menu-link text-pink-500 hover:text-pink-700 focus:text-pink-700">
        <i class="menu-icon tf-icons ti ti-home text-pink-500"></i>
        <div>Dashboard</div>
      </a>
    </li>

    {{-- Admin Menu --}}
    @if(Auth::user()->role === 'admin')
      <li class="menu-item {{ request()->routeIs('pasien.*') ? 'active' : '' }}">
        <a href="{{ route('pasien.index') }}" class="menu-link text-pink-500 hover:text-pink-700 focus:text-pink-700">
          <i class="menu-icon tf-icons ti ti-users-group text-pink-500"></i>
          <div>Data Pasien</div>
        </a>
      </li>

      <li class="menu-item {{ request()->routeIs('dokter.*') ? 'active' : '' }}">
        <a href="{{ route('dokter.index') }}" class="menu-link text-pink-500 hover:text-pink-700 focus:text-pink-700">
          <i class="menu-icon tf-icons ti ti-stethoscope text-pink-500"></i>
          <div>Data Dokter</div>
        </a>
      </li>

      <li class="menu-item {{ request()->routeIs('rekam_medis.*') ? 'active' : '' }}">
        <a href="{{ route('rekam_medis.index') }}" class="menu-link text-pink-500 hover:text-pink-700 focus:text-pink-700">
          <i class="menu-icon tf-icons ti ti-file-text text-pink-500"></i>
          <div>Rekam Medis</div>
        </a>
      </li>
    @endif

    {{-- Dokter Menu --}}
    @if(Auth::user()->role === 'dokter')
      <li class="menu-item {{ request()->routeIs('pasien.index') ? 'active' : '' }}">
        <a href="{{ route('pasien.index') }}" class="menu-link text-pink-500 hover:text-pink-700 focus:text-pink-700">
          <i class="menu-icon tf-icons ti ti-users-group text-pink-500"></i>
          <div>Data Pasien</div>
        </a>
      </li>

      <li class="menu-item {{ request()->routeIs('rekam_medis.index') ? 'active' : '' }}">
        <a href="{{ route('rekam_medis.index') }}" class="menu-link text-pink-500 hover:text-pink-700 focus:text-pink-700">
          <i class="menu-icon tf-icons ti ti-file-text text-pink-500"></i>
          <div>Rekam Medis</div>
        </a>
      </li>
    @endif

    {{-- Pasien Menu --}}
    @if(Auth::user()->role === 'pasien')
      <li class="menu-item {{ request()->routeIs('pasien.pendaftaran.create') ? 'active' : '' }}">
        <a href="{{ route('pasien.pendaftaran.create') }}" class="menu-link text-pink-500 hover:text-pink-700 focus:text-pink-700">
          <i class="menu-icon tf-icons ti ti-edit text-pink-500"></i>
          <div>Pendaftaran</div>
        </a>
      </li>

      <li class="menu-item {{ request()->routeIs('pasien.rekam_medis') ? 'active' : '' }}">
        <a href="{{ route('pasien.rekam_medis') }}" class="menu-link text-pink-500 hover:text-pink-700 focus:text-pink-700">
          <i class="menu-icon tf-icons ti ti-file-text text-pink-500"></i>
          <div>Rekam Medis Saya</div>
        </a>
      </li>
    @endif
  </ul>
</aside>

<style>
  /* Hapus highlight biru default saat klik/fokus */
  #layout-menu .menu-link:focus,
  #layout-menu .menu-link:active {
    outline: none;
    background-color: #ffe4ec; /* soft pink hover/fokus */
    color: #be185d !important;
  }

  #layout-menu .menu-item.active > .menu-link {
    background-color: #f472b6;
    color: #fff !important;
  }

  #layout-menu .menu-item .menu-link:hover {
    background-color: #fce7f3;
    color: #be185d !important;
  }
</style>
