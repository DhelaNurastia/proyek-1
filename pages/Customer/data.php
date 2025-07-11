<?php
session_start();
include('../../koneksi.php');

if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit();
}

$user_id = $_SESSION['user_id'];

if (isset($_GET['booking_id'])) {
  $booking_id = (int) $_GET['booking_id'];
  $unit_id = $_GET['unit_id'] ?? null;

  $query = "
    SELECT 
        b.*, 
        u.nama_lengkap, u.email, u.telepon, u.alamat, 
        um.transmisi, um.warna, um.plat_nomor, 
        jm.nama AS jenis_mobil, jm.harga_sewa
    FROM booking b
    JOIN users u ON b.customer_id = u.id
    JOIN unit_mobil um ON b.unit_mobil_id = um.id
    JOIN jenis_mobil jm ON um.jenis_mobil_id = jm.id
    WHERE b.customer_id = $user_id
    AND b.id = $booking_id
  ";

  if ($unit_id !== null) {
    $query .= " AND b.unit_mobil_id = $unit_id";
  }



  $result_detail = mysqli_query($db, $query);
  $data = mysqli_fetch_assoc($result_detail);

  if (!$data) {
    die("Data booking tidak ditemukan atau Anda tidak punya akses.");
  }
}

if (!isset($data)) {
  echo "Data transaksi tidak ditemukan.";
  exit;
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Data Transaksi</title>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
  <style>
    /* CSS Variables using provided color scheme */
    :root {
      --background-color: #031119;
      --accent-color: #e3a127;
      --surface-color: #374151;
      --default-color: rgba(255 255 255 / 0.85);
      --contrast-color: #ffffff;
      --font-default: 'Roboto', system-ui, -apple-system, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
      --font-heading: 'Nunito Sans', sans-serif;
    }

    /* Reset and base */
    * {
      box-sizing: border-box;
    }

    body {
      margin: 0;
      background-color: var(--background-color);
      color: var(--default-color);
      font-family: var(--font-default);
      -webkit-font-smoothing: antialiased;
      -moz-osx-font-smoothing: grayscale;
    }

    /* Scrollbar */
    ::-webkit-scrollbar {
      width: 10px;
      background: var(--background-color);
    }

    ::-webkit-scrollbar-thumb {
      background: var(--accent-color);
      border-radius: 10px;
    }

    /* Header */
    header {
      position: sticky;
      top: 0;
      height: 64px;
      background: rgba(27, 38, 44, 0.75);
      backdrop-filter: blur(12px);
      display: flex;
      align-items: center;
      padding: 0 24px;
      box-shadow: 0 4px 12px rgb(227 161 39 / 0.3);
      z-index: 1000;
    }

    header .logo {
      color: var(--accent-color);
      font-family: var(--font-heading);
      font-weight: 900;
      font-size: 1.6rem;
      letter-spacing: 1.2px;
      user-select: none;
    }

    /* Container */
    main {
      max-width: 720px;
      margin: 2rem auto 4rem;
      background: var(--surface-color);
      border-radius: 16px;
      box-shadow: 0 8px 24px rgb(0 0 0 / 0.6);
      overflow: hidden;
      padding: 1.5rem 2rem 2.5rem;
    }

    /* Title section */
    main h1 {
      font-family: var(--font-heading);
      color: var(--accent-color);
      font-size: clamp(1.8rem, 4vw, 2.4rem);
      font-weight: 800;
      margin-bottom: 12px;
      text-align: center;
    }

    main p.subtitle {
      text-align: center;
      margin: 0 0 2rem;
      font-weight: 600;
      font-size: 1rem;
      color: var(--default-color);
      opacity: 0.85;
    }

    /* Info grid for user & transaction details */
    .info-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 1.5rem 3rem;
      margin-bottom: 2.5rem;
    }

    .info-block {
      background: var(--background-color);
      padding: 1rem 1.5rem;
      border-radius: 12px;
      box-shadow: inset 0 0 15px rgb(227 161 39 / 0.1);
    }

    .info-block h2 {
      font-family: var(--font-heading);
      margin: 0 0 0.6rem;
      color: var(--accent-color);
      font-weight: 700;
      font-size: 1.1rem;
      border-bottom: 1px solid rgb(227 161 39 / 0.3);
      padding-bottom: 0.3rem;
    }

    .info-block ul {
      list-style: none;
      padding: 0;
      margin: 0;
      color: var(--default-color);
    }

    .info-block ul li {
      margin-bottom: 0.5rem;
      font-size: 0.9rem;
      display: flex;
      align-items: center;
      gap: 0.5rem;
    }

    .info-block ul li i.material-icons {
      color: var(--accent-color);
      font-size: 20px;
      width: 24px;
      height: 24px;
    }

    /* Transaction details table for car rental info */
    table.transaction-table {
      width: 100%;
      border-collapse: separate;
      border-spacing: 0 12px;
    }

    table.transaction-table thead tr {
      background: var(--background-color);
    }

    table.transaction-table thead th {
      font-weight: 700;
      color: var(--accent-color);
      padding: 12px 15px;
      text-align: left;
      font-family: var(--font-heading);
      font-size: 0.95rem;
      border-radius: 12px 12px 0 0;
    }

    table.transaction-table tbody tr {
      background: var(--background-color);
      box-shadow: 0 4px 8px rgb(0 0 0 / 0.25);
      border-radius: 12px;
    }

    table.transaction-table tbody tr td {
      padding: 14px 15px;
      font-size: 0.95rem;
      color: var(--default-color);
      vertical-align: middle;
    }

    table.transaction-table tbody tr:nth-child(even) {
      background: var(--surface-color);
    }

    table.transaction-table tbody tr:last-child {
      font-weight: 700;
      color: var(--accent-color);
      border-top: 2px solid var(--accent-color);
    }

    /* Total row styling */
    .total-row td {
      font-weight: 700;
    }

    /* Footer summary */
    .summary {
      margin-top: 2.5rem;
      padding-top: 1.5rem;
      border-top: 1px solid rgb(227 161 39 / 0.3);
      display: flex;
      justify-content: flex-end;
      gap: 2rem;
    }

    .summary div {
      font-size: 1.1rem;
      font-weight: 700;
      color: var(--accent-color);
    }

    /* Print button */
    .btn-print {
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
      background: var(--accent-color);
      color: var(--background-color);
      border: none;
      border-radius: 28px;
      padding: 12px 24px;
      font-weight: 700;
      font-size: 1rem;
      cursor: pointer;
      box-shadow: 0 8px 20px rgb(227 161 39 / 0.6);
      transition: background-color 0.25s ease, transform 0.15s ease;
      user-select: none;
      margin: 1rem auto 0;
      width: 100%;
      max-width: 300px;
    }

    .btn-print:hover {
      background: #c3901a;
      transform: translateY(-2px);
      box-shadow: 0 12px 30px rgb(227 161 39 / 0.8);
    }

    .btn-print i.material-icons {
      font-size: 24px;
    }

    /* Responsive adjustments */
    @media (max-width: 600px) {
      main {
        margin: 1rem;
        padding: 1rem 1.5rem 2rem;
      }

      .info-grid {
        display: block;
      }

      .info-block {
        margin-bottom: 1.5rem;
      }

      .summary {
        flex-direction: column;
        align-items: flex-start;
      }

      .btn-print {
        max-width: 100%;
      }
    }
  </style>
</head>

<body>
  <main role="main" aria-labelledby="transaction-title">
    <h1 id="transaction-title">Detail Transaksi Rental Mobil</h1>
    <p class="subtitle">Terima kasih atas kepercayaan Anda. Berikut adalah detail transaksi rental mobil Anda.</p>

    <section class="info-grid" aria-label="Informasi Pelanggan dan Transaksi">
      <div class="info-block" role="region" aria-labelledby="customer-info-title">
        <h2 id="customer-info-title">Informasi Pelanggan</h2>
        <ul>
          <li><i class="material-icons" aria-hidden="true">person</i><span>Nama: <?= htmlspecialchars($data['nama_lengkap']) ?></span></li>
          <li><i class="material-icons" aria-hidden="true">email</i><span>Email: <?= htmlspecialchars($data['email']) ?></span></li>
          <li><i class="material-icons" aria-hidden="true">phone</i><span>Telepon: <?= htmlspecialchars($data['telepon']) ?></span></li>
          <li><i class="material-icons" aria-hidden="true">location_on</i><span>Alamat: <?= htmlspecialchars($data['alamat']) ?></span></li>
        </ul>
      </div>

      <div class="info-block" role="region" aria-labelledby="transaction-info-title">
        <h2 id="transaction-info-title">Detail Transaksi</h2>
        <ul>
          <li><i class="material-icons" aria-hidden="true">event</i><span>Tanggal Pesan: <?= date('d M Y', strtotime($data['tgl_booking'])) ?></span></li>
          <li><i class="material-icons" aria-hidden="true">event_available</i><span>Tanggal Rental Mulai: <?= date('d M Y', strtotime($data['tgl_booking'])) ?></span></li>
          <li><i class="material-icons" aria-hidden="true">event_busy</i><span>Tanggal Rental Selesai: <?= date('d M Y', strtotime($data['tgl_kembali'])) ?></span></li>
          <li><i class="material-icons" aria-hidden="true">receipt_long</i><span>No. Transaksi: INV-<?= date('Ymd', strtotime($data['tgl_booking'])) ?>-<?= str_pad($data['id'], 4, '0', STR_PAD_LEFT) ?></span></li>
        </ul>
      </div>
    </section>

    <section aria-label="Rincian Rental Mobil">
      <table class="transaction-table" role="table" aria-describedby="transaction-summary">
        <thead>
          <tr>
            <th scope="col">Mobil</th>
            <th scope="col">Tipe</th>
            <th scope="col">Durasi</th>
            <th scope="col">Harga/hari</th>
            <th scope="col">Total</th>
          </tr>
        </thead>
        <tr>
          <td><?= htmlspecialchars($data['jenis_mobil']) ?></td>
          <td><?= $data['transmisi'] ?> - <?= $data['warna'] ?></td>
          <td><?= ceil($data['durasi'] / 24) ?> Hari</td>
          <td>Rp<?= number_format($data['harga_sewa'], 0, ',', '.') ?></td>
          <td>Rp<?= number_format($data['total_biaya'], 0, ',', '.') ?></td>
        </tr>
        <tr class="total-row">
          <td colspan="4" style="text-align: right;">Total Pembayaran</td>
          <td>Rp<?= number_format($data['total_biaya'], 0, ',', '.') ?></td>
        </tr>
      </table>
    </section>

    <section class="summary" style="font-family: Arial, sans-serif; padding: 16px; border: 1px solid #ddd; border-radius: 8px;">
      <div>Metode Pembayaran: <?= ucfirst($data['metode_pembayaran']) ?></div>
      <div>Status: <strong><?= ucfirst($bayar['status'] ?? 'Pending') ?></strong></div>

      <a href="riwayat.php" style="
    display: inline-block;
    margin-top: 12px;
    padding: 8px 16px;
    background-color: #007bff;
    color: white;
    text-decoration: none;
    border-radius: 4px;
    font-size: 14px;
  ">Next</a>
    </section>



  </main>
</body>

</html>