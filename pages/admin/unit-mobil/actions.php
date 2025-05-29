<?php
require_once "../../../koneksi.php";

// Proses membuat data
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["create"])) {
    // Ambil input dari form
    $nama = $_POST["nama"];
    $harga_sewa = $_POST["harga_sewa"];
    $jumlah_kursi = $_POST["jumlah_kursi"];

    // Query ke database
    $stmt = mysqli_prepare($db, "INSERT INTO jenis_mobil (nama,harga_sewa,jumlah_kursi) VALUES (?,?,?)");
    mysqli_stmt_bind_param($stmt, "sii", $nama, $harga_sewa, $jumlah_kursi);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    mysqli_close($db);

    // Alihkan ke halaman index.php
    header("location: index.php");
    exit;
}

// Proses memperbarui data
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["update"])) {
    // Ambil input dari form
    $id = $_POST["id"];
    $nama = $_POST["nama"];
    $harga_sewa = $_POST["harga_sewa"];
    $jumlah_kursi = $_POST["jumlah_kursi"];

    // Query ke database
    $stmt = mysqli_prepare($db, "UPDATE jenis_mobil SET nama=?, harga_sewa=?, jumlah_kursi=? WHERE id=?");
    mysqli_stmt_bind_param($stmt, "siii", $nama, $harga_sewa, $jumlah_kursi, $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    mysqli_close($db);

    // Alihkan ke halaman index.php
    header("location: index.php");
    exit;
}

// Proses menghapus data
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["delete"])) {
    // Ambil input dari form
    $id = $_POST["id"];

    // Query ke database
    $stmt = mysqli_prepare($db, "DELETE FROM jenis_mobil WHERE id=?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    mysqli_close($db);

    // Alihkan ke halaman index.php
    header("location: index.php");
    exit;
}
