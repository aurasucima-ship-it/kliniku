<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login | KLINIKU</title>

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

    .login-card {
      width: 100%;
      max-width: 400px;
      background: #fff;
      border-radius: 20px;
      padding: 2.5rem 2rem;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
      text-align: center;
    }

    .login-card img {
      width: 120px;
      border-radius: 15px;
      margin-bottom: 15px;
    }

    .login-card h2 {
      color: #e91e63;
      font-weight: bold;
      margin-bottom: 5px;
    }

    .login-card p {
      color: #555;
      margin-bottom: 20px;
      font-size: 0.95rem;
    }

    .login-card input {
      width: 100%;
      padding: 0.65rem 0.8rem;
      border: 1px solid #f8bbd0;
      border-radius: 10px;
      margin-bottom: 15px;
      font-size: 0.95rem;
    }

    .login-card input:focus {
      border-color: #e91e63;
      outline: none;
      box-shadow: 0 0 0 0.2rem rgba(233, 30, 99, 0.25);
    }

    .btn-login {
      width: 50%;
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

    .btn-login:hover {
      background: #d81b60;
    }

    .form-check-label {
      color: #e91e63;
      font-size: 0.9rem;
    }
  </style>
</head>

<body>

  <div class="login-card">
    <img src="{{ asset('img/logo/logoklinik.JPEG') }}" alt="Logo KLINIKU">

    <h2>KLINIKU</h2>
    <p>Silakan login untuk melanjutkan</p>

    <form method="POST" action="{{ route('login') }}">
      @csrf

      <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required autofocus>
      @error('email')
      <div style="color:red;font-size:0.85rem;">{{ $message }}</div>
      @enderror

      <input type="password" name="password" placeholder="Password" required>
      @error('password')
      <div style="color:red;font-size:0.85rem;">{{ $message }}</div>
      @enderror

<div style="margin-bottom:15px; display:flex; align-items:center; gap:8px;">
  <input type="checkbox" id="remember" name="remember" style="width:18px; height:18px; accent-color:#e91e63; cursor:pointer;">
  <label for="remember" style="cursor:pointer; color:#e91e63; font-weight:500; font-size:0.95rem;">
    Ingat saya 
  </label>
</div>


      <button type="submit" class="btn-login">Login</button>
    </form>
  </div>

</body>
</html>
