<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Data Transaksi</title>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
<style>
  /* CSS Variables using provided color scheme */
  :root {
    --background-color: #031119;
    --accent-color: #e3a127;
    --surface-color: #374151;
    --default-color: rgba(255 255 255 / 0.85);
    --contrast-color: #ffffff;
    --font-default: 'Roboto', system-ui, -apple-system, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
    --font-heading: 'Nunito Sans', sans-serif;
  }

  /* Reset and base */
  * {
    box-sizing: border-box;
  }

  body {
    margin: 0;
    background-color: var(--background-color);
    color: var(--default-color);
    font-family: var(--font-default);
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
  }

  /* Scrollbar */
  ::-webkit-scrollbar {
    width: 10px;
    background: var(--background-color);
  }

  ::-webkit-scrollbar-thumb {
    background: var(--accent-color);
    border-radius: 10px;
  }

  /* Header */
  header {
    position: sticky;
    top: 0;
    height: 64px;
    background: rgba(27, 38, 44, 0.75);
    backdrop-filter: blur(12px);
    display: flex;
    align-items: center;
    padding: 0 24px;
    box-shadow: 0 4px 12px rgb(227 161 39 / 0.3);
    z-index: 1000;
  }

  header .logo {
    color: var(--accent-color);
    font-family: var(--font-heading);
    font-weight: 900;
    font-size: 1.6rem;
    letter-spacing: 1.2px;
    user-select: none;
  }

  /* Container */
  main {
    max-width: 720px;
    margin: 2rem auto 4rem;
    background: var(--surface-color);
    border-radius: 16px;
    box-shadow: 0 8px 24px rgb(0 0 0 / 0.6);
    overflow: hidden;
    padding: 1.5rem 2rem 2.5rem;
  }

  /* Title section */
  main h1 {
    font-family: var(--font-heading);
    color: var(--accent-color);
    font-size: clamp(1.8rem, 4vw, 2.4rem);
    font-weight: 800;
    margin-bottom: 12px;
    text-align: center;
  }

  main p.subtitle {
    text-align: center;
    margin: 0 0 2rem;
    font-weight: 600;
    font-size: 1rem;
    color: var(--default-color);
    opacity: 0.85;
  }

  /* Info grid for user & transaction details */
  .info-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1.5rem 3rem;
    margin-bottom: 2.5rem;
  }

  .info-block {
    background: var(--background-color);
    padding: 1rem 1.5rem;
    border-radius: 12px;
    box-shadow: inset 0 0 15px rgb(227 161 39 / 0.1);
  }

  .info-block h2 {
    font-family: var(--font-heading);
    margin: 0 0 0.6rem;
    color: var(--accent-color);
    font-weight: 700;
    font-size: 1.1rem;
    border-bottom: 1px solid rgb(227 161 39 / 0.3);
    padding-bottom: 0.3rem;
  }

  .info-block ul {
    list-style: none;
    padding: 0;
    margin: 0;
    color: var(--default-color);
  }

  .info-block ul li {
    margin-bottom: 0.5rem;
    font-size: 0.9rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
  }

  .info-block ul li i.material-icons {
    color: var(--accent-color);
    font-size: 20px;
    width: 24px;
    height: 24px;
  }

  /* Transaction details table for car rental info */
  table.transaction-table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0 12px;
  }

  table.transaction-table thead tr {
    background: var(--background-color);
  }

  table.transaction-table thead th {
    font-weight: 700;
    color: var(--accent-color);
    padding: 12px 15px;
    text-align: left;
    font-family: var(--font-heading);
    font-size: 0.95rem;
    border-radius: 12px 12px 0 0;
  }

  table.transaction-table tbody tr {
    background: var(--background-color);
    box-shadow: 0 4px 8px rgb(0 0 0 / 0.25);
    border-radius: 12px;
  }

  table.transaction-table tbody tr td {
    padding: 14px 15px;
    font-size: 0.95rem;
    color: var(--default-color);
    vertical-align: middle;
  }

  table.transaction-table tbody tr:nth-child(even) {
    background: var(--surface-color);
  }

  table.transaction-table tbody tr:last-child {
    font-weight: 700;
    color: var(--accent-color);
    border-top: 2px solid var(--accent-color);
  }

  /* Total row styling */
  .total-row td {
    font-weight: 700;
  }

  /* Footer summary */
  .summary {
    margin-top: 2.5rem;
    padding-top: 1.5rem;
    border-top: 1px solid rgb(227 161 39 / 0.3);
    display: flex;
    justify-content: flex-end;
    gap: 2rem;
  }

  .summary div {
    font-size: 1.1rem;
    font-weight: 700;
    color: var(--accent-color);
  }

  /* Print button */
  .btn-print {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    background: var(--accent-color);
    color: var(--background-color);
    border: none;
    border-radius: 28px;
    padding: 12px 24px;
    font-weight: 700;
    font-size: 1rem;
    cursor: pointer;
    box-shadow: 0 8px 20px rgb(227 161 39 / 0.6);
    transition: background-color 0.25s ease, transform 0.15s ease;
    user-select: none;
    margin: 1rem auto 0;
    width: 100%;
    max-width: 300px;
  }

  .btn-print:hover {
    background: #c3901a;
    transform: translateY(-2px);
    box-shadow: 0 12px 30px rgb(227 161 39 / 0.8);
  }

  .btn-print i.material-icons {
    font-size: 24px;
  }

  /* Responsive adjustments */
  @media (max-width: 600px) {
    main {
      margin: 1rem;
      padding: 1rem 1.5rem 2rem;
    }

    .info-grid {
      display: block;
    }

    .info-block {
      margin-bottom: 1.5rem;
    }

    .summary {
      flex-direction: column;
      align-items: flex-start;
    }

    .btn-print {
      max-width: 100%;
    }
  }
</style>
</head>
<body>
<main role="main" aria-labelledby="transaction-title">
  <h1 id="transaction-title">Detail Transaksi Rental Mobil</h1>
  <p class="subtitle">Terima kasih atas kepercayaan Anda. Berikut adalah detail transaksi rental mobil Anda.</p>

  <section class="info-grid" aria-label="Informasi Pelanggan dan Transaksi">
    <div class="info-block" role="region" aria-labelledby="customer-info-title">
      <h2 id="customer-info-title">Informasi Pelanggan</h2>
      <ul>
        <li><i class="material-icons" aria-hidden="true">person</i><span>Nama: Budi Santoso</span></li>
        <li><i class="material-icons" aria-hidden="true">email</i><span>Email: budi.santoso@mail.com</span></li>
        <li><i class="material-icons" aria-hidden="true">phone</i><span>Telepon: 0812-3456-7890</span></li>
        <li><i class="material-icons" aria-hidden="true">location_on</i><span>Alamat: Jl. Melati No.5, Jakarta</span></li>
      </ul>
    </div>

    <div class="info-block" role="region" aria-labelledby="transaction-info-title">
      <h2 id="transaction-info-title">Detail Transaksi</h2>
      <ul>
        <li><i class="material-icons" aria-hidden="true">event</i><span>Tanggal Pesan: 15 Maret 2025</span></li>
        <li><i class="material-icons" aria-hidden="true">event_available</i><span>Tanggal Rental Mulai: 20 Maret 2025</span></li>
        <li><i class="material-icons" aria-hidden="true">event_busy</i><span>Tanggal Rental Selesai: 25 Maret 2025</span></li>
        <li><i class="material-icons" aria-hidden="true">receipt_long</i><span>No. Transaksi: INV-20250315-0001</span></li>
      </ul>
    </div>
  </section>

  <section aria-label="Rincian Rental Mobil">
    <table class="transaction-table" role="table" aria-describedby="transaction-summary">
      <thead>
        <tr>
          <th scope="col">Mobil</th>
          <th scope="col">Tipe</th>
          <th scope="col">Durasi</th>
          <th scope="col">Harga/hari</th>
          <th scope="col">Total</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>Toyota Avanza</td>
          <td>MPV</td>
          <td>5 Hari</td>
          <td>Rp450.000</td>
          <td>Rp2.250.000</td>
        </tr>
        <tr>
          <td>Honda Jazz</td>
          <td>Hatchback</td>
          <td>3 Hari</td>
          <td>Rp400.000</td>
          <td>Rp1.200.000</td>
        </tr>
        <tr class="total-row">
          <td colspan="4" style="text-align: right;">Total Pembayaran</td>
          <td>Rp3.450.000</td>
        </tr>
      </tbody>
    </table>
  </section>

  <section class="summary" aria-live="polite" aria-atomic="true" aria-relevant="text">
    <div>Metode Pembayaran: Cash</div>
    <div>Status: <strong>Lunas</strong></div>
  </section>

</main>
</body>
</html>