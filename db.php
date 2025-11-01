<?php

$host = '127.0.0.1';
$username = 'root';
$password = '';
$db_name = 'projekperpustakaan';

$db = new mysqli($host, $username, $password, $db_name);

if ($db->connect_error) {
    die("Koneksi database gagal: " . $db->connect_error);
}

$db->set_charset("utf8mb4");

?>
