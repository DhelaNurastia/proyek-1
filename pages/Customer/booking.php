<?php
$base_url = '/proyek-1/';
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Car Rental Booking Form with Available Cars</title>
<style>
  :root {
    --primary-color: #007bff;
    --secondary-color: #e0e0e0;
    --background-color: rgba(248, 249, 250, 0.9);
    --input-bg: #fff;
    --input-border: #ced4da;
    --font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  }

  body {
    background-image: url('<?= $base_url ?>assets/image/form.jpg');
    background-size: cover;
    background-position: center center;
    font-family: var(--font-family);
    margin: 0;
    padding: 1rem;
    min-height: 100vh;
    color: var(--secondary-color);
    display: flex;
    justify-content: center;
    align-items: flex-start;
  }

  .container {
    background: var(--background-color);
    max-width: 1200px;
    width: 100%;
    border-radius: 8px;
    box-shadow: 0 8px 16px rgb(0 0 0 / 0.3);
    display: flex;
    gap: 2rem;
    padding: 2rem;
    box-sizing: border-box;
    color: #212529;
  }

  .form-section {
    flex: 1;
    min-width: 350px;
  }

  h1 {
    margin-top: 0;
    margin-bottom: 1.5rem;
    font-weight: 700;
    text-align: center;
    color: var(--primary-color);
  }

  form {
    display: flex;
    flex-direction: column;
  }

  .form-row {
    display: flex;
    gap: 1.5rem;
    flex-wrap: wrap;
  }

  .form-group {
    flex: 1;
    min-width: 250px;
    display: flex;
    flex-direction: column;
  }

  label {
    font-weight: 600;
    margin-bottom: 0.25rem;
    color: #495057;
  }

  input[type="text"],
  input[type="email"],
  input[type="tel"],
  input[type="date"],
  select,
  textarea,
  input[type="file"] {
    padding: 0.5rem;
    border: 1px solid var(--input-border);
    border-radius: 4px;
    background: var(--input-bg);
    font-size: 1rem;
    transition: border-color 0.3s ease;
    resize: vertical;
  }

  input[type="text"]:focus,
  input[type="email"]:focus,
  input[type="tel"]:focus,
  input[type="date"]:focus,
  select:focus,
  textarea:focus,
  input[type="file"]:focus {
    outline: none;
    border-color: var(--primary-color);
    box-shadow: 0 0 5px var(--primary-color);
  }

  textarea {
    min-height: 80px;
  }

  .radio-group {
    margin-bottom: 1rem;
  }
  .radio-group label {
    font-weight: 500;
    margin-right: 1rem;
    color: #495057;
    cursor: pointer;
  }
  .radio-group input[type="radio"] {
    margin-right: 0.3rem;
  }
  .radio-group .error {
    margin-top: 0.25rem;
    margin-left: 1.25rem;
    display: none;
  }

  .error {
    color: #dc3545;
    font-size: 0.875rem;
    margin-top: 0.25rem;
    display: none;
  }

  button {
    align-self: center;
    background: var(--primary-color);
    color: white;
    padding: 0.75rem 2rem;
    border: none;
    border-radius: 4px;
    font-weight: 700;
    font-size: 1.1rem;
    cursor: pointer;
    transition: background-color 0.3s ease;
    margin-top: 1rem;
  }

  button:hover,
  button:focus {
    background: #0056b3;
    outline: none;
  }

  .cars-section {
    flex: 1;
    min-width: 320px;
    max-width: 480px;
    overflow-y: auto;
  }

  .cars-section h2 {
    text-align: center;
    color: var(--primary-color);
    margin-top: 0;
    margin-bottom: 1rem;
  }

  .car-card {
    background: white;
    border-radius: 8px;
    margin-bottom: 1.5rem;
    box-shadow: 0 2px 6px rgba(0,0,0,0.15);
    overflow: hidden;
    display: flex;
    flex-direction: column;
  }

  .car-image {
    height: 180px;
    object-fit: cover;
    width: 100%;
    border-bottom: 1px solid #ddd;
  }

  .car-info {
    padding: 1rem;
    display: flex;
    flex-direction: column;
    gap: 0.25rem;
    font-size: 0.95rem;
    color: #444;
  }

  .car-info strong {
    color: #222;
  }

  @media (max-width: 1000px) {
    body {
      flex-direction: column;
      padding: 1rem;
    }
    .container {
      flex-direction: column;
      max-width: 600px;
      padding: 1.5rem;
    }
    .cars-section {
      max-width: 100%;
      margin-top: 2rem;
      overflow-y: visible;
    }
  }

</style>
</head>
<body>
  <div class="container">
    <section class="form-section">
      <h1>Car Rental Booking Form</h1>
      <form id="bookingForm" novalidate enctype="multipart/form-data">
        <div class="form-group">
          <label for="fullName">Full Name *</label>
          <input type="text" id="fullName" name="fullName" placeholder="Your full name" required />
          <div class="error" id="errorFullName">Please enter your full name.</div>
        </div>

        <div class="form-group">
          <label for="alamat">Alamat *</label>
          <input type="text" id="alamat" name="alamat" placeholder="Your full address" required />
          <div class="error" id="errorAlamat">Please enter your address.</div>
        </div>

        <div class="form-row">
          <div class="form-group">
            <label for="phone">Phone Number *</label>
            <input type="tel" id="phone" name="phone" placeholder="+1234567890" pattern="\\+?\\d{7,15}" required />
            <div class="error" id="errorPhone">Please enter a valid phone number.</div>
          </div>
          <div class="form-group">
            <label for="email">Email Address *</label>
            <input type="email" id="email" name="email" placeholder="you@example.com" required />
            <div class="error" id="errorEmail">Please enter a valid email address.</div>
          </div>
        </div>

        <div class="form-group">
          <label for="kotaTujuan">Kota Tujuan *</label>
          <input type="text" id="kotaTujuan" name="kotaTujuan" placeholder="Destination city" required />
          <div class="error" id="errorKotaTujuan">Please enter your destination city.</div>
        </div>

        <div class="form-row">
          <div class="form-group">
            <label for="pickupDate">Pick-up Date *</label>
            <input type="date" id="pickupDate" name="pickupDate" required />
            <div class="error" id="errorPickupDate">Please select a pick-up date.</div>
          </div>
          <div class="form-group">
            <label for="dropoffDate">Drop-off Date *</label>
            <input type="date" id="dropoffDate" name="dropoffDate" required />
            <div class="error" id="errorDropoffDate">Please select a drop-off date (after pick-up date).</div>
          </div>
          <div class="form-group">
            <label for="durasi">Durasi (optional)</label>
            <select id="durasi" name="durasi">
              <option value="" selected>-- Select duration --</option>
              <option value="1_hari">1 Hari</option>
              <option value="2_hari">2 Hari</option>
              <option value="3_hari">3 Hari</option>
              <option value="4_hari">4 Hari</option>
              <option value="5_hari">5 Hari</option>
              <option value="6_hari">6 Hari</option>
              <option value="7_hari">7 Hari</option>
              <option value="lebih">Lebih dari 7 Hari</option>
            </select>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group">
            <label for="kkPhoto">Upload Foto KK *</label>
            <input type="file" id="kkPhoto" name="kkPhoto" accept="image/*" required />
            <div class="error" id="errorKKPhoto">Please upload a foto KK.</div>
          </div>
          <div class="form-group">
            <label for="ktpPhoto">Upload Foto KTP *</label>
            <input type="file" id="ktpPhoto" name="ktpPhoto" accept="image/*" required />
            <div class="error" id="errorKTPPhoto">Please upload a foto KTP.</div>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group">
            <label for="namaUnit">Nama Unit *</label>
            <input type="text" id="namaUnit" name="namaUnit" placeholder="Nama unit" required />
            <div class="error" id="errorNamaUnit">Please enter the unit name.</div>
          </div>
          <div class="form-group">
            <label for="warna">Warna *</label>
            <input type="text" id="warna" name="warna" placeholder="Warna" required />
            <div class="error" id="errorWarna">Please enter the color.</div>
          </div>
        </div>

        <fieldset class="radio-group">
          <legend>Jaminan *</legend>
          <label><input type="radio" name="jaminan" value="uang" required /> Uang</label>
          <label><input type="radio" name="jaminan" value="motor" /> Motor</label>
          <div class="error" id="errorJaminan">Please select a jaminan option.</div>
        </fieldset>

        <fieldset class="radio-group">
          <legend>Cara Pembayaran *</legend>
          <label><input type="radio" name="caraPembayaran" value="transfer" required /> Transfer</label>
          <label><input type="radio" name="caraPembayaran" value="cash" /> Cash</label>
          <div class="error" id="errorCaraPembayaran">Please select a payment method.</div>
        </fieldset>

        <fieldset class="radio-group">
          <legend>Fasilitas *</legend>
          <label><input type="radio" name="fasilitas" value="supir" required /> Supir</label>
          <label><input type="radio" name="fasilitas" value="lepas_kunci" /> Lepas Kunci</label>
          <div class="error" id="errorFasilitas">Please select a fasilitas option.</div>
        </fieldset>

        <button type="submit">Book Now</button>
      </form>
    </section>

    <section class="cars-section">
      <h2>Available Cars</h2>
      <div id="carsList">
        <!-- Car cards will be injected here by JS -->
      </div>
    </section>
  </div>

<script>
  const form = document.getElementById('bookingForm');

  form.addEventListener('submit', function(event) {
    event.preventDefault();
    clearErrors();

    let valid = true;

    // Validate Full Name
    const fullName = form.fullName.value.trim();
    if (!fullName) {
      showError('errorFullName');
      valid = false;
    }

    // Validate Alamat
    const alamat = form.alamat.value.trim();
    if (!alamat) {
      showError('errorAlamat');
      valid = false;
    }

    // Validate Phone
    const phone = form.phone.value.trim();
    if (!phone || !validatePhone(phone)) {
      showError('errorPhone');
      valid = false;
    }

    // Validate Email
    const email = form.email.value.trim();
    if (!email || !validateEmail(email)) {
      showError('errorEmail');
      valid = false;
    }

    // Validate Kota Tujuan
    const kotaTujuan = form.kotaTujuan.value.trim();
    if (!kotaTujuan) {
      showError('errorKotaTujuan');
      valid = false;
    }

    // Validate Pickup Date
    const pickupDateValue = form.pickupDate.value;
    const todayStr = new Date().toISOString().split('T')[0];
    if (!pickupDateValue || pickupDateValue < todayStr) {
      showError('errorPickupDate');
      valid = false;
    }

    // Validate Dropoff Date
    const dropoffDateValue = form.dropoffDate.value;
    if (!dropoffDateValue || dropoffDateValue <= pickupDateValue) {
      showError('errorDropoffDate');
      valid = false;
    }

    // Durasi is optional - no validation needed

    // Validate KK Photo
    const kkFiles = form.kkPhoto.files;
    if (!kkFiles || kkFiles.length === 0) {
      showError('errorKKPhoto');
      valid = false;
    }

    // Validate KTP Photo
    const ktpFiles = form.ktpPhoto.files;
    if (!ktpFiles || ktpFiles.length === 0) {
      showError('errorKTPPhoto');
      valid = false;
    }

    // Validate Nama Unit
    const namaUnit = form.namaUnit.value.trim();
    if (!namaUnit) {
      showError('errorNamaUnit');
      valid = false;
    }

    // Validate Warna
    const warna = form.warna.value.trim();
    if (!warna) {
      showError('errorWarna');
      valid = false;
    }

    // Validate Jaminan
    const jaminan = form.jaminan.value;
    if (!jaminan) {
      showError('errorJaminan');
      valid = false;
    }

    // Validate Cara Pembayaran
    const caraPembayaran = form.caraPembayaran.value;
    if (!caraPembayaran) {
      showError('errorCaraPembayaran');
      valid = false;
    }

    // Validate Fasilitas
    const fasilitas = form.fasilitas.value;
    if (!fasilitas) {
      showError('errorFasilitas');
      valid = false;
    }

    if (valid) {
      alert('Thank you for your booking, ' + fullName + '! Your car rental request has been received.');
      form.reset();
    }
  });

  function showError(id) {
    const elem = document.getElementById(id);
    if (elem) {
      elem.style.display = 'block';
    }
  }

  function clearErrors() {
    document.querySelectorAll('.error').forEach(e => e.style.display = 'none');
  }

  function validateEmail(email) {
    // Basic email regex pattern
    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(email);
  }

  function validatePhone(phone) {
    // Only digits with optional leading +, min 7, max 15 digits
    const re = /^\+?\d{7,15}$/;
    return re.test(phone);
  }

  // Sample car data simulating database entries
<div id="selectedCar"></div>

<script>
  function tampilkanMobilDipilih() {
    const car = JSON.parse(localStorage.getItem('mobilDipilih'));
    const container = document.getElementById('selectedCar');

    if (!car) {
      container.innerHTML = '<p>Tidak ada mobil yang dipilih.</p>';
      return;
    }

    container.innerHTML = `
      <div class="car-card">
        <img src="${car.foto}" alt="${car.namaUnit}" class="car-image" />
        <div class="car-info">
          <strong>${car.namaUnit}</strong>
          <div><strong>Plat Nomor:</strong> ${car.platNomor}</div>
          <div><strong>Warna:</strong> ${car.warna}</div>
          <div><strong>Tahun Beli:</strong> ${car.tahunBeli}</div>
          <div><strong>Harga Sewa:</strong> ${car.hargaSewa}</div>
          <div><strong>Jumlah Kursi:</strong> ${car.jumlahKursi}</div>
        </div>
      </div>
    `;
  }

  tampilkanMobilDipilih();
</script>

</script>
</body>
</html>