<?php
// Koneksi database
$host = 'localhost';
$user = 'root';
$pass = ''; // sesuaikan jika pakai password
$db = 'proyek-1';

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
  die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data mobil tersedia dari join dua tabel
$sql = "
  SELECT 
    u.plat_nomor AS plat,
    j.nama AS name,
    j.harga_sewa AS price12h,
    j.jumlah_kursi AS seats,
    u.transmisi,
    u.warna,
    u.foto
  FROM unit_mobil u
  JOIN jenis_mobil j ON u.jenis_mobil_id = j.id
  WHERE u.status = 'tersedia'
";
$result = $conn->query($sql);

$cars = [];
if ($result && $result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $cars[] = $row;
  }
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Rental Mobil - Daftar Mobil</title>
  <style>
    /* Style sama seperti punyamu sebelumnya */
    /* ... (style dari kode kamu di atas tetap dipakai tanpa perubahan besar) ... */
    :root {
      --color-primary-dark: #000957;
      --font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    * { box-sizing: border-box; }
    body {
      margin: 0;
      font-family: var(--font-family);
      background: url('../../assets/image/listing.jpg') no-repeat center center fixed;
      background-size: cover;
      color: var(--color-primary-dark);
    }

    header {
      background: var(--color-primary-dark);
      padding: 1.25rem 2rem;
      color: white;
      display: flex;
      align-items: center;
      justify-content: space-between;
    }
    header h1 { margin: 0; font-weight: 700; font-size: 1.8rem; }
    main { padding: 2rem; max-width: 1200px; margin: 0 auto; }
    .search-form {
      background: rgba(255, 255, 255, 0.6); /* Transparansi 92% */
      padding: 1rem 1.5rem;
      border-radius: 8px;
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
      gap: 1.2rem;
      margin-bottom: 2rem;
    }
    .search-form input,
    .search-form select {
      background: rgba(255, 255, 255, 0.6);
      width: 100%;
      padding: 0.5rem;
      border: 2px solid var(--color-primary-dark);
      border-radius: 6px;
      font-size: 1rem;
    }
    .car-list {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
      gap: 1.5rem;
    }
    .car-card {
      background: rgba(255, 255, 255, 0.6); /* Transparansi 92% */
      border-radius: 10px;
      box-shadow: 0 3px 8px rgba(0,0,0,0.12);
      padding: 1.4rem;
      display: flex;
      flex-direction: column;
    }
    .car-photo {
      width: 100%;
      height: 160px;
      border-radius: 8px;
      object-fit: cover;
      margin-bottom: 12px;
    }
    .car-name { font-size: 1.3rem; font-weight: 700; }
    .car-info { font-size: 0.9rem; margin: 5px 0; display: flex; flex-wrap: wrap; gap: 0.5rem; }
    .car-info span {
      background: var(--color-primary-dark);
      color: white;
      padding: 3px 8px;
      border-radius: 5px;
      font-size: 0.82rem;
    }
    .car-price { font-weight: bold; margin-top: 0.6rem; color: var(--color-primary-dark); }
    .rent-button {
      margin-top: auto;
      background: var(--color-primary-dark);
      color: white;
      border: none;
      padding: 0.6rem;
      border-radius: 8px;
      font-weight: bold;
      cursor: pointer;
    }
    .no-results { text-align: center; font-size: 1.2rem; color: #888; margin-top: 2rem; }
  </style>
</head>
<body>
<header><h1>Rental Mobil</h1></header>
<main>
  <form class="search-form" id="searchForm">
    <div>
      <label for="pickupDate">Tanggal Pengambilan</label>
      <input type="date" id="pickupDate" name="pickupDate" />
    </div>
    <div>
      <label for="returnDate">Tanggal Pengembalian</label>
      <input type="date" id="returnDate" name="returnDate" />
    </div>
    <div>
      <label for="unitName">Nama Unit</label>
      <input type="text" id="unitName" placeholder="Cari nama unit..." />
    </div>
    <div>
      <label for="transmission">Transmisi</label>
      <select id="transmission">
        <option value="">Semua</option>
        <option value="Manual">Manual</option>
        <option value="Matic">Matic</option>
      </select>
    </div>
  </form>

  <section class="car-list" id="carList">
    <?php foreach ($cars as $car): ?>
      <article class="car-card" data-name="<?= strtolower($car['name']) ?>" data-trans="<?= $car['transmisi'] ?>">
        <img src="<?= htmlspecialchars($car['foto']) ?>" alt="<?= htmlspecialchars($car['name']) ?>" class="car-photo" />
        <h2 class="car-name"><?= htmlspecialchars($car['name']) ?> (<?= htmlspecialchars($car['plat']) ?>)</h2>
        <div class="car-info">
          <span><?= $car['transmisi'] ?></span>
          <span><?= $car['seats'] ?> Kursi</span>
          <span><?= $car['warna'] ?></span>
        </div>
        <div class="car-price">Rp <?= number_format($car['price12h'], 0, ',', '.') ?> / 12 jam</div>
        <br>
        <button class="rent-button">Rental Sekarang</button>
      </article>
    <?php endforeach; ?>
  </section>

  <p class="no-results" id="noResults" style="display:none;">Tidak ada mobil yang sesuai kriteria pencarian.</p>
</main>

<script>
  const pickupDate = document.getElementById("pickupDate");
  const returnDate = document.getElementById("returnDate");
  const nameInput = document.getElementById("unitName");
  const transmissionSelect = document.getElementById("transmission");
  const carCards = document.querySelectorAll(".car-card");
  const noResults = document.getElementById("noResults");

  function setMinDates() {
    const today = new Date().toISOString().split("T")[0];
    pickupDate.min = today;
    returnDate.min = today;
  }

  function updateReturnMinDate() {
    if (pickupDate.value) {
      returnDate.min = pickupDate.value;
      if (returnDate.value < pickupDate.value) {
        returnDate.value = pickupDate.value;
      }
    }
  }

  function filterCars() {
    const name = nameInput.value.trim().toLowerCase();
    const trans = transmissionSelect.value;
    let visible = 0;

    carCards.forEach(card => {
      const cardName = card.dataset.name;
      const cardTrans = card.dataset.trans;

      const matchName = name === "" || cardName.includes(name);
      const matchTrans = trans === "" || cardTrans === trans;

      if (matchName && matchTrans) {
        card.style.display = "flex";
        visible++;
      } else {
        card.style.display = "none";
      }
    });

    noResults.style.display = visible === 0 ? "block" : "none";
  }

  // Event setup
  setMinDates();
  pickupDate.addEventListener("change", () => {
    updateReturnMinDate();
    filterCars();
  });
  returnDate.addEventListener("change", filterCars);
  nameInput.addEventListener("input", filterCars);
  transmissionSelect.addEventListener("change", filterCars);

  // Tombol Rental Sekarang
// Tombol Rental Sekarang
document.querySelectorAll(".rent-button").forEach((btn, i) => {
  btn.addEventListener("click", () => {
    const name = carCards[i].querySelector(".car-name").textContent;
    const pick = pickupDate.value || "";
    const ret = returnDate.value || "";

    const url = new URL("http://localhost/proyek-1/pages/customer/booking.php");
    url.searchParams.set("mobil", name);
    url.searchParams.set("ambil", pick);
    url.searchParams.set("kembali", ret);
    window.location.href = url.toString();

  });
});

</script>
</body>
</html>