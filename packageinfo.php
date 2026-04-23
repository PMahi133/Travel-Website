<?php include("./config.php") ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Packages</title>
    <?php include("./link.php") ?>
    <style>
        .ptext{
            color:darkgray;
        }
        #pimg{
            width: 600px;
            height: 500px;
            border-radius: 20px;
        }
        h4{
            color: darkgray;
            font-size: 18px;
        }
        .himg{
            height: 220px;
            width: 100%;
            object-fit: cover;
            border-radius: 10px;
        }
        .card{
            height: 100%;
            margin-bottom: 20px;
            background-color: black;
        }
    </style>
</head>
<body>
    <?php include("./header.php") ?>

<?php 
if(isset($_GET['id'])){ 

    $pid = (int) $_GET['id']; 

    $sql = "SELECT p.Pimg, p.Pname, 
            ps.Packagename, ps.Packageprice, ps.Duration, 
            ps.Transportation, ps.Packageid,
            ps.Pickuplocation, ps.Departuretime, ps.Overview
            FROM places p 
            JOIN packages ps ON p.Pid = ps.Pid 
            WHERE p.Pid = $pid";

    $result = mysqli_query($link,$sql);

  
    if (!$result) {
        die("SQL Error: " . mysqli_error($link));
    }

    if(mysqli_num_rows($result) > 0){ 
        $row = mysqli_fetch_assoc($result);

        $packageId = (int)$row['Packageid']; 

        
        $query = "SELECT pd.dateid, pd.TravelDate, pd.Bus, pd.Capacity,
                  (pd.Capacity - IFNULL(SUM(b.adults + b.children), 0)) AS seats_left
                  FROM package_date pd
                  LEFT JOIN bookings b 
                  ON pd.dateid = b.dateid
                  WHERE pd.Packageid = $packageId
                  GROUP BY pd.dateid, pd.TravelDate, pd.Bus, pd.Capacity";

        $result2 = mysqli_query($link, $query);

        if (!$result2) {
            die("SQL Error: " . mysqli_error($link));
        }
?>
    <main class="main">

    <section class="hero section dark-background">

        <div class="hero-background">
            <img src="assets/image/bg1.jpg">
            <div class="overlay"></div>
        </div>

        <div class="container">

            <div class="row">
                <div><br><h1 align="center" style="color:white;font-family:cursive;">Package Information &nbsp;</h1><br></div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <img src="<?php echo $row['Pimg'] ?>" alt='Image' id='pimg'>
                </div>
                <div class="col-sm-6">
                    <h2 class="ptext"><?php echo $row['Packagename']; ?></h2><hr>
                    <h5 class="ptext">Price: ₹<?php echo $row['Packageprice']; ?> Per Person
                        <br>&nbsp;&nbsp;&nbsp;<small style="color: lightgrey;">(Children aged 5–10 years will be charged 50% of the adult price)</small></h5>
                    <h5 class="ptext">Duration: <?php echo $row['Duration']; ?></h5>
                    <h5 class="ptext">Transportation: <?php echo $row['Transportation']; ?></h5>
                    <h5 class="ptext">Pickuplocation: <?php echo $row['Pickuplocation']; ?></h5>
                    <h5 class="ptext">Departuretime: <?php echo $row['Departuretime']; ?></h5><br><hr>
                    <h5 class="ptext">Available Dates : <br><br>
                    <?php 
if(mysqli_num_rows($result2) == 0){
    echo "<p style='color:red;'>No dates available</p>";
}
?>

<select id="travelDate" class="form-control">
<option value="">Select Date</option>

<?php 
while($date = mysqli_fetch_assoc($result2)){ 
    $disabled = ($date['seats_left'] <= 0) ? 'disabled' : '';
?>

<option value="<?php echo $date['dateid']; ?>" <?php echo $disabled; ?>>
    <?php echo date("d-m-Y", strtotime($date['TravelDate'])); ?>
    - Bus <?php echo $date['Bus']; ?>

    <?php 
        if($date['seats_left'] <= 0){
            echo "(FULL)";
        } else {
            echo "(Seats Left: " . $date['seats_left'] . ")";
        }
    ?>
</option>

<?php } ?>

</select>

<?php 
    } else { 
        echo "<h3 style='color:white;'>No Packages Found</h3>"; 
    }  
}
    else { 
    echo "<h3 style='color:white;'>Invalid Request</h3>";
}
?>
</h5><br>
                    <button type="button" class="btn btn-outline-success" onclick="goToPayment()">
    Book With This Package
</button>
                </div>
            </div><br><br>

            <div class="row">
                <div class="col-sm-12">
                    <h2 style="color:darkgray;">Package Overview : </h2><hr>
                    <h5 class="ptext"><?php echo $row['Overview']; ?></h5>
                </div>
            </div><br><br>

            <div class="row">
                <div class="col-sm-6">
                    <h2 style="color:darkgray;" >Daily Itinerary : </h2><hr>
                    <?php
                        $packageid = $row['Packageid'];
                        $sql3 = "SELECT * FROM itinerary WHERE Packageid = $packageid ORDER BY Day";
                        $result3 = mysqli_query($link,$sql3);
                            while($schedule = mysqli_fetch_assoc($result3)){
                    ?>
                    <h4>Day <?php echo $schedule['Day']; ?></h4>
                    <p class="ptext"><?php echo $schedule['Text']; ?></p>
                    <?php } ?>
                </div>
                <div class="col-sm-6">
                    <h2 style="color:darkgray;">Package Include :</h2><hr>
                    <ul style="padding-left:20px; line-height:1.5;">
                        <?php $packageid = $row['Packageid'];
                            $sql3 = "SELECT * FROM package_includes WHERE Packageid = $packageid";
                            $result3 = mysqli_query($link,$sql3);
                            while($schedule = mysqli_fetch_assoc($result3)){
                        ?>
                        <li class="ptext" style="font-size:17px;"><?php echo $schedule['Include']; ?></li>
                        <?php } ?>
                    </ul>

                    <h3 style="color:darkgray;">Package Exclude :</h3>
                    <ul style="padding-left:20px; line-height:1.5;">
                        <?php $packageid = $row['Packageid'];
                            $sql3 = "SELECT * FROM package_includes WHERE Packageid = $packageid";
                            $result3 = mysqli_query($link,$sql3);
                            while($schedule = mysqli_fetch_assoc($result3)){
                        ?>
                        <li class="ptext" style="font-size:17px;"><?php echo $schedule['Exclude']; ?></li>
                        <?php } ?>
                    </ul>

                </div>
            </div><br><br>

            <div class="row">
            <h2 style="color:darkgray;">Hotel Informations :</h2><hr>
                <?php $packageid = $row['Packageid'];
                    $sql = "SELECT * FROM hotel WHERE Packageid = $packageid";
                    $result = mysqli_query($link,$sql);
                    while($hotel = mysqli_fetch_assoc($result)){
                ?>
            <div class="col-md-4">
                <div class="card" >
                    <img class="himg" src="<?php echo $hotel['Hotelimg']; ?>">
                    <div class="card-body" style="color:darkgray ;">
                        <h2 class="card-title"><?php echo $hotel['Hotelname']; ?></h2>
                        <p> <?php echo $hotel['Night']; ?> Night Stay</p>
                        <p>📍 <?php echo $hotel['Location']; ?></p>
                        <h5 class="card-title">Hotel Services :</h5>
                        <p class="card-text"><?php echo $hotel['Service']; ?></p>
                        <h5 class="card-title">Hotel Include :</h5>
                        <p class="card-text"><?php echo $hotel['Hotelinlcude']; ?></p>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>

    </section>

    </main>

<script>
function goToPayment() {

    var select = document.getElementById("travelDate");
    var dateid = select.value;

    if(dateid === ""){
        alert("Please select a date!");
        return;
    }

    var packageId = "<?php echo $row['Packageid']; ?>";

    window.location.href = "spayment.php?PackageID=" + packageId + "&dateid=" + dateid;
}
</script>
<?php include("./footer.php") ?>
<?php include("./script.php") ?>

</body>
</html>
