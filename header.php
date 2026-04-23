<header id="header" class="header fixed-top">

  <div class="topbar d-flex align-items-center dark-background">
    <div class="container d-flex justify-content-center justify-content-md-between">
      <div class="contact-info d-flex align-items-center">
        <i class="bi bi-envelope d-flex align-items-center"><a href="mailto:contact@example.com">Triptime@gmail.com</a></i>
        <i class="bi bi-phone d-flex align-items-center ms-4"><span>+1 9904 68735 24</span></i>
      </div>
      <div class="social-links d-none d-md-flex align-items-center">
        <a href="#" class="twitter"><i class="bi bi-twitter-x"></i></a>
        <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
        <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
        <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
      </div>
    </div>
  </div><!-- End Top Bar -->

  <div class="branding d-flex align-items-cente">

    <div class="container position-relative d-flex align-items-center justify-content-between">
      <a href="index.html" class="logo d-flex align-items-center">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="assets/img/logo.webp" alt=""> -->
        <h1 class="sitename">Triptime : travel with us!</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="index.php" class="active">Home</a></li>
          <li><a href="aboutUs.php">About</a></li>
          <li class="dropdown"><a href="#"><span>Packages</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
              <li><a href="winter.php">Winter Packages</a></li>
              <li><a href="summer.php">Summer Packages</a></li>
              <li><a href="monsoon.php">Monsoon Packages</a></li>
            </ul>
          </li>
          <li><a href="./gallery.php">Gallery</a></li>
          <li><a href="contact.php">Contact Us</a></li>
          <li><a href="privacyinfo.php">Privacy Policy</a></li>
          <?php
if (isset($_SESSION["role"]) && $_SESSION["role"] == "admin") {
    echo '<li><a href="dashboard.php">Dashboard</a></li>';
}
elseif (isset($_SESSION["role"]) && $_SESSION["role"] == "user") {
  echo '<li><a href="Userbooking.php">My Booking</a></li>';
    echo '<li><a href="user.php">Profile</a></li>';
}
else {
    echo '<li><a href="login1.php">Login</a></li>';
}
?>
  
      </nav>

    </div>

  </div>
</header>