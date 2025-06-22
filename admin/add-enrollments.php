<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if (strlen($_SESSION['sturecmsaid'] == 0)) {
  header('location:logout.php');
} else {
  if (isset($_POST['submit'])) {
    $student_id = $_POST['student_id'];
    $semester_id = $_POST['semester_id'];
    $subject_code = $_POST['subject_code'];
    $schedule_id = $_POST['schedule_id'];
    $status = $_POST['student_status'];
    $grade = null; 
    $retake = $_POST['is_retake'];
    $enroll_date = date('Y-m-d');

    $sql = "INSERT INTO enrollment(student_id, semester_id, Subject_Code, schedule_id, student_status, final_grade, is_retake, enrollment_date)
            VALUES(:student_id, :semester_id, :subject_code, :schedule_id, :status, :grade, :retake, :enroll_date)";
    $query = $dbh->prepare($sql);
    $query->bindParam(':student_id', $student_id);
    $query->bindParam(':semester_id', $semester_id);
    $query->bindParam(':subject_code', $subject_code);
    $query->bindParam(':schedule_id', $schedule_id);
    $query->bindParam(':status', $status);
    $query->bindParam(':grade', $grade);
    $query->bindParam(':retake', $retake);
    $query->bindParam(':enroll_date', $enroll_date);
    $query->execute();

    echo '<script>alert("Enrollment added successfully")</script>';
    echo "<script>window.location.href='manage-enrollments.php'</script>";
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Add Enrollment</title>
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
    <h3 class="page-title">Add Enrollment</h3>
  </div>
  <div class="card">
    <div class="card-body">
      <form method="post">
        <div class="form-group">
          <label>Student</label>
          <select name="student_id" class="form-control" required>
            <option value="">Select</option>
            <?php
            $stmt = $dbh->query("SELECT * FROM student_info");
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
              echo "<option value='{$row['Student_ID']}'>{$row['Student_Name']}</option>";
            }
            ?>
          </select>
        </div>
        <div class="form-group">
          <label>Semester</label>
          <select name="semester_id" class="form-control" required>
            <option value="">Select</option>
            <?php
            $stmt = $dbh->query("SELECT * FROM semester");
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
              echo "<option value='{$row['semester_id']}'>{$row['semester_name']}</option>";
            }
            ?>
          </select>
        </div>
        <div class="form-group">
          <label>Subject</label>
          <select name="subject_code" id="subject_code" class="form-control" required>
            <option value="">Select Subject</option>
            <?php
            $stmt = $dbh->query("SELECT * FROM subject");
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
              echo "<option value='{$row['Subject_Code']}'>" . htmlentities($row['Subject_Name']) . "</option>";
            }
            ?>
          </select>
        </div>

        <div class="form-group">
          <label>Schedule (Based on Subject)</label>
          <select name="schedule_id" id="schedule_id" class="form-control" required>
            <option value="">Select Subject First</option>
          </select>
        </div>

        <div class="form-group">
          <label>Status</label>
          <select name="student_status" class="form-control" required>
            <option value="">Select</option>
            <option value="Active">Active</option>
            <option value="Withdrawn">Withdrawn</option>
          </select>
        </div>

        <div class="form-group">
          <label>Is Retake?</label>
          <select name="is_retake" class="form-control" required>
            <option value="">Select</option>
            <option value="0">No</option>
            <option value="1">Yes</option>
          </select>
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Add</button>
      </form>
    </div>
  </div>
</div>
<?php include_once('includes/footer.php'); ?>
</div></div></div>

<script src="vendors/js/vendor.bundle.base.js"></script>
<script src="js/off-canvas.js"></script>
<script src="js/misc.js"></script>

<script>
document.getElementById('subject_code').addEventListener('change', function() {
    var subjectCode = this.value;
    var scheduleSelect = document.getElementById('schedule_id');
    scheduleSelect.innerHTML = '<option>Loading...</option>';

    if (subjectCode !== '') {
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "get-schedule-by-subject.php?subject_code=" + encodeURIComponent(subjectCode), true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                scheduleSelect.innerHTML = xhr.responseText;
            }
        };
        xhr.send();
    } else {
        scheduleSelect.innerHTML = '<option value="">Select Subject First</option>';
    }
});
</script>

</body>
</html>
<?php } ?>
