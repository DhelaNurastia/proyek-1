<?php 
$base_url = '/proyek-1/'
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <title>Starter Page - Strategy Bootstrap Template</title>
  <meta name="description" content="" />
  <meta name="keywords" content="" />

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon" />
  <link href="<?= $base_url ?>assets/template/home/Strategy/assets/img/apple-touch-icon.png" rel="apple-touch-icon" />

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect" />
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Nunito+Sans:ital,wght@0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,600;1,700;1,800;1,900&family=Inter:wght@600;700&display=swap" rel="stylesheet" />

  <!-- Vendor CSS Files -->
  <link href="<?= $base_url ?>assets/template/home/Strategy/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
  <link href="<?= $base_url ?>assets/template/home/Strategy/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet" />
  <link href="<?= $base_url ?>assets/template/home/Strategy/assets/vendor/aos/aos.css" rel="stylesheet" />
  <link href="<?= $base_url ?>assets/template/home/Strategy/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet" />
  <link href="<?= $base_url ?>assets/template/home/Strategy/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet" />

  <!-- Main CSS File -->
  <link href="<?= $base_url ?>assets/template/home/Strategy/assets/css/main.css" rel="stylesheet" />

  <style>
    /* Profile Section Styles Scoped */
    .profile-section {
      padding-top: 4rem;
      padding-bottom: 5rem;
      background: transparent;
      font-family: 'Roboto', sans-serif;
      color: #fff;
    }

    .profile-section h1,
    .profile-section h2,
    .profile-section h3 {
      font-family: 'Inter', sans-serif;
      color: #fff;
      font-weight: 700;
      margin-top: 0;
    }

    .profile-section h1 {
      font-size: 3rem;
      font-weight: 800;
      line-height: 1.1;
      margin-bottom: 0.5rem;
    }

    .profile-section h2 {
      font-size: 2rem;
      margin-bottom: 1rem;
    }

    .profile-section h3 {
      font-size: 1.5rem;
      margin-bottom: 1rem;
    }

    /* Profile Hero with two buttons side by side */
    .profile-hero {
      text-align: center;
      max-width: 600px;
      margin-left: auto;
      margin-right: auto;
      padding-bottom: 3rem;
      border-bottom: 1px solid rgba(255 255 255 / 0.15);
      background: transparent;
      box-shadow: none;
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 1.5rem;
    }

    .profile-avatar {
      width: 140px;
      height: 140px;
      border-radius: 50%;
      object-fit: cover;
      box-shadow: 0 8px 20px rgba(255 255 255 / 0.3);
      margin-bottom: 0;
      background: transparent;
      border: 2px solid #fff;
    }

    .profile-role {
      font-size: 1.25rem;
      font-weight: 600;
      color: #ddd;
      margin-bottom: 1.0rem;
    }

    .profile-cta {
      margin-top: 0;
      display: flex;
      gap: 1rem;
      flex-wrap: wrap;
      justify-content: center;
      width: 100%;
      max-width: 300px;
    }

    .btn-primary {
      background-color: #111827;
      color: #fff;
      font-weight: 700;
      font-size: 1rem;
      border: none;
      border-radius: 0.75rem;
      padding: 0.75rem 1.5rem;
      cursor: pointer;
      transition: background-color 0.3s ease;
      text-align: center;
      flex: 1 1 auto;
      min-width: 120px;
    }

    .btn-primary:hover,
    .btn-primary:focus {
      background-color: #374151;
      outline: none;
    }

    .info-cards {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
      gap: 2rem;
      margin-top: 3rem;
      background: transparent;
      /* Override text color to white inside cards */
      color: #fff;
    }

    /* Cards with background and shadow */
    .card {
      background: #374151;
      border-radius: 0.75rem;
      padding: 2rem;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
      display: flex;
      flex-direction: column;
      gap: 1rem;
      transition: box-shadow 0.3s ease;
      color: #fff; /* Set white text for all text in these cards */
    }

    /* Override card text color to black */
    .card h3,
    .card label,
    .card div.value,
    .document-list,
    .document-list li {
      color: #fff !important;
    }

    /* But personal detail and document cards text white */
    /* Since the user wants all text in Personal Details and Documents cards white */
    /* We already set card text to white */

    .card:hover {
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }

    .card label {
      font-weight: 600;
      font-size: 0.875rem;
      text-transform: uppercase;
      letter-spacing: 0.05em;
    }

    .document-list {
      list-style: none;
      padding-left: 0;
      margin: 0;
      background: transparent;
    }

    .document-list li {
      font-size: 1.125rem;
      font-weight: 600;
      padding: 0.35rem 0;
      border-bottom: 1px solid rgba(0, 0, 0, 0.1);
    }

    .document-list li:last-child {
      border-bottom: none;
    }

    .rental-history {
      margin-top: 3rem;
      color: #111827; /* rental history text dark */
    }

    .rental-history h2 {
      font-family: 'Inter', sans-serif;
      font-weight: 700;
      font-size: 2rem;
      margin-bottom: 1rem;
      color: #111827;
    }

    .rental-list {
      list-style: none;
      margin: 0;
      padding: 0;
      display: grid;
      grid-template-columns: 1fr;
      gap: 1.5rem;
      background: transparent;
    }

    /* Rental history cards with background */
    .rental-item {
      background: #f9fafb;
      border-radius: 0.75rem;
      padding: 1.5rem 2rem;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
      display: flex;
      justify-content: space-between;
      align-items: center;
      transition: box-shadow 0.3s ease;
      cursor: default;
      color: #111827;
    }

    .rental-item:hover {
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }

    .rental-details {
      display: flex;
      flex-direction: column;
      gap: 0.25rem;
    }

    .car-model {
      font-weight: 700;
      font-size: 1.125rem;
    }

    .rental-date {
      font-size: 0.875rem;
      color: #6b7280;
    }

    .rental-status {
      font-weight: 600;
      border-radius: 9999px;
      padding: 0.25rem 0.75rem;
      font-size: 0.875rem;
      color: #fff;
      background-color: #10b981;
      user-select: none;
    }

    .rental-status.pending {
      background-color: #f59e0b;
    }

    /* Contact form with transparent background, white text */
    .contact-section {
      background: transparent;
      margin-top: 3rem;
      color: #fff;
    }

    .contact-section h2 {
      color: #fff;
    }

    .contact-section form {
      max-width: 400px;
      margin: 0 auto;
      display: flex;
      flex-direction: column;
      gap: 1rem;
      background: transparent;
      color: #fff;
    }

    .form-group {
      display: flex;
      flex-direction: column;
      gap: 0.25rem;
      background: transparent;
      color: #fff;
    }

    .profile-section label {
      font-weight: 600;
      font-size: 0.875rem;
      color: #ddd;
    }

    .profile-section input,
    .profile-section textarea {
      padding: 0.75rem 1rem;
      border-radius: 0.75rem;
      border: 1px solid #555;
      font-size: 1rem;
      font-family: inherit;
      transition: border-color 0.3s ease;
      resize: vertical;
      background: #222;
      color: #fff;
    }

    .profile-section input::placeholder,
    .profile-section textarea::placeholder {
      color: #aaa;
    }

    .profile-section input:focus,
    .profile-section textarea:focus {
      outline: none;
      border-color: #fff;
      box-shadow: 0 0 0 3px rgba(255 255 255 / 0.3);
      background: #111;
      color: #fff;
    }

    .submit-btn {
      background-color: #111827;
      color: #fff;
      border: none;
      border-radius: 0.75rem;
      font-weight: 700;
      font-size: 1rem;
      padding: 0.75rem 1.5rem;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .submit-btn:hover,
    .submit-btn:focus {
      background-color: #374151;
      outline: none;
    }

    @media (max-width: 600px) {
      .profile-section h1 {
        font-size: 2.25rem;
      }

      .profile-avatar {
        width: 100px;
        height: 100px;
      }

      .profile-hero {
        max-width: 100%;
      }
    }
  </style>
</head>

<body class="starter-page-page">
  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="header-container container-fluid container-xl position-relative d-flex align-items-center justify-content-between">
      <a href="index.html" class="logo d-flex align-items-center me-auto me-xl-0">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="assets/img/logo.webp" alt=""> -->
        <h1 class="sitename">Strategy</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="#hero">Home</a></li>
          <li><a href="#about">About</a></li>
          <li><a href="#services">Services</a></li>
          <li><a href="#portfolio">Portfolio</a></li>
          <li><a href="#team">Team</a></li>
          <li class="dropdown"><a href="#"><span>Dropdown</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
              <li><a href="#">Dropdown 1</a></li>
              <li class="dropdown"><a href="#"><span>Deep Dropdown</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                <ul>
                  <li><a href="#">Deep Dropdown 1</a></li>
                  <li><a href="#">Deep Dropdown 2</a></li>
                  <li><a href="#">Deep Dropdown 3</a></li>
                  <li><a href="#">Deep Dropdown 4</a></li>
                  <li><a href="#">Deep Dropdown 5</a></li>
                </ul>
              </li>
              <li><a href="#">Dropdown 2</a></li>
              <li><a href="#">Dropdown 3</a></li>
              <li><a href="#">Dropdown 4</a></li>
            </ul>
          </li>
          <li><a href="#contact">Contact</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

      <a class="btn-getstarted" href="#about">Get Started</a>
    </div>
  </header>

  <main class="main">
    <!-- Page Title -->
    <div class="page-title dark-background" data-aos="fade">
      <div class="container position-relative">
        <h1>Starter Page</h1>
        <p>Esse dolorum voluptatum ullam est sint nemo et est ipsa porro placeat quibusdam quia assumenda numquam molestias.</p>
        <nav class="breadcrumbs">
          <ol>
            <li><a href="index.html">Home</a></li>
            <li class="current">Starter Page</li>
          </ol>
        </nav>
      </div>
    </div>
    <!-- End Page Title -->

    <!-- Starter Section Section -->
    <section id="starter-section" class="starter-section section">
      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Starter Section</h2>
        <div><span>Check Our</span> <span class="description-title">Starter Section</span></div>
      </div>
      <!-- End Section Title -->

      <div class="container" data-aos="fade-up">
        <p>Use this page as a starter for your own custom pages.</p>
      </div>
    </section>
    <!-- /Starter Section Section -->

    <!-- Profile Section Inserted Below Starter Section -->
    <section class="profile-section container" aria-label="User Profile">
      <section class="profile-hero" aria-label="User Profile Introduction">
        <img src="https://randomuser.me/api/portraits/men/56.jpg" alt="Profile Picture of John Doe" class="profile-avatar" />
        <h1 class="profile-name">John Doe</h1>
        <p class="profile-role">Premium Member</p>
        <p class="profile-bio">
          Passionate about exploring new destinations and driving the best cars. Renting made easy and reliable with CarRental.
        </p>
        <div class="profile-cta">
          <button class="btn-primary" aria-label="Edit Profile">Edit Profile</button>
          <button class="btn-primary" aria-label="View Rental History" id="btnRentalHistory">Rental History</button>
        </div>
      </section>

      <section class="profile-info" aria-label="User Personal Information">
        <div class="info-cards">
          <article class="card">
            <h3>Personal Details</h3>
            <label>Full Name</label>
            <div class="value">Johnathan Doe</div>

            <label>Email</label>
            <div class="value">john.doe@example.com</div>

            <label>Phone</label>
            <div class="value">+1 234 567 8901</div>

            <label>Location</label>
            <div class="value">San Francisco, CA, USA</div>
          </article>

          <article class="card">
            <h3>Documents</h3>
            <ul class="document-list" role="list">
              <li>KK</li>
              <li>KTP</li>
              <li>SIM</li>
            </ul>
          </article>
        </div>
      </section>

      <section class="contact-section" aria-label="Contact Form">
        <h2>Contact Support</h2>
        <form action="#" method="post" novalidate>
          <div class="form-group">
            <label for="contact-subject">Subject</label>
            <input id="contact-subject" name="subject" type="text" placeholder="Subject" required />
          </div>
          <div class="form-group">
            <label for="contact-message">Message</label>
            <textarea id="contact-message" name="message" rows="4" placeholder="Write your message here..." required></textarea>
          </div>
          <button class="submit-btn" type="submit">Send Message</button>
        </form>
      </section>
    </section>
  </main>

  <footer id="footer" class="footer">
    <div class="container footer-top">
      <div class="row gy-4">
        <div class="col-lg-5 col-md-12 footer-about">
          <a href="index.html" class="logo d-flex align-items-center">
            <span class="sitename">Strategy</span>
          </a>
          <p>Cras fermentum odio eu feugiat lide par naso tierra. Justo eget nada terra videa magna derita valies darta donna mare fermentum iaculis eu non diam phasellus.</p>
          <div class="social-links d-flex mt-4">
            <a href=""><i class="bi bi-twitter-x"></i></a>
            <a href=""><i class="bi bi-facebook"></i></a>
            <a href=""><i class="bi bi-instagram"></i></a>
            <a href=""><i class="bi bi-linkedin"></i></a>
          </div>
        </div>

        <div class="col-lg-2 col-6 footer-links">
          <h4>Useful Links</h4>
          <ul>
            <li><a href="#">Home</a></li>
            <li><a href="#">About us</a></li>
            <li><a href="#">Services</a></li>
            <li><a href="#">Terms of service</a></li>
            <li><a href="#">Privacy policy</a></li>
          </ul>
        </div>

        <div class="col-lg-2 col-6 footer-links">
          <h4>Our Services</h4>
          <ul>
            <li><a href="#">Web Design</a></li>
            <li><a href="#">Web Development</a></li>
            <li><a href="#">Product Management</a></li>
            <li><a href="#">Marketing</a></li>
            <li><a href="#">Graphic Design</a></li>
          </ul>
        </div>

        <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">
          <h4>Contact Us</h4>
          <p>A108 Adam Street</p>
          <p>New York, NY 535022</p>
          <p>United States</p>
          <p class="mt-4"><strong>Phone:</strong> <span>+1 5589 55488 55</span></p>
          <p><strong>Email:</strong> <span>info@example.com</span></p>
        </div>
      </div>
    </div>

    <div class="container copyright text-center mt-4">
      <p>© <span>Copyright</span> <strong class="px-1 sitename">Strategy</strong> <span>All Rights Reserved</span></p>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you've purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
      </div>
    </div>
  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="<?= $base_url ?>assets/template/home/Strategy/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?= $base_url ?>assets/template/home/Strategy/assets/vendor/php-email-form/validate.js"></script>
  <script src="<?= $base_url ?>assets/template/home/Strategy/assets/vendor/aos/aos.js"></script>
  <script src="<?= $base_url ?>assets/template/home/Strategy/assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="<?= $base_url ?>assets/template/home/Strategy/assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="<?= $base_url ?>assets/template/home/Strategy/assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
  <script src="<?= $base_url ?>assets/template/home/Strategy/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>

  <!-- Main JS File -->
  <script src="<?= $base_url ?>assets/template/home/Strategy/assets/js/main.js"></script>

  <script>
    // Smooth scroll to rental history
    document.getElementById('btnRentalHistory').addEventListener('click', function () {
      document.getElementById('rentalHistorySection').scrollIntoView({ behavior: 'smooth' });
    });
  </script>
</body>

</html>