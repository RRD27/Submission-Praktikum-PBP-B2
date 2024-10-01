<?php
session_start();
require_once(__DIR__ . '/../lib/db_login.php');


error_reporting(E_ALL);
ini_set('display_errors', 1);

$name = $db->real_escape_string($_POST['name']);
$phone = $db->real_escape_string($_POST['phone']);
$address = $db->real_escape_string($_POST['address']);
$brand = $db->real_escape_string($_POST['brand']);
$model = $db->real_escape_string($_POST['model']);
$color = $db->real_escape_string($_POST['color']);

// Validate input
if (empty($name) || empty($phone) || empty($address) || empty($brand) || empty($model) || empty($color)) {
    echo json_encode(['status' => 'error', 'message' => 'Isi semua kolom terlebih dahulu']);
    $db->close();
    exit;
}

// Check for duplicates
$duplicateCheckQuery = "SELECT * FROM orders WHERE phone_number = '$phone' OR (name = '$name' AND address = '$address' AND brand_code = '$brand' AND model_code = '$model' AND color = '$color')";
$duplicateCheckResult = $db->query($duplicateCheckQuery);

if ($duplicateCheckResult->num_rows > 0) {
    echo json_encode(['status' => 'error', 'message' => 'Data sudah ada']);
    $db->close();
    exit;
}

// Tulis query untuk insert ke database
$query = "INSERT INTO orders (name, phone_number, address, color, brand_code, model_code) VALUES ('$name', '$phone', '$address', '$color', '$brand', '$model')";

// Eksekusi query. Tangani jika sukses dan gagal
if ($db->query($query) === TRUE) {
    echo json_encode(['status' => 'success']);
} else {
    echo json_encode(['status' => 'error', 'message' => $db->error]);
}

$db->close();
exit;