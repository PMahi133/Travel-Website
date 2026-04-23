<?php include("config.php")?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>A Monsoon Retreat</title>
    <link rel="stylesheet" href="bootstrap.min.css">
    <script src="jquery-3.7.1.min.js"></script>
    <link rel="stylesheet" href="style.css">
    <?php include("link.php")?>
    <style>
      .winter{
        height: 630px;
        border-radius: 50px;
      }
      #wimg{
        height: 400px;
        width: 340px;
        border-radius: 50px;
        margin-top: 10px;
      }
    </style>
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
      <!-- India travelling Places -->
      <div class="row">
        <div><br><h1 align="center" style="color:white;font-family:cursive;">Winter Travel Packages : In India &nbsp;</h1><br></div>
      </div>
      <div class="row monsoon_row" style="margin-left:5px;padding:15px;">
        <?php
$sql = "SELECT p.Pname, p.Pimg, p.Pid,
        ps.Packagename, ps.Duration, ps.Packageid
        FROM places p
        JOIN packages ps ON p.Pid = ps.Pid 
        WHERE p.Season = 'winter'";

$result = mysqli_query($link, $sql);

// ✅ ERROR CHECK
if (!$result) {
    die("SQL Error: " . mysqli_error($link));
}

while ($row = mysqli_fetch_assoc($result)) {
    echo "<div class='card winter' style='margin:10px;width:400px;'>";
    echo "<div class='card.body win_cardbody' style='width:370px;'>";
    echo "<img src='".$row['Pimg']."' alt='Image' id='wimg' style='width:370px;'><br>"; 
    echo "<h3 align='center'>".$row["Pname"]."</h3><hr>";
    echo "<h4 align='center'>".$row["Duration"]."</h4><hr>";
    echo "<center><a href='packageinfo.php?id=".$row['Pid']."'>
          <input type='submit' value='View Packages' class='btn btn-outline-danger'>
          </a></center>";
    echo "</div>";   
    echo "</div>";
}
?>
      </div>

      <div style="background-color: white;border-radius: 2%;">
        <div>
          <center><br><h3>Tips For Winter Travel </h3><br></center>
            <table style="margin-left:70px;"> 
              <tr><center>
                <td><img src="assets/image/imageswinter/WinterTips1.png" alt="" style="height: 250px;width:250px;"></td>
                <td><img src="assets/image/imageswinter/WinterTips2.png" alt="" style="height: 250px;width:250px;"></td>
                <td><img src="assets/image/imageswinter/WinterTips3.png" alt="" style="height: 250px;width:250px;"></td>
              </center></tr>
              <tr>
                <td><h5>Pack warm clothes, gloves, and thermal wear.</h5></td>
                <td><h5>Keep moisturizers and lip balm to avoid dryness.</h5></td>
                <td><h5>Carry hot beverages and keep extra blankets.</h5></td>
              </tr>
            </table>
        </div>
      </div>
    </div>
  </section>
   
</main>

  <?php include("footer.php") ?>
  
  <?php include("script.php")?>
</body>
</html>
