<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Checker Inspeksi Mobil - Detail Kerusakan & Dokumentasi</title>
  <style>
    /* Reset and base */
    * {
      box-sizing: border-box;
    }
    body {
      font-family: 'Poppins', sans-serif;
      margin: 0;
      background: #f5f7fa;
      color: #333;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      align-items: center;
      padding: 24px 16px;
    }
    h1, h2 {
      text-align: center;
      color: #1e293b;
      font-weight: 700;
      margin-bottom: 24px;
    }

    /* Container */
    .container {
      width: 100%;
      max-width: 960px;
      background: white;
      border-radius: 12px;
      box-shadow: 0 8px 24px rgb(0 0 0 / 0.1);
      padding: 32px 24px;
      display: flex;
      flex-direction: column;
      gap: 32px;
      margin-bottom: 48px;
    }

    /* Form groups */
    label {
      font-weight: 600;
      display: block;
      margin-bottom: 6px;
      font-size: 14px;
      color: #475569;
    }

    select, input[type=text], input[type=number], textarea {
      width: 100%;
      padding: 12px 14px;
      border-radius: 8px;
      border: 1.5px solid #cbd5e1;
      font-size: 16px;
      transition: border-color 0.3s ease;
      resize: vertical;
      font-family: inherit;
    }
    select:focus, input[type=text]:focus, input[type=number]:focus, textarea:focus {
      outline: none;
      border-color: #4f46e5;
      box-shadow: 0 0 8px rgba(79, 70, 229, 0.25);
    }

    /* Radio group */
    .radio-group {
      display: flex;
      gap: 24px;
      margin-top: 8px;
    }
    .radio-group label {
      font-weight: 500;
      font-size: 16px;
      color: #334155;
      cursor: pointer;
      display: flex;
      align-items: center;
      gap: 8px;
    }
    input[type=radio] {
      accent-color: #4f46e5;
      width: 18px;
      height: 18px;
      cursor: pointer;
    }

    /* File upload */
    .file-upload {
      border: 2px dashed #a3bffa;
      border-radius: 12px;
      padding: 24px;
      text-align: center;
      color: #64748b;
      font-weight: 600;
      cursor: pointer;
      position: relative;
      transition: background-color 0.3s ease;
    }
    .file-upload:hover {
      background-color: #e0e7ff;
    }
    .file-upload input[type="file"] {
      position: absolute;
      opacity: 0;
      width: 100%;
      height: 100%;
      top: 0; left: 0;
      cursor: pointer;
    }
    .uploaded-preview {
      margin-top: 8px;
      display: flex;
      flex-wrap: wrap;
      gap: 12px;
      justify-content: center;
    }
    .img-preview {
      width: 120px;
      height: 90px;
      object-fit: cover;
      border-radius: 8px;
      border: 1px solid #cbd5e1;
      box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    }

    /* Buttons */
    button.submit-btn {
      background-color: #4f46e5;
      color: white;
      padding: 14px 24px;
      border: none;
      border-radius: 12px;
      font-size: 16px;
      font-weight: 700;
      cursor: pointer;
      transition: background-color 0.3s;
      align-self: flex-start;
      margin-right: 12px;
    }
    button.submit-btn:hover {
      background-color: #4338ca;
    }
    button.delete-btn {
      background-color: #dc2626;
      border: none;
      border-radius: 8px;
      color: white;
      padding: 6px 12px;
      cursor: pointer;
      font-weight: 600;
      font-size: 14px;
      transition: background-color 0.3s ease;
    }
    button.delete-btn:hover {
      background-color: #b91c1c;
    }
    button.cancel-btn {
      background-color: #6b7280;
      border: none;
      border-radius: 12px;
      color: white;
      padding: 14px 24px;
      cursor: pointer;
      font-weight: 700;
      font-size: 16px;
      transition: background-color 0.3s ease;
      align-self: flex-start;
    }
    button.cancel-btn:hover {
      background-color: #4b5563;
    }

    /* Status message */
    .status-message {
      font-weight: 600;
      font-size: 15px;
      margin-top: 4px;
      color: #059669;
    }
    .status-error {
      color: #dc2626;
    }

    /* Checklist detail section */
    fieldset.checklist-section {
      border: 1.5px solid #cbd5e1;
      border-radius: 12px;
      padding: 20px 24px;
      margin-bottom: 24px;
      background: #f9fafb;
    }
    fieldset.checklist-section legend {
      font-weight: 700;
      font-size: 16px;
      margin-bottom: 16px;
      color: #334155;
    }
    .checklist-group {
      display: flex;
      flex-direction: column;
      gap: 8px;
    }
    .checklist-group label {
      font-weight: 500;
      font-size: 15px;
      cursor: pointer;
      display: flex;
      align-items: center;
      gap: 10px;
      color: #475569;
    }
    input[type=checkbox] {
      accent-color: #4f46e5;
      width: 18px;
      height: 18px;
      cursor: pointer;
    }

    /* Inspections list table */
    .inspection-list-section {
      width: 100%;
      max-width: 960px;
      margin-bottom: 80px;
      overflow-x: auto;
    }
    table.inspection-table {
      width: 100%;
      border-collapse: collapse;
      font-size: 14px;
      min-width: 720px;
    }
    table.inspection-table th,
    table.inspection-table td {
      padding: 12px 10px;
      text-align: left;
      border-bottom: 1px solid #dde3e8;
      vertical-align: top;
      max-width: 250px;
    }
    table.inspection-table thead {
      background: #4f46e5;
      color: white;
    }
    table.inspection-table tbody tr:hover {
      background: #f0f4ff;
    }
    .small-text {
      font-size: 12px;
      color: #64748b;
    }
    .photo-count {
      font-weight: 600;
      color: #475569;
    }
    .checklist-summary {
      max-width: 220px;
      word-wrap: break-word;
      white-space: normal;
    }
    .inspection-photos-container {
      display: flex;
      gap: 6px;
      flex-wrap: wrap;
      max-width: 250px;
    }
    .inspection-photo-thumb {
      width: 60px;
      height: 45px;
      object-fit: cover;
      border-radius: 6px;
      border: 1px solid #cbd5e1;
      box-shadow: 0 1px 3px rgba(0,0,0,0.1);
      cursor: pointer;
      transition: transform 0.2s ease;
    }
    .inspection-photo-thumb:hover {
      transform: scale(1.2);
      z-index: 10;
      position: relative;
    }

    /* Responsive */
    @media (max-width: 640px) {
      .container {
        padding: 24px 16px;
        gap: 24px;
        max-width: 100%;
      }
      .radio-group {
        flex-direction: column;
        gap: 12px;
      }
      .file-upload {
        padding: 18px;
        font-size: 14px;
      }
      .img-preview {
        width: 100px;
        height: 75px;
      }
      button.submit-btn, button.cancel-btn {
        width: 100%;
        padding: 14px 0;
        margin-right: 0;
        margin-bottom: 12px;
      }
      fieldset.checklist-section {
        padding: 16px 18px;
      }
      table.inspection-table {
        min-width: 600px;
        font-size: 12px;
      }
      table.inspection-table th, table.inspection-table td {
        padding: 8px 6px;
      }
      .checklist-summary {
        max-width: 140px;
      }
      .inspection-photos-container {
        max-width: 120px;
      }
      .inspection-photo-thumb {
        width: 40px;
        height: 30px;
      }
    }
  </style>
  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
</head>
<body>
  <h1>Checker Inspeksi Kondisi Mobil</h1>

  <section class="container" aria-label="Form inspeksi mobil">
    <form id="inspectionForm" novalidate>
      <!-- Pilih ID Booking -->
      <div>
        <label for="bookingId">Pilih ID Booking</label>
        <select id="bookingId" name="bookingId" required aria-required="true" aria-describedby="bookingHelp">
          <option value="">-- Pilih Booking --</option>
          <!-- Options akan diisi lewat JS -->
        </select>
        <small id="bookingHelp" style="color:#64748b;">
          Pilih booking yang ingin diperiksa kondisinya.
        </small>
      </div>

      <!-- Checklist kondisi mobil dengan detail kerusakan -->
      <fieldset class="checklist-section" aria-describedby="checklistDesc">
        <legend>Checklist Detail Kerusakan Mobil</legend>
        <small id="checklistDesc" style="color:#64748b; display: block; margin-bottom: 12px;">Centang kerusakan yang ditemukan pada detail bagian berikut:</small>

        <!-- Bodi -->
        <fieldset class="checklist-section" aria-label="Kerusakan Bodi">
          <legend>Bodi</legend>
          <div class="checklist-group">
            <label><input type="checkbox" name="checklist" value="Bodi - Penyok" /> Penyok</label>
            <label><input type="checkbox" name="checklist" value="Bodi - Lecet" /> Lecet / Goresan</label>
            <label><input type="checkbox" name="checklist" value="Bodi - Cat Terkelupas" /> Cat Terkelupas</label>
            <label><input type="checkbox" name="checklist" value="Bodi - Retak" /> Retak</label>
          </div>
        </fieldset>

        <!-- Ban -->
        <fieldset class="checklist-section" aria-label="Kerusakan Ban">
          <legend>Ban</legend>
          <div class="checklist-group">
            <label><input type="checkbox" name="checklist" value="Ban - Bocor" /> Bocor</label>
            <label><input type="checkbox" name="checklist" value="Ban - Gundul" /> Ban Gundul</label>
            <label><input type="checkbox" name="checklist" value="Ban - Velg Penyok" /> Velg Penyok</label>
            <label><input type="checkbox" name="checklist" value="Ban - Baut Lemah" /> Baut Lemah / Hilang</label>
          </div>
        </fieldset>

        <!-- Lampu -->
        <fieldset class="checklist-section" aria-label="Kerusakan Lampu">
          <legend>Lampu</legend>
          <div class="checklist-group">
            <label><input type="checkbox" name="checklist" value="Lampu - Mati" /> Mati</label>
            <label><input type="checkbox" name="checklist" value="Lampu - Retak / Pecah" /> Retak / Pecah</label>
            <label><input type="checkbox" name="checklist" value="Lampu - Kotor" /> Kotor / Buram</label>
          </div>
        </fieldset>

        <!-- Interior -->
        <fieldset class="checklist-section" aria-label="Kerusakan Interior">
          <legend>Interior</legend>
          <div class="checklist-group">
            <label><input type="checkbox" name="checklist" value="Interior - Jok Robek" /> Jok Robek / Sobek</label>
            <label><input type="checkbox" name="checklist" value="Interior - Dashboard Retak" /> Dashboard Retak</label>
            <label><input type="checkbox" name="checklist" value="Interior - Lampu Kabin Rusak" /> Lampu Kabin Rusak</label>
            <label><input type="checkbox" name="checklist" value="Interior - AC Tidak Dingin" /> AC Tidak Dingin</label>
          </div>
        </fieldset>

        <!-- Kaca -->
        <fieldset class="checklist-section" aria-label="Kerusakan Kaca">
          <legend>Kaca</legend>
          <div class="checklist-group">
            <label><input type="checkbox" name="checklist" value="Kaca - Retak" /> Retak</label>
            <label><input type="checkbox" name="checklist" value="Kaca - Pecah" /> Pecah</label>
            <label><input type="checkbox" name="checklist" value="Kaca - Kotor" /> Kotor</label>
          </div>
        </fieldset>

      </fieldset>

      <!-- Upload Foto Sebelum Sewa -->
      <div style="margin-top:24px;">
        <label for="fotoPre">Upload Foto Kondisi Mobil Sebelum Sewa</label>
        <div class="file-upload" aria-label="Upload foto sebelum sewa">
          Klik atau seret file foto di sini
          <input type="file" id="fotoPre" name="fotoPre" accept="image/*" multiple aria-describedby="fotoPreHelp" />
        </div>
        <small id="fotoPreHelp" style="color:#64748b;">1 foto. Format JPG/PNG.</small>
        <div id="previewPre" class="uploaded-preview" aria-live="polite"></div>
      </div>

      <!-- Upload Foto Setelah Sewa -->
      <div style="margin-top:24px;">
        <label for="fotoPost">Upload Foto Kondisi Mobil Setelah Sewa</label>
        <div class="file-upload" aria-label="Upload foto setelah sewa">
          Klik atau seret file foto di sini
          <input type="file" id="fotoPost" name="fotoPost" accept="image/*" multiple aria-describedby="fotoPostHelp" />
        </div>
        <small id="fotoPostHelp" style="color:#64748b;">1 foto.Format JPG/PNG.</small>
        <div id="previewPost" class="uploaded-preview" aria-live="polite"></div>
      </div>

      <!-- Hasil Inspeksi -->
      <fieldset style="margin-top:24px; border:none;">
        <legend style="font-weight: 600; color:#475569; margin-bottom: 12px;">Hasil Inspeksi</legend>
        <div class="radio-group" role="radiogroup" aria-labelledby="hasilInspeksiLabel">
          <label for="normal">
            <input type="radio" id="normal" name="hasilInspeksi" value="Normal" required />
            Normal
          </label>
          <label for="rusak">
            <input type="radio" id="rusak" name="hasilInspeksi" value="Rusak" />
            Rusak
          </label>
        </div>
      </fieldset>

      <div style="margin-top:24px;">
        <label for="denda">Denda (Rp)</label>
        <input type="number" id="denda" name="denda" min="0" step="1000" placeholder="Masukan jumlah denda jika ada" />
      </div>

      <div style="margin-top: 32px; display: flex; align-items: center;">
        <button type="submit" class="submit-btn" aria-live="polite" id="submitBtn">
          Simpan Hasil Inspeksi
        </button>
        <button type="button" class="cancel-btn" id="cancelEditBtn" style="display:none;">
          Batal Edit
        </button>
      </div>

      <div id="formStatus" role="alert" style="margin-top:16px; font-weight:600;"></div>
    </form>
  </section>

  <section class="inspection-list-section" aria-label="Daftar Hasil Inspeksi">
    <h2>Daftar Hasil Inspeksi Tersimpan</h2>
    <table class="inspection-table" aria-describedby="inspectionDesc">
      <caption id="inspectionDesc" class="sr-only">
        Daftar hasil inspeksi mobil yang telah disimpan dengan rincian booking, hasil inspeksi, checklist, denda, dan foto.
      </caption>
      <thead>
        <tr>
          <th>ID Booking</th>
          <th>Checklist Kerusakan</th>
          <th>Hasil Inspeksi</th>
          <th>Denda (Rp)</th>
          <th>Foto Pre / Post</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody id="inspectionRecords">
        <!-- Rows akan diisi JS -->
      </tbody>
    </table>
  </section>

  <script>
    const bookings = [
      { id_booking: "BKG001", customer: "Naura jawa", mobil: "Toyota Avanza", status_mobil: "Tersedia" },
      { id_booking: "BKG002", customer: "Andi duda", mobil: "Honda Jazz", status_mobil: "Disewa" },
      { id_booking: "BKG003", customer: "Dedi Saputra", mobil: "Mitsubishi Xpander", status_mobil: "Disewa" },
    ];

    const bookingSelect = document.getElementById('bookingId');
    const inspectionRecordsTbody = document.getElementById('inspectionRecords');
    const form = document.getElementById('inspectionForm');
    const statusDiv = document.getElementById('formStatus');
    const previewPre = document.getElementById('previewPre');
    const previewPost = document.getElementById('previewPost');
    const fotoPreInput = document.getElementById('fotoPre');
    const fotoPostInput = document.getElementById('fotoPost');
    const submitBtn = document.getElementById('submitBtn');
    const cancelEditBtn = document.getElementById('cancelEditBtn');

    let editIndex = -1; // -1 means not editing

    // Load bookings to select dropdown
    function loadBookings() {
      bookings.forEach(b => {
        const option = document.createElement('option');
        option.value = b.id_booking;
        option.textContent = `${b.id_booking} - ${b.customer} (${b.mobil}) - Status: ${b.status_mobil}`;
        bookingSelect.appendChild(option);
      });
    }

    // Save to localStorage key
    const STORAGE_KEY = 'inspectionResults';

    // Save inspection to localStorage
    function saveInspection(data) {
      const currentData = JSON.parse(localStorage.getItem(STORAGE_KEY)) || [];
      if (editIndex === -1) {
        currentData.push(data);
      } else {
        currentData[editIndex] = data;
      }
      localStorage.setItem(STORAGE_KEY, JSON.stringify(currentData));
      editIndex = -1;
    }

    // Load inspections from localStorage
    function loadInspections() {
      return JSON.parse(localStorage.getItem(STORAGE_KEY)) || [];
    }

    // Reset form to default state
    function resetForm() {
      form.reset();
      previewPre.innerHTML = "";
      previewPost.innerHTML = "";
      statusDiv.textContent = "";
      statusDiv.className = "";
      submitBtn.textContent = "Simpan Hasil Inspeksi";
      cancelEditBtn.style.display = "none";
      editIndex = -1;
    }

    // Render inspections list in table
    function renderInspections() {
      const data = loadInspections();
      inspectionRecordsTbody.innerHTML = '';
      if (data.length === 0) {
        const tr = document.createElement('tr');
        const td = document.createElement('td');
        td.textContent = "Belum ada data inspeksi tersimpan.";
        td.colSpan = 6;
        td.style.textAlign = 'center';
        td.style.fontStyle = 'italic';
        tr.appendChild(td);
        inspectionRecordsTbody.appendChild(tr);
        return;
      }

      data.forEach((record, index) => {
        const tr = document.createElement('tr');

        // ID Booking
        const tdBooking = document.createElement('td');
        tdBooking.textContent = record.bookingId;
        tr.appendChild(tdBooking);

        // Checklist summary (limit length)
        const tdChecklist = document.createElement('td');
        if (record.checklist.length === 0) {
          tdChecklist.textContent = '-';
        } else {
          const maxChars = 50;
          let text = record.checklist.join(', ');
          if (text.length > maxChars) {
            text = text.substring(0, maxChars) + '...';
          }
          tdChecklist.textContent = text;
          tdChecklist.title = record.checklist.join(', ');
          tdChecklist.classList.add('checklist-summary');
        }
        tr.appendChild(tdChecklist);

        // Hasil Inspeksi
        const tdHasil = document.createElement('td');
        tdHasil.textContent = record.hasilInspeksi;
        tr.appendChild(tdHasil);

        // Denda
        const tdDenda = document.createElement('td');
        tdDenda.textContent = record.denda.toLocaleString('id-ID', {minimumFractionDigits: 0});
        tr.appendChild(tdDenda);

        // Foto Pre/Post images preview thumbnails
        const tdFoto = document.createElement('td');
        const container = document.createElement('div');
        container.className = 'inspection-photos-container';

        // For demonstration, photos stored as base64 strings in record.fotoPre and fotoPost arrays
        if (record.fotoPre && record.fotoPre.length > 0) {
          record.fotoPre.forEach((b64, i) => {
            const img = document.createElement('img');
            img.className = 'inspection-photo-thumb';
            img.src = b64;
            img.alt = `Foto kondisi sebelum sewa ${i + 1} booking ${record.bookingId}`;
            container.appendChild(img);
          });
        }
        if (record.fotoPost && record.fotoPost.length > 0) {
          record.fotoPost.forEach((b64, i) => {
            const img = document.createElement('img');
            img.className = 'inspection-photo-thumb';
            img.src = b64;
            img.alt = `Foto kondisi setelah sewa ${i + 1} booking ${record.bookingId}`;
            container.appendChild(img);
          });
        }

        tdFoto.appendChild(container);
        tr.appendChild(tdFoto);

        // Actions - Edit & Delete buttons
        const tdAction = document.createElement('td');
        tdAction.style.display = 'flex';
        tdAction.style.gap = '8px';

        const btnEdit = document.createElement('button');
        btnEdit.type = 'button';
        btnEdit.className = 'submit-btn';
        btnEdit.textContent = 'Edit';
        btnEdit.setAttribute('aria-label', `Edit hasil inspeksi untuk booking ${record.bookingId}`);
        btnEdit.style.backgroundColor = '#2563eb';
        btnEdit.style.padding = '6px 12px';
        btnEdit.style.fontSize = '14px';
        btnEdit.style.fontWeight = '600';
        btnEdit.style.borderRadius = '8px';
        btnEdit.style.cursor = 'pointer';
        btnEdit.addEventListener('click', () => {
          startEdit(index);
        });

        const btnDelete = document.createElement('button');
        btnDelete.type = 'button';
        btnDelete.className = 'delete-btn';
        btnDelete.textContent = 'Hapus';
        btnDelete.setAttribute('aria-label', `Hapus hasil inspeksi untuk booking ${record.bookingId}`);
        btnDelete.addEventListener('click', () => {
          if (confirm(`Yakin ingin menghapus hasil inspeksi untuk booking ${record.bookingId}?`)) {
            deleteInspection(index);
          }
        });
        tdAction.appendChild(btnEdit);
        tdAction.appendChild(btnDelete);
        tr.appendChild(tdAction);

        inspectionRecordsTbody.appendChild(tr);
      });
    }

    // Delete inspection record
    function deleteInspection(index) {
      const data = loadInspections();
      data.splice(index, 1);
      localStorage.setItem(STORAGE_KEY, JSON.stringify(data));
      if (editIndex === index) {
        resetForm();
      }
      if (editIndex > index) {
        editIndex--;
      }
      renderInspections();
    }

    // Convert file to base64 string for storage
    function fileToBase64(file) {
      return new Promise((resolve, reject) => {
        const reader = new FileReader();
        reader.onload = () => resolve(reader.result);
        reader.onerror = error => reject(error);
        reader.readAsDataURL(file);
      });
    }

    // Populate form with existing data for editing
    async function startEdit(index) {
      const data = loadInspections();
      if (!data[index]) return;

      const record = data[index];
      editIndex = index;

      form.bookingId.value = record.bookingId;

      // Clear all checklist checkboxes then check those in record
      const checklistCheckboxes = form.querySelectorAll('input[name="checklist"]');
      checklistCheckboxes.forEach(chk => {
        chk.checked = record.checklist.includes(chk.value);
      });

      // Set hasilInspeksi radio
      if (record.hasilInspeksi) {
        const radio = form.querySelector(`input[name="hasilInspeksi"][value="${record.hasilInspeksi}"]`);
        if (radio) radio.checked = true;
      }

      // Set denda
      form.denda.value = record.denda;

      // Clear previews and file inputs
      previewPre.innerHTML = '';
      previewPost.innerHTML = '';
      fotoPreInput.value = '';
      fotoPostInput.value = '';

      // Show saved images in preview (since files cant be restored to inputs)
      if (record.fotoPre && record.fotoPre.length > 0) {
        record.fotoPre.forEach(b64 => {
          const img = document.createElement('img');
          img.classList.add('img-preview');
          img.src = b64;
          img.alt = `Foto kondisi sebelum sewa saat edit booking ${record.bookingId}`;
          previewPre.appendChild(img);
        });
      }
      if (record.fotoPost && record.fotoPost.length > 0) {
        record.fotoPost.forEach(b64 => {
          const img = document.createElement('img');
          img.classList.add('img-preview');
          img.src = b64;
          img.alt = `Foto kondisi setelah sewa saat edit booking ${record.bookingId}`;
          previewPost.appendChild(img);
        });
      }

      // Show messages that user should re-upload photos on edit
      const aviso = "Silakan unggah ulang foto sebelum dan setelah sewa jika ingin mengubahnya.";

      statusDiv.textContent = aviso;
      statusDiv.className = "status-message";

      // Change submit button text and show cancel edit btn
      submitBtn.textContent = "Perbarui Hasil Inspeksi";
      cancelEditBtn.style.display = "inline-block";

      // Scroll form into view smoothly
      form.scrollIntoView({ behavior: 'smooth' });
    }

    // Preview images (for form file inputs)
    function previewImages(input, previewContainer) {
      previewContainer.innerHTML = "";
      if (!input.files) return;
      const files = Array.from(input.files);
      if (files.length > 5) {
        alert("Maksimal 5 foto per upload");
        input.value = "";
        return;
      }
      files.forEach(file => {
        const img = document.createElement('img');
        img.classList.add('img-preview');
        img.src = URL.createObjectURL(file);
        img.alt = `Pratinjau foto ${file.name}`;
        img.onload = () => URL.revokeObjectURL(img.src);
        previewContainer.appendChild(img);
      });
    }

    // Cancel edit and reset form
    cancelEditBtn.addEventListener('click', () => {
      resetForm();
    });

    // On file change preview
    fotoPreInput.addEventListener('change', () => previewImages(fotoPreInput, previewPre));
    fotoPostInput.addEventListener('change', () => previewImages(fotoPostInput, previewPost));

    // Form submit handler
    form.addEventListener('submit', async e => {
      e.preventDefault();
      statusDiv.textContent = "";
      statusDiv.className = "";

      if (!form.bookingId.value) {
        statusDiv.textContent = "Harap pilih ID Booking terlebih dahulu.";
        statusDiv.className = "status-error";
        form.bookingId.focus();
        return;
      }
      // Validate fotoPre: if no file selected and no previous photos in edit mode, error
      if (form.fotoPre.files.length === 0 && !(editIndex !== -1 && loadInspections()[editIndex].fotoPre?.length > 0)) {
        statusDiv.textContent = "Harap unggah minimal 1 foto kondisi mobil sebelum sewa.";
        statusDiv.className = "status-error";
        form.fotoPre.focus();
        return;
      }
      // Validate fotoPost: if no file selected and no previous photos in edit mode, error
      if (form.fotoPost.files.length === 0 && !(editIndex !== -1 && loadInspections()[editIndex].fotoPost?.length > 0)) {
        statusDiv.textContent = "Harap unggah minimal 1 foto kondisi mobil setelah sewa.";
        statusDiv.className = "status-error";
        form.fotoPost.focus();
        return;
      }
      if (!form.hasilInspeksi.value) {
        statusDiv.textContent = "Harap pilih hasil inspeksi (Normal atau Rusak).";
        statusDiv.className = "status-error";
        return;
      }

      // Gather checklist values
      const checklistValues = Array.from(form.checklist)
        .filter(chk => chk.checked)
        .map(chk => chk.value);

      // Convert uploaded files to base64 for storage or reuse previous if no new upload
      let fotoPreBase64 = [];
      if (form.fotoPre.files.length > 0) {
        fotoPreBase64 = await Promise.all(
          Array.from(form.fotoPre.files).map(file => fileToBase64(file))
        );
      } else if(editIndex !== -1) {
        // Use existing fotos if no new upload
        fotoPreBase64 = loadInspections()[editIndex].fotoPre || [];
      }

      let fotoPostBase64 = [];
      if (form.fotoPost.files.length > 0) {
        fotoPostBase64 = await Promise.all(
          Array.from(form.fotoPost.files).map(file => fileToBase64(file))
        );
      } else if(editIndex !== -1) {
        fotoPostBase64 = loadInspections()[editIndex].fotoPost || [];
      }

      // Construct data object
      const formData = {
        bookingId: form.bookingId.value,
        checklist: checklistValues,
        hasilInspeksi: form.hasilInspeksi.value,
        denda: form.denda.value ? parseInt(form.denda.value) : 0,
        fotoPreCount: fotoPreBase64.length,
        fotoPostCount: fotoPostBase64.length,
        fotoPre: fotoPreBase64,
        fotoPost: fotoPostBase64,
        timestamp: new Date().toISOString()
      };

      // Update booking status in bookings array
      const booking = bookings.find(b => b.id_booking === formData.bookingId);
      if (booking) {
        booking.status_mobil = formData.hasilInspeksi === "Normal" ? "Tersedia" : "Perbaikan";
      }

      // Save or update inspection
      saveInspection(formData);
      renderInspections();

      statusDiv.textContent = editIndex === -1
        ? "Hasil inspeksi berhasil disimpan. Status mobil otomatis diperbarui."
        : "Hasil inspeksi berhasil diperbarui. Status mobil otomatis diperbarui.";
      statusDiv.className = "status-message";

      console.log("Data Inspeksi Terkirim:", formData);
      console.log("Status mobil sekarang:", booking.status_mobil);

      resetForm();
    });

    // Convert file to base64 string for storage
    function fileToBase64(file) {
      return new Promise((resolve, reject) => {
        const reader = new FileReader();
        reader.onload = () => resolve(reader.result);
        reader.onerror = error => reject(error);
        reader.readAsDataURL(file);
      });
    }

    // Initialize page
    function init() {
      loadBookings();
      renderInspections();
    }

    init();
  </script>
</body>
</html>

