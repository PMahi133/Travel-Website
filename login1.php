<?php
session_start();
include("config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

   $email = trim($_POST["email"]);
   $email = strtolower(trim($_POST["email"]));
$password = trim($_POST["password"]);

// Email validation
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "<script>alert('Invalid Email Format');</script>";
    exit();
}

// Password validation (same rule as frontend)
if (!preg_match("/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/", $password)) {
    echo "<script>alert('Password must be at least 8 characters and contain letters and numbers');</script>";
    exit();
}
    // Fetch user
    $sql = "SELECT * FROM tbl_login WHERE email='$email'";
    $result = mysqli_query($link, $sql);

    if ($result && mysqli_num_rows($result) == 1) {

        $user = mysqli_fetch_assoc($result);
        if (
            password_verify($password, $user["password"]) ||
            $password === $user["password"]
        ) {
            if ($password === $user["password"]) {
                $newHash = password_hash($password, PASSWORD_DEFAULT);
                mysqli_query($link, "UPDATE tbl_login SET password='$newHash' WHERE uid='".$user['uid']."'");
            }

            $_SESSION["uid"] = $user["uid"];
            $_SESSION["email"] = $user["email"];
            $_SESSION["role"] = $user["role"];

            // Redirect
            if ($user["role"] == "admin") {
                header("Location: dashboard.php");
            } else {
                header("Location: user.php");
            }
            exit();

        } else {
            echo "<script>alert('Wrong Password');</script>";
        }

    } else {
        echo "<script>alert('Email not found');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login Page</title>
  <?php include("link.php") ?>
</head>
<body>
  <?php include("header.php") ?>
  <main>
    <section id="hero" class="hero section dark-background">
      <div class="hero-background">
        <img src="assets/image/LoginPageBg.jpg" alt="" data-aos-duration="1000">
        <div class="overlay"></div>
      </div>

      <div class="container">
        <form action="" method="post">
          <div class="row">
            <div class="col-sm-6 loginform">
              <div class="form-group">
                <center>
                  <img src="assets/image/Screenshot 2025-07-05 113230.png" alt="" style="width:100px;height:100px;">
                </center><br>
                <h2 align="center">Login To Your Account</h2>
              </div><hr><br>

              <div class="form-group">
                <div class="input-with-icon">
                  <i class="bi bi-envelope"></i>
                  <input type="email" class="form-control" id="email" name="email" 
placeholder="Email Address" required 
pattern="^[^\s@]+@[^\s@]+\.[^\s@]+$"
title="Enter a valid email (example: abc@gmail.com)">
                </div>
              </div><br>

              <div class="form-group">
                <div class="input-with-icon">
                  <i class="bi bi-person"></i>
                  <input type="password" class="form-control" id="password" name="password" 
placeholder="Password" required 
pattern="^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$"
title="Password must be at least 8 characters with letters and numbers">
                </div>
              </div><br><br>

              <div class="col-12 text-center">
                <button type="submit" class="btn btn-primary btn-submit" id="btnlogin" name="btnlogin">&nbsp; Login &nbsp;</button><br>
                Don't Have An Account? &nbsp;<a href="sign.php">Create New Account</a><br>
                Forgot Password? &nbsp;<a href="forgot_password.php">Reset Here</a>
              </div>
            </div>

            <div class="col-sm-6">
              <img src="assets/image/Login1.jpg" alt="" style="height:550px;width:650px;border-radius:5%;margin-top:12px; margin-left:100px;">
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
