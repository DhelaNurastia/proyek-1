<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Lupa Password</title>
    <link rel="stylesheet" href="../../assets/CSS/registerlogin.css" />
    <style>
        .error {
            color: red;
            font-size: 0.85em;
            margin-top: 4px;
            display: block;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        input.error-input {
            border: 2px solid red;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- KIRI -->
        <div class="left">
            <img src="../../assets/img/logo.png" alt="Astronaut" />
            <h3>Lupa Password?</h3>
            <p>Masukkan email dan password barumu yaa 💌</p>
        </div>

        <!-- KANAN -->
        <div class="right">
            <div class="form-box">
                <h2>Reset Password</h2>
                <form action="forgot_proses.php" method="POST" onsubmit="return validateReset()">
                    <div class="form-group">
                        <input type="email" name="email" id="email" placeholder="Email terdaftar" />
                        <small class="error" id="err-email"></small>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password_baru" id="password_baru" placeholder="Password Baru" />
                        <small class="error" id="err-password"></small>
                    </div>
                    <div class="form-group">
                        <input type="password" name="konfirmasi" id="konfirmasi" placeholder="Konfirmasi Password Baru" />
                        <small class="error" id="err-konfirmasi"></small>
                    </div>
                    <button type="submit">Reset Password</button>
                </form>

                <p style="text-align:center; margin-top:1rem;">
                    Sudah ingat password? <a href="login.php" style="color: #285ad7;">Login di sini</a>
                </p>
            </div>
        </div>
    </div>

    <script>
        function validateReset() {
            let valid = true;
            const email = document.getElementById("email");
            const pass = document.getElementById("password_baru");
            const konfirmasi = document.getElementById("konfirmasi");

            document.querySelectorAll(".error").forEach(e => e.textContent = "");
            document.querySelectorAll("input").forEach(e => e.classList.remove("error-input"));

            if (!email.value.trim()) {
                showError(email, "Email wajib diisi");
                valid = false;
            } else if (!/^\S+@\S+\.\S+$/.test(email.value)) {
                showError(email, "Format email tidak valid");
                valid = false;
            }

            if (pass.value.length < 6) {
                showError(pass, "Password minimal 6 karakter");
                valid = false;
            }

            if (pass.value !== konfirmasi.value) {
                showError(konfirmasi, "Konfirmasi tidak cocok");
                valid = false;
            }

            return valid;
        }

        function showError(input, msg) {
            document.getElementById("err-" + input.id).textContent = msg;
            input.classList.add("error-input");
        }
    </script>
</body>

</html>