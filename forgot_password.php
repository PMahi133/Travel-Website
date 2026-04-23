<?php
include("config.php");

if(isset($_POST['reset'])){
    $email = $_POST['email'];
    $new = $_POST['new_password'];
    $confirm = $_POST['confirm_password'];

    $res = mysqli_query($link,"SELECT * FROM tbl_login WHERE email='$email'");

    if(mysqli_num_rows($res)>0){
        if($new === $confirm){
            $hash = password_hash($new,PASSWORD_DEFAULT);
            mysqli_query($link,"UPDATE tbl_login SET password='$hash' WHERE email='$email'");
            echo "Password reset successful!";
        } else {
            echo "Passwords do not match";
        }
    } else {
        echo "Email not found";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Forgot Password</title>
<?php include("link.php"); ?>
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
      <div class="row">
        <div class="col-sm-12">
          <h2 align="center" style="color: white;"> Forgot Password</h2><br>
        </div>
      </div>
      <div class="card shadow">
        <div class="card-body">
        <?php if(isset($msg)) echo "<div class='alert alert-info'>$msg</div>"; ?>
          <form method="POST">
            <div class="mb-3">
              <label>Email</label>
              <input type="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
              <label>New Password</label>
              <input type="password" name="new_password" class="form-control" required>
            </div>
            <div class="mb-3">
              <label>Confirm New Password</label>
              <input type="password" name="confirm_password" class="form-control" required>
            </div>
            <center><button type="submit" name="reset" class="btn btn-outline-success">Reset Password</button></center>
          </form>
        </div>
      </div>
    </div>

</section>
</main>

  <?php include("footer.php") ?>
  
  <?php include("script.php")?>
</body>
</html>
