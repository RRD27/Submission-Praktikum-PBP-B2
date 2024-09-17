<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Form Input Siswa</title>
    <style>
        .form-container{
            border : 1px solid #ddd;
            padding: 20px;
            border-radius: 5px;
            background-color: #f8f9fa;
        }
        .form-title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 15px;
        }
        .error {
            color: red;
            font-size: 12px;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <div class="form-container">
        <div class="form-title">Form Input Siswa</div>
        <?php 
            function test_input($data){
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }
            
            if (isset($_POST['submit'])) {
                // Validasi NIS: Harus 10 karakter dan hanya angka
                $nis = test_input($_POST['nis']);
                if (empty($nis)){
                    $error_nis = "NIS harus diisi";
                } elseif(!preg_match("/^[0-9]{10}$/", $nis)){
                    $error_nis = "NIS harus berisi 10 angka";
                }

                // Validasi Nama: Tidak boleh kosong, hanya huruf dan spasi
                $nama = test_input($_POST['nama']);
                if (empty($nama)){
                    $error_nama = "Nama harus diisi";
                } elseif(!preg_match("/^[a-zA-Z ]*$/", $nama)){
                    $error_nama = "Nama hanya dapat berisi huruf dan spasi";
                }

                // Validasi Jenis Kelamin: Tidak boleh kosong
                if (isset($_POST['jenis_kelamin'])){
                    $jenis_kelamin = $_POST['jenis_kelamin'];
                } else {
                    $error_jenis_kelamin = "Jenis kelamin harus diisi";
                }

                // Validasi Kelas: Tidak boleh kosong
                $kelas = $_POST['kelas'];
                if ($kelas == '' || $kelas == 'kelas'){
                    $error_kelas = "Kelas harus diisi";
                }

                // Validasi Ekstrakurikuler jika kelas X atau XI
                if (($kelas == 'X' || $kelas == 'XI') && !isset($_POST['ekstrakurikuler'])){
                    $error_ekstrakurikuler = "Pilih minimal 1 ekstrakurikuler";
                } elseif (isset($_POST['ekstrakurikuler']) && count($_POST['ekstrakurikuler']) > 3) {
                    $error_ekstrakurikuler = "Maksimal pilih 3 ekstrakurikuler";
                }
            }
        ?>
        <form action="" method="POST">
            <div class="form-group">
                <label for="nis">NIS:</label>
                <input type="text" class="form-control" id="nis" name="nis" maxlength="10" value="<?php if(isset($nis)) echo $nis;?>">
                <div class="error"><?php if(isset($error_nis)) echo $error_nis;?></div>
            </div>

            <div class="form-group">
                <label for="nama">Nama:</label>
                <input type="text" class="form-control" id="nama" name="nama" maxlength="50" value="<?php if(isset($nama)) echo $nama;?>">
                <div class="error"><?php if(isset($error_nama)) echo $error_nama;?></div>
            </div>

            <label>Jenis Kelamin</label>
            <div class="form-check">
                <label class="form-check-label">
                    <input type="radio" name="jenis_kelamin" class="form-check-input" value="pria" <?php if (isset($jenis_kelamin) && $jenis_kelamin == "pria") echo 'checked';?>>
                    Pria
                </label>
            </div>
            <div class="form-check">
                <label class="form-check-label">
                    <input type="radio" name="jenis_kelamin" class="form-check-input" value="wanita" <?php if (isset($jenis_kelamin) && $jenis_kelamin == "wanita") echo 'checked';?>>
                    Wanita
                </label>
                <div class="error"><?php if(isset($error_jenis_kelamin)) echo $error_jenis_kelamin;?></div>
            </div>

            <br>
            <div class="form-group">
                <label for="kelas">Kelas:</label>
                <select name="kelas" id="kelas" class="form-control" onchange="toggleEkstrakurikuler()">
                    <option value="">Pilih Kelas</option>
                    <option value="X" <?php if (isset($kelas) && $kelas == "X") echo 'selected';?>>X</option>
                    <option value="XI" <?php if (isset($kelas) && $kelas == "XI") echo 'selected';?>>XI</option>
                    <option value="XII" <?php if (isset($kelas) && $kelas == "XII") echo 'selected';?>>XII</option>
                </select>
                <div class="error"><?php if(isset($error_kelas)) echo $error_kelas;?></div>
            </div>

           
            <div id="ekstrakurikulerSection" style="display: none;">
                <label>Ekstrakurikuler (Pilih minimal 1, maksimal 3):</label>
                <div class="form-check">
                    <input type="checkbox" name="ekstrakurikuler[]" class="form-check-input" value="Pramuka" <?php if (isset($_POST['ekstrakurikuler']) && in_array('Pramuka', $_POST['ekstrakurikuler'])) echo 'checked';?>> Pramuka
                </div>
                <div class="form-check">
                    <input type="checkbox" name="ekstrakurikuler[]" class="form-check-input" value="Seni Tari" <?php if (isset($_POST['ekstrakurikuler']) && in_array('Seni Tari', $_POST['ekstrakurikuler'])) echo 'checked';?>> Seni Tari
                </div>
                <div class="form-check">
                    <input type="checkbox" name="ekstrakurikuler[]" class="form-check-input" value="Sinematografi" <?php if (isset($_POST['ekstrakurikuler']) && in_array('Sinematografi', $_POST['ekstrakurikuler'])) echo 'checked';?>> Sinematografi
                </div>
                <div class="form-check">
                    <input type="checkbox" name="ekstrakurikuler[]" class="form-check-input" value="Basket" <?php if (isset($_POST['ekstrakurikuler']) && in_array('Basket', $_POST['ekstrakurikuler'])) echo 'checked';?>> Basket
                </div>
                <div class="error"><?php if(isset($error_ekstrakurikuler)) echo $error_ekstrakurikuler;?></div>
            </div>

            <br>
            <button type="submit" class="btn btn-primary" name="submit" value="submit">Submit</button>
            <button type="reset" class="btn btn-danger">Reset</button>
        </form>
    </div>
</div>

<script>
    function toggleEkstrakurikuler() {
        var kelas = document.getElementById("kelas").value;
        var ekstrakurikulerSection = document.getElementById("ekstrakurikulerSection");

        if (kelas == 'X' || kelas == 'XI') {
            ekstrakurikulerSection.style.display = 'block';
        } else {
            ekstrakurikulerSection.style.display = 'none';
        }
    }

    // Trigger the function on page load in case form is resubmitted
    toggleEkstrakurikuler();
</script>

</body>
</html>