<?php
include_once __DIR__ . '/../../../koneksi.php';

if (!$db) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

$booking_id = $_POST['booking_id'];
$tipe       = $_POST['tipe']; // 'pre' atau 'post'
$kondisi    = $_POST['kondisi'];
$catatan    = mysqli_real_escape_string($db, $_POST['catatan']);
$denda      = isset($_POST['denda']) ? $_POST['denda'] : 0;

$foto_name = '';
if (isset($_FILES['foto']) && $_FILES['foto']['error'] === 0) {
    $tmp = $_FILES['foto']['tmp_name'];
    $ext = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
    $foto_name = 'foto_' . $tipe . '_' . time() . '.' . $ext;

    $upload_dir = __DIR__ . '/../../../uploads/foto_pre_post/';
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0755, true);
    }
    move_uploaded_file($tmp, $upload_dir . $foto_name);
}

$cek = mysqli_query($db, "SELECT * FROM inspeksi WHERE booking_id = '$booking_id'");
$ada = mysqli_num_rows($cek);

if ($tipe === 'pre') {
    if ($ada == 0) {
        mysqli_query($db, "INSERT INTO inspeksi (booking_id, tanggal_pre, kondisi_pre, foto_pre) 
            VALUES ('$booking_id', NOW(), '$kondisi', '$foto_name')");
    } else {
        mysqli_query($db, "UPDATE inspeksi SET tanggal_pre = NOW(), kondisi_pre = '$kondisi', foto_pre = '$foto_name' 
            WHERE booking_id = '$booking_id'");
    }
} elseif ($tipe === 'post') {
    if ($ada == 0) {
        mysqli_query($db, "INSERT INTO inspeksi (booking_id, tanggal_post, kondisi_post, foto_post, catatan, denda) 
            VALUES ('$booking_id', NOW(), '$kondisi', '$foto_name', '$catatan', '$denda')");
    } else {
        mysqli_query($db, "UPDATE inspeksi SET tanggal_post = NOW(), kondisi_post = '$kondisi', foto_post = '$foto_name', 
            catatan = '$catatan', denda = '$denda' WHERE booking_id = '$booking_id'");
    }

    if ($kondisi === 'rusak') {
        $q_unit = mysqli_query($db, "SELECT unit_mobil_id FROM booking WHERE id = '$booking_id'");
        $u = mysqli_fetch_assoc($q_unit);
        $unit_id = $u['unit_mobil_id'];

        mysqli_query($db, "UPDATE unit_mobil SET status = 'perlu_dicek' WHERE id = '$unit_id'");
    }
}

header("Location: ../index.php?success=1");
exit;
