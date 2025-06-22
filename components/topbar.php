<?php
require_once __DIR__ . '/../koneksi.php';

// Ambil notifikasi terbaru (max 5), belum dibaca, untuk admin
$notifikasi_result = mysqli_query($db, "SELECT * FROM notifikasi WHERE role_tujuan = 'admin' AND dibaca = 0 ORDER BY created_at DESC LIMIT 5");
$jumlah_notifikasi = mysqli_num_rows($notifikasi_result);

// Daftar menu pencarian
$menu_list = [
    ["label" => "Data Customer", "url" => "/proyek-1/pages/admin/customer/index.php"],
    ["label" => "Data Checker", "url" => "/proyek-1/pages/admin/checker/index.php"],
    ["label" => "Jenis Mobil", "url" => "/proyek-1/pages/admin/jenis-mobil/index.php"],
    ["label" => "Unit Mobil", "url" => "/proyek-1/pages/admin/unit-mobil/index.php"],
    ["label" => "Permintaan Verifikasi", "url" => "/proyek-1/pages/admin/permintaan-sewa/index.php"],
    ["label" => "Booking Masuk", "url" => "/proyek-1/pages/admin/booking-masuk/index.php"],
    ["label" => "Laporan Pemasukan", "url" => "/proyek-1/pages/admin/laporan/laporan.php"],
    ["label" => "Dashboard", "url" => "/proyek-1/pages/admin/index.php"]
];
?>

<style>
    .dropdown-menu {
        background-color: #ffffff !important;
    }

    .dropdown-item {
        color: #000000 !important;
    }

    .bg-dark-custom {
        background-color: #1e293b !important;
    }

    .navbar {
        background-color: #1e293b;
    }
</style>

<nav class="navbar navbar-expand navbar-dark topbar mb-4 static-top shadow">
    <!-- Sidebar toggle -->
    <form class="form-inline">
        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
        </button>
    </form>

    <!-- Search form -->
    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
        <div class="position-relative">
            <input type="text" id="menuSearch" class="form-control bg-light border-0 small"
                placeholder="Cari halaman..." style="width: 250px; border-radius: 20px; padding-left: 15px;">
            <div id="menuDropdown" class="dropdown-menu shadow"
                style="position: absolute; top: 100%; left: 0; display: none; z-index: 9999;"></div>
        </div>
    </form>

    <!-- Right Navbar -->
    <ul class="navbar-nav ml-auto">
        <!-- Notifikasi -->
        <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell fa-fw"></i>
                <span class="badge badge-danger badge-counter"><?= $jumlah_notifikasi > 0 ? $jumlah_notifikasi : '' ?></span>
            </a>
            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header">Notifikasi</h6>
                <?php if ($jumlah_notifikasi > 0): ?>
                    <?php while ($notif = mysqli_fetch_assoc($notifikasi_result)): ?>
                        <?php
                        $link = '#';
                        if ($notif['tipe'] === 'verifikasi') {
                            $link = '/proyek-1/pages/admin/permintaan-sewa/index.php';
                        } elseif ($notif['tipe'] === 'booking') {
                            $link = '/proyek-1/pages/admin/booking-masuk/index.php';
                        }
                        ?>
                        <a href="<?= $link ?>" class="dropdown-item d-flex align-items-center">
                            <div class="mr-3">
                                <div class="icon-circle bg-warning">
                                    <i class="fas fa-user-check text-white"></i>
                                </div>
                            </div>
                            <div>
                                <div class="small text-gray-500"><?= date('d M Y, H:i', strtotime($notif['created_at'])) ?></div>
                                <span class="font-weight-bold"><?= htmlspecialchars($notif['pesan']) ?></span>
                            </div>
                        </a>
                    <?php endwhile; ?>
                    <a class="dropdown-item text-center small text-gray-500" href="#">Lihat Semua Notifikasi</a>
                <?php else: ?>
                    <div class="dropdown-item text-center small text-gray-500">Tidak ada notifikasi baru</div>
                <?php endif; ?>
            </div>
        </li>

        <!-- Divider -->
        <div class="topbar-divider d-none d-sm-block"></div>

        <!-- User Info -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Admin</span>
                <img class="img-profile rounded-circle" src="/proyek-1/assets/img/undraw_profile.svg">
            </a>
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Logout
                </a>
            </div>
        </li>
    </ul>
</nav>

<!-- Script Pencarian -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const menuList = <?= json_encode($menu_list) ?>;
        const input = document.getElementById("menuSearch");
        const dropdown = document.getElementById("menuDropdown");

        input.addEventListener("input", function() {
            const keyword = this.value.toLowerCase().trim();
            dropdown.innerHTML = "";

            if (!keyword) {
                dropdown.style.display = "none";
                return;
            }

            const filtered = menuList.filter(menu =>
                menu.label.toLowerCase().includes(keyword)
            );

            if (filtered.length > 0) {
                filtered.forEach(menu => {
                    const a = document.createElement("a");
                    a.href = menu.url;
                    a.className = "dropdown-item";
                    a.textContent = menu.label;
                    dropdown.appendChild(a);
                });
            } else {
                const empty = document.createElement("span");
                empty.className = "dropdown-item text-muted";
                empty.textContent = "Menu tidak ditemukan";
                dropdown.appendChild(empty);
            }

            dropdown.style.display = "block";
        });

        document.addEventListener("click", function(e) {
            const inputField = document.getElementById("menuSearch");
            const dropdown = document.getElementById("menuDropdown");
            if (!inputField.contains(e.target) && !dropdown.contains(e.target)) {
                dropdown.style.display = "none";
            }
        });
    });
</script>