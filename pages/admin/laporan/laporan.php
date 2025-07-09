<?php
require_once __DIR__ . '/../../../vendor/autoload.php'; // untuk PhpSpreadsheet
require_once __DIR__ . '/../../../config.php';
require_once __DIR__ . '/../../../koneksi.php';

$dateFrom = $_GET['date-from'] ?? null;
$dateTo = $_GET['date-to'] ?? null;
$status = $_GET['status-filter'] ?? null;

if (isset($_GET['export']) && $_GET['export'] === 'pdf') {
    echo "<script>window.print();</script>";
}


$query = "
  SELECT 
    b.tgl_booking AS tanggal,
    CONCAT('INV-', DATE_FORMAT(b.tgl_booking, '%Y%m%d'), '-', LPAD(b.id, 4, '0')) AS nomor_transaksi,
    u.nama_lengkap AS customer,
    jm.nama AS mobil,
    b.durasi,
    b.total_biaya,
    b.metode_pembayaran,
    p.status
  FROM booking b
  JOIN users u ON b.customer_id = u.id
  JOIN unit_mobil um ON b.unit_mobil_id = um.id
  JOIN jenis_mobil jm ON um.jenis_mobil_id = jm.id
  JOIN pembayaran p ON p.booking_id = b.id
  WHERE 1=1
";

// 🔁 Tambahkan filter sebelum query dijalankan
if ($dateFrom) {
  $query .= " AND b.tgl_booking >= '$dateFrom'";
}
if ($dateTo) {
  $query .= " AND b.tgl_booking <= '$dateTo'";
}
if ($status) {
  $query .= " AND p.status = '$status'";
}

$query .= " ORDER BY b.tgl_booking DESC";

// ✅ Baru dijalankan setelah filter lengkap
$result = mysqli_query($db, $query);

$laporan = [];
while ($row = mysqli_fetch_assoc($result)) {
  $laporan[] = $row;
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
  <!-- Styles -->
  <link href="../../../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Njeniso:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link href="../../../assets/css/sb-admin-2.min.css" rel="stylesheet">
  <link href="../../../assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

  <style>
    @media print {
  /* Sembunyikan elemen yang tidak perlu dicetak */
  .no-print, .navbar, .btn, .sidebar, footer {
    display: none !important;
  }

  /* Atur ulang layout agar cocok dicetak */
  body {
    background: white !important;
    color: black !important;
  }

  table {
    border-collapse: collapse;
    width: 100%;
  }

  table, th, td {
    border: 1px solid black;
  }

  th, td {
    padding: 6px;
    text-align: left;
  }
}

    /* CSS Variables for Theming and Colors */
    :root {
      --color-primary: #111827;
      --color-primary-light: #c7d2fe;
      --color-bg: #f9fafb;
      --color-text: #1f2937;
      --color-text-light: #6b7280;
      --color-accent: #6366f1;
      --color-error: #ef4444;
      --color-success: #22c55e;
      --color-warning: #fbbf24;
      --color-info: #3b82f6;
      --color-sidebar-bg: rgba(31, 41, 55, 0.9);
      --color-sidebar-text: #d1d5db;
      --color-header-bg: rgba(255 255 255 / 0.25);
      --color-footer-bg: #f3f4f6;
      --font-family: 'Inter', sans-serif;

      --sidebar-width: 280px;
      --header-height: 64px;
      --footer-height-mobile: 56px;

      --transition-speed: 0.3s;
      --box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    /* Reset and base */
    * {
      box-sizing: border-box;
    }

    body {
      margin: 0;
      font-family: var(--font-family);
      background: var(--color-bg);
      color: var(--color-text);
      -webkit-font-smoothing: antialiased;
      -moz-osx-font-smoothing: grayscale;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      overflow-x: hidden;
    }

    a {
      color: var(--color-primary);
      text-decoration: none;
      transition: color var(--transition-speed);
    }

    a:hover,
    a:focus {
      color: var(--color-primary-light);
      outline: none;
    }

    button {
      font-family: var(--font-family);
      cursor: pointer;
      border: none;
      background: none;
      color: var(--color-primary);
      padding: 8px 12px;
      border-radius: 6px;
      transition: background-color var(--transition-speed),
        box-shadow var(--transition-speed), color var(--transition-speed);
    }

    button:focus {
      outline: 2px solid var(--color-primary);
      outline-offset: 2px;
    }

    button.primary {
      background: var(--color-primary);
      color: white;
      box-shadow: var(--box-shadow);
    }

    button.primary:hover {
      background: var(--color-primary-light);
      color: var(--color-primary);
      box-shadow: 0 4px 20px var(--color-primary-light);
    }

    /* SCROLLBAR */
    ::-webkit-scrollbar {
      width: 10px;
      height: 8px;
    }

    ::-webkit-scrollbar-track {
      background: transparent;
    }

    ::-webkit-scrollbar-thumb {
      background-color: var(--color-primary-light);
      border-radius: 100px;
      border: 3px solid transparent;
      background-clip: content-box;
    }

    ::-webkit-scrollbar-thumb:hover {
      background-color: var(--color-primary);
    }

    /* Container grid layout for desktop */
    .app-container {
      display: grid;
      grid-template-columns: var(--sidebar-width) 1fr;
      grid-template-rows: var(--header-height) 1fr auto;
      grid-template-areas:
        "sidebar header"
        "sidebar main"
        "sidebar footer";
      min-height: 100vh;
      max-width: 100vw;
      overflow: hidden;
    }

    /* Header */
    header.app-header {
      grid-area: header;
      position: sticky;
      top: 0;
      height: var(--header-height);
      width: 100%;
      backdrop-filter: blur(16px);
      background: var(--color-header-bg);
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 0 24px;
      border-bottom: 1px solid rgba(207 213 222 / 0.3);
      box-shadow: var(--box-shadow);
      z-index: 20;
    }

    .header-left,
    .header-right {
      display: flex;
      align-items: center;
      gap: 20px;
    }

    .brand {
      font-size: clamp(1.25rem, 2vw, 1.5rem);
      font-weight: 900;
      user-select: none;
      color: var(--color-primary);
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .brand .material-icons {
      font-size: 28px;
      color: var(--color-primary);
    }

    /* Navigation */
    nav.breadcrumbs {
      font-size: 0.9rem;
      color: var(--color-text-light);
      user-select: none;
      display: flex;
      align-items: center;
      gap: 8px;
    }

    nav.breadcrumbs span,
    nav.breadcrumbs a {
      white-space: nowrap;
    }

    nav.breadcrumbs a {
      color: var(--color-primary);
    }

    nav.breadcrumbs a:hover,
    nav.breadcrumbs a:focus {
      text-decoration: underline;
    }

    /* Search input inside header */
    input#search-input {
      padding: 8px 12px;
      border: none;
      border-radius: 10px;
      font-size: 1rem;
      max-width: 280px;
      box-shadow: var(--box-shadow);
      transition: box-shadow 0.25s ease;
      user-select: text;
    }

    input#search-input:focus {
      outline: none;
      box-shadow: 0 0 10px var(--color-primary-light);
    }

    /* Sidebar */
    aside.sidebar {
      grid-area: sidebar;
      background: var(--color-sidebar-bg);
      color: var(--color-sidebar-text);
      display: flex;
      flex-direction: column;
      padding: 20px 16px;
      gap: 24px;
      overflow-y: auto;
      position: sticky;
      top: 0;
      height: 100vh;
      box-shadow: inset -1px 0 5px rgba(0, 0, 0, 0.15);
      z-index: 18;
      transition: transform var(--transition-speed) ease;
    }

    aside.sidebar h2 {
      font-size: 1.2rem;
      font-weight: 700;
      margin-bottom: 12px;
      text-transform: uppercase;
      letter-spacing: 1.5px;
      user-select: none;
    }

    ul.nav-list {
      display: flex;
      flex-direction: column;
      gap: 12px;
      padding-left: 0;
      margin: 0;
      list-style: none;
    }

    ul.nav-list li {
      display: flex;
    }

    ul.nav-list li button,
    ul.nav-list li a {
      flex: 1;
      text-align: left;
      font-size: 1rem;
      padding: 12px 16px;
      border-radius: 12px;
      display: flex;
      align-items: center;
      gap: 12px;
      color: var(--color-sidebar-text);
      background: transparent;
      border: none;
      cursor: pointer;
      user-select: none;
      transition: background-color var(--transition-speed);
    }

    ul.nav-list li button:focus,
    ul.nav-list li a:focus {
      outline: 2px solid var(--color-primary-light);
      outline-offset: 2px;
    }

    ul.nav-list li button:hover,
    ul.nav-list li a:hover {
      background: var(--color-primary-light);
      color: var(--color-primary);
    }

    ul.nav-list li a.active,
    ul.nav-list li button.active {
      background: var(--color-primary);
      color: white;
      box-shadow: var(--box-shadow);
    }

    .material-icons.nav-icon {
      font-size: 22px;
      user-select: none;
    }

    .badge {
      font-size: 0.75rem;
      min-width: 24px;
      padding: 2px 8px;
      border-radius: 9999px;
      text-align: center;
      background: var(--color-error);
      color: white;
      user-select: none;
      font-weight: 700;
    }

    /* Main content */
    main.content {
      grid-area: main;
      background: white;
      padding: 32px 40px;
      overflow-y: auto;
      min-height: calc(100vh - var(--header-height));
    }

    main.content h1 {
      font-size: clamp(2.5rem, 4vw, 3rem);
      font-weight: 900;
      margin-bottom: 24px;
      color: var(--color-primary);
      user-select: none;
    }

    /* Report filter bar */
    .filter-bar {
      display: flex;
      flex-wrap: wrap;
      gap: 16px;
      margin-bottom: 24px;
      align-items: center;
    }

    .filter-bar label {
      font-weight: 600;
      color: var(--color-text-light);
      user-select: none;
    }

    .filter-bar input,
    .filter-bar select {
      padding: 8px 14px;
      font-size: 1rem;
      border-radius: 12px;
      border: 1.5px solid var(--color-primary-light);
      max-width: 180px;
      transition: border-color var(--transition-speed);
    }

    .filter-bar input:focus,
    .filter-bar select:focus {
      outline: none;
      border-color: var(--color-primary);
      box-shadow: 0 0 8px var(--color-primary-light);
    }

    /* Table styles */
    table.report-table {
      width: 100%;
      border-collapse: collapse;
      font-size: clamp(0.875rem, 1vw, 1rem);
      user-select: none;
    }

    table.report-table thead {
      background: var(--color-primary);
      color: white;
      font-weight: 700;
      text-align: left;
      user-select: none;
    }

    table.report-table thead th {
      padding: 16px 16px;
      position: sticky;
      top: 0;
      z-index: 10;
    }

    table.report-table tbody tr {
      border-bottom: 1px solid #e5e7eb;
      transition: background-color 0.3s ease;
    }

    table.report-table tbody tr:hover {
      background: var(--color-primary-light);
      cursor: pointer;
      color: var(--color-primary);
    }

    table.report-table tbody td {
      padding: 14px 16px;
    }

    table.report-table .amount {
      font-weight: 700;
      text-align: right;
      color: var(--color-success);
    }

    table.report-table .status {
      font-weight: 600;
      padding: 6px 14px;
      border-radius: 9999px;
      display: inline-block;
      color: white;
    }

    .status.pending {
      background: var(--color-warning);
      color: var(--color-text);
    }

    .status.completed {
      background: var(--color-success);
    }

    .status.failed {
      background: var(--color-error);
    }

    ul.nav-list li button,
    ul.nav-list li a {
      justify-content: flex-start;
      padding-left: 32px;
    }

    ul.nav-list li button span.label,
    ul.nav-list li a span.label {
      display: inline;
    }

    main.content {
      padding: 20px 16px;
      min-height: calc(100vh - var(--header-height) - var(--footer-height-mobile));
      overscroll-behavior: contain;
    }

    /* Micro-interactions */
    button.primary:hover,
    ul.nav-list li.button.active,
    ul.nav-list li a.active,
    ul.nav-list li button:hover,
    ul.nav-list li a:hover {
      transform: translateY(-2px);
      transition-timing-function: cubic-bezier(0.3, 1.5, 0.5, 1);
    }

    main.content h1 {
      transition: color 0.3s ease;
    }

    main.content h1:hover {
      color: var(--color-accent);
      cursor: default;
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

          <main class="content" role="main" tabindex="0">
            <h1>Laporan Pemasukan</h1>

            <form method="get" class="filter-bar" aria-label="Income report filters">
              <label for="date-from">From:</label>
              <input type="date" id="date-from" name="date-from" value="<?= htmlspecialchars($dateFrom) ?>" />

              <label for="date-to">To:</label>
              <input type="date" id="date-to" name="date-to" value="<?= htmlspecialchars($dateTo) ?>" />

              

              <button type="submit" class="primary">Filter</button>
              <a href="laporan.php" class="btn btn-secondary">Reset</a>
              </section>

              <section aria-label="Income report table section">
                <table class="report-table" role="table" aria-live="polite" aria-describedby="summary" tabindex="0">
                  <thead>
                    <tr>
                      <th scope="col">Tanggal</th>
                      <th scope="col">Nomor Transaksi</th>
                      <th scope="col">Customer</th>
                      <th scope="col">Mobil</th>
                      <th scope="col">durasi</th>
                      <th scope="col">Total</th>
                      <th scope="col">Metode</th>
                      <th scope="col">Status</th>
                    </tr>
                  </thead>
                  <tbody id="report-body">
                  <tbody id="report-body">
                    <?php
                    $total = 0;
                    foreach ($laporan as $row):
                      $total += $row['total_biaya'];
                    ?>
                      <tr>
                        <td><?= date('Y-m-d', strtotime($row['tanggal'])) ?></td>
                        <td><?= $row['nomor_transaksi'] ?></td>
                        <td><?= htmlspecialchars($row['customer']) ?></td>
                        <td><?= htmlspecialchars($row['mobil']) ?></td>
                        <td><?= $row['durasi'] ?> Jam</td>
                        <td class="amount">Rp<?= number_format($row['total_biaya'], 0, ',', '.') ?></td>
                        <td><?= ucfirst($row['metode_pembayaran']) ?></td>
                        <td><span class="status completed">Berhasil</span></td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                  </tbody>
                  <tfoot>
                    <tr>
                      <th colspan="2" scope="row" id="summary">Total Pemasukan:</th>
                      <th colspan="4" class="amount" id="total-amount">Rp<?= number_format($total, 0, ',', '.') ?></th>
                      <th colspan="2"></th>
                    </tr>
                  </tfoot>
                </table>
                    <div class="no-print">
                      <a href="export_excel.php?date-from=<?= $dateFrom ?>&date-to=<?= $dateTo ?>&status-filter=<?= $status ?>" class="btn btn-success">Export ke Excel</a>
                      <a href="laporan.php?export=pdf&date-from=<?= $dateFrom ?>&date-to=<?= $dateTo ?>&status-filter=<?= $status ?>" class="btn btn-danger">Cetak PDF</a>
                    </div>

              </section>
          </main>

          <!-- Footer -->
          <?php include '../../../components/footer.php'; ?>
        </div>
      </div>
      <a class="scroll-to-top rounded" href="#page-top"><i class="fas fa-angle-up"></i></a>
      <!-- Logout modal -->
      <?php include_once '../../../components/logout-modal.php'; ?>
      <!-- Scripts -->
      <script src="../../../assets/vendor/jquery/jquery.min.js"></script>
      <script src="../../../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
      <script src="../../../assets/vendor/jquery-easing/jquery.easing.min.js"></script>
      <script src="../../../assets/js/sb-admin-2.min.js"></script>
      <script src="../../../assets/vendor/datatables/jquery.dataTables.min.js"></script>
      <script src="../../../assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>
      <script src="../../../assets/js/demo/datatables-demo.js"></script>

    </div>

    <script>
      (() => {
        const sidebar = document.querySelector('aside.sidebar');
        const sidebarToggle = document.getElementById('sidebar-toggle');
        const reportBody = document.getElementById('report-body');
        const searchInput = document.getElementById('search-input');
        const dateFromInput = document.getElementById('date-from');
        const dateToInput = document.getElementById('date-to');
        const statusFilter = document.getElementById('status-filter');
        const resetFiltersButton = document.getElementById('reset-filters');
        const totalAmountEl = document.getElementById('total-amount');
        const themeToggle = document.getElementById('theme-toggle');

        // Format currency
        const formatCurrency = (num) =>
          num.toLocaleString('en-US', {
            style: 'currency',
            currency: 'USD'
          });

        // Render rows filtered by inputs
        function renderRows() {
          let filtered = incomeData.slice();

          // Filter by search text in source or category
          const search = searchInput.value.trim().toLowerCase();
          if (search) {
            filtered = filtered.filter(
              (item) =>
              item.source.toLowerCase().includes(search) ||
              item.category.toLowerCase().includes(search)
            );
          }
          // Filter by date range
          const fromDate = dateFromInput.value;
          const toDate = dateToInput.value;
          if (fromDate) {
            filtered = filtered.filter((item) => item.date >= fromDate);
          }
          if (toDate) {
            filtered = filtered.filter((item) => item.date <= toDate);
          }
          // Filter by status
          const status = statusFilter.value;
          if (status) {
            filtered = filtered.filter((item) => item.status === status);
          }

          // Render rows
          reportBody.innerHTML = '';
          let totalIncome = 0;
          for (const item of filtered) {
            totalIncome += item.amount;
            const row = document.createElement('tr');
            row.setAttribute('tabindex', '0');
            row.innerHTML = `
            <td>${item.date}</td>
            <td>${item.source}</td>
            <td class="amount">${formatCurrency(item.amount)}</td>
            <td>${item.category}</td>
            <td><span class="status ${item.status}">${item.status.charAt(0).toUpperCase() + item.status.slice(1)}</span></td>
          `;
            reportBody.appendChild(row);
          }
          totalAmountEl.textContent = formatCurrency(totalIncome);
        }

        // Event listeners
        searchInput.addEventListener('input', renderRows);
        dateFromInput.addEventListener('change', renderRows);
        dateToInput.addEventListener('change', renderRows);
        statusFilter.addEventListener('change', renderRows);
        resetFiltersButton.addEventListener('click', () => {
          searchInput.value = '';
          dateFromInput.value = '';
          dateToInput.value = '';
          statusFilter.value = '';
          renderRows();
        });

        // Sidebar toggle mobile
        sidebarToggle.addEventListener('click', () => {
          const expanded = sidebarToggle.getAttribute('aria-expanded') === 'true' || false;
          sidebarToggle.setAttribute('aria-expanded', !expanded);
          sidebar.classList.toggle('open');
        });

        // Theme toggle
        themeToggle.addEventListener('click', () => {
          if (document.documentElement.hasAttribute('data-theme')) {
            document.documentElement.removeAttribute('data-theme');
            themeToggle.innerHTML = '<span class="material-icons">light_mode</span>';
          } else {
            document.documentElement.setAttribute('data-theme', 'dark');
            themeToggle.innerHTML = '<span class="material-icons">dark_mode</span>';
          }
        });

        // Initial render
        renderRows();

        // Accessibility focus trap on main content for demo
        const mainContent = document.querySelector('main.content');
        mainContent.addEventListener('keydown', (ev) => {
          if (ev.key === 'Tab' && !ev.shiftKey) {
            ev.preventDefault();
            ev.currentTarget.focus();
          }
        });
      })();
    </script>
</body>

</html>