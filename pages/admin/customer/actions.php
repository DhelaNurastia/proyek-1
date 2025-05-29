<?php

require_once "../../../koneksi.php";

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["toggle_blacklist"])) {
    // Ambil input dari form
    $id = $_POST["id"];
    $current_blacklist = $_POST["blacklist"];

    // Ubah ke satu jika nilai blacklist saat ini adalah 0 dan sebaliknya
    $update_blacklist = $current_blacklist == 1 ? 0 : 1;

    // Query ke database
    $stmt = mysqli_prepare($db, "UPDATE users SET blacklist=? WHERE id=?");
    mysqli_stmt_bind_param($stmt, "ii", $update_blacklist, $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    mysqli_close($db);

    // Alihkan ke halaman index.php
    header("location: index.php");
    exit;
}
