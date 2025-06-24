<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if (strlen($_SESSION['sturecmsaid'] == 0)) {
  header('location:logout.php');
} else {
  $eid = $_GET['id'];

  if (isset($_POST['submit'])) {
    $semester_id = $_POST['semester_id'];
    $enrollment_date = $_POST['enrollment_date'];
    $registration_start = $_POST['registration_start'];
    $registration_end = $_POST['registration_end'];
    $Subject_Code = $_POST['Subject_Code'];
    $schedule_id = $_POST['schedule_id'];

    $sql = "UPDATE enrollment SET semester_id=:semester_id, enrollment_date=:enrollment_date,
            registration_start=:registration_start, registration_end=:registration_end,
            Subject_Code=:Subject_Code, schedule_id=:schedule_id WHERE enrollment_id=:eid";
    $query = $dbh->prepare($sql);
    $query->bindParam(':semester_id', $semester_id);
    $query->bindParam(':enrollment_date', $enrollment_date);
    $query->bindParam(':registration_start', $registration_start);
    $query->bindParam(':registration_end', $registration_end);
    $query->bindParam(':Subject_Code', $Subject_Code);
    $query->bindParam(':schedule_id', $schedule_id);
    $query->bindParam(':eid', $eid);
    $query->execute();

    echo '<script>alert("Enrollment updated successfully.");</script>';
    echo "<script>window.location.href='manage-enrollment.php'</script>";
  }

  $sql = "SELECT * FROM enrollment WHERE enrollment_id = :eid";
  $query = $dbh->prepare($sql);
  $query->bindParam(':eid', $eid);
  $query->execute();
  $row = $query->fetch(PDO::FETCH_OBJ);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Edit Enrollment</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="vendors/simple-line-icons/css/simple-line-icons.css">
  <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
  <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="vendors/select2/select2.min.css">
  <link rel="stylesheet" href="vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
  <!-- Layout styles -->
  <link rel="stylesheet" href="css/style.css" />
</head>
<body>
<div class="container-scroller">
<?php include('includes/header.php'); ?>
<div class="container-fluid page-body-wrapper">
<?php include('includes/sidebar.php'); ?>
<div class="main-panel">
<div class="content-wrapper">
  <div class="page-header">
    <h3 class="page-title">Edit Enrollment</h3>
  </div>
  <div class="card">
    <div class="card-body">
      <form method="post" class="forms-sample">
        <div class="form-group">
          <label>Semester</label>
          <select name="semester_id" class="form-control" required>
            <?php
            $stmt = $dbh->query("SELECT * FROM semester");
            while ($sem = $stmt->fetch(PDO::FETCH_OBJ)) {
              $sel = ($row->semester_id == $sem->semester_id) ? "selected" : "";
              echo "<option value='$sem->semester_id' $sel>$sem->semester_name</option>";
            }
            ?>
          </select>
        </div>
        <div class="form-group">
          <label>Enrollment Date</label>
          <input type="date" name="enrollment_date" class="form-control" value="<?php echo $row->enrollment_date; ?>" required>
        </div>
        <div class="form-group">
          <label>Registration Start</label>
          <input type="date" name="registration_start" class="form-control" value="<?php echo $row->registration_start; ?>" required>
        </div>
        <div class="form-group">
          <label>Registration End</label>
          <input type="date" name="registration_end" class="form-control" value="<?php echo $row->registration_end; ?>" required>
        </div>
        <div class="form-group">
          <label>Subject</label>
          <select name="Subject_Code" class="form-control" required>
            <?php
            $stmt = $dbh->query("SELECT * FROM subject");
            while ($sub = $stmt->fetch(PDO::FETCH_OBJ)) {
              $sel = ($row->Subject_Code == $sub->Subject_Code) ? "selected" : "";
              echo "<option value='$sub->Subject_Code' $sel>$sub->Subject_Name</option>";
            }
            ?>
          </select>
        </div>
        <div class="form-group">
          <label>Schedule</label>
          <select name="schedule_id" class="form-control">
            <option value="">None</option>
            <?php
            $stmt = $dbh->query("SELECT * FROM schedule");
            while ($sc = $stmt->fetch(PDO::FETCH_OBJ)) {
              $sel = ($row->schedule_id == $sc->schedule_id) ? "selected" : "";
              echo "<option value='$sc->schedule_id' $sel>ID: $sc->schedule_id</option>";
            }
            ?>
          </select>
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Update</button>
      </form>
    </div>
  </div>
</div>
<?php include('includes/footer.php'); ?>
</div></div></div>
<script src="vendors/js/vendor.bundle.base.js"></script>
<script src="vendors/select2/select2.min.js"></script>
<script src="js/off-canvas.js"></script>
<script src="js/misc.js"></script>
</body>
</html>
<?php } ?>
