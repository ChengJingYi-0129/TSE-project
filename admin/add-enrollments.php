<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if (strlen($_SESSION['sturecmsaid']) == 0) {
  header('location:logout.php');
} else {
  if (isset($_POST['submit'])) {
    $student_id = $_POST['student_id'];
    $semester_id = $_POST['semester_id'];
    $enrollment_date = $_POST['enrollment_date'];
    $registration_start = $_POST['registration_start'];
    $registration_end = $_POST['registration_end'];
    $Subject_Code = $_POST['Subject_Code'];
    $schedule_id = $_POST['schedule_id'];

    $sql = "INSERT INTO enrollment(student_id, semester_id, enrollment_date, registration_start, registration_end, Subject_Code, schedule_id) 
            VALUES (:student_id, :semester_id, :enrollment_date, :registration_start, :registration_end, :Subject_Code, :schedule_id)";
    $query = $dbh->prepare($sql);
    $query->bindParam(':student_id', $student_id);
    $query->bindParam(':semester_id', $semester_id);
    $query->bindParam(':enrollment_date', $enrollment_date);
    $query->bindParam(':registration_start', $registration_start);
    $query->bindParam(':registration_end', $registration_end);
    $query->bindParam(':Subject_Code', $Subject_Code);
    $query->bindParam(':schedule_id', $schedule_id);
    $query->execute();

    echo '<script>alert("Enrollment added successfully.");</script>';
    echo "<script>window.location.href='manage-enrollment.php'</script>";
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Add Enrollment</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="vendors/select2/select2.min.css">
    <link rel="stylesheet" href="vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
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
    <h3 class="page-title">Add Enrollment</h3>
  </div>
  <div class="card">
    <div class="card-body">
      <form method="post" class="forms-sample">
        <div class="form-group">
          <label>Student</label>
          <select name="student_id" class="form-control" required>
            <option value="">Select</option>
            <?php
            $stmt = $dbh->query("SELECT Student_ID, Student_Name FROM student_info");
            while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
              echo "<option value='$row->Student_ID'>$row->Student_Name ($row->Student_ID)</option>";
            }
            ?>
          </select>
        </div>
        <div class="form-group">
          <label>Semester</label>
          <select name="semester_id" class="form-control" required>
            <option value="">Select</option>
            <?php
            $stmt = $dbh->query("SELECT semester_id, semester_name FROM semester");
            while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
              echo "<option value='$row->semester_id'>$row->semester_name</option>";
            }
            ?>
          </select>
        </div>
        <div class="form-group">
          <label>Enrollment Date</label>
          <input type="date" name="enrollment_date" class="form-control" required>
        </div>
        <div class="form-group">
          <label>Registration Start</label>
          <input type="date" name="registration_start" class="form-control" required>
        </div>
        <div class="form-group">
          <label>Registration End</label>
          <input type="date" name="registration_end" class="form-control" required>
        </div>
        <div class="form-group">
          <label>Subject</label>
          <select name="Subject_Code" class="form-control" required>
            <option value="">Select</option>
            <?php
            $stmt = $dbh->query("SELECT Subject_Code, Subject_Name FROM subject");
            while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
              echo "<option value='$row->Subject_Code'>$row->Subject_Name</option>";
            }
            ?>
          </select>
        </div>
        <div class="form-group">
          <label>Schedule</label>
          <select name="schedule_id" class="form-control">
            <option value="">Select</option>
            <?php
            $stmt = $dbh->query("SELECT schedule_id, Subject_Code, day_of_week, start_time, end_time FROM schedule");
            while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
              echo "<option value='$row->schedule_id'>[$row->Subject_Code] $row->day_of_week $row->start_time - $row->end_time</option>";
            }
            ?>
          </select>
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Add</button>
      </form>
    </div>
  </div>
</div>
<?php include('includes/footer.php'); ?>
</div></div></div>
<script src="vendors/js/vendor.bundle.base.js"></script>
<script src="js/off-canvas.js"></script>
<script src="js/misc.js"></script>
</body>
</html>
<?php } ?>
