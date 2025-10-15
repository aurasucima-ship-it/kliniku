<aside id="layout-menu" class="layout-menu menu-vertical menu">
    <div class="app-brand demo flex items-center justify-between px-4 py-3 border-b" style="border-color:#F9A8D4;">
        <a href="{{ route('home') }}" class="app-brand-link flex items-center gap-2">
            <span class="app-brand-logo demo">
                <img src="{{ asset('img/logo/logoklinik.png') }}" style="width:40px; height:40px;">
            </span>
            <span class="app-brand-text demo menu-text fw-bold text-lg" style="color:#DB2777;">KLINIKU</span>
        </a>
        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="ti menu-toggle-icon d-none d-xl-block align-middle"></i>
            <i class="ti ti-x d-block d-xl-none ti-md align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    @php
        $role = Auth::user()->role;
        $unreadCount = \App\Models\Notification::where('user_id', Auth::id())
                        ->where('is_read', false)
                        ->count();
    @endphp

    <ul class="menu-inner py-1">
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
            <li class="menu-item">
                <a href="{{ route('dokter.notifikasi.index') }}" class="menu-link relative">
                    <i class="menu-icon tf-icons ti ti-bell"></i>
                    Notifikasi
                    @if($unreadCount > 0)
                        <span id="notif-badge-dokter" class="notification-badge">{{ $unreadCount }}</span>
                    @endif
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
            <li class="menu-item {{ request()->routeIs('pasien.notifikasi.*') ? 'active' : '' }}">
                <a href="{{ route('pasien.notifikasi.index') }}" class="menu-link relative">
                    <i class="menu-icon tf-icons ti ti-bell"></i>
                    Notifikasi
                    @if($unreadCount > 0)
                        <span id="notif-badge-pasien" class="notification-badge">{{ $unreadCount }}</span>
                    @endif
                </a>
            </li>
        @endif
    </ul>

    <style>
        #layout-menu { background-color: #FFE4EF; }
        #layout-menu .menu-link { color: #9D174D; font-weight: 500; transition: all 0.2s ease; }
        #layout-menu .menu-item:hover > .menu-link { background-color: #FBCFE8; color: #831843; border-radius: 8px; }
        #layout-menu .menu-item.active > .menu-link { background-color: #F9A8D4; color: #6B0F42; font-weight: 600; border-radius: 8px; }
        #layout-menu .menu-icon { color: #9D174D; }
        #layout-menu .app-brand-text { color: #DB2777 !important; }
        .notification-badge { position: absolute; top: 6px; right: 14px; background-color: #E11D48; color: white; font-size: 11px; font-weight: bold; line-height: 1; padding: 3px 6px; border-radius: 9999px; box-shadow: 0 0 4px rgba(0, 0, 0, 0.15); }
    </style>

    <script>
        setInterval(function() {
            @if($role === 'dokter')
            fetch('/dokter/notifikasi')
                .then(res => res.json())
                .then(data => {
                    let badge = document.getElementById('notif-badge-dokter');
                    if(badge) badge.textContent = data.unread;
                });
            @endif

            @if($role === 'pasien')
            fetch('/pasien/notifikasi')
                .then(res => res.json())
                .then(data => {
                    let badge = document.getElementById('notif-badge-pasien');
                    if(badge) badge.textContent = data.unread;
                });
            @endif
        }, 5000);
    </script>
</aside>
