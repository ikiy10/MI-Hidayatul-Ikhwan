<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>MI Hidayatul Ikhwan</title>
  <link rel="icon" href="{{ asset('img/logo.png') }}" type="image/png">
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

  <style>
    body, html {
      height: 100%;
      margin: 0;
      font-family: 'Segoe UI', sans-serif;
      background: url('/img/latar.jpg') no-repeat center center fixed;
      background-size: cover;
    }

    .login-box {
      width: 100%;
      max-width: 400px;
      padding: 30px;
      background: rgba(255, 255, 255, 0.95);
      border-radius: 16px;
      box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    }

    .toggle-password {
      cursor: pointer;
    }

    button.btn {
      background-color: #6366f1;
      font-weight: bold;
    }
  </style>
</head>
<body>

  <div class="container mt-5">
    <!-- NOTIFIKASI ERROR -->
    @if (session('error'))
      <div class="alert alert-danger text-center">
        {{ session('error') }}
      </div>
    @endif
  </div>

  <div class="d-flex justify-content-center align-items-center vh-100">
    <div class="login-box">
      <div class="d-flex justify-content-center align-items-center mb-4">
        <h4 class="mb-0 text-center fw-bold">LOGIN</h4>
      </div>

      <form action="{{ route('login.process') }}" method="POST">
        @csrf

        <div class="mb-3">
          <input type="email" name="email" class="form-control" placeholder="Masukan Username Atau Email" required autofocus />
        </div>

        <div class="mb-3 position-relative">
          <input type="password" name="password" class="form-control" placeholder="Masukan password" id="passwordField" required />
          <span class="position-absolute end-0 top-50 translate-middle-y me-3 toggle-password" onclick="togglePassword()" id="toggleIcon">
            <i class="fa-solid fa-eye-slash"></i>
          </span>
        </div>

        <div class="d-flex justify-content-between align-items-center mb-3">
          <div class="form-check">
            <input class="form-check-input" type="checkbox" name="remember" id="remember" />
            <label class="form-check-label" for="remember">Remember me</label>
          </div>
        </div>

        <button type="submit" class="btn btn-primary w-100">Sign in</button>
      </form>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <!-- Toggle Password Script -->
  <script>
    function togglePassword() {
      const passwordField = document.getElementById("passwordField");
      const icon = document.getElementById("toggleIcon").firstElementChild;

      if (passwordField.type === "password") {
        passwordField.type = "text";
        icon.classList.remove("fa-eye-slash");
        icon.classList.add("fa-eye");
      } else {
        passwordField.type = "password";
        icon.classList.remove("fa-eye");
        icon.classList.add("fa-eye-slash");
      }
    }
  </script>

</body>
</html>
