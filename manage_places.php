<?php
session_start();
include("config.php");

if (!isset($_SESSION["role"]) || $_SESSION["role"] != "admin") {
    header("Location: login1.php");
    exit();
}

function getNextPid($link){
    $res = mysqli_query($link, "SELECT MAX(Pid) AS maxid FROM places");
    $row = mysqli_fetch_assoc($res);
    return $row['maxid'] + 1;
}

if(isset($_POST['add'])){
    $pname = $_POST['pname'];
    $season = $_POST['season'];

    if($season == "summer"){
        $target_dir = "assets/image/imagesummer/";
    } elseif($season == "winter"){
        $target_dir = "assets/image/imageswinter/";
    } elseif($season == "monsoon"){
        $target_dir = "assets/image/monsoon/";
    } else {
        $target_dir = "assets/image/Other_package/";
    }

    if(!is_dir($target_dir)) { mkdir($target_dir, 0777, true); }

    $filename = time() . "_" . basename($_FILES["pimg"]["name"]);
    $target_file = $target_dir . $filename;
    move_uploaded_file($_FILES["pimg"]["tmp_name"], $target_file);

    $nextPid = getNextPid($link);

    $sql = "INSERT INTO places (Pid, Pname, Season, Pimg) 
            VALUES ($nextPid, '$pname', '$season', '$target_file')";
    mysqli_query($link, $sql);
    header("Location: manage_places.php");
    exit();
}

if(isset($_POST['update'])){
    $pid = $_POST['Pid'];
    $pname = $_POST['pname'];
    $season = $_POST['season'];

    if(!empty($_FILES["pimg"]["name"])){
        if($season == "summer"){
            $target_dir = "assets/image/imagesummer/";
        } elseif($season == "winter"){
            $target_dir = "assets/image/imageswinter/";
        } elseif($season == "monsoon"){
            $target_dir = "assets/image/monsoon/";
        } else {
            $target_dir = "assets/image/Other_package/";
        }

        if(!is_dir($target_dir)) { mkdir($target_dir, 0777, true); }

        $filename = time() . "_" . basename($_FILES["pimg"]["name"]);
        $target_file = $target_dir . $filename;
        move_uploaded_file($_FILES["pimg"]["tmp_name"], $target_file);

        $sql = "UPDATE places SET Pname='$pname', Season='$season', Pimg='$target_file' WHERE Pid=$pid";
    } else {
        $sql = "UPDATE places SET Pname='$pname', Season='$season' WHERE Pid=$pid";
    }

    mysqli_query($link, $sql);
    header("Location: manage_places.php");
    exit();
}

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

$result = mysqli_query($link, "SELECT * FROM places ORDER BY Pid ASC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Manage Places</title>
  <?php include("link.php") ?>
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
        <a href="dashboard.php" class="btn btn-secondary">
          <i class="bi bi-arrow-left-circle"></i> Back to Dashboard
        </a>
      </div>

      <!-- Add Place -->
      <div class="card shadow mb-4">
        <div class="card-header bg-primary text-white">
          <h5>➕ Add New Place</h5>
        </div>
        <div class="card-body">
          <form method="POST" enctype="multipart/form-data">
            <div class="row g-3">
              <div class="col-md-4">
                <label class="form-label">Place Name</label>
                <input type="text" name="pname" class="form-control" required>
              </div>
              <div class="col-md-4">
                <label class="form-label">Season</label>
                <select name="season" class="form-select" required>
                  <option value="">-- Select Season --</option>
                  <option value="summer">Summer</option>
                  <option value="winter">Winter</option>
                  <option value="monsoon">Monsoon</option>
                </select>
              </div>
              <div class="col-md-4">
                <label class="form-label">Upload Image</label>
                <input type="file" name="pimg" class="form-control" accept="image/*" required>
              </div>
              <div class="col-12 text-center mt-3">
                <button type="submit" name="add" class="btn btn-success px-4">
                  <i class="bi bi-plus-circle"></i> Add Place
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>

      <!-- Places Table -->
      <div class="card shadow">
        <div class="card-header bg-dark text-white">
          <h2 align="center" style="color: white;"> Existing Places</h2>
        </div>
        <div class="card-body">
          <table class="table table-hover table-striped align-middle">
            <thead class="table-dark">
              <tr>
                <th>Pid</th>
                <th>Place Name</th>
                <th>Season</th>
                <th>Image</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php while($row = mysqli_fetch_assoc($result)){ ?>
              <tr>
                <td><?php echo $row['Pid']; ?></td>
                <td><?php echo $row['Pname']; ?></td>
                <td><?php echo $row['Season']; ?></td>
                <td><img src="<?php echo $row['Pimg']; ?>" alt="Place Image" width="100"></td>
                <td>
                  <form method="POST" enctype="multipart/form-data" class="d-inline">
                    <input type="hidden" name="Pid" value="<?php echo $row['Pid']; ?>">
                    <input type="text" name="pname" value="<?php echo $row['Pname']; ?>" class="form-control form-control-sm mb-1" required>
                    <input type="text" name="season" value="<?php echo $row['Season']; ?>" class="form-control form-control-sm mb-1" required>
                    <input type="file" name="pimg" class="form-control form-control-sm mb-1" accept="image/*">
                    <button type="submit" name="update" class="btn btn-primary btn-sm mt-1">
                      <i class="bi bi-pencil-square"></i> Update
                    </button>
                  </form>
                  <a href="manage_places.php?delete=<?php echo $row['Pid']; ?>" 
                     class="btn btn-danger btn-sm mt-1"
                     onclick="return confirm('Are you sure you want to delete this place?');">
                     <i class="bi bi-trash"></i> Delete
                  </a>
                </td>
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
