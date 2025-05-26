<?php
session_start();
include('includes/dbconnection.php');

if (!isset($_SESSION['sturecmsaid']) || empty($_SESSION['sturecmsaid'])) {
    header("Location: logout.php");
    exit();
}

if (isset($_POST['submit'])) {
    $id = $_POST['lecturer_id'];
    $fname = $_POST['first_name'];
    $lname = $_POST['last_name'];
    $password = password_hash($_POST['Pass'], PASSWORD_DEFAULT);
    $contact = $_POST['Contact_Num'];
    $email = $_POST['email'];
    $department = $_POST['department'];

    $check = $dbh->prepare("SELECT lecturer_id FROM lecturer WHERE lecturer_id = :id");
    $check->bindParam(':id', $id, PDO::PARAM_STR);
    $check->execute();

    if ($check->rowCount() > 0) {
        echo "<script>alert('Lecturer ID already exists');</script>";
    } else {
        $sql = "INSERT INTO lecturer (lecturer_ID, first_name, last_name, Pass, Contact_Num, email, department)
                VALUES (:id, :fname, :lname, :password, :contact, :email, :department)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':id', $id, PDO::PARAM_STR);
        $query->bindParam(':fname', $fname, PDO::PARAM_STR);
        $query->bindParam(':lname', $lname, PDO::PARAM_STR);
        $query->bindParam(':password', $password, PDO::PARAM_STR);
        $query->bindParam(':contact', $contact, PDO::PARAM_STR);
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->bindParam(':department', $department, PDO::PARAM_STR);

        if ($query->execute()) {
            echo "<script>alert('Lecturer added successfully');</script>";
            echo "<script>window.location.href='add-Lec.php';</script>";
        } else {
            echo "<script>alert('Error occurred');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Student Enrollment Management || Add Lecturer</title>
    <link rel="stylesheet" href="vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="container-scroller">
    <?php include_once('includes/header.php'); ?>
    <div class="container-fluid page-body-wrapper">
        <?php include_once('includes/sidebar.php'); ?>
        <div class="main-panel">
            <div class="content-wrapper">
                <div class="page-header">
                    <h3 class="page-title"> Add Lecturer </h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page"> Add Lecturer</li>
                        </ol>
                    </nav>
                </div>

                <div class="row">
                    <div class="col-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title text-center">Add Lecturer Details</h4>
                                <hr />
                                <form class="forms-sample" method="post">
                                    <div class="form-group">
                                        <label>Lecturer ID</label>
                                        <input type="text" name="lecturer_id" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>First Name</label>
                                        <input type="text" name="first_name" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Last Name</label>
                                        <input type="text" name="last_name" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" name="Pass" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Contact Number</label>
                                        <input type="text" name="Contact_Num" class="form-control" required pattern="[0-9]+" maxlength="10">
                                    </div>
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" name="email" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Department</label>
                                        <input type="text" name="department" class="form-control" required>
                                    </div>
                                    <button type="submit" name="submit" class="btn btn-primary mr-2">Add Lecturer</button>
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
