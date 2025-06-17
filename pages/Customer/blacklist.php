<?php
session_start();
require_once '../../koneksi.php';
$base_url = '/proyek-1/';

if (!isset($_SESSION['user_id'])) {
  header("Location: ../auth/login.php");
  exit;
}

$userId = $_SESSION['user_id'];
$query = $db->prepare("SELECT u.nama_lengkap, u.nama, u.email, u.telepon, u.alamat, u.foto_profile, d.file_kk, d.file_ktp, d.file_sim, u.blacklist
                      FROM users u
                      LEFT JOIN dokumen_user d ON u.id = d.id_user
                      WHERE u.id = ?");
$query->bind_param("i", $userId);
$query->execute();
$result = $query->get_result();
$user = $result->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Account Blacklisted - Trading Platform</title>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
  <style>
    /* Modern dark theme base */
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap');

    :root {
      --bg-color: #1f2937; /* Gray 800 */
      --card-bg: #111827; /* Gray 900 */
      --text-primary: #f3f4f6; /* Gray 100 */
      --text-secondary: #9ca3af; /* Gray 400 */
      --danger: #ef4444; /* Red 500 */
      --danger-light: #fca5a5; /* Red 300 */
      --button-bg: #dc2626; /* Red 600 */
      --button-hover: #b91c1c; /* Red 700 */
    }

    * {
      box-sizing: border-box;
    }

    body, html {
      margin: 0;
      padding: 0;
      font-family: 'Inter', sans-serif;
      background-color: var(--bg-color);
      color: var(--text-primary);
      height: 100%;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 16px;
      min-height: 100vh;
    }

    main {
      background-color: var(--card-bg);
      border-radius: 16px;
      padding: 48px 40px 56px 40px;
      max-width: 480px;
      width: 100%;
      box-shadow: 0 12px 24px rgba(0, 0, 0, 0.7);
      display: flex;
      flex-direction: column;
      align-items: center;
      text-align: center;
      gap: 24px;
    }

    .icon-container {
      background-color: var(--danger-light);
      border-radius: 50%;
      width: 96px;
      height: 96px;
      display: flex;
      justify-content: center;
      align-items: center;
      margin-bottom: 8px;
      flex-shrink: 0;
    }

    .icon-container .material-icons {
      color: var(--danger);
      font-size: 56px;
    }

    h1 {
      font-weight: 700;
      font-size: 2.5rem;
      margin: 0;
      color: var(--danger);
      letter-spacing: -0.02em;
    }

    p {
      font-weight: 400;
      font-size: 1.125rem;
      margin: 0;
      color: var(--text-secondary);
      line-height: 1.5;
      max-width: 360px;
    }

    .actions {
      margin-top: 16px;
      width: 100%;
      display: flex;
      justify-content: center;
      gap: 16px;
      flex-wrap: wrap;
    }

    button, a.button-link {
      cursor: pointer;
      padding: 14px 32px;
      font-weight: 600;
      font-size: 1rem;
      border-radius: 12px;
      border: none;
      text-decoration: none;
      text-align: center;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
      background-color: var(--button-bg);
      color: white;
      box-shadow: 0 6px 12px rgba(220,38,38,0.5);
      transition: background-color 0.3s ease;
      user-select: none;
      min-width: 160px;
      flex-shrink: 0;
    }

    button:hover, a.button-link:hover,
    button:focus-visible, a.button-link:focus-visible {
      background-color: var(--button-hover);
      outline: none;
    }

    .material-icons.button-icon {
      font-size: 20px;
    }

    @media (max-width: 480px) {
      main {
        padding: 32px 24px 40px 24px;
      }
      
      h1 {
        font-size: 2rem;
      }
      
      p {
        font-size: 1rem;
        max-width: 100%;
      }
      
      button, a.button-link {
        min-width: 100%;
      }
    }
  </style>
</head>
<body>
  <main role="alert" aria-live="assertive" aria-labelledby="blacklist-title" aria-describedby="blacklist-desc">
    <div class="icon-container" aria-hidden="true">
      <span class="material-icons" aria-hidden="true">block</span>
    </div>
    <h1 id="blacklist-title">Akun Anda Telah Di-Blacklist</h1>
    <p id="blacklist-desc">
      Kami menyesal memberitahukan bahwa akun Anda telah diblokir karena pelanggaran kebijakan kami. 
      Jika Anda merasa ini adalah kesalahan, silakan hubungi tim dukungan kami untuk informasi lebih lanjut.
    </p>
    <div class="actions">
      <a href="https://wa.me/6281212280564" class="button-link" target="_blank" rel="noopener noreferrer" aria-label="Hubungi Dukungan melalui WhatsApp">
        <span class="material-icons button-icon" aria-hidden="true">support_agent</span>
        Hubungi Dukungan
      </a>
      <button type="button" onclick="handleLogout()" aria-label="Keluar dari akun Anda">
        <span class="material-icons button-icon" aria-hidden="true">logout</span>
        Keluar
      </button>
    </div>
  </main>

  <script>
    function handleLogout() {
      // Placeholder logout function - redirect to login or homepage
      // In real application, clear auth tokens and session here
      window.location.href = 'index.php';
    }
  </script>
</body>
</html>