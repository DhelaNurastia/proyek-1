<?php
require_once "../../../koneksi.php";

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['verifikasi'])) {
    $id = $_POST['id'];

    $stmt = mysqli_prepare($db, "UPDATE users SET status_verifikasi = 'terverifikasi' WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("Location: index.php?success=User berhasil diverifikasi");
    exit;
}


// Batalkan verifikasi
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['batal_verifikasi'])) {
    $id = $_POST['id'];
    $stmt = mysqli_prepare($db, "UPDATE users SET status_verifikasi = 'belum diverifikasi' WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("Location: daftar-terverifikasi.php?success=Verifikasi dibatalkan");
    exit;
}
