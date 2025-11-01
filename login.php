<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login - PerpusPintar</title>
  <link href="assets/css/bootstrap.min.css" rel="stylesheet">
  <style>
    /* Pakai style yang sama dengan register */
    body {
      display: flex;
      align-items: center;
      justify-content: center;
      min-height: 100vh;
      background-color: #f8f9fa;
    }
    .form-container {
      max-width: 400px;
      padding: 2rem;
      border-radius: 0.5rem;
      background-color: #fff;
      box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    }
  </style>
</head>
<body>

  <div class="form-container">
    <h3 class="text-center mb-4">Login Akun</h3>
    
    <?php if (isset($_GET['error'])): ?>
      <div class="alert alert-danger" role="alert">
        Username atau password salah!
      </div>
    <?php endif; ?>
    
    <?php if (isset($_GET['success'])): ?>
      <div class="alert alert-success" role="alert">
        Registrasi berhasil! Silakan login.
      </div>
    <?php endif; ?>

    <form action="auth/login_process.php" method="POST">
      <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input type="text" class="form-control" id="username" name="username" required>
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password" required>
      </div>
      <button type="submit" class="btn btn-primary w-100">Login</button>
      <div class="text-center mt-3">
        <p>Belum punya akun? <a href="register.php">Daftar di sini</a></p>
      </div>
    </form>
  </div>

  <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>