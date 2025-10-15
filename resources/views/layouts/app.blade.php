<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
  class="light-style layout-navbar-fixed layout-menu-fixed layout-compact"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="{{ asset('/') }}"
  data-template="vertical-menu-template"
  data-style="light">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') | KLINIKU</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('/img/favicon/favicon.ico') }}" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('/vendor/fonts/fontawesome.css') }}" />
    <link rel="stylesheet" href="{{ asset('/vendor/fonts/tabler-icons.css') }}" />
    <link rel="stylesheet" href="{{ asset('/vendor/fonts/flag-icons.css') }}" />
    <link rel="stylesheet" href="{{ asset('/vendor/css/rtl/core.css') }}" />
    <link rel="stylesheet" href="{{ asset('/vendor/css/rtl/theme-default.css') }}" />
    <link rel="stylesheet" href="{{ asset('/css/demo.css') }}" />
    <link rel="stylesheet" href="{{ asset('/vendor/libs/node-waves/node-waves.css') }}" />
    <link rel="stylesheet" href="{{ asset('/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('/vendor/libs/typeahead-js/typeahead.css') }}" />
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
        .table-pink th {
            background-color: #f9c2d3; 
            color: #db2777; 
        }
        .row-hover-pink:hover {
            background-color: #ffe4ed; 
        }
        .btn-icon-pink {
            display: inline-flex;
            justify-content: center;
            align-items: center;
            width: 36px;
            height: 36px;
            background-color: #db2777;
            color: #fff;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            transition: all 0.2s ease;
        }
        .btn-icon-pink:hover {
            background-color: #e91e63;
            transform: scale(1.1);
        }
        .btn-pink {
            background-color: #db2777;
            color: #fff;
            font-weight: 500;
            transition: all 0.2s ease;
        }
        .btn-pink:hover {
            background-color: #e91e63;
        }
        .text-pink-500 {
            color: #db2777;
        }
    </style>
    <script src="{{ asset('/js/config.js') }}"></script>
    @stack('styles')
</head>

<body>
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            @include('layouts.inc.sidebar')
            <div class="layout-page">
                @include('layouts.inc.navbar')
                <div class="content-wrapper">
                    <div class="container-xxl flex-grow-1 container-p-y">
                        @if (session('success') || session('error'))
                            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                            <script>
                                document.addEventListener('DOMContentLoaded', function () {
                                    @if (session('success'))
                                        Swal.fire({
                                            icon: 'success',
                                            title: '{{ session('success') }}',
                                            showConfirmButton: false,
                                            timer: 1500,
                                            background: '#fbcfe8',
                                            color: '#9d174d'
                                        });
                                    @endif
                                    @if (session('error'))
                                        Swal.fire({
                                            icon: 'error',
                                            title: '{{ session('error') }}',
                                            showConfirmButton: true,
                                            background: '#fbcfe8',
                                            color: '#9d174d'
                                        });
                                    @endif
                                });
                            </script>
                        @endif
                        @yield('content')
                    </div>
                    @include('layouts.inc.footer')
                </div>
            </div>
        </div>
        <div class="layout-overlay layout-menu-toggle"></div>
        <div class="drag-target"></div>
    </div>
    <script src="{{ asset('/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('/vendor/libs/node-waves/node-waves.js') }}"></script>
    <script src="{{ asset('/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('/vendor/libs/hammer/hammer.js') }}"></script>
    <script src="{{ asset('/vendor/libs/i18n/i18n.js') }}"></script>
    <script src="{{ asset('/vendor/libs/typeahead-js/typeahead.js') }}"></script>
    <script src="{{ asset('/vendor/js/menu.js') }}"></script>
    <script src="{{ asset('/js/main.js') }}"></script>
    @stack('scripts')
</body>
</html>
