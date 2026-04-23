<?php include("./config.php") ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php include("./link.php") ?>
    <style>
        #pimg {
            height: 650px;
            width: 600px;
            border-radius: 20%;
        }
        .payment-form h5 h3{ 
            color: while;
        }
        h5 ,h3{
            color: white;
        }
    </style>
</head>
<?php
if (!isset($_SESSION["email"])) {
    echo "<script>alert('Please log in first!'); window.location.href='login1.php';</script>";
    exit();
}
$packageId = 0;
$dateid = '';

// If coming from previous page (GET)
if (isset($_GET['PackageID']) && isset($_GET['dateid'])) {
    $packageId = intval($_GET['PackageID']);
    $dateid = $_GET['dateid'];
}

// If form submitted (POST)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $packageId = intval($_POST['PackageID']);
    $dateid = $_POST['dateid'];
}

// Final validation
if(!$packageId || !$dateid){
    echo "<script>alert('Invalid request!'); window.location.href='index.php';</script>";
    exit();
}

// Fetch package details
$sql = "SELECT p.Pimg, p.Pname, ps.Packageprice
        FROM places p
        JOIN packages ps ON p.Pid = ps.Pid
        WHERE ps.Packageid = $packageId";

$result = mysqli_query($link, $sql);
$row = mysqli_fetch_assoc($result);

$image = $row['Pimg'];
$name = $row['Pname'];
$adultPrice = $row['Packageprice'];
$childPrice = $adultPrice / 2;

// Get travel date
$getDate = mysqli_query($link, "SELECT TravelDate FROM package_date WHERE dateid='$dateid'");
$rowDate = mysqli_fetch_assoc($getDate);
$travel_date = $rowDate['TravelDate'];

// FORM SUBMIT
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $traveler = $fname . " " . $lname;
    $email = $_POST['email'];
    $number = $_POST['number'];
    $city = $_POST['city'];
    $area = $_POST['area'];
    $pincode = $_POST['pincode'];
    $adult = intval($_POST['adult']);
    $child = intval($_POST['child']);
    $payment = $_POST['pay'];

    // Capacity check
    $checkSql = "SELECT Capacity FROM package_date WHERE dateid='$dateid'";
    $checkResult = mysqli_query($link, $checkSql);
    $busData = mysqli_fetch_assoc($checkResult);
    $capacity = $busData['Capacity'];

    $countSql = "SELECT SUM(adults + children) as totalBooked FROM bookings WHERE dateid='$dateid'";
    $countResult = mysqli_query($link, $countSql);
    $countData = mysqli_fetch_assoc($countResult);
    $totalBooked = $countData['totalBooked'] ?? 0;

    $newSeats = $adult + $child;

    if(($totalBooked + $newSeats) > $capacity){
        echo "<script>alert('Bus is full!');</script>";
    } else {

        $total = ($adult * $adultPrice) + ($child * $childPrice);

// 🎯 40% payment calculation
$first_payment = $total * 0.4;

$sqlInsert = "INSERT INTO bookings 
(PackageID, traveler_name, email, contact_no, city, area, pincode, adults, children, travel_date, dateid, payment_mode, total_price, amountpaid, paymentstage, status)

VALUES 
('$packageId','$traveler','$email','$number','$city','$area','$pincode','$adult','$child','$travel_date','$dateid','$payment','$total','$first_payment',1,'active')";

        if(mysqli_query($link, $sqlInsert)){
            echo "<script>alert('Booking Confirmed!'); window.location.href='Userbooking.php';</script>";
            exit();
        } else {
            echo mysqli_error($link);
        }
    }
}
?>
<body>
    <?php include("./header.php") ?>
    <main class="main">
        <!-- Hero Section -->
        <section id="hero" class="hero section dark-background">
            <div class="hero-background">
                <img src="assets/image/bg1.jpg" alt="" data-aos-duration="1000">
                <div class="overlay"></div>
            </div>

            <div class="container  payment-form">
                <div class="row">
                    <div class="col-sm-12">
                        <center>
                            <h1 style="color: white;">Payment Here</h1>
                        </center>
                        <hr><br>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <img src="<?php echo $image; ?>" id="pimg" style="width:100%;">
                        <div class="row">
                            <div class="col-sm-12"><label for="place">
                                </label><?php echo '<center><h1 style="color:white;">' . $name . '</h1></center>'; ?></div>
                        </div><br>
                    </div>
                    <div class="col-sm-6">
                        <form action="spayment.php" method="POST">
                            <input type="hidden" name="PackageID" value="<?php echo $packageId; ?>">
                            <input type="hidden" name="dateid" value="<?php echo $dateid; ?>">
                            <input type="hidden" name="amountpaid" id="amountpaid" value="0">
                            <div class="row">
                                <label for="name">
                                    <h5>Traveler's Name :</h5>
                                </label>
                                <div class="col-sm-6"><input type="text" name="fname" id="fname" class="form-control" placeholder="Name" required></div>
                                <div class="col-sm-6"><input type="text" name="lname" id="lname" class="form-control" placeholder="Surname" required></div>
                            </div><br>
                            <div class="row">
                                <div class="col-sm-6"><label for="email">
                                        <h5>Email :</h5>
                                    </label><input type="email" name="email" id="email" class="form-control" placeholder="example123@gmail.com" required></div>
                                <div class="col-sm-6"><label for="number">
                                        <h5>Contact No :</h5>
                                    </label><input type="tel" name="number" id="number" class="form-control" value="(+91)" placeholder="(+91)00000-00000" required></div>
                            </div><br><br>

                            <div class="row">
                                <label for="address">
                                    <h3>Address :</h3><br>
                                </label>
                                <div class="col-sm-4"><label for="city">
                                        <h5>City :</h5>
                                    </label><input type="text" name="city" id="city" class="form-control" placeholder="City Name" required></div>
                                <div class="col-sm-4"><label for="area">
                                        <h5>Area :</h5>
                                    </label><input type="text" name="area" id="area" class="form-control" placeholder="Area name" required></div>
                                <div class="col-sm-4"><label for="pincode">
                                        <h5>Pincode :</h5>
                                    </label><input type="number" name="pincode" id="pincode" class="form-control" placeholder="Pincode Number"></div>
                            </div><br><br>

                            <?php $date = isset($_GET['date']) ? $_GET['date'] : '';?>
                            <div class="row">
                                <label for="persons">
                                    <h3>Date :</h3><br>
                                </label>
                                <div class="col-sm-12"><label for="adult">
                                    <h5>Date For Travel:</h5>
                                    </label><input type="date" name="date" class="form-control" value="<?php echo $travel_date; ?>" readonly>
                                </div>
                            </div><br><br>
                            <?php
                            $adultPrice = $row['Packageprice']; 
                            $childPrice = $adultPrice / 2;      
                            ?>
                            <div class="row">
                                <label for="persons">
                                    <h3>Persons :</h3><br>
                                </label>
                                <div class="col-sm-6"><label for="adult">
                                        <h5>Adults(11+) :</h5>
                                    </label><input type="number" name="adult" id="adult" class="form-control" placeholder="Total Adults" required >
                                </div>
                                <div class="col-sm-6"><label for="child">
                                        <h5>Child(5-10) :</h5>
                                    </label><input type="number" name="child" id="child" class="form-control" placeholder="Total Child" > 
                                </div>
                            </div><br><br>
                            <div id="childAlert" style="display:none;">
                                <div class="row">
                                    <div class="alert alert-warning mt-2">Children aged 1–5 years can travel free (no ticket booking charges). However, applicable charges for hotel stays, tour packages, transfers, and other services will be charged separately.</div>
                                </div>
                            </div>
                        
                            <div class="row">
                                <h3> Total Amount(Per Person: ₹<?php echo $adultPrice; ?>) &nbsp;  : &nbsp; ₹ <span id="totalPrice">0</span></h3>
                            </div><br><br>

                            <div class="row">
                                <div class="col-sm-12">
                                    <label for="child"><h3>Payment Method :</h3></label>
                                    <select name="pay" id="pay" class="form-control">
                                        <option value="select" selected disabled>--Select Payment--</option>
                                        <option value="Cash">Cash Payment</option>
                                        <option value="Online">Online Payment</option>
                                    </select></div><br><br><br>

                                <div id="onlinePayment" style="display:none; margin-top:10px;">
                                    <h5>Enter Bank Info</h5>
                                    <input style="width:500px;margin-left:50px;" type="text" id="cardNumber" placeholder="Card Number" class="form-control" maxlength="16"><br>
                                    <script>const cardNumber = document.getElementById('cardNumber').value.trim();
                                            if(!/^\d{16}$/.test(cardNumber)){alert("Card Number must be 16 digits!");
                                                return false;
                                    }</script>
                                    <input style="width:500px;margin-left:50px;" type="text" id="expiry" placeholder="MM/YY" class="form-control" maxlength="5"><br>
                                    <script>const expiry = document.getElementById('expiry').value.trim();
                                            if(!/^(0[1-9]|1[0-2])\/\d{2}$/.test(expiry)){alert("Expiry must be in MM/YY format!(ex: 08/26)");
                                                return false;
                                    }</script>
                                    <input style="width:500px;margin-left:50px;" type="text" id="cvv" placeholder="CVV" class="form-control" maxlength="3"><br>
                                    <script>const cvv = document.getElementById('cvv').value.trim();
                                            if(!/^\d{3}$/.test(cvv)){alert("CVV must be 3 digits!");
                                                return false;
                                    }</script>
                                    <h5 style="width:500px;margin-left:50px;" >Your 40% Payment: ₹ <span id="onlinePayNow">0</span></h5>
                                </div>
                            </div>
                            <div class="row mt-5">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-outline-success" id="confirmBtn">Confirm Booking</button>
                                    <a href="./index.php" class="btn btn-outline-danger">Cancle Booking</a></center>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <script>

        // Show child alert when child input is focused
        document.getElementById('child').addEventListener('focus', function() {
            document.getElementById('childAlert').style.display = 'block';
        });

        // Show payment alert when payment is selected
        document.getElementById('pay').addEventListener('change', function() {
            document.getElementById('paymentAlert').style.display = 'block';
        });
    </script>
    <script>
    const dateInput = document.getElementById("date");

    dateInput.addEventListener("change", function () {
        let selectedDate = new Date(this.value);
        let today = new Date();
        today.setHours(0,0,0,0); // remove time part

        if (selectedDate < today) {
            alert(" You cannot select a past date!");
            this.value = ""; // clear the date
        }
    });
</script>

<!-- Count Total Price -->
<script>
// Inputs
const adultInput = document.getElementById('adult');
const childInput = document.getElementById('child');
const totalPriceSpan = document.getElementById('totalPrice');
const onlinePaySpan = document.getElementById('onlinePayNow');
const paySelect = document.getElementById('pay');
const onlineDiv = document.getElementById('onlinePayment');

const adultPrice = <?php echo $adultPrice; ?>;
const childPrice = <?php echo $childPrice; ?>;

function calculateTotal() {
    const adults = parseInt(adultInput.value) || 0;
    const children = parseInt(childInput.value) || 0;

    const total = (adults * adultPrice) + (children * childPrice);
    const payNow = total * 0.4;

    // Update total amount
    totalPriceSpan.textContent = total.toLocaleString();

    // Update 40% payment if Online Payment is selected
    if(paySelect.value === 'Online'){
        onlinePaySpan.textContent = payNow.toLocaleString();
    } else {
        onlinePaySpan.textContent = '0';
    }
}

adultInput.addEventListener('input', calculateTotal);
childInput.addEventListener('input', calculateTotal);

paySelect.addEventListener('change', function() {
    if(this.value === 'Online'){
        onlineDiv.style.display = 'block';
    } else {
        onlineDiv.style.display = 'none';
    }
    calculateTotal(); // update 40% payment
});

// Initial calculation
calculateTotal();
</script>
<script>
document.getElementById('confirmBtn').addEventListener('click', function(event) {

    const payMode = document.getElementById('pay').value;
    const form = document.querySelector("form");

    if(payMode === 'Online'){

        const cardNumber = document.getElementById('cardNumber').value.trim();
        const expiry = document.getElementById('expiry').value.trim();
        const cvv = document.getElementById('cvv').value.trim();

        // Validation
        if(!cardNumber || !expiry || !cvv){
            event.preventDefault();
            alert("Please fill all bank details!");
            return;
        }

        if(!/^\d{16}$/.test(cardNumber)){
            event.preventDefault();
            alert("Card Number must be 16 digits!");
            return;
        }

        if(!/^(0[1-9]|1[0-2])\/\d{2}$/.test(expiry)){
            event.preventDefault();
            alert("Expiry must be MM/YY format!");
            return;
        }

        if(!/^\d{3}$/.test(cvv)){
            event.preventDefault();
            alert("CVV must be 3 digits!");
            return;
        }

        //  calculate amount
        const total = parseFloat(document.getElementById('totalPrice').textContent.replace(/,/g,''));
        const payNow = total * 0.4;

        document.getElementById('amountpaid').value = payNow;

        alert("Booking Confirmed! Please complete your online payment within 24 hours. Contact agency for payment instructions.");

        form.submit();
    }

    else if(payMode === 'Cash'){
        document.getElementById('amountpaid').value = 0;

        alert("Booking Confirmed! Please complete your cash payment at the agency within 24 hours. Otherwise, your booking will be automatically cancelled.");

        form.submit();
    }

    else {
        event.preventDefault();
        alert("Please select payment method!");
    }

});
</script>
    <?php include("./footer.php") ?>
    <?php include("./script.php") ?>
</body>

</html>
