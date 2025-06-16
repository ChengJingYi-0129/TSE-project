<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if (strlen($_SESSION['sturecmsaid'] == 0)) {
    header('location:logout.php');
} else {
    $id = $_GET['id'];

    if (isset($_POST['submit'])) {
        $faculty_name = $_POST['faculty_name'];
        $sql = "UPDATE faculty SET faculty_name = :fname WHERE faculty_id = :fid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':fname', $faculty_name, PDO::PARAM_STR);
        $query->bindParam(':fid', $id, PDO::PARAM_STR);
        $query->execute();

        echo '<script>alert("Faculty updated successfully.")</script>';
        echo "<script>window.location.href ='manage-faculty.php'</script>";
    }

    $sql = "SELECT * FROM faculty WHERE faculty_id = :fid";
    $query = $dbh->prepare($sql);
    $query->bindParam(':fid', $id, PDO::PARAM_STR);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_OBJ);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Faculty</title>
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
        <h3 class="page-title">Edit Faculty</h3>
    </div>
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <form class="forms-sample" method="post">
                        <div class="form-group">
                            <label>Faculty ID</label>
                            <input type="text" class="form-control" value="<?php echo htmlentities($result->faculty_id); ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label>Faculty Name</label>
                            <input type="text" name="faculty_name" class="form-control" value="<?php echo htmlentities($result->faculty_name); ?>" required>
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary mr-2">Update</button>
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
