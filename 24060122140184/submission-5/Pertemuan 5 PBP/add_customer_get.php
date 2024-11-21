<?php
    //TODO: Koneksi ke database
    require_once("lib/db_login.php");

    //TODO: Dapatkan nilai inputan form
    $name = $db->real_escape_string($_GET['name']);
    $address = $db->real_escape_string($_GET['address']);
    $city = $db->real_escape_string($_GET['city']);

    //TODO: Buat dan eksekusi query
    
    $query = "INSERT INTO customers (`customerid`, `name`, `address`, `city`) VALUES (NULL, '" . $name . "', '" . $address . "', '" . $city . "')";
    $result = $db->query($query);

    //TODO: Tampilkan alert
    if (!$result) {
        echo '<div class="alert alert-danger alert-dismissible">
        <strong>Error!</strong> Could not query the database<br>'.
        $db->error.'<br>query = ',$query.
        '</div>';
    } else {
        echo '<div class="alert alert-success alert-dismissible">
        <strong>Success!</strong> Data has been edded<br>
        Name: '.$_GET['name'].'<br>
        Address: '.$_GET['address'].'<br>
        City: '.$_GET['city'].'<br>
        </div>';
    }
    
    // TODO: Tutup koneksi database
    $db->close();
?>