<?php include("config.php")?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <?php include("link.php")?>
</head>
<?php 
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = mysqli_real_escape_string($link, $_POST['email']);
    $pwd   = $_POST['pwd']; // don't escape before hashing
    $uname = mysqli_real_escape_string($link, $_POST['username']);
    $cno   = mysqli_real_escape_string($link, $_POST['contactno']);

    // 🔥 HASH PASSWORD (IMPORTANT)
    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

    // Insert with role = user
    $sql = "INSERT INTO tbl_login(email, password, username, contactno, role) 
            VALUES ('$email', '$hashedPwd', '$uname', '$cno', 'user')";

    if (mysqli_query($link, $sql)) {
        echo "<script>alert('Account created successfully!'); window.location='login1.php';</script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($link) . "');</script>";
    }
}
?>
<body>
    <?php include("header.php")?>

    <main class="main">
    <!-- Hero Section -->
    <section id="hero" class="hero section dark-background">
      <div class="hero-background">
        <img src="assets/image/LoginPageBg.jpg" alt="" data-aos-duration="1000">
        <div class="overlay"></div>
      </div>

      <div class="container">
        <div class="row">
            <div class="col-sm-12"><img src="assets/image/Signup.png" alt="" ></div>
        </div> <br><br>
        <div class="row">
            <h2 class="text-center mb-4" style="color:white;">Create Your Account</h2>

              <form  method="post" style="width:800px; margin-left:270px;">
                <div class="row g-3">

                  <!-- Username -->
                  <div class="col-md-12">
                    <div class="form-group">
                      <div class="input-with-icon">
                        <i class="bi bi-text-left"></i>
                        <input type="text" class="form-control" name="username" id="username"
placeholder="Username" required
pattern="^[A-Za-z ]{3,}$"
title="Username must be at least 3 letters">
                      </div>
                    </div>
                  </div>

                  <!-- Contact Number -->
                  <div class="col-md-12">
                    <div class="form-group">
                      <div class="input-with-icon">
                        <i class="bi bi-telephone"></i>
                        <input type="text" class="form-control" name="contactno" id="contactno"
placeholder="Contact Number" required
pattern="^[0-9]{10}$"
title="Enter valid 10-digit number">
                      </div>
                    </div>
                  </div>

                  <!-- Email -->
                  <div class="col-md-12">
                    <div class="form-group">
                        <i class="bi bi-envelope"></i>
                        <input type="email" class="form-control" name="email" id="email"
placeholder="Email Address" required
pattern="^[^\s@]+@[^\s@]+\.[^\s@]+$"
title="Enter valid email">
                    </div>
                  </div>

                  <!-- Password -->
                  <div class="col-md-12">
                    <div class="form-group">
                      <div class="input-with-icon">
                        <i class="bi bi-lock"></i>
                        <input type="password" class="form-control" name="pwd" id="password"
placeholder="Password" required
pattern="^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$"
title="Password must be 8+ characters with letters and numbers">
                      </div>
                    </div>
                  </div>

                  <!-- Already Have Account -->
                  <div class="col-md-12">
                    <div class="form-group">
                     <center>Already Have An Account?&nbsp;&nbsp;<a href="./login1.php">Log In</a></center>
                    </div>
                  </div>

                  <!-- Submit Button -->
                  <div class="col-12 text-center">
                    <button type="submit" class="btn btn-primary btn-submit">&nbsp; Create Account &nbsp;</button><br>
                  </div>

                </div>
              </form>
        </div>
      </div>
    </section> 
    </main>

    <?php include("footer.php")?>
    <?php include("script.php")?>
</body>
</html>
