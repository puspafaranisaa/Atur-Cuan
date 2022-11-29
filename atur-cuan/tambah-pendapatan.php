<?php

session_start();

include __DIR__ . '/includes/conn.inc.php';
include __DIR__ . '/function/function.fun.php';

if(!isset($_SESSION['auth'])) {
header('Location: auth/signin.php');
exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atur Cuan - Tambah Pendapatan</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!-- Link Custom CSS -->
    <link rel="stylesheet" href="./assets/css/adnanstyle.css">

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

    <section id="totalPendapatan" class="section">
        <div class="container">

            <div class="content">

                <!-- Card Form Pendapatan -->
                <form action="includes/tambah-transaksi.inc.php" method="post" class="card-form">

                    <div class="card-form-badge">
                        <div class="card-form-badge-title-wrapper">
                            <img src="./assets/icon/money-withdrawy-icon.svg" alt="" width="55" height="50">
                            <h3 class="card-form-badge-text-title">
                                Total Pendapatan 
                            </h3>
                        </div>
                        <h2 class="card-form-badge-price fc-success">
                            November
                        </h2>
                    </div>

                    <h2 class="card-form-title">
                        Tambah Pendapatan
                    </h2>

                    <ul class="card-list-form">
                        <li class="card-item-form">
                            <label for="nominal">
                                Nominal
                            </label>
                            <div class="card-item-input">
                                <div class="card-badge-icon-nominal">
                                    <img src="./assets/icon/indonesian-icon.svg" alt="">
                                    <p>Rp</p>
                                </div>
                                <input type="number" class="" id="nominal" name="nominal" >
                            </div>
                        </li>
                        <li class="card-item-form">
                        <label for="tanggal">Tanggal</label>
                            <div class="card-item-input">
                            <input type="date" class="" id="tanggal" name="tanggal">
                        

                            </div>
                        </li>
                        <li class="card-item-form">
                            <label for="kategori">
                                Kategori
                            </label>
                            <div class="card-item-input">
                                <select name="kategori" aria-placeholder="Pilih Kategori" id="" required>
                                 <option disabled selected> Pilih Kategori </option>
                                    <option value="aktif">Aktif</option>
                                    <option value="pasif">Pasif</option>
                                    <option value="investasi">Investasi</option>
                                </select>
                            </div>
                        </li>
                        <li class="card-item-form">
                            <label for="rincian">
                                Rincian Pendapatan
                            </label>
                            <div class="card-item-input">
                                <input type="text" name="rincian" placeholder="Isi Keterangan Singkat(Opsional)" id="rincian">
                            </div>
                        </li>
                        <li class="card-item-form button">
                            <button type="submit" class="btn btn-success" name="tambah-pendapatan">
                                Tambah
                            </button>
                        </li>
                    </ul>

                </form>
                <?php 
                    if (isset($_SESSION['message'])) {
                ?>

                    <?= $_SESSION['message']; ?>

                <?php
                    unset($_SESSION['message']);
                    }
                ?>

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
        </form>
    </div> -->
</body>
</html>