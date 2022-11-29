<?php 

session_start();

if (isset($_POST['signin'])) {

    include __DIR__ . '/../../includes/conn.inc.php';

    $no_telp = isset($_POST['no_telp']) ? mysqli_real_escape_string($conn, $_POST['no_telp']) : '';
    $password = isset($_POST['password']) ? mysqli_real_escape_string($conn, $_POST['password']) : '';

    if (empty($no_telp) || empty($password)) {

        $_SESSION['message'] = '<p class="text-red">Input belum diisi semua! Pastikan isi semua input.</p>';

        header('Location: ../signin.php?error=input_empty');
        exit();
    }

    if (!preg_match("/^[0-9\s]*$/", $no_telp)) {

        $_SESSION['message'] = '<p class="text-red">Nomor Telphone salah! Pastikan isi sesuai dengan format email.</p>';

        header('Location: ../signin.php?error=invalid_no_telp');
        exit();
    }

    $sql = "SELECT id_pengguna, no_telp, password, status_pengguna FROM tb_pengguna WHERE no_telp = '$no_telp'";
    $stmt = $conn->query($sql) or die("Something wrong with database! Please call admin.");

    if ($stmt) {

        $row = $stmt->fetch_assoc();

        $id_pengguna_row = isset($row['id_pengguna']) ? mysqli_real_escape_string($conn, $row['id_pengguna']) : '';
        $no_telp_row = isset($row['no_telp']) ? mysqli_real_escape_string($conn, $row['no_telp']) : '';
        $password_row = isset($row['password']) ? mysqli_real_escape_string($conn, $row['password']) : '';
        $status_pengguna_row = isset($row['status_pengguna']) ? mysqli_real_escape_string($conn, $row['status_pengguna']) : '';

        if ($no_telp !== $no_telp_row) {

            $_SESSION['message'] = '<p class="text-red">No Telephone atau Password salah! Pastikan dicek kembali.</p>';

            header('Location: ../signin.php?error=incorrect_email_pass');
            exit();
        }

        if (!password_verify($password, $password_row)) {

            $_SESSION['message'] = '<p class="text-red">No Telephone atau Password salah! Pastikan dicek kembali.</p>';

            header('Location: ../signin.php?error=incorrect_email_pass');
            exit();
        }

        if ($status_pengguna_row == 0) {

            $_SESSION['message'] = '<p class="text-red">Email belum Terverifikasi! Kalian bisa lihat di Inbox/Spam email.</p>';

            header('Location: ../signin.php?error=email_not_verified');
            exit();
        }

        $_SESSION['auth'] = true;

        $_SESSION['auth_user'] = [
            'idPengguna' => $id_pengguna_row,
            'noTelp' => $no_telp_row
        ];

        header('Location: ../../home.php');
        exit();

    } else {

        $_SESSION['message'] = '<p class="text-red">STMT Gagal! Kalian bisa coba nanti lagi.</p>';

        header('Location: ../signin.php?error=stmt_failed');
        exit();
    }

} else {
    
    header('Location: ../signin.php');
    exit();
}

?>