<?php include('./header.php') ?>
<div class="row w-50 mx-auto mt-5">
    <div class="col">
        <div class="card">
            <div class="card-header">Show Customer Data</div>
            <div class="card-body">
                <!-- TODO 2: menampilkan dropdown list data customer dengan fungsi yang dipanggil dari ajax -->
                <select name="customer" id="customer" class="form-select" onchange="showCustomer(this.value)">
                    <option value="">-- Select a Customer --</option>
                    <?php
                    //TODO : Koneksi ke basisdata
                    require_once('lib/db_login.php');

                    //TODO : Buat dan eksekusi Query untuk mengambil data customer
                    $query = "SELECT * FROM customers ORDER BY customerid";
                    $result = $db->query($query);

                    //TODO : Hentikan program jika eksekusi query tidak berhasil dan tampilkan error
                    if (!$result) {
                        die("Could not query the database: <br/>".$db->error);
                    }

                    //TODO : Menampilkan hasil result ke elemen option 
                    while ($row = $result->fetch_object()) {
                        echo '<option value="'.$row->customerid.'">'. $row->name.'</option>';
                    }

                    //TODO : bebaskan $result dari memory dan tutup koneksi database 
                    $result->free();
                    $db->close();

                    ?>
                </select>
                <br>
                <div id="detail_customer"></div>
            </div>
        </div>
    </div>
</div>
<!-- // TODO 1: include file footer.php -->
<?php include('./footer.php') ?>