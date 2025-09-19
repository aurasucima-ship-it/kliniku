<!doctype html>
<html lang="en"
      class="light-style layout-navbar-fixed layout-menu-fixed layout-compact"
      dir="ltr"
      data-theme="theme-default"
      data-assets-path="{{ asset('/') }}"
      data-template="vertical-menu-template"
      data-style="light">

<head>
  <meta charset="utf-8" />
  <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

  <title>@yield('title', 'Klinik App')</title>

  <!-- Favicon -->
  <link rel="icon" type="image/x-icon" href="{{ asset('/img/favicon/favicon.ico') }}" />

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet" />

  <!-- Icons -->
  <link rel="stylesheet" href="{{ asset('/vendor/fonts/fontawesome.css') }}" />
  <link rel="stylesheet" href="{{ asset('/vendor/fonts/tabler-icons.css') }}" />
  <link rel="stylesheet" href="{{ asset('/vendor/fonts/flag-icons.css') }}" />

  <!-- Core CSS -->
  <link rel="stylesheet" href="{{ asset('/vendor/css/rtl/core.css') }}" class="template-customizer-core-css" />
  <link rel="stylesheet" href="{{ asset('/vendor/css/rtl/theme-default.css') }}" class="template-customizer-theme-css" />
  <link rel="stylesheet" href="{{ asset('/css/demo.css') }}" />

  <!-- Vendors CSS -->
  <link rel="stylesheet" href="{{ asset('/vendor/libs/node-waves/node-waves.css') }}" />
  <link rel="stylesheet" href="{{ asset('/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
  <link rel="stylesheet" href="{{ asset('/vendor/libs/typeahead-js/typeahead.css') }}" />

  <!-- Laravel Vite -->
  @vite(['resources/css/app.css', 'resources/js/app.js'])

  <!-- Config JS -->
  <script src="{{ asset('/js/config.js') }}"></script>

  <!-- Custom Pink Theme -->
  <style>
    body { font-family: 'Poppins', sans-serif; }

    .card-pink { border: 1px solid #f9a8d4 !important; background: #fff !important; }
    .card-header.custom-pink { color: #db2777 !important; font-weight: 600; }

    .btn-pink { background-color: #ec4899 !important; color: #fff !important; border: none; }
    .btn-pink:hover { background-color: #db2777 !important; }

    .table { background-color: #ffffff !important; }
    .table thead { background-color: #fce7f3 !important; color: #db2777 !important; font-weight: 600; }
    .table tbody tr:hover { background-color: #fdf2f8 !important; }

    .btn-icon-pink { background: transparent; border: none; color: #ec4899; cursor: pointer; font-size: 1.2rem; }
    .btn-icon-pink:hover { color: #be185d; }

    /* Flash toast */
    .flash-toast {
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      z-index: 9999;
      width: 360px;
      text-align: center;
      opacity: 1;
      transition: opacity 0.5s ease;
    }

    .toast-box {
      padding: 1.2rem 1.5rem;
      border-radius: 0.75rem;
      font-size: 1rem;
      font-weight: 500;
      background: #fce7f3;
      color: #db2777;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }
  </style>

  @stack('styles')
</head>

<body>
  <div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">

      <!-- Sidebar -->
      @include('layouts.inc.sidebar')
      <!-- / Sidebar -->

      <!-- Layout container -->
      <div class="layout-page">

        <!-- Navbar -->
        @include('layouts.inc.navbar')
        <!-- / Navbar -->

        <!-- Content wrapper -->
        <div class="content-wrapper">
          <div class="container-xxl flex-grow-1 container-p-y">

            {{-- Flash success --}}
            @if(session('success'))
              <div class="flash-toast" id="flashToastSuccess">
                <div class="toast-box">
                  <i class="fas fa-check-circle mb-2" style="font-size:1.8rem; display:block;"></i>
                  <div>{{ session('success') }}</div>
                </div>
              </div>
            @endif

            @yield('content')
          </div>

          <!-- Footer -->
          @include('layouts.inc.footer')
          <!-- / Footer -->

          <div class="content-backdrop fade"></div>
        </div>
      </div>
    </div>

    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>
    <div class="drag-target"></div>
  </div>

  <!-- Core JS -->
  <script src="{{ asset('/vendor/libs/jquery/jquery.js') }}"></script>
  <script src="{{ asset('/vendor/libs/popper/popper.js') }}"></script>
  <script src="{{ asset('/vendor/js/bootstrap.js') }}"></script>
  <script src="{{ asset('/vendor/libs/node-waves/node-waves.js') }}"></script>
  <script src="{{ asset('/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
  <script src="{{ asset('/vendor/libs/hammer/hammer.js') }}"></script>
  <script src="{{ asset('/vendor/libs/i18n/i18n.js') }}"></script>
  <script src="{{ asset('/vendor/libs/typeahead-js/typeahead.js') }}"></script>
  <script src="{{ asset('/vendor/js/menu.js') }}"></script>

  <!-- Main JS -->
  <script src="{{ asset('/js/main.js') }}"></script>

  <!-- SweetAlert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!-- Flash toast auto hide + Delete confirmation -->
  <script>
    document.addEventListener("DOMContentLoaded", function () {
      // Auto hide flash toast
      const toast = document.getElementById("flashToastSuccess");
      if(toast) {
        setTimeout(() => {
          toast.style.opacity = "0";
          setTimeout(() => toast.remove(), 500);
        }, 2000);
      }

      // Konfirmasi hapus untuk semua tombol .btn-delete
      const deleteButtons = document.querySelectorAll(".btn-delete");
      deleteButtons.forEach(btn => {
        btn.addEventListener("click", function(e) {
          e.preventDefault();
          Swal.fire({
            title: 'Yakin mau hapus?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
          }).then((result) => {
            if(result.isConfirmed) {
              this.closest('form').submit();
            }
          });
        });
      });
    });
  </script>

  @stack('scripts')
</body>
</html>
