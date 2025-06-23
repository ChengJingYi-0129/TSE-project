<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if (strlen($_SESSION['sturecmsaid'] == 0)) {
  header('location:logout.php');
} else {
  $sql = "SELECT e.enrollment_id, s.Student_Name, sub.Subject_Name, se.semester_name, e.student_status, e.final_grade
          FROM enrollment e
          JOIN student_info s ON e.student_id = s.Student_ID
          JOIN subject sub ON e.Subject_Code = sub.Subject_Code
          JOIN semester se ON e.semester_id = se.semester_id";
  $query = $dbh->prepare($sql);
  $query->execute();
  $results = $query->fetchAll(PDO::FETCH_OBJ);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Manage Enrollment</title>
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
    <h3 class="page-title">Manage Enrollment</h3>
  </div>
  <div class="card">
    <div class="card-body">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>#</th>
            <th>Student</th>
            <th>Subject</th>
            <th>Semester</th>
            <th>Status</th>
            <th>Grade</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php $cnt = 1;
          foreach ($results as $row) { ?>
            <tr>
              <td><?php echo $cnt++; ?></td>
              <td><?php echo htmlentities($row->Student_Name); ?></td>
              <td><?php echo htmlentities($row->Subject_Name); ?></td>
              <td><?php echo htmlentities($row->semester_name); ?></td>
              <td><?php echo htmlentities($row->student_status); ?></td>
              <td><?php echo htmlentities($row->final_grade); ?></td>
              <td><a href="edit-enrollments.php?id=<?php echo $row->enrollment_id; ?>" class="btn btn-sm btn-info">Edit</a></td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
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
