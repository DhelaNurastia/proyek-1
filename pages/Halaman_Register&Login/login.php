
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .header {
            background-color: #000957;
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
            justify-content: center;
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
        <h3>Selamat Datang Kembali!</h3>
        <p> Masuk ke akunmu dan lanjutkan petualangan 🚀</p>
    </div>
    <div class="form-wrapper">
        <div class="form-container">
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
                    <div class="input-box">
                        <input type="text" name="nama" id="nama" placeholder="Username" />
                        <small class="error" id="err-nama"></small>
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-box">
                        <input type="password" name="password" id="password" placeholder="Password" />
                        <small class="error" id="err-password"></small>
                    </div>
                </div>

                <div class="submit-button">
                    <button type="submit" aria-label="Daftar">Daftar</button>
            </form>

            <p style="text-align: center; margin-top: 1rem;">
                <a href="forgot_password.php" style="color: #285ad7;">Lupa Password?</a>
            </p>

            <p style="text-align: center; margin-top: 1rem;">
                Belum punya akun? <a href="register.php" style="color: #285ad7;">Daftar yuk!</a>
            </p>
        </div>
    </div>

    <!-- VALIDASI JAVASCRIPT -->
    <script>
        function validateLogin() {
            let valid = true;

            const nama = document.getElementById("nama");
            const password = document.getElementById("password");

            // Reset
            document.querySelectorAll(".error").forEach(el => el.textContent = "");
            document.querySelectorAll("input").forEach(el => el.classList.remove("error-input"));

            if (email.value.trim() === "") {
                showError(nama, "Username wajib diisi");
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