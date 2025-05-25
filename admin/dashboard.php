<?php
session_start();
include('includes/dbconnection.php');

// 安全检查
if (!isset($_SESSION['sturecmsaid']) || empty($_SESSION['sturecmsaid'])) {
    header('Location: logout.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Student Management System | Dashboard</title>
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
                <div class="row">
                    <div class="col-md-12 grid-margin">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-sm-flex align-items-baseline report-summary-header">
                                    <h5 class="font-weight-semibold">Dashboard Summary</h5>
                                    <span class="ml-auto">Updated</span>
                                    <button class="btn btn-icons border-0 p-2"><i class="icon-refresh"></i></button>
                                </div>

                                <div class="row report-inner-cards-wrapper">

                                    <!-- Total Students -->
                                    <div class="col-md-6 col-xl report-inner-card">
                                        <div class="inner-card-text">
                                            <?php
                                            $sql = "SELECT COUNT(*) FROM student_info";
                                            $query = $dbh->prepare($sql);
                                            $query->execute();
                                            $totalStudents = $query->fetchColumn();
                                            ?>
                                            <span class="report-title">Total Students</span>
                                            <h4><?= htmlentities($totalStudents); ?></h4>
                                            <a href="manage-students.php"><span class="report-count">View Students</span></a>
                                        </div>
                                        <div class="inner-card-icon bg-info">
                                            <i class="icon-user"></i>
                                        </div>
                                    </div>

                                    <!-- Total Lecturer -->
                                    <div class="col-md-6 col-xl report-inner-card">
                                        <div class="inner-card-text">
                                            <?php
                                            $sql = "SELECT COUNT(*) FROM lecturer";
                                            $query = $dbh->prepare($sql);
                                            $query->execute();
                                            $totalStudents = $query->fetchColumn();
                                            ?>
                                            <span class="report-title">Total Lecturers</span>
                                            <h4><?= htmlentities($totalStudents); ?></h4>
                                            <a href="manage-Lec.php"><span class="report-count">View Lecturers</span></a>
                                        </div>
                                        <div class="inner-card-icon bg-info">
                                            <i class="icon-user"></i>
                                        </div>
                                    </div>

                                    <!-- Total Courses -->
                                    <div class="col-md-6 col-xl report-inner-card">
                                        <div class="inner-card-text">
                                            <?php
                                            $sql = "SELECT COUNT(*) FROM course";
                                            $query = $dbh->prepare($sql);
                                            $query->execute();
                                            $totalCourses = $query->fetchColumn();
                                            ?>
                                            <span class="report-title">Total Courses</span>
                                            <h4><?= htmlentities($totalCourses); ?></h4>
                                            <a href="manage-course.php"><span class="report-count">View Courses</span></a>
                                        </div>
                                        <div class="inner-card-icon bg-success">
                                            <i class="icon-book-open"></i>
                                        </div>
                                    </div>

                                    <!-- Total Enrollments -->
                                    <div class="col-md-6 col-xl report-inner-card">
                                        <div class="inner-card-text">
                                            <?php
                                            $sql = "SELECT COUNT(*) FROM enrollment";
                                            $query = $dbh->prepare($sql);
                                            $query->execute();
                                            $totalEnrollments = $query->fetchColumn();
                                            ?>
                                            <span class="report-title">Total Enrollments</span>
                                            <h4><?= htmlentities($totalEnrollments); ?></h4>
                                            <a href="manage-enrollments.php"><span class="report-count">View Enrollments</span></a>
                                        </div>
                                        <div class="inner-card-icon bg-warning">
                                            <i class="icon-doc"></i>
                                        </div>
                                    </div>

                                    <!-- Total Subjects -->
                                    <div class="col-md-6 col-xl report-inner-card">
                                        <div class="inner-card-text">
                                            <?php
                                            $sql = "SELECT COUNT(*) FROM subject";
                                            $query = $dbh->prepare($sql);
                                            $query->execute();
                                            $totalSubjects = $query->fetchColumn();
                                            ?>
                                            <span class="report-title">Total Subjects</span>
                                            <h4><?= htmlentities($totalSubjects); ?></h4>
                                            <a href="manage-subjects.php"><span class="report-count">View Subjects</span></a>
                                        </div>
                                        <div class="inner-card-icon bg-danger">
                                            <i class="icon-layers"></i>
                                        </div>
                                    </div>

                                </div> <!-- end row -->
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
