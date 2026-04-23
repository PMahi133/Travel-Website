<?php
include("config.php");

if(isset($_GET['id']) && isset($_GET['action'])){
    $id = intval($_GET['id']);
    $action = $_GET['action'];

    if($action == 'confirm'){
        $status = 'confirmed';
    }
    elseif($action == 'cancel'){
        $status = 'cancelled';
    }
    else{
        header("Location: manage_bookings.php");
        exit();
    }

    $sql = "UPDATE bookings SET status='$status' WHERE id=$id";

    if(mysqli_query($link, $sql)){
        header("Location: manage_bookings.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($link);
    }
}
?>