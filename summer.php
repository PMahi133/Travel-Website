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
      .summer{
        height: 630px;
        border-radius: 50px;
      }
      #simg{
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
        <div><br><h1 align="center" style="color:white;font-family:cursive;">Summer Travel Packages : In India &nbsp;</h1><br></div>
      </div>
      <div class="row monsoon_row" style="margin-left:5px;padding:15px;">
        <?php
          $sql = "SELECT p.Pname, p.Pimg, p.Pid,
            ps.Packagename,ps.Duration,ps.Packageid
            FROM places p
        JOIN packages ps ON p.Pid = ps.Pid 
        WHERE p.Season = 'summer'";
          $result = mysqli_query($link, $sql);
          while ($row = mysqli_fetch_assoc($result)) {
            echo "<div class='card summer' style='margin:10px;width:400px;'>";
            echo "<div class='card.body win_cardbody'  style='width:370px;'>";
            echo "<img src='".$row['Pimg']."' alt='Image' id='simg' style='width:370px;'><br>"; 
            echo "<h3 align='center'>".$row["Pname"]."</h3><hr>";
            echo "<h4 align='center'>".$row["Duration"]."</h4><hr>";
            echo "<center><a href='packageinfo.php?id=".$row['Pid']."&image=".$row['Pimg']."'>
            <input type='submit' value='View Packages' class='btn btn-outline-danger'>
            </a></center>";
            echo "</div>";   
            echo "</div>";
          }
        ?>
      </div>

      <div style="background-color: white;border-radius: 2%;">
        <center><br><h3>Tips For Summer Travel </h3><br></center>
        <table style="margin-left:30px;"> 
          <tr>
            <td><img src="assets/image/imagesummer/SummerTips1.png" alt="" style="height: 250px;width:250px;"></td>
            <td><img src="assets/image/imagesummer/SummerTips2.png" alt="" style="height: 250px;width:250px;"></td>
            <td><img src="assets/image/imagesummer/SummerTips3.png" alt="" style="height: 250px;width:250px;"></td>
            <td><img src="assets/image/imagesummer/SummerTips4.png" alt="" style="height: 250px;width:250px;"></td>
          </tr>
          <tr>
            <td><h5>Book accommodations with cooling &nbsp; facilities.</h5></td>
            <td><h5>Wear light, breathable clothing &nbsp; and sunscreen.</h5></td>
            <td><h5>Stay hydrated; carry enough &nbsp; water.</h5></td>
            <td><h5>Avoid outdoor activities during &nbsp;&nbsp; peak afternoon heat.</h5></td>
          </tr>
        </table>
      </div>

    </div>
  </section>
   
</main>

  <?php include("footer.php") ?>
  
  <?php include("script.php")?>
</body>
</html>
