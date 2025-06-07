<?php
require_once "../../config.php";
require_once "../../koneksi.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Daftar Akun</title>

    <!-- Custom fonts for this template-->
    <link href="/proyek-1/assets/template/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../../assets/css/sb-admin-2.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f4f4;
        }

        .card {
            background-color: black;
        }

        .bg-register-image {
            background: url('../../assets/img/logo.png') no-repeat center center;
            background-size: contain; /* Mengatur ukuran logo agar sesuai */
        }

        .form-box {
            padding: 30px;
        }

        .form-box h2 {
            color: #000957;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .form-box input {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            transition: border-color 0.3s;
        }

        .form-box input:focus {
            border-color: #344CB7;
            outline: none;
        }

        button {
            background-color: #344CB7;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #577BC1;
        }

        .error {
            color: red;
            font-size: 0.85em;
            margin-top: 4px;
            display: block;
        }

        input.error-input {
            border: 2px solid red;
        }

        .file-description {
            font-size: 0.85em;
            color: #777;
            margin-top: 4px;
            display: none;
        }

        .file-input-container {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 1rem;
        }
    </style>
</head>

<body class="bg-gradient-primary">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Buat Akun Baru!</h1>
                            </div>
                            <form action="register_proses.php" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
                                <div class="form-group">
                                    <input type="text" name="nama" id="nama" class="form-control form-control-user" placeholder="Username" />
                                    <small class="error" id="err-nama"></small>
                                </div>

                                <div class="form-group">
                                    <input type="email" name="email" id="email" class="form-control form-control-user" placeholder="Email" />
                                    <small class="error" id="err-email"></small>
                                </div>

                                <div class="form-group">
                                    <input type="password" name="password" id="password" class="form-control form-control-user" placeholder="Password" />
                                    <small class="error" id="err-password"></small>
                                </div>

                                <div class="form-group">
                                    <input type="password" name="konfirmasi" id="konfirmasi" class="form-control form-control-user" placeholder="Konfirmasi Password" />
                                    <small class="error" id="err-konfirmasi"></small>
                                </div>

                                <div class="form-group file-input-container">
                                    <label for="sim">Upload SIM:</label>
                                    <input type="file" name="sim" id="sim" accept=".jpg,.jpeg,.png,.pdf" onchange="checkFileSize(this, 'err-sim', 'desc-sim')" />
                                    <small class="file-description" id="desc-sim">Format: JPG, JPEG, PNG, PDF. Maksimal 2MB.</small>
                                    <small class="error" id="err-sim"></small>
                                </div>

                                <div class="form-group file-input-container">
                                    <label for="kk">Upload KK:</label>
                                    <input type="file" name="kk" id="kk" accept=".jpg,.jpeg,.png,.pdf" onchange="checkFileSize(this, 'err-kk', 'desc-kk')" />
                                    <small class="file-description" id="desc-kk">Format: JPG, JPEG, PNG, PDF. Maksimal 2MB.</small>
                                    <small class="error" id="err-kk"></small>
                                </div>

                                <div class="form-group file-input-container">
                                    <label for="ktp">Upload KTP:</label>
                                    <input type="file" name="ktp" id="ktp" accept=".jpg,.jpeg,.png,.pdf" onchange="checkFileSize(this, 'err-ktp', 'desc-ktp')" />
                                    <small class="file-description" id="desc-ktp">Format: JPG, JPEG, PNG, PDF. Maksimal 2MB.</small>
                                    <small class="error" id="err-ktp"></small>
                                </div>

                                <button type="submit">Daftar</button>
                            </form>

                            <p class="text-center" style="margin-top: 1rem;">
                                Sudah punya akun? <a href="login.php" style="color: #285ad7;">Login di sini</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- VALIDASI JAVASCRIPT -->
    <script>
        function validateForm() {
            let valid = true;

            const nama = document.getElementById("nama");
            const email = document.getElementById("email");
            const password = document.getElementById("password");
            const konfirmasi = document.getElementById("konfirmasi");
            const sim = document.getElementById("sim");
            const kk = document.getElementById("kk");
            const ktp = document.getElementById("ktp");

            // Reset error
            document.querySelectorAll(".error").forEach(el => el.textContent = "");
            document.querySelectorAll("input").forEach(el => el.classList.remove("error-input"));

            if (nama.value.trim() === "") {
                showError(nama, "Nama lengkap harus diisi");
                valid = false;
            }

            if (email.value.trim() === "") {
                showError(email, "Email harus diisi");
                valid = false;
            } else if (!validateEmail(email.value)) {
                showError(email, "Format email tidak valid");
                valid = false;
            }

            if (password.value.length < 6) {
                showError(password, "Password minimal 6 karakter");
                valid = false;
            }

            if (konfirmasi.value !== password.value) {
                showError(konfirmasi, "Konfirmasi password tidak cocok");
                valid = false;
            }

            if (!sim.value) {
                showError(sim, "Upload SIM harus diisi");
                valid = false;
            }

            if (!kk.value) {
                showError(kk, "Upload KK harus diisi");
                valid = false;
            }

            if (!ktp.value) {
                showError(ktp, "Upload KTP harus diisi");
                valid = false;
            }

            return valid;
        }

        function showError(input, message) {
            const errorId = "err-" + input.id;
            const errorElement = document.getElementById(errorId);
            errorElement.textContent = message;
            input.classList.add("error-input");
        }

        function validateEmail(email) {
            const regex = /^[^@\s]+@[^@\s]+\.[^@\s]+$/;
            return regex.test(email);
        }

        function checkFileSize(input, errorId, descId) {
            const file = input.files[0];
            const maxSize = 2 * 1024 * 1024; // 2MB

            // Reset error
            document.getElementById(errorId).textContent = "";
            document.getElementById(descId).style.display = "none"; // Sembunyikan keterangan

            if (file) {
                if (file.size > maxSize) {
                    showError(input, "Ukuran file melebihi 2MB");
                } else {
                    document.getElementById(descId).style.display = "block"; // Tampilkan keterangan
                }
            }
        }
    </script>
</body>

</html>
