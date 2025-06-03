<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login</title>
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

        .success {
            color: green;
            font-size: 0.95em;
            margin-bottom: 1rem;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- KIRI -->
        <div class="left">
            <img src="../../assets/img/logo.png" alt="Astronaut" />
            <h3>Selamat Datang Kembali</h3>
            <p>Masuk ke akunmu dan lanjutkan petualangan 🚀</p>
        </div>

        <!-- KANAN -->
        <div class="right">
            <div class="form-box">
                <h2>Login</h2>

                <?php if (isset($_GET['error']) && $_GET['error'] == '1'): ?>
                    <div class="error" style="margin-bottom: 1rem;">username atau password salah!</div>
                <?php endif; ?>

                <?php if (isset($_GET['register']) && $_GET['register'] == 'success'): ?>
                    <div class="success">Akun berhasil dibuat! Silakan login yaa 😊</div>
                <?php endif; ?>

                <?php if (isset($_GET['reset']) && $_GET['reset'] == 'success'): ?>
                    <div class="success">Password berhasil direset! Silakan login yaa 🔐</div>
                <?php endif; ?>

                <form action="login_proses.php" method="POST" onsubmit="return validateLogin()">
                    <div class="form-group">
                        <input type="text" name="nama" id="nama" placeholder="Username" />
                        <small class="error" id="err-nama"></small>
                    </div>

                    <div class="form-group">
                        <input type="password" name="password" id="password" placeholder="Password" />
                        <small class="error" id="err-password"></small>
                    </div>

                    <button type="submit">Login</button>
                </form>

                <p style="text-align: center; margin-top: 1rem;">
                    <a href="forgot_password.php" style="color: #285ad7;">Lupa Password?</a>
                </p>

                <p style="text-align: center; margin-top: 1rem;">
                    Belum punya akun? <a href="register.php" style="color: #285ad7;">Daftar yuk!</a>
                </p>
            </div>
        </div>
    </div>

    <!-- VALIDASI JAVASCRIPT -->
    <script>
        function validateLogin() {
            let valid = true;

            const username = document.getElementById("nama");
            const password = document.getElementById("password");

            // Reset
            document.querySelectorAll(".error").forEach(el => el.textContent = "");
            document.querySelectorAll("input").forEach(el => el.classList.remove("error-input"));

            if (email.value.trim() === "") {
                showError(username, "Username wajib diisi");
                valid = false;
            }

            if (password.value.trim() === "") {
                showError(password, "Password tidak boleh kosong");
                valid = false;
            }

            return valid;
        }

        function showError(input, message) {
            const errorId = "err-" + input.id;
            document.getElementById(errorId).textContent = message;
            input.classList.add("error-input");
        }
    </script>
</body>

</html>