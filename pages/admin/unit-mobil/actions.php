<?php
require_once "../../../koneksi.php";

// Proses update data jenis mobil
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["update"])) {
    $id = (int) $_POST["id"];
    $nama = trim($_POST["nama"]);
    $harga_sewa = (int) $_POST["harga_sewa"];
    $jumlah_kursi = (int) $_POST["jumlah_kursi"];

    // Validasi sederhana
    if (empty($nama) || empty($harga_sewa) || empty($jumlah_kursi)) {
        $error = "Semua field wajib diisi.";
        header("location: edit.php?id=$id&error=" . urlencode($error));
        exit;
    }

    // Update ke database
    $stmt = mysqli_prepare($db, "UPDATE jenis_mobil SET nama = ?, harga_sewa = ?, jumlah_kursi = ? WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "siii", $nama, $harga_sewa, $jumlah_kursi, $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    // Redirect kembali ke index
    $success = "Data berhasil diperbarui.";
    header("location: index.php?success=" . urlencode($success));
    exit;
}

// blok create 
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["create"])) {
    $nama = trim($_POST["nama"]);
    $harga_sewa = (int) $_POST["harga_sewa"];
    $jumlah_kursi = (int) $_POST["jumlah_kursi"];

    if (empty($nama) || empty($harga_sewa) || empty($jumlah_kursi)) {
        $error = "Semua field wajib diisi.";
        header("location: create.php?error=" . urlencode($error));
        exit;
    }

    $stmt = mysqli_prepare($db, "INSERT INTO jenis_mobil (nama, harga_sewa, jumlah_kursi) VALUES (?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "sii", $nama, $harga_sewa, $jumlah_kursi);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    $success = "Jenis mobil baru berhasil ditambahkan.";
    header("location: index.php?success=" . urlencode($success));
    exit;
}
