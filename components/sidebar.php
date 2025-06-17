<?php
require_once __DIR__ . "/../config.php";
$current_uri = $_SERVER['REQUEST_URI'];

// Buat penanda bagian aktif
$isDashboard       = strpos($current_uri, '/admin/index.php') !== false;
$isUnitMobil           = strpos($current_uri, '/admin/unit-mobil/') !== false;
$isJenisMobil       = strpos($current_uri, '/admin/jenis-mobil/') !== false;
$isMobilSection    = $isUnitMobil || $isJenisMobil;

$isSewaPermintaan  = strpos($current_uri, '/admin/permintaan') !== false;
$isSewaAktif       = strpos($current_uri, '/admin/sewa-aktif') !== false;
$isRiwayat         = strpos($current_uri, '/admin/riwayat') !== false;
$isSewaSection     = $isSewaPermintaan || $isSewaAktif || $isRiwayat;

$isCustomer        = strpos($current_uri, 'customer/index.php') !== false;
$isMarketing       = strpos($current_uri, 'marketing/index.php') !== false;
$isChecker         = strpos($current_uri, 'checker/index.php') !== false;

$isPages           = strpos($current_uri, 'login.php') !== false || strpos($current_uri, 'register.php') !== false || strpos($current_uri, 'forgot-password.php') !== false;
?>

<style>
    .custom-sidebar-bg {
        background-color: #111827 !important;
    }
</style>
<ul class="navbar-nav sidebar sidebar-dark accordion custom-sidebar-bg" id="accordionSidebar">


    <!-- Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= BASE_URL ?>/admin/index.php">
        <div class="sidebar-brand-icon rotate-n-15"><i class="fas fa-laugh-wink"></i></div>
        <div class="sidebar-brand-text mx-3">Sigma RentCar</div>
    </a>

    <hr class="sidebar-divider my-0">

    <!-- Dashboard -->
    <li class="nav-item <?= $isDashboard ? 'active' : '' ?>">
        <a class="nav-link" href="<?= BASE_URL ?>/admin/index.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <hr class="sidebar-divider">
    <div class="sidebar-heading">Kelola Data</div>

    <!-- Mobil Section -->
    <li class="nav-item">
        <a class="nav-link <?= $isMobilSection ? '' : 'collapsed' ?>" href="#" data-toggle="collapse" data-target="#collapseMobil"
            aria-expanded="<?= $isMobilSection ? 'true' : 'false' ?>" aria-controls="collapseMobil">
            <i class="fas fa-fw fa-car"></i>
            <span>Mobil</span>
        </a>
        <div id="collapseMobil" class="collapse <?= $isMobilSection ? 'show' : '' ?>" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item <?= $isJenisMobil ? 'active' : '' ?>" href="<?= BASE_URL ?>/admin/jenis-mobil/index.php">Jenis Mobil</a>
                <a class="collapse-item <?= $isUnitMobil ? 'active' : '' ?>" href="<?= BASE_URL ?>/admin/unit-mobil/index.php">Unit Mobil</a>
            </div>
        </div>
    </li>

    <!-- Data Sewa Section -->
    <li class="nav-item">
        <a class="nav-link <?= $isSewaSection ? '' : 'collapsed' ?>" href="#" data-toggle="collapse" data-target="#collapseSewa"
            aria-expanded="<?= $isSewaSection ? 'true' : 'false' ?>" aria-controls="collapseSewa">
            <i class="fas fa-fw fa-calendar-check"></i>
            <span>Data Sewa</span>
        </a>
        <div id="collapseSewa" class="collapse <?= $isSewaSection ? 'show' : '' ?>" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item <?= $isSewaPermintaan ? 'active' : '' ?>" href="<?= BASE_URL ?>/admin/permintaan-sewa/index.php">📥 Permintaan Verifikasi</a>
                <a class="collapse-item <?= $isSewaAktif ? 'active' : '' ?>" href="<?= BASE_URL ?>/admin/booking-masuk/index.php">📊 Booking Masuk</a>
                <a class="collapse-item <?= $isRiwayat ? 'active' : '' ?>" href="<?= BASE_URL ?>/admin/riwayat.php">📂 Riwayat Sewa</a>
            </div>
        </div>
    </li>

    <hr class="sidebar-divider">
    <div class="sidebar-heading">Manajemen Pengguna</div>

    <li class="nav-item">
        <a class="nav-link <?= $isCustomer ? 'active' : '' ?>" href="<?= BASE_URL ?>/admin/customer/index.php">
            <i class="fas fa-fw fa-user"></i>
            <span>Data Customer</span>
        </a>
        <a class="nav-link <?= $isMarketing ? 'active' : '' ?>" href="<?= BASE_URL ?>/admin/marketing/index.php">
            <i class="fas fa-fw fa-user-tie"></i>
            <span>Data Marketing</span>
        </a>
        <a class="nav-link <?= $isChecker ? 'active' : '' ?>" href="<?= BASE_URL ?>/admin/checker/index.php">
            <i class="fas fa-fw fa-user-check"></i>
            <span>Data Checker</span>
        </a>
    </li>

    <hr class="sidebar-divider">
    <div class="sidebar-heading">Fitur Tambahan</div>

    <li class="nav-item">
        <a class="nav-link <?= $isPages ? '' : 'collapsed' ?>" href="#" data-toggle="collapse" data-target="#collapsePages"
            aria-expanded="<?= $isPages ? 'true' : 'false' ?>" aria-controls="collapsePages">
            <i class="fas fa-fw fa-folder"></i>
            <span>Pages</span>
        </a>
        <div id="collapsePages" class="collapse <?= $isPages ? 'show' : '' ?>" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Login Screens:</h6>
                <a class="collapse-item <?= strpos($current_uri, 'login.php') !== false ? 'active' : '' ?>" href="<?= BASE_URL ?>/Halaman_Register&Login/login.php">Login</a>
                <a class="collapse-item <?= strpos($current_uri, 'register.php') !== false ? 'active' : '' ?>" href="<?= BASE_URL ?>/Halaman_Register&Login/register.php">Register</a>
                <a class="collapse-item <?= strpos($current_uri, 'forgot-password.php') !== false ? 'active' : '' ?>" href="<?= BASE_URL ?>/Halaman_Register&Login/forgot_password.php">Forgot Password</a>
                <div class="collapse-divider"></div>
                <h6 class="collapse-header">Other Pages:</h6>
                <a class="collapse-item" href="404.html">404 Page</a>
                <a class="collapse-item" href="blank.html">Blank Page</a>
            </div>
        </div>
    </li>


    <hr class="sidebar-divider d-none d-md-block">
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>