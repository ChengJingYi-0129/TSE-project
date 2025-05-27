<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if (strlen($_SESSION['sturecmsaid'] == 0)) {
    header('location:logout.php');
} else {
    // 拉出所有 subject 列表，用来填充下拉菜单
    $subjectQuery = $dbh->prepare("SELECT Subject_Code, Subject_Name FROM subject");
    $subjectQuery->execute();
    $subjects = $subjectQuery->fetchAll(PDO::FETCH_ASSOC);

    if (isset($_POST['submit'])) {
        $code = $_POST['subject_code'];
        $name = $_POST['subject_name'];
        $credit = $_POST['credit_hours'];
        $graded = $_POST['graded'];
        $prereq = $_POST['prereq'] != '' ? $_POST['prereq'] : null;  // 空值转为 null
        $elective = $_POST['elective'];

        $sql = "INSERT INTO subject (Subject_Code, Subject_Name, Subject_Credit_Hours, Graded, Prerequirement_Subject_Code, elective)
                VALUES (:code, :name, :credit, :graded, :prereq, :elective)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':code', $code, PDO::PARAM_STR);
        $query->bindParam(':name', $name, PDO::PARAM_STR);
        $query->bindParam(':credit', $credit, PDO::PARAM_INT);
        $query->bindParam(':graded', $graded, PDO::PARAM_INT);
        $query->bindParam(':prereq', $prereq, PDO::PARAM_STR);
        $query->bindParam(':elective', $elective, PDO::PARAM_INT);

        $query->execute();
        echo '<script>alert("Subject has been added.")</script>';
        echo "<script>window.location.href ='add-subject.php'</script>";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Student Management System || Add Subject</title>
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
                    <h3 class="page-title">Add Subject</h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Add Subject</li>
                        </ol>
                    </nav>
                </div>
                <div class="row">
                    <div class="col-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title" style="text-align: center;">Add Subject</h4>
                                <form class="forms-sample" method="post">
                                    <div class="form-group">
                                        <label>Subject Code</label>
                                        <input type="text" name="subject_code" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Subject Name</label>
                                        <input type="text" name="subject_name" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Credit Hours</label>
                                        <input type="number" name="credit_hours" class="form-control" min="1" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Is Graded?</label>
                                        <select name="graded" class="form-control" required>
                                            <option value="">Choose</option>
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Prerequirement Subject Code</label>
                                        <select name="prereq" class="form-control">
                                            <option value="">-- None --</option>
                                            <?php foreach ($subjects as $subject) { ?>
                                                <option value="<?php echo $subject['Subject_Code']; ?>">
                                                    <?php echo $subject['Subject_Code'] . " - " . $subject['Subject_Name']; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Is Elective?</label>
                                        <select name="elective" class="form-control" required>
                                            <option value="">Choose</option>
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select>
                                    </div>
                                    <button type="submit" name="submit" class="btn btn-primary mr-2">Add</button>
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
<script src="js/off-canvas.js"></script>
<script src="js/misc.js"></script>
</body>
</html>
<?php } ?>
