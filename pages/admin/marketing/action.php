<?php
require_once("../../../koneksi.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["create"])) {
    $nama = trim($_POST['nama']);
    $telepon = trim($_POST['telepon']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);


    if (empty($nama) || empty($telepon) || empty($email)) {
        echo '<script>
    alert("isi semua data")
</script>';
    } elseif (cek_email_terdaftar($email)){
        $error = "Email telah terdaftar";
        header("location: create.php?error={$error}");
        exit;

    } else {
        $password_hashed = password_hash($password, PASSWORD_DEFAULT);
        $role = "marketing";
        $sql = 'INSERT INTO users (nama, telepon, email, password, role) VALUES (?,?,?,?,?)';
        $stmt = $db->prepare($sql);
        $stmt->execute([$nama, $telepon, $email, $password_hashed, $role]);
        $stmt->close();

        header('location: index.php');
        exit();
    }
}

function cek_email_terdaftar(string $email): bool {
    global $db;

    $stmt = mysqli_prepare($db,'SELECT email FROM users WHERE email=?');
    mysqli_stmt_bind_param( $stmt,'s', $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);

    return $result->num_rows > 0;
}