<?php
// 1. Panggil file koneksi database
include '../config/db.php'; // (../ karena kita ada di dalam folder auth)

// 2. Pastikan request adalah POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    // 3. Ambil data dari form (dan amankan)
    $full_name = htmlspecialchars($_POST['full_name']);
    $username = htmlspecialchars($_POST['username']);
    $email = htmlspecialchars($_POST['email']);
    $password = $_POST['password']; // Jangan htmlspecialchars password

    // 4. Validasi dasar (bisa kamu kembangkan)
    if (empty($full_name) || empty($username) || empty($email) || empty($password)) {
        header('Location: ../register.php?error=Semua kolom wajib diisi');
        exit;
    }

    // 5. Cek apakah username atau email sudah ada
    try {
        $stmt_check = $db->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
        $stmt_check->execute([$username, $email]);
        if ($stmt_check->fetch()) {
            header('Location: ../register.php?error=Username atau email sudah terdaftar');
            exit;
        }

        // 6. Hash password (SANGAT PENTING!)
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // 7. Masukkan ke database (role default adalah 'user')
        $stmt_insert = $db->prepare("INSERT INTO users (full_name, username, email, password, role) VALUES (?, ?, ?, ?, 'user')");
        $stmt_insert->execute([$full_name, $username, $email, $hashed_password]);

        // 8. Redirect ke halaman login jika berhasil
        header('Location: ../login.php?success=1');
        exit;

    } catch (PDOException $e) {
        // Jika ada error database
        header('Location: ../register.php?error=Terjadi masalah pada database: ' . $e->getMessage());
        exit;
    }

} else {
    // Jika diakses langsung, tendang ke register
    header('Location: ../register.php');
    exit;
}
?>