<?php include("config.php");?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btnsubmit'])) {
    $name    = trim($_POST['name'] ?? '');
    $email   = trim($_POST['email'] ?? '');
    $subject = trim($_POST['subject'] ?? '');
    $message = trim($_POST['message'] ?? '');

    $stmt = mysqli_prepare($link, "INSERT INTO tbl_contactus (username, email, subject, message) VALUES (?, ?, ?, ?)");
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $subject, $message);
        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_close($stmt);
            header("Location: " . $_SERVER['PHP_SELF'] . "?success=1");
            exit();
        } else {
            $error = "Insert failed: " . mysqli_stmt_error($stmt);
            mysqli_stmt_close($stmt);
        }
    } else {
        $error = "DB prepare failed: " . mysqli_error($link);
    }
}
?>
<?php include("link.php"); ?>
</head>
<body>
    <?php include("header.php"); ?>

<main>
  <section id="hero" class="hero section dark-background">
    <!-- your existing hero background -->
    <div class="hero-background">
      <img src="assets/image/contactUs2.jpg" alt="" data-aos-duration="1000">
      <div class="overlay"></div>
    </div>

    <section id="contact" class="contact section">
      <div class="container section-title">

        <!-- Your form -->
        <div class="row justify-content-center" data-aos="fade-up" data-aos-delay="300" style="margin-left: 252px;">
          <div class="col-lg-10">
            <div class="contact-form-wrapper">
              <?php if(!isset($_SESSION['role']) || $_SESSION['role'] != 'admin'){ ?>
              <h2 class="text-center mb-4" style="color:white;">Get in Touch</h2>
              <form action="" method="post">
                <div class="row g-3">
                  <div class="col-md-6">
                    <div class="form-group">
                      <div class="input-with-icon">
                        <i class="bi bi-person"></i>
                        <input type="text" class="form-control" name="name" placeholder="First Name" required>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <div class="input-with-icon">
                        <i class="bi bi-envelope"></i>
                        <input type="email" class="form-control" name="email" placeholder="Email Address" required>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <div class="input-with-icon">
                        <i class="bi bi-text-left"></i>
                        <input type="text" class="form-control" name="subject" placeholder="Subject" required>
                      </div>
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="form-group">
                      <div class="input-with-icon">
                        <i class="bi bi-chat-dots message-icon"></i>
                        <textarea class="form-control" name="message" placeholder="Write Message..." style="height: 180px" required></textarea>
                      </div>
                    </div>
                  </div>

                  <div class="col-12 text-center">
                    <button type="submit" class="btn btn-primary" name="btnsubmit">SEND MESSAGE</button>
                  </div>
                </div>
              </form><hr><br>
              <?php } ?>

              <?php if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin'){ ?>
              <div class="container" style="margin-top:50px;margin-left:120px;">
                <h2 style="color:white; text-align:center;">User Messages</h2><hr>
                <table class="table table-bordered table-dark">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Subject</th>
                    <th>Message</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                  $sql = "SELECT * FROM tbl_contactus";
                  $result = mysqli_query($link, $sql);
                  while($row = mysqli_fetch_assoc($result)){
                    echo "<tr>";
                    echo "<td>".$row['username']."</td>";
                    echo "<td>".$row['email']."</td>";
                    echo "<td>".$row['subject']."</td>";
                    echo "<td>".$row['message']."</td>";
                    echo "</tr>";
                  }
                ?>
                </tbody>
                </table>
              </div>
            <?php } ?>
          </div>
        </div>
      </div>
    </section>
  </section>
</main>

<?php include("footer.php"); ?>
<?php include("script.php"); ?>
</body>
</html>



