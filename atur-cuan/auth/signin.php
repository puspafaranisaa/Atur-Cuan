<?php

    session_start();

    if (isset($_SESSION['auth'])) {
        header('Location: ../home.php');
        exit();
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="../assets/css/tgr.css">

    <title>Sign In - Atur Cuan</title>
</head>
<body>
    <section id="login">
        <div class="header">
            <div class="content">
                <img src="../assets/img/aturcuan-logo.png" alt="">
                <div class="logis2">
                    <a class="register" href="signup.php">Register</a>
                    <a class="login" href="signin.php">Login</a>
                </div>
            </div>
        </div>

        <div class="cardlog">
            <div class="card">
                <h1>LOGIN</h1>
                <hr class="garisreg">
                <div class="isi">
                    <form action="includes/signin.inc.php" method="post">
                        <p class="nemail">No. Telp</p>
                        <input class="niemail" type="number" id="no_telp" name="no_telp">
                        <hr class="garisline">

                        <p class="npassword">Password</p>
                        <input class="nipassword" type="password" id="password" name="password">
                        <hr class="garisline">
                        <div class="btnlogin">
                            <button type="submit" name="signin">LOGIN</button>
                        </div>
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
        </div>

    </section>

    <!-- <div>
        <form action="includes/signin.inc.php" method="post">
            <div class="">
                <label for="email">No. Telp</label>
                <input type="number" class="" id="no_telp" name="no_telp" placeholder="E.g. 0812XXXXXXXX">
            </div>
            <div class="">
                <label for="email">Password</label>
                <input type="password" class="" id="password" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;">
            </div>
            <div class="">
                <button type="submit" class="" name="signin">Sign In</button>
                <a href="signup.php">Sign Up</a>
            </div>


        </form>
    </div> -->
</body>
</html>