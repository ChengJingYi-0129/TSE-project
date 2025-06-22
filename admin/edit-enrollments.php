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
        $subject_code = $_POST['subject_code'];
        $schedule_id = $_POST['schedule_id'];
        $student_status = $_POST['student_status'];
        $final_grade = $_POST['final_grade'];
        $is_retake = $_POST['is_retake'];

        $sql = "UPDATE enrollment 
                SET semester_id = :semester_id,
                    Subject_Code = :subject_code,
                    schedule_id = :schedule_id,
                    student_status = :student_status,
                    final_grade = :final_grade,
                    is_retake = :is_retake
                WHERE enrollment_id = :eid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':semester_id', $semester_id);
        $query->bindParam(':subject_code', $subject_code);
        $query->bindParam(':schedule_id', $schedule_id);
        $query->bindParam(':student_status', $student_status);
        $query->bindParam(':final_grade', $final_grade);
        $query->bindParam(':is_retake', $is_retake);
        $query->bindParam(':eid', $eid);
        $query->execute();

        echo '<script>alert("Enrollment updated successfully")</script>';
        echo "<script>window.location.href='manage-enrollment.php'</script>";
    }

    $sql = "SELECT * FROM enrollment WHERE enrollment_id = :eid";
    $query = $dbh->prepare($sql);
    $query->bindParam(':eid', $eid);
    $query->execute();
    $row = $query->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Edit Enrollment</title>
  <link rel="stylesheet" href="vendors/simple-line-icons/css/simple-line-icons.css">
  <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="css/style.css" />
</head>
<body>
<div class="container-scroller">
<?php include_once('includes/header.php'); ?>
<div class="container-fluid page-body-wrapper">
<?php include_once('includes/sidebar.php'); ?>
<div class="main-panel">
<div class="content-wrapper">
  <div class="page-header">
    <h3 class="page-title">Edit Enrollment</h3>
  </div>
  <div class="card">
    <div class="card-body">
      <form method="post">
        <div class="form-group">
          <label>Student ID</label>
          <input type="text" class="form-control" value="<?php echo htmlentities($row['student_id']); ?>" readonly>
        </div>
        <div class="form-group">
          <label>Semester</label>
          <select name="semester_id" class="form-control" required>
            <option value="">Select</option>
            <?php
            $stmt = $dbh->query("SELECT * FROM semester");
            while ($sem = $stmt->fetch(PDO::FETCH_ASSOC)) {
              $selected = $sem['semester_id'] == $row['semester_id'] ? "selected" : "";
              echo "<option value='{$sem['semester_id']}' $selected>{$sem['semester_name']}</option>";
            }
            ?>
          </select>
        </div>
        <div class="form-group">
          <label>Subject</label>
          <select name="subject_code" class="form-control" required>
            <option value="">Select</option>
            <?php
            $stmt = $dbh->query("SELECT * FROM subject");
            while ($sub = $stmt->fetch(PDO::FETCH_ASSOC)) {
              $selected = $sub['Subject_Code'] == $row['Subject_Code'] ? "selected" : "";
              echo "<option value='{$sub['Subject_Code']}' $selected>{$sub['Subject_Name']}</option>";
            }
            ?>
          </select>
        </div>
        <div class="form-group">
          <label>Schedule</label>
          <select name="schedule_id" class="form-control" required>
            <option value="">Select</option>
            <?php
            $stmt = $dbh->query("SELECT schedule_id FROM schedule");
            while ($sc = $stmt->fetch(PDO::FETCH_ASSOC)) {
              $selected = $sc['schedule_id'] == $row['schedule_id'] ? "selected" : "";
              echo "<option value='{$sc['schedule_id']}' $selected>{$sc['schedule_id']}</option>";
            }
            ?>
          </select>
        </div>
        <div class="form-group">
          <label>Status</label>
          <select name="student_status" class="form-control" required>
            <option value="">Select</option>
            <option value="Active" <?php if ($row['student_status'] == 'Active') echo 'selected'; ?>>Active</option>
            <option value="Withdrawn" <?php if ($row['student_status'] == 'Withdrawn') echo 'selected'; ?>>Withdrawn</option>
          </select>
        </div>
        <div class="form-group">
          <label>Final Grade</label>
          <input type="text" name="final_grade" class="form-control" value="<?php echo htmlentities($row['final_grade']); ?>">
        </div>
        <div class="form-group">
          <label>Is Retake?</label>
          <select name="is_retake" class="form-control" required>
            <option value="">Select</option>
            <option value="0" <?php if ($row['is_retake'] == 0) echo 'selected'; ?>>No</option>
            <option value="1" <?php if ($row['is_retake'] == 1) echo 'selected'; ?>>Yes</option>
          </select>
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Update</button>
      </form>
    </div>
  </div>
</div>
<?php include_once('includes/footer.php'); ?>
</div></div></div>
<script src="vendors/js/vendor.bundle.base.js"></script>
<script src="js/off-canvas.js"></script>
<script src="js/misc.js"></script>
</body>
</html>
<?php } ?>
