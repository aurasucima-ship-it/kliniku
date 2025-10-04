<aside id="layout-menu" class="layout-menu menu-vertical menu" style="background-color:#FCE7F3;">

  <div class="app-brand demo flex items-center justify-between px-4 py-3 border-b">
    <a href="{{ route('home') }}" class="app-brand-link flex items-center gap-2">
      <span class="app-brand-logo demo">
<img src="{{ asset('img/logo/logoklinik.png') }}" style="width:40px; height:40px;">


      </span>
      <span class="app-brand-text demo menu-text fw-bold text-lg text-pink-600">KLINIKU</span>
    </a>
    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
      <i class="ti menu-toggle-icon d-none d-xl-block align-middle"></i>
      <i class="ti ti-x d-block d-xl-none ti-md align-middle"></i>
    </a>
  </div>

  <div class="menu-inner-shadow"></div>

  <ul class="menu-inner py-1">
    @php $role = Auth::user()->role; @endphp

    <li class="menu-item {{ request()->routeIs('home') ? 'active' : '' }}">
      <a href="{{ route('home') }}" class="menu-link">
        <i class="menu-icon tf-icons ti ti-home"></i>
        Dashboard
      </a>
    </li>

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

    @if($role === 'pasien')
      <li class="menu-item {{ request()->routeIs('pasien.pendaftaran.*') ? 'active' : '' }}">
        <a href="{{ route('pasien.pendaftaran.index') }}" class="menu-link">
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

  <style>
    #layout-menu {
      background-color: #FCE7F3;
    }
    #layout-menu .menu-link {
      color: #9d174d;
    }
    #layout-menu .menu-item:hover > .menu-link {
      background-color: #FBCFE8;
      color: #831843;
    }
    #layout-menu .menu-item.active > .menu-link {
      background-color: #F9A8D4;
      color: #6B0F42;
      font-weight: 600;
    }
    #layout-menu .app-brand-text {
      color: #db2777 !important;
    }
  </style>
</aside>
