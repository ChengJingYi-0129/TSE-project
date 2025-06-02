<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if (strlen($_SESSION['sturecmsaid'] == 0)) {
  header('location:logout.php');
} else {
  if (isset($_POST['submit'])) {
    $lecname = $_POST['lecname'];
    $lecid = $_POST['lecid']; 
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $connum = $_POST['connum'];
    $faculty_id = $_POST['faculty_id'];

    $sql = "UPDATE lecturer 
            SET first_name=:lecname, last_name=:lastname, email=:email, 
                Contact_Num=:connum, faculty_id=:faculty_id 
            WHERE lecturer_id=:lecid";
    $query = $dbh->prepare($sql);
    $query->bindParam(':lecname', $lecname, PDO::PARAM_STR);
    $query->bindParam(':lastname', $lastname, PDO::PARAM_STR);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->bindParam(':connum', $connum, PDO::PARAM_STR);
    $query->bindParam(':faculty_id', $faculty_id, PDO::PARAM_STR);
    $query->bindParam(':lecid', $lecid, PDO::PARAM_STR);
    $query->execute();

    echo '<script>alert("Lecturer has been updated")</script>';
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Student Enrollment Management || Update Lecturer</title>
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
          <h3 class="page-title">Update Lecturer</h3>
        </div>
        <div class="row">
          <div class="col-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title text-center">Update Lecturer Details</h4>
                <hr/>
                <form class="forms-sample" method="post">
                  <?php
                  $eid = $_GET['editid'];
                  $sql = "SELECT * FROM lecturer WHERE lecturer_id = :eid";
                  $query = $dbh->prepare($sql);
                  $query->bindParam(':eid', $eid, PDO::PARAM_STR);
                  $query->execute();
                  $results = $query->fetchAll(PDO::FETCH_OBJ);
                  if ($query->rowCount() > 0) {
                    foreach ($results as $row) {
                  ?>
                  <div class="form-group">
                    <label>First Name</label>
                    <input type="text" name="lecname" value="<?php echo htmlentities($row->first_name); ?>" class="form-control" required>
                  </div>
                  <div class="form-group">
                    <label>Last Name</label>
                    <input type="text" name="lastname" value="<?php echo htmlentities($row->last_name); ?>" class="form-control">
                  </div>
                  <div class="form-group">
                    <label>Lecturer ID</label>
                    <input type="text" name="lecid" value="<?php echo htmlentities($row->lecturer_id); ?>" class="form-control" readonly>
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
                    <label>Email</label>
                    <input type="email" name="email" value="<?php echo htmlentities($row->email); ?>" class="form-control">
                  </div>
                  <div class="form-group">
                    <label>Contact Number</label>
                    <input type="text" name="connum" value="<?php echo htmlentities($row->Contact_Num); ?>" class="form-control" required maxlength="10">
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
