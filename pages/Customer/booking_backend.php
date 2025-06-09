<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit();
}
?>



<?php
include 'booking_backend.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Form Booking</title>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
  <h2>Form Booking</h2>
  <form id="bookingForm" method="POST" action="booking_backend.php">
    <input type="hidden" name="unit_mobil_id" id="unit_mobil_id" value="<?php echo $_GET['unit_mobil_id']; ?>">

    <div id="infoUser"></div>

    <label for="tanggal_pengambilan">Tanggal Pengambilan:</label>
    <input type="date" name="tanggal_pengambilan" id="tanggal_pengambilan" required><br>

    <label for="jam_pengambilan">Jam Pengambilan:</label>
    <input type="time" name="jam_pengambilan" id="jam_pengambilan" required><br>

    <label for="tanggal_pengembalian">Tanggal Pengembalian:</label>
    <input type="date" name="tanggal_pengembalian" id="tanggal_pengembalian" required><br>

    <label for="jam_pengembalian">Jam Pengembalian:</label>
    <input type="time" name="jam_pengembalian" id="jam_pengembalian" required><br>

    <label for="fasilitas">Fasilitas:</label>
    <select name="fasilitas" id="fasilitas">
      <option value="lepas kunci">Lepas Kunci</option>
      <option value="dengan supir">Dengan Supir (+Rp100.000)</option>
    </select><br>

    <label for="jaminan">Jaminan:</label>
    <select name="jaminan">
      <option value="motor">Motor</option>
      <option value="uang">Uang</option>
    </select><br>

    <label for="metode_pembayaran">Cara Pembayaran:</label>
    <select name="metode_pembayaran">
      <option value="transfer">Transfer</option>
      <option value="cash">Cash</option>
    </select><br>

    <p><strong>Total Biaya:</strong> <span id="totalBiaya">Rp0</span></p>

    <button type="submit">Booking Sekarang</button>
  </form>

  <h3>Info Mobil</h3>
  <div id="infoMobil"></div>

<script>
$(document).ready(function () {
  const userId = <?php echo $_SESSION['user_id']; ?>;
  const unitMobilId = <?php echo $_GET['unit_mobil_id']; ?>;
  let hargaSewa = 0;

  // Load info user
  $.get('booking_backend.php', { id_user: userId }, function (data) {
    const user = JSON.parse(data);
    $('#infoUser').html(`
      <p>Nama: ${user.nama}</p>
      <p>Alamat: ${user.alamat}</p>
      <p>No. Telepon: ${user.telepon}</p>
      <p>Email: ${user.email}</p>
      <p>KK: <a href="uploads/dokumen-user/${user.file_kk}" target="_blank">Lihat</a></p>
      <p>KTP: <a href="uploads/dokumen-user/${user.file_ktp}" target="_blank">Lihat</a></p>
    `);
  });

  // Load info mobil dan simpan harga sewa
  $.get('booking_backend.php', { unit_mobil_id: unitMobilId }, function (data) {
    const mobil = JSON.parse(data);
    hargaSewa = mobil.harga_sewa;
    $('#infoMobil').html(`
      <p>Nama Mobil: ${mobil.nama}</p>
      <p>Harga Sewa per 12 jam: Rp${mobil.harga_sewa}</p>
      <p>Plat Nomor: ${mobil.plat_nomor}</p>
      <p>Warna: ${mobil.warna}</p>
      <p>Transmisi: ${mobil.transmisi}</p>
      <p>Tahun Beli: ${mobil.tahun_beli}</p>
    `);
  });

  // Fungsi untuk hitung total biaya
  function hitungBiaya() {
    const tglAwal = $('#tanggal_pengambilan').val();
    const jamAwal = $('#jam_pengambilan').val();
    const tglAkhir = $('#tanggal_pengembalian').val();
    const jamAkhir = $('#jam_pengembalian').val();
    const fasilitas = $('#fasilitas').val();

    if (tglAwal && jamAwal && tglAkhir && jamAkhir) {
      const start = new Date(`${tglAwal}T${jamAwal}`);
      const end = new Date(`${tglAkhir}T${jamAkhir}`);
      const durasiJam = Math.ceil((end - start) / (1000 * 60 * 60));
      const blok12jam = Math.ceil(durasiJam / 12);
      let total = hargaSewa * blok12jam;
      if (fasilitas === 'dengan supir') total += 100000;
      $('#totalBiaya').text(`Rp${total.toLocaleString('id-ID')}`);
    }
  }

  $('#tanggal_pengambilan, #jam_pengambilan, #tanggal_pengembalian, #jam_pengembalian, #fasilitas').on('change', hitungBiaya);
});
</script>
</body>
</html>