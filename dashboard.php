<?php
// 1. Panggil header (path-nya harus disesuaikan karena kita ada di dalam folder 'admin')
include '../includes/header.php';

// 2. Panggil skrip pelindung ADMIN
include '../includes/check_admin.php';
?>

<h1>Admin Dashboard</h1>
<p>Selamat datang, Admin <?php echo htmlspecialchars($_SESSION['full_name']); ?>.</p>

<p>Dari sini Anda bisa:</p>
<ul>
    <li><a href="manage_books.php">Mengelola Daftar Buku (CRUD)</a></li>
    <li><a href="manage_users.php">Mengelola Pengguna</a></li>
    <li>Melihat laporan peminjaman</li>
</ul>

<?php
// 3. Panggil footer
include '../includes/footer.php';
?>
