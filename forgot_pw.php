<?php
session_start();

$_SESSION['change_pw'] = $email;

require 'functions.php';
if (isset($_POST["reset"])) {
    $email = htmlspecialchars($_POST['email']);
    $result = mysqli_query($conn, "SELECT email FROM 
    user WHERE email = '$email'");

    if (!mysqli_fetch_assoc($result)) {
        echo "<script>alert('Email tidak ditemukan!');</script>";
    } else {
        header("location:change_pw.php");
    }
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
    <title>Lupa password</title>
</head>

<body>
    <div class="col">
        <div class="container-fluid d-flex min-vh-100 justify-content-center align-items-center">
            <div class="form-group p-5">
                <!-- form -->
                <form action="" method="POST">
                    <div>
                        <h1>Ganti Password</h1>
                    </div>
                    <div class="form-group">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="Masukkan email yang teregistrasi">
                    </div>
                    <div class="form-group">
                        <button type="submit" name="reset" class="btn btn-primary w-100">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>