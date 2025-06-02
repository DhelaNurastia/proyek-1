<?php
session_start();

// Hapus semua data session
session_unset();

// Hancurkan session
session_destroy();

// Redirect ke halaman login (ganti dengan nama file login Anda)
header("Location: {$base_url}/login_proses.php");
exit;
?>
