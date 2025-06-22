<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if (strlen($_SESSION['sturecmsaid']) == 0) {
    header('location:logout.php');
} else {
    $lecturer_id = $_SESSION['sturecmsaid'];

    $sql = "SELECT sc.Subject_Code, sub.Subject_Name, sc.semester_id, se.semester_name,
                   sc.day_of_week, sc.start_time, sc.end_time, sc.location
            FROM schedule sc
            JOIN subject sub ON sc.Subject_Code = sub.Subject_Code
            JOIN semester se ON sc.semester_id = se.semester_id
            WHERE sc.lecturer_id = :lecturer_id
            ORDER BY FIELD(sc.day_of_week, 'Monday','Tuesday','Wednesday','Thursday','Friday'), sc.start_time";

    $query = $dbh->prepare($sql);
    $query->bindParam(':lecturer_id', $lecturer_id, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Student Enrollment Management || My Timetable</title>
  <link rel="stylesheet" href="vendors/simple-line-icons/css/simple-line-icons.css">
  <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
  <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="vendors/select2/select2.min.css">
  <link rel="stylesheet" href="vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
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
          <h3 class="page-title">My Timetable</h3>
        </div>
        <div class="row">
          <div class="col-12 stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title text-center">Weekly Timetable</h4>
                <hr/>
                <div class="table-responsive">
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Day</th>
                        <th>Time</th>
                        <th>Subject</th>
                        <th>Semester</th>
                        <th>Location</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $cnt = 1;
                      if ($results) {
                        foreach ($results as $row) {
                      ?>
                      <tr>
                        <td><?php echo $cnt++; ?></td>
                        <td><?php echo htmlentities($row->day_of_week); ?></td>
                        <td><?php echo htmlentities(date("H:i", strtotime($row->start_time)) . " - " . date("H:i", strtotime($row->end_time))); ?></td>
                        <td><?php echo htmlentities($row->Subject_Code . " - " . $row->Subject_Name); ?></td>
                        <td><?php echo htmlentities($row->semester_name); ?></td>
                        <td><?php echo htmlentities($row->location); ?></td>
                      </tr>
                      <?php } } else { ?>
                      <tr>
                        <td colspan="6" class="text-center">No timetable found.</td>
                      </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php include_once('includes/footer.php'); ?>
    </div>
  </div>
</div>
<script src="vendors/js/vendor.bundle.base.js"></script>
<script src="vendors/select2/select2.min.js"></script>
<script src="vendors/typeahead.js/typeahead.bundle.min.js"></script>
<script src="js/off-canvas.js"></script>
<script src="js/misc.js"></script>
<script src="js/typeahead.js"></script>
<script src="js/select2.js"></script>
</body>
</html>
<?php } ?>