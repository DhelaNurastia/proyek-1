<?php
require_once '../../koneksi.php';


// Statistik dashboard
$total_unit = mysqli_fetch_assoc(mysqli_query($db, "SELECT COUNT(*) AS total FROM unit_mobil"))['total'];
$total_booking = mysqli_fetch_assoc(mysqli_query($db, "SELECT COUNT(*) AS total FROM booking"))['total'];
$total_customer = mysqli_fetch_assoc(mysqli_query($db, "SELECT COUNT(*) AS total FROM users WHERE role = 'customer'"))['total'];
$tanggal_hari_ini = date('Y-m-d');
$permintaan_sewa = mysqli_fetch_assoc(mysqli_query($db, "SELECT COUNT(*) AS total FROM booking WHERE status = 'menunggu' AND DATE(tgl_booking) = '$tanggal_hari_ini'"))['total'];
?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="../../../assets/template/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../../assets/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="../../assets/css/custom.css" rel="stylesheet">

    <style>
        .card-box {
            padding: 2rem;
            /* lebih lega */
            min-height: 160px;
            /* lebih tinggi */
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            background-color: black;
        }

        /* body {
            background-color: #111827;
        } */


        .stat-value {
            font-size: 2.5rem;
            /* angka besar */
            font-weight: bold;
            margin-bottom: 0.5rem;
        }

        .stat-title {
            font-size: 1.2rem;
            /* label besar */
            color: #6c757d;
        }

        .card {
            /* background-color: #111827; */
            color: white;
        }
    </style>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include '../../components/sidebar.php'; ?>
        <!-- End Of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php include '../../components/topbar.php' ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
                    </div>
                    <!-- Content Row -->
                    <div class="row">

                        <!-- Unit mobil card-->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Jumlah Unit Mobil</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_unit ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-car fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Total booking card -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Total Booking</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_booking ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-bookmark fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Total customer card -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Customer</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_customer ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-users fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Permintaan booking hari ini -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Permintaan Sewa Masuk Hari Ini</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $permintaan_sewa ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Content Row End -->


                    <!-- Grafik dan pie chart -->
                    <div class="row">

                        <?php
                        require_once '../../koneksi.php';

                        // --- Data untuk Area Chart: jumlah sewa per minggu terakhir ---
                        $weekly = [];
                        for ($i = 6; $i >= 0; $i--) {
                            $tanggal = date('Y-m-d', strtotime("-$i days"));
                            $q = mysqli_query($db, "SELECT COUNT(*) AS total FROM booking WHERE DATE(tgl_booking) = '$tanggal'");
                            $row = mysqli_fetch_assoc($q);
                            $weekly['labels'][] = date('D', strtotime($tanggal)); // Contoh: Mon, Tue
                            $weekly['data'][] = $row['total'];
                        }

                        // --- Data untuk Pie Chart: kondisi hari ini ---
                        $today = date('Y-m-d');

                        $sewa_hari_ini = mysqli_fetch_assoc(mysqli_query($db, "SELECT COUNT(*) AS total FROM booking WHERE DATE(tgl_booking) = '$today'"))['total'];
                        $kembali_hari_ini = mysqli_fetch_assoc(mysqli_query($db, "SELECT COUNT(*) AS total FROM booking WHERE DATE(tgl_kembali) = '$today'"))['total'];
                        $booking_masuk = mysqli_fetch_assoc(mysqli_query($db, "SELECT COUNT(*) AS total FROM booking WHERE status = 'masuk' AND DATE(created_at) = '$today'"))['total'];
                        ?>

                        <!DOCTYPE html>
                        <html lang="id">

                        <head>
                            <meta charset="UTF-8">
                            <title>Grafik Dashboard</title>
                            <link rel="stylesheet" href="../../assets/template/sb-admin-2.css">
                            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                        </head>

                        <body class="p-0">

                            <div class="row">
                                <!-- Area Chart -->
                                <div class="col-xl-8 col-lg-7">
                                    <div class="card shadow mb-4">
                                        <div class="card-header d-flex justify-content-between align-items-center">
                                            <h6 class="m-0 font-weight-bold text-primary">Jumlah Sewa per Hari</h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="chart-area">
                                                <canvas id="areaChart"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Pie Chart -->
                                <div class="col-xl-4 col-lg-5">
                                    <div class="card shadow mb-4">
                                        <div class="card-header d-flex justify-content-between align-items-center">
                                            <h6 class="m-0 font-weight-bold text-primary">Kondisi Hari Ini</h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="chart-pie pt-4 pb-2">
                                                <canvas id="pieChart"></canvas>
                                            </div>
                                            <div class="mt-4 text-center small">
                                                <span class="mr-2"><i class="fas fa-circle text-primary"></i> Sewa Hari Ini</span>
                                                <span class="mr-2"><i class="fas fa-circle text-success"></i> Pengembalian Hari Ini</span>
                                                <span class="mr-2"><i class="fas fa-circle text-info"></i> Booking Masuk</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <script>
                                const ctxArea = document.getElementById("areaChart").getContext('2d');
                                new Chart(ctxArea, {
                                    type: 'line',
                                    data: {
                                        labels: <?= json_encode($weekly['labels']) ?>,
                                        datasets: [{
                                            label: "Sewa",
                                            data: <?= json_encode($weekly['data']) ?>,
                                            backgroundColor: 'rgba(78, 115, 223, 0.1)',
                                            borderColor: ' #111827',
                                            pointRadius: 3,
                                            pointBackgroundColor: ' #111827',
                                            tension: 0.3,
                                        }]
                                    },
                                    options: {
                                        responsive: true,
                                        scales: {
                                            y: {
                                                beginAtZero: true
                                            }
                                        }
                                    }
                                });

                                const ctxPie = document.getElementById("pieChart").getContext('2d');
                                new Chart(ctxPie, {
                                    type: 'doughnut',
                                    data: {
                                        labels: ["Sewa Hari Ini", "Pengembalian Hari Ini", "Booking Masuk"],
                                        datasets: [{
                                            data: [<?= $sewa_hari_ini ?>, <?= $kembali_hari_ini ?>, <?= $booking_masuk ?>],
                                            backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc'],
                                            hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf']
                                        }]
                                    },
                                    options: {
                                        responsive: true,
                                        plugins: {
                                            legend: {
                                                position: 'bottom'
                                            }
                                        }
                                    }
                                });
                            </script>
                            <!-- End Grafik dan pie chart -->

                            <div class="row">

                            </div>
                    </div>
                    <!-- End of Main Content -->

                    <!-- Footer -->
                    <footer class="sticky-footer bg-white">
                        <div class="container my-auto">
                            <div class="copyright text-center my-auto">
                                <span>Copyright &copy; Your Website 2021</span>
                            </div>
                        </div>
                    </footer>
                    <!-- End of Footer -->

                </div>
                <!-- End of Content Wrapper -->

            </div>
            <!-- End of Page Wrapper -->

            <!-- Scroll to Top Button-->
            <a class="scroll-to-top rounded" href="#page-top">
                <i class="fas fa-angle-up"></i>
            </a>

            <!-- Logout Modal-->
            <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                            <a class="btn btn-primary" href="../Halaman_Register&Login/logout.php">Logout</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bootstrap core JavaScript -->
            <script src="../../assets/vendor/jquery/jquery.min.js"></script>
            <script src="../../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

            <!-- Core plugin JavaScript -->
            <script src="../../assets/vendor/jquery-easing/jquery.easing.min.js"></script>

            <!-- Custom scripts for all pages -->
            <script src="../../assets/js/sb-admin-2.min.js"></script>

            <!-- Page level plugins -->
            <script src="../../assets/vendor/chart.js/Chart.min.js"></script>

            <!-- Page level custom scripts -->
            <script src="../../assets/js/demo/chart-area-demo.js"></script>
            <script src="../../assets/js/demo/chart-pie-demo.js"></script>
</body>

</html>