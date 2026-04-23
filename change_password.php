<?php
include("config.php");

if (!isset($_SESSION['uid'])) {
    header("Location: login.php");
    exit();
}

if(isset($_POST['change'])){
    $uid = $_SESSION['uid'];
    $current = $_POST['current_password'];
    $new = $_POST['new_password'];
    $confirm = $_POST['confirm_password'];

    $res = mysqli_query($link,"SELECT password FROM tbl_login WHERE uid=$uid");
    $row = mysqli_fetch_assoc($res);

    if(password_verify($current,$row['password'])){
        if($new === $confirm){
            $hash = password_hash($new,PASSWORD_DEFAULT);
            mysqli_query($link,"UPDATE tbl_login SET password='$hash' WHERE uid=$uid");
            echo "Password changed!";
        } else {
            echo "Passwords do not match";
        }
    } else {
        echo "Wrong current password";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Change Password</title>
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
          <h2 align="center" style="color: white;">  Change Password</h2><br>
        </div>
      </div>
      <div class="card shadow">
        <div class="card-body">
          <?php if(isset($msg)) echo "<div class='alert alert-info'>$msg</div>"; ?>
          <form method="POST">
            <div class="mb-3">
              <label>Current Password</label>
              <input type="password" name="current_password" class="form-control" required>
            </div>
            <div class="mb-3">
              <label>New Password</label>
              <input type="password" name="new_password" class="form-control" required>
            </div>
            <div class="mb-3">
              <label>Confirm New Password</label>
              <input type="password" name="confirm_password" class="form-control" required>
            </div>
            <center><button type="submit" name="change" class="btn btn-outline-success">Change Password</button></center>
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
