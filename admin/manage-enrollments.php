<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if (strlen($_SESSION['sturecmsaid']) == 0) {
    header('location:logout.php');
} else {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Student Enrollment Management || Manage Schedule</title>
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
        <h3 class="page-title">Manage Schedule</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Manage Schedule</li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Class Schedule List</h4>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Subject</th>
                                    <th>Lecturer</th>
                                    <th>Day</th>
                                    <th>Time</th>
                                    <th>Location</th>
                                    <th>Semester</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
<?php
$sql = "SELECT s.schedule_id, sub.Subject_Name, l.first_name, s.day_of_week, s.start_time, s.end_time, s.location, sem.semester_name
        FROM schedule s
        JOIN subject sub ON s.Subject_Code = sub.Subject_Code
        JOIN lecturer l ON s.lecturer_id = l.lecturer_id
        JOIN semester sem ON s.semester_id = sem.semester_id
        ORDER BY s.day_of_week, s.start_time ASC";
$query = $dbh->prepare($sql);
$query->execute();
$results = $query->fetchAll(PDO::FETCH_OBJ);
$cnt = 1;
foreach ($results as $row) {
?>
<tr>
    <td><?php echo $cnt++; ?></td>
    <td><?php echo htmlentities($row->Subject_Name); ?></td>
    <td><?php echo htmlentities($row->first_name); ?></td>
    <td><?php echo htmlentities($row->day_of_week); ?></td>
    <td><?php echo htmlentities($row->start_time . " - " . $row->end_time); ?></td>
    <td><?php echo htmlentities($row->location); ?></td>
    <td><?php echo htmlentities($row->semester_name); ?></td>
    <td>
        <a href="edit-schedule.php?editid=<?php echo $row->schedule_id; ?>" class="btn btn-sm btn-info">Edit</a>
    </td>
</tr>
<?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <a href="add-schedule.php" class="btn btn-primary mt-3">+ Add New Schedule</a>
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
