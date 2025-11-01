<?php
include '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($full_name) || empty($username) || empty($email) || empty($password)) {
        header('Location: ../register.php?error=Semua kolom wajib diisi');
        exit;
    }

    // Cek apakah username atau email sudah ada
    $check_sql = "SELECT id FROM users WHERE username = ? OR email = ?";
    $check_stmt = $db->prepare($check_sql);
    $check_stmt->bind_param("ss", $username, $email);
    $check_stmt->execute();
    $check_result = $check_stmt->get_result();

    if ($check_result->num_rows > 0) {
        header('Location: ../register.php?error=Username atau email sudah terdaftar');
        $check_stmt->close();
        exit;
    }
    $check_stmt->close();
    
    // Hash password (SANGAT PENTING!)
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Masukkan user baru
    $insert_sql = "INSERT INTO users (full_name, username, email, password, role) VALUES (?, ?, ?, ?, 'user')";
    $insert_stmt = $db->prepare($insert_sql);
    
    if ($insert_stmt === false) {
        die("Error preparing statement: " . $db->error);
    }

    $insert_stmt->bind_param("ssss", $full_name, $username, $email, $hashed_password);

    if ($insert_stmt->execute()) {
        header('Location: ../login.php?success=1');
    } else {
        header('Location: ../register.php?error=Terjadi kesalahan saat mendaftar');
    }

    $insert_stmt->close();
    $db->close();

} else {
    header('Location: ../register.php');
    exit;
}
?>
