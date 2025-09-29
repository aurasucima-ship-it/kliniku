<!doctype html>
<html
  lang="en"
  class="light-style layout-wide customizer-hide"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="{{ asset('/') }}"
  data-template="vertical-menu-template"
  data-style="light">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Login | KlinikApp</title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('/img/favicon/favicon.ico') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@400;500;600;700&display=swap"
      rel="stylesheet" />

    <!-- Icons -->
    <link rel="stylesheet" href="{{ asset('/vendor/fonts/fontawesome.css') }}" />
    <link rel="stylesheet" href="{{ asset('/vendor/fonts/tabler-icons.css') }}" />
    <link rel="stylesheet" href="{{ asset('/vendor/fonts/flag-icons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('/vendor/css/rtl/core.css') }}" />
    <link rel="stylesheet" href="{{ asset('/vendor/css/rtl/theme-default.css') }}" />
    <link rel="stylesheet" href="{{ asset('/css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('/vendor/libs/node-waves/node-waves.css') }}" />
    <link rel="stylesheet" href="{{ asset('/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('/vendor/libs/typeahead-js/typeahead.css') }}" />
    <link rel="stylesheet" href="{{ asset('/vendor/libs/@form-validation/form-validation.css') }}" />

    <!-- Page CSS -->
    <link rel="stylesheet" href="{{ asset('/vendor/css/pages/page-auth.css') }}" />

    <!-- Helpers -->
    <script src="{{ asset('/vendor/js/helpers.js') }}"></script>
    <script src="{{ asset('/vendor/js/config.js') }}"></script>
  </head>

  <body>
    <div class="container-xxl">
      <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner py-6">
          <!-- Login Card -->
          <div class="card">
            <div class="card-body">

              <!-- Logo -->
              <div class="app-brand justify-content-center mb-6">
                <a href="{{ url('/') }}" class="app-brand-link">
                  <span class="app-brand-logo demo">
                    <!-- bisa ganti svg/logo -->
                    <img src="{{ asset('/img/logo.png') }}" alt="Logo" width="40">
                  </span>
                  <span class="app-brand-text demo text-heading fw-bold">KlinikApp</span>
                </a>
              </div>
              <!-- /Logo -->

              <h4 class="mb-1">Selamat Datang 👋</h4>
              <p class="mb-6">Silakan login untuk melanjutkan.</p>

              <!-- Form Login -->
              <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email -->
                <div class="mb-6">
                  <label for="email" class="form-label">Email</label>
                  <input
                    id="email"
                    type="email"
                    class="form-control @error('email') is-invalid @enderror"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    autocomplete="email"
                    autofocus
                    placeholder="Enter your email" />
                  @error('email')
                    <span class="invalid-feedback d-block">{{ $message }}</span>
                  @enderror
                </div>

                <!-- Password -->
                <div class="mb-6 form-password-toggle">
                  <label class="form-label" for="password">Password</label>
                  <div class="input-group input-group-merge">
                    <input
                      id="password"
                      type="password"
                      class="form-control @error('password') is-invalid @enderror"
                      name="password"
                      required
                      autocomplete="current-password"
                      placeholder="********" />
                    <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                  </div>
                  @error('password')
                    <span class="invalid-feedback d-block">{{ $message }}</span>
                  @enderror
                </div>

                <!-- Remember Me -->
                <div class="my-4 d-flex justify-content-between align-items-center">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember">
                    <label class="form-check-label" for="remember">Ingat saya</label>
                  </div>
                </div>

                <!-- Submit -->
                <div class="mb-6">
                  <button class="btn btn-primary d-grid w-100" type="submit">Login</button>
                </div>
              </form>
              <!-- End Form Login -->

            </div>
          </div>
          <!-- /Login Card -->
        </div>
      </div>
    </div>

    <!-- Core JS -->
    <script src="{{ asset('/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('/vendor/libs/node-waves/node-waves.js') }}"></script>
    <script src="{{ asset('/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('/vendor/libs/typeahead-js/typeahead.js') }}"></script>
    <script src="{{ asset('/vendor/js/menu.js') }}"></script>

    <!-- Vendors JS -->
    <script src="{{ asset('/vendor/libs/@form-validation/popular.js') }}"></script>
    <script src="{{ asset('/vendor/libs/@form-validation/bootstrap5.js') }}"></script>
    <script src="{{ asset('/vendor/libs/@form-validation/auto-focus.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ asset('/js/main.js') }}"></script>
    <script src="{{ asset('/js/pages-auth.js') }}"></script>
  </body>
</html>
