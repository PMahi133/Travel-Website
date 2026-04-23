<?php
session_start();
include("config.php");

if (!isset($_SESSION["role"]) || $_SESSION["role"] != "admin") {
    header("Location: login1.php");
    exit();
}

function getNextHotelId($link){
    $res = mysqli_query($link, "SELECT MAX(Hotelid) AS maxid FROM hotel");
    $row = mysqli_fetch_assoc($res);
    return $row['maxid'] + 1;
}

$filterPackage = isset($_GET['packageid']) ? $_GET['packageid'] : null;

$packages = mysqli_query($link, "SELECT Packageid, Packagename FROM packages ORDER BY Packageid ASC");

if(isset($_POST['add'])){
    $packageid = $_POST['packageid'];
    $night = $_POST['night'];
    $hotelname = $_POST['hotelname'];
    $location = $_POST['location'];
    $service = $_POST['service'];
    $hotelinlcude = $_POST['hotelinlcude'];

    $target_dir = "assets/img/";
    if(!is_dir($target_dir)){
        mkdir($target_dir, 0777, true);
    }

    $filename = time() . "_" . basename($_FILES["hotelimg"]["name"]);
    $target_file = $target_dir . $filename;

    move_uploaded_file($_FILES["hotelimg"]["tmp_name"], $target_file);

    $nextId = getNextHotelId($link);

    $sql = "INSERT INTO hotel (Hotelid, Packageid, Night, Hotelname, Location, Service, Hotelimg, Hotelinlcude) 
            VALUES ($nextId, '$packageid', '$night', '$hotelname', '$location', '$service', '$target_file', '$hotelinlcude')";

    mysqli_query($link, $sql);
    header("Location: manage_hotels.php?packageid=" . $packageid);
exit();
}

if(isset($_POST['update'])){
    $Hotelid = $_POST['Hotelid'];
    $packageid = $_POST['packageid'];
    $night = $_POST['night'];
    $hotelname = $_POST['hotelname'];
    $location = $_POST['location'];
    $service = $_POST['service'];
    $hotelinlcude = $_POST['hotelinlcude'];

    if(!empty($_FILES["hotelimg"]["name"])){

        $target_dir = "assets/img/";
        if(!is_dir($target_dir)){
            mkdir($target_dir, 0777, true);
        }

        $filename = time() . "_" . basename($_FILES["hotelimg"]["name"]);
        $target_file = $target_dir . $filename;

        move_uploaded_file($_FILES["hotelimg"]["tmp_name"], $target_file);

        $sql = "UPDATE hotel SET 
            Packageid='$packageid',
            Night='$night',
            Hotelname='$hotelname',
            Location='$location',
            Service='$service',
            Hotelimg='$target_file',
            Hotelinlcude='$hotelinlcude'
            WHERE Hotelid=$Hotelid";

    } else {

        $sql = "UPDATE hotel SET 
            Packageid='$packageid',
            Night='$night',
            Hotelname='$hotelname',
            Location='$location',
            Service='$service',
            Hotelinlcude='$hotelinlcude'
            WHERE Hotelid=$Hotelid";
    }

    mysqli_query($link, $sql);
    header("Location: manage_hotels.php?packageid=" . $packageid);
exit();
}

if(isset($_GET['delete'])){
    $Hotelid = $_GET['delete'];
   $get = mysqli_query($link, "SELECT Packageid FROM hotel WHERE Hotelid=$Hotelid");
$row = mysqli_fetch_assoc($get);
$packageid = $row['Packageid'];

mysqli_query($link, "DELETE FROM hotel WHERE Hotelid=$Hotelid");

header("Location: manage_hotels.php?packageid=" . $packageid);
exit();
}

$query = "SELECT h.*, p.Packagename 
          FROM hotel h 
          LEFT JOIN packages p ON h.Packageid = p.Packageid";

if(!empty($filterPackage)){
    $filterPackage = (int)$filterPackage;
    $query .= " WHERE h.Packageid = $filterPackage";
}

$query .= " ORDER BY h.Hotelid ASC";

$result = mysqli_query($link, $query);

if(!$result){
    die("Query Failed: " . mysqli_error($link));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Manage Hotels</title>
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
        <a href="manage_packages.php" class="btn btn-secondary">⬅ Back</a>
      </div>
      <!-- ADD HOTEL -->
      <div class="card mb-4">
          <div class="card-header bg-primary text-white">Add Hotel</div>
            <div class="card-body">
              <form method="POST" enctype="multipart/form-data">
                  <div class="row">
                      <div class="col-md-4">
                          <label>Package</label>
                          <select name="packageid" class="form-control" required>
                              <option value="">Select</option>
                              <?php while($pkg = mysqli_fetch_assoc($packages)){ ?>
                                  <option value="<?php echo $pkg['Packageid']; ?>">
                                      <?php echo $pkg['Packagename']; ?>
                                  </option>
                              <?php } ?>
                          </select>
                      </div>
                      <div class="col-md-2">
                          <label>Nights</label>
                          <input type="number" name="night" class="form-control" required>
                      </div>
                      <div class="col-md-6">
                          <label>Hotel Name</label>
                          <input type="text" name="hotelname" class="form-control" required>
                      </div>
                      <div class="col-md-6">
                          <label>Location</label>
                          <input type="text" name="location" class="form-control" required>
                      </div>
                      <div class="col-md-6">
                          <label>Service</label>
                          <input type="text" name="service" class="form-control" required>
                      </div>
                      <div class="col-md-6">
                          <label>Upload Image</label>
                          <input type="file" name="hotelimg" class="form-control" accept="image/*" required>
                      </div>
                      <div class="col-md-6">
                          <label>Meals</label>
                          <input type="text" name="hotelinlcude" class="form-control">
                      </div>
                      <div class="col-12 text-center mt-3">
                          <button type="submit" name="add" class="btn btn-success">Add Hotel</button>
                      </div>
                  </div>
              </form>
            </div>
          </div>
          <!-- HOTEL TABLE -->
          <div class="card shadow">
            <div class="card-header bg-dark text-white">
              <h2 align="center" style="color: white;"> Hotels </h2>
            </div>
          <div class="card-body">
              <table class="table table-bordered">
                  <tr>
                      <th>ID</th>
                      <th>Package</th>
                      <th>Name</th>
                      <th>Image</th>
                      <th>Action</th>
                  </tr>
                  <?php while($row = mysqli_fetch_assoc($result)){ ?>
                  <tr>
                      <form method="POST" enctype="multipart/form-data">
                          <td><?php echo $row['Hotelid']; ?><input type="hidden" name="Hotelid" value="<?php echo $row['Hotelid']; ?>"></td>
                          <td><?php echo $row['Packagename']; ?></td>
                          <td><input type="text" name="hotelname" value="<?php echo $row['Hotelname']; ?>" class="form-control"></td>
                          <td>
                              <img src="<?php echo $row['Hotelimg']; ?>" width="80"><br>
                              <input type="file" name="hotelimg" class="form-control mt-1">
                          </td>
                          <td>
                              <button name="update" class="btn btn-primary btn-sm">Update</button>
                              <a href="?delete=<?php echo $row['Hotelid']; ?>" class="btn btn-danger btn-sm">Delete</a>
                          </td>
                      </form>
                  </tr>
                  <?php } ?>
              </table>
          </div>
      </div>

    </div>
  </section>

</main>
<?php include("footer.php")?>
<?php include("script.php") ?>
</body>
</html>