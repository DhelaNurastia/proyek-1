<?php
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    echo "Akses tidak diizinkan!";
    exit;
}

require_once '../../koneksi.php';

// Ambil data form
$nama      = $_POST['nama'] ?? '';
$email     = $_POST['email'] ?? '';
$password  = $_POST['password'] ?? '';
$konfirmasi = $_POST['konfirmasi'] ?? '';

// Validasi dasar
if (empty($nama) || empty($email) || empty($password) || empty($konfirmasi)) {
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

// Validasi file dokumen
$allowed = ['jpg', 'jpeg', 'png', 'pdf'];
foreach (['ktp', 'sim', 'kk'] as $doc) {
    $ext = pathinfo($_FILES[$doc]['name'], PATHINFO_EXTENSION);
    if (!in_array(strtolower($ext), $allowed)) {
        echo strtoupper($doc) . " harus berupa JPG, PNG, atau PDF!";
        exit;
    }
}

// Cek email sudah ada
$cek = mysqli_query($db, "SELECT id FROM users WHERE email = '$email'");
if (mysqli_num_rows($cek) > 0) {
    echo "Email sudah terdaftar!";
    exit;
}

// Enkripsi dan insert ke tabel users
$hashed = password_hash($password, PASSWORD_DEFAULT);
$status = "belum diverifikasi";

$query = mysqli_query($db, "INSERT INTO users (nama, email, password, role, blacklist, status_verifikasi)
    VALUES ('$nama', '$email', '$hashed', 'customer', 0, '$status')");

if (!$query) {
    echo "Gagal menyimpan data user.";
    exit;
}

$id_user = mysqli_insert_id($db);

// Upload file dokumen
$upload_dir = '../../uploads/dokumen-user/';
if (!is_dir($upload_dir)) mkdir($upload_dir, 0777, true);

function uploadFile($name, $prefix)
{
    global $upload_dir;
    $filename = $prefix . "_" . time() . "_" . basename($_FILES[$name]['name']);
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

header("Location: login.php?register=success");
exit;
