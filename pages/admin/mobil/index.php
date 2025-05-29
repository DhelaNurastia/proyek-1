<?php
require_once "../../../config.php";
require '../../../koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];

    $sql = 'DELETE FROM unit_mobil WHERE id_mobil = ?';
    $stmt = $db->prepare($sql);
    $stmt->execute([$id]);

    header('location: ./index.php');
    exit();
}

// $query = mysqli_query($db, "SELECT * FROM unit_mobil ORDER BY nama ASC");
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

    <style>
        .container {
            padding: 2rem;
        }

        .card-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
        }

        .unit_mobil-card {
            border: 1px solid #ddd;
            border-radius: 10px;
            overflow: hidden;
            background: #fff;
            transition: box-shadow .3s;
        }

        .unit_mobil-card:hover {
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
        }

        .unit_mobil-card img {
            width: 100%;
            height: 180px;
            object-fit: cover;
        }

        .unit_mobil-content {
            padding: 1rem;
        }

        .unit_mobil-content h4 {
            margin: 0 0 0.5rem;
            font-size: 1.1rem;
        }

        .unit_mobil-info {
            font-size: 0.9rem;
            color: #555;
        }

        .unit_mobil-status {
            font-weight: bold;
            margin-top: 0.5rem;
            display: inline-block;
            padding: 0.3rem 0.6rem;
            border-radius: 6px;
            font-size: 0.85rem;
        }

        .ready {
            background-color: #d4edda;
            color: #155724;
        }

        .disewa {
            background-color: #fff3cd;
            color: #856404;
        }

        .perawatan {
            background-color: #f8d7da;
            color: #721c24;
        }

        .card-actions {
            margin-top: 1rem;
        }

        .card-actions a {
            text-decoration: none;
            padding: 5px 10px;
            margin-right: 5px;
            border-radius: 4px;
            font-size: 0.85rem;
            color: white;
        }

        .edit-btn {
            background: #007bff;
        }

        .hapus-btn {
            background: #dc3545;
        }
    </style>
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
                    <h1 class="h3 mb-2 text-gray-800">Unit Mobil</h1>
                    <p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vel ipsam aspernatur voluptates consectetur labore doloribus placeat!</p>



                    <!-- Konten Utama -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex justify-content-between align-items-center">
                            <h6 class="m-0 font-weight-bold text-primary">Tabel Unit Mobil</h6>
                            <a href="./create.php" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Unit Mobil Baru</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Foto</th>
                                            <th>Jenis Mobil</th>
                                            <th>Plat Nomor</th>
                                            <th>Harga Sewa</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Foto</th>
                                            <th>Jenis Mobil</th>
                                            <th>Plat Nomor</th>
                                            <th>Harga Sewa</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                        $sql = 'SELECT * FROM unit_mobil AS um JOIN jenis_mobil AS jm ON um.jenis_mobil_id = jm.id ORDER BY um.id DESC';
                                        $data = $db->query($sql)->fetch_all();

                                        foreach ($data as $index => $d):
                                        ?>
                                            <tr>
                                                <td><?php echo $index + 1; ?></td>
                                                <td><img src="uploads/<?php echo $d[4]; ?>" alt="Foto unit_mobil" style="max-width: 150px; border-radius: 8px;"></td>
                                                <td><?php echo $d[9]; ?></td>
                                                <td><?php echo $d[2]; ?></td>
                                                <td>Rp <?php echo number_format($d[10]); ?></td>
                                                <td><?php echo strtoupper($d[6]); ?></td>
                                                <td>
                                                    <form method="post">
                                                        <input type="hidden" name="id" value="<?php echo $d[0]; ?>">
                                                        <a href="edit.php?id=<?php echo $d[0]; ?>" class="mr-2 btn btn-sm btn-secondary"><i class="fas fa-edit"></i></a>
                                                        <button onclick="return confirm('Hapus data unit_mobil?');" type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                                    </form>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <?php include '../../../components/footer.php'; ?>
        </div>
    </div>

    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <?php include '../../../components/logout-modal.php'; ?>

    <script src="../../../assets/vendor/jquery/jquery.min.js"></script>
    <script src="../../../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../../../assets/vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="../../../assets/js/sb-admin-2.min.js"></script>
    <script src="../../../assets/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../../../assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="../../../assets/js/demo/datatables-demo.js"></script>
</body>

</html>