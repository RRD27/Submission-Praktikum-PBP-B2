<?php
    // TODO : Koneksi ke basis data
    require_once('lib/db_login.php'); // Pastikan Anda menghubungkan ke database dengan benar

    // TODO : Mendapatkan judul buku dari request
    $title = isset($_GET['title']) ? $db->real_escape_string($_GET['title']) : '';

    // TODO : Membuat dan mengeksekusi query untuk memperoleh data buku yang dicari
    $query = "SELECT * FROM books WHERE title LIKE '%$title%'";

    $result = $db->query($query);

    // TODO : Cek apakah eksekusi query gagal atau berhasil
    if (!$result) {
        die("Could not query the database: <br>" . $db->error);
    }

    // TODO : Tampilkan data buku yang dicari dalam bentuk tabel
    if ($result->num_rows > 0) {
        echo '<table class="table table-striped">';
        echo '<tr><th>ISBN</th><th>Author</th><th>Title</th><th>Price</th></tr>';

        while ($row = $result->fetch_object()) {
            echo '<tr>';
            echo '<td>' . $row->isbn . '</td>';
            echo '<td>' . $row->author . '</td>';
            echo '<td>' . $row->title . '</td>';
            echo '<td>$' . number_format($row->price, 2) . '</td>';
            echo '</tr>';
        }

        echo '</table>';
    } else {
        echo 'No books found for the given title.';
    }

    // TODO : bebaskan $result dari memory dan tutup koneksi database
    $result->free();
    $db->close();
    ?>