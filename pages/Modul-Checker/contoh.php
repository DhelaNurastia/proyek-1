<?php
require_once '../../koneksi.php';

$query = "SELECT b.id AS booking_id, u.nama AS nama_peminjam, m.plat_nomor, b.tgl_booking, b.status 
          FROM booking b
          JOIN users u ON b.customer_id = u.id
          JOIN unit_mobil m ON b.unit_mobil_id = m.id
          ORDER BY b.created_at DESC";

$result = mysqli_query($db, $query);

$data = [];

while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

header('Content-Type: application/json');
echo json_encode($data);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Inspeksi Mobil - Modern</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #4361ee;
            --secondary: #3f37c9;
            --success: #4cc9f0;
            --danger: #f72585;
            --warning: #f8961e;
            --light: #f8f9fa;
            --dark: #212529;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f5f7fa;
        }

        .navbar-brand {
            font-weight: 700;
        }

        .nav-pills .nav-link.active {
            background-color: var(--primary);
        }

        .card {
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            border: none;
            margin-bottom: 20px;
        }

        .card-header {
            background-color: white;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            font-weight: 600;
        }

        .section-title {
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 25px;
            position: relative;
            padding-bottom: 10px;
        }

        .section-title:after {
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            width: 50px;
            height: 3px;
            background-color: var(--primary);
        }

        .form-label {
            font-weight: 500;
        }

        .btn-primary {
            background-color: var(--primary);
            border-color: var(--primary);
        }

        .btn-primary:hover {
            background-color: var(--secondary);
            border-color: var(--secondary);
        }

        .file-upload {
            position: relative;
            overflow: hidden;
            cursor: pointer;
            border: 2px dashed #dee2e6;
            border-radius: 8px;
            padding: 20px;
            text-align: center;
            transition: all 0.3s ease;
        }

        .file-upload:hover {
            border-color: var(--primary);
            background-color: rgba(67, 97, 238, 0.05);
        }

        .file-upload i {
            font-size: 2rem;
            color: var(--primary);
            margin-bottom: 10px;
        }

        .preview-container {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            margin-top: 20px;
        }

        .preview-item {
            position: relative;
            width: 120px;
            height: 120px;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .preview-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .remove-btn {
            position: absolute;
            top: 5px;
            right: 5px;
            width: 25px;
            height: 25px;
            background-color: rgba(247, 37, 133, 0.8);
            color: white;
            border: none;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }

        .status-badge {
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
        }

        .status-good {
            background-color: rgba(76, 201, 240, 0.1);
            color: #4cc9f0;
        }

        .status-light {
            background-color: rgba(248, 150, 30, 0.1);
            color: #f8961e;
        }

        .status-heavy {
            background-color: rgba(247, 37, 133, 0.1);
            color: #f72585;
        }

        .search-box {
            position: relative;
            margin-bottom: 20px;
        }

        .search-box i {
            position: absolute;
            left: 15px;
            top: 12px;
            color: #6c757d;
        }

        .search-box input {
            padding-left: 40px;
            border-radius: 50px;
        }

        .booking-item {
            cursor: pointer;
            transition: all 0.3s ease;
            border-left: 3px solid transparent;
        }

        .booking-item:hover {
            background-color: #f8f9fa;
            border-left-color: var(--primary);
        }

        .booking-item.active {
            background-color: rgba(67, 97, 238, 0.1);
            border-left-color: var(--primary);
        }

        #loading {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.8);
            z-index: 9999;
            justify-content: center;
            align-items: center;
        }

        .spinner {
            width: 3rem;
            height: 3rem;
        }
    </style>
</head>

<body>
    <!-- Loading Indicator -->
    <div id="loading">
        <div class="spinner-border text-primary spinner" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="fas fa-car me-2"></i>Inspeksi Mobil
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="#" data-section="booking-list">
                            <i class="fas fa-list me-1"></i> Daftar Booking
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-section="kondisi-awal">
                            <i class="fas fa-car-crash me-1"></i> Kondisi Awal
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-section="kondisi-akhir">
                            <i class="fas fa-car-alt me-1"></i> Kondisi Akhir
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-section="perhitungan-denda">
                            <i class="fas fa-calculator me-1"></i> Denda
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container py-4">
        <!-- Daftar Booking -->
        <section id="booking-list" class="active-section">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="section-title">
                        <i class="fas fa-list me-2"></i>Daftar Booking
                    </h2>

                    <div class="search-box">
                        <i class="fas fa-search"></i>
                        <input type="text" id="search-booking" class="form-control" placeholder="Cari booking...">
                    </div>

                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <span>Daftar Peminjaman Aktif</span>
                            <button class="btn btn-sm btn-primary" id="refresh-booking">
                                <i class="fas fa-sync-alt me-1"></i> Refresh
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>ID Booking</th>
                                            <th>Nama Peminjam</th>
                                            <th>Mobil</th>
                                            <th>Tanggal</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="booking-table-body">
                                        <!-- Data booking akan diisi oleh JavaScript -->
                                        <script>
                                            document.addEventListener("DOMContentLoaded", function() {
                                                fetch('get_booking.php')
                                                    .then(response => response.json())
                                                    .then(data => {
                                                        const tableBody = document.getElementById('booking-table-body');
                                                        tableBody.innerHTML = ''; // kosongkan dulu

                                                        data.forEach(row => {
                                                            const tr = document.createElement('tr');

                                                            tr.innerHTML = `
                                                        <td>${row.booking_id}</td>
                                                        <td>${row.nama_peminjam}</td>
                                                        <td>${row.plat_nomor}</td>
                                                        <td>${new Date(row.tgl_booking).toLocaleDateString()}</td>
                                                        <td>${row.status}</td>
                                                        <td><a href="detail_booking.php?id=${row.booking_id}">Detail</a></td>
                                                    `;

                                                            tableBody.appendChild(tr);
                                                        });
                                                    })
                                                    .catch(error => {
                                                        console.error('Error ambil data:', error);
                                                    });
                                            });
                                        </script>

                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <div class="text-muted">
                                    Menampilkan <span id="pagination-start">1</span> - <span id="pagination-end">10</span> dari <span id="pagination-total">50</span> data
                                </div>
                                <div>
                                    <button class="btn btn-outline-secondary me-2" id="prev-page">&lt; Sebelumnya</button>
                                    <button class="btn btn-outline-secondary" id="next-page">Selanjutnya &gt;</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Kondisi Awal Mobil -->
        <section id="kondisi-awal">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="section-title">
                        <i class="fas fa-car-crash me-2"></i>Pemeriksaan Kondisi Awal Mobil
                    </h2>

                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>Pilih booking dari daftar untuk memulai inspeksi.
                    </div>

                    <div id="awal-form-container" style="display: none;">
                        <!-- Form akan diisi oleh JavaScript -->
                    </div>
                </div>
            </div>
        </section>

        <!-- Kondisi Akhir Mobil -->
        <section id="kondisi-akhir">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="section-title">
                        <i class="fas fa-car-alt me-2"></i>Pemeriksaan Kondisi Akhir Mobil
                    </h2>

                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>Pilih booking dari daftar untuk memulai inspeksi.
                    </div>

                    <div id="akhir-form-container" style="display: none;">
                        <!-- Form akan diisi oleh JavaScript -->
                    </div>
                </div>
            </div>
        </section>

        <!-- Perhitungan Denda -->
        <section id="perhitungan-denda">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="section-title">
                        <i class="fas fa-calculator me-2"></i>Perhitungan Denda
                    </h2>

                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>Pilih booking dari daftar untuk menghitung denda.
                    </div>

                    <div id="denda-form-container" style="display: none;">
                        <!-- Form akan diisi oleh JavaScript -->
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Data contoh (simulasi database)
        const bookings = [{
                id: 'BOOK001',
                customer: {
                    id: 'CUST001',
                    name: 'John Doe',
                    address: 'Jl. Sudirman No. 123, Jakarta',
                    phone: '081234567890',
                    email: 'john.doe@example.com'
                },
                car: {
                    plate: 'B 1234 ABC',
                    brand: 'Toyota',
                    model: 'Avanza',
                    year: 2022,
                    color: 'Hitam',
                    transmission: 'Automatic'
                },
                startDate: '2023-06-01',
                endDate: '2023-06-07',
                status: 'active'
            },
            {
                id: 'BOOK002',
                customer: {
                    id: 'CUST002',
                    name: 'Jane Smith',
                    address: 'Jl. Thamrin No. 45, Jakarta',
                    phone: '082345678901',
                    email: 'jane.smith@example.com'
                },
                car: {
                    plate: 'B 5678 XYZ',
                    brand: 'Honda',
                    model: 'Jazz',
                    year: 2021,
                    color: 'Putih',
                    transmission: 'Manual'
                },
                startDate: '2023-06-05',
                endDate: '2023-06-10',
                status: 'active'
            },
            {
                id: 'BOOK003',
                customer: {
                    id: 'CUST003',
                    name: 'Robert Johnson',
                    address: 'Jl. Gatot Subroto No. 67, Jakarta',
                    phone: '083456789012',
                    email: 'robert.j@example.com'
                },
                car: {
                    plate: 'B 9012 KLM',
                    brand: 'Suzuki',
                    model: 'Ertiga',
                    year: 2020,
                    color: 'Silver',
                    transmission: 'Automatic'
                },
                startDate: '2023-06-08',
                endDate: '2023-06-15',
                status: 'active'
            }
        ];

        // Variabel global untuk menyimpan data yang dipilih
        let selectedBooking = null;
        let initialInspection = {};
        let finalInspection = {};
        let penaltyData = {};

        // Fungsi untuk menampilkan loading
        function showLoading() {
            document.getElementById('loading').style.display = 'flex';
        }

        // Fungsi untuk menyembunyikan loading
        function hideLoading() {
            document.getElementById('loading').style.display = 'none';
        }

        // Fungsi untuk navigasi antar section
        function navigateToSection(sectionId) {
            // Sembunyikan semua section
            document.querySelectorAll('section').forEach(section => {
                section.classList.remove('active-section');
            });

            // Tampilkan section yang dipilih
            document.getElementById(sectionId).classList.add('active-section');

            // Update navbar active state
            document.querySelectorAll('.nav-link').forEach(link => {
                link.classList.remove('active');
                if (link.getAttribute('data-section') === sectionId) {
                    link.classList.add('active');
                }
            });

            // Scroll ke atas
            window.scrollTo(0, 0);
        }

        // Fungsi untuk memuat data booking
        function loadBookings(searchTerm = '') {
            showLoading();

            // Simulasi AJAX call dengan timeout
            setTimeout(() => {
                const filteredBookings = bookings.filter(booking => {
                    return booking.id.toLowerCase().includes(searchTerm.toLowerCase()) ||
                        booking.customer.name.toLowerCase().includes(searchTerm.toLowerCase()) ||
                        booking.car.plate.toLowerCase().includes(searchTerm.toLowerCase());
                });

                const tableBody = document.getElementById('booking-table-body');
                tableBody.innerHTML = '';

                if (filteredBookings.length === 0) {
                    tableBody.innerHTML = `
                        <tr>
                            <td colspan="6" class="text-center py-4">
                                <i class="fas fa-exclamation-circle me-2"></i>Tidak ada data booking yang ditemukan
                            </td>
                        </tr>
                    `;
                } else {
                    filteredBookings.forEach(booking => {
                        const row = document.createElement('tr');
                        row.className = 'booking-item';
                        row.setAttribute('data-booking-id', booking.id);
                        row.innerHTML = `
                            <td>${booking.id}</td>
                            <td>${booking.customer.name}</td>
                            <td>${booking.car.brand} ${booking.car.model} (${booking.car.plate})</td>
                            <td>${formatDate(booking.startDate)} - ${formatDate(booking.endDate)}</td>
                            <td>
                                <span class="badge bg-success">${booking.status === 'active' ? 'Aktif' : 'Selesai'}</span>
                            </td>
                            <td>
                                <button class="btn btn-sm btn-outline-primary select-booking" data-booking-id="${booking.id}">
                                    <i class="fas fa-edit me-1"></i> Pilih
                                </button>
                            </td>
                        `;
                        tableBody.appendChild(row);
                    });
                }

                hideLoading();
            }, 800);
        }

        // Fungsi untuk memformat tanggal
        function formatDate(dateString) {
            const options = {
                day: '2-digit',
                month: '2-digit',
                year: 'numeric'
            };
            return new Date(dateString).toLocaleDateString('id-ID', options);
        }

        // Fungsi untuk memilih booking
        function selectBooking(bookingId) {
            showLoading();

            // Simulasi AJAX call dengan timeout
            setTimeout(() => {
                selectedBooking = bookings.find(booking => booking.id === bookingId);

                // Update UI untuk menunjukkan booking yang dipilih
                document.querySelectorAll('.booking-item').forEach(row => {
                    if (row.getAttribute('data-booking-id') === bookingId) {
                        row.classList.add('active');
                    } else {
                        row.classList.remove('active');
                    }
                });

                // Isi form kondisi awal
                renderInitialInspectionForm();

                // Isi form kondisi akhir
                renderFinalInspectionForm();

                // Isi form denda
                renderPenaltyForm();

                hideLoading();

                // Tampilkan notifikasi
                showAlert('success', `Booking ${bookingId} dipilih`, 'Data booking telah dimuat.');
            }, 500);
        }

        // Fungsi untuk menampilkan form kondisi awal
        function renderInitialInspectionForm() {
            const container = document.getElementById('awal-form-container');

            if (!selectedBooking) {
                container.style.display = 'none';
                return;
            }

            container.style.display = 'block';
            container.innerHTML = `
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-info-circle me-2"></i>Data Booking & Kendaraan
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h5 class="mb-3">Data Booking</h5>
                                <div class="mb-3">
                                    <label class="form-label">ID Booking</label>
                                    <input type="text" class="form-control" value="${selectedBooking.id}" readonly>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Durasi</label>
                                    <input type="text" class="form-control" value="${calculateDuration(selectedBooking.startDate, selectedBooking.endDate)} hari" readonly>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Tanggal Ambil</label>
                                    <input type="text" class="form-control" value="${formatDate(selectedBooking.startDate)}" readonly>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Tanggal Kembali</label>
                                    <input type="text" class="form-control" value="${formatDate(selectedBooking.endDate)}" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h5 class="mb-3">Data Mobil</h5>
                                <div class="mb-3">
                                    <label class="form-label">Nomor Polisi</label>
                                    <input type="text" class="form-control" value="${selectedBooking.car.plate}" readonly>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Nama Unit</label>
                                    <input type="text" class="form-control" value="${selectedBooking.car.brand} ${selectedBooking.car.model}" readonly>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Warna</label>
                                    <input type="text" class="form-control" value="${selectedBooking.car.color}" readonly>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Transmisi</label>
                                    <input type="text" class="form-control" value="${selectedBooking.car.transmission}" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-car me-2"></i>Pemeriksaan Kondisi Awal Mobil
                    </div>
                    <div class="card-body">
                        <ul class="nav nav-pills mb-4" id="inspection-tabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="exterior-tab" data-bs-toggle="pill" data-bs-target="#exterior" type="button">
                                    <i class="fas fa-car-side me-1"></i> Eksterior
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="interior-tab" data-bs-toggle="pill" data-bs-target="#interior" type="button">
                                    <i class="fas fa-couch me-1"></i> Interior
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="engine-tab" data-bs-toggle="pill" data-bs-target="#engine" type="button">
                                    <i class="fas fa-cog me-1"></i> Mesin & Kelistrikan
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="equipment-tab" data-bs-toggle="pill" data-bs-target="#equipment" type="button">
                                    <i class="fas fa-tools me-1"></i> Kelengkapan
                                </button>
                            </li>
                        </ul>
                        
                        <div class="tab-content" id="inspection-tab-content">
                            <div class="tab-pane fade show active" id="exterior" role="tabpanel">
                                ${renderInspectionSection('exterior', [
                                    { id: 'body-depan', label: 'Body Depan' },
                                    { id: 'body-belakang', label: 'Body Belakang' },
                                    { id: 'pintu', label: 'Pintu Mobil' },
                                    { id: 'kaca', label: 'Kaca' },
                                    { id: 'ban-velg', label: 'Ban & Velg' }
                                ])}
                            </div>
                            <div class="tab-pane fade" id="interior" role="tabpanel">
                                ${renderInspectionSection('interior', [
                                    { id: 'kursi-depan', label: 'Kursi Depan' },
                                    { id: 'kursi-belakang', label: 'Kursi Belakang' },
                                    { id: 'dashboard', label: 'Dashboard' },
                                    { id: 'ac', label: 'AC' },
                                    { id: 'elektronik', label: 'Fungsi Elektronik' }
                                ])}
                            </div>
                            <div class="tab-pane fade" id="engine" role="tabpanel">
                                ${renderInspectionSection('engine', [
                                    { id: 'mesin', label: 'Mesin' },
                                    { id: 'oli', label: 'Oli Mesin', options: ['Full', 'Habis'] },
                                    { id: 'lampu', label: 'Lampu' },
                                    { id: 'audio', label: 'Audio System' }
                                ])}
                            </div>
                            <div class="tab-pane fade" id="equipment" role="tabpanel">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5 class="mb-3">Dokumen Kendaraan</h5>
                                        ${renderCheckboxGroup('documents', [
                                            { id: 'stnk', label: 'STNK' },
                                            { id: 'bpkb', label: 'BPKB' },
                                            { id: 'kunci-cadangan', label: 'Kunci Cadangan' },
                                            { id: 'manual-book', label: 'Manual Book' }
                                        ])}
                                    </div>
                                    <div class="col-md-6">
                                        <h5 class="mb-3">Peralatan Darurat</h5>
                                        ${renderCheckboxGroup('emergency', [
                                            { id: 'dongkrak', label: 'Dongkrak' },
                                            { id: 'segitiga', label: 'Segitiga Pengaman' },
                                            { id: 'ban-serep', label: 'Ban Serep' },
                                            { id: 'p3k', label: 'P3K' }
                                        ])}
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Bensin</label>
                                            <select class="form-select" id="fuel-level">
                                                <option value="full">Full</option>
                                                <option value="half">Setengah</option>
                                                <option value="empty">Habis</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-camera me-2"></i>Foto Kondisi Mobil
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <div class="file-upload" onclick="document.getElementById('front-photo').click()">
                                    <i class="fas fa-car-side"></i>
                                    <p>Foto Depan</p>
                                    <input type="file" id="front-photo" accept="image/*" style="display: none;" onchange="previewImage(this, 'front-preview')">
                                </div>
                                <div class="preview-container">
                                    <div id="front-preview" class="preview-item" style="display: none;">
                                        <img src="" alt="Preview Foto Depan">
                                        <button class="remove-btn" onclick="removeImage('front-photo', 'front-preview')">×</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="file-upload" onclick="document.getElementById('rear-photo').click()">
                                    <i class="fas fa-car-side fa-flip-horizontal"></i>
                                    <p>Foto Belakang</p>
                                    <input type="file" id="rear-photo" accept="image/*" style="display: none;" onchange="previewImage(this, 'rear-preview')">
                                </div>
                                <div class="preview-container">
                                    <div id="rear-preview" class="preview-item" style="display: none;">
                                        <img src="" alt="Preview Foto Belakang">
                                        <button class="remove-btn" onclick="removeImage('rear-photo', 'rear-preview')">×</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="file-upload" onclick="document.getElementById('right-photo').click()">
                                    <i class="fas fa-car-side" style="transform: rotate(90deg)"></i>
                                    <p>Foto Kanan</p>
                                    <input type="file" id="right-photo" accept="image/*" style="display: none;" onchange="previewImage(this, 'right-preview')">
                                </div>
                                <div class="preview-container">
                                    <div id="right-preview" class="preview-item" style="display: none;">
                                        <img src="" alt="Preview Foto Kanan">
                                        <button class="remove-btn" onclick="removeImage('right-photo', 'right-preview')">×</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="file-upload" onclick="document.getElementById('left-photo').click()">
                                    <i class="fas fa-car-side" style="transform: rotate(-90deg)"></i>
                                    <p>Foto Kiri</p>
                                    <input type="file" id="left-photo" accept="image/*" style="display: none;" onchange="previewImage(this, 'left-preview')">
                                </div>
                                <div class="preview-container">
                                    <div id="left-preview" class="preview-item" style="display: none;">
                                        <img src="" alt="Preview Foto Kiri">
                                        <button class="remove-btn" onclick="removeImage('left-photo', 'left-preview')">×</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="file-upload" onclick="document.getElementById('interior-photo').click()">
                                    <i class="fas fa-couch"></i>
                                    <p>Foto Dalam</p>
                                    <input type="file" id="interior-photo" accept="image/*" style="display: none;" onchange="previewImage(this, 'interior-preview')">
                                </div>
                                <div class="preview-container">
                                    <div id="interior-preview" class="preview-item" style="display: none;">
                                        <img src="" alt="Preview Foto Dalam">
                                        <button class="remove-btn" onclick="removeImage('interior-photo', 'interior-preview')">×</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="file-upload" onclick="document.getElementById('overall-photo').click()">
                                    <i class="fas fa-car"></i>
                                    <p>Foto Keseluruhan</p>
                                    <input type="file" id="overall-photo" accept="image/*" style="display: none;" onchange="previewImage(this, 'overall-preview')">
                                </div>
                                <div class="preview-container">
                                    <div id="overall-preview" class="preview-item" style="display: none;">
                                        <img src="" alt="Preview Foto Keseluruhan">
                                        <button class="remove-btn" onclick="removeImage('overall-photo', 'overall-preview')">×</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="text-end">
                    <button class="btn btn-primary btn-lg" onclick="saveInitialInspection()">
                        <i class="fas fa-save me-2"></i> Simpan Pemeriksaan
                    </button>
                </div>
            `;

            // Inisialisasi tab Bootstrap
            new bootstrap.Tab(document.querySelector('#exterior-tab'));
        }

        // Fungsi untuk menampilkan form kondisi akhir
        function renderFinalInspectionForm() {
            const container = document.getElementById('akhir-form-container');

            if (!selectedBooking) {
                container.style.display = 'none';
                return;
            }

            container.style.display = 'block';
            container.innerHTML = `
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-info-circle me-2"></i>Data Booking & Kendaraan
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h5 class="mb-3">Data Booking</h5>
                                <div class="mb-3">
                                    <label class="form-label">ID Booking</label>
                                    <input type="text" class="form-control" value="${selectedBooking.id}" readonly>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Durasi</label>
                                    <input type="text" class="form-control" value="${calculateDuration(selectedBooking.startDate, selectedBooking.endDate)} hari" readonly>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Tanggal Ambil</label>
                                    <input type="text" class="form-control" value="${formatDate(selectedBooking.startDate)}" readonly>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Tanggal Kembali</label>
                                    <input type="text" class="form-control" value="${formatDate(selectedBooking.endDate)}" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h5 class="mb-3">Data Mobil</h5>
                                <div class="mb-3">
                                    <label class="form-label">Nomor Polisi</label>
                                    <input type="text" class="form-control" value="${selectedBooking.car.plate}" readonly>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Nama Unit</label>
                                    <input type="text" class="form-control" value="${selectedBooking.car.brand} ${selectedBooking.car.model}" readonly>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Warna</label>
                                    <input type="text" class="form-control" value="${selectedBooking.car.color}" readonly>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Transmisi</label>
                                    <input type="text" class="form-control" value="${selectedBooking.car.transmission}" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-car me-2"></i>Pemeriksaan Kondisi Akhir Mobil
                    </div>
                    <div class="card-body">
                        <ul class="nav nav-pills mb-4" id="final-inspection-tabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="final-exterior-tab" data-bs-toggle="pill" data-bs-target="#final-exterior" type="button">
                                    <i class="fas fa-car-side me-1"></i> Eksterior
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="final-interior-tab" data-bs-toggle="pill" data-bs-target="#final-interior" type="button">
                                    <i class="fas fa-couch me-1"></i> Interior
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="final-engine-tab" data-bs-toggle="pill" data-bs-target="#final-engine" type="button">
                                    <i class="fas fa-cog me-1"></i> Mesin & Kelistrikan
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="final-equipment-tab" data-bs-toggle="pill" data-bs-target="#final-equipment" type="button">
                                    <i class="fas fa-tools me-1"></i> Kelengkapan
                                </button>
                            </li>
                        </ul>
                        
                        <div class="tab-content" id="final-inspection-tab-content">
                            <div class="tab-pane fade show active" id="final-exterior" role="tabpanel">
                                ${renderInspectionSection('final-exterior', [
                                    { id: 'final-body-depan', label: 'Body Depan' },
                                    { id: 'final-body-belakang', label: 'Body Belakang' },
                                    { id: 'final-pintu', label: 'Pintu Mobil' },
                                    { id: 'final-kaca', label: 'Kaca' },
                                    { id: 'final-ban-velg', label: 'Ban & Velg' }
                                ])}
                            </div>
                            <div class="tab-pane fade" id="final-interior" role="tabpanel">
                                ${renderInspectionSection('final-interior', [
                                    { id: 'final-kursi-depan', label: 'Kursi Depan' },
                                    { id: 'final-kursi-belakang', label: 'Kursi Belakang' },
                                    { id: 'final-dashboard', label: 'Dashboard' },
                                    { id: 'final-ac', label: 'AC' },
                                    { id: 'final-elektronik', label: 'Fungsi Elektronik' }
                                ])}
                            </div>
                            <div class="tab-pane fade" id="final-engine" role="tabpanel">
                                ${renderInspectionSection('final-engine', [
                                    { id: 'final-mesin', label: 'Mesin' },
                                    { id: 'final-oli', label: 'Oli Mesin', options: ['Full', 'Habis'] },
                                    { id: 'final-lampu', label: 'Lampu' },
                                    { id: 'final-audio', label: 'Audio System' }
                                ])}
                            </div>
                            <div class="tab-pane fade" id="final-equipment" role="tabpanel">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5 class="mb-3">Dokumen Kendaraan</h5>
                                        ${renderCheckboxGroup('final-documents', [
                                            { id: 'final-stnk', label: 'STNK' },
                                            { id: 'final-bpkb', label: 'BPKB' },
                                            { id: 'final-kunci-cadangan', label: 'Kunci Cadangan' },
                                            { id: 'final-manual-book', label: 'Manual Book' }
                                        ])}
                                    </div>
                                    <div class="col-md-6">
                                        <h5 class="mb-3">Peralatan Darurat</h5>
                                        ${renderCheckboxGroup('final-emergency', [
                                            { id: 'final-dongkrak', label: 'Dongkrak' },
                                            { id: 'final-segitiga', label: 'Segitiga Pengaman' },
                                            { id: 'final-ban-serep', label: 'Ban Serep' },
                                            { id: 'final-p3k', label: 'P3K' }
                                        ])}
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Bensin</label>
                                            <select class="form-select" id="final-fuel-level">
                                                <option value="full">Full</option>
                                                <option value="half">Setengah</option>
                                                <option value="empty">Habis</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-camera me-2"></i>Foto Kondisi Mobil
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <div class="file-upload" onclick="document.getElementById('final-front-photo').click()">
                                    <i class="fas fa-car-side"></i>
                                    <p>Foto Depan</p>
                                    <input type="file" id="final-front-photo" accept="image/*" style="display: none;" onchange="previewImage(this, 'final-front-preview')">
                                </div>
                                <div class="preview-container">
                                    <div id="final-front-preview" class="preview-item" style="display: none;">
                                        <img src="" alt="Preview Foto Depan">
                                        <button class="remove-btn" onclick="removeImage('final-front-photo', 'final-front-preview')">×</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="file-upload" onclick="document.getElementById('final-rear-photo').click()">
                                    <i class="fas fa-car-side fa-flip-horizontal"></i>
                                    <p>Foto Belakang</p>
                                    <input type="file" id="final-rear-photo" accept="image/*" style="display: none;" onchange="previewImage(this, 'final-rear-preview')">
                                </div>
                                <div class="preview-container">
                                    <div id="final-rear-preview" class="preview-item" style="display: none;">
                                        <img src="" alt="Preview Foto Belakang">
                                        <button class="remove-btn" onclick="removeImage('final-rear-photo', 'final-rear-preview')">×</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="file-upload" onclick="document.getElementById('final-right-photo').click()">
                                    <i class="fas fa-car-side" style="transform: rotate(90deg)"></i>
                                    <p>Foto Kanan</p>
                                    <input type="file" id="final-right-photo" accept="image/*" style="display: none;" onchange="previewImage(this, 'final-right-preview')">
                                </div>
                                <div class="preview-container">
                                    <div id="final-right-preview" class="preview-item" style="display: none;">
                                        <img src="" alt="Preview Foto Kanan">
                                        <button class="remove-btn" onclick="removeImage('final-right-photo', 'final-right-preview')">×</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="file-upload" onclick="document.getElementById('final-left-photo').click()">
                                    <i class="fas fa-car-side" style="transform: rotate(-90deg)"></i>
                                    <p>Foto Kiri</p>
                                    <input type="file" id="final-left-photo" accept="image/*" style="display: none;" onchange="previewImage(this, 'final-left-preview')">
                                </div>
                                <div class="preview-container">
                                    <div id="final-left-preview" class="preview-item" style="display: none;">
                                        <img src="" alt="Preview Foto Kiri">
                                        <button class="remove-btn" onclick="removeImage('final-left-photo', 'final-left-preview')">×</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="file-upload" onclick="document.getElementById('final-interior-photo').click()">
                                    <i class="fas fa-couch"></i>
                                    <p>Foto Dalam</p>
                                    <input type="file" id="final-interior-photo" accept="image/*" style="display: none;" onchange="previewImage(this, 'final-interior-preview')">
                                </div>
                                <div class="preview-container">
                                    <div id="final-interior-preview" class="preview-item" style="display: none;">
                                        <img src="" alt="Preview Foto Dalam">
                                        <button class="remove-btn" onclick="removeImage('final-interior-photo', 'final-interior-preview')">×</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="file-upload" onclick="document.getElementById('final-overall-photo').click()">
                                    <i class="fas fa-car"></i>
                                    <p>Foto Keseluruhan</p>
                                    <input type="file" id="final-overall-photo" accept="image/*" style="display: none;" onchange="previewImage(this, 'final-overall-preview')">
                                </div>
                                <div class="preview-container">
                                    <div id="final-overall-preview" class="preview-item" style="display: none;">
                                        <img src="" alt="Preview Foto Keseluruhan">
                                        <button class="remove-btn" onclick="removeImage('final-overall-photo', 'final-overall-preview')">×</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-exclamation-triangle me-2"></i>Foto Kerusakan Mobil
                    </div>
                    <div class="card-body">
                        <div class="file-upload" onclick="document.getElementById('damage-photos').click()">
                            <i class="fas fa-plus-circle"></i>
                            <p>Tambah Foto Kerusakan</p>
                            <input type="file" id="damage-photos" accept="image/*" multiple style="display: none;" onchange="previewMultipleImages(this, 'damage-preview-container')">
                        </div>
                        <div class="preview-container" id="damage-preview-container">
                            <!-- Preview gambar kerusakan akan ditambahkan di sini -->
                        </div>
                    </div>
                </div>

                <div class="text-end">
                    <button class="btn btn-primary btn-lg" onclick="saveFinalInspection()">
                        <i class="fas fa-save me-2"></i> Simpan Pemeriksaan
                    </button>
                </div>
            `;

            // Inisialisasi tab Bootstrap
            new bootstrap.Tab(document.querySelector('#final-exterior-tab'));
        }

        // Fungsi untuk menampilkan form denda
        function renderPenaltyForm() {
            const container = document.getElementById('denda-form-container');

            if (!selectedBooking) {
                container.style.display = 'none';
                return;
            }

            container.style.display = 'block';
            container.innerHTML = `
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-info-circle me-2"></i>Data Peminjam & Kendaraan
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h5 class="mb-3">Data Peminjam</h5>
                                <div class="mb-3">
                                    <label class="form-label">Nama</label>
                                    <input type="text" class="form-control" value="${selectedBooking.customer.name}" readonly>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Alamat</label>
                                    <input type="text" class="form-control" value="${selectedBooking.customer.address}" readonly>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Nomor Telepon</label>
                                    <input type="text" class="form-control" value="${selectedBooking.customer.phone}" readonly>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="text" class="form-control" value="${selectedBooking.customer.email}" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h5 class="mb-3">Data Mobil</h5>
                                <div class="mb-3">
                                    <label class="form-label">Nomor Polisi</label>
                                    <input type="text" class="form-control" value="${selectedBooking.car.plate}" readonly>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Nama Unit</label>
                                    <input type="text" class="form-control" value="${selectedBooking.car.brand} ${selectedBooking.car.model}" readonly>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Warna</label>
                                    <input type="text" class="form-control" value="${selectedBooking.car.color}" readonly>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Transmisi</label>
                                    <input type="text" class="form-control" value="${selectedBooking.car.transmission}" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-exclamation-circle me-2"></i>Keterangan Denda
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Jenis Denda</label>
                                <select class="form-select" id="penalty-type">
                                    <option value="">Pilih Jenis Denda</option>
                                    <option value="late">Keterlambatan</option>
                                    <option value="damage">Kerusakan</option>
                                    <option value="violation">Pelanggaran</option>
                                    <option value="other">Lainnya</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Biaya Denda (Rp)</label>
                                <input type="number" class="form-control" id="penalty-amount" placeholder="Masukkan jumlah denda">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Catatan Denda</label>
                            <textarea class="form-control" id="penalty-notes" rows="3" placeholder="Masukkan rincian denda"></textarea>
                        </div>
                    </div>
                </div>

                <div class="text-end">
                    <button class="btn btn-primary btn-lg" onclick="savePenalty()">
                        <i class="fas fa-save me-2"></i> Simpan Denda
                    </button>
                </div>
            `;
        }

        // Fungsi untuk merender bagian inspeksi
        function renderInspectionSection(sectionId, items) {
            return items.map(item => `
                <div class="mb-3">
                    <label class="form-label">${item.label}</label>
                    ${item.options ? renderSelectOptions(`${sectionId}-${item.id}`, item.options) : renderRadioGroup(`${sectionId}-${item.id}`)}
                    <textarea class="form-control mt-2" id="${sectionId}-${item.id}-notes" placeholder="Catatan tambahan"></textarea>
                </div>
            `).join('');
        }

        // Fungsi untuk merender radio group
        function renderRadioGroup(name) {
            return `
                <div class="btn-group btn-group-sm w-100" role="group">
                    <input type="radio" class="btn-check" name="${name}" id="${name}-good" value="good" autocomplete="off">
                    <label class="btn btn-outline-success" for="${name}-good">Baik</label>
                    
                    <input type="radio" class="btn-check" name="${name}" id="${name}-light" value="light" autocomplete="off">
                    <label class="btn btn-outline-warning" for="${name}-light">Ringan</label>
                    
                    <input type="radio" class="btn-check" name="${name}" id="${name}-heavy" value="heavy" autocomplete="off">
                    <label class="btn btn-outline-danger" for="${name}-heavy">Berat</label>
                </div>
            `;
        }

        // Fungsi untuk merender select options
        function renderSelectOptions(id, options) {
            return `
                <select class="form-select" id="${id}">
                    ${options.map(option => `<option value="${option.toLowerCase()}">${option}</option>`).join('')}
                </select>
            `;
        }

        // Fungsi untuk merender checkbox group
        function renderCheckboxGroup(groupName, items) {
            return items.map(item => `
                <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" id="${groupName}-${item.id}">
                    <label class="form-check-label" for="${groupName}-${item.id}">
                        ${item.label}
                    </label>
                </div>
            `).join('');
        }

        // Fungsi untuk menghitung durasi
        function calculateDuration(startDate, endDate) {
            const start = new Date(startDate);
            const end = new Date(endDate);
            const diffTime = Math.abs(end - start);
            return Math.ceil(diffTime / (1000 * 60 * 60 * 24));
        }

        // Fungsi untuk preview gambar
        function previewImage(input, previewId) {
            const preview = document.getElementById(previewId);
            const file = input.files[0];

            if (file) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    preview.querySelector('img').src = e.target.result;
                    preview.style.display = 'block';
                }

                reader.readAsDataURL(file);
            }
        }

        // Fungsi untuk preview multiple images
        function previewMultipleImages(input, containerId) {
            const container = document.getElementById(containerId);
            const files = input.files;

            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                const reader = new FileReader();

                reader.onload = function(e) {
                    const previewItem = document.createElement('div');
                    previewItem.className = 'preview-item';
                    previewItem.innerHTML = `
                        <img src="${e.target.result}" alt="Preview Foto">
                        <button class="remove-btn" onclick="this.parentElement.remove()">×</button>
                    `;
                    container.appendChild(previewItem);
                }

                reader.readAsDataURL(file);
            }
        }

        // Fungsi untuk menghapus gambar
        function removeImage(inputId, previewId) {
            document.getElementById(inputId).value = '';
            document.getElementById(previewId).style.display = 'none';
        }

        // Fungsi untuk menampilkan alert
        function showAlert(type, title, message) {
            const alertHtml = `
                <div class="alert alert-${type} alert-dismissible fade show" role="alert">
                    <strong>${title}</strong> ${message}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            `;

            // Buat element alert
            const alertElement = document.createElement('div');
            alertElement.innerHTML = alertHtml;

            // Tambahkan alert ke container
            const container = document.querySelector('.container');
            container.insertBefore(alertElement, container.firstChild);

            // Hapus alert setelah 5 detik
            setTimeout(() => {
                alertElement.remove();
            }, 5000);
        }

        // Fungsi untuk menyimpan inspeksi awal
        function saveInitialInspection() {
            showLoading();

            // Simulasi proses penyimpanan
            setTimeout(() => {
                // Simpan data ke variabel global
                initialInspection = {
                    bookingId: selectedBooking.id,
                    inspectionDate: new Date().toISOString(),
                    // Data lainnya akan diisi dari form
                };

                hideLoading();
                showAlert('success', 'Berhasil!', 'Pemeriksaan kondisi awal berhasil disimpan.');

                // Navigasi ke kondisi akhir
                navigateToSection('kondisi-akhir');
            }, 1500);
        }

        // Fungsi untuk menyimpan inspeksi akhir
        function saveFinalInspection() {
            showLoading();

            // Simulasi proses penyimpanan
            setTimeout(() => {
                // Simpan data ke variabel global
                finalInspection = {
                    bookingId: selectedBooking.id,
                    inspectionDate: new Date().toISOString(),
                    // Data lainnya akan diisi dari form
                };

                hideLoading();
                showAlert('success', 'Berhasil!', 'Pemeriksaan kondisi akhir berhasil disimpan.');

                // Navigasi ke perhitungan denda
                navigateToSection('perhitungan-denda');
            }, 1500);
        }

        // Fungsi untuk menyimpan denda
        function savePenalty() {
            showLoading();

            // Simulasi proses penyimpanan
            setTimeout(() => {
                // Simpan data ke variabel global
                penaltyData = {
                    bookingId: selectedBooking.id,
                    penaltyDate: new Date().toISOString(),
                    type: document.getElementById('penalty-type').value,
                    amount: document.getElementById('penalty-amount').value,
                    notes: document.getElementById('penalty-notes').value
                };

                hideLoading();
                showAlert('success', 'Berhasil!', 'Data denda berhasil disimpan.');

                // Navigasi ke daftar booking
                navigateToSection('booking-list');
            }, 1500);
        }

        // Event listeners
        document.addEventListener('DOMContentLoaded', function() {
            // Load data booking saat halaman dimuat
            loadBookings();

            // Navigasi saat navbar diklik
            document.querySelectorAll('.nav-link').forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    navigateToSection(this.getAttribute('data-section'));
                });
            });

            // Pilih booking saat tombol dipilih
            document.addEventListener('click', function(e) {
                if (e.target.classList.contains('select-booking')) {
                    const bookingId = e.target.getAttribute('data-booking-id');
                    selectBooking(bookingId);
                    navigateToSection('kondisi-awal');
                }
            });

            // Refresh data booking
            document.getElementById('refresh-booking').addEventListener('click', function() {
                loadBookings();
            });

            // Pencarian booking
            document.getElementById('search-booking').addEventListener('input', function() {
                loadBookings(this.value);
            });
        });
    </script>
</body>

</html>