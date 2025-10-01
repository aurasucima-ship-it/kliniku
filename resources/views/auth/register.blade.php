<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register | KLINIKU</title>

  <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

  <style>
    body {
      background: linear-gradient(135deg, #fce4ec, #f8bbd0);
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      font-family: 'Public Sans', sans-serif;
    }

    .register-card {
      width: 100%;
      max-width: 420px;
      background: #fff;
      border-radius: 20px;
      padding: 2.5rem 2rem;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
      text-align: center;
    }

    .register-card img {
      width: 120px;
      border-radius: 15px;
      margin-bottom: 15px;
    }

    .register-card h2 {
      color: #e91e63;
      font-weight: bold;
      margin-bottom: 5px;
    }

    .register-card p {
      color: #555;
      margin-bottom: 20px;
      font-size: 0.95rem;
    }

    .register-card input {
      width: 100%;
      padding: 0.65rem 0.8rem;
      border: 1px solid #f8bbd0;
      border-radius: 10px;
      margin-bottom: 15px;
      font-size: 0.95rem;
    }

    .register-card input:focus {
      border-color: #e91e63;
      outline: none;
      box-shadow: 0 0 0 0.2rem rgba(233, 30, 99, 0.25);
    }

    .btn-register {
      width: 60%;
      padding: 0.55rem;
      background: #e91e63;
      border: none;
      border-radius: 10px;
      color: #fff;
      font-weight: bold;
      cursor: pointer;
      font-size: 0.95rem;
      transition: 0.3s;
    }

    .btn-register:hover {
      background: #d81b60;
    }

    .link-login {
      margin-top: 15px;
      font-size: 0.9rem;
      color: #555;
    }

    .link-login a {
      color: #e91e63;
      font-weight: 600;
      text-decoration: none;
      transition: 0.2s;
    }

    .link-login a:hover {
      text-decoration: underline;
    }
  </style>
</head>

<body>

  <div class="register-card">

    <img src="{{ asset('img/logo/logoklinik.JPEG') }}" alt="Logo KLINIKU">

    <h2>KLINIKU</h2>
    <p>Silakan daftar untuk membuat akun pasien</p>

    <form method="POST" action="{{ route('register') }}">
      @csrf

      <input type="text" name="name" placeholder="Nama Lengkap" value="{{ old('name') }}" required autofocus>
      @error('name')
      <div style="color:red;font-size:0.85rem;">{{ $message }}</div>
      @enderror

      <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
      @error('email')
      <div style="color:red;font-size:0.85rem;">{{ $message }}</div>
      @enderror

      <input type="password" name="password" placeholder="Password" required>
      @error('password')
      <div style="color:red;font-size:0.85rem;">{{ $message }}</div>
      @enderror

      <input type="password" name="password_confirmation" placeholder="Konfirmasi Password" required>

      <button type="submit" class="btn-register">Register</button>
    </form>

    <div class="link-login">
      Sudah punya akun? <a href="{{ route('login') }}">Login di sini</a>
    </div>
  </div>

</body>
</html>
