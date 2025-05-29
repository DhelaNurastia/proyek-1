<?php
require_once '../../koneksi.php';

// Statistik utama
$total_unit = mysqli_fetch_assoc(mysqli_query($db, "SELECT COUNT(*) AS total FROM mobil"))['total'];
$total_user = mysqli_fetch_assoc(mysqli_query($db, "SELECT COUNT(*) AS total FROM users WHERE role='customer'"))['total'];
$total_pesanan = mysqli_fetch_assoc(mysqli_query($db, "SELECT COUNT(*) AS total FROM booking"))['total'];
$total_telat = mysqli_fetch_assoc(mysqli_query($db, "SELECT COUNT(*) AS total FROM booking WHERE status = 'Terlambat'"))['total'];
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Dashboard Owner</title>
    <link rel="stylesheet" href="../../assets/css/sb-admin-2.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .card-box {
            text-align: center;
            padding: 1rem;
        }

        .stat-title {
            font-size: 0.9rem;
            color: #6c757d;
        }

        .stat-value {
            font-size: 1.8rem;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <nav class="bg-primary text-white p-3" style="width: 250px; min-height: 100vh;">
            <h4>Sigma RentCar</h4>
            <hr>
            <p><strong>Dashboard</strong></p>
            <div class="mb-2">
                <label for="data-master">Data master</label>
                <select id="data-master" class="form-control">
                    <option>Data Mobil</option>
                    <option>Data Pemesan</option>
                    <option>Data Pesanan</option>
                    <option>Data Marketing</option>
                </select>
            </div>
        </nav>

        <!-- Content -->
        <div class="flex-fill p-4">
            <h2 class="mb-4">Dashboard</h2>

            <!-- Statistik Cards -->
            <div class="row text-center mb-4">
                <?php
                $cards = [
                    ['Jumlah Unit', $total_unit, '🚗'],
                    ['Jumlah User', $total_user, '👤'],
                    ['Jumlah Pesanan', $total_pesanan, '✅'],
                    ['Jumlah Keterlambatan', $total_telat, '⏰']
                ];
                foreach ($cards as [$label, $count, $icon]) {
                    echo "<div class='col-md-3'>
                            <div class='card'>
                                <div class='card-box'>
                                    <div class='stat-value'>$icon $count</div>
                                    <div class='stat-title'>$label</div>
                                    <a href='#'>Lihat selengkapnya</a>
                                </div>
                            </div>
                        </div>";
                }
                ?>
            </div>

            <!-- Grafik -->
            <div class="row">
                <div class="col-md-8">
                    <h4>Jumlah Sewa per Minggu</h4>
                    <canvas id="weeklyChart"></canvas>
                </div>
                <div class="col-md-4">
                    <h4>Kondisi Hari Ini</h4>
                    <canvas id="dailyPieChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart Scripts -->
    <script>
        // CHART: Garis
        fetch('grafik_data.php?tipe=mingguan')
            .then(res => res.json())
            .then(data => {
                new Chart(document.getElementById('weeklyChart'), {
                    type: 'line',
                    data: {
                        labels: data.labels,
                        datasets: [{
                            label: 'Jumlah Sewa',
                            data: data.values,
                            borderColor: 'blue',
                            tension: 0.3
                        }]
                    }
                });
            });

        // CHART: Lingkaran
        fetch('grafik_data.php?tipe=harian')
            .then(res => res.json())
            .then(data => {
                new Chart(document.getElementById('dailyPieChart'), {
                    type: 'pie',
                    data: {
                        labels: data.labels,
                        datasets: [{
                            data: data.values,
                            backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc']
                        }]
                    }
                });
            });
    </script>
</body>

</html>