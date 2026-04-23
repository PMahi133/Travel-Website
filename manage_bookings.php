<?php
session_start();
include("config.php");

if (!isset($_SESSION["role"]) || $_SESSION["role"] != "admin") {
    header("Location: login1.php");
    exit();
}
$where = [];

if(isset($_GET['place']) && $_GET['place'] != ''){
    $place = mysqli_real_escape_string($link, $_GET['place']);
    $where[] = "p.Pname LIKE '%$place%'";
}

if(isset($_GET['date']) && $_GET['date'] != ''){
    $date = $_GET['date'];
    $where[] = "b.travel_date = '$date'";
}

if(isset($_GET['traveler']) && $_GET['traveler'] != ''){
    $traveler = mysqli_real_escape_string($link, $_GET['traveler']);
    $where[] = "b.traveler_name LIKE '%$traveler%'";
}

$whereSQL = "";
if(count($where) > 0){
    $whereSQL = "WHERE " . implode(" AND ", $where);
}

$query = "SELECT b.id, b.traveler_name, b.email, b.contact_no, b.city, b.area, b.pincode,
                 b.adults, b.children, b.travel_date, b.payment_mode,
                 b.amountpaid, b.refund, b.status,
                 p.Pname
          FROM bookings b
          JOIN packages pk ON b.PackageID = pk.Packageid
          JOIN places p ON pk.Pid = p.Pid
          $whereSQL
          ORDER BY b.travel_date DESC";

$result = mysqli_query($link, $query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Manage Bookings</title>
<?php include("link.php"); ?>
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
      <div class="mb-3 text-end">
        <a href="dashboard.php" class="btn btn-secondary">⬅ Back</a>
      </div>

      <!-- Bookings Table -->
      <div class="card shadow" style="width: 1300px; margin-left:10px;">
        <div class="card-header bg-dark text-white">
          <h2 align="center" style="color: white;"> Bookings</h2>
        </div>

        <form method="GET" class="mb-3">
  <div class="row">
    <div class="col-md-3">
      <input type="text" name="place" class="form-control" placeholder="Search Travel Place">
    </div>
    <div class="col-md-3">
      <input type="text" name="traveler" class="form-control" placeholder="Search Traveler Name">
    </div>
    <div class="col-md-3">
      <input type="date" name="date" class="form-control">
    </div>
    <div class="col-md-3">
      <button type="submit" class="btn btn-primary">Search</button>
      <a href="manage_bookings.php" class="btn btn-secondary">Reset</a>
    </div>
  </div>
</form>

        <div class="card-body table-responsive" style="overflow-x:auto;">
          <table class="table table-bordered table-striped text-nowrap">

<!-- HEADER -->
<thead class="table-dark">
<tr>
<th>ID</th>
<th>Traveler</th>
<th>Email</th>
<th>Contact</th>
<th>City</th>
<th>Area</th>
<th>Pincode</th>
<th>Adults</th>
<th>Children</th>
<th>Travel Date</th>
<th>Travel Place</th>
<th>Payment Mode</th>
<th>Status</th>
<th>Paid Amount</th>
<th>Refund</th>
<th>Action</th>
</tr>
</thead>

<!-- BODY -->
<tbody>

<?php 
if($result && mysqli_num_rows($result)>0){ 
    while($row = mysqli_fetch_assoc($result)){ 
?>

<tr>
<td><?php echo $row['id']; ?></td>
<td><?php echo $row['traveler_name']; ?></td>
<td><?php echo $row['email']; ?></td>
<td><?php echo $row['contact_no']; ?></td>
<td><?php echo $row['city']; ?></td>
<td><?php echo $row['area']; ?></td>
<td><?php echo $row['pincode']; ?></td>
<td><?php echo $row['adults']; ?></td>
<td><?php echo $row['children']; ?></td>
<td><?php echo $row['travel_date']; ?></td>
<td><?php echo $row['Pname']; ?></td>
<td><?php echo $row['payment_mode']; ?></td>

<!-- STATUS -->
<td>
<?php
if($row['status'] == 'active'){
    echo "<span style='color:orange;'>Processing</span>";
}
elseif($row['status'] == 'confirmed'){
    echo "<span style='color:green;'>Confirmed</span>";
}
elseif($row['status'] == 'cancelled'){
    echo "<span style='color:red;'>Cancelled</span>";
}
?>
</td>

<!-- PAID -->
<td>
<?php echo ($row['status']=='confirmed') ? "₹".$row['amountpaid'] : "-"; ?>
</td>

<!-- REFUND -->
<td>
<?php echo ($row['status']=='cancelled') ? "₹".$row['refund'] : "-"; ?>
</td>

<!-- ACTION -->
<td>
<?php if($row['status'] == 'active'){ ?>
    <a href="update_booking.php?id=<?php echo $row['id']; ?>&action=confirm" class="btn btn-success btn-sm">Confirm</a>

    <a href="update_booking.php?id=<?php echo $row['id']; ?>&action=cancel" class="btn btn-danger btn-sm">Cancel</a>
<?php } ?>

<br><br>

<a href="manage_delete_bookings.php?id=<?php echo $row['id']; ?>" 
   class="btn btn-dark btn-sm"
   onclick="return confirm('Are you sure you want to delete this booking?')">
   Delete
</a>
</td>

</tr>

<?php 
    } 
} else { 
?>
<tr><td colspan="15">No bookings found</td></tr>
<?php } ?>

</tbody>
</table>
        </div>
      </div>
    </div>

  </section>
</main>
<?php include("footer.php") ?>
<?php include("script.php") ?>
</body>
</html>
