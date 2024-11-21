<?php
// TODO : Koneksi ke basis data
require_once('lib/db_login.php');

//TODO : Mendapatkan id customer
$customerid = $_GET['id'];

//TODO : Membuat dan mengeksekusi query untuk memperoleh data customer yang dipilih
$query = "SELECT * FROM customers WHERE customerid=". $customerid;
$result = $db->query($query);

//TODO : Cek apakah eksekusi query gagal atau berhasil
if (!$result) {
    die ("Could not query the database: <br/>". $db->error);
}

//TODO : Tampilkan data customer dengan perulangan while
while ($row = $result->fetch_object()) {
    echo 'Name: '.$row->name.'<br/>';
    echo 'Address: '.$row->address.'<br/>';
    echo 'City: '.$row->city.'<br/>';
}

//TODO : bebaskan $result dari memory dan tutup koneksi database
$result->free();
$db->close();
?>