<?php
require_once "../../../koneksi.php";

// Proses membuat data
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["create"])) {
    // Ambil input dari form
    $nama = trim($_POST["nama"]);
    $telepon = trim($_POST["telepon"]);
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    if (empty($nama) || empty($telepon) || empty($email) || empty($password)) {
        $error = "Harap isi semua data";
        header("location: create.php?error={$error}");
        exit;
    }

    if (cek_email_terdaftar($email)) {
        $error = "Email telah terdaftar";
        header("location: create.php?error={$error}");
        exit;
    }

    $passwordHashed = password_hash($password, PASSWORD_DEFAULT);
    $role = "checker";

    // Query ke database
    $stmt = mysqli_prepare($db, "INSERT INTO users (nama,telepon,email,password,role) VALUES (?,?,?,?,?)");
    mysqli_stmt_bind_param($stmt, "sssss", $nama, $telepon, $email, $passwordHashed, $role);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    mysqli_close($db);

    // Alihkan ke halaman index
    $success = "Berhasil menambah  checker baru";
    header("location: index.php?success={$success}");
    exit;
}

// Proses memperbarui data
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["update"])) {
    // Ambil input dari form
    $id = (int) $_POST["id"];
    $nama = trim($_POST["nama"]);
    $telepon = trim($_POST["telepon"]);
    $email = trim($_POST["email"]);

    if (empty($nama) || empty($telepon) || empty($email)) {
        $error = "Harap isi semua data";
        header("location: create.php?error={$error}");
        exit;
    }

    if (cek_email_terdaftar($email)) {
        $error = "Email telah terdaftar";
        header("location: create.php?error={$error}");
        exit;
    }

    // Query ke database
    $stmt = mysqli_prepare($db, "UPDATE users SET nama=?, telepon=?, email=? WHERE id=?");
    mysqli_stmt_bind_param($stmt, "sssi", $nama, $telepon, $email, $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    mysqli_close($db);

    // Alihkan ke halaman index
    $success = "Berhasil memperbarui checker";
    header("location: index.php?success={$success}");
    exit;
}

// Proses menghapus data
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["delete"])) {
    $id = (int) $_POST["id"];

    // Query ke database
    $stmt = mysqli_prepare($db, "DELETE FROM users WHERE id=?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    mysqli_close($db);

    // Alihkan ke halaman index.php
    header("location: index.php");
    exit;
}

function cek_email_terdaftar(string $email): bool
{
    global $db;

    // Query ke database
    $stmt = mysqli_prepare($db, "SELECT email FROM users WHERE email=?");
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);

    return $result->num_rows > 0;
}