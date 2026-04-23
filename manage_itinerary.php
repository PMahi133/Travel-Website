<?php
session_start();
include("config.php");

if (!isset($_SESSION["role"]) || $_SESSION["role"] != "admin") {
    header("Location: login1.php");
    exit();
}

$packages = mysqli_query($link, "SELECT Packageid, Packagename FROM packages ORDER BY Packageid ASC");

if(isset($_POST['add'])){
    $packageid = $_POST['packageid'];
    $day = $_POST['day'];
    $text = $_POST['text'];

    $sql = "INSERT INTO itinerary (Packageid, Day, Text) 
            VALUES ('$packageid', '$day', '$text')";
    mysqli_query($link, $sql);

    header("Location: manage_itinerary.php?packageid=".$packageid);
    exit();
}

if(isset($_POST['update'])){
    $packageid = $_POST['packageid'];
    $old_day = $_POST['old_day'];   // original
    $new_day = $_POST['day'];       // edited
    $text = $_POST['text'];

    $sql = "UPDATE itinerary 
            SET Day='$new_day', Text='$text' 
            WHERE Packageid='$packageid' AND Day='$old_day'
            LIMIT 1";

    if(mysqli_query($link, $sql)){
        header("Location: manage_itinerary.php?packageid=".$packageid);
        exit();
    } else {
        echo "Update Error: " . mysqli_error($link);
    }
}

if(isset($_GET['delete'])){
    $packageid = $_GET['packageid'];
    $day = $_GET['day'];

    mysqli_query($link, "DELETE FROM itinerary WHERE Packageid='$packageid' AND Day='$day'");

    header("Location: manage_itinerary.php?packageid=".$packageid);
    exit();
}

$filterPackage = isset($_GET['packageid']) ? $_GET['packageid'] : null;

$query = "SELECT i.*, p.Packagename 
          FROM itinerary i 
          LEFT JOIN packages p ON i.Packageid = p.Packageid";

if($filterPackage){
    $query .= " WHERE i.Packageid = '$filterPackage'";
}

$query .= " ORDER BY i.Packageid, i.Day ASC";

$result = mysqli_query($link, $query);

if(!$result){
    die("Query failed: " . mysqli_error($link));
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Manage Itinerary</title>
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

      <!-- Add Itinerary -->
      <div class="card shadow mb-4">
        <div class="card-header bg-primary text-white">
          <h5>➕ Add Itinerary</h5>
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
              <div class="col-md-2">
                <label>Day</label>
                <input type="number" name="day" class="form-control" required>
              </div>
              <div class="col-md-6">
                <label>Text</label>
                <input type="text" name="text" class="form-control" required>
              </div>
              <div class="col-12 text-center">
                <button type="submit" name="add" class="btn btn-success px-4">Add Itinerary</button>
              </div>
            </div>
          </form>
        </div>
      </div>

      <!-- Itinerary Table -->
      <div class="card shadow">
        <div class="card-header bg-dark text-white">
          <h2 align="center" style="color: white;"> Itineraries</h2>
        </div>
        <div class="card-body">
          <table class="table table-bordered table-striped">
            <thead class="table-dark">
              <tr>
                <th>Package</th>
                <th>Old Day</th>
                <th>New Day</th>
                <th>Text</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
          <?php while($row = mysqli_fetch_assoc($result)){ ?>
<form method="POST">
<tr>
    <td>
        <?php echo $row['Packagename']; ?>
        <input type="hidden" name="packageid" value="<?php echo $row['Packageid']; ?>">
    </td>

    <td>
    <?php echo $row['Day']; ?>
    <input type="hidden" name="old_day" value="<?php echo $row['Day']; ?>">
</td>

<td>
    <input type="number" name="day" value="<?php echo $row['Day']; ?>" class="form-control form-control-sm">
</td>

    <td>
        <input type="text" name="text" value="<?php echo $row['Text']; ?>" class="form-control form-control-sm">
    </td>

    <td>
        <button type="submit" name="update" class="btn btn-primary btn-sm">Update</button>

        <a href="?delete=1&packageid=<?php echo $row['Packageid']; ?>&day=<?php echo $row['Day']; ?>" 
           class="btn btn-danger btn-sm"
           onclick="return confirm('Delete this itinerary?');">
           Delete
        </a>
    </td>
</tr>
</form>
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
