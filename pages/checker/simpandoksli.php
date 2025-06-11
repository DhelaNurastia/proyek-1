<?php
include 'koneksi.php';

$tipe = $_POST['tipe'] ?? '';
$checklist = $_POST['checklist'] ?? '';
$fotoNames = [];

foreach ($_FILES['foto']['tmp_name'] as $i => $tmp_name) {
  $namaFile = basename($_FILES['foto']['name'][$i]);
  $target = 'upload/' . $namaFile;
  move_uploaded_file($tmp_name, $target);
  $fotoNames[] = $namaFile;
}

$fotoFinal = implode(',', $fotoNames);
$sql = "INSERT INTO dokumentasi (tipe, checklist, foto) VALUES ('$tipe', '$checklist', '$fotoFinal')";
$result = $conn->query($sql);

echo $result ? "sukses" : "gagal";
?>
