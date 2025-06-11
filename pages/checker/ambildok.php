<?php
include 'koneksi.php';
$data = ['Sebelum Sewa' => [], 'Sesudah Sewa' => []];

$sql = "SELECT * FROM dokumentasi ORDER BY waktu DESC";
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
  $data[$row['tipe']][] = $row;
}
echo json_encode($data);
?>
