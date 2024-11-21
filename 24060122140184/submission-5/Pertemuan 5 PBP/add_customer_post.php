<?php
require_once('./lib/db_login.php');

$name = $db->real_escape_string($_POST['name']);
$address = $db->real_escape_string($_POST['address']);
$city = $db->real_escape_string($_POST['city']);

// Assign a query
$query = "INSERT INTO customers (name, address, city) VALUES ('" . $name . "', '" . $address . "', '" . $city . "')";
$result = $db->query($query);

if (!$result) {
    echo '<div class="alert alert-danger alert-dismissible">
            <strong>Error!</strong> Could not query the database<br>'. 
            $db->error. '<br>query='.$query.
        '</div>';
}else{
    echo '<div class="alert alert-success alert-dismissible"> 
            <strong>Success!</strong> Data has been added. <br>
            <!--TODO 1: Panggil data input pengguna name, address, dan city dengan POST -->
            Name: '.$_POST['name'].'<br>
            Address: '.$_POST['address'].'<br>
            City: '.$_POST['city'].'<br>
        </div>';
}

// Close DB Connection
$db->close();

?>