<?php
// session_unset();
// session_destroy();
    session_start();

    include __DIR__ . '/includes/conn.inc.php';
    include __DIR__ . '/function/function.fun.php';

    if(!isset($_SESSION['auth'])) {
        header('Location: auth/signin.php');
        exit();
    }

    $id_pengguna_session = $_SESSION['auth_user']['idPengguna'];

    $sql = "SELECT nama_pengguna FROM tb_pengguna WHERE id_pengguna = '$id_pengguna_session'";
    $stmt = $conn->query($sql) or die("Something wrong with database! Please call admin.");

    if ($stmt) {

        $row = $stmt->fetch_assoc();

        $nama_pengguna = isset($row['nama_pengguna']) ? mysqli_real_escape_string($conn, $row['nama_pengguna']) : '';

    } 

    $sql2 = "SELECT SUM(total_pendapatan) AS total_pendapatan_sum FROM tb_pendapatan WHERE id_pengguna = '$id_pengguna_session'";
    $stmt = $conn->query($sql2) or die("Something wrong with database! Please call admin.");

    if ($stmt->num_rows > 0) {

        $row = $stmt->fetch_assoc();

        if (empty($row['total_pendapatan_sum'])) {
            $pendapatan = 0;
        } else {
            $pendapatan = isset($row['total_pendapatan_sum']) ? mysqli_real_escape_string($conn, $row['total_pendapatan_sum']) : '';
        }

    }

    $sql3 = "SELECT SUM(total_pengeluaran) AS total_pengeluaran_sum FROM tb_pengeluaran WHERE id_pengguna = '$id_pengguna_session'";
    $stmt = $conn->query($sql3) or die("Something wrong with database! Please call admin.");

    if ($stmt->num_rows > 0) {

        $row = $stmt->fetch_assoc();

        if (empty($row['total_pengeluaran_sum'])) {
            $pengeluaran = 0;
        } else {
            $pengeluaran = isset($row['total_pengeluaran_sum']) ? mysqli_real_escape_string($conn, $row['total_pengeluaran_sum']) : '';
        }

    }

    $sql4 = "SELECT SUM(total_tabungan) AS total_tabungan_sum FROM tb_tabungan WHERE id_pengguna = '$id_pengguna_session'";
    $stmt = $conn->query($sql4) or die("Something wrong with database! Please call admin.");

    if ($stmt->num_rows > 0) {

        $row = $stmt->fetch_assoc();

        if (empty($row['total_tabungan_sum'])) {
            $tabungan = 0;
        } else {
            $tabungan = isset($row['total_tabungan_sum']) ? mysqli_real_escape_string($conn, $row['total_tabungan_sum']) : '';
        }

    }

    $total_uang = $pendapatan - $pengeluaran + $tabungan;

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="./assets/css/styles.css">

    <!-- Font Google -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <title>Home - Atur Cuan</title>
</head>
<body>

    <header class="header">

        <a href="./" class="logo">
            <img src="./assets/img/logoaturcuan.png" width="54" height="47" alt="">
            <span>
                Atur Cuan
            </span>
        </a>

        <nav class="navbar" data-navbar>
            <ul class="navbar-list" data-navbar-list>
                <li class="nav-item" data-nav-item><a href="pendapatan.php">Pendapatan</a></li>
                <li class="nav-item" data-nav-item><a href="pengeluaran.php">Pengeluaran</a></li>
                <li class="nav-item" data-nav-item><a href="tabungan.php">Tabungan</a></li>
                <li class="nav-item" data-nav-item><a href="anggaran.php">Anggaran</a></li>
                <li class="nav-item" data-nav-item><a href="laporan-keuangan.php">Laporan Keuangan</a></li>
            </ul>
        </nav>

        <div class="button-actions">
            <button data-nav-toggler>
                <img src="./assets/icon/hamburger-icon.svg" width="38" height="28" alt="">
            </button>
            <a href="profile.php">
                <img src="./assets/icon/user-profile-icon.svg" width="40" height="40" alt="">
            </a>
        </div>

    </header>

    <section id="landing">
        <div class="container">
            <div class="left">
                <img src="./assets/img/dashboard.png" alt="dashboard">
            </div>
            <div class="right">
                <h1>Selamat datang, <?php echo $nama_pengguna ?></h1>
                <p>Ingin mencatat apa hari ini?</p>
                <span>Jumlah Uang Kamu</span>
                <h6><?php curr($total_uang) ?></h6> 
            </div>
        </div>
        <div class="container bottom">
            <div class="card">
                <div class="title">
                    <img src="./assets/icon/pendapatan.png" alt="pendaapatan"><span>Pendapatan</span>
                </div>
                <p><?php curr($pendapatan) ?></p>
            </div>
            <div class="card">
                <div class="title">
                    <img src="./assets/icon/pengeluaran.png" alt="pengeluaran"><span>Pengeluaran</span>
                </div>
                <p><?php curr($pengeluaran) ?></p>
            </div>
            <div class="card">
                <div class="title">
                    <img src="./assets/icon/tabungan.png" alt="tabungan"><span>Tabungan</span>
                </div>
                <p><?php curr($tabungan) ?></p>
            </div>
        </div>
    </section>


    <script type="text/javascript">

        const navbar = document.querySelector('[data-navbar]');
        const buttonNavToggler = document.querySelector('[data-nav-toggler');

        buttonNavToggler.addEventListener("click", () => {
            navbar.classList.toggle('active');
        });

    </script>
</body>
</html>