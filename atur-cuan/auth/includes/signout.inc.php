<?php

    session_start();
    
    if(isset($_SESSION['auth'])) {
        $_SESSION = [];
        session_unset();

        $_SESSION['message'] = '<p class="text-green">Berhasil Log Out! Kalian berhasil keluar.</p>';

        header('Location: ../signin.php?success=signout');
        exit();

        session_destroy();

    } else {
        
        header('Location: ../signin.php');
        exit();
    }

?>