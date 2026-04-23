<?php
include("config.php");

if(isset($_GET['id'])){
    $id = intval($_GET['id']);

    // booking data
    $sql = "SELECT travel_date, bookingtime, amountpaid 
            FROM bookings 
            WHERE id = $id";

    $res = mysqli_query($link, $sql);

    if(!$res){
        die("SQL Error: " . mysqli_error($link));
    }

    $row = mysqli_fetch_assoc($res);

    if(!$row){
        die("Booking not found!");
    }

    // Time objects
    $now = new DateTime();
    $booking = new DateTime($row['bookingtime']);
    $travel = new DateTime($row['travel_date']);
    $travel->setTime(23,59,59);

    // Calculate hours
    $hoursSinceBooking = ($now->getTimestamp() - $booking->getTimestamp()) / 3600;

    if($hoursSinceBooking <= 24){
        $refundPercent = 1;
    }
    elseif($now < $travel){
        $refundPercent = 0.6;
    }
    else{
        $refundPercent = 0;
    }

    $refundAmount = $row['amountpaid'] * $refundPercent;

    // Update booking
    $update = "UPDATE bookings 
               SET status='cancelled', refund='$refundAmount' 
               WHERE id=$id";

    $updateRes = mysqli_query($link, $update);

    if(!$updateRes){
        die("Update Error: " . mysqli_error($link));
    }

    echo "<script>
        alert('Booking cancelled! Refund: ₹$refundAmount');
        window.location.href='Userbooking.php';
    </script>";
    exit();
}
?>