<?php
session_start();
include("config.php");

if (!isset($_SESSION["role"]) || $_SESSION["role"] != "admin") {
    header("Location: login1.php");
    exit();
}

function getNextDateId($link){
    $res = mysqli_query($link, "SELECT MAX(dateid) AS maxid FROM package_date");
    $row = mysqli_fetch_assoc($res);
    return $row['maxid'] + 1;
}

$packages = mysqli_query($link, "SELECT Packageid, Packagename FROM packages ORDER BY Packageid ASC");

if(isset($_POST['add'])){
    $packageid = $_POST['packageid'];
    $traveldate = $_POST['traveldate'];
    $bus = $_POST['bus'];

    if(strtotime($traveldate) < strtotime(date('Y-m-d'))){
        echo "<script>alert('You cannot select a past date!'); window.location='manage_dates.php';</script>";
        exit();
    }

    $nextId = getNextDateId($link);

    $sql = "INSERT INTO package_date (dateid, Packageid, TravelDate, Bus) 
            VALUES ($nextId, '$packageid', '$traveldate', '$bus')";
    if(mysqli_query($link, $sql)){
       header("Location: manage_dates.php?packageid=" . $packageid);
exit();
    } else {
        echo "<script>alert('Error adding record: ".mysqli_error($link)."');</script>";
    }
}

// Handle Update Date
if(isset($_POST['update'])){
    $dateid = $_POST['dateid'];
    $packageid = $_POST['packageid'];
    $traveldate = $_POST['traveldate'];
    $bus = $_POST['bus'];

    if(strtotime($traveldate) < strtotime(date('Y-m-d'))){
        echo "<script>alert('You cannot select a past date!'); window.location='manage_dates.php';</script>";
        exit();
    }

    $sql = "UPDATE package_date SET 
                Packageid='$packageid',
                TravelDate='$traveldate',
                Bus='$bus'
            WHERE dateid=$dateid";
    mysqli_query($link, $sql);
   header("Location: manage_dates.php?packageid=" . $packageid);
exit();
}

if(isset($_GET['delete'])){
    $dateid = $_GET['delete'];

    // OPTIONAL: get packageid before delete
    $get = mysqli_query($link, "SELECT Packageid FROM package_date WHERE dateid=$dateid");
    $row = mysqli_fetch_assoc($get);
    $packageid = $row['Packageid'];

    mysqli_query($link, "DELETE FROM package_date WHERE dateid=$dateid");

    header("Location: manage_dates.php?packageid=" . $packageid);
    exit();
}

$filterPackage = isset($_GET['packageid']) ? $_GET['packageid'] : null;

if($filterPackage){
    $result = mysqli_query($link, "SELECT d.*, p.Packagename 
                                   FROM package_date d 
                                   LEFT JOIN packages p ON d.Packageid = p.Packageid 
                                   WHERE d.Packageid = '$filterPackage'
                                   ORDER BY d.TravelDate ASC");
} else {
    $result = mysqli_query($link, "SELECT d.*, p.Packagename 
                                   FROM package_date d 
                                   LEFT JOIN packages p ON d.Packageid = p.Packageid 
                                   ORDER BY d.Packageid, d.TravelDate ASC");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Manage Dates</title>
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

      <!-- Add Date -->
      <div class="card shadow mb-4">
        <div class="card-header bg-primary text-white">
          <h5>➕ Add Travel Date</h5>
        </div>
        <div class="card-body">
          <form method="POST">
            <div class="row g-3">
              <div class="col-md-4">
                <label>Select Package</label>
                <select name="packageid" class="form-select" required>
                  <option value="">-- Select --</option>
                  <?php mysqli_data_seek($packages, 0); while($pkg = mysqli_fetch_assoc($packages)){ ?>
                    <option value="<?php echo $pkg['Packageid']; ?>" 
                      <?php if($filterPackage == $pkg['Packageid']) echo "selected"; ?>>
                      <?php echo $pkg['Packagename']; ?>
                    </option>
                  <?php } ?>
                </select>
              </div>
              <div class="col-md-4">
                <label>Travel Date</label>
                <input type="date" name="traveldate" class="form-control" required 
                       min="<?php echo date('Y-m-d'); ?>">
              </div>
              <div class="col-md-4">
                <label>Bus</label>
                <input type="text" name="bus" class="form-control" required>
              </div>
              <div class="col-12 text-center">
                <button type="submit" name="add" class="btn btn-success px-4">Add Date</button>
              </div>
            </div>
          </form>
        </div>
      </div>

      <!-- Dates Table -->
      <div class="card shadow">
        <div class="card-header bg-dark text-white">
          <h2 align="center" style="color: white;"> Travel Dates</h2>
        </div>
        <div class="card-body">
          <table class="table table-bordered table-striped">
            <thead class="table-dark">
              <tr>
                <th>ID</th>
                <th>Package</th>
                <th>Travel Date</th>
                <th>Bus</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php while($row = mysqli_fetch_assoc($result)){ ?>
              <tr>
                <form method="POST">
                  <td><?php echo $row['dateid']; ?>
                    <input type="hidden" name="dateid" value="<?php echo $row['dateid']; ?>">
                  </td>
                  <td>
                    <select name="packageid" class="form-select form-select-sm">
                      <?php mysqli_data_seek($packages, 0); while($pkg = mysqli_fetch_assoc($packages)){ ?>
                        <option value="<?php echo $pkg['Packageid']; ?>" 
                          <?php if($pkg['Packageid']==$row['Packageid']) echo "selected"; ?>>
                          <?php echo $pkg['Packagename']; ?>
                        </option>
                      <?php } ?>
                    </select>
                  </td>
                  <td><input type="date" name="traveldate" value="<?php echo $row['TravelDate']; ?>" 
                             class="form-control form-control-sm" min="<?php echo date('Y-m-d'); ?>"></td>
                  <td><input type="text" name="bus" value="<?php echo $row['Bus']; ?>" class="form-control form-control-sm"></td>
                  <td>
                    <button type="submit" name="update" class="btn btn-primary btn-sm">Update</button>
                    <a href="?delete=<?php echo $row['dateid']; ?>" class="btn btn-danger btn-sm" 
                       onclick="return confirm('Delete this date?');">Delete</a>
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
