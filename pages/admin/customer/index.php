<?php
require_once '../../../koneksi.php';

$query = mysqli_query($db, "
    SELECT users.id, users.nama, users.email, dokumen_user.file_ktp, dokumen_user.file_sim, dokumen_user.file_kk
    FROM users
    LEFT JOIN dokumen_user ON users.id = dokumen_user.id_user
    WHERE users.role = 'customer'
    ORDER BY users.id
");

?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Data Customer</title>

    <!-- Custom fonts for this template-->
    <link href="../../../assets/template/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../../../assets/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include '../../../components/sidebar.php'; ?>
        <!-- End Of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php include '../../../components/topbar.php' ?>

                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Data Customer</h1>
                        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
                    </div>

                    <!-- MAIN -->
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Telepon</th>
                                        <th>Email</th>
                                        <th>KTP</th>
                                        <th>SIM</th>
                                        <th>KK</th>
                                        <th>Blacklist</th>

                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Telepon</th>
                                        <th>Email</th>
                                        <th>KTP</th>
                                        <th>SIM</th>
                                        <th>KK</th>
                                        <th>Blacklist</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php $result = mysqli_query($db, "SELECT users.*, dokumen_user.file_ktp, dokumen_user.file_sim, dokumen_user.file_kk 
                                    FROM users 
                                    LEFT JOIN dokumen_user ON users.id = dokumen_user.id_user 
                                    WHERE role = 'customer' 
                                    ORDER BY users.id");
                                    $no = 1;
                                    while ($user = mysqli_fetch_assoc($result)): ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= $user['nama']; ?></td>
                                            <td><?= $user['telepon']; ?></td>
                                            <td><?= $user['email']; ?></td>

                                            <td>
                                                <?php if ($user['file_ktp']): ?>
                                                    <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#modalGambar" data-gambar="/proyek-1/uploads/dokumen-user/<?= $user['file_ktp'] ?>">Lihat</button>
                                                <?php else: ?>
                                                    <em class="text-muted">Belum ada</em>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <?php if ($user['file_sim']): ?>
                                                    <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#modalGambar" data-gambar="/proyek-1/uploads/dokumen-user/<?= $user['file_sim'] ?>">Lihat</button>
                                                <?php else: ?>
                                                    <em class="text-muted">Belum ada</em>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <?php if ($user['file_kk']): ?>
                                                    <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#modalGambar" data-gambar="/proyek-1/uploads/dokumen-user/<?= $user['file_kk'] ?>">Lihat</button>
                                                <?php else: ?>
                                                    <em class="text-muted">Belum ada</em>
                                                <?php endif; ?>
                                            </td>


                                            <td>
                                                <form action="./actions.php" method="post">
                                                    <input type="hidden" name="id" value="<?= $user['id']; ?>">
                                                    <input type="hidden" name="blacklist" value="<?= $user['blacklist']; ?>">
                                                    <button type="submit" name="toggle_blacklist" class="btn btn-sm <?= $user['blacklist'] ? "btn-primary" : "btn-danger"; ?>" onclick="return <?= $user['blacklist'] ? 'confirm(`Batalkan blacklist?`)' : 'confirm(`Blacklist?`)' ?>"><?= $user['blacklist'] ? "Batalkan blacklist" : "Blacklist"; ?></button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                            <!-- Modal untuk menampilkan gambar -->
                            <div class="modal fade" id="modalGambar" tabindex="-1" role="dialog" aria-labelledby="modalGambarLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalGambarLabel">Gambar Dokumen</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <img id="gambarDokumen" src="" alt="Dokumen" class="img-fluid">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

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

            <script src="../../../assets/template/vendor/jquery/jquery.min.js"></script>
            <script src="../../../assets/template/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>


            <script>
                $(document).ready(function() {
                    $('#modalGambar').on('show.bs.modal', function(event) {
                        var button = $(event.relatedTarget);
                        var gambar = button.data('gambar');
                        var modal = $(this);
                        modal.find('#gambarDokumen').attr('src', gambar);
                    });
                });
            </script>
</body>

</html>