<?php
session_start();
include('../../koneksi.php');

// Cek apakah user sudah login
if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit();
}

$user_id = $_SESSION['user_id'];

// Cek apakah akun user ditolak
$cek_verifikasi = mysqli_query($db, "SELECT status_verifikasi, blacklist FROM users WHERE id = '$user_id'");
$user_status = mysqli_fetch_assoc($cek_verifikasi);

if ($user_status['status_verifikasi'] === 'ditolak') {
  echo "<script>alert('Akun Anda telah ditolak dan tidak dapat melakukan booking.'); window.location.href='listing.php';</script>";
  exit;
}

if ($user_status['blacklist'] == 1) {
  echo "<script>alert('Akun Anda diblokir dan tidak bisa melakukan pemesanan.'); window.location.href='blacklist.php';</script>";
  exit;
}

// Ambil informasi tanggal & jam dari GET
$tanggal_mulai   = $_GET['tanggal_mulai'] ?? '';
$jam_mulai       = $_GET['jam_mulai'] ?? '';
$tanggal_selesai = $_GET['tanggal_selesai'] ?? '';
$jam_selesai     = $_GET['jam_selesai'] ?? '';

// Ambil data user lengkap
$query_user = "SELECT nama_lengkap, alamat, telepon, email, status_verifikasi, file_ktp, file_kk, blacklist
               FROM users 
               LEFT JOIN dokumen_user ON users.id = dokumen_user.id_user
               WHERE users.id = $user_id";
$result_user = mysqli_query($db, $query_user);
$user = mysqli_fetch_assoc($result_user);

// Ambil data mobil
if (!isset($_GET['unit_id'])) {
  echo "ID mobil tidak ditemukan.";
  exit;
}

$unit_id = $_GET['unit_id'];

$query_mobil = "
    SELECT um.*, jm.nama AS nama_mobil, jm.harga_sewa, jm.jumlah_kursi
    FROM unit_mobil um
    JOIN jenis_mobil jm ON um.jenis_mobil_id = jm.id
    WHERE um.id = $unit_id
";
$mobil = mysqli_fetch_assoc(mysqli_query($db, $query_mobil));

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <title>Rental Mobil Form</title>
  <meta name="description" content="Rental Mobil Form" />
  <meta name="keywords" content="mobil, rental, form, booking" />

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect" />
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Raleway:wght@600;700&amp;family=Nunito+Sans:wght@400;600&amp;display=swap"
    rel="stylesheet" />

  <style>
    /* Base Reset and typography */
    body {
      margin: 0;
      font-family: 'Nunito Sans', sans-serif;
      background-color: #1e293b;
      color: #6b7280;
      line-height: 1.6;
      font-size: 17px;
      min-height: 100vh;
      display: flex;
      /* justify-content: center; */
      align-items: flex-start;
      padding: 2rem;
    }

    /* Container */
    .container {
      /* max-width: 1200px; */
      width: 100%;
      background: #fff;
      border-radius: 0.75rem;
      box-shadow: 0 10px 32px 8px rgba(0 0 0 / 0.08);
      padding: 3.5rem 3rem 3.5rem;
      box-sizing: border-box;
      display: flex;
      gap: 3rem;
      flex-wrap: wrap;
    }

    /* Form container */
    .form-container {
      flex: 1 1 480px;
      min-width: 320px;
    }

    /* Car details container */
    .car-details-container {
      flex: 1 1 380px;
      min-width: 280px;
      background-color: #1e293b;
      border-radius: 0.75rem;
      box-shadow: 0 6px 24px rgb(0 0 0 / 0.1);
      padding: 1.5rem 2rem;
      color: #ffffff;
      font-family: 'Nunito Sans', sans-serif;
      display: flex;
      flex-direction: column;
      gap: 1rem;
      user-select: none;
    }

    /* Car image */
    .car-image {
      width: 100%;
      height: auto;
      border-radius: 0.5rem;
      overflow: hidden;
      object-fit: cover;
      aspect-ratio: 4 / 3;
      box-shadow: 0 4px 12px rgb(0 0 0 / 0.08);
    }

    /* Car detail item */
    .car-detail-item {
      display: flex;
      justify-content: space-between;
      font-size: 1rem;
      line-height: 1.4;
      font-weight: 600;
      color: #4b5563;
    }

    .car-detail-label {
      color: #6b7280;
    }

    /* Headline */
    h1 {
      font-family: 'Raleway', sans-serif;
      font-weight: 700;
      font-size: 3rem;
      margin-bottom: 0.6rem;
      color: #111827;
      /* almost black */
      user-select: none;
    }

    /* Subtitle / description */
    .description {
      font-size: 1.125rem;
      margin-bottom: 2.5rem;
      user-select: none;
      color: #4b5563;
    }

    /* Display horizontal flex for grouped inputs */
    .grouped-inputs {
      display: flex;
      flex-wrap: wrap;
      gap: 1.5rem;
      margin-bottom: 1rem;
    }

    .grouped-inputs .form-group {
      flex: 1 1 45%;
      min-width: 180px;
    }

    /* Group for time inputs side by side */
    .grouped-time-inputs {
      display: flex;
      flex-wrap: wrap;
      gap: 1.5rem;
      margin-bottom: 1rem;
    }

    .grouped-time-inputs .form-group {
      flex: 1 1 45%;
      min-width: 180px;
    }

    /* Field wrapper for inputs and labels */
    .form-group {
      display: flex;
      flex-direction: column;
    }

    label {
      font-weight: 600;
      margin-bottom: 0.3rem;
      color: #374151;
      user-select: none;
      font-size: 1rem;
    }

    /* Inputs and selects */
    input[type="text"],
    input[type="email"],
    input[type="tel"],
    input[type="date"],
    input[type="time"],
    input[type="file"],
    select,
    textarea {
      font-family: 'Nunito Sans', sans-serif;
      font-size: 1rem;
      padding: 0.65rem 1rem;
      border: 1.5px solid #d1d5db;
      border-radius: 0.625rem;
      background-color: #ffffff;
      color: #111827;
      transition: border-color 0.3s ease, box-shadow 0.3s ease;
      resize: vertical;
    }

    input[type="text"]:focus,
    input[type="email"]:focus,
    input[type="tel"]:focus,
    input[type="date"]:focus,
    input[type="time"]:focus,
    input[type="file"]:focus,
    select:focus,
    textarea:focus {
      outline: none;
      border-color: #2563eb;
      box-shadow: 0 0 8px 3px rgba(37, 99, 235, 0.3);
      background-color: #fff;
    }

    /* Submit button */
    button[type="submit"] {
      font-family: 'Raleway', sans-serif;
      font-weight: 700;
      font-size: 1.25rem;
      padding: 0.8rem 2rem;
      background-color: #111827;
      color: white;
      border: none;
      border-radius: 0.75rem;
      cursor: not-allowed;
      transition: background-color 0.3s ease;
      user-select: none;
      margin-top: 1.5rem;
      justify-self: start;
      width: 150px;
    }

    button[type="submit"]:enabled {
      cursor: pointer;
      background-color: #111827;
    }

    button[type="submit"]:enabled:hover,
    button[type="submit"]:enabled:focus {
      background-color: #2563eb;
      outline: none;
    }

    /* Responsive */
    @media (min-width: 900px) {
      form {
        grid-template-columns: 1fr 1fr;
        gap: 2rem;
      }

      /* Make some inputs full width */
      .full-width {
        grid-column: 1 / -1;
      }

      button[type="submit"] {
        grid-column: 1 / -1;
        width: 200px;
      }
    }

    /* Accessibility & UX improvements */
    input::placeholder,
    textarea::placeholder {
      color: #9ca3af;
    }

    .form-info {
      margin-bottom: 1rem;
    }

    .form-info label {
      font-weight: bold;
      color: #333;
      display: block;
      margin-bottom: 0.3rem;
    }

    .form-info p {
      display: inline-block;
      /* Agar lebar menyesuaikan isi */
      background: #f8f9fa;
      padding: 0.5rem 1rem;
      border-radius: 0.5rem;
      border: 1px solid #ccc;
      white-space: pre-wrap;
      /* Agar teks tetap wrap jika panjang */
      max-width: 100%;
      /* Hindari overflow melewati container */
    }

    .form-display {
      display: block;
      background-color: #f8f9fa;
      padding: 0.5rem 1rem;
      border: 1px solid #ced4da;
      border-radius: 0.5rem;
      font-size: 1rem;
      color: #495057;
      min-height: 42px;
      /* biar sejajar dengan input lain */
      line-height: 1.5;
      margin-top: 4px;
    }
  </style>
</head>

<body>
  <main>
    <section class="container" aria-labelledby="formTitle">
      <form class="form-container form">
        <h1 id="formTitle">Form Rental Mobil</h1>
        <p class="description">Silakan isi formulir di bawah untuk menyewa mobil pilihan Anda dengan mudah dan cepat.</p>

        <!-- Informasi User -->
        <div class="grouped-inputs">
          <div class="form-info">
            <label>Nama Lengkap</label>
            <p><?= htmlspecialchars($user['nama_lengkap']) ?></p>
          </div>

          <div class="form-group">
            <label for="alamat">Alamat</label>
            <p class="form-display"><?= htmlspecialchars($user['alamat']) ?></p>
          </div>
        </div>

        <div class="grouped-inputs">
          <div class="form-info">
            <label>Nomor Telepon</label>
            <p><?= htmlspecialchars($user['telepon']) ?></p>
          </div>

          <div class="form-info">
            <label>Email</label>
            <p><?= htmlspecialchars($user['email']) ?></p>
          </div>
        </div>

        <!-- Informasi Tanggal & Jam -->
        <div class="grouped-time-inputs">
          <div class="form-info">
            <label>Tanggal Pengambilan</label>
            <p><?= htmlspecialchars($tanggal_mulai) ?></p>
            <input type="hidden" id="tanggal_pengambilan" value="<?= $tanggal_mulai ?>">
          </div>
          <div class="form-info">
            <label>Jam Pengambilan</label>
            <p><?= htmlspecialchars($jam_mulai) ?></p>
            <input type="hidden" id="jam_pengambilan" value="<?= $jam_mulai ?>">
          </div>
        </div>

        <!-- Tanggal & Jam Pengembalian -->
        <div class="grouped-inputs">
          <div class="form-info">
            <label>Tanggal Pengembalian</label>
            <p><?= htmlspecialchars($tanggal_selesai) ?></p>
            <input type="hidden" id="tanggal_pengembalian" value="<?= $tanggal_selesai ?>">
          </div>
          <div class="form-info">
            <label>Jam Pengembalian</label>
            <p><?= htmlspecialchars($jam_selesai) ?></p>
            <input type="hidden" id="jam_pengembalian" value="<?= $jam_selesai ?>">
          </div>
        </div>

        <!-- KK and KTP Document inputs side by side -->
        <div class="grouped-inputs">
          <div class="form-group">
            <label>File KTP</label>
            <?php if (!empty($user['file_ktp'])): ?>
              <p><a href="../../uploads/dokumen-user/<?php echo $user['file_ktp']; ?>" target="_blank">Lihat File KTP</a></p>
            <?php else: ?>
              <p>Tidak ada file KTP</p>
            <?php endif; ?>
          </div>

          <div class="form-group">
            <label>File KK</label>
            <?php if (!empty($user['file_kk'])): ?>
              <p><a href="../../uploads/dokumen-user/<?php echo $user['file_kk']; ?>" target="_blank">Lihat File KK</a></p>
            <?php else: ?>
              <p>Tidak ada file KK</p>
            <?php endif; ?>
          </div>

        </div>

        <div class="form-group full-width">
          <label>Fasilitas</label>
          <div style="display: flex; gap: 1.5rem; flex-wrap: wrap;">
            <!-- <label><input type="checkbox"  name="facilities" value="Supir" /> Supir</label>
            <label><input type="checkbox" name="facilities" value="Lepas Kunci" /> Lepas Kunci</label> -->
            <select name="facilities" id="fasilitas">
              <option value="" disabled selected>Pilih Fasilitas</option>
              <option value="dengan supir">Supir</option>
              <option value="lepas kunci">Lepas Kunci</option>
            </select>
          </div>
        </div>

        <div class="form-group full-width">
          <label>Jaminan</label>
          <select id="jaminan" name="jaminan" required>
            <option value="" disabled selected>Pilih Jaminan</option>
            <option value="uang">Uang</option>
            <option value="motor">Motor</option>
          </select>
        </div>

        <div class="form-group full-width">
          <label for="payment-method">Cara Pembayaran</label>
          <select id="payment-method" name="payment-method" required>
            <option value="" disabled selected>Pilih cara pembayaran</option>
            <option value="Transfer">Transfer</option>
            <option value="Cash">Cash</option>
          </select>
        </div>

        <div class="form-group full-width">
          <label for="rental-cost">Biaya Sewa</label>
          <input type="text" id="total_biaya" name="rental-cost" readonly />
        </div>

        <button type="submit" id="proses-booking">Sewa Sekarang</button>
      </form>


      <aside class="car-details-container" aria-label="Detail mobil yang dipilih">
        <div class="car-details">
          <h3>Mobil yang Anda Pilih</h3>
          <img src="../../uploads/foto-mobil/<?= $mobil['foto']; ?>" alt="foto mobil" class="car-image" style="width: 450px; height: auto;">
          <table>
            <tr>
              <td><b>Nama Mobil</b></td>
              <td>: <?= $mobil['nama_mobil']; ?></td>
            </tr>
            <tr>
              <td><b>Tahun</b></td>
              <td>: <?= $mobil['tahun_beli']; ?></td>
            </tr>
            <tr>
              <td><b>Harga per Hari</b></td>
              <td>: Rp <?= number_format($mobil['harga_sewa'], 0, ',', '.'); ?></td>
            </tr>
            <tr>
              <td><b>Transmisi</b></td>
              <td>: <?= $mobil['transmisi']; ?></td>
            </tr>
            <tr>
              <td><b>Jumlah Kursi</b></td>
              <td>: <?= $mobil['jumlah_kursi']; ?></td>
            </tr>
            <tr>
              <td><b>Plat Nomor</b></td>
              <td>: <?= $mobil['plat_nomor']; ?></td>
            </tr>
            <tr>
              <td><b>Warna</b></td>
              <td>: <?= $mobil['warna']; ?></td>
            </tr>
          </table>
        </div>
      </aside>
    </section>
  </main>

  <script>
    document.addEventListener("DOMContentLoaded", function() {
      const today = new Date().toISOString().split('T')[0];

      const pickupDateInput = document.getElementById("tanggal_pengambilan");
      const returnDateInput = document.getElementById("tanggal_pengembalian");

      pickupDateInput.setAttribute("min", today);
      returnDateInput.setAttribute("min", today);

      // Opsional: Perbarui tanggal pengembalian otomatis setelah memilih tanggal pengambilan
      pickupDateInput.addEventListener("change", function() {
        returnDateInput.setAttribute("min", this.value);
      });
    });
  </script>

  <!-- Midtrans client key -->
  <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-G-mHIBdE0tG4avXY"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const userId = <?php echo $_SESSION['user_id']; ?>;
      const isVerifiedUser = "<?= $user['status_verifikasi'] ?>"
      let hargaSewa = 0;
      let totalBiaya = 0;
      let tglAwal;
      let tglAkhir;
      let jamAwal;
      let jamAkhir;
      let durasiJam;

      async function hitungBiaya() {
        tglAwal = document.getElementById('tanggal_pengambilan').value;
        jamAwal = document.getElementById('jam_pengambilan').value;
        tglAkhir = document.getElementById('tanggal_pengembalian').value;
        jamAkhir = document.getElementById('jam_pengembalian').value;
        let fasilitas = document.getElementById('fasilitas').value;
        let unitMobilId = <?php echo $_GET['unit_id']; ?>;

        if (tglAwal && jamAwal && tglAkhir && jamAkhir && unitMobilId) {
          const start = new Date(`${tglAwal}T${jamAwal}`);
          const end = new Date(`${tglAkhir}T${jamAkhir}`);

          if (end <= start) {
            alert("Tanggal atau jam pengembalian harus setelah pengambilan.");
            return;
          }

          durasiJam = Math.ceil((end - start) / (1000 * 60 * 60));
          const periode12Jam = Math.ceil(durasiJam / 12);

          // Ambil harga sewa dari server
          const response = await fetch(`get_harga.php?unit_id=${unitMobilId}`);
          const data = await response.json();
          const hargaPer12Jam = parseInt(data.harga);


          totalBiaya = hargaPer12Jam * periode12Jam;

          if (fasilitas === "dengan supir") {
            totalBiaya += 250000;
          }

          console.log("Harga per 12 jam:", hargaPer12Jam);
          console.log("Durasi jam:", durasiJam);
          console.log("Total biaya:", totalBiaya);

          // document.getElementById('total_biaya').value = totalBiaya;
          document.getElementById('total_biaya').value = totalBiaya.toLocaleString("id-ID", {
            style: "currency",
            currency: "IDR",
            maximumFractionDigits: 0,
          });
        }
      }

      document.getElementById('tanggal_pengambilan').addEventListener('change', hitungBiaya);
      document.getElementById('jam_pengambilan').addEventListener('change', hitungBiaya);
      document.getElementById('tanggal_pengembalian').addEventListener('change', hitungBiaya);
      document.getElementById('jam_pengembalian').addEventListener('change', hitungBiaya);
      document.getElementById('fasilitas').addEventListener('change', hitungBiaya);

      const form = document.querySelector('form');
      const submitButton = form.querySelector('button[type="submit"]');

      // Melakukan proses booking
      document.getElementById("proses-booking").addEventListener("click", async function(e) {
        e.preventDefault();

        if (this.disabled) return;

        // Data yang dikirim ke proses-booking.php
        const data = {
          unit_mobil_id: <?= $unit_id; ?>,
          customer_id: <?= $user_id; ?>,
          metode_pembayaran: document.getElementById("payment-method").value,
          total_biaya: totalBiaya,
          jaminan: document.getElementById("jaminan").value,
          tgl_booking: tglAwal,
          tgl_kembali: tglAkhir,
          jam_booking: jamAwal,
          jam_kembali: jamAkhir,
          durasi: durasiJam,
          fasilitas: document.getElementById("fasilitas").value,
        };

        const json = JSON.stringify(data);
        const res = await fetch("actions/proses-booking.php", {
          method: "POST",
          headers: {
            'Content-Type': 'application/json',
          },
          body: json,
        });
        const result = await res.json();

        let message = await result.message;
        if (message) return alert(message);

        const metode = document.getElementById("payment-method").value;

        if (metode === "Transfer") {
          let snapToken = await result.snapToken;
          if (snapToken) {
            window.snap.pay(snapToken, {
              onSuccess: function(result) {
                console.log('success', result);
                window.location.href = "./riwayat.php";
              },
              onPending: function(result) {
                console.log('pending', result);
              },
              onError: function(result) {
                console.log('error', result);
              },
              onClose: function() {
                alert('Transaksi belum selesai');
              }
            });
          }
        } else {
          // CASH: redirect ke detail transaksi
          const bookingId = result.booking_id;
          window.location.href = `data.php?booking_id=${result.booking_id}`;
        }
      });
    });

    fetch("booking.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify(data),
      })
      .then(response => response.json())
      .then(result => {
        if (result.message) {
          alert(result.message); // ← ini yang tampilkan pesan error
        } else {
          // Booking sukses
          console.log(result.snapToken);
        }
      });
  </script>
</body>

</html>