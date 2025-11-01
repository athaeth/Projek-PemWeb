<?php
require_once 'includes/check_auth.php';
require_once 'config/db.php';
require_once 'includes/header.php';
?>

<div class="p-3 mb-4 bg-light rounded-3">
    <div class="container-fluid py-3">
        <h1 class="display-5 fw-bold">Selamat Datang di PerpusPintar!</h1>
        <p class="col-md-8 fs-5">Temukan dan pinjam buku favoritmu dengan mudah.</p>
    </div>
</div>

<h3 class="mb-3">Koleksi Buku Kami</h3>

<div class="row">
    <?php
    // --- Versi MySQLi ---
    
    // 1. Buat query SQL
    $sql = "SELECT id, title, author, cover_image, stock, category FROM books ORDER BY title ASC";
    
    // 2. Eksekusi query menggunakan objek $db
    $result = $db->query($sql);

    // 3. Cek apakah query berhasil dan ada datanya
    if ($result && $result->num_rows > 0) {
        
        // 4. Looping untuk menampilkan setiap buku
        //    $result->fetch_assoc() akan mengambil satu baris data sebagai array
        while ($book = $result->fetch_assoc()) {
    ?>
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                <div class="card h-100 shadow-sm">
                    <img src="assets/img/<?php echo !empty($book['cover_image']) ? htmlspecialchars($book['cover_image']) : 'default_cover.jpg'; ?>" class="card-img-top" alt="<?php echo htmlspecialchars($book['title']); ?>" style="height: 250px; object-fit: cover;">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title"><?php echo htmlspecialchars($book['title']); ?></h5>
                        <p class="card-text text-muted small"><?php echo htmlspecialchars($book['author']); ?></p>
                        <span class="badge bg-secondary align-self-start mb-2"><?php echo htmlspecialchars($book['category']); ?></span>
                        
                        <div class="mt-auto">
                            <a href="#" class="btn btn-primary w-100">Lihat Detail</a>
                        </div>
                    </div>
                </div>
            </div>
    <?php
        } // Akhir while loop
        
        // 5. Bebaskan memori hasil query (best practice)
        $result->free();

    } else if ($result) {
        // Jika query berhasil tapi tidak ada buku
        echo '<div class="col-12"><div class="alert alert-warning">Belum ada buku yang tersedia saat ini.</div></div>';
    } else {
        // Jika query gagal (ada error di $sql)
        echo '<div class="col-12"><div class="alert alert-danger">Gagal mengambil data buku: ' . $db->error . '</div></div>';
    }
    
    // 6. Tutup koneksi database (best practice, walau PHP otomatis menutup di akhir script)
    // $db->close(); 
    // Sebaiknya jangan ditutup di sini jika footer.php mungkin perlu koneksi
    ?>
</div>

<?php
require_once 'includes/footer.php';
?>
