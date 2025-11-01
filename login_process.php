<?php
// 1. Mulai SESSION di baris paling atas!
session_start();

// 2. Panggil file koneksi database
include '../config/db.php';

// 3. Pastikan request adalah POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // 4. Ambil data dari form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // 5. Validasi dasar
    if (empty($username) || empty($password)) {
        header('Location: ../login.php?error=1');
        exit;
    }

    try {
        // 6. Cari user di database berdasarkan username
        $stmt = $db->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // 7. Verifikasi user dan password
        // $user -> Cek apakah usernya ada
        // password_verify(...) -> Cek apakah password yang diinput sama dengan hash di DB
        
        if ($user && password_verify($password, $user['password'])) {
            // Jika login berhasil!
            
            // 8. Simpan data user ke SESSION
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['full_name'] = $user['full_name'];
            $_SESSION['role'] = $user['role']; // Ini penting untuk bedakan admin/user

            // 9. Redirect berdasarkan ROLE
            if ($user['role'] == 'admin') {
                header('Location: ../admin/dashboard.php'); // Arahkan admin ke dashboard admin
            } else {
                header('Location: ../index.php'); // Arahkan user biasa ke index
            }
            exit;

        } else {
            // Jika user tidak ditemukan atau password salah
            header('Location: ../login.php?error=1');
            exit;
        }

    } catch (PDOException $e) {
        // Error database
        header('Location: ../login.php?error=db');
        exit;
    }

} else {
    // Jika diakses langsung, tendang ke login
    header('Location: ../login.php');
    exit;
}
?>