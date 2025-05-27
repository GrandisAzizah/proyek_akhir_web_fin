<?php
session_start();
if (isset($_SESSION['change_pw'])) {
    echo "Tidak ada session untuk email ini";
    exit;
}

require 'functions.php';

if (isset($_POST["reset"])) {
    $_POST['email'] = $_SESSION['change_pw'];
    if (ganti_pw($_POST) > 0) {
        header("location: login.php");
        exit;
    }
} else {
    echo "<script>Password gagal diperbarui.</script>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style_login.css">
    <title>Input Password Baru</title>
</head>

<body>
    <div class="col">
        <div class="container-fluid d-flex min-vh-100 justify-content-center align-items-center">
            <div class="form-group p-5">
                <!-- form -->
                <form action="" method="POST">
                    <div>
                        <h1>Input Password</h1>
                    </div>
                    <div class="form-group">
                        <label for="password" class="form-label">Password Baru</label>
                        <input type="password" name="passwordNew" id="passwordNew" class="form-control" placeholder="Masukkan password baru">
                    </div>
                    <div class="form-group">
                        <button type="submit" name="reset" id="reset" class="btn btn-primary w-100">Reset</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>