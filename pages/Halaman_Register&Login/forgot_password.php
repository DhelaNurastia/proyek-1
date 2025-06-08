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
        <h3>Lupa Password?</h3>
        <p>Masukkan email dan password barumu yaa 💌</p>
    </div>
    <div class="form-wrapper">
        <div class="form-container">
            <h2>Reset Password</h2>
            <form action="forgot_proses.php" method="POST" onsubmit="return validateReset()">
                <div class="form-group">
                    <div class="input-box">
                        <input type="email" name="email" id="email" placeholder="Email terdaftar" />
                        <small class="error" id="err-email"></small>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-box">
                        <input type="password" name="password_baru" id="password_baru" placeholder="Password Baru" />
                        <small class="error" id="err-password"></small>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-box">
                        <input type="password" name="konfirmasi" id="konfirmasi" placeholder="Konfirmasi Password Baru" />
                        <small class="error" id="err-konfirmasi"></small>
                    </div>
                </div>

                <div class="submit-button">
                    <button type="submit" aria-label="Reset">Reset Password</button>
            </form>

            <p style="text-align:center; margin-top:1rem;">
                Sudah ingat password? <a href="login.php" style="color: #285ad7;">Login di sini</a>
            </p>
        </div>
    </div>

    <!-- VALIDASI JAVASCRIPT -->
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