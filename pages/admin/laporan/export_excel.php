<?php
require_once __DIR__ . '/../../../vendor/autoload.php';
require_once __DIR__ . '/../../../config.php';
require_once __DIR__ . '/../../../koneksi.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Ambil filter dari GET
$dateFrom = $_GET['date-from'] ?? null;
$dateTo = $_GET['date-to'] ?? null;
$status = $_GET['status-filter'] ?? null;

// Query seperti di laporan.php
$query = "
  SELECT 
    b.tgl_booking AS tanggal,
    CONCAT('INV-', DATE_FORMAT(b.tgl_booking, '%Y%m%d'), '-', LPAD(b.id, 4, '0')) AS nomor_transaksi,
    u.nama_lengkap AS customer,
    jm.nama AS mobil,
    b.durasi,
    b.total_biaya,
    b.metode_pembayaran,
    p.status
  FROM booking b
  JOIN users u ON b.customer_id = u.id
  JOIN unit_mobil um ON b.unit_mobil_id = um.id
  JOIN jenis_mobil jm ON um.jenis_mobil_id = jm.id
  JOIN pembayaran p ON p.booking_id = b.id
  WHERE 1=1
";

if ($dateFrom) $query .= " AND b.tgl_booking >= '$dateFrom'";
if ($dateTo) $query .= " AND b.tgl_booking <= '$dateTo'";
if ($status) $query .= " AND p.status = '$status'";

$query .= " ORDER BY b.tgl_booking DESC";

$result = mysqli_query($db, $query);

// Buat spreadsheet
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Header kolom
$header = ['Tanggal', 'No Transaksi', 'Customer', 'Mobil', 'Durasi', 'Total Biaya', 'Metode Pembayaran', 'Status'];
$sheet->fromArray($header, NULL, 'A1');

// Isi data mulai dari baris ke-2
$row = 2;
while ($data = mysqli_fetch_assoc($result)) {
    $sheet->setCellValue("A$row", $data['tanggal']);
    $sheet->setCellValue("B$row", $data['nomor_transaksi']);
    $sheet->setCellValue("C$row", $data['customer']);
    $sheet->setCellValue("D$row", $data['mobil']);
    $sheet->setCellValue("E$row", $data['durasi']);
    $sheet->setCellValue("F$row", $data['total_biaya']);
    $sheet->setCellValue("G$row", $data['metode_pembayaran']);
    $sheet->setCellValue("H$row", $data['status']);
    $row++;
}

// Output ke browser
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="laporan.xlsx"');
header('Cache-Control: max-age=0');

$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit;