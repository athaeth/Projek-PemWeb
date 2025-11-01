<?php
session_start();

include '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $username = $_POST['username'];
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {
        header('Location: ../login.php?error=1');
        exit;
    }

    $sql = "SELECT id, username, password, full_name, role FROM users WHERE username = ?";
    
    $stmt = $db->prepare($sql);
    
    if ($stmt === false) {
        die("Error preparing statement: ". $db->error);
    }

    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        
        if (password_verify($password, $user['password'])) {
            
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['full_name'] = $user['full_name'];
            $_SESSION['role'] = $user['role'];

            // PERBAIKAN: Tutup koneksi SEBELUM redirect
            $stmt->close();
            $db->close();

            if ($user['role'] == 'admin') {
                header('Location: ../admin/dashboard.php');
            } else {
                header('Location: ../index.php');
            }
            exit;

        } else {
            // PERBAIKAN: Tutup koneksi SEBELUM redirect
            $stmt->close();
            $db->close();
            header('Location: ../login.php?error=1');
            exit;
        }
    } else {
        // PERBAIKAN: Tutup koneksi SEBELUM redirect
        $stmt->close();
        $db->close();
        header('Location: ../login.php?error=1');
        exit;
    }
    
    // Kita hapus kode yang error kuning dari sini

} else {
    header('Location: ../login.php');
    exit;
}
?>
