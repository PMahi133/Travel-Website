<?php include("config.php")?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index Page</title>
    <?php include("link.php")?>
 
  <?php 
if(!isset($_SESSION['email'])){
    echo "<script>alert('Please log in'); window.location.href='login1.php';</script>";
    exit();
}

$userEmail = mysqli_real_escape_string($link, $_SESSION['email']);

//  FIXED QUERY (PackageID corrected)
$sql = "SELECT b.id, b.traveler_name, b.adults, b.children, b.travel_date, 
               b.total_price, b.payment_mode, b.amountpaid, b.paymentstage, b.status, b.refund,
               ps.Packagename, ps.Packageprice
        FROM bookings b
        JOIN packages ps ON ps.Packageid = b.PackageID
        WHERE b.email = '$userEmail'
        ORDER BY b.travel_date DESC";

$result = mysqli_query($link, $sql);

// ERROR CHECK (VERY IMPORTANT)
if (!$result) {
    die("SQL Error: " . mysqli_error($link));
}
?>

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

      <div class="container mt-5">
    <h2 class="text-center text-white mb-4">My Bookings</h2>
     <?php
      if(mysqli_num_rows($result) > 0){
          while($row = mysqli_fetch_assoc($result)){
              echo "<div class='card mb-3' style='background:#222; color:white;'>";
              echo "<div class='card-body'>";
              echo "<h3 style='color: whitesmoke;'>".$row['Packagename']."</h3><hr>";
              echo "<p>Traveler Name: ".$row['traveler_name']."</p>";
              echo "<p>Adults: ".$row['adults']." | Children: ".$row['children']."</p>";
              echo "<p>Travel Date: ".$row['travel_date']."</p>";
              echo "<p>Total Payment: ₹".$row['total_price']."</p>";

              echo "<p>Paid Amount: ₹".$row['amountpaid']."</p>";

if($row['status'] == 'active'){
    echo "<p style='color:orange; font-weight:bold;'>Status: Processing</p>";
}
elseif($row['status'] == 'confirmed'){
    echo "<p style='color:lightgreen; font-weight:bold;'>Status: Confirmed</p>";
}
elseif($row['status'] == 'cancelled'){
    echo "<p style='color:red; font-weight:bold;'>Status: Cancelled</p>";
    echo "<p style='color:yellow;'>Refund Amount: ₹".$row['refund']."</p>";
}

              // Cancel Booking button if not cancelled
              if($row['status'] != 'cancelled'){
                  echo "<button onclick='confirmCancel(".$row['id'].", \"".$row['travel_date']."\", \""."\", ".$row['amountpaid'].")' class='btn btn-outline-danger mt-2'>Cancel Booking</button>";
              }

              echo "</div></div>";
          }
      } else {
          echo "<p class='text-white'>No bookings found.</p>";
      }
      ?>
</div>

    </section>
  </main>
<script>
// Confirm cancellation with refund info
function confirmCancel(id, travelDate, bookingTime, amountPaid) {
    const refundPercent = getRefundPercentage(travelDate, bookingTime);
    let refundMessage = "Refund policy:\n";

if(refundPercent === 1){
    refundMessage += "Cancel within 24 hours → 100% refund.\n";
} else if(refundPercent === 0.6){
    refundMessage += "Cancel after 24 hours → 60% refund.\n";
} else {
    refundMessage += "Cancel on trip day or after → No refund.\n";
}

    refundMessage += "You will recive your payment after 24 hours \n\nDo you want to continue?";

    if(confirm(refundMessage)){
        window.location.href = "delete_booking.php?id=" + id;
    }
}

function getRefundPercentage(travelDate, bookingTime) {
    const now = new Date();

    const booking = new Date(bookingTime);
    const travel = new Date(travelDate);
    travel.setHours(23,59,59);

    const hoursSinceBooking = (now - booking) / (1000*60*60);

    //  RULES
    if(hoursSinceBooking <= 24){
        return 1; // 100%
    } else if(now < travel){
        return 0.6; // 60%
    } else {
        return 0; // 0%
    }
}
</script>

<?php include("footer.php")?>
<?php include("script.php")?>
</body>
</html>