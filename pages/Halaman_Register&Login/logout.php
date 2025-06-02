<?php
session_start();
session_destroy(); // Menghapus semua data sesi
header("Location: ../homepage/index.php"); // Arahkan ke halaman login
exit();
