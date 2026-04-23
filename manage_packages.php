<?php
session_start();
include("config.php");

if (!isset($_SESSION["role"]) || $_SESSION["role"] != "admin") {
    header("Location: login1.php");
    exit();
}

function getNextPackageId($link){
    $res = mysqli_query($link, "SELECT MAX(Packageid) AS maxid FROM packages");
    $row = mysqli_fetch_assoc($res);
    return $row['maxid'] + 1;
}

$places = mysqli_query($link, "SELECT * FROM places ORDER BY Pid ASC");


if(isset($_POST['add'])){
    $pid = $_POST['pid'];
    $packagename = $_POST['packagename'];
    $duration = $_POST['duration'];
    $packageprice = $_POST['packageprice'];
    $transportation = $_POST['transportation'];
    $pickup = $_POST['pickup'];
    $departure = $_POST['departure'];
    $overview = $_POST['overview'];

    $nextId = getNextPackageId($link);

    $sql = "INSERT INTO packages (Packageid, Pid, Packagename, Duration, Packageprice, Transportation, Pickuplocation, Departuretime, Overview) 
            VALUES ($nextId, '$pid', '$packagename', '$duration', '$packageprice', '$transportation', '$pickup', '$departure', '$overview')";
    mysqli_query($link, $sql);
    header("Location: manage_packages.php");
    exit();
}

if(isset($_POST['update'])){
    $packageid = $_POST['Packageid'];
    $pid = $_POST['pid'];
    $packagename = $_POST['packagename'];
    $duration = $_POST['duration'];
    $packageprice = $_POST['packageprice'];
    $transportation = $_POST['transportation'];
    $pickup = $_POST['pickup'];
    $departure = $_POST['departure'];
    $overview = $_POST['overview'];

    $sql = "UPDATE packages SET 
                Pid='$pid',
                Packagename='$packagename',
                Duration='$duration',
                Packageprice='$packageprice',
                Transportation='$transportation',
                Pickuplocation='$pickup',
                Departuretime='$departure',
                Overview='$overview'
            WHERE Packageid=$packageid";
    mysqli_query($link, $sql);
    header("Location: manage_packages.php");
    exit();
}


// Handle Delete Place
if(isset($_GET['delete'])){
    $pid = $_GET['delete'];
    mysqli_query($link, "
        DELETE FROM itinerary 
        WHERE Packageid IN (SELECT Packageid FROM packages WHERE Pid = $pid)
    ");

    mysqli_query($link, "DELETE FROM packages WHERE Pid = $pid");

    mysqli_query($link, "DELETE FROM places WHERE Pid = $pid");

    header("Location: manage_places.php");
    exit();
}

$result = mysqli_query($link, "SELECT p.*, pl.Pname 
                               FROM packages p 
                               LEFT JOIN places pl ON p.Pid = pl.Pid 
                               ORDER BY Packageid DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Manage Packages</title>
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

      <!-- Add Package -->
      <div class="card shadow mb-4">
        <div class="card-header bg-primary text-white">
          <h5>➕ Add Package</h5>
        </div>
        <div class="card-body">
          <form method="POST">
            <div class="row g-3">
              <div class="col-md-4">
                <label>Select Place</label>
                <select name="pid" class="form-select" required>
                  <option value="">-- Select --</option>
                  <?php mysqli_data_seek($places, 0); while($pl = mysqli_fetch_assoc($places)){ ?>
                    <option value="<?php echo $pl['Pid']; ?>"><?php echo $pl['Pname']; ?></option>
                  <?php } ?>
                </select>
              </div>
              <div class="col-md-4">
                <label>Package Name</label>
                <input type="text" name="packagename" class="form-control" required>
              </div>
              <div class="col-md-4">
                <label>Duration</label>
                <input type="text" name="duration" class="form-control" required>
              </div>
              <div class="col-md-4">
                <label>Price</label>
                <input type="number" name="packageprice" class="form-control" required>
              </div>
              <div class="col-md-4">
                <label>Transportation</label>
                <input type="text" name="transportation" class="form-control" required>
              </div>
              <div class="col-md-4">
                <label>Pickup Location</label>
                <input type="text" name="pickup" class="form-control" required>
              </div>
              <div class="col-md-4">
                <label>Departure Time</label>
                <input type="text" name="departure" class="form-control" required>
              </div>
              <div class="col-md-12">
                <label>Overview</label>
                <textarea name="overview" class="form-control" required></textarea>
              </div>
              <div class="col-12 text-center">
                <button type="submit" name="add" class="btn btn-success px-4">Add Package</button>
              </div>
            </div>
          </form>
        </div>
      </div>

      <!-- Packages Table -->
      <div class="card shadow">
        <div class="card-header bg-dark text-white">
          <h2 align="center" style="color: white;"> Packages</h2>
        </div>
        <div class="card-body">
          <table class="table table-bordered table-striped">
            <thead class="table-dark">
              <tr>
                <th>ID</th>
                <th>Place</th>
                <th>Name</th>
                <th>Duration</th>
                <th>Price</th>
                <th>Transportation</th>
                <th>Pickup</th>
                <th>Departure</th>
                <th>Overview</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php while($row = mysqli_fetch_assoc($result)){ ?>
              <tr>
                <form method="POST">
                  <td><?php echo $row['Packageid']; ?>
                    <input type="hidden" name="Packageid" value="<?php echo $row['Packageid']; ?>">
                  </td>
                  <td>
                    <select name="pid" class="form-select form-select-sm">
                      <?php mysqli_data_seek($places, 0); while($pl = mysqli_fetch_assoc($places)){ ?>
                        <option value="<?php echo $pl['Pid']; ?>" <?php if($pl['Pid']==$row['Pid']) echo "selected"; ?>>
                          <?php echo $pl['Pname']; ?>
                        </option>
                      <?php } ?>
                    </select>
                  </td>
                  <td><input type="text" name="packagename" value="<?php echo $row['Packagename']; ?>" class="form-control form-control-sm"></td>
                  <td><input type="text" name="duration" value="<?php echo $row['Duration']; ?>" class="form-control form-control-sm"></td>
                  <td><input type="number" name="packageprice" value="<?php echo $row['Packageprice']; ?>" class="form-control form-control-sm"></td>
                  <td><input type="text" name="transportation" value="<?php echo $row['Transportation']; ?>" class="form-control form-control-sm"></td>
                  <td><input type="text" name="pickup" value="<?php echo $row['Pickuplocation']; ?>" class="form-control form-control-sm"></td>
                  <td><input type="text" name="departure" value="<?php echo $row['Departuretime']; ?>" class="form-control form-control-sm"></td>
                  <td><textarea name="overview" class="form-control form-control-sm"><?php echo $row['Overview']; ?></textarea></td>
                  <td>
                    <button type="submit" name="update" class="btn btn-primary btn-sm">Update</button>
                    <a href="?delete=<?php echo $row['Packageid']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Delete this package?');">Delete</a>
                    <a href="manage_itinerary.php?packageid=<?php echo $row['Packageid']; ?>" class="btn btn-info btn-sm">Manage Itinerary</a>
                    <a href="manage_dates.php?packageid=<?php echo $row['Packageid']; ?>" class="btn btn-warning btn-sm">Manage Dates</a>
                    <a href="manage_includes.php?packageid=<?php echo $row['Packageid']; ?>" class="btn btn-success btn-sm">Manage Includes/Excludes</a>
                    <a href="manage_hotels.php?packageid=<?php echo $row['Packageid']; ?>" class="btn btn-warning btn-sm">Manage Hotels</a>
                  </td>
                </form>
              </tr>
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
