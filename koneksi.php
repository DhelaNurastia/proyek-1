<?php

const HOSTNAME = 'localhost';
const USERNAME = 'root';
const PASSWORD = '';
const DATABASE = 'proyek-1';

$db = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE);

if (!$db) {
    die("Koneksi error" . mysqli_connect_error());
}
