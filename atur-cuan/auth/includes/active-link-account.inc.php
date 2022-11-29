<?php

    session_start();
    
    if (!empty($_GET['token'])) {

        $get_token = $_GET['token'];

        include __DIR__ . '/../../includes/conn.inc.php';
        include 'date.inc.php';
        
        $sql = "SELECT id_pengguna, token, expired_at, status FROM tb_token WHERE token = '$get_token';";
        $stmt = $conn->query($sql) or die("Something wrong with database! Please call admin.");

        if ($stmt) {

            $row = $stmt->fetch_assoc();

            $id_pengguna_row = isset($row['id_pengguna']) ? mysqli_real_escape_string($conn, $row['id_pengguna']) : '';
            $token_row = isset($row['token']) ? mysqli_real_escape_string($conn, $row['token']) : '';
            $expired_at_row = isset($row['expired_at']) ? mysqli_real_escape_string($conn, $row['expired_at']) : '';
            $status_row = isset($row['status']) ? mysqli_real_escape_string($conn, $row['status']) : '';

            if (isset($get_token) == $token_row) {

                if ($status_row == 1) {

                    $_SESSION['message'] = '<p class="text-red">Token Gagal! Kalian bisa coba nanti lagi.</p>';

                    header('Location: ../signin.php?error=invalid_token');
                    exit();
                }
        
                if ($expired_at_row > $date_time) {
        
                    $sql = "UPDATE tb_pengguna SET status_pengguna = 1 WHERE id_pengguna = '$id_pengguna_row';
                            UPDATE tb_token SET status = 1 WHERE token = '$token_row';
                    ";
                    $stmt = $conn->multi_query($sql) or die("Something wrong with database! Please call admin.");

                    $_SESSION['message'] = '<p class="text-green">Akun telah Aktif! Kalian bisa coba Log In.</p>';

                    header('Location: ../signin.php?error=account_active');
                    exit();
                } else {
        
                    $_SESSION['message'] = '<p class="text-red">Link Expired!</p>';

                    header('Location: ../signin.php?error=token_expired');
                    exit();
                }
            } else {
        
                $_SESSION['message'] = '<p class="text-red">Token Gagal! Kalian bisa coba nanti lagi.</p>';

                header('Location: ../signin.php?error=invalid_token');
                exit();
            }

        } else {

            $_SESSION['message'] = '<p class="text-red">STMT Gagal! Kalian bisa coba nanti lagi.</p>';

            header('Location: ../signin.php?error=stmt_failed');
            exit();
        }

    } else {

        $_SESSION['message'] = '<p class="text-red">Token Gagal! Kalian bisa coba nanti lagi.</p>';

        header('Location: ../signin.php?error=invalid_token');
        exit();
    }

?>