<?php

require_once('./lib/db_login.php');

if (isset($_POST['submit'])) {
    $is_valid = TRUE;

    // TODO 1: Lakukan validasi terhadap isi form name dengan POST
    if ($name == '') {
        $name_error = "Name field is required";
        $is_valid = FALSE;
    }

    // TODO 1: Lakukan validasi terhadap isi form address dengan POST
    if ($address == '') {
        $address_error = "Address field is required";
        $is_valid = FALSE;
    }

    // TODO 1: Lakukan validasi terhadap isi form city dengan POST
    if ($city == '' || $city == 'none') {
        $city_error = "City field is required";
    }


    // Jika valid maka masukkan ke database
    if ($is_valid) {
        // Escape inputs data
        $address = $db->real_escape_string($address);

        $query = "INSERT INTO customers (`customerid`, `name`, `address`, `city`) VALUES (NULL, '" . $name . "', '" . $address . "', '" . $city . "')";

        // Execute the query
        $result = $db->query($query);
        if (!$result) {
            die("Could not query the database: <br />" . $db->error . "<br>Query: " . $query);
        } else {
            $db->close();
            header('Location: view_customer.php');
        }
    }
}

?>

<?php include('./header.php') ?>

<div class="row w-50 mx-auto">
    <div class="col">
        <div class="card mt-4">
            <div class="card-header" class="text-bg-primary p-3">Add Customer Data</div>
            <div class="card-body">
                <form method="POST" autocomplete="on">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama:</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?php if (isset($name)) echo $name ?>">
                        <div class="text-danger small">
                            <p><?php if (isset($name_error)) echo $name_error ?></p>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Address:</label>
                        <textarea class="form-control" id="address" rows="3" name="address"><?php if (isset($address)) echo $address ?></textarea>
                        <div class="text-danger small">
                            <p><?php if (isset($address_error)) echo $address_error ?></p>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="city">City:</label>
                        <select name="city" id="city" class="form-control" required>
                            <option selected disabled value="none" <?php if (!isset($city)) echo 'selected' ?>>--Select a city--</option>
                            <option value="Airport West" <?php if (isset($city) && $city == "Airport West") echo 'selected' ?>>Airport West</option>
                            <option value="Box Hill" <?php if (isset($city) && $city == "Box Hill") echo 'selected' ?>>Box Hill</option>
                            <option value="Yarraville" <?php if (isset($city) && $city == "Yarraville") echo 'selected' ?>>Yarraville</option>
                        </select>
                        <div class="text-danger small"><?php if (isset($city_error)) echo $city_error ?></div>
                    </div>
                     <!-- TODO 2: Tambahkan fungsi add_customer_post() ketika tombol diklik -->
                    <button type="button" class="btn btn-success" onclick="add_customer_post()">Add Customer (POST)</button>
                </form>
                <br>
                <div id="add_response"></div>
            </div>
        </div>
    </div>
</div>

<!-- TODO 3: include file footer.php untuk memanggil ajax -->
<?php include('./footer.php') ?>