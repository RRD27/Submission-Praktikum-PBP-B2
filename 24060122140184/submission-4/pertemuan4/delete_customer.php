<?php
// File: delete_customer.php
// Deskripsi: Menghapus data customer berdasarkan customerid

// Aktifkan error reporting untuk debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include file koneksi database
require_once('lib/db_login.php'); // pastikan path ke file koneksi benar

// Cek apakah customerid dikirimkan via URL
if (isset($_GET['id'])) {
    $customerid = intval($_GET['id']);  // Pastikan id dalam bentuk integer

    // Persiapkan query untuk menghapus customer berdasarkan customerid
    $query = "DELETE FROM customers WHERE customerid = ?";

    // Siapkan statement menggunakan prepared statement untuk mencegah SQL Injection
    if ($stmt = $db->prepare($query)) {
        // Bind parameter (customerid) ke query
        $stmt->bind_param("i", $customerid);

        // Eksekusi query
        if ($stmt->execute()) {
            // Jika berhasil, redirect kembali ke halaman view_customer.php
            header("Location: view_customer.php?msg=deleted");
            exit();
        } else {
            // Tampilkan pesan error jika eksekusi gagal
            echo "Error executing query: (" . $stmt->errno . ") " . $stmt->error;
        }

        // Tutup statement
        $stmt->close();
    } else {
        // Tampilkan pesan error jika query gagal dipersiapkan
        echo "Error preparing query: (" . $db->errno . ") " . $db->error;
    }

    // Tutup koneksi database
    $db->close();
} else {
    // Jika id tidak ditemukan di URL, redirect kembali ke halaman view_customer.php
    header("Location: view_customer.php?msg=noid");
    exit();
}
