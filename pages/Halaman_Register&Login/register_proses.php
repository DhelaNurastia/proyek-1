<?php
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    echo "<script>alert('Akses tidak diizinkan!'); window.location.href='register.php';</script>";
    exit;
}

require_once '../../koneksi.php';

// Ambil data form
$nama_lengkap = $_POST['nama_lengkap'] ?? '';
$alamat       = $_POST['alamat'] ?? '';
$telepon      = $_POST['telepon'] ?? '';
$nama         = $_POST['nama'] ?? '';
$email        = $_POST['email'] ?? '';
$password     = $_POST['password'] ?? '';
$konfirmasi   = $_POST['konfirmasi'] ?? '';

// Validasi dasar
if (empty($nama_lengkap) || empty($telepon) || empty($nama) || empty($email) || empty($password) || empty($konfirmasi)) {
    echo "<script>alert('Semua field harus diisi!'); window.location.href='register.php';</script>";
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "<script>alert('Format email tidak valid!'); window.location.href='register.php';</script>";
    exit;
}

if (!preg_match('/^[0-9]+$/', $telepon)) {
    echo "<script>alert('Nomor telepon hanya boleh angka!'); window.location.href='register.php';</script>";
    exit;
}

if (strlen($password) < 6) {
    echo "<script>alert('Password minimal 6 karakter!'); window.location.href='register.php';</script>";
    exit;
}

if ($password !== $konfirmasi) {
    echo "<script>alert('Konfirmasi password tidak cocok!'); window.location.href='register.php';</script>";
    exit;
}

// Validasi file dokumen
$allowed = ['jpg', 'jpeg', 'png', 'pdf'];
$max_size = 2 * 1024 * 1024; // 2MB

foreach (['ktp', 'sim', 'kk'] as $doc) {
    $ext = pathinfo($_FILES[$doc]['name'], PATHINFO_EXTENSION);
    $size = $_FILES[$doc]['size'];

    if (!in_array(strtolower($ext), $allowed)) {
        echo "<script>alert('" . strtoupper($doc) . " harus berupa JPG, PNG, atau PDF!'); window.location.href='register.php';</script>";
        exit;
    }

    if ($size > $max_size) {
        echo "<script>alert('" . strtoupper($doc) . " tidak boleh lebih dari 2MB!'); window.location.href='register.php';</script>";
        exit;
    }
}

// Cek email sudah ada
$cek = mysqli_query($db, "SELECT id FROM users WHERE email = '$email'");
if (mysqli_num_rows($cek) > 0) {
    echo "<script>alert('Email sudah terdaftar!'); window.location.href='register.php';</script>";
    exit;
}

// Enkripsi dan insert ke tabel users
$hashed = password_hash($password, PASSWORD_DEFAULT);
$status = "belum diverifikasi";

$query = mysqli_query($db, "INSERT INTO users (nama_lengkap, alamat, telepon, nama, email, password, role, blacklist, status_verifikasi)
    VALUES ('$nama_lengkap', '$alamat', '$telepon', '$nama', '$email', '$hashed', 'customer', 0, '$status')");

if (!$query) {
    echo "<script>alert('Gagal menyimpan data user.'); window.location.href='register.php';</script>";
    exit;
}

$id_user = mysqli_insert_id($db);

// Upload file dokumen
$upload_dir = '../../uploads/dokumen-user/';
if (!is_dir($upload_dir)) mkdir($upload_dir, 0777, true);

function uploadFile($name, $prefix)
{
    global $upload_dir;
    $filename = $prefix . "_" . time() . "_" . uniqid() . "." . pathinfo($_FILES[$name]['name'], PATHINFO_EXTENSION);
    $filepath = $upload_dir . $filename;
    move_uploaded_file($_FILES[$name]['tmp_name'], $filepath);
    return $filename;
}

$file_ktp = uploadFile('ktp', 'ktp');
$file_sim = uploadFile('sim', 'sim');
$file_kk  = uploadFile('kk', 'kk');

// Simpan dokumen ke tabel
mysqli_query($db, "INSERT INTO dokumen_user (id_user, file_ktp, file_sim, file_kk)
    VALUES ('$id_user', '$file_ktp', '$file_sim', '$file_kk')");

echo "<script>alert('Pendaftaran berhasil! Silakan login.'); window.location.href='login.php';</script>";
exit;

