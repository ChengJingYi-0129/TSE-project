<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if (strlen($_SESSION['sturecmsaid']) == 0) {
    header('location:logout.php');
} else {
    $eid = $_GET['id'];

    if (isset($_POST['submit'])) {
        $new_grade = $_POST['final_grade'];

        $sql = "UPDATE enrollment SET final_grade = :grade WHERE enrollment_id = :eid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':grade', $new_grade, PDO::PARAM_STR);
        $query->bindParam(':eid', $eid, PDO::PARAM_INT);
        $query->execute();

        echo '<script>alert("Grade updated successfully.")</script>';
        echo "<script>window.location.href ='manage-grade.php'</script>";
    }

    $sql = "SELECT e.final_grade, s.Student_Name, sub.Subject_Name
            FROM enrollment e
            JOIN student_info s ON e.student_id = s.Student_ID
            JOIN subject sub ON e.Subject_Code = sub.Subject_Code
            WHERE e.enrollment_id = :eid";
    $query = $dbh->prepare($sql);
    $query->bindParam(':eid', $eid, PDO::PARAM_INT);
    $query->execute();
    $row = $query->fetch(PDO::FETCH_OBJ);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Grade</title>
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
        <h3 class="page-title">Edit Grade</h3>
    </div>
    <form method="post" class="forms-sample">
        <div class="form-group">
            <label>Student</label>
            <input type="text" class="form-control" value="<?php echo htmlentities($row->Student_Name); ?>" readonly>
        </div>
        <div class="form-group">
            <label>Subject</label>
            <input type="text" class="form-control" value="<?php echo htmlentities($row->Subject_Name); ?>" readonly>
        </div>
        <div class="form-group">
            <label>Grade</label>
            <select name="final_grade" class="form-control" required>
                <option value="">Choose</option>
                <?php foreach (['A', 'B', 'C', 'D', 'F'] as $g) { ?>
                    <option value="<?php echo $g; ?>" <?php if ($row->final_grade == $g) echo 'selected'; ?>><?php echo $g; ?></option>
                <?php } ?>
            </select>
        </div>
        <button type="submit" name="submit" class="btn btn-primary mr-2">Update</button>
    </form>
</div>
<?php include_once('includes/footer.php'); ?>
</div></div></div>
<script src="vendors/js/vendor.bundle.base.js"></script>
<script src="js/off-canvas.js"></script>
<script src="js/misc.js"></script>
</body>
</html>
<?php } ?>
