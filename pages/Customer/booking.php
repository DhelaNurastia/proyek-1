<?php
$base_url = '/proyek-1/';
session_start();
include '../../navbar.php'; // pastikan path-nya sesuai
?>


<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Booking - SIGMA RENTCAR</title>
    <style>
        body {
            background-color: #000;
            color: white;
            font-family: Arial, sans-serif;
            margin: 0;
        }
        .navbar {
            background-color: #1e272e;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-radius: 0 0 25px 25px;
        }
        .navbar h1 {
            margin: 0;
            color: #f1f2f6;
        }
        .nav-links a {
            margin-left: 25px;
            color: #dcdde1;
            text-decoration: none;
        }
        .nav-links a.active {
            color: orange;
        }
        .container {
            display: flex;
            justify-content: space-between;
            padding: 30px;
        }
        .form-container, .order-summary {
            background-color: #1e272e;
            padding: 20px;
            border-radius: 10px;
            width: 48%;
        }
        input[type="text"], input[type="email"], input[type="file"], select {
            width: 100%;
            padding: 8px;
            margin: 10px 0;
            border-radius: 5px;
            border: none;
        }
        button {
            background-color: #001f3f;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }
        .order-summary img {
            width: 100%;
            height: auto;
            margin-bottom: 15px;
            background-color: #444;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="form-container">
            <h2>Rincianmu</h2>
            <input type="text" placeholder="Nama Awal">
            <input type="text" placeholder="Nama Belakang">
            <input type="text" placeholder="Alamat">
            <input type="text" placeholder="Kota Tujuan">
            <input type="text" placeholder="Nomor Hp">
            <input type="email" placeholder="Email">
            <input type="file" placeholder="Upload KK">
            <input type="file" placeholder="Upload KTP">
            <select>
                <option disabled selected>Jaminan</option>
                <option>KTP</option>
                <option>SIM</option>
                <option>NPWP</option>
            </select>
            <select>
                <option disabled selected>Metode Pembayaran</option>
                <option>Transfer Bank</option>
                <option>Tunai</option>
                <option>QRIS</option>
            </select>
            <select>
                <option disabled selected>Fasilitas</option>
                <option>Supir</option>
                <option>Tanpa Supir</option>
            </select>
            <button>Pesan sekarang</button>
        </div>

        <div class="order-summary">
            <h2>Rincian Pemesanan</h2>
            <img src="#" alt="Gambar Mobil">
            <p><strong>Merk mobil:</strong> Toyota Avanza</p>
            <p><strong>Pengambilan:</strong> 10 Juni 2025</p>
            <p><strong>Pengembalian:</strong> 13 Juni 2025</p>
        </div>
    </div>
</body>
</html>