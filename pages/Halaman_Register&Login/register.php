<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Daftar Akun</title>
    <link rel="stylesheet" href="../../assets/CSS/registerlogin.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">
    <style>
        .error {
            color: red;
            font-size: 0.85em;
            margin-top: 4px;
            display: block;
        }

        input.error-input {
            border: 2px solid red;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .form-box input {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- KIRI -->
        <div class="left">
            <img src="../../assets/img/logo.png" alt="Astronaut" />
            <h3>Daftar Akun</h3>
            <p>Mulai perjalananmu bersama kami 🚗</p>
        </div>

        <!-- KANAN -->
        <div class="right">
            <div class="form-box">
                <h2>Buat Akun Baru</h2>
                <form action="register_proses.php" method="POST" onsubmit="return validateForm()">

                    <div class="form-group">
                        <input type="text" name="nama" id="nama" placeholder="Username" />
                        <small class="error" id="err-nama"></small>
                    </div>

                    <div class="form-group">
                        <input type="email" name="email" id="email" placeholder="Email" />
                        <small class="error" id="err-email"></small>
                    </div>

                    <div class="form-group">
                        <input type="password" name="password" id="password" placeholder="Password" />
                        <small class="error" id="err-password"></small>
                    </div>

                    <div class="form-group">
                        <input type="password" name="konfirmasi" id="konfirmasi" placeholder="Konfirmasi Password" />
                        <small class="error" id="err-konfirmasi"></small>
                    </div>

                    <button type="submit">Daftar</button>
                </form>

                <p style="text-align: center; margin-top: 1rem;">
                    Sudah punya akun? <a href="login.php" style="color: #285ad7;">Login di sini</a>
                </p>
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
    </script>
</body>

</html>