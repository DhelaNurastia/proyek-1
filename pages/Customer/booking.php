<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Formulir Booking</title>
<style>
  :root {
    --primary-color: #007bff;
    --secondary-color: #6c757d;
    --background-color: #f8f9fa;
    --input-bg: #fff;
    --input-border: #ced4da;
    --font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  }

  body {
    background: var(--background-color);
    font-family: var(--font-family);
    margin: 0;
    padding: 1.5rem;
    display: flex;
    justify-content: center;
    align-items: flex-start;
    min-height: 100vh;
  }

  .container {
    background: #fff;
    max-width: 480px;
    width: 100%;
    border-radius: 8px;
    box-shadow: 0 8px 16px rgb(0 0 0 / 0.1);
    padding: 2rem;
    box-sizing: border-box;
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

  label {
    font-weight: 600;
    margin-bottom: 0.25rem;
    color: var(--secondary-color);
  }

  input[type="text"],
  input[type="email"],
  input[type="tel"],
  input[type="date"],
  select,
  textarea,
  input[type="file"] {
    padding: 0.5rem;
    margin-bottom: 1rem;
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
    color: var(--secondary-color);
    cursor: pointer;
  }
  .radio-group input[type="radio"] {
    margin-right: 0.3rem;
  }

  button {
    background: var(--primary-color);
    color: white;
    padding: 0.75rem;
    border: none;
    border-radius: 4px;
    font-weight: 700;
    font-size: 1.1rem;
    cursor: pointer;
    transition: background-color 0.3s ease;
  }

  button:hover,
  button:focus {
    background: #0056b3;
    outline: none;
  }

  .error {
    color: #dc3545;
    font-size: 0.875rem;
    margin-top: -0.75rem;
    margin-bottom: 0.75rem;
    display: none;
  }

  @media (max-width: 520px) {
    body {
      padding: 1rem;
    }
    .container {
      padding: 1.25rem;
    }
  }

</style>
</head>
<body>
  <div class="container">
    <h1>Car Rental Booking Form</h1>
    <form id="bookingForm" novalidate enctype="multipart/form-data">
      <label for="fullName">Full Name *</label>
      <input type="text" id="fullName" name="fullName" placeholder="Your full name" required />
      <div class="error" id="errorFullName">Please enter your full name.</div>

      <label for="alamat">Alamat *</label>
      <input type="text" id="alamat" name="alamat" placeholder="Your full address" required />
      <div class="error" id="errorAlamat">Please enter your address.</div>

      <label for="email">Email Address *</label>
      <input type="email" id="email" name="email" placeholder="you@example.com" required />
      <div class="error" id="errorEmail">Please enter a valid email address.</div>

      <label for="phone">Phone Number *</label>
      <input type="tel" id="phone" name="phone" placeholder="+1234567890" pattern="\\+?\\d{7,15}" required />
      <div class="error" id="errorPhone">Please enter a valid phone number.</div>

      <label for="pickupDate">Pick-up Date *</label>
      <input type="date" id="pickupDate" name="pickupDate" required />
      <div class="error" id="errorPickupDate">Please select a pick-up date.</div>

      <label for="dropoffDate">Drop-off Date *</label>
      <input type="date" id="dropoffDate" name="dropoffDate" required />
      <div class="error" id="errorDropoffDate">Please select a drop-off date (after pick-up date).</div>

      <label for="kkPhoto">Upload Foto KK *</label>
      <input type="file" id="kkPhoto" name="kkPhoto" accept="image/*" required />
      <div class="error" id="errorKKPhoto">Please upload a foto KK.</div>

      <label for="ktpPhoto">Upload Foto KTP *</label>
      <input type="file" id="ktpPhoto" name="ktpPhoto" accept="image/*" required />
      <div class="error" id="errorKTPPhoto">Please upload a foto KTP.</div>

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

    // Validate Email
    const email = form.email.value.trim();
    if (!email || !validateEmail(email)) {
      showError('errorEmail');
      valid = false;
    }

    // Validate Phone
    const phone = form.phone.value.trim();
    if (!phone || !validatePhone(phone)) {
      showError('errorPhone');
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
</script>
</body>
</html>