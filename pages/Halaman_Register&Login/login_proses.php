<?php
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    echo "Akses tidak diizinkan!";
    exit;
}

require_once '../../config.php';
require_once '../../koneksi.php';

$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

if (empty($email) || empty($password)) {
    header("Location: login.php?error=1");
    exit;
}

$user = mysqli_query($db, "SELECT * FROM users WHERE email='$email'");
$data = mysqli_fetch_array($user);

if ($data && password_verify($password, $data['password'])) {
    session_start();
    $_SESSION['user_id'] = $data['id'];
    $_SESSION['role']    = $data['role'];

    // Redirect berdasarkan role
    switch ($data['role']) {
        case 'admin':
        case 'owner':
            header("Location: ../admin/index.php");
            break;
        case 'marketing':
            header("Location: ../marketing/dashboard_marketing.php");
            break;
        case 'checker':
            header("Location: ../checker/dashboard_checker.php");
            break;
        case 'customer':
            echo "Redirect ke customer...";
            header("Location: ../Customer/homepage.php");
            break;
        default:
            echo "Role tidak dikenali.";
            exit;
    }
} else {
    header("Location: login.php?error=1");
    exit;
}
