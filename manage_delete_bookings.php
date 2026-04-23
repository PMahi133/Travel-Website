<?php
include("config.php");

if(isset($_GET['id'])){
    $id = intval($_GET['id']);

    $sql = "DELETE FROM bookings WHERE id = $id";

    if(mysqli_query($link, $sql)){
        header("Location: manage_bookings.php");
        exit();
    } else {
        echo "Delete Error: " . mysqli_error($link);
    }
} else {
    echo "Invalid request!";
}
?>