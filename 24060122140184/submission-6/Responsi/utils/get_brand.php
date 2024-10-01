<?php
require_once(__DIR__ . '/../lib/db_login.php');

// Buat query untuk mengambil merek mobil
$query = "SELECT brand_code, brand_name FROM brands";

// Eksekusi query
$result = $db->query($query);

// Buat respon gagal dan sukses
if (!$result) {
    // Jika gagal, tampilkan pesan error
    echo '<option value="">Error: ' . $db->error . '</option>';
} else {
    // Jika sukses, buat option untuk select
    while ($row = $result->fetch_assoc()) {
        echo '<option value="' . $row['brand_code'] . '">' . $row['brand_name'] . '</option>';
    }
}

$db->close();