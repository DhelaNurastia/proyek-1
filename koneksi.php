<?php

const HOSTNAME = 'localhost';
const USERNAME = 'root';
const PASSWORD = '';
const DATABASE = 'tes';

$db = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE);

if ($db) {
    // echo 'Koneksi berhasil';
} else {
    die("Koneksi error" . mysqli_connect_error());
}
