<?php

require __DIR__ . '/configs/config.php';

$db = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE);

if($db){
    // echo 'Koneksi berhasil';
} else {
    die("Koneksi error" . mysqli_connect_error());
}