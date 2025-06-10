<?php
session_start();
// Pastikan pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Mengambil data pengguna dari basis data
$user_id = $_SESSION['user_id']; // ID pengguna yang disimpan dalam sesi

// Koneksi ke basis data
include '../../koneksi.php';

// Pastikan ID pengguna valid
if (is_numeric($user_id)) {
    $query = "SELECT * FROM users WHERE id = $user_id";
    $result = mysqli_query($db, $query);
    if ($result) {
        $user = mysqli_fetch_assoc($result);
    } else {
        echo "Error fetching user data: " . mysqli_error($conn);
        exit();
    }
} else {
    echo "Invalid user ID.";
    exit();
}

// Menangani pengeditan profil
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Mengambil data dari form dan mengamankan input
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);

    // Update data pengguna
    $update_query = "UPDATE users SET name='$name', email='$email', phone='$phone' WHERE id=$user_id";
    if (mysqli_query($conn, $update_query)) {
        // Redirect kembali ke halaman profil setelah berhasil mengubah
        header('Location: profile.php');
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Edit Profile</title>

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@700&family=Roboto&display=swap" rel="stylesheet" />

  <style>
    /* Reset and base */
    *, *::before, *::after {
      box-sizing: border-box;
    }

    body {
      margin: 0;
      font-family: 'Roboto', sans-serif;
      background: #ffffff;
      color: #6b7280;
      font-size: 18px;
      line-height: 1.5;
      -webkit-font-smoothing: antialiased;
      -moz-osx-font-smoothing: grayscale;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      align-items: center;
      padding: 4rem 1rem 4rem 1rem;
    }

    main {
      max-width: 900px;
      width: 100%;
    }

    h1 {
      font-family: 'Inter', sans-serif;
      font-weight: 800;
      font-size: 48px;
      color: #111827;
      margin-bottom: 1rem;
      text-align: center;
    }

    form {
      background: #f9fafb;
      border-radius: 12px;
      padding: 2.5rem 3rem;
      box-shadow: 0 4px 12px rgb(0 0 0 / 0.08);
      display: grid;
      gap: 2.5rem;
    }

    fieldset {
      border: none;
      padding: 0;
      margin: 0;
      display: grid;
      gap: 1.5rem;
    }

    legend {
      font-family: 'Inter', sans-serif;
      font-weight: 700;
      font-size: 24px;
      color: #111827;
      margin-bottom: 0.5rem;
      border-bottom: 2px solid #e5e7eb;
      padding-bottom: 0.25rem;
      width: max-content;
    }

    label {
      font-weight: 600;
      font-size: 14px;
      color: #6b7280;
      display: block;
      margin-bottom: 0.5rem;
      user-select: none;
    }

    input[type="text"],
    input[type="email"],
    input[type="tel"],
    input[type="file"],
    textarea {
      width: 100%;
      font-family: inherit;
      font-size: 16px;
      font-weight: 400;
      color: #374151;
      background: #fff;
      border: 1.5px solid #d1d5db;
      border-radius: 12px;
      padding: 0.8rem 1rem;
      transition: border-color 0.3s ease, box-shadow 0.3s ease;
      font-family: 'Roboto', sans-serif;
    }

    input[type="text"]:focus,
    input[type="email"]:focus,
    input[type="tel"]:focus,
    input[type="file"]:focus,
    textarea:focus {
      outline: none;
      border-color: #111827;
      box-shadow: 0 0 6px rgba(17, 24, 39, 0.15);
    }

    textarea {
      resize: vertical;
      min-height: 80px;
      max-height: 200px;
    }

    /* Profile photo */
    .profile-photo-group {
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 1rem;
      text-align: center;
    }

    .profile-photo-preview {
      width: 140px;
      height: 140px;
      border-radius: 50%;
      background-color: #e5e7eb;
      background-position: center;
      background-size: cover;
      background-repeat: no-repeat;
      box-shadow: 0 4px 10px rgb(0 0 0 / 0.1);
      user-select: none;
    }

    /* Documents accordion */
    .documents-container {
      display: flex;
      flex-direction: column;
      gap: 1rem;
    }

    .doc-item {
      border-radius: 12px;
      background: #ffffff;
      border: 1.5px solid #d1d5db;
      box-shadow: 0 2px 6px rgb(0 0 0 / 0.05);
      padding: 1rem 1.5rem;
      transition: border-color 0.3s ease, box-shadow 0.3s ease;
    }

    .doc-item:focus-within,
    .doc-item:hover {
      border-color: #111827;
      box-shadow: 0 4px 12px rgb(17 24 39 / 0.15);
    }

    .doc-label {
      font-weight: 600;
      font-size: 16px;
      margin-bottom: 0.5rem;
      color: #111827;
      user-select: none;
    }

    .doc-textarea {
      width: 100%;
      font-family: inherit;
      font-size: 16px;
      color: #374151;
      background: #f3f4f6;
      border: 1.5px solid #cbd5e1;
      border-radius: 8px;
      padding: 0.6rem 0.8rem;
      resize: vertical;
      min-height: 60px;
      max-height: 120px;
      transition: border-color 0.3s ease;
    }

    .doc-textarea:focus {
      outline: none;
      border-color: #111827;
      background: #fff;
    }

    /* Buttons container */
    .form-actions {
      display: flex;
      justify-content: flex-end;
      gap: 1rem;
      margin-top: 1rem;
    }

    button[type="submit"],
    button[type="button"] {
      background: #111827;
      border: none;
      color: #fff;
      font-weight: 700;
      font-size: 16px;
      padding: 0.75rem 1.75rem;
      border-radius: 12px;
      cursor: pointer;
      transition: background-color 0.3s ease;
      user-select: none;
    }

    button[type="submit"]:hover,
    button[type="button"]:hover,
    button[type="submit"]:focus,
    button[type="button"]:focus {
      background-color: #374151;
      outline: none;
    }

    /* Responsive */
    @media (max-width: 600px) {
      form {
        padding: 2rem 1.5rem;
      }
    }

  </style>
</head>

<body>
  <main>
    <h1>Edit Profile</h1>
    <form id="editProfileForm" novalidate>
      <!-- Profile Photo -->
      <fieldset class="profile-photo-group">
        <legend>Profile Photo</legend>
        <div aria-live="polite">
          <div id="photoPreview" class="profile-photo-preview" role="img" aria-label="Profile photo preview"></div>
        </div>
        <input type="file" id="profilePhotoInput" accept="image/*" aria-describedby="photoHelp" />
        <small id="photoHelp" style="color:#6b7280;">Choose a profile photo (PNG, JPG, JPEG). Max size 5MB.</small>
      </fieldset>

      <!-- Personal Details -->
      <fieldset>
        <legend>Personal Details</legend>
        <label for="fullName">Full Name</label>
        <input type="text" id="fullName" name="fullName" placeholder="Full name" required />

        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="Email address" required />

        <label for="phone">Phone</label>
        <input type="tel" id="phone" name="phone" placeholder="Phone number" required pattern="^[+]*[(]?[0-9]{1,4}[)]?[-\s./0-9]*$" />

        <label for="location">Location</label>
        <input type="text" id="location" name="location" placeholder="City, State, Country" />

        <label for="bio">Bio</label>
        <textarea id="bio" name="bio" placeholder="Write a short bio about yourself..."></textarea>
      </fieldset>

      <div class="form-actions">
        <button type="submit" aria-label="Save Profile Changes">Save Changes</button>
        <button type="button" id="resetBtn" aria-label="Reset Profile Form">Reset</button>
      </div>
    </form>
  </main>

  <script>
    const profilePhotoInput = document.getElementById('profilePhotoInput');
    const photoPreview = document.getElementById('photoPreview');
    const editProfileForm = document.getElementById('editProfileForm');
    const resetBtn = document.getElementById('resetBtn');

    // Load initial placeholder photo (optional)
    let currentPhotoURL = '';

    function setPhotoPreview(src) {
      if (src) {
        photoPreview.style.backgroundImage = `url('${src}')`;
      } else {
        photoPreview.style.backgroundImage = 'url(https://via.placeholder.com/140x140?text=Profile)';
      }
    }

    setPhotoPreview(currentPhotoURL);

    profilePhotoInput.addEventListener('change', () => {
      const file = profilePhotoInput.files[0];
      if (file && file.type.startsWith('image/')) {
        const reader = new FileReader();
        reader.onload = (e) => {
          setPhotoPreview(e.target.result);
        };
        reader.readAsDataURL(file);
      } else {
        // Reset preview if not image
        setPhotoPreview(currentPhotoURL);
      }
    });

    // Form submit handler - simulate save and validation
    editProfileForm.addEventListener('submit', (e) => {
      e.preventDefault();

      // Basic validation and alert simulate saving
      if (!editProfileForm.checkValidity()) {
        editProfileForm.reportValidity();
        return;
      }

      alert('Profile changes saved successfully!');
    });

    // Reset button - clear photo and form fields
    resetBtn.addEventListener('click', () => {
      editProfileForm.reset();
      setPhotoPreview(currentPhotoURL);
    });
  </script>
</body>

</html>