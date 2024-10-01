<?php
require_once(__DIR__ . '/../lib/db_login.php');
$brand_code = $_GET['brand_code'];

// Buat query untuk mengambil model mobil berdasarkan merek
$query = "SELECT model_code, model_name FROM models WHERE brand_code = '$brand_code'";

// Eksekusi query
$result = $db->query($query);

// Buat respon gagal dan sukses
if (!$result) {
    // Jika gagal, tampilkan pesan error
    echo '<option value="">Error: ' . $db->error . '</option>';
} else {
    // Jika sukses, buat option untuk select
    while ($row = $result->fetch_assoc()) {
        echo '<option value="' . $row['model_code'] . '">' . $row['model_name'] . '</option>';
    }
}

$db->close();