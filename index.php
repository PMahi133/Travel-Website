<?php include("config.php")?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index Page</title>
    <?php include("link.php")?>
    <style>
      h1, h5, h3{
          color:black;
          font-family:cursive;
      }
      .timg{
        height: 170px;
        width: 170px;
        border-radius: 50%;
        margin-left: 25px;
      }
      td{
        text-align: center;
      }
    </style>
</head>
<body>
<?php include("header.php")?>

  <main class="main">
    <!-- Hero Section -->
    <section id="hero" class="hero section dark-background">
      <div class="hero-background">
        <img src="assets/image/bg1.jpg" alt="" data-aos-duration="1000">
        <div class="overlay"></div>
      </div>

      <div class="container">
        <div class="row">
          <center><div class="col-sm-12"><h1 style="color: white;">Welcome To TripTime</h1></div>
          <div class="col-sm-12"><p>"Discover Your Next Adventure with TripTime"</p></div></center>
        </div>
        <div class="row">
          <div class="col-sm-12">
            <h6 style="font-size: 19px;color:white;line-height: 26px;">Your Gateway to Unforgettable Journeys!At TripTime, we curate seamless travel experiences that go beyond booking—it’s about crafting memories. 
              Whether it's a solo escape, a family holiday, honeymoon, or group adventure, our expert team is with you every step of the way. 
              From handpicked destinations and budget-friendly packages to personalized itineraries and 24/7 support—we ensure your journeys are unforgettable and hassle-free.
              This content aligns with a personalized, user-focused travel platform—distinct from the TripTime® insurance provider. You’ll be presenting your services clearly, inspiring confidence and excitement, and guiding visitors to take action.</h6>
          </div>
        </div><br><br><hr>

        <!-- top Destinations -->
        <div class="row" style="border-radius: 20px;">
          <div class="col-sm-12"><br>
            <center><h1 style="color: white;">Top Destinations</h1></center>
          </div>
          <table>
            <tr>
              <td><a href="./monsoon.php"><img src="assets/image/monsoon/Andaman_Nicobar.jpeg" class="timg" alt="" ></a></td>
              <td><a href="./summer.php"><img src="assets/image/imagesummer/Ladakh.jpg" class="timg" alt=""></a></td>
              <td><a href="./summer.php"><img src="assets/image/imagesummer/Shillong.jpg" class="timg" alt=""></a></td>
              <td><a href="./winter.php"><img src="assets/image/imageswinter/goa.jpg" class="timg" alt=""></a></td>
              <td><a href="./winter.php"><img src="assets/image/imageswinter/gulmarg-jummu-kashmir.jpg" class="timg" alt=""></a></td>
              <td><a href="./index.php"><img src="assets/image/inter_package/Thailand.jpeg" class="timg" alt=""></a></td>
            </tr><br><br>
            <tr>
              <td><h5  style="color: white;">Tour 5</h5></td>
              <td><h5  style="color: white;">Tour 3</h5></td>
              <td><h5  style="color: white;">Tour 6</h5></td>
              <td><h5  style="color: white;">Tour 4</h5></td>
              <td><h5  style="color: white;">Tour 5</h5></td>
              <td><h5  style="color: white;">Tour 7</h5></td>
            </tr><br>
          </table>
        </div><br><br><br><br><hr>

        <!-- Bus Facilities -->
<div class="row">
  <div><br><h1 align="center" style="color:white;font-family:cursive;">Bus Facilities</h1><br></div>
</div>

<div class="row" style="color:white;text-align:center;">
  <div class="col-sm-3">
    <h3 style="color: white;">🚌 Comfortable Seats</h3>
    <p>Pushback seats for a relaxing journey</p>
  </div>
  <div class="col-sm-3">
    <h3 style="color: white;">🔌 Charging Point</h3>
    <p>Charge your mobile anytime</p>
  </div>
  <div class="col-sm-3">
    <h3 style="color: white;">❄️ AC Buses</h3>
    <p>Enjoy cool and comfortable travel</p>
  </div>
  <div class="col-sm-3">
    <h3 style="color: white;">🛡️ Safety First</h3>
    <p>Experienced drivers & secure trips</p>
  </div>
</div><br><br><hr>

<!-- Travel Tips -->
<div class="row">
  <div><br><h1 align="center" style="color:white;font-family:cursive;">Travel Tips</h1><br></div>
</div>

<div class="row">
  <div class="col-sm-6">
    <h4 style="color:white;">
    <ul style="line-height:2;">
      <li> Carry valid ID proof</li>
      <li> Reach pickup point 30 minutes early</li>
      <li> Keep power bank & charger</li>
      <li> Carry water & light snacks</li>
    </ul></h4>
  </div>
  <div class="col-sm-6">
    <h4 style="color:white;">
    <ul style="line-height:2;">
      <li> Wear comfortable clothes</li>
      <li> Keep necessary medicines</li>
      <li> Follow bus rules</li>
      <li> Keep your luggage safe</li>
    </ul></h4>
  </div>
</div>

<hr>

      </div>
    </section>
  </main>

<?php include("footer.php")?>
<?php include("script.php")?>
</body>
</html>