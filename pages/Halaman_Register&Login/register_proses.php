<?php
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    echo "Akses tidak diizinkan!";
    exit;
}

require_once '../../koneksi.php'; // sesuaikan path kalau perlu

// Ambil data dari form
$nama      = $_POST['nama'] ?? '';
$email      = $_POST['email'] ?? '';
$password   = $_POST['password'] ?? '';
$konfirmasi = $_POST['konfirmasi'] ?? '';

// Validasi form kosong
if (empty($nama) || empty($email) || empty($password) || empty($konfirmasi)) {
    echo "Semua field harus diisi!";
    exit;
}

// Validasi format email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "Format email tidak valid!";
    exit;
}

// Validasi panjang password
if (strlen($password) < 6) {
    echo "Password minimal 6 karakter ya!";
    exit;
}

// Cek konfirmasi password
if ($password !== $konfirmasi) {
    echo "Kata sandi dan konfirmasi tidak sama!";
    exit;
}

// Cek email sudah terdaftar?
$cek_email = mysqli_query($db, "SELECT * FROM users WHERE email='$email'");
if (mysqli_num_rows($cek_email) > 0) {
    echo "Email sudah terdaftar!";
    exit;
}

// Enkripsi password
$hashed = password_hash($password, PASSWORD_DEFAULT);

// Simpan ke database
$insert = mysqli_query($db, "
    INSERT INTO users (nama, email, password, role)
    VALUES ('$nama', '$email', '$hashed', 'customer')
");

if ($insert) {
    header("Location: login.php?register=success");
    exit;
} else {
    echo "Gagal mendaftar, coba lagi yaa~";
}
