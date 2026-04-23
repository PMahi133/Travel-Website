<?php include("./config.php") ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login Page</title>
  <?php include("link.php") ?>
<?php

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'user') {
    header("Location: login.php");
    exit();
}

$email = $_SESSION["email"];

$res = mysqli_query($link, "SELECT * FROM tbl_login WHERE email='$email'");
$user = mysqli_fetch_assoc($res);


$email = $_SESSION["email"]; // from login.php session

// Fetch user details
$sql = "SELECT * FROM tbl_login WHERE email = '$email'";
$result = mysqli_query($link, $sql);

// Check if query ran successfully
if ($result && mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result);
} else {
    // If no user found, force logout
    echo "<script>alert('User not found. Please login again.');</script>";
    session_destroy();
    header("location: login1.php");
    exit();
}
?>

</head>

<body>
  <?php include("header.php") ?>
  <main>
    <!-- Hero Section -->
    <section id="hero" class="hero section dark-background">

      <div class="hero-background">
        <img src="assets/image/userBackground.jpg" alt="" data-aos-duration="1000">
        <div class="overlay"></div>
      </div>

      <div class="container">
        <form action="" method="post">
          <div class="row">
            <div class="col-sm-6" align="right">
              <img src="assets/image/userDashboard2.jpg" alt="" style="height:600px;width:500px;border-radius:5%;margin-top:12px; margin-left:100px;">
              <h1 style="position: absolute;top: 20%;left:20%; color:white;">Welcome &nbsp;<br> To Triptime</h1>
              <p style="position: absolute;top: 40%;left:16%; color:white;">Get ready for unforgettable journeys </p>
              <p style="position: absolute;top: 44%;left:24%; color:white;">with TripTime!</p>
            </div>
            <div class="col-sm-6 bg-light" style="border-radius:5%;" align="left">
              <center><img src="./assets/image/Screenshot 2025-07-05 113230.png" alt="" style="border-radius: 30%;width:150px;height:150px;">
                <h2> Account Details </h2><hr>

                <!-- user Details -->
                <div class="row">
                  <div class="col-sm-6"><h5 style="color: black;text-align:right;"><strong>User Name : </strong></h5></div>
                  <div class="col-sm-6"><p style="color: black;text-align:left;"><?= $user["username"]; ?></p></div>
                </div>
                <div class="row">
                  <div class="col-sm-6"><h5 style="color: black;text-align:right;"><strong>Contact No : </strong></h5></div>
                  <div class="col-sm-6"><p style="color: black;text-align:left;"><?= $user["contactno"]; ?></p></div>
                </div>
                <div class="row">
                  <div class="col-sm-6"><h5 style="color: black;text-align:right;"><strong>Email Id : </strong></h5></div>
                  <div class="col-sm-6"><p style="color: black;text-align:left;"><?= $user["email"]; ?></p></div>
                </div>

                <div class="row mt-4">
                  <div class="col-sm-12 text-center">
                    <a href="./change_password.php" class="btn btn-outline-warning me-2">Change Password</a>
                    <a href="logout.php" class="btn btn-outline-primary">Log Out</a>
                  </div>
                </div>
            </div>
          </div>
        </form>
      </div>
    </section>
  </main>
  <?php include("footer.php") ?>
  <?php include("script.php") ?>
</body>
</html>
