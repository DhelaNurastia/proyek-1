<?php
require_once "../../../koneksi.php";

// === VERIFIKASI ===
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['verifikasi'])) {
    $id = $_POST['id'];

    // Update status user jadi 'terverifikasi'
    $stmt = mysqli_prepare($db, "UPDATE users SET status_verifikasi = 'terverifikasi' WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    // Buat notifikasi ke customer
    $pesan = "Akun Anda telah diverifikasi. Anda sekarang dapat melakukan booking mobil.";
    mysqli_query($db, "INSERT INTO notifikasi (user_id, role_tujuan, pesan, dibaca, created_at)
                    VALUES ('$id', 'customer', '$pesan', 0, NOW())");

    header("Location: index.php?success=User berhasil diverifikasi");
    exit;
}

// === BATALKAN VERIFIKASI ===
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['batal_verifikasi'])) {
    $id = $_POST['id'];

    $stmt = mysqli_prepare($db, "UPDATE users SET status_verifikasi = 'belum diverifikasi' WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("Location: daftar-terverifikasi.php?success=Verifikasi dibatalkan");
    exit;
}

// === TOLAK VERIFIKASI ===
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['tolak'])) {
    $id = $_POST['id'];

    // Update status user jadi 'ditolak'
    $stmt = mysqli_prepare($db, "UPDATE users SET status_verifikasi = 'ditolak' WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    // Buat notifikasi ke customer
    $pesan = "Verifikasi akun Anda ditolak. Silakan hubungi admin.";
    mysqli_query($db, "INSERT INTO notifikasi (user_id, role_tujuan, pesan, dibaca, created_at)
                    VALUES ('$id', 'customer', '$pesan', 0, NOW())");

    header("Location: index.php?tolak=berhasil");
    exit;
}
