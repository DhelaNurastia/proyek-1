<?php
session_start();
require_once '../../koneksi.php';
$base_url = '/proyek-1/';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit;
}

$userId = $_SESSION['user_id'];

// Ambil data user + dokumen
$query = $db->prepare("SELECT u.nama_lengkap, u.nama, u.email, u.telepon, u.alamat, u.foto_profile, d.file_kk, d.file_ktp, d.file_sim, u.blacklist
                      FROM users u
                      LEFT JOIN dokumen_user d ON u.id = d.id_user
                      WHERE u.id = ?");
$query->bind_param("i", $userId);
$query->execute();
$result = $query->get_result();
$user = $result->fetch_assoc();

$fotoPath = (!empty($user['foto_profile']))
    ? "../../uploads/foto_profile/" . $user['foto_profile']
    : "../../assets/image/default.png";

// ==== FORM DIPROSES ====
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_lengkap = $_POST['nama'];
    $email = $_POST['email'];
    $telepon = $_POST['telepon'];
    $alamat = $_POST['alamat'];

    if (empty($nama_lengkap) || empty($email) || empty($telepon) || empty($alamat)) {
        $error = "Semua field wajib diisi.";
    } else {
        // 1. Update profil
        $stmt = $db->prepare("UPDATE users SET nama_lengkap = ?, email = ?, telepon = ?, alamat = ? WHERE id = ?");
        $stmt->bind_param("ssssi", $nama_lengkap, $email, $telepon, $alamat, $userId);
        $stmt->execute();

        // 2. Upload dokumen
        $upload_dir = '../../uploads/dokumen-user/';
        $allowed_types = ['image/jpeg', 'image/png', 'application/pdf'];

        function uploadDokumen($input_name)
        {
            global $upload_dir, $allowed_types;

            if (!empty($_FILES[$input_name]['name'])) {
                $tmp = $_FILES[$input_name]['tmp_name'];
                $type = mime_content_type($tmp);

                if (in_array($type, $allowed_types)) {
                    $filename = uniqid() . '_' . basename($_FILES[$input_name]['name']);
                    move_uploaded_file($tmp, $upload_dir . $filename);
                    return $filename;
                }
            }
            return '';
        }

        $file_kk = uploadDokumen('file_kk');
        $file_ktp = uploadDokumen('file_ktp');
        $file_sim = uploadDokumen('file_sim');

        // 3. Cek apakah dokumen_user sudah ada
        $cek = $db->prepare("SELECT id_user FROM dokumen_user WHERE id_user = ?");
        $cek->bind_param("i", $userId);
        $cek->execute();
        $hasil = $cek->get_result();

        if ($hasil->num_rows === 0) {
            $insert = $db->prepare("INSERT INTO dokumen_user (id_user) VALUES (?)");
            $insert->bind_param("i", $userId);
            $insert->execute();
        }

        // 4. Update dokumen (jika ada file baru)
        $update = $db->prepare("UPDATE dokumen_user SET 
            file_kk = COALESCE(NULLIF(?, ''), file_kk),
            file_ktp = COALESCE(NULLIF(?, ''), file_ktp),
            file_sim = COALESCE(NULLIF(?, ''), file_sim)
            WHERE id_user = ?");
        $update->bind_param("sssi", $file_kk, $file_ktp, $file_sim, $userId);
        $update->execute();

        // 5. Selesai
        header("Location: profile.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Profile</title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Favicons -->
    <link href="<?= $base_url ?>assets/image/favicon.jpeg" rel="icon">
    <link href="<?= $base_url ?>assets/template/home/Strategy/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Nunito+Sans:ital,wght@0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <!-- Material Icons for consistent iconography -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="<?= $base_url ?>assets/template/home/Strategy/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= $base_url ?>assets/template/home/Strategy/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="<?= $base_url ?>assets/template/home/Strategy/assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="<?= $base_url ?>assets/template/home/Strategy/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link href="<?= $base_url ?>assets/template/home/Strategy/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="<?= $base_url ?>assets/template/home/Strategy/assets/css/main.css" rel="stylesheet">

    <style>
        /* Profile Section Styling */
        #profile-section {
            padding: 40px 0 60px;
            max-width: 1080px;
            margin: 0 auto;
        }

        #profile-section .profile-card {
            background: rgba(255, 255, 255, 0.14);
            backdrop-filter: blur(20px);
            border-radius: 1rem;
            box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.12);
            padding: 2rem;
            transition: box-shadow 0.3s ease;
        }

        #profile-section .profile-card:hover,
        #profile-section .profile-card:focus-within {
            box-shadow: 0 16px 48px 0 rgba(0, 0, 0, 0.25);
        }

        #profile-section h2 {
            font-weight: 700;
            font-size: clamp(1.8rem, 2vw, 2.5rem);
            margin-bottom: 1.2rem;
            color: #000000;
        }

        #profile-section .status-badge {
            display: flex;
            /* ubah dari inline-flex agar bisa full width */
            align-items: center;
            justify-content: center;
            /* agar teks tetap di tengah */
            gap: 6px;
            font-weight: 600;
            font-size: 0.9rem;
            padding: 10px 16px;
            border-radius: 12px;
            color: white;
            user-select: none;
            width: 100%;
            /* ini membuat elemen memenuhi seluruh lebar parent */
        }

        #profile-section .status-active {
            background: #22c55e;
            /* Green */
            box-shadow: 0 0 8px #22c55e;
        }

        #profile-section .status-inactive {
            background: #ef4444;
            /* Red */
            box-shadow: 0 0 8px #ef4444;
        }

        #profile-section .profile-info {
            margin-top: 24px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.6rem 3rem;
            color: #000000;
            font-family: 'Nunito Sans', sans-serif;
        }

        #profile-section .profile-info-item {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: clamp(1rem, 1vw, 1.1rem);
        }

        #profile-section .profile-info-item .material-icons {
            font-size: 24px;
            color: #6366f1;
            /* Indigo-500 */
        }

        #profile-section .documents {
            margin-top: 2.5rem;
        }

        #profile-section .documents h3 {
            font-weight: 600;
            margin-bottom: 1rem;
            color: #000000;
            font-size: clamp(1.4rem, 1.8vw, 1.6rem);
        }

        #profile-section .doc-list {
            display: flex;
            flex-wrap: wrap;
            gap: 1.6rem;
        }

        #profile-section .doc-card {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 1rem;
            box-shadow: 0 6px 18px rgb(0 0 0 / 0.1);
            width: 160px;
            cursor: pointer;
            transition: transform 0.25s ease, box-shadow 0.3s ease;
            text-align: center;
            padding: 1rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            user-select: none;
        }

        #profile-section .doc-card:hover,
        #profile-section .doc-card:focus-visible {
            transform: translateY(-6px);
            box-shadow: 0 12px 36px rgba(0, 0, 0, 0.22);
            outline: none;
        }

        #profile-section .doc-card img {
            max-width: 100%;
            border-radius: 0.75rem;
            margin-bottom: 0.8rem;
            user-select: none;
            pointer-events: none;
            aspect-ratio: 4 / 3;
            object-fit: cover;
            box-shadow: 0 3px 8px rgb(0 0 0 / 0.1);
            border: 1px solid rgba(0, 0, 0, 0.12);
        }

        #profile-section .doc-card .doc-label {
            font-weight: 600;
            font-size: 1rem;
            color: #000000;
        }

        /* Responsive adjustments */
        @media (max-width: 767px) {
            #profile-section .profile-info {
                grid-template-columns: 1fr;
                gap: 1.2rem 0;
            }

            #profile-section .doc-list {
                justify-content: center;
            }
        }

        /* Modal Styles */
        #doc-modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100dvh;
            display: none;
            align-items: center;
            justify-content: center;
            background: rgba(30, 41, 59, 0.85);
            backdrop-filter: blur(12px);
            z-index: 1050;
            padding: 1rem;
            overflow-y: auto;
            will-change: opacity;
            transition: opacity 0.3s ease;
        }

        #doc-modal.show {
            display: flex;
            opacity: 1;
        }

        #doc-modal .modal-content {
            position: relative;
            width: 100%;
            max-width: 720px;
            /* atau sesuaikan dengan keinginanmu */
            max-height: 90vh;
            background: rgba(255 255 255 / 0.15);
            border-radius: 1rem;
            backdrop-filter: blur(24px);
            box-shadow: 0 24px 48px rgb(0 0 0 / 0.3);
            padding: 1.5rem;
            cursor: default;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }


        #doc-modal .modal-image {
            max-width: 100%;
            max-height: 80vh;
            border-radius: 1rem;
            object-fit: contain;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
            user-select: none;
        }

        #doc-modal .modal-close-button {
            position: absolute;
            top: 12px;
            right: 12px;
            background: rgba(0, 0, 0, 0.3);
            border: none;
            border-radius: 50%;
            color: white;
            width: 36px;
            height: 36px;
            font-size: 24px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background-color 0.2s ease;
        }

        #doc-modal .modal-close-button:hover,
        #doc-modal .modal-close-button:focus {
            background: rgba(0, 0, 0, 0.6);
            outline: none;
        }

        /* Prevent background scroll when modal is open */
        body.modal-open {
            overflow: hidden;
        }

        .status-badge {
            padding: 8px 16px;
            border-radius: 25px;
            font-weight: bold;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .status-active {
            background-color: #22c55e;
            color: white;
        }

        .status-blacklist {
            background-color: #ef4444;
            color: white;
        }
    </style>

    <!-- =======================================================
  * Template Name: Strategy
  * Template URL: https://bootstrapmade.com/strategy-bootstrap-agency-template/
  * Updated: May 09 2025 with Bootstrap v5.3.6
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body class="starter-page-page">

    <header id="header" class="header d-flex align-items-center fixed-top">
        <div class="header-container container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

            <a href="index.html" class="logo d-flex align-items-center me-auto me-xl-0">
                <!-- Uncomment the line below if you also wish to use an image logo -->
                <!-- <img src="assets/img/logo.webp" alt=""> -->
                <h1 class="sitename">Strategy</h1>
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="listing.php">Daftar Mobil</a></li>
                    <li class="dropdown"><a href="#"><span>Riwayat</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                        <ul>
                            <li><a href="riwayat.php" class="active">Riwayat Booking</a></li>
                            <li><a href="denda.php">Riwayat Denda</a></li>
                        </ul>
                    <li class="dropdown"><a href="#" class="active"><span>Akun</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                        <ul>
                            <li><a href="profile.php">Profile</a></li>
                            <li><a href="../Halaman_Register&Login/logout.php">LogOut</a></li>
                        </ul>
                    </li>
                    <li><a href="../customer/index.php/#contact">Kontak</a></li>
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>

        </div>
    </header>

    <main class="main">


        <!-- Profile Section -->
        <main class="main">
            <div class="page-title dark-background" data-aos="fade">
                <div class="container position-relative">
                    <h1>Edit Profil</h1>
                    <p>Perbarui informasi akun Anda di halaman ini.</p>
                </div>
            </div>

            <section class="container form-section" data-aos="fade-up">
                <form method="POST" action="" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Lengkap</label>
                        <input type="text" name="nama" class="form-control" id="nama" value="<?= htmlspecialchars($user['nama_lengkap']) ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" id="email" value="<?= htmlspecialchars($user['email']) ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="telepon" class="form-label">Nomor Telepon</label>
                        <input type="text" name="telepon" class="form-control" id="telepon" value="<?= htmlspecialchars($user['telepon']) ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea name="alamat" class="form-control" id="alamat" rows="3"><?= htmlspecialchars($user['alamat']) ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="file_kk" class="form-label">Upload Kartu Keluarga (KK)</label>
                        <input type="file" name="file_kk" class="form-control" id="file_kk" accept=".jpg,.jpeg,.png,.pdf">
                    </div>

                    <div class="mb-3">
                        <label for="file_ktp" class="form-label">Upload KTP</label>
                        <input type="file" name="file_ktp" class="form-control" id="file_ktp" accept=".jpg,.jpeg,.png,.pdf">
                    </div>

                    <div class="mb-3">
                        <label for="file_sim" class="form-label">Upload SIM</label>
                        <input type="file" name="file_sim" class="form-control" id="file_sim" accept=".jpg,.jpeg,.png,.pdf">
                    </div>
                    <div class="d-flex justify-content-between">
                        <a href="profile.php" class="btn btn-secondary">Batal</a>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </section>
        </main>

        <!-- Document Modal -->
        <div id="doc-modal" role="dialog" aria-modal="true" aria-labelledby="doc-modal-title" aria-describedby="doc-modal-desc" tabindex="-1">
            <div class="modal-content">
                <button class="modal-close-button" aria-label="Close document preview" title="Close document preview">
                    <span class="material-icons" aria-hidden="true">close</span>
                </button>
                <img src="" alt="" class="modal-image" />
            </div>
        </div>

    </main>

    <footer id="footer" class="footer">

        <div class="container footer-top">
            <div class="row gy-4">
                <div class="col-lg-5 col-md-12 footer-about">
                    <a href="index.html" class="logo d-flex align-items-center">
                        <span class="sitename">Strategy</span>
                    </a>
                    <p>Cras fermentum odio eu feugiat lide par naso tierra. Justo eget nada terra videa magna derita valies darta donna mare fermentum iaculis eu non diam phasellus.</p>
                    <div class="social-links d-flex mt-4">
                        <a href=""><i class="bi bi-twitter-x"></i></a>
                        <a href=""><i class="bi bi-facebook"></i></a>
                        <a href=""><i class="bi bi-instagram"></i></a>
                        <a href=""><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>

                <div class="col-lg-2 col-6 footer-links">
                    <h4>Useful Links</h4>
                    <ul>
                        <li><a href="#">Home</a></li>
                        <li><a href="#">About us</a></li>
                        <li><a href="#">Services</a></li>
                        <li><a href="#">Terms of service</a></li>
                        <li><a href="#">Privacy policy</a></li>
                    </ul>
                </div>

                <div class="col-lg-2 col-6 footer-links">
                    <h4>Our Services</h4>
                    <ul>
                        <li><a href="#">Web Design</a></li>
                        <li><a href="#">Web Development</a></li>
                        <li><a href="#">Product Management</a></li>
                        <li><a href="#">Marketing</a></li>
                        <li><a href="#">Graphic Design</a></li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">
                    <h4>Contact Us</h4>
                    <p>A108 Adam Street</p>
                    <p>New York, NY 535022</p>
                    <p>United States</p>
                    <p class="mt-4"><strong>Phone:</strong> <span>+1 5589 55488 55</span></p>
                    <p><strong>Email:</strong> <span>info@example.com</span></p>
                </div>

            </div>
        </div>

        <div class="container copyright text-center mt-4">
            <p>© <span>Copyright</span> <strong class="px-1 sitename">Strategy</strong> <span>All Rights Reserved</span></p>
            <div class="credits">
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you've purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->
                Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
            </div>
        </div>

    </footer>

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="<?= $base_url ?>assets/template/home/Strategy/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= $base_url ?>assets/template/home/Strategy/assets/vendor/php-email-form/validate.js"></script>
    <script src="<?= $base_url ?>assets/template/home/Strategy/assets/vendor/aos/aos.js"></script>
    <script src="<?= $base_url ?>assets/template/home/Strategy/assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="<?= $base_url ?>assets/template/home/Strategy/assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="<?= $base_url ?>assets/template/home/Strategy/assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
    <script src="<?= $base_url ?>assets/template/home/Strategy/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>

    <!-- Main JS File -->
    <script src="<?= $base_url ?>assets/template/home/Strategy/assets/js/main.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const docList = document.querySelector('#profile-section .doc-list');
            const modal = document.getElementById('doc-modal');
            const modalImage = modal.querySelector('.modal-image');
            const closeBtn = modal.querySelector('.modal-close-button');

            if (!docList) return;

            docList.addEventListener('click', (e) => {
                const anchor = e.target.closest('a.doc-card');
                if (!anchor) return;
                e.preventDefault();

                const imgSrc = anchor.dataset.imgSrc;
                const imgAlt = anchor.querySelector('.doc-label')?.textContent + ' enlarged preview';
                if (imgSrc) {
                    modalImage.src = imgSrc;
                    modalImage.alt = imgAlt;
                    modal.classList.add('show');
                    document.body.classList.add('modal-open');
                    modal.focus();
                }
            });

            function closeModal() {
                modal.classList.remove('show');
                document.body.classList.remove('modal-open');
                modalImage.src = '';
                modalImage.alt = '';
            }

            closeBtn.addEventListener('click', closeModal);
            modal.addEventListener('click', (e) => {
                if (e.target === modal) {
                    closeModal();
                }
            });
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape' && modal.classList.contains('show')) {
                    closeModal();
                }
            });
        });
    </script>


</body>

</html>