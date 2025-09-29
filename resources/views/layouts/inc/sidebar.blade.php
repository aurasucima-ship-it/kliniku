<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">

  <!-- Logo & Brand -->
  <div class="app-brand demo flex items-center justify-between px-4 py-3 border-b">
    <a href="{{ route('home') }}" class="app-brand-link flex items-center gap-2">
      <span class="app-brand-logo demo">
        <svg width="32" height="22" viewBox="0 0 32 22" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd" clip-rule="evenodd"
            d="M0.00172773 0V6.85398C0.00172773 6.85398 -0.133178 9.01207 1.98092 10.8388L13.6912 21.9964L19.7809 21.9181L18.8042 9.88248L16.4951 7.17289L9.23799 0H0.00172773Z"
            fill="#ec4899" />
          <path fill-rule="evenodd" clip-rule="evenodd"
            d="M7.77295 16.3566L23.6563 0H32V6.88383C32 6.88383 31.8262 9.17836 30.6591 10.4057L19.7824 22H13.6938L7.77295 16.3566Z"
            fill="#db2777" />
        </svg>
      </span>
      <span class="app-brand-text demo menu-text fw-bold text-pink-600 text-lg">KLINIKU</span>
    </a>

    <!-- Toggle -->
    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
      <i class="ti menu-toggle-icon d-none d-xl-block align-middle"></i>
      <i class="ti ti-x d-block d-xl-none ti-md align-middle"></i>
    </a>
  </div>

  <div class="menu-inner-shadow"></div>

  <!-- Menu Items -->
  <ul class="menu-inner py-1">

    <!-- Dashboard -->
    <li class="menu-item {{ request()->routeIs('home') ? 'active' : '' }}">
      <a href="{{ route('home') }}" class="menu-link">
        <i class="menu-icon tf-icons ti ti-home"></i>
        Dashboard
      </a>
    </li>

    @php $role = Auth::user()->role; @endphp

    {{-- Admin Menu --}}
    @if($role === 'admin')
      <li class="menu-item {{ request()->routeIs('admin.pasien.*') ? 'active' : '' }}">
        <a href="{{ route('admin.pasien.index') }}" class="menu-link">
          <i class="menu-icon tf-icons ti ti-user"></i>
          Data Pasien
        </a>
      </li>
      <li class="menu-item {{ request()->routeIs('admin.dokter.*') ? 'active' : '' }}">
        <a href="{{ route('admin.dokter.index') }}" class="menu-link">
          <i class="menu-icon tf-icons ti ti-stethoscope"></i>
          Data Dokter
        </a>
      </li>
      <li class="menu-item {{ request()->routeIs('admin.rekam_medis.*') ? 'active' : '' }}">
        <a href="{{ route('admin.rekam_medis.index') }}" class="menu-link">
          <i class="menu-icon tf-icons ti ti-file-text"></i>
          Rekam Medis
        </a>
      </li>
      <li class="menu-item {{ request()->routeIs('admin.pembayaran.*') ? 'active' : '' }}">
        <a href="{{ route('admin.pembayaran.index') }}" class="menu-link">
          <i class="menu-icon tf-icons ti ti-credit-card"></i>
          Daftar Pembayaran
        </a>
      </li>
    @endif

    {{-- Dokter Menu --}}
    @if($role === 'dokter')
      <li class="menu-item {{ request()->routeIs('dokter.pasien.*') ? 'active' : '' }}">
        <a href="{{ route('dokter.pasien.index') }}" class="menu-link">
          <i class="menu-icon tf-icons ti ti-user"></i>
          Data Pasien
        </a>
      </li>
      <li class="menu-item {{ request()->routeIs('dokter.rekam_medis.*') ? 'active' : '' }}">
        <a href="{{ route('dokter.rekam_medis.index') }}" class="menu-link">
          <i class="menu-icon tf-icons ti ti-file-text"></i>
          Rekam Medis Pasien
        </a>
      </li>
      <li class="menu-item {{ request()->routeIs('dokter.pembayaran.*') ? 'active' : '' }}">
        <a href="{{ route('dokter.pembayaran.index') }}" class="menu-link">
          <i class="menu-icon tf-icons ti ti-credit-card"></i>
          Pembayaran Pasien
        </a>
      </li>
    @endif

    {{-- Pasien Menu --}}
    @if($role === 'pasien')
      <li class="menu-item {{ request()->routeIs('pasien.pendaftaran.*') ? 'active' : '' }}">
        <a href="{{ route('pasien.pendaftaran.create') }}" class="menu-link">
          <i class="menu-icon tf-icons ti ti-user"></i>
          Data Saya
        </a>
      </li>
      <li class="menu-item {{ request()->routeIs('pasien.rekam_medis.*') ? 'active' : '' }}">
        <a href="{{ route('pasien.rekam_medis.index') }}" class="menu-link">
          <i class="menu-icon tf-icons ti ti-file-text"></i>
          Rekam Medis Saya
        </a>
      </li>
      <li class="menu-item {{ request()->routeIs('pasien.pembayaran.*') ? 'active' : '' }}">
        <a href="{{ route('pasien.pembayaran.index') }}" class="menu-link">
          <i class="menu-icon tf-icons ti ti-credit-card"></i>
          Tagihan / Pembayaran
        </a>
      </li>
    @endif

  </ul>
</aside>
