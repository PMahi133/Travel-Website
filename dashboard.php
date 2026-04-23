<?php
session_start();
include("config.php");

if (!isset($_SESSION["role"]) || $_SESSION["role"] != "admin") {
    header("Location: login1.php");
    exit();
}

$places_count = mysqli_fetch_assoc(mysqli_query($link, "SELECT COUNT(*) AS c FROM places"))['c'];
$packages_count = mysqli_fetch_assoc(mysqli_query($link, "SELECT COUNT(*) AS c FROM packages"))['c'];
$bookings_count = mysqli_fetch_assoc(mysqli_query($link, "SELECT COUNT(*) AS c FROM bookings"))['c'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Dashboard</title>
  <?php include("link.php") ?>
</head>
<body>
<?php include("header.php")?>
<main>

  <section id="hero" class="hero section dark-background">

    <div class="hero-background">
      <img src="assets/image/monsoon/monsoonBackground.jpg" alt="" data-aos-duration="1000">
      <div class="overlay"></div>
    </div>

    <div class="container">
      <h1 align="center" style="color: whitesmoke;">Admin Dashboard</h1>

      <!-- Summary Cards -->
      <div class="row">
        <div class="col-md-4">
          <div class="card shadow text-center">
            <div class="card-body">
              <h5 class="card-title">Places</h5><hr>
              <p style="color: black;font-size:31px;" class="display-6"><?php echo $places_count; ?></p>
              <a href="./manage_places.php" class="btn btn-outline-primary btn-sm">Manage Places</a>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card shadow text-center">
            <div class="card-body">
              <h5 class="card-title">Packages</h5><hr>
              <p style="color: black;font-size:31px;" class="display-6"><?php echo $packages_count; ?></p>
              <a href="./manage_packages.php" class="btn btn-outline-primary btn-sm">Manage Packages</a>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card shadow text-center">
            <div class="card-body">
              <h5 class="card-title">Bookings</h5><hr>
              <p style="color: black;font-size:31px;" class="display-6"><?php echo $bookings_count; ?></p>
              <a href="./manage_bookings.php" class="btn btn-outline-primary btn-sm">View Bookings</a>
            </div>
          </div>
        </div>

      <!-- Logout Button -->
      <div class="row mt-4">
      <div class="col-sm-12 text-center">
        <a href="change_password.php" class="btn btn-outline-warning me-2">Change Password</a>
        <a href="logout.php" class="btn btn-outline-primary">Log Out</a>
      </div>
    </div>

  </section>

</main>
<?php include("script.php") ?>
</body>
</html>
