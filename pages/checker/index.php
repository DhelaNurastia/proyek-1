<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Sigma Rentcar</title>
<link
    rel="stylesheet"
    href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
/>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f8f9fa;
    }
    .container {
        margin-top: 20px;
        max-width: 900px;
    }
    .card {
        margin-bottom: 20px;
    }
    .img-preview {
        max-width: 200px;
        margin-top: 10px;
        margin-right: 10px;
        border-radius: 8px;
        object-fit: cover;
        box-shadow: 0 2px 6px rgba(0,0,0,0.15);
    }
    video.img-preview {
        max-height: 120px;
    }
    #inspectionResults p {
        margin-bottom: 0.3rem;
    }
    label {
        font-weight: 600;
    }
    .custom-file-label::after {
        content: "Browse";
    }
    .saved-inspections-list li, .customer-history-list li {
        margin-bottom: 15px;
        padding: 15px;
        background: white;
        border-radius: 8px;
        box-shadow: 0 2px 6px rgb(0 0 0 / 0.1);
    }
    .saved-inspections-list li strong, .customer-history-list li strong {
        font-weight: 700;
    }
    .delete-btn {
        float: right;
        cursor: pointer;
    }
    /* Tab navigation styling */
    .nav-tabs {
        margin-bottom: 20px;
    }
    .checklist-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 8px 0;
        border-bottom: 1px solid #eee;
    }
    .checklist-label {
        flex-grow: 1;
    }
    .checklist-status {
        display: flex;
        gap: 1rem;
        align-items: center;
    }
</style>
</head>
<body>
<div class="container">
    <h1 class="mb-4">Sigma Rentcar - Sistem Inspeksi &amp; Dokumentasi Mobil</h1>

      <!-- Navigation tabs -->
    <ul class="nav nav-tabs" id="mainTabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="form-tab" data-toggle="tab" href="#tabForm" role="tab" aria-controls="tabForm" aria-selected="true" tabindex="0">Form Inspeksi</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="saved-tab" data-toggle="tab" href="#tabSaved" role="tab" aria-controls="tabSaved" aria-selected="false" tabindex="0">Dokumentasi Tersimpan</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="history-tab" data-toggle="tab" href="#tabHistory" role="tab" aria-controls="tabHistory" aria-selected="false" tabindex="0">Riwayat Customer</a>
        </li>
    </ul>

    <div class="tab-content" id="mainTabsContent">
        <!-- Inspection Form tab -->
        <div class="tab-pane fade show active" id="tabForm" role="tabpanel" aria-labelledby="form-tab">
            <div class="card">
                <div class="card-header">Dokumentasi Mobil</div>
                <div class="card-body">
                    <form id="car-inspection-form" novalidate>
                        <div class="form-group">
                            <label for="customerName">Nama Customer:</label>
                            <input
                                type="text"
                                class="form-control"
                                id="customerName"
                                placeholder="Masukkan nama customer"
                                required
                            />
                        </div>
                        <div class="form-group">
                            <label for="carId">ID Mobil:</label>
                            <input
                                type="text"
                                class="form-control"
                                id="carId"
                                placeholder="Masukkan ID Mobil"
                                required
                            />
                        </div>

                        <div class="form-group">
                            <label>Kondisi Mobil (sebelum sewa):</label>
                            <div class="custom-file">
                                <input
                                    type="file"
                                    class="custom-file-input"
                                    id="preSewaUpload"
                                    accept="image/*,video/*"
                                    multiple
                                />
                                <label class="custom-file-label" for="preSewaUpload"
                                    >Upload Foto (Sebelum Sewa)</label
                                >
                            </div>
                            <div id="preSewaPreview" class="d-flex flex-wrap mt-2"></div>
                        </div>

                        <div class="form-group">
                            <label>Kondisi Mobil (Setelah Sewa):</label>
                            <div class="custom-file">
                                <input
                                    type="file"
                                    class="custom-file-input"
                                    id="postSewaUpload"
                                    accept="image/*,video/*"
                                    multiple
                                />
                                <label class="custom-file-label" for="postSewaUpload"
                                    >Upload Foto (setelah sewa)</label
                                >
                            </div>
                            <div id="postSewaPreview" class="d-flex flex-wrap mt-2"></div>
                        </div>

                        <div class="form-group">
                            <label>Checklist &amp; Status Kondisi Mobil:</label>
                            <div id="checklist">
                                <div class="checklist-item">
                                    <span class="checklist-label">Ban</span>
                                    <div class="checklist-status">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="banStatus" id="banNormal" value="Normal" required>
                                            <label class="form-check-label" for="banNormal">Normal</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="banStatus" id="banRusak" value="Rusak">
                                            <label class="form-check-label" for="banRusak">Rusak</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="checklist-item">
                                    <span class="checklist-label">Body</span>
                                    <div class="checklist-status">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="bodyStatus" id="bodyNormal" value="Normal" required>
                                            <label class="form-check-label" for="bodyNormal">Normal</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="bodyStatus" id="bodyRusak" value="Rusak">
                                            <label class="form-check-label" for="bodyRusak">Rusak</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="checklist-item">
                                    <span class="checklist-label">Interior</span>
                                    <div class="checklist-status">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="interiorStatus" id="interiorNormal" value="Normal" required>
                                            <label class="form-check-label" for="interiorNormal">Normal</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="interiorStatus" id="interiorRusak" value="Rusak">
                                            <label class="form-check-label" for="interiorRusak">Rusak</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="checklist-item">
                                    <span class="checklist-label">Mesin</span>
                                    <div class="checklist-status">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="mesinStatus" id="mesinNormal" value="Normal" required>
                                            <label class="form-check-label" for="mesinNormal">Normal</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="mesinStatus" id="mesinRusak" value="Rusak">
                                            <label class="form-check-label" for="mesinRusak">Rusak</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="catatanKerusakan">Catatan Kerusakan:</label>
                            <textarea
                                class="form-control"
                                id="catatanKerusakan"
                                rows="3"
                                placeholder="Tambahkan catatan kerusakan bila ada"
                            ></textarea>
                        </div>

                        <div class="form-group">
                            <label for="denda">Denda (Rp):</label>
                            <input
                                type="number"
                                class="form-control"
                                id="denda"
                                placeholder="Masukkan jumlah denda jika ada"
                                min="0"
                                value="0"
                            />
                        </div>

                        <button type="submit" class="btn btn-primary">
                            Kirim Inspeksi
                        </button>
                    </form>
                </div>
            </div>

            <div class="card mt-4">
                <div class="card-header">Hasil Inspeksi</div>
                <div class="card-body">
                    <div id="inspectionResults" tabindex="0" aria-live="polite"></div>
                </div>
            </div>
        </div>

        <!-- Saved Inspections tab -->
        <div class="tab-pane fade" id="tabSaved" role="tabpanel" aria-labelledby="saved-tab">
            <div class="card">
                <div class="card-header">Dokumentasi Tersimpan</div>
                <div class="card-body">
                    <ul class="saved-inspections-list list-unstyled" id="savedInspectionsList"></ul>
                    <p id="noInspectionsMsg" class="text-muted">Belum ada hasil inspeksi tersimpan.</p>
                </div>
            </div>
        </div>

        <!-- Customer History tab -->
        <div class="tab-pane fade" id="tabHistory" role="tabpanel" aria-labelledby="history-tab">
            <div class="card">
                <div class="card-header">Riwayat Customer</div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="filterCustomerName">Filter berdasarkan nama customer:</label>
                        <input type="text" class="form-control" id="filterCustomerName" placeholder="Masukkan nama customer..." aria-label="Filter riwayat customers" />
                    </div>
                    <ul class="customer-history-list list-unstyled" id="customerHistoryList"></ul>
                    <p id="noHistoryMsg" class="text-muted">Tidak ditemukan riwayat untuk customer tersebut.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script
    src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
    crossorigin="anonymous"
></script>
<script
    src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"
    crossorigin="anonymous"
></script>
<script
    src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
    crossorigin="anonymous"
></script>
<script>
    $(document).ready(function () {
       function previewFiles(input, previewArea) {
    var files = input.files;
    $(previewArea).empty();
    if (files) {
        for (let i = 0; i < files.length; i++) {
            let file = files[i];
            let reader = new FileReader();
            reader.onload = function (event) {
                let fileType = file.type;
                let previewElement;
                if (fileType.includes("image")) {
                    previewElement = $('<img alt="Preview gambar" class="img-preview" />').attr("src", event.target.result);
                    // Menyimpan Base64 string ke localStorage
                    saveFileToLocalStorage(file.name, event.target.result);
                } else if (fileType.includes("video")) {
                    previewElement = $('<video controls class="img-preview"></video>');
                    previewElement.attr("src", event.target.result);
                } else {
                    previewElement = $("<p>Unsupported file type</p>");
                }
                $(previewArea).append(previewElement);
            };
            reader.readAsDataURL(file);
        }
    }
}

function saveFileToLocalStorage(fileName, base64Data) {
    // Mendapatkan data yang ada di localStorage
    let storedFiles = JSON.parse(localStorage.getItem("uploadedFiles")) || [];
    // Menambahkan file baru ke array
    storedFiles.push({ fileName, base64Data });
    // Menyimpan kembali ke localStorage
    localStorage.setItem("uploadedFiles", JSON.stringify(storedFiles));
}

        $(".custom-file-input").on("change", function () {
            let fileNames = Array.from(this.files)
                .map((file) => file.name)
                .join(", ");
            $(this)
                .next(".custom-file-label")
                .addClass("selected")
                .html(fileNames || "Pilih file");
        });
        $("#preSewaUpload").change(function () {
            previewFiles(this, "#preSewaPreview");
        });
        $("#postSewaUpload").change(function () {
            previewFiles(this, "#postSewaPreview");
        });
        function loadInspections() {
            const savedInspections =
                JSON.parse(localStorage.getItem("sigmaRentcarInspections")) || [];
            const listElement = $("#savedInspectionsList");
            const noMsg = $("#noInspectionsMsg");
            listElement.empty();
            if (savedInspections.length === 0) {
                noMsg.show();
                return;
            }
            noMsg.hide();
            savedInspections.forEach((inspection, index) => {
                const truncatedNotes =
                    inspection.catatanKerusakan.length > 80
                        ? inspection.catatanKerusakan.substring(0, 77) + "..."
                        : inspection.catatanKerusakan;
                const li = $(`
                    <li>
                        <button class="btn btn-sm btn-danger delete-btn" aria-label="Hapus inspeksi ${inspection.carId}">&times;</button>
                        <div><strong>Nama Customer:</strong> ${inspection.customerName}</div>
                        <div><strong>ID Mobil:</strong> ${inspection.carId}</div>
                        <div><strong>Hasil Inspeksi:</strong> ${inspection.hasilInspeksi}</div>
                        <div><strong>Catatan Kerusakan:</strong> ${truncatedNotes}</div>
                        <div><strong>Denda:</strong> Rp ${inspection.denda.toLocaleString(
                            "id-ID"
                        )}</div>
                    </li>
                `);
                li.find(".delete-btn").on("click", () => {
                    if (
                        confirm(
                            `Hapus data inspeksi dengan ID Mobil: ${inspection.carId}?`
                        )
                    ) {
                        deleteInspection(index);
                    }
                });
                listElement.append(li);
            });
        }
        function saveInspection(data) {
            const savedInspections =
                JSON.parse(localStorage.getItem("sigmaRentcarInspections")) || [];
            savedInspections.push(data);
            localStorage.setItem(
                "sigmaRentcarInspections",
                JSON.stringify(savedInspections)
            );
        }
        function deleteInspection(index) {
            let savedInspections =
                JSON.parse(localStorage.getItem("sigmaRentcarInspections")) || [];
            if (index >= 0 && index < savedInspections.length) {
                savedInspections.splice(index, 1);
                localStorage.setItem(
                    "sigmaRentcarInspections",
                    JSON.stringify(savedInspections)
                );
                loadInspections();
                loadCustomerHistory();
            }
        }
        function loadCustomerHistory(filterName = '') {
            const savedInspections =
                JSON.parse(localStorage.getItem("sigmaRentcarInspections")) || [];
            const listElement = $("#customerHistoryList");
            const noMsg = $("#noHistoryMsg");
            listElement.empty();
            const filteredInspections = savedInspections.filter((ins) =>
                ins.customerName.toLowerCase().includes(filterName.toLowerCase())
            );
            if (filteredInspections.length === 0) {
                noMsg.show();
                return;
            }
            noMsg.hide();
            filteredInspections.forEach((inspection) => {
                const truncatedNotes =
                    inspection.catatanKerusakan.length > 80
                        ? inspection.catatanKerusakan.substring(0, 77) + "..."
                        : inspection.catatanKerusakan;
                const li = $(`
                    <li>
                        <div><strong>Nama Customer:</strong> ${inspection.customerName}</div>
                        <div><strong>ID Mobil:</strong> ${inspection.carId}</div>
                        <div><strong>Hasil Inspeksi Detail:</strong></div>
                        <ul>
                            ${Object.entries(inspection.checklistStatus || {}).map(([item, status]) => `<li>${item}: <strong>${status}</strong></li>`).join('')}
                        </ul>
                        <div><strong>Catatan Kerusakan:</strong> ${truncatedNotes}</div>
                        <div><strong>Denda:</strong> Rp ${inspection.denda.toLocaleString(
                            "id-ID"
                        )}</div>
                    </li>
                `);
                listElement.append(li);
            });
        }

        $("#car-inspection-form").submit(function (event) {
            event.preventDefault();

            const customerName = $("#customerName").val().trim();
            const carId = $("#carId").val().trim();

            // We do not store file contents, only count and names
            const preFiles = $("#preSewaUpload")[0].files;
            const postFiles = $("#postSewaUpload")[0].files;

            const preSewaFilesInfo = [];
            for (let f of preFiles) {
                preSewaFilesInfo.push({ name: f.name, type: f.type });
            }
            const postSewaFilesInfo = [];
            for (let f of postFiles) {
                postSewaFilesInfo.push({ name: f.name, type: f.type });
            }

            // Collect checklist statuses for each item
            const checklistStatus = {};
            ['ban', 'body', 'interior', 'mesin'].forEach(id => {
                const radios = $(`input[name=${id}Status]`);
                radios.each(function() {
                    if(this.checked) {
                        // Capitalize first letter
                        checklistStatus[id.charAt(0).toUpperCase() + id.slice(1)] = this.value.charAt(0).toUpperCase() + this.value.slice(1);
                    }
                });
            });

            // Determine overall hasilInspeksi and statusMobil
            // If any checklist item marked Rusak, hasilInspeksi = Rusak else Normal
            const hasilInspeksi = Object.values(checklistStatus).includes('Rusak') ? 'Rusak' : 'Normal';
            const statusMobil = hasilInspeksi === 'Rusak' ? 'Rusak' : 'Siap Digunakan';

            const catatanKerusakan = $("#catatanKerusakan").val().trim() || "-";
            const dendaVal = $("#denda").val();
            const denda = dendaVal ? Number(dendaVal) : 0;

            const inspectionData = {
                customerName,
                carId,
                preSewaFilesCount: preFiles.length,
                postSewaFilesCount: postFiles.length,
                preSewaFilesInfo,
                postSewaFilesInfo,
                checklistStatus,
                hasilInspeksi,
                catatanKerusakan,
                denda,
                statusMobil,
            };

            saveInspection(inspectionData);
            loadInspections();
            loadCustomerHistory();

            // Display summary with detailed checklist statuses
            let checklistItemsHtml = '<ul>';
            for(const [item, status] of Object.entries(checklistStatus)) {
                checklistItemsHtml += `<li>${item}: <strong>${status}</strong></li>`;
            }
            checklistItemsHtml += '</ul>';

            let resultsHtml = `
                <p><strong>Nama Customer:</strong> ${customerName}</p>
                <p><strong>ID Mobil:</strong> ${carId}</p>
                <p><strong>Kondisi Pre-Sewa:</strong> ${preFiles.length} file(s) diupload</p>
                <p><strong>Kondisi Post-Sewa:</strong> ${postFiles.length} file(s) diupload</p>
                <p><strong>Detail Checklist Kondisi:</strong> ${checklistItemsHtml}</p>
                <p><strong>Hasil Inspeksi Keseluruhan:</strong> ${hasilInspeksi}</p>
                <p><strong>Catatan Kerusakan:</strong> ${catatanKerusakan}</p>
                <p><strong>Denda:</strong> Rp ${denda.toLocaleString("id-ID")}</p>

            `;
            $("#inspectionResults").html(resultsHtml);

            this.reset();
            $(".custom-file-label").html("Pilih file");
            $("#preSewaPreview, #postSewaPreview").empty();
        });

        $("#filterCustomerName").on("input", function () {
            const query = $(this).val();
            loadCustomerHistory(query);
        });

        // Load saved inspections and customer history on page load
        loadInspections();
        loadCustomerHistory();
    });
</script>
</body>
</html>

