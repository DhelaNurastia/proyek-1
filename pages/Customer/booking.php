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
      background-color: #ffffff;
      color: #6b7280;
      line-height: 1.6;
      font-size: 17px;
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: flex-start;
      padding: 4rem 1rem 5rem;
    }

    /* Container */
    .container {
      max-width: 1200px;
      width: 100%;
      background: #fff;
      border-radius: 0.75rem;
      box-shadow: 0 10px 25px rgb(0 0 0 / 0.08);
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
      background-color: #f9fafb;
      border-radius: 0.75rem;
      box-shadow: 0 6px 16px rgb(0 0 0 / 0.1);
      padding: 1.5rem 2rem;
      color: #374151;
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
      color: #111827; /* almost black */
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

    /* Form Styles */
    form {
      display: grid;
      grid-template-columns: 1fr;
      gap: 1.5rem 2rem;
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
      cursor: pointer;
      transition: background-color 0.3s ease;
      user-select: none;
      margin-top: 1.5rem;
      justify-self: start;
      width: 150px;
    }

    button[type="submit"]:hover,
    button[type="submit"]:focus {
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
  </style>
</head>

<body>
  <main>
    <section class="container" aria-labelledby="formTitle">
      <div class="form-container">
        <h1 id="formTitle">Form Rental Mobil</h1>
        <p class="description">Silakan isi formulir di bawah untuk menyewa mobil pilihan Anda dengan mudah dan cepat.</p>

        <!-- Top info: Rental Duration removed as requested -->

        <form id="rental-car-form" novalidate>
          <div class="grouped-inputs">
            <div class="form-group">
              <label for="full-name">Nama Lengkap</label>
              <input type="text" id="full-name" name="full-name" placeholder="Nama lengkap Anda" required autocomplete="name" />
            </div>

            <div class="form-group">
              <label for="address">Alamat</label>
              <input type="text" id="address" name="address" placeholder="Alamat lengkap Anda" required />
            </div>
          </div>

          <div class="grouped-inputs">
            <div class="form-group">
              <label for="phone-number">Nomor Telepon</label>
              <input type="tel" id="phone-number" name="phone-number" placeholder="+62 812 3456 7890" required autocomplete="tel" />
            </div>

            <div class="form-group">
              <label for="email">Email</label>
              <input type="email" id="email" name="email" placeholder="email@example.com" required autocomplete="email" />
            </div>
          </div>

          <div class="form-group">
            <label for="pickup-date">Tanggal Pengambilan</label>
            <input type="date" id="pickup-date" name="pickup-date" required />
          </div>

          <div class="form-group">
            <label for="return-date">Tanggal Pengembalian</label>
            <input type="date" id="return-date" name="return-date" required />
          </div>

          <div class="form-group full-width">
            <label>Fasilitas</label>
            <div style="display: flex; gap: 1.5rem; flex-wrap: wrap;">
              <label><input type="checkbox" name="facilities" value="Supir" /> Supir</label>
              <label><input type="checkbox" name="facilities" value="Lepas Kunci" /> Lepas Kunci</label>
            </div>
          </div>

          <div class="form-group full-width">
            <label>Jaminan</label>
            <div style="display: flex; gap: 1.5rem; flex-wrap: wrap;">
              <label><input type="checkbox" name="guarantee" value="Uang" /> Uang</label>
              <label><input type="checkbox" name="guarantee" value="Motor" /> Motor</label>
            </div>
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
            <input type="text" id="rental-cost" name="rental-cost" readonly />
          </div>

          <button type="submit">Sewa Sekarang</button>
        </form>
      </div>

      <aside class="car-details-container" aria-label="Detail mobil yang dipilih">
        <img src="" alt="Foto mobil" id="car-photo" class="car-image" />
        <div class="car-detail-item"><span class="car-detail-label">Nama Unit:</span> <span id="detail-name">-</span></div>
        <div class="car-detail-item"><span class="car-detail-label">Harga/12 jam:</span> <span id="detail-price">-</span></div>
        <div class="car-detail-item"><span class="car-detail-label">Transmisi:</span> <span id="detail-transmission">-</span></div>
        <div class="car-detail-item"><span class="car-detail-label">Jumlah Kursi:</span> <span id="detail-seats">-</span></div>
        <div class="car-detail-item"><span class="car-detail-label">Plat Nomor:</span> <span id="detail-plate">-</span></div>
        <div class="car-detail-item"><span class="car-detail-label">Warna:</span> <span id="detail-color">-</span></div>
      </aside>
    </section>
  </main>

  <script>
    // Car data with photos and details (example, replace with your backend dynamic data)
    const carData = [
      {
        name: 'Avanza',
        pricePer12h: 150000,
        transmission: 'Manual',
        seats: 7,
        plate: 'B 1234 ABC',
        color: 'Putih',
        photo: 'https://cdn.pixabay.com/photo/2014/04/03/10/42/car-311293_1280.png',
      },
      {
        name: 'Jazz',
        pricePer12h: 200000,
        transmission: 'Automatic',
        seats: 5,
        plate: 'D 5678 XYZ',
        color: 'Hitam',
        photo: 'https://cdn.pixabay.com/photo/2013/07/13/12/46/car-160849_1280.png',
      },
      {
        name: 'Xpander',
        pricePer12h: 180000,
        transmission: 'Manual',
        seats: 7,
        plate: 'F 4321 QWE',
        color: 'Silver',
        photo: 'https://cdn.pixabay.com/photo/2014/04/02/11/25/car-304664_1280.png',
      },
      {
        name: 'Mobilio',
        pricePer12h: 190000,
        transmission: 'Automatic',
        seats: 7,
        plate: 'L 8765 RTY',
        color: 'Merah',
        photo: 'https://cdn.pixabay.com/photo/2019/06/18/16/05/red-4287363_1280.png',
      },
      {
        name: 'Ertiga',
        pricePer12h: 160000,
        transmission: 'Manual',
        seats: 7,
        plate: 'B 9876 ZXC',
        color: 'Biru',
        photo: 'https://cdn.pixabay.com/photo/2017/01/06/19/15/car-1958926_1280.png',
      },
    ];

    // Utility: format number as IDR currency
    function formatCurrency(value) {
      return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(value);
    }

    // Calculate difference in days (inclusive)
    function daysBetween(date1, date2) {
      const oneDay = 24 * 60 * 60 * 1000;
      const diffTime = date2.getTime() - date1.getTime();
      return Math.max(0, Math.floor(diffTime / oneDay) + 1);
    }

    const pickupDateInput = document.getElementById('pickup-date');
    const returnDateInput = document.getElementById('return-date');

    const carPhoto = document.getElementById('car-photo');
    const detailName = document.getElementById('detail-name');
    const detailPrice = document.getElementById('detail-price');
    const detailTransmission = document.getElementById('detail-transmission');
    const detailSeats = document.getElementById('detail-seats');
    const detailPlate = document.getElementById('detail-plate');
    const detailColor = document.getElementById('detail-color');

    const rentalCostInput = document.getElementById('rental-cost');

    // Example: You may set the selected car here dynamically from backend or user input
    // For demonstration, default to first car
    let selectedCar = carData[0];
    function showCarDetails(car) {
      selectedCar = car;
      carPhoto.src = car.photo;
      carPhoto.alt = `Foto mobil ${car.name}`;

      detailName.textContent = car.name;
      detailPrice.textContent = formatCurrency(car.pricePer12h);
      detailTransmission.textContent = car.transmission;
      detailSeats.textContent = car.seats + ' Kursi';
      detailPlate.textContent = car.plate;
      detailColor.textContent = car.color;

      updateRentalCost();
    }

    // Set min date for pickup and return to today
    const today = new Date().toISOString().split('T')[0];
    pickupDateInput.setAttribute('min', today);
    returnDateInput.setAttribute('min', today);

    // Ensure return date can't be before pickup date
    pickupDateInput.addEventListener('change', () => {
      if (pickupDateInput.value) {
        returnDateInput.min = pickupDateInput.value;
        if (returnDateInput.value && returnDateInput.value < pickupDateInput.value) {
          returnDateInput.value = pickupDateInput.value;
        }
      } else {
        returnDateInput.min = today;
      }
      updateRentalCost();
    });

    returnDateInput.addEventListener('change', updateRentalCost);

    function updateRentalCost() {
      if (!selectedCar || !pickupDateInput.value || !returnDateInput.value) {
        rentalCostInput.value = 'Rp0';
        return;
      }
      const start = new Date(pickupDateInput.value);
      const end = new Date(returnDateInput.value);
      if (end < start) {
        rentalCostInput.value = 'Rp0';
        return;
      }
      const days = daysBetween(start, end);
      const rentalSegments = days * 2; // per 12 hours
      const totalCost = selectedCar.pricePer12h * rentalSegments;
      rentalCostInput.value = formatCurrency(totalCost);
    }

    // Initial render of car details
    showCarDetails(selectedCar);

    // Form submission can be handled by you in backend
  </script>
</body>

</html>