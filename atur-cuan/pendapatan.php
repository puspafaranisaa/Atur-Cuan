<?php

    session_start();

    include __DIR__ . '/includes/conn.inc.php';
    include __DIR__ . '/function/function.fun.php';

    if(!isset($_SESSION['auth'])) {
        header('Location: auth/signin.php');
        exit();
    }

    $id_pengguna_session = $_SESSION['auth_user']['idPengguna'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendapatan - Atur Cuan</title>

    <link rel="stylesheet" href="assets/css/style.css">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!-- Link Custom CSS -->
    <link rel="stylesheet" href="assets/css/adnanstyle.css">

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


    <section id="tabelpendapatan" class="section">
        <div class="container">

        <div class="content">

        <table class="card-form-table">
            <thead class="card-form-thead">
                <tr>
                <th>No.</th>
                <th>Tanggal</th>
                <th>Rincian Pendapatan</th>
                <th>Jenis Pendapatan</th>
                <th>Total Pendapatan</th>
                </tr>
            </thead>
            <?php pendapatan($id_pengguna_session) ?>
        </table>
        <div>
            <a href="tambah-pendapatan.php"><button>Tambah Pendapatan</button></a>
        </div>
    </section>

    <?php 

        if (isset($_SESSION['message'])) {

    ?>

                <?= $_SESSION['message']; ?>

    <?php
            unset($_SESSION['message']);

        }

    ?>

    <script type="text/javascript">

        const navbar = document.querySelector('[data-navbar]');
        const buttonNavToggler = document.querySelector('[data-nav-toggler');

        buttonNavToggler.addEventListener("click", () => {
            navbar.classList.toggle('active');
        });

    </script>

</body>
</html>