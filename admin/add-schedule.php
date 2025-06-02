<?php
session_start();
include('includes/dbconnection.php');

if (!isset($_SESSION['sturecmsaid']) || empty($_SESSION['sturecmsaid'])) {
    header("Location: logout.php");
    exit();
}

if (isset($_POST['submit'])) {
    $subject_code = $_POST['Subject_Code'];
    $lecturer_id = $_POST['lecturer_id'];
    $day = $_POST['day_of_week'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];
    $location = $_POST['location'];
    $semester_id = $_POST['semester_id'];

    $sql = "INSERT INTO schedule (Subject_Code, lecturer_id, day_of_week, start_time, end_time, location, semester_id)
            VALUES (:subject_code, :lecturer_id, :day, :start_time, :end_time, :location, :semester_id)";
    $query = $dbh->prepare($sql);
    $query->bindParam(':subject_code', $subject_code, PDO::PARAM_STR);
    $query->bindParam(':lecturer_id', $lecturer_id, PDO::PARAM_STR);
    $query->bindParam(':day', $day, PDO::PARAM_STR);
    $query->bindParam(':start_time', $start_time, PDO::PARAM_STR);
    $query->bindParam(':end_time', $end_time, PDO::PARAM_STR);
    $query->bindParam(':location', $location, PDO::PARAM_STR);
    $query->bindParam(':semester_id', $semester_id, PDO::PARAM_STR);

    if ($query->execute()) {
        echo "<script>alert('Schedule added successfully');</script>";
        echo "<script>window.location.href='add-schedule.php';</script>";
    } else {
        echo "<script>alert('Error occurred');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Student Enrollment Management || Add Schedule</title>
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
        <h3 class="page-title"> Add Schedule </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page"> Add Schedule</li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-center">Add Class Schedule</h4>
                    <hr />
                    <form class="forms-sample" method="post">
                        <div class="form-group">
                            <label>Subject</label>
                            <select name="Subject_Code" class="form-control" required>
                                <option value="">-- Select Subject --</option>
                                <?php
                                $sql = "SELECT * FROM subject";
                                $query = $dbh->prepare($sql);
                                $query->execute();
                                $subjects = $query->fetchAll(PDO::FETCH_OBJ);
                                foreach ($subjects as $s) {
                                    echo "<option value='" . htmlentities($s->Subject_Code) . "'>" . htmlentities($s->Subject_Name) . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Lecturer</label>
                            <select name="lecturer_id" class="form-control" required>
                                <option value="">-- Select Lecturer --</option>
                                <?php
                                $sql = "SELECT * FROM lecturer";
                                $query = $dbh->prepare($sql);
                                $query->execute();
                                $lecturers = $query->fetchAll(PDO::FETCH_OBJ);
                                foreach ($lecturers as $l) {
                                    echo "<option value='" . htmlentities($l->lecturer_id) . "'>" . htmlentities($l->first_name) . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Day of Week</label>
                            <select name="day_of_week" class="form-control" required>
                                <option value="">-- Select Day --</option>
                                <option>Monday</option>
                                <option>Tuesday</option>
                                <option>Wednesday</option>
                                <option>Thursday</option>
                                <option>Friday</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Start Time</label>
                            <input type="time" name="start_time" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>End Time</label>
                            <input type="time" name="end_time" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Location</label>
                            <input type="text" name="location" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Semester</label>
                            <select name="semester_id" class="form-control" required>
                                <option value="">-- Select Semester --</option>
                                <?php
                                $sql = "SELECT * FROM semester";
                                $query = $dbh->prepare($sql);
                                $query->execute();
                                $semesters = $query->fetchAll(PDO::FETCH_OBJ);
                                foreach ($semesters as $sem) {
                                    echo "<option value='" . htmlentities($sem->semester_id) . "'>" . htmlentities($sem->semester_name) . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary mr-2">Add Schedule</button>
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
