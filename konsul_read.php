<!-- <?php
session_start();

if (!isset($_SESSION["login"])) {
    header("location: login.php");
    exit;
}

require 'functions.php';

// $kon = "SELECT * FROM konsul ORDER BY id_konsul DESC";
$kon = mysqli_query($conn, "SELECT * FROM konsul ORDER BY id_konsul DESC");

if (isset($_POST["submit"])) {
    $id_konsul = $_POST["id_konsul"];
    $adm_response = htmlspecialchars($_POST["adm_response"]);

    $query = "UPDATE konsul SET adm_response = '$adm_response' WHERE id_konsul = $id_konsul";

    if (mysqli_query($conn, $query)) {
        header("Location: read_req.php"); // kembali ke halaman admin
        exit;
    } else {
        echo "Gagal membalas: " . mysqli_error($conn);
    }
}
?>
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
    <title>Konsultasi</title>
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
                            <a class="nav-link mx-lg-2" href="berandaAdmin.php">Daftar Produk</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mx-lg-2 active" aria-current="page" href="read_req.php">Request</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mx-lg-2" href="#">Konsultasi</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mx-lg-2" href="logout.php">Log out</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <ul class="list-group list-group-flush mt-5">
        <?php while ($row = mysqli_fetch_assoc($kon)): ?>
            <li class="list-group-item">
                <strong><?= htmlspecialchars($row['username']) ?></strong>
                <?= htmlspecialchars($row['user_response']) ?>
                <em>Admin:</em> <?= htmlspecialchars($row['adm_response']) ?: '<span class="text-muted">Belum dibalas</span>' ?>
                <!-- Form balasan -->
                <form action="respon.php" method="POST" class="mt-2">
                    <input type="hidden" name="id_konsul" value="<?= $row['id_konsul'] ?>">
                    <input type="text" name="adm_response" placeholder="Tulis balasan..." class="form-control mb-1">
                    <button type="submit" name="submit" class="btn btn-sm btn-primary">Balas</button>
                </form>
            </li>
        <?php endwhile ?>
    </ul>
</body>

</html> -->