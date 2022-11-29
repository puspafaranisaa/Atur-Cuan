<?php 

session_start();

include __DIR__ . '/conn.inc.php';
include __DIR__ . '/../auth/includes/date.inc.php';
include __DIR__ . '/../function/function.fun.php';

if (isset($_POST['tambah-pendapatan'])) {

    $nominal = isset($_POST['nominal']) ? mysqli_real_escape_string($conn, $_POST['nominal']) : '';
    $kategori = isset($_POST['kategori']) ? mysqli_real_escape_string($conn, $_POST['kategori']) : false;
    $tanggal = date('Y-m-d', strtotime($_POST['tanggal']));
    $keterangan = isset($_POST['rincian']) ? mysqli_real_escape_string($conn, $_POST['rincian']) : false;

    $id_pengguna_session = $_SESSION['auth_user']['idPengguna'];

    if (empty($nominal) || empty($kategori) || empty($tanggal)) {

        $_SESSION['message'] = '<p class="text-red">Input belum diisi semua! Pastikan isi semua input.</p>';

        header('Location: ../tambah-pendapatan.php?error=input_empty');
        exit();
    }

    if (!preg_match("/^[0-9\s]*$/", $nominal)) {

        $_SESSION['message'] = '<p class="text-red">Nominal salah! Kami hanya menerima angka saja.</p>';

        header('Location: ../tambah-pendapatan.php?error=invalid_nominal');
        exit();
    }

    $id = "PNDTAN" . $date_time_combine;
    $idLaporan = "LPRAN" . $date_time_combine; 
    $kategoriCaps = ucwords($kategori);

    $sql = "INSERT INTO tb_pendapatan (id_pendapatan, id_pengguna, tanggal_pendapatan, rincian_pendapatan, jenis_pendapatan, total_pendapatan) VALUES ('$id', '$id_pengguna_session', '$tanggal', '$keterangan', '$kategoriCaps', '$nominal');
            INSERT INTO tb_laporan_keuangan (id_laporan, id_pengguna, bulan_laporan, id_pendapatan, total_pendapatan, status_keuangan) VALUES ('$idLaporan', '$id_pengguna_session', '$date_month', '$id', '$nominal', '$kategoriCaps');
    ";
    $stmt = $conn->multi_query($sql) or die("Something wrong with database! Please call admin.");

    if ($stmt) {

        $_SESSION['message'] = '<p class="text-green">Tambah pendapatan Berhasil!</p>';

        header('Location: ../pendapatan.php?success=form_submit');
        exit();

    } else {

        $_SESSION['message'] = '<p class="text-red">STMT Gagal! Kalian bisa coba nanti lagi.</p>';

        header('Location: ../tambah-pendapatan.php?error=stmt_failed');
        exit();
    }

}

if (isset($_POST['tambah-pengeluaran'])) {

    $nominal = isset($_POST['nominal']) ? mysqli_real_escape_string($conn, $_POST['nominal']) : '';
    $kategori = isset($_POST['kategori']) ? mysqli_real_escape_string($conn, $_POST['kategori']) : false;
    $tanggal = date('Y-m-d', strtotime($_POST['tanggal']));
    $keterangan = isset($_POST['rincian']) ? mysqli_real_escape_string($conn, $_POST['rincian']) : false;

    $id_pengguna_session = $_SESSION['auth_user']['idPengguna'];

    if (empty($nominal) || empty($kategori) || empty($tanggal)) {

        $_SESSION['message'] = '<p class="text-red">Input belum diisi semua! Pastikan isi semua input.</p>';

        header('Location: ../tambah-pengeluaran.php?error=input_empty');
        exit();
    }

    if (!preg_match("/^[0-9\s]*$/", $nominal)) {

        $_SESSION['message'] = '<p class="text-red">Nominal salah! Kami hanya menerima angka saja.</p>';

        header('Location: ../tambah-pengeluaran.php?error=invalid_nominal');
        exit();
    }

    $id = "PNGLAN" . $date_time_combine;
    $idLaporan = "LPRAN" . $date_time_combine;
    $kategoriCaps = ucwords($kategori);

    $sql = "INSERT INTO tb_pengeluaran (id_pengeluaran, id_pengguna, tanggal_pengeluaran, rincian_pengeluaran, jenis_pengeluaran, total_pengeluaran) VALUES ('$id', '$id_pengguna_session', '$tanggal', '$keterangan', '$kategoriCaps', '$nominal');
            INSERT INTO tb_laporan_keuangan (id_laporan, id_pengguna, bulan_laporan, id_pengeluaran, total_pengeluaran, status_keuangan) VALUES ('$idLaporan', '$id_pengguna_session', '$date_month', '$id', '$nominal', '$kategoriCaps');
    ";
    $stmt = $conn->multi_query($sql) or die("Something wrong with database! Please call admin.");

    if ($stmt) {

        $_SESSION['message'] = '<p class="text-green">Tambah pengeluaran Berhasil!</p>';

        header('Location: ../pengeluaran.php?success=form_submit');
        exit();

    } else {

        $_SESSION['message'] = '<p class="text-red">STMT Gagal! Kalian bisa coba nanti lagi.</p>';

        header('Location: ../tambah-pengeluaran.php?error=stmt_failed');
        exit();
    }

}

if (isset($_POST['tambah-tabungan'])) {

    $nominal = isset($_POST['nominal']) ? mysqli_real_escape_string($conn, $_POST['nominal']) : '';
    $kategori = isset($_POST['kategori']) ? mysqli_real_escape_string($conn, $_POST['kategori']) : '';
    $tanggal = date('Y-m-d', strtotime($_POST['tanggal']));
    $keterangan = isset($_POST['rincian']) ? mysqli_real_escape_string($conn, $_POST['rincian']) : false;

    $id_pengguna_session = $_SESSION['auth_user']['idPengguna'];

    if (empty($nominal) || empty($kategori) || empty($tanggal)) {

        $_SESSION['message'] = '<p class="text-red">Input belum diisi semua! Pastikan isi semua input.</p>';

        header('Location: ../tambah-tabungan.php?error=input_empty');
        exit();
    }

    if (!preg_match("/^[0-9\s]*$/", $nominal)) {

        $_SESSION['message'] = '<p class="text-red">Nominal salah! Kami hanya menerima angka saja.</p>';

        header('Location: ../tambah-tabungan.php?error=invalid_nominal');
        exit();
    }

    $id = "TBGAN" . $date_time_combine;
    $idLaporan = "LPRAN" . $date_time_combine;
    $kategoriCaps = ucwords($kategori);

    $sql = "INSERT INTO tb_tabungan (id_tabungan, id_pengguna, tanggal_tabungan, rincian_tabungan, jenis_tabungan, total_tabungan) VALUES ('$id', '$id_pengguna_session', '$tanggal', '$keterangan', '$kategoriCaps', '$nominal');
            INSERT INTO tb_laporan_keuangan (id_laporan, id_pengguna, bulan_laporan, id_tabungan, total_tabungan, status_keuangan) VALUES ('$idLaporan', '$id_pengguna_session', '$date_month', '$id', '$nominal', '$kategoriCaps');
    ";
    $stmt = $conn->multi_query($sql) or die("Something wrong with database! Please call admin.");

    if ($stmt) {

        $_SESSION['message'] = '<p class="text-green">Tambah tabungan Berhasil!</p>';

        header('Location: ../tabungan.php?success=form_submit');
        exit();

    } else {

        $_SESSION['message'] = '<p class="text-red">STMT Gagal! Kalian bisa coba nanti lagi.</p>';

        header('Location: ../tambah-tabungan.php?error=stmt_failed');
        exit();
    }

}

if (isset($_POST['tambah-anggaran'])) {

    $nama_anggaran = isset($_POST['nama-anggaran']) ? mysqli_real_escape_string($conn, $_POST['nama-anggaran']) : '';
    $kategori = isset($_POST['kategori']) ? mysqli_real_escape_string($conn, $_POST['kategori']) : '';
    $nominal = isset($_POST['nominal']) ? mysqli_real_escape_string($conn, $_POST['nominal']) : '';
    $tanggal_awal = date('Y-m-d', strtotime($_POST['tanggal-awal']));
    $tanggal_akhir = date('Y-m-d', strtotime($_POST['tanggal-akhir']));
    
    $id_pengguna_session = $_SESSION['auth_user']['idPengguna'];

    if (empty($nama_anggaran) || empty($nominal) || empty($kategori) || empty($tanggal_awal) || empty($tanggal_akhir)) {

        $_SESSION['message'] = '<p class="text-red">Input belum diisi semua! Pastikan isi semua input.</p>';

        header('Location: ../tambah-anggaran.php?error=input_empty');
        exit();
    }

    if (!preg_match("/^[a-zA-Z\s]*$/", $nama_anggaran)) {

        $_SESSION['message'] = '<p class="text-red">Nama anggaran Salah! Kami hanya menerima huruf saja.</p>';

        header('Location: ../tambah-anggaran.php?error=invalid_nominal');
        exit();
    }

    if (!preg_match("/^[0-9\s]*$/", $nominal)) {

        $_SESSION['message'] = '<p class="text-red">Nominal salah! Kami hanya menerima angka saja.</p>';

        header('Location: ../tambah-anggaran.php?error=invalid_nominal');
        exit();
    }

    if ($tanggal_awal > $tanggal_akhir) {

        $_SESSION['message'] = '<p class="text-red">Pastikan tanggal awal tidak lebih dari tanggal akhir</p>';

        header('Location: ../tambah-anggaran.php?error=invalid_nominal');
        exit();
    }

    $id = "AGGRAN" . $date_time_combine;
    $idLaporan = "LPRAN" . $date_time_combine;
    $kategoriCaps = ucwords($kategori);

    $sql = "INSERT INTO tb_anggaran (id_anggaran, id_pengguna, nama_anggaran, jenis_anggaran, jumlah_anggaran, tanggal_awal, tanggal_akhir) VALUES ('$id', '$id_pengguna_session', '$nama_anggaran', '$kategoriCaps', '$nominal', '$tanggal_awal', '$tanggal_akhir');
            INSERT INTO tb_laporan_keuangan (id_laporan, id_pengguna, bulan_laporan, id_anggaran, total_anggaran, status_keuangan) VALUES ('$idLaporan', '$id_pengguna_session', '$date_month', '$id', '$nominal', '$kategoriCaps');
    ";
    $stmt = $conn->multi_query($sql) or die("Something wrong with database! Please call admin.");

    if ($stmt) {

        $_SESSION['message'] = '<p class="text-green">Tambah anggaran Berhasil!</p>';

        header('Location: ../anggaran.php?success=form_submit');
        exit();

    } else {

        $_SESSION['message'] = '<p class="text-red">STMT Gagal! Kalian bisa coba nanti lagi.</p>';

        header('Location: ../tambah-pengeluaran.php?error=stmt_failed');
        exit();
    }

}

header('Location: ../home.php');
exit();

?>