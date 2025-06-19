<?php
require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Header
$sheet->setCellValue('A1', 'Tanggal');
$sheet->setCellValue('B1', 'Nomor Transaksi');
$sheet->setCellValue('C1', 'Customer');
$sheet->setCellValue('D1', 'Unit');
$sheet->setCellValue('E1', 'Durasi');
$sheet->setCellValue('F1', 'Total');
$sheet->setCellValue('G1', 'Metode');
$sheet->setCellValue('H1', 'Status');
// ... lanjutkan sesuai kolom

// Data
$rowNum = 2;
foreach ($laporan as $row) {
    $sheet->setCellValue('A' . $rowNum, $row['tanggal']);
    $sheet->setCellValue('B' . $rowNum, $row['nomor_transaksi']);
    $sheet->setCellValue('C' . $rowNum, $row['customer']);
    $sheet->setCellValue('D' . $rowNum, $row['mobil']);
    $sheet->setCellValue('E' . $rowNum, $row['b.durasi']);
    $sheet->setCellValue('F' . $rowNum, $row['b.total_biaya']);
    $sheet->setCellValue('G' . $rowNum, $row['p.status']);
    // ... lanjutkan
    $rowNum++;
}

$writer = new Xlsx($spreadsheet);
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="laporan.xlsx"');
$writer->save('php://output');
exit;