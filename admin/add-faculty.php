<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if (strlen($_SESSION['sturecmsaid'] == 0)) {
    header('location:logout.php');
} else {
    if (isset($_POST['submit'])) {
        $faculty_id = $_POST['faculty_id'];
        $faculty_name = $_POST['faculty_name'];

        $sql = "INSERT INTO faculty (faculty_id, faculty_name) VALUES (:fid, :fname)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':fid', $faculty_id, PDO::PARAM_STR);
        $query->bindParam(':fname', $faculty_name, PDO::PARAM_STR);
        $query->execute();

        echo '<script>alert("Faculty added successfully.")</script>';
        echo "<script>window.location.href ='manage-faculty.php'</script>";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add Faculty</title>
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
<?php include_once('includes/header.php'); ?>
<div class="container-fluid page-body-wrapper">
<?php include_once('includes/sidebar.php'); ?>
<div class="main-panel">
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">Add Faculty</h3>
    </div>
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <form class="forms-sample" method="post">
                        <div class="form-group">
                            <label>Faculty ID</label>
                            <input type="text" name="faculty_id" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Faculty Name</label>
                            <input type="text" name="faculty_name" class="form-control" required>
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary mr-2">Add</button>
                    </form>
                </div>
            </div>
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
