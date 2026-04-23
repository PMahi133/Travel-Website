<?php include("config.php");?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Records - About Us Page</title>
    <?php include("link.php")?>
</head>
<?php 
if (!isset($_SESSION["email"]) || $_SESSION["email"] != "admin@gmail.com") {
    header("Location: login1.php");
    exit();
}
?>
<body >
    <?php include("header.php")?>
    <main class="main">
        <section id="hero" class="hero section dark-background">
            <div class="hero-background">
                <img src="assets/image/AboutUsBackground.jpg" alt="" data-aos-duration="1000">
                <div class="overlay"></div>
            </div>
            <section id="booking" >
                <div class="container">
                    <h2 align="center" style="color: white;margin-left: 200px;">Booking Records</h2>
                    <?php 
                    $sql = "SELECT id, traveler_name, email, contact_no, city, area, pincode, adults, children, travel_date, payment_mode FROM bookings";
                    $result = mysqli_query($link, $sql);
                    if ($result) {
                        if (mysqli_num_rows($result) > 0): ?>
                            <div style="margin-left: 200px;">
                                <table class="table table-striped table-bordered" >
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Id</th>
                                            <th>Traveler Name</th>
                                            <th>Email</th>
                                            <th>Contact No</th>
                                            <th>City</th>
                                            <th>Area</th>
                                            <th>Pincode</th>
                                            <th>Adults</th>
                                            <th>Children</th>
                                            <th>Travel Date</th>
                                            <th>Payment Mode</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while ($row = mysqli_fetch_assoc($result)): ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($row['id']); ?></td>
                                            <td><?php echo htmlspecialchars($row['traveler_name']); ?></td>
                                            <td><?php echo htmlspecialchars($row['email']); ?></td>
                                            <td><?php echo htmlspecialchars($row['contact_no']); ?></td>
                                            <td><?php echo htmlspecialchars($row['city']); ?></td>
                                            <td><?php echo htmlspecialchars($row['area']); ?></td>
                                            <td><?php echo htmlspecialchars($row['pincode']); ?></td>
                                            <td><?php echo htmlspecialchars($row['adults']); ?></td>
                                            <td><?php echo htmlspecialchars($row['children']); ?></td>
                                            <td><?php echo htmlspecialchars($row['travel_date']); ?></td>
                                            <td><?php echo htmlspecialchars($row['payment_mode']); ?></td>
                                        </tr>
                                        <?php endwhile; ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php else: ?>
                            <p>No booking records found.</p>
                        <?php endif; 
                    } else {
                        echo "<p>Error fetching records: " . mysqli_error($link) . "</p>";
                    }
                    ?>
                </div>
            </section>
        </section>
    </main>
    <?php include("footer.php")?>
    <?php include("script.php")?>
</body>
</html>