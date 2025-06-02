<?php
$base_url = '/Sigma RentCar/';
?>


<!doctype html>
<html lang="en">

  <head>
    <title>Sigma RentCar - Daftar Mobil</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700;900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="<?= $base_url ?>assets/template/listing/fonts/icomoon/style.css">

    <link rel="stylesheet" href="<?= $base_url ?>assets/template/listing/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= $base_url ?>assets/template/listing/css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="<?= $base_url ?>assets/template/listing/css/jquery.fancybox.min.css">
    <link rel="stylesheet" href="<?= $base_url ?>assets/template/listing/css/owl.carousel.min.css">
    <link rel="stylesheet" href="<?= $base_url ?>assets/template/listing/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="<?= $base_url ?>assets/template/listing/fonts/flaticon/font/flaticon.css">
    <link rel="stylesheet" href="<?= $base_url ?>assets/template/listing/css/aos.css">

    <!-- MAIN CSS -->
    <link rel="stylesheet" href="<?= $base_url ?>assets/template/listing/css/style.css">

  </head>

  <body>

    
    <div class="site-wrap" id="home-section">

      <div class="site-mobile-menu site-navbar-target">
        <div class="site-mobile-menu-header">
          <div class="site-mobile-menu-close mt-3">
            <span class="icon-close2 js-menu-toggle"></span>
          </div>
        </div>
        <div class="site-mobile-menu-body"></div>
      </div>      
      <div class="hero inner-page" style="background-image: url('images/hero_1_a.jpg');">
        
        <div class="container">
          <div class="row align-items-end ">
            <div class="col-lg-5">

              <div class="intro">
                <h1><strong>Listings</strong></h1>
                <div class="custom-breadcrumbs"><a href="index.php">Home</a> <span class="mx-2">/</span> <strong>Listings</strong></div>
              </div>

            </div>
          </div>
        </div>
      </div>
<div class="site-section bg-light">
  <div class="container">
    <div class="row">
      <div class="col-lg-7">
        <h2 class="section-heading"><strong>Car Listings</strong></h2>
        <p class="mb-5">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>    
      </div>
    </div>

    <!-- PAGE 1 -->
    <div id="page1" class="listing-page row">
      <div class="col-md-6 col-lg-4 mb-4">
        <!-- mobil 1 -->
        <div class="listing d-block align-items-stretch">
          <div class="listing-img h-100 mr-4">
            <img src="<?= $base_url ?>assets/template/listing/images/car_6.jpg" alt="Image" class="img-fluid">
          </div>
          <div class="listing-contents h-100">
            <h3>Mitsubishi Pajero</h3>
            <div class="rent-price"><strong>$389.00</strong><span class="mx-1">/</span>day</div>
            <div class="d-block d-md-flex mb-3 border-bottom pb-3">
              <div class="listing-feature pr-4"><span class="caption">Luggage:</span><span class="number">8</span></div>
              <div class="listing-feature pr-4"><span class="caption">Doors:</span><span class="number">4</span></div>
              <div class="listing-feature pr-4"><span class="caption">Passenger:</span><span class="number">4</span></div>
            </div>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quos eos at eum, voluptatem quibusdam.</p>
            <p><a href="#" class="btn btn-primary btn-sm">Rent Now</a></p>
          </div>
        </div>
      </div>

      <div class="col-md-6 col-lg-4 mb-4">
        <!-- mobil 2 -->
        <div class="listing d-block align-items-stretch">
          <div class="listing-img h-100 mr-4">
            <img src="<?= $base_url ?>assets/template/listing/images/car_5.jpg" alt="Image" class="img-fluid">
          </div>
          <div class="listing-contents h-100">
            <h3>Nissan Moco</h3>
            <div class="rent-price"><strong>$389.00</strong><span class="mx-1">/</span>day</div>
            <div class="d-block d-md-flex mb-3 border-bottom pb-3">
              <div class="listing-feature pr-4"><span class="caption">Luggage:</span><span class="number">8</span></div>
              <div class="listing-feature pr-4"><span class="caption">Doors:</span><span class="number">4</span></div>
              <div class="listing-feature pr-4"><span class="caption">Passenger:</span><span class="number">4</span></div>
            </div>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quos eos at eum, voluptatem quibusdam.</p>
            <p><a href="#" class="btn btn-primary btn-sm">Rent Now</a></p>
          </div>
        </div>
      </div>

      <div class="col-md-6 col-lg-4 mb-4">
        <!-- mobil 3 -->
        <div class="listing d-block align-items-stretch">
          <div class="listing-img h-100 mr-4">
            <img src="<?= $base_url ?>assets/template/listing/images/car_4.jpg" alt="Image" class="img-fluid">
          </div>
          <div class="listing-contents h-100">
            <h3>Honda Fitta</h3>
            <div class="rent-price"><strong>$389.00</strong><span class="mx-1">/</span>day</div>
            <div class="d-block d-md-flex mb-3 border-bottom pb-3">
              <div class="listing-feature pr-4"><span class="caption">Luggage:</span><span class="number">8</span></div>
              <div class="listing-feature pr-4"><span class="caption">Doors:</span><span class="number">4</span></div>
              <div class="listing-feature pr-4"><span class="caption">Passenger:</span><span class="number">4</span></div>
            </div>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quos eos at eum, voluptatem quibusdam.</p>
            <p><a href="#" class="btn btn-primary btn-sm">Rent Now</a></p>
          </div>
        </div>
      </div>
    </div>

    <!-- PAGE 2 -->
    <div id="page2" class="listing-page row" style="display:none;">
      <div class="col-md-6 col-lg-4 mb-4">
        <!-- mobil 4 -->
        <div class="listing d-block align-items-stretch">
          <div class="listing-img h-100 mr-4">
            <img src="<?= $base_url ?>assets/template/listing/images/car_3.jpg" alt="Image" class="img-fluid">
          </div>
          <div class="listing-contents h-100">
            <h3>Skoda Laura</h3>
            <div class="rent-price"><strong>$389.00</strong><span class="mx-1">/</span>day</div>
            <div class="d-block d-md-flex mb-3 border-bottom pb-3">
              <div class="listing-feature pr-4"><span class="caption">Luggage:</span><span class="number">8</span></div>
              <div class="listing-feature pr-4"><span class="caption">Doors:</span><span class="number">4</span></div>
              <div class="listing-feature pr-4"><span class="caption">Passenger:</span><span class="number">4</span></div>
            </div>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quos eos at eum, voluptatem quibusdam.</p>
            <p><a href="#" class="btn btn-primary btn-sm">Rent Now</a></p>
          </div>
        </div>
      </div>

      <div class="col-md-6 col-lg-4 mb-4">
        <!-- mobil 5 -->
        <div class="listing d-block align-items-stretch">
          <div class="listing-img h-100 mr-4">
            <img src="<?= $base_url ?>assets/template/listing/images/car_2.jpg" alt="Image" class="img-fluid">
          </div>
          <div class="listing-contents h-100">
            <h3>Mazda LaPuta</h3>
            <div class="rent-price"><strong>$389.00</strong><span class="mx-1">/</span>day</div>
            <div class="d-block d-md-flex mb-3 border-bottom pb-3">
              <div class="listing-feature pr-4"><span class="caption">Luggage:</span><span class="number">8</span></div>
              <div class="listing-feature pr-4"><span class="caption">Doors:</span><span class="number">4</span></div>
              <div class="listing-feature pr-4"><span class="caption">Passenger:</span><span class="number">4</span></div>
            </div>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quos eos at eum, voluptatem quibusdam.</p>
            <p><a href="#" class="btn btn-primary btn-sm">Rent Now</a></p>
          </div>
        </div>
      </div>

      <div class="col-md-6 col-lg-4 mb-4">
        <!-- mobil 6 -->
        <div class="listing d-block align-items-stretch">
          <div class="listing-img h-100 mr-4">
            <img src="<?= $base_url ?>assets/template/listing/images/car_1.jpg" alt="Image" class="img-fluid">
          </div>
          <div class="listing-contents h-100">
            <h3>Buick LaCrosse</h3>
            <div class="rent-price"><strong>$389.00</strong><span class="mx-1">/</span>day</div>
            <div class="d-block d-md-flex mb-3 border-bottom pb-3">
              <div class="listing-feature pr-4"><span class="caption">Luggage:</span><span class="number">8</span></div>
              <div class="listing-feature pr-4"><span class="caption">Doors:</span><span class="number">4</span></div>
              <div class="listing-feature pr-4"><span class="caption">Passenger:</span><span class="number">4</span></div>
            </div>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quos eos at eum, voluptatem quibusdam.</p>
            <p><a href="#" class="btn btn-primary btn-sm">Rent Now</a></p>
          </div>
        </div>
      </div>
    </div>

    <!-- Pagination -->
    <div class="row">
      <div class="col-5">
        <div class="custom-pagination">
          <a href="#page1">1</a>
          <a href="#page2">2</a>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  // Fungsi pagination klik link
  document.querySelectorAll('.custom-pagination a').forEach(link => {
    link.addEventListener('click', function(e) {
      e.preventDefault(); // cegah default scroll ke anchor

      const targetId = this.getAttribute('href').substring(1); // dapatkan id tanpa #

      // sembunyikan semua halaman listing
      document.querySelectorAll('.listing-page').forEach(page => {
        page.style.display = 'none';
      });

      // tampilkan halaman yang dipilih
      document.getElementById(targetId).style.display = 'flex'; // karena .row pakai flex

      // scroll halus ke atas container listing
      document.getElementById(targetId).scrollIntoView({behavior: 'smooth'});
    });
  });
</script>

    <div class="site-section">
      <div class="container">
        <div class="row">
          <div class="col-lg-7">
            <h2 class="section-heading"><strong>Testimonials</strong></h2>
            <p class="mb-5">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>    
          </div>
        </div>
        <div class="row">
          <div class="col-lg-4 mb-4 mb-lg-0">
            <div class="testimonial-2">
              <blockquote class="mb-4">
                <p>"Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatem, deserunt eveniet veniam. Ipsam, nam, voluptatum"</p>
              </blockquote>
              <div class="d-flex v-card align-items-center">
                <img src="<?= $base_url ?>assets/template/listing/images/person_1.jpg" alt="Image" class="img-fluid mr-3">
                <div class="author-name">
                  <span class="d-block">Mike Fisher</span>
                  <span>Owner, Ford</span>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 mb-4 mb-lg-0">
            <div class="testimonial-2">
              <blockquote class="mb-4">
                <p>"Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatem, deserunt eveniet veniam. Ipsam, nam, voluptatum"</p>
              </blockquote>
              <div class="d-flex v-card align-items-center">
                <img src="<?= $base_url ?>assets/template/listing/images/person_2.jpg" alt="Image" class="img-fluid mr-3">
                <div class="author-name">
                  <span class="d-block">Jean Stanley</span>
                  <span>Traveler</span>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 mb-4 mb-lg-0">
            <div class="testimonial-2">
              <blockquote class="mb-4">
                <p>"Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatem, deserunt eveniet veniam. Ipsam, nam, voluptatum"</p>
              </blockquote>
              <div class="d-flex v-card align-items-center">
                <img src="<?= $base_url ?>assets/template/listing/images/person_3.jpg" alt="Image" class="img-fluid mr-3">
                <div class="author-name">
                  <span class="d-block">Katie Rose</span>
                  <span >Customer</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="site-section bg-primary py-5">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-7 mb-4 mb-md-0">
            <h2 class="mb-0 text-white">What are you waiting for?</h2>
            <p class="mb-0 opa-7">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Obcaecati, laboriosam.</p>
          </div>
          <div class="col-lg-5 text-md-right">
            <a href="#" class="btn btn-primary btn-white">Rent a car now</a>
          </div>
        </div>
      </div>
    </div>

      
      <footer class="site-footer">
        <div class="container">
          <div class="row">
            <div class="col-lg-3">
              <h2 class="footer-heading mb-4">About Us</h2>
              <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. </p>
              <ul class="list-unstyled social">
                <li><a href="#"><span class="icon-facebook"></span></a></li>
                <li><a href="#"><span class="icon-instagram"></span></a></li>
                <li><a href="#"><span class="icon-twitter"></span></a></li>
                <li><a href="#"><span class="icon-linkedin"></span></a></li>
              </ul>
            </div>
            <div class="col-lg-8 ml-auto">
              <div class="row">
                <div class="col-lg-3">
                  <h2 class="footer-heading mb-4">Quick Links</h2>
                  <ul class="list-unstyled">
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Testimonials</a></li>
                    <li><a href="#">Terms of Service</a></li>
                    <li><a href="#">Privacy</a></li>
                    <li><a href="#">Contact Us</a></li>
                  </ul>
                </div>
                <div class="col-lg-3">
                  <h2 class="footer-heading mb-4">Resources</h2>
                  <ul class="list-unstyled">
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Testimonials</a></li>
                    <li><a href="#">Terms of Service</a></li>
                    <li><a href="#">Privacy</a></li>
                    <li><a href="#">Contact Us</a></li>
                  </ul>
                </div>
                <div class="col-lg-3">
                  <h2 class="footer-heading mb-4">Support</h2>
                  <ul class="list-unstyled">
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Testimonials</a></li>
                    <li><a href="#">Terms of Service</a></li>
                    <li><a href="#">Privacy</a></li>
                    <li><a href="#">Contact Us</a></li>
                  </ul>
                </div>
                <div class="col-lg-3">
                  <h2 class="footer-heading mb-4">Company</h2>
                  <ul class="list-unstyled">
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Testimonials</a></li>
                    <li><a href="#">Terms of Service</a></li>
                    <li><a href="#">Privacy</a></li>
                    <li><a href="#">Contact Us</a></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <div class="row pt-5 mt-5 text-center">
            <div class="col-md-12">
              <div class="border-top pt-5">
                <p>
              <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
              Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="icon-heart text-danger" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank" >Colorlib</a>
              <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
              </p>
              </div>
            </div>

          </div>
        </div>
      </footer>

    </div>

    <script src="<?= $base_url ?>/template/listing/js/jquery-3.3.1.min.js"></script>
    <script src="<?= $base_url ?>assets/template/listing/js/popper.min.js"></script>
    <script src="<?= $base_url ?>assets/template/listing/js/bootstrap.min.js"></script>
    <script src="<?= $base_url ?>assets/template/listing/js/owl.carousel.min.js"></script>
    <script src="<?= $base_url ?>assets/template/listing/js/jquery.sticky.js"></script>
    <script src="<?= $base_url ?>assets/template/listing/js/jquery.waypoints.min.js"></script>
    <script src="<?= $base_url ?>assets/template/listing/js/jquery.animateNumber.min.js"></script>
    <script src="<?= $base_url ?>assets/template/listing/js/jquery.fancybox.min.js"></script>
    <script src="<?= $base_url ?>assets/template/listing/js/jquery.easing.1.3.js"></script>
    <script src="<?= $base_url ?>assets/template/listing/js/bootstrap-datepicker.min.js"></script>
    <script src="<?= $base_url ?>assets/template/listing/js/aos.js"></script>

    <script src="<?= $base_url ?>assets/template/listing/js/main.js"></script>

  </body>

</html>