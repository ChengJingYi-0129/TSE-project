<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if (strlen($_SESSION['sturecmsaid'] == 0)) {
    header('location:logout.php');
} else {
    if (isset($_POST['submit'])) {
        $subject_code = $_GET['editid'];
        $subject_name = $_POST['subject_name'];
        $credit_hours = $_POST['credit_hours'];
        $graded = $_POST['graded'];
        $prereq = $_POST['prereq'];
        $elective = $_POST['elective'];
        $group = $_POST['elective_group'];

        $sql = "UPDATE subject 
                SET Subject_Name = :subject_name, 
                    Subject_Credit_Hours = :credit_hours, 
                    Graded = :graded, 
                    Prerequirement_Subject_Code = :prereq, 
                    elective = :elective, 
                    Elective_Group = :group 
                WHERE Subject_Code = :subject_code";
        $query = $dbh->prepare($sql);
        $query->bindParam(':subject_name', $subject_name, PDO::PARAM_STR);
        $query->bindParam(':credit_hours', $credit_hours, PDO::PARAM_INT);
        $query->bindParam(':graded', $graded, PDO::PARAM_INT);
        $query->bindParam(':prereq', $prereq, PDO::PARAM_STR);
        $query->bindParam(':elective', $elective, PDO::PARAM_INT);
        $query->bindParam(':group', $group, PDO::PARAM_INT);
        $query->bindParam(':subject_code', $subject_code, PDO::PARAM_STR);
        $query->execute();

        echo '<script>alert("Subject has been updated")</script>';
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Student Management System || Edit Subject</title>
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
                    <h3 class="page-title">Edit Subject</h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit Subject</li>
                        </ol>
                    </nav>
                </div>
                <div class="row">
                    <div class="col-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title" style="text-align: center;">Edit Subject</h4>
                                <form class="forms-sample" method="post">
<?php
$eid = $_GET['editid'];
$sql = "SELECT * FROM subject WHERE Subject_Code = :eid";
$query = $dbh->prepare($sql);
$query->bindParam(':eid', $eid, PDO::PARAM_STR);
$query->execute();
$results = $query->fetchAll(PDO::FETCH_OBJ);
if ($query->rowCount() > 0) {
    foreach ($results as $row) {
?>
                                    <div class="form-group">
                                        <label>Subject Code (Not Editable)</label>
                                        <input type="text" class="form-control" value="<?php echo htmlentities($row->Subject_Code); ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label>Subject Name</label>
                                        <input type="text" name="subject_name" value="<?php echo htmlentities($row->Subject_Name); ?>" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Credit Hours</label>
                                        <input type="number" name="credit_hours" value="<?php echo htmlentities($row->Subject_Credit_Hours); ?>" class="form-control" min="1" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Is Graded?</label>
                                        <select name="graded" class="form-control" required>
                                            <option value="<?php echo htmlentities($row->Graded); ?>"><?php echo $row->Graded ? 'Yes' : 'No'; ?></option>
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Prerequirement Subject Code</label>
                                        <input type="text" name="prereq" value="<?php echo htmlentities($row->Prerequirement_Subject_Code); ?>" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Is Elective?</label>
                                        <select name="elective" class="form-control" required>
                                            <option value="<?php echo htmlentities($row->elective); ?>"><?php echo $row->elective ? 'Yes' : 'No'; ?></option>
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Elective Group</label>
                                        <input type="number" name="elective_group" value="<?php echo htmlentities($row->Elective_Group); ?>" class="form-control" min="1">
                                    </div>
<?php } } ?>
                                    <button type="submit" name="submit" class="btn btn-primary mr-2">Update</button>
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
