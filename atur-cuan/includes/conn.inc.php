<?php

    // Database Detil
    $serverName = "localhost";
    $dBUsername = "root";
    $dBPassword = "SukmaIcha";
    $dBName = "atur_cuan";

    // Koneksi ke Database
    $conn = new mysqli($serverName, $dBUsername, $dBPassword, $dBName);

    // Koneksi Validasi
    if ($conn->connect_errno) {
        die("Connection error: " . $conn->connect_errno);
    }

    // URL
    $url = 'http://localhost/atur-cuan/';

    // Akun Email
    $emailBot = 'aturcuan@gmail.com';
    $passBot = 'vpfqhvbnxxbzscmo';

    // Password aturcuan@gmail.com -> aturcuan2052
