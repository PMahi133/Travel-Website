<?php
session_start();
include("config.php");

if (!isset($_SESSION["role"]) || $_SESSION["role"] != "admin") {
    header("Location: login1.php");
    exit();
}

function getNextIid($link){
    $res = mysqli_query($link, "SELECT MAX(Iid) AS maxid FROM package_includes");
    if($res){
        $row = mysqli_fetch_assoc($res);
        return $row['maxid'] + 1;
    }
    return 1;
}

$packages = mysqli_query($link, "SELECT Packageid, Packagename FROM packages ORDER BY Packageid ASC");

if(isset($_POST['add'])){
    $packageid = $_POST['packageid'];
    $include = $_POST['include'];
    $exclude = $_POST['exclude'];

    $nextId = getNextIid($link);

    $sql = "INSERT INTO package_includes (Iid, Packageid, Include, Exclude) 
            VALUES ($nextId, '$packageid', '$include', '$exclude')";
    if(!mysqli_query($link, $sql)){
        die("Insert failed: " . mysqli_error($link));
    }
   header("Location: manage_includes.php?packageid=" . $packageid);
exit();
}


if(isset($_POST['update'])){
    $Iid = $_POST['Iid'];
    $packageid = $_POST['packageid'];
    $include = $_POST['include'];
    $exclude = $_POST['exclude'];

    $sql = "UPDATE package_includes SET 
                Packageid='$packageid',
                Include='$include',
                Exclude='$exclude'
            WHERE Iid=$Iid";
    if(!mysqli_query($link, $sql)){
        die("Update failed: " . mysqli_error($link));
    }
    header("Location: manage_includes.php?packageid=" . $packageid);
exit();
}

if(isset($_GET['delete'])){
    $Iid = $_GET['delete'];

    // get packageid before delete
    $get = mysqli_query($link, "SELECT Packageid FROM package_includes WHERE Iid=$Iid");
    $row = mysqli_fetch_assoc($get);
    $packageid = $row['Packageid'];

    mysqli_query($link, "DELETE FROM package_includes WHERE Iid=$Iid");

    header("Location: manage_includes.php?packageid=" . $packageid);
    exit();
}

$filterPackage = isset($_GET['packageid']) ? $_GET['packageid'] : null;

$query = "SELECT i.*, p.Packagename 
          FROM package_includes i 
          LEFT JOIN packages p ON i.Packageid = p.Packageid";

if($filterPackage){
    $query .= " WHERE i.Packageid = '$filterPackage'";
}

$query .= " ORDER BY i.Packageid, i.Iid ASC";

$result = mysqli_query($link, $query);
if(!$result){
    die("Query failed: " . mysqli_error($link));
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Manage Includes/Excludes</title>
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

      <!-- Add Include/Exclude -->
      <div class="card shadow mb-4">
        <div class="card-header bg-primary text-white">
          <h5>➕ Add Includes/Excludes</h5>
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
                <label>Include</label>
                <input type="text" name="include" class="form-control" required>
              </div>
              <div class="col-md-4">
                <label>Exclude</label>
                <input type="text" name="exclude" class="form-control" required>
              </div>
              <div class="col-12 text-center">
                <button type="submit" name="add" class="btn btn-success px-4">Add</button>
              </div>
            </div>
          </form>
        </div>
      </div>

      <!-- Includes/Excludes Table -->
      <div class="card shadow">
        <div class="card-header bg-dark text-white">
          <h2 align="center" style="color: white;"> Includes/Excludes </h2>
        </div>
        <div class="card-body">
          <table class="table table-bordered table-striped">
            <thead class="table-dark">
              <tr>
                <th>ID</th>
                <th>Package</th>
                <th>Include</th>
                <th>Exclude</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php 
              if($result && mysqli_num_rows($result) > 0){ 
                  while($row = mysqli_fetch_assoc($result)){ ?>
                  <tr>
                    <form method="POST">
                      <td><?php echo $row['Iid']; ?>
                        <input type="hidden" name="Iid" value="<?php echo $row['Iid']; ?>">
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
                      <td><input type="text" name="include" value="<?php echo $row['Include']; ?>" class="form-control form-control-sm"></td>
                      <td><input type="text" name="exclude" value="<?php echo $row['Exclude']; ?>" class="form-control form-control-sm"></td>
                      <td>
                        <button type="submit" name="update" class="btn btn-primary btn-sm">Update</button>
                        <a href="?delete=<?php echo $row['Iid']; ?>" class="btn btn-danger btn-sm" 
                           onclick="return confirm('Delete this record?');">Delete</a>
                      </td>
                    </form>
                  </tr>
              <?php } 
              } else { ?>
                  <tr><td colspan="5">No records found.</td></tr>
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
