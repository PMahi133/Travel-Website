<?php include("config.php");?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solo Package Information</title>
    <?php include("link.php"); ?>
    <style>
      h2,h3,h4,h5{
        color: white;
      }
      h6{
        color: rgb(135, 133, 133);
        font-size: 19px;
      }
    </style>
</head>
<body>
<?php include("header.php"); ?>

    <main class="main">
    <!-- Hero Section -->
    <section id="hero" class="hero section dark-background">
      <div class="hero-background">
        <img src="assets/image/bg1.jpg" alt="" data-aos-duration="1000">
        <div class="overlay"></div>
      </div>

      <div class="container">
        <div class="row">
          <center><div class="col-sm-12"><h1 style="color: white;">Solo Package Information</h1></div>
          <div class="col-sm-12"><p>“Travel Alone, Discover Yourself”</p></div></center>
        </div><hr>
       
        <div class="row" style="margin-left:70px;">

          <div class="col-sm-6">
            <h3 >Valid for : </h3>
            <h5>Number of Persons: 1 Traveler Only</h5>
            <p>This package is specially designed for individual travelers seeking freedom and flexibility.</p>

            <h3>Key Benefits : </h3>
            <h6><ul>
              <li>Complete travel independence</li>
              <li>Flexible sightseeing schedule</li>
              <li>Safe and solo-friendly destinations</li>
              <li>Personalized itinerary support</li>
            </ul></h6><br>

            <h3>Special Treatment for Solo Travelers : </h3>
            <h6><ul>
              <li>Priority customer support</li>
              <li>Solo-friendly hotels and transport</li>
              <li>Emergency assistance during travel</li>
              <li>Optional local guide (on request)</li>
            </ul></h6><br>

            <h3>Package Includes : </h3>
            <h6><ul>
              <li>Comfortable accommodation</li>
              <li>Daily breakfast</li>
              <li>Sightseeing as per plan</li>
              <li>24/7 customer assistance</li>
            </ul></h6><br>

            
            <h3>Package Excludes : </h3>
            <h6><ul>
              <li>Personal expenses</li>
              <li>Adventure activities</li>
              <li>Entry fees (if applicable)</li>
              <li>Travel insurance</li>
            </ul></h6><br>

            <h2>Note : </h2><p>Select Any Place To Apply This Package</p>
          </div>

          <div class="col-sm-6">
                <div class="image-wrapper">
                    <img src="assets/image/Other_package/Soloimg.jpg" alt="About Us" style="height: 800px; width:600px;border-radius:20px;">
                </div>
          </div>

        </div>

        <div class="row mt-5">
          <div class="col-sm-12" align="center">
            <a href="./winter.php" class="btn btn-outline-success">Select Place</a>
            <a href="./index.php" class="btn btn-outline-danger">Home</a></center>
          </div>
        </div>


      </div>
    </section>
    </main>

<?php include("footer.php"); ?>
<?php include("script.php"); ?>
</body>
</html>