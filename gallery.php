<?php include("./config.php") ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gallery</title>
  <?php include("./link.php") ?> 
  <style>
.rbox {
  background: #f8f9fa;
  border-left: 4px solid #007bff;
  padding: 15px;
  margin-top: 10px;
  border-radius: 8px;
  font-style: italic;
  position: relative;
}

.rbox::before {
  content: "❝";
  font-size: 30px;
  color: #007bff;
  position: absolute;
  top: -10px;
  left: 10px;
}



  </style>
</head>
<body>
  <?php include("./header.php") ?>

  <main class="py-5">
  <!-- Hero Section with background -->
  <section id="hero" class="hero section dark-background">
    
    <div class="hero-background">
      <img src="assets/image/monsoon/monsoonBackground.jpg" alt="">
      <div class="overlay"></div>
    </div>

    <div class="container hero-content">
      <img src="assets/image/Gallery/GalleryBanner.jpg" alt="" style="width: 100%; max-width:1300px;">
      <!-- gallery Data Fetch From tblgallery -->
      <h1 class="text-center mb-5 text-white">Our Travel Gallery</h1>
      <div class="row">
        <?php
        $sql = "select * from tblgallery order by gid DESC";
        $result = mysqli_query($link, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
          echo '<div class="col-md-4 mb-4">';
          echo '<div class="card shadow-sm h-100">';
          echo '<img src="'.$row['gimg'].'" class="gimg" style="width: 100%;height: 250px;object-fit: cover;">';
          echo '<div class="card-body text-center">';
          echo '<h5 class="card-title">'.$row['gname'].'</h5><br>';
          
          // Review Style
          if (!empty($row['greview'])) {
            echo '<div class="rbox">';
            echo '<div class="stars" style="color:#f1c40f;margin-bottom: 5px;">★★★★★</div>';
            echo '<p class="rtext" style="color:black;font-size:16px;margin-left: 25px;">'.$row['greview'].'</p>';
            echo '</div>';
          } else {
            echo '<p class="text-muted">No reviews</p>';
          }
          echo '</div>';
          echo '</div>';
          echo '</div>';
        }
        ?>
      </div>
    </div>
  </section>
</main>


  <?php include("./footer.php") ?>
  <?php include("./script.php") ?>
</body>
</html>
