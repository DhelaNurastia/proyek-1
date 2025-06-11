<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Dashboard Checker - Sigma RentCar</title>
  <style>
    body {
      display: flex; font-family: Arial, sans-serif;
      margin: 0; height: 100vh;
    }
    nav.sidebar {
      background: #222; color: white;
      width: 200px; padding: 1rem;
      display: flex; flex-direction: column;
    }
    nav.sidebar a {
      color: white; text-decoration: none;
      margin-bottom: 1rem;
    }
    nav.sidebar a.active {
      font-weight: bold;
      text-decoration: underline;
    }
    main {
      flex: 1; padding: 2rem;
      background: #f0f0f0;
      overflow-y: auto;
    }
    .content-section { display: none; }
    .content-section.active { display: block; }
    #upload-preview img, .doc-photo {
      max-width: 100px; margin: 5px; border: 1px solid #ccc;
    }
    .success { color: green; }
    .error { color: red; }
    table {
      width: 100%; border-collapse: collapse; margin-top: 1rem;
    }
    th, td {
      border: 1px solid #ccc; padding: 0.5rem;
    }
  </style>
</head>
<body>
  <nav class="sidebar">
    <h3>Checker Panel</h3>
    <a href="#" class="active" data-page="dokumentasi">Upload Dokumentasi</a>
    <a href="#" data-page="hasil-dokumentasi">Riwayat Dokumentasi</a>
    <a href="#" data-page="inspeksi">Form Inspeksi</a>
    <a href="#" data-page="hasil-inspeksi">Riwayat Inspeksi</a>
  </nav>

  <main>
    <section id="dokumentasi" class="content-section active">
      <h2>Upload Dokumentasi Mobil</h2>
      <form id="upload-form">
        <label><input type="radio" name="documentation-type" value="Sebelum Sewa" /> Sebelum Sewa</label>
        <label><input type="radio" name="documentation-type" value="Sesudah Sewa" /> Sesudah Sewa</label>
        <div style="margin-top: 1rem;">
          <label>Checklist Kerusakan:</label><br/>
          <label><input type="checkbox" name="checklist" value="Body Lecet" /> Body Lecet</label>
          <label><input type="checkbox" name="checklist" value="Ban Kempes" /> Ban Kempes</label>
          <label><input type="checkbox" name="checklist" value="Lampu Pecah" /> Lampu Pecah</label>
        </div>
        <div style="margin-top: 1rem;">
          <label>Upload Foto (max 3):</label><br/>
          <input type="file" id="upload-files" accept="image/*" multiple />
          <div id="upload-preview"></div>
        </div>
        <button type="submit">Simpan Dokumentasi</button>
        <p id="upload-status"></p>
      </form>
    </section>

    <section id="hasil-dokumentasi" class="content-section">
      <h2>Hasil Dokumentasi Mobil</h2>

      <h3>Sebelum Sewa</h3>
      <table>
        <thead><tr><th>Waktu</th><th>Checklist</th><th>Foto</th></tr></thead>
        <tbody id="documentation-before-body"></tbody>
      </table>

      <h3 style="margin-top: 2rem;">Sesudah Sewa</h3>
      <table>
        <thead><tr><th>Waktu</th><th>Checklist</th><th>Foto</th></tr></thead>
        <tbody id="documentation-after-body"></tbody>
      </table>
    </section>

    <section id="inspeksi" class="content-section">
      <h2>Form Inspeksi Mobil</h2>
      <form id="inspection-form">
        <label>Pilih Mobil:
          <select id="car-select"></select>
        </label><br/><br/>
        <label><input type="radio" name="inspection-result" value="Normal" /> Normal</label>
        <label><input type="radio" name="inspection-result" value="Rusak" /> Rusak</label><br/><br/>
        <label>Catatan Kerusakan:</label><br/>
        <textarea id="damage-notes" disabled></textarea><br/>
        <label>Denda (Rp):</label><br/>
        <input type="number" id="fine-amount" disabled value="0" /><br/><br/>
        <button type="submit">Simpan Hasil</button>
        <p id="status-msg" style="display:none;"></p>
      </form>
    </section>

    <section id="hasil-inspeksi" class="content-section">
      <h2>Riwayat Inspeksi</h2>
      <table>
        <thead>
          <tr><th>Mobil</th><th>Hasil</th><th>Catatan</th><th>Denda</th><th>Waktu</th></tr>
        </thead>
        <tbody id="inspection-history-body"></tbody>
      </table>
    </section>
  </main>

  <script>
    const navLinks = document.querySelectorAll('nav.sidebar a');
    const contentSections = document.querySelectorAll('main .content-section');

    const uploadForm = document.getElementById('upload-form');
    const uploadFilesInput = document.getElementById('upload-files');
    const uploadPreview = document.getElementById('upload-preview');
    const uploadStatus = document.getElementById('upload-status');
    const documentationBeforeBody = document.getElementById('documentation-before-body');
    const documentationAfterBody = document.getElementById('documentation-after-body');

    const inspectionForm = document.getElementById('inspection-form');
    const carSelect = document.getElementById('car-select');
    const inspectionRadios = document.getElementsByName('inspection-result');
    const damageNotes = document.getElementById('damage-notes');
    const fineAmount = document.getElementById('fine-amount');
    const statusMsg = document.getElementById('status-msg');
    const inspectionHistoryBody = document.getElementById('inspection-history-body');

    let documentationHistory = [];
    let inspectionHistory = [];

    const carsList = [
      { id: '1', model: 'Avanza', status: 'Available' },
      { id: '2', model: 'Xenia', status: 'Pending' },
      { id: '3', model: 'Innova', status: 'Maintenance' }
    ];

    function showPage(pageKey) {
      navLinks.forEach(link => {
        link.classList.toggle('active', link.getAttribute('data-page') === pageKey);
      });
      contentSections.forEach(section => {
        section.classList.toggle('active', section.id === pageKey);
      });
      uploadStatus.textContent = '';
      statusMsg.style.display = 'none';
      if (pageKey === 'hasil-dokumentasi') renderDocumentationHistory();
      if (pageKey === 'hasil-inspeksi') renderInspectionHistory();
    }

    navLinks.forEach(link => {
      link.addEventListener('click', e => {
        e.preventDefault();
        showPage(link.getAttribute('data-page'));
      });
    });

    uploadFilesInput.addEventListener('change', () => {
      uploadPreview.innerHTML = '';
      const files = uploadFilesInput.files;
      Array.from(files).forEach(file => {
        if (!file.type.startsWith('image/')) return;
        const reader = new FileReader();
        reader.onload = e => {
          const img = document.createElement('img');
          img.src = e.target.result;
          uploadPreview.appendChild(img);
        };
        reader.readAsDataURL(file);
      });
    });
uploadForm.addEventListener('submit', e => {
  e.preventDefault();
  const docTypeInput = uploadForm.querySelector('input[name="documentation-type"]:checked');
  const checklistVals = Array.from(uploadForm.querySelectorAll('input[name="checklist"]:checked')).map(c => c.value);
  const files = uploadFilesInput.files;

  if (!docTypeInput || checklistVals.length === 0 || files.length === 0) {
    uploadStatus.textContent = 'Isi semua data dokumentasi!';
    uploadStatus.className = 'error';
    return;
  }

  const formData = new FormData();
  formData.append('tipe', docTypeInput.value);
  formData.append('checklist', checklistVals.join(', '));
  for (let i = 0; i < files.length; i++) {
    formData.append('foto[]', files[i]);
  }

  fetch('simpan_dokumentasi.php', {
    method: 'POST',
    body: formData
  })
    .then(res => res.text())
    .then(text => {
      if (text.includes('sukses')) {
        uploadStatus.textContent = 'Dokumentasi berhasil disimpan.';
        uploadStatus.className = 'success';
        uploadForm.reset();
        uploadPreview.innerHTML = '';
      } else {
        uploadStatus.textContent = 'Gagal menyimpan dokumentasi.';
        uploadStatus.className = 'error';
      }
    });
});

    
      });
    });

    function renderDocumentationHistory() {
  fetch('ambil_dokumentasi.php')
    .then(res => res.json())
    .then(data => {
      documentationBeforeBody.innerHTML = '';
      documentationAfterBody.innerHTML = '';

      ['Sebelum Sewa', 'Sesudah Sewa'].forEach(tipe => {
        data[tipe].forEach(row => {
          const tr = document.createElement('tr');
          const fotoHTML = row.foto.split(',').map(f =>
            `<img class="doc-photo" src="upload/${f.trim()}" />`
          ).join('');
          tr.innerHTML = `
            <td>${row.waktu}</td>
            <td>${row.checklist}</td>
            <td>${fotoHTML}</td>
          `;
          if (tipe === 'Sebelum Sewa') documentationBeforeBody.appendChild(tr);
          else documentationAfterBody.appendChild(tr);
        });
      });
    });
}

      });
    }

    function populateCarSelect() {
      carSelect.innerHTML = '';
      carsList.forEach(car => {
        const opt = document.createElement('option');
        opt.value = car.id;
        opt.textContent = `${car.model} (${car.status})`;
        carSelect.appendChild(opt);
      });
    }

    inspectionRadios.forEach(r => {
      r.addEventListener('change', () => {
        const isRusak = r.value === 'Rusak' && r.checked;
        damageNotes.disabled = !isRusak;
        fineAmount.disabled = !isRusak;
        if (!isRusak) {
          damageNotes.value = '';
          fineAmount.value = 0;
        }
      });
    });

    inspectionForm.addEventListener('submit', e => {
      e.preventDefault();
      const selectedCar = carsList.find(c => c.id === carSelect.value);
      const inspectionResult = inspectionForm['inspection-result'].value;
      const notes = damageNotes.value.trim();
      const fine = parseInt(fineAmount.value) || 0;

      if (!inspectionResult || (inspectionResult === 'Rusak' && (!notes || fine < 0))) {
        statusMsg.textContent = 'Lengkapi data inspeksi!';
        statusMsg.className = 'error';
        statusMsg.style.display = 'block';
        return;
      }

      inspectionHistory.push({
        carModel: selectedCar.model,
        result: inspectionResult,
        notes: notes || '-',
        fine: inspectionResult === 'Rusak' ? fine : 0,
        time: new Date().toLocaleString('id-ID')
      });

      selectedCar.status = (inspectionResult === 'Rusak') ? 'Maintenance' : 'Available';
      populateCarSelect();
      renderInspectionHistory();
      inspectionForm.reset();
      damageNotes.disabled = true;
      fineAmount.disabled = true;
      statusMsg.textContent = 'Hasil inspeksi disimpan.';
      statusMsg.className = 'success';
      statusMsg.style.display = 'block';
    });

    function renderInspectionHistory() {
      inspectionHistoryBody.innerHTML = '';
      inspectionHistory.forEach(record => {
        const tr = document.createElement('tr');
        tr.innerHTML = `
          <td>${record.carModel}</td>
          <td>${record.result}</td>
          <td>${record.notes}</td>
          <td>Rp ${record.fine.toLocaleString('id-ID')}</td>
          <td>${record.time}</td>
        `;
        inspectionHistoryBody.appendChild(tr);
      });
    }

    populateCarSelect();
  </script>
</body>
</html>
