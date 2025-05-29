<?php
require_once '../../koneksi.php';

$email = $_POST['email'];
$password = $_POST['password_baru'];
$konfirmasi = $_POST['konfirmasi'];

if (empty($email) || empty($password) || empty($konfirmasi)) {
    echo "Semua field harus diisi!";
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "Format email tidak valid!";
    exit;
}

if (strlen($password) < 6) {
    echo "Password minimal 6 karakter!";
    exit;
}

if ($password !== $konfirmasi) {
    echo "Konfirmasi password tidak cocok!";
    exit;
}

$cek = mysqli_query($db, "SELECT * FROM users WHERE email='$email'");
if (mysqli_num_rows($cek) == 0) {
    echo "Email tidak ditemukan!";
    exit;
}

$hashed = password_hash($password, PASSWORD_DEFAULT);
$update = mysqli_query($db, "UPDATE users SET password='$hashed' WHERE email='$email'");

if ($update) {
    header("Location: login.php?reset=success");
    exit;
} else {
    echo "Gagal reset password. Coba lagi yaa~";
}
