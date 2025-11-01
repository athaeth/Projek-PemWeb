<?php
// Kita akan gunakan header.php nanti, tapi untuk sekarang kita buat simpel dulu
// session_start(); // Tidak perlu session di halaman register
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Registrasi - PerpusPintar</title>
  <link href="assets/css/bootstrap.min.css" rel="stylesheet">
  <style>
    /* Sedikit style agar form di tengah */
    body {
      display: flex;
      align-items: center;
      justify-content: center;
      min-height: 100vh;
      background-color: #f8f9fa;
    }
    .form-container {
      max-width: 450px;
      padding: 2rem;
      border-radius: 0.5rem;
      background-color: #fff;
      box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    }
  </style>
</head>
<body>

  <div class="form-container">
    <h3 class="text-center mb-4">Buat Akun Baru</h3>
    
    <?php if (isset($_GET['error'])): ?>
      <div class="alert alert-danger" role="alert">
        <?php echo htmlspecialchars($_GET['error']); ?>
      </div>
    <?php endif; ?>

    <form action="auth/register_process.php" method="POST">
      <div class="mb-3">
        <label for="full_name" class="form-label">Nama Lengkap</label>
        <input type="text" class="form-control" id="full_name" name="full_name" required>
      </div>
      <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input type="text" class="form-control" id="username" name="username" required>
      </div>
      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" required>
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password" required>
      </div>
      <button type="submit" class="btn btn-primary w-100">Daftar</button>
      <div class="text-center mt-3">
        <p>Sudah punya akun? <a href="login.php">Login di sini</a></p>
      </div>
    </form>
  </div>

  <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>