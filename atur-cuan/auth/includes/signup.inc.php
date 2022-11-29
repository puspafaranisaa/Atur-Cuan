<?php 

session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (isset($_POST['signup'])) {

    include 'date.inc.php';
    include __DIR__ . '/../../includes/conn.inc.php';

    $nama_lengkap = isset($_POST['nama-lengkap']) ? mysqli_real_escape_string($conn, $_POST['nama-lengkap']) : '';
    $gender = isset($_POST['gender']) ? mysqli_real_escape_string($conn, $_POST['gender']) : '';
    $email = isset($_POST['email']) ? mysqli_real_escape_string($conn, $_POST['email']) : '';
    $no_telp = isset($_POST['no-telp']) ? mysqli_real_escape_string($conn, $_POST['no-telp']) : '';
    $password = isset($_POST['password']) ? mysqli_real_escape_string($conn, $_POST['password']) : '';
    $retype_password = isset($_POST['retype-password']) ? mysqli_real_escape_string($conn, $_POST['retype-password']) : '';

    if (empty($nama_lengkap) || empty($email) || empty($no_telp) || empty($password) || empty($retype_password)) {

        $_SESSION['message'] = '<p class="text-red">Input belum diisi semua! Pastikan isi semua input.</p>';

        header('Location: ../signup.php?error=input_empty');
        exit();
    }

    if (!preg_match("/^[a-zA-Z\s]*$/", $nama_lengkap)) {

        $_SESSION['message'] = '<p class="text-red">Nama Lengkap salah! Kami hanya menerima huruf saja.</p>';

        header('Location: ../signup.php?error=invalid_notelp');
        exit();
    }

    if (!isset($_POST['gender'])) {

        $_SESSION['message'] = '<p class="text-red">Gender belum dipilih! Pastikan pilih salah satu gender.</p>';

        header('Location: ../signup.php?error=input_empty');
        exit();
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

        $_SESSION['message'] = '<p class="text-red">Email salah! Pastikan isi sesuai dengan format email.</p>';

        header('Location: ../signup.php?error=invalid_email');
        exit();
    }

    if (!preg_match("/^[0-9\s]*$/", $no_telp)) {

        $_SESSION['message'] = '<p class="text-red">Nomor Telphone salah! Kami hanya menerima nomor saja.</p>';

        header('Location: ../signup.php?error=invalid_notelp');
        exit();
    }

    if (strlen($password) < 3) {

        $_SESSION['message'] = '<p class="text-red">Password dibawah minimal! Pastikan password tidak dibawah 3 huruf atau angka.</p>';

        header('Location: ../signup.php?error=min_password');
        exit();
    }

    if ($password !== $retype_password) {

        $_SESSION['message'] = '<p class="text-red">Password tidak sama! Pastikan password dan retype password sama.</p>';

        header('Location: ../signup.php?error=password_not_match');
        exit();
    } 

    $sql = "SELECT email, no_telp FROM tb_pengguna";
    $stmt = $conn->query($sql) or die("Something wrong with database! Please call admin.");

    if ($stmt) {

        include_once '../../includes/phpmailer/src/Exception.php';
        include_once '../../includes/phpmailer/src/PHPMailer.php';
        include_once '../../includes/phpmailer/src/SMTP.php';

        $row = $stmt->fetch_assoc();

        $email_row = isset($row['email']) ? mysqli_real_escape_string($conn, $row['email']) : '';
        $no_telp_row = isset($row['no_telp']) ? mysqli_real_escape_string($conn, $row['no_telp']) : '';

        if ($email == $email_row) {

            $_SESSION['message'] = '<p class="text-red">Email sudah dipakai! Silahkan ganti yang belum pernah terdaftar.</p>';

            header('Location: ../signup.php?error=email_exist');
            exit();
        }

        if ($no_telp == $no_telp_row) {

            $_SESSION['message'] = '<p class="text-red">Nomor Telphone sudah dipakai! Silahkan ganti yang belum pernah terdaftar.</p>';

            header('Location: ../signup.php?error=no_telp_exist');
            exit();
        }

        $id_pengguna = 'U' . $date_time_combine;
        $pass_encrypt = password_hash($password, PASSWORD_DEFAULT);

        $token = openssl_random_pseudo_bytes(16);
        $token = bin2hex($token);

        $sql = "INSERT INTO tb_pengguna (id_pengguna, nama_pengguna, gender, email, no_telp, password) VALUES ('$id_pengguna', '$nama_lengkap', '$gender', '$email', '$no_telp', '$pass_encrypt');
                INSERT INTO tb_token (id_pengguna, token, expired_at) VALUES ('$id_pengguna', '$token', '$expired_token');
        ";
        $stmt = $conn->multi_query($sql) or die("Something wrong with database! Please call admin.01");

        $mail = new PHPMailer(true);

        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = "$emailBot";
        $mail->Password = "$passBot";
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        
        $mail->setFrom('noreply@aturcuan.com');
        $mail->addAddress("$email");
        
        $mail->isHTML(true);

        $mail->Subject = 'Verifikasi Akun - Atur Cuan';
        $mail->Body = 'Link untuk mengaktifkan Akun Anda - ' . $url .'auth/includes/active-link-account.inc.php?token=' . $token . '<br> Hanya berlaku 10 Menit.';

        if ($stmt) {

            $mail->send();

            $_SESSION['message'] = '<p class="text-red">Akun telah dibuat! Kalian bisa lihat di Inbox/Spam untuk mengaktifkan akun.</p>';

            header('Location: ../signin.php?success=account_been_created');
            exit();
        } else {

            $_SESSION['message'] = '<p class="text-green">STMT Gagal! Kalian bisa coba nanti lagi.</p>';

            header('Location: ../signup.php?error=stmt_failed');
            exit();
        }

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