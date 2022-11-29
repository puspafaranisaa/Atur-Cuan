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

    <title>Sign Up - Atur Cuan</title>
</head>
<body>

    <section id="signup">
        <div class="header">
            <div class="content">
                <img src="../assets/img/aturcuan-logo.png" alt="">
                <div class="logis">
                    <a class="register" href="signup.php">Register</a>
                    <a class="login" href="signin.php">Login</a>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="content">
                <h1>REGISTER</h1>
                <hr class="line-regis">

                <form action="includes/signup.inc.php" method="post">
                    <div class="isi">
                        <p class="nlengkap">Nama Lengkap</p>
                        <input class="nname" type="text" id="nama-lengkap" name="nama-lengkap">
                        <hr class="garis">
                        <p class="nlengkap">Email</p>
                        <input class="nname" type="text" id="email" name="email">
                        <hr class="garis">
                        <p class="gender">Jenis Kelamin</p>

                        <div class="pilih">
                            <div class="field1">
                                <input type="radio" id="laki" name="gender" value="laki"/>
                                <label for="c1">Laki-laki</label>
                            </div>
                            
                            <div class="field2">
                                <input type="radio" id="perempuan" name="gender" value="perempuan"/>
                                <label for="c1">Perempuan</label>
                            </div>
                        </div>

                        <p class="notel">Nomor Telepon</p>
                        <input class="ntelp" type="text" id="no-telp" name="no-telp">
                        <hr class="garis">
                        <p class="notel">Password</p>
                        <input class="ntelp" type="password" id="password" name="password">
                        <hr class="garis">
                        <p class="notel">Re-Type Password</p>
                        <input class="ntelp" type="password" id="retype-password" name="retype-password">
                        <hr class="garis">
                        <div class="btnregis">
                            <button type="submit" name="signup">REGISTER</button>
                        </div>
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

    </section>

    <!-- <div>
        <form action="includes/signup.inc.php" method="post">
            <div class="">
                <label for="nama_lengkap">Nama Lengkap</label>
                <input type="text" class="" id="nama-lengkap" name="nama-lengkap" placeholder="E.g. Alexander">
            </div>
            <div class="">
                <input type="radio" class="" id="laki" name="gender" value="laki">
                <label for="laki">Laki-Laki</label>
                <input type="radio" class="" id="perempuan" name="gender" value="perempuan">
                <label for="laki">Perempuan</label>
            </div>
            <div class="">
                <label for="email">Email</label>
                <input type="text" class="" id="email" name="email" placeholder="E.g. example@gmail.com">
            </div>
            <div class="">
                <label for="no_telp">No. Telphone</label>
                <input type="number" class="" id="no-telp" name="no-telp" placeholder="E.g. 0812XXXXXXXX">
            </div>
            <div class="">
                <label for="password">Password</label>
                <input type="password" class="" id="password" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;">
            </div>
            <div class="">
                <label for="retype_password">Retype Password</label>
                <input type="password" class="" id="retype-password" name="retype-password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;">
            </div>
            <div class="">
                <button type="submit" class="" name="signup">Sign Up</button>
                <a href="signin.php">Sign In</a>
            </div>

            

        </form>
    </div> -->
</body>
</html>