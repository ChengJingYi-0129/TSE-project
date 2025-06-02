<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['sturecmsaid'] == 0)) {
  header('location:logout.php');
} else {
  if (isset($_POST['submit'])) {
    $stuname = $_POST['stuname'];
    $stuid = $_POST['stuid'];
    $connum = $_POST['connum'];
    $eid = $_GET['editid'];
    $faculty_id = $_POST['faculty_id'];

    $sql = "UPDATE student_info 
            SET Student_Name=:stuname, 
                Student_Contact_Number=:connum, 
                faculty_id=:faculty_id 
            WHERE Student_ID=:eid";
    $query = $dbh->prepare($sql);
    $query->bindParam(':stuname', $stuname, PDO::PARAM_STR);
    $query->bindParam(':connum', $connum, PDO::PARAM_STR);
    $query->bindParam(':faculty_id', $faculty_id, PDO::PARAM_STR);
    $query->bindParam(':eid', $eid, PDO::PARAM_STR);
    $query->execute();
    echo '<script>alert("Student has been updated")</script>';
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Student Enrollment Management || Update Student</title>
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
          <h3 class="page-title">Update Student</h3>
        </div>
        <div class="row">
          <div class="col-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title text-center">Update Student Details</h4>
                <hr/>
                <form class="forms-sample" method="post">
                  <?php
                  $eid = $_GET['editid'];
                  $sql = "SELECT * FROM student_info WHERE Student_ID = :eid";
                  $query = $dbh->prepare($sql);
                  $query->bindParam(':eid', $eid, PDO::PARAM_STR);
                  $query->execute();
                  $results = $query->fetchAll(PDO::FETCH_OBJ);
                  if ($query->rowCount() > 0) {
                    foreach ($results as $row) {
                  ?>
                  <div class="form-group">
                    <label>Student Name</label>
                    <input type="text" name="stuname" value="<?php echo htmlentities($row->Student_Name); ?>" class="form-control" required>
                  </div>
                  <div class="form-group">
                    <label>Student ID</label>
                    <input type="text" name="stuid" value="<?php echo htmlentities($row->Student_ID); ?>" class="form-control" readonly>
                  </div>
                  <div class="form-group">
                    <label>Faculty</label>
                    <select name="faculty_id" class="form-control" required>
                      <option value="">-- Select Faculty --</option>
                      <?php
                        $sql = "SELECT * FROM faculty";
                        $query = $dbh->prepare($sql);
                        $query->execute();
                        $faculties = $query->fetchAll(PDO::FETCH_OBJ);
                        foreach ($faculties as $f) {
                          $selected = ($row->faculty_id == $f->faculty_id) ? "selected" : "";
                          echo "<option value='" . htmlentities($f->faculty_id) . "' $selected>" . htmlentities($f->faculty_name) . "</option>";
                        }
                      ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Contact Number</label>
                    <input type="text" name="connum" value="<?php echo htmlentities($row->Student_Contact_Number); ?>" class="form-control" required maxlength="10">
                  </div>
                  <?php } } ?>
                  <button type="submit" class="btn btn-primary mr-2" name="submit">Update</button>
                </form>
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