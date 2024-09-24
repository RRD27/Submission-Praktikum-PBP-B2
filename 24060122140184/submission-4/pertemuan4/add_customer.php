<?php
// File: add_customer.php
// Deskripsi: Menambah data customer baru

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('lib/db_login.php'); // test_input() sudah ada di sini, tidak perlu mendefinisikan ulang

// Inisialisasi variabel untuk form
$name = $address = $city = "";
$error_name = $error_address = $error_city = "";

// Cek apakah form telah disubmit
if (isset($_POST['submit'])) {
    $valid = TRUE;

    // Validasi nama
    $name = test_input($_POST['name']);
    if (empty($name)) {
        $error_name = "Name is required";
        $valid = FALSE;
    }

    // Validasi alamat
    $address = test_input($_POST['address']);
    if (empty($address)) {
        $error_address = "Address is required";
        $valid = FALSE;
    }

    // Validasi kota
    $city = test_input($_POST['city']);
    if ($city == '' || $city == 'none') {
        $error_city = "City is required";
        $valid = FALSE;
    }

    // Jika validasi sukses, simpan data ke database
    if ($valid) {
        // Menggunakan prepared statement untuk keamanan
        $query = "INSERT INTO customers (name, address, city) VALUES (?, ?, ?)";
        if ($stmt = $db->prepare($query)) {
            // Bind parameter
            $stmt->bind_param("sss", $name, $address, $city);

            // Eksekusi query
            if ($stmt->execute()) {
                // Redirect ke halaman view_customer.php setelah berhasil menambahkan
                header("Location: view_customer.php");
                exit();
            } else {
                echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
            }

            // Menutup statement
            $stmt->close();
        } else {
            echo "Prepare failed: (" . $db->errno . ") " . $db->error;
        }

        $db->close();
    }
}
?>

<?php include('lib/header.html'); ?>
<div class="container">
    <div class="card mt-5">
        <div class="card-header">Add Customer</div>
        <div class="card-body">
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>">
                    <div class="error"><?php echo $error_name; ?></div>
                </div>

                <div class="form-group">
                    <label for="address">Address:</label>
                    <textarea class="form-control" id="address" name="address" rows="4"><?php echo htmlspecialchars($address); ?></textarea>
                    <div class="error"><?php echo $error_address; ?></div>
                </div>

                <div class="form-group">
                    <label for="city">City:</label>
                    <select name="city" id="city" class="form-control">
                        <option value="none" <?php if ($city == 'none' || $city == '') echo 'selected'; ?>>--Select a city--</option>
                        <option value="Airport West" <?php if ($city == "Airport West") echo 'selected'; ?>>Airport West</option>
                        <option value="Box Hill" <?php if ($city == "Box Hill") echo 'selected'; ?>>Box Hill</option>
                        <option value="Yarraville" <?php if ($city == "Yarraville") echo 'selected'; ?>>Yarraville</option>
                    </select>
                    <div class="error"><?php echo $error_city; ?></div>
                </div>

                <br>
                <button type="submit" class="btn btn-primary" name="submit" value="submit">Submit</button>
                <a href="view_customer.php" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
<?php include('lib/footer.html'); ?>
