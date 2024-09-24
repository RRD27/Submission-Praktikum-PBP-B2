<?php
//Filelogin.php
//Deskripsi: menampilkan form login dan melakukan login ke halaman admin.php


session_start(); //inisialisasi session
require_once('lib/db_login.php');


$email = '';
$error_email = '';
$error_password = '';

//cek apakah user sudah submit form 
if (isset($_POST["submit"])) {
    $valid = TRUE; //flag validasi
    //cek validasi email
    $email = test_input($_POST['email']); 
    if ($email == '') {
        $error_email = "Email is required"; 
        $valid = FALSE;
    }elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) { 
        $error_email = "Invalid email format";
        $valid = FALSE;
    }

    //cek validasi 
    $password = test_input ($_POST['password']);
    if ($password== '') {
        $error_password = "Password is required";
        $valid = FALSE;
    }

    //cek validasi
    if ($valid) {
    //Asign a query
        $query = "SELECT * FROM admin WHERE email='".$email."' AND password='".md5($password)."' ";
        // Execute the query
        $result = $db->query($query);
        if (!$result) {
            die ("Could not query the database: <br />". $db->error);
        }else{
            if ($result->num_rows > 0) { //login berhasil
                $_SESSION['username'] = $email;
                header('Location: view_customer.php');
                exit;
            } else{ //login gagal
                echo '<span class="error">Combination of username and password are not correct.</span>';
            }
        }
        //close db connection
        $db->close();
    }
}

?>
<?php include('lib/header.html') ?>
<br>
<div class="card">
    <div class="card-header">Login Form</div>
        <div class="card-body">
            <form method="POST" autocomplete="on" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" size="30" value ="<?php echo $email; ?>">
                    <div class="error"><?php if (isset($error_email)) echo $error_email; ?></div> 
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" value= "">
                    <div class="error"><?php if (isset($error_password)) echo $error_password; ?></div> 
                </div>
                <br>
                <button type="submit" class="btn btn-primary" name="submit" value="submit">Login </button>
            </form>
        </div>
    </div>
</div>
<?php include('lib/footer.html') ?>