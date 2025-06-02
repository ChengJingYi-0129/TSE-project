<?php
session_start();
include('includes/dbconnection.php');

if (!isset($_SESSION['sturecmsaid']) || empty($_SESSION['sturecmsaid'])) {
    header("Location: logout.php");
    exit();
}

if (!isset($_GET['editid']) || empty($_GET['editid'])) {
    echo "<script>alert('Invalid schedule ID.'); window.location.href='manage-schedule.php';</script>";
    exit();
}

$schedule_id = $_GET['editid'];

if (isset($_POST['submit'])) {
    $subject_code = $_POST['Subject_Code'];
    $lecturer_id = $_POST['lecturer_id'];
    $day = $_POST['day_of_week'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];
    $location = $_POST['location'];
    $semester_id = $_POST['semester_id'];

    $sql = "UPDATE schedule SET Subject_Code=:subject_code, lecturer_id=:lecturer_id, day_of_week=:day, start_time=:start_time, end_time=:end_time, location=:location, semester_id=:semester_id WHERE schedule_id=:schedule_id";
    $query = $dbh->prepare($sql);
    $query->bindParam(':subject_code', $subject_code, PDO::PARAM_STR);
    $query->bindParam(':lecturer_id', $lecturer_id, PDO::PARAM_STR);
    $query->bindParam(':day', $day, PDO::PARAM_STR);
    $query->bindParam(':start_time', $start_time, PDO::PARAM_STR);
    $query->bindParam(':end_time', $end_time, PDO::PARAM_STR);
    $query->bindParam(':location', $location, PDO::PARAM_STR);
    $query->bindParam(':semester_id', $semester_id, PDO::PARAM_STR);
    $query->bindParam(':schedule_id', $schedule_id, PDO::PARAM_INT);

    if ($query->execute()) {
        echo "<script>alert('Schedule updated successfully'); window.location.href='manage-schedule.php';</script>";
    } else {
        echo "<script>alert('Error occurred while updating');</script>";
    }
}

$sql = "SELECT * FROM schedule WHERE schedule_id = :schedule_id";
$query = $dbh->prepare($sql);
$query->bindParam(':schedule_id', $schedule_id, PDO::PARAM_INT);
$query->execute();
$result = $query->fetch(PDO::FETCH_OBJ);

if (!$result) {
    echo "<script>alert('Schedule not found'); window.location.href='manage-schedule.php';</script>";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Schedule</title>
    <link rel="stylesheet" href="vendors/simple-line-icons/css/simple-line-icons.css">
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
        <h3 class="page-title">Edit Schedule</h3>
    </div>
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <form class="forms-sample" method="post">
                        <div class="form-group">
                            <label>Subject</label>
                            <select name="Subject_Code" class="form-control" required>
                                <?php
                                $sql = "SELECT * FROM subject";
                                $query = $dbh->prepare($sql);
                                $query->execute();
                                $subjects = $query->fetchAll(PDO::FETCH_OBJ);
                                foreach ($subjects as $s) {
                                    $selected = ($result->Subject_Code == $s->Subject_Code) ? 'selected' : '';
                                    echo "<option value='{$s->Subject_Code}' $selected>{$s->Subject_Name}</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Lecturer</label>
                            <select name="lecturer_id" class="form-control" required>
                                <?php
                                $sql = "SELECT * FROM lecturer";
                                $query = $dbh->prepare($sql);
                                $query->execute();
                                $lecturers = $query->fetchAll(PDO::FETCH_OBJ);
                                foreach ($lecturers as $l) {
                                    $selected = ($result->lecturer_id == $l->lecturer_id) ? 'selected' : '';
                                    echo "<option value='{$l->lecturer_id}' $selected>{$l->first_name}</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Day of Week</label>
                            <select name="day_of_week" class="form-control" required>
                                <?php
                                $days = ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday"];
                                foreach ($days as $day) {
                                    $selected = ($result->day_of_week == $day) ? 'selected' : '';
                                    echo "<option value='$day' $selected>$day</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Start Time</label>
                            <input type="time" name="start_time" class="form-control" value="<?php echo $result->start_time; ?>" required>
                        </div>
                        <div class="form-group">
                            <label>End Time</label>
                            <input type="time" name="end_time" class="form-control" value="<?php echo $result->end_time; ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Location</label>
                            <input type="text" name="location" class="form-control" value="<?php echo htmlentities($result->location); ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Semester</label>
                            <select name="semester_id" class="form-control" required>
                                <?php
                                $sql = "SELECT * FROM semester";
                                $query = $dbh->prepare($sql);
                                $query->execute();
                                $semesters = $query->fetchAll(PDO::FETCH_OBJ);
                                foreach ($semesters as $sem) {
                                    $selected = ($result->semester_id == $sem->semester_id) ? 'selected' : '';
                                    echo "<option value='{$sem->semester_id}' $selected>{$sem->semester_name}</option>";
                                }
                                ?>
                            </select>
                        </div>
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
<script src="js/off-canvas.js"></script>
<script src="js/misc.js"></script>
</body>
</html>
