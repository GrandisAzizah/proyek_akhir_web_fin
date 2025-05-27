<?php
session_start();
// user belum login
if (!isset($_SESSION["login"])) {
    header("location: login.php");
    exit;
}
require 'functions.php';

// ambil data di url
if (!isset($_GET["ID"]) || !is_numeric(($_GET["ID"]))) { //is_numeric mencegah injection
    die("ID tidak ditemukan"); //die untuk menghentikan eksekusi
}
$id = (int)$_GET['ID'];
$tm = query("SELECT * FROM laptop WHERE ID = $id")[0];

// cek apakah tombol sudah dipencet
if (isset($_POST["submit"])) {
    // cek apakah data berhasil di update
    if (update($_POST) > 0) {
        header("location:berandaAdmin.php");
    } else {
        echo "Data gagal di update";
        // menampilkan kenapa gagal
        echo mysqli_error($conn);
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
    <link rel="stylesheet" href="add_update.css">
    <title>Tambah Data</title>
</head>

<body>
    <div class="col">
        <div class="container-fluid d-flex min-vh-100 justify-content-center align-items-center mt-3">
            <div class="form-group p-5">
                <h1>Update Data</h1>
                <form action="" method="POST" enctype="multipart/form-data">
                    <!-- id atau ID -->
                    <input type="hidden" name="ID" value="<?= ($tm["ID"]); ?>">
                    <input type="hidden" name="gambarLama" value="<?= ($tm["gambar"]); ?>">

                    <!-- INPUT MEREK -->
                    <label for="merk">merk: </label><br>
                    <input type="text" name="merk" placeholder="merk" id="merk" value="<?= ($tm["merk"]); ?>"><br><br>


                    <!-- INPUT GAMBAR -->
                    <label for="gambar">Gambar: </label><br>
                    <img src="<?= $tm['gambar']; ?>" width="50">
                    <input type="file" name="gambar" id="gambar"><br><br>

                    <!-- INPUT CPU -->
                    <label for="CPU">CPU: </label><br>
                    <input type="text" name="CPU" id="CPU" value="<?= ($tm["CPU"]); ?>"><br><br>


                    <!-- INPUT GPU -->
                    <label for="GPU">GPU: </label><br>
                    <input type="text" name="GPU" id="GPU" value="<?= ($tm["GPU"]); ?>"><br><br>


                    <!-- INPUT RAM -->
                    <label for="RAM">RAM: </label><br>
                    <input type="text" name="RAM" id="RAM" value="<?= ($tm["RAM"]); ?>"><br><br>


                    <!-- INPUT BATTERY -->
                    <label for="battery">Battery: </label><br>
                    <input type="text" name="battery" id="battery" value="<?= ($tm["battery"]); ?>"><br><br>


                    <!-- INPUT HARGA -->
                    <label for="harga">Harga: </label><br>
                    <input type="text" name="harga" id="harga" value="<?= ($tm["harga"]); ?>"><br><br>


                    <!-- INPUT LINK -->
                    <label for="link">Link Barang: </label><br>
                    <input type="text" name="link" id="link" value="<?= ($tm["link"]); ?>"><br><br>


                    <!-- SUBMIT BUTTON -->
                    <button type="submit" value="Update" name="submit" class="btn btn-primary w-100">Update</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>