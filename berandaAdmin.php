<?php
session_start();
// user belum login
if (!isset($_SESSION["login"])) {
    header("location: login.php");
    exit;
}

require 'functions.php';

$laptop = query("SELECT * FROM laptop ORDER BY id DESC");

// pagination
$jumlahDataPerHalaman = 5;

$jumlahData = count(query("SELECT * FROM laptop"));

// pembulatan ke atas
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);

$halamanAktif = (isset($_GET["halaman"]) && (int)$_GET["halaman"] > 0) ? (int)$_GET["halaman"] : 1;

$awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;

$laptop = query("SELECT * FROM laptop ORDER BY id DESC LIMIT $awalData, $jumlahDataPerHalaman");

// tombol cari di klik
if (isset($_POST["cari"])) {
    $laptop = cari($_POST["keyword"]);
} else {
    $laptop = query("SELECT * FROM laptop ORDER BY id DESC LIMIT $awalData, $jumlahDataPerHalaman");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="beranda.css">
    <title>Admin Page</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="berandaAdmin.php">Compare</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-center flex-grow-1 pe-3">
                        <li class="nav-item">
                            <a class="nav-link mx-lg-2 active" aria-current="page" href="#">Daftar Produk</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mx-lg-2" href="read_req.php">Request</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mx-lg-2" href="konsul_read.php">Konsultasi</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mx-lg-2" href="logout.php">Log out</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <div id="beranda" class="justify-content-center align-items-center">
        <div class="container fluid p-5"><br>
            <div class="container my-4">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-3">
                    <a href="tambahdata.php"><button type="button" class="btn btn-primary" style="background-color: #6f42c1; color: white; border-color:#6f42c1;">Tambah Data</button></a>
                    <!-- SEARCH BAR -->
                    <form action="" method="POST" class="d-flex" role="search">
                        <input type="text" name="keyword" size="30" class="form-control me-2" placeholder="Cari Produk" autofocus autocomplete="off" />
                        <button class="btn btn-primary" type="submit" name="cari" style="background-color: #6f42c1; color: white; border-color:#6f42c1;"">Cari</button>
                    </form>
                </div>
            </div>
            <table class=" table table-hover table-bordered mt-5">
                            <thead class="table-dark">
                                <tr>
                                    <th class="text-center align-middle">No</th>
                                    <th class="text-center align-middle">ID</th>
                                    <th class="text-center align-middle">Merek</th>
                                    <th class="text-center align-middle">Gambar</th>
                                    <th class="text-center align-middle">CPU</th>
                                    <th class="text-center align-middle">GPU</th>
                                    <th class="text-center align-middle">RAM</th>
                                    <th class="text-center align-middle">Battery</th>
                                    <th class="text-center align-middle">Harga</th>
                                    <th class="text-center align-middle">Link Barang</th>
                                    <th class="text-center align-middle">Action</th>
                                </tr>
                            </thead>


                            </tbody>
                            <!-- i untuk penomoran -->
                            <?php $i = $awalData + 1 ?>
                            <!-- titik dua mengganti kurung kurawal -->
                            <?php foreach ($laptop as $row) : ?>
                                <tr>
                                    <td><?= $i ?></td>
                                    <td><?= $row['ID'] ?></td>
                                    <td><?= $row['merk'] ?></td>
                                    <td><img src="<?= $row['gambar'] ?>" width="50"></td>
                                    <td><?= $row['CPU'] ?></td>
                                    <td><?= $row['GPU'] ?></td>
                                    <td><?= $row['RAM'] ?></td>
                                    <td><?= $row['battery'] ?></td>
                                    <td>Rp<?= $row['harga'] ?></td>
                                    <td class="text-center align-middle"><a href=<?= $row['link'] ?> class="cart-icon"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart3 align-center" viewBox="0 0 16 16">
                                                <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M3.102 4l.84 4.479 9.144-.459L13.89 4zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2" />
                                            </svg></a></td>
                                    <td>
                                        <a href="update.php?ID=<?= $row["ID"]; ?>" class="update-icon"><svg xmlns="http://www.w3.org/2000/svg" IDth="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                                            </svg></a>
                                        <a href="hapus.php?ID=<?= $row["ID"]; ?>" class="delete-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                                <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5" />
                                            </svg></a>
                                    </td>
                                </tr>
                                <?php $i++; ?>
                            <?php endforeach ?>
                            </tbody>
                            </table>

                </div>

                <!-- pagination -->
                <div class="d-flex justify-content-center align-items-center">
                    <div aria-label="pagination-page">
                        <ul class="pagination">

                            <!-- previous button -->
                            <li class="page-item <?= ($halamanAktif <= 1) ? 'disabled' : '' ?>">
                                <a class="page-link" href="?halaman=<?= $halamanAktif - 1 ?>" tabindex="-1">Sebelumnya </a>
                            </li>

                            <!-- numbered page links -->
                            <?php for ($i = 1; $i <= $jumlahHalaman; $i++) : ?>
                                <li class="page-item <?= ($i == $halamanAktif) ? 'active' : '' ?>">
                                    <a class="page-link" href="?halaman=<?= $i ?>"><?= $i ?></a>
                                </li>
                            <?php endfor; ?>

                            <!-- next button -->
                            <li class="page-item <?= ($halamanAktif >= $jumlahHalaman) ? 'disabled' : '' ?>">
                                <a class="page-link" href="?halaman=<?= $halamanAktif + 1 ?>">Selanjutnya </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
</body>

</html>