<?php
require_once(__DIR__ . '/../lib/db_login.php');
$phone_number = $_GET['phone_number'];

// Buat query untuk mengambil pesanan sesuai nomor telepon
$query = "SELECT * FROM orders WHERE phone = '$phone_number'";

// Eksekusi query
$result = $db->query($query);

// Buat respon gagal dan sukses
if (!$result) {
    echo 'Error: ' . $db->error;
} else {
    if ($result->num_rows > 0) {
        // Jika ada pesanan dengan nomor telepon yang diberikan
        echo 'Nomor telepon sudah digunakan';
    } else {
        // Jika tidak ada pesanan dengan nomor telepon yang diberikan
        echo 'Nomor telepon tersedia';
    }
}

$db->close();