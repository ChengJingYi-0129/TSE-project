<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if (strlen($_SESSION['sturecmsaid']) == 0) {
    header('location:logout.php');
} else {
    if (isset($_POST['submit'])) {
        $enrollment_id = $_POST['enrollment_id'];
        $final_grade = $_POST['final_grade'];

        $sql = "UPDATE enrollment SET final_grade = :grade WHERE enrollment_id = :eid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':grade', $final_grade, PDO::PARAM_STR);
        $query->bindParam(':eid', $enrollment_id, PDO::PARAM_INT);
        $query->execute();

        echo '<script>alert("Grade assigned successfully.")</script>';
        echo "<script>window.location.href ='add-grade.php'</script>";
    }

    $lecturer = $_SESSION['sturecmsaid'];

    $sql = "SELECT e.enrollment_id, s.Student_Name, sub.Subject_Name
            FROM enrollment e
            JOIN student_info s ON e.student_id = s.Student_ID
            JOIN schedule sc ON e.schedule_id = sc.schedule_id
            JOIN subject sub ON e.Subject_Code = sub.Subject_Code
            WHERE sc.lecturer_id = :lid AND e.final_grade IS NULL";
    $query = $dbh->prepare($sql);
    $query->bindParam(':lid', $lecturer, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add Grade</title>
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
        <h3 class="page-title">Add Grade</h3>
    </div>
    <form method="post" class="forms-sample">
        <div class="form-group">
            <label>Select Student & Subject</label>
            <select name="enrollment_id" class="form-control" required>
                <option value="">Choose</option>
                <?php foreach ($results as $row) { ?>
                    <option value="<?php echo $row->enrollment_id; ?>">
                        <?php echo htmlentities($row->Student_Name . ' - ' . $row->Subject_Name); ?>
                    </option>
                <?php } ?>
            </select>
        </div>
        <div class="form-group">
            <label>Grade</label>
            <select name="final_grade" class="form-control" required>
                <option value="">Choose</option>
                <option>A</option><option>B</option><option>C</option><option>D</option><option>F</option>
            </select>
        </div>
        <button type="submit" name="submit" class="btn btn-primary mr-2">Assign Grade</button>
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
