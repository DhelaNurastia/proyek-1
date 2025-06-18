<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .header {
            background-color: #111827;
            height: 350px;
            text-align: center;
            position: relative;
            z-index: 1;
            color: white;
        }

        .header img {
            max-width: 150px;
            margin-top: 2px;
        }

        .header h3,
        .header p {
            margin: 10px 0 0;
        }

        .form-wrapper {
            display: flex;
            justify-content: center;
            align-items: flex-start;
            margin-top: -160px;
            padding: 40px 20px;
            position: relative;
            z-index: 2;
        }

        .form-container {
            background: #fff;
            padding: 30px 40px;
            box-shadow: 0px 0px 20px 8px rgba(0, 9, 87, 0.4);
            max-width: 600px;
            width: 100%;
            box-sizing: border-box;
            border-radius: 10px;
            transition: box-shadow 0.3s ease;
        }

        .form-container:hover {
            box-shadow: 0px 0px 25px 10px rgba(240, 231, 65, 0.6);
        }

        h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #000957;
        }

        .form-group {
            display: flex;
            justify-content: space-between;
            margin-bottom: 25px;
            flex-wrap: wrap;
        }

        .form-group .input-box {
            width: 48%;
            margin-bottom: 10px;
        }

        .input-box label {
            display: block;
            margin-bottom: 5px;
            color: #333;
        }

        .input-box input[type="text"],
        .input-box input[type="email"],
        .input-box input[type="password"],
        .input-box input[type="file"] {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
            transition: border-color 0.3s, box-shadow 0.3s;
        }

        .input-box input:focus {
            border-color: #87cefa;
            box-shadow: 0 0 6px #000957;
            outline: none;
        }

        .submit-button {
            text-align: center;
            margin-top: 20px;
        }

        .submit-button button {
            padding: 10px 20px;
            background-color: #000957;
            border: none;
            color: white;
            font-weight: bold;
            border-radius: 4px;
            cursor: pointer;
        }

        .submit-button button:hover {
            background-color: rgba(240, 231, 65, 0.6);
            color: #000;
        }

        .form-footer a {
            color: #000957;
        }
    </style>
</head>

<body>
    <div class="header">
        <img src="../../assets/img/logo.png" alt="Logo">
        <h3>yuk, mulai petualanganmu di sini!</h3>
        <p>Pilih mobil, booking, dan gaskeun bareng kami!</p>
    </div>
    <div class="form-wrapper">
        <div class="form-container">
            <h2>Buat Akun Mu</h2>
            <form action="register_proses.php" method="post" enctype="multipart/form-data" onsubmit=" return validateForm()">
                <div class="form-group">
                    <div class="input-box">
                        <input type="text" name="nama_lengkap" id="nama_lengkap" placeholder="Nama Lengkap" />
                        <small class="error" id="err-nama_lengkap"></small>
                    </div>
                    <div class="input-box">
                        <input type="text" name="nama" id="nama" placeholder="Username" />
                        <small class="error" id="err-nama"></small>
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-box" style="width:100%">
                        <input type="text" alamat="alamat" id="alamat" placeholder="Alamat Lengkap" />
                        <small class="error" id="err-nama_lengkap"></small>
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-box">
                        <input type="email" name="email" id="email" placeholder="Email" />
                        <small class="error" id="err-email"></small>
                    </div>
                    <div class="input-box">
                        <input type="text" name="telepon" id="telepon" placeholder="Nomor Telepon" />
                        <small class="error" id="err-telepon"></small>
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-box">
                        <input type="password" name="password" id="password" placeholder="Password" />
                        <small class="error" id="err-password"></small>
                    </div>
                    <div class="input-box">
                        <input type="password" name="konfirmasi" id="konfirmasi" placeholder="Konfirmasi Password" />
                        <small class="error" id="err-konfirmasi"></small>
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-box">
                        <label for="kk">Upload KK</label>
                        <input type="file" name="kk" id="kk" accept=".jpg,.jpeg,.png"
                            onchange="checkFileSize(this, 'err-kk', 'desc-kk')" />
                        <small class="file-description" id="desc-kk">Format: JPG, JPEG, PNG. Maksimal 2MB.</small>
                        <small class="error" id="err-kk"></small>
                    </div>
                    <div class="input-box">
                        <label for="ktp">Upload KTP</label>
                        <input type="file" name="ktp" id="ktp" accept=".jpg,.jpeg,.png"
                            onchange="checkFileSize(this, 'err-ktp', 'desc-ktp')" />
                        <small class="file-description" id="desc-ktp">Format: JPG, JPEG, PNG. Maksimal 2MB.</small>
                        <small class="error" id="err-ktp"></small>
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-box" style="width:100%">
                        <label for="sim">Upload SIM</label>
                        <input type="file" name="sim" id="sim" accept=".jpg,.jpeg,.png"
                            onchange="checkFileSize(this, 'err-sim', 'desc-sim')" />
                        <small class="file-description" id="desc-sim">Format: JPG, JPEG, PNG. Maksimal 2MB.</small>
                        <small class="error" id="err-sim"></small>
                    </div>
                </div>

                <div class="submit-button">
                    <button type="submit" aria-label="Daftar" href="login.php">Daftar</button>
            </form>

            <p class="form-footer">
                Sudah punya akun? <a href="login.php">Login di sini</a>
            </p>
        </div>
        </form>
    </div>
    </div>

    <script>
        function validateForm() {
            let valid = true;

            const nama_lengkap = document.getElementById("nama_lengkap");
            const nama = document.getElementById("nama");
            const email = document.getElementById("email");
            const telepon = document.getElementById("telepon");
            const password = document.getElementById("password");
            const konfirmasi = document.getElementById("konfirmasi");
            const sim = document.getElementById("sim");
            const kk = document.getElementById("kk");
            const ktp = document.getElementById("ktp");

            // Reset error
            document.querySelectorAll(".error").forEach(el => el.textContent = "");
            document.querySelectorAll("input").forEach(el => el.classList.remove("error-input"));

            if (nama_lengkap.value.trim() === "") {
                showError(nama_lengkap, "Nama lengkap harus diisi");
                valid = false;
            }

            if (nama.value.trim() === "") {
                showError(nama, "Username harus diisi");
                valid = false;
            }

            if (email.value.trim() === "") {
                showError(email, "Email harus diisi");
                valid = false;
            } else if (!validateEmail(email.value)) {
                showError(email, "Format email tidak valid");
                valid = false;
            }

            if (telepon.value.trim() === "") {
                showError(telepon, "Nomor telepon harus diisi");
                valid = false;
            } else if (!/^[0-9]+$/.test(telepon.value)) {
                showError(telepon, "Nomor telepon hanya boleh angka");
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

        function togglePassword(id) {
            const passwordInput = document.getElementById(id);
            const type = passwordInput.getAttribute("type") === "password" ? "text" : "password";
            passwordInput.setAttribute("type", type);
        }
    </script>

</body>

</html>