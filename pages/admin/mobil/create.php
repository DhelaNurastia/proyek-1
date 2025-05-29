<?php
require_once "../../../config.php";
require '../../../koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $jenis_mobil_id = trim($_POST['jenis_mobil_id']);
    $plat_nomor = trim($_POST['plat_nomor']);
    $warna = trim($_POST['warna']);
    $tahun_beli = trim($_POST['tahun_beli']);
    $foto = $_FILES["foto"];
    $status = trim($_POST['status']);
    $fasilitas_id = trim($_POST['fasilitas_id']);

    if (empty($jenis_mobil_id) || empty($plat_nomor) || empty($warna) || empty($tahun_beli) || empty($foto) || empty($status) || empty($fasilitas_id)) {
        echo '<script>alert("isi semua data")</script>';
    } else {
        $filename = basename($foto["name"]);
        $tileType = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

        move_uploaded_file($_FILES["foto"]["tmp_name"], "uploads/" . $filename);

        $sql = "INSERT INTO unit_mobil(jenis_mobil_id, plat_nomor, warna, tahun_beli, foto, status, fasilitas_id) VALUES(?,?,?,?,?,?,?)";
        $stmt = $db->prepare($sql);
        $stmt->bind_param("isssssi", $jenis_mobil_id, $plat_nomor, $warna, $tahun_beli, $filename, $status, $fasilitas_id);
        $stmt->execute();
        $stmt->close();
        header('location: ./index.php');
        exit();
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo APP_NAME; ?></title>

    <link href="../../../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="../../../assets/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="../../../assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>

<body id="page-top">
    <div id="wrapper">
        <!-- Sidebar -->
        <?php include '../../../components/sidebar.php'; ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <!-- Topbar -->
                <?php include '../../../components/topbar.php'; ?>
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Buat fasilitas baru</h1>
                    <p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vel ipsam aspernatur voluptates consectetur labore doloribus placeat!</p>



                    <!-- ========== Konten Utama ========== -->
                    <form method="post" class="d-flex flex-column" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="jenis_mobil_id" class="form-label">Jenis Mobil</label>
                            <select name="jenis_mobil_id" id="jenis_mobil_id" class="form-control">
                                <option>Pilih Jenis Mobil</option>
                                <?php
                                $daftarJenisMobil = mysqli_query($db, "SELECT id,nama FROM jenis_mobil")->fetch_all();
                                foreach ($daftarJenisMobil as $jenisMobil):
                                ?>
                                    <option value="<?= $jenisMobil[0]; ?>"><?= $jenisMobil[1]; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="plat_nomor" class="form-label">Plat Nomor</label>
                            <input type="text" name="plat_nomor" id="plat_nomor" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="warna" class="form-label">Warna</label>
                            <input type="text" name="warna" id="warna" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="tahun_beli" class="form-label">Tahun Beli</label>
                            <input type="text" name="tahun_beli" id="tahun_beli" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="foto" class="form-label">Foto</label>
                            <input type="file" name="foto" id="foto" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" id="status" class="form-control">
                                <option>Pilih Status Unit Mobil</option>
                                <?php
                                $status = [
                                    ["value" => "tersedia", "label" => "Tersedia"],
                                    ["value" => "disewa", "label" => "Disewa"],
                                    ["value" => "perbaikan", "label" => "Perbaikan"],
                                ];
                                foreach ($status as $s):
                                ?>
                                    <option value="<?= $s["value"] ?>"><?= $s["label"] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="fasilitas_id" class="form-label">Fasilitas</label>
                            <select name="fasilitas_id" id="fasilitas_id" class="form-control">
                                <option>Pilih Fasilitas</option>
                                <?php
                                $fasilitas = mysqli_query($db, "SELECT id, nama FROM fasilitas")->fetch_all();
                                foreach ($fasilitas as $f):
                                ?>
                                    <option value="<?= $f[0] ?>"><?= $f[1] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="d-flex align-items-center justify-content-end">
                            <button type="submit" class="btn btn-primary mr-2"><i class="fas fa-save"></i> Simpan</button>
                            <a href="./index.php" class="btn btn-secondary">Kembali</a>
                        </div>
                    </form>
                    <!-- ========== Konten Utama ========== -->



                </div>
            </div>
            <!-- Footer -->
            <?php include '../../../components/footer.php'; ?>
        </div>
    </div>
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <!-- Logout modal -->
    <?php include '../../../components/logout-modal.php'; ?>

    <!-- Scripts -->
    <script src="../../../assets/vendor/jquery/jquery.min.js"></script>
    <script src="../../../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../../../assets/vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="../../../assets/js/sb-admin-2.min.js"></script>
    <script src="../../../assets/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../../../assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="../../../assets/js/demo/datatables-demo.js"></script>
</body>

</html>