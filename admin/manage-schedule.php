<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if (strlen($_SESSION['sturecmsaid'] == 0)) {
    header('location:logout.php');
    exit();
}

// Delete schedule if needed
if (isset($_GET['delid'])) {
    $rid = $_GET['delid'];
    $sql = "DELETE FROM schedule WHERE schedule_id = :rid";
    $query = $dbh->prepare($sql);
    $query->bindParam(':rid', $rid, PDO::PARAM_STR);
    $query->execute();
    echo "<script>alert('Schedule deleted');</script>";
    echo "<script>window.location.href = 'manage-schedule.php'</script>";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Student Enrollment System || Manage Schedule</title>
  <link rel="stylesheet" href="vendors/simple-line-icons/css/simple-line-icons.css">
  <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
  <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="./vendors/daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="./vendors/chartist/chartist.min.css">
  <link rel="stylesheet" href="./css/style.css">
</head>
<body>
<div class="container-scroller">
<?php include_once('includes/header.php'); ?>
<div class="container-fluid page-body-wrapper">
<?php include_once('includes/sidebar.php'); ?>
<div class="main-panel">
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title"> Manage Schedule </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page"> Manage Schedule</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-sm-flex align-items-center mb-4">
                        <h4 class="card-title mb-sm-0">Manage Schedule</h4>
                        <a href="add-schedule.php" class="btn btn-sm btn-primary ml-auto">+ Add Schedule</a>
                    </div>
                    <div class="table-responsive border rounded p-1">
                        <table class="table">
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
$page_no = isset($_GET['page_no']) ? $_GET['page_no'] : 1;
$total_records_per_page = 10;
$offset = ($page_no - 1) * $total_records_per_page;

$sql = "SELECT COUNT(*) as total FROM schedule";
$query1 = $dbh->prepare($sql);
$query1->execute();
$total_records = $query1->fetch(PDO::FETCH_OBJ)->total;
$total_no_of_pages = ceil($total_records / $total_records_per_page);
$previous_page = $page_no - 1;
$next_page = $page_no + 1;

$sql = "SELECT s.schedule_id, sub.Subject_Name, l.first_name, s.day_of_week, s.start_time, s.end_time, s.location, sem.semester_name
        FROM schedule s
        JOIN subject sub ON s.Subject_Code = sub.Subject_Code
        JOIN lecturer l ON s.lecturer_id = l.lecturer_id
        JOIN semester sem ON s.semester_id = sem.semester_id
        ORDER BY s.day_of_week, s.start_time ASC
        LIMIT $offset, $total_records_per_page";

$query = $dbh->prepare($sql);
$query->execute();
$results = $query->fetchAll(PDO::FETCH_OBJ);
$cnt = $offset + 1;

if ($query->rowCount() > 0) {
    foreach ($results as $row) {
?>
<tr>
    <td><?php echo $cnt++; ?></td>
    <td><?php echo htmlentities($row->Subject_Name); ?></td>
    <td><?php echo htmlentities($row->first_name); ?></td>
    <td><?php echo htmlentities($row->day_of_week); ?></td>
    <td><?php echo htmlentities($row->start_time . ' - ' . $row->end_time); ?></td>
    <td><?php echo htmlentities($row->location); ?></td>
    <td><?php echo htmlentities($row->semester_name); ?></td>
    <td>
        <a href="edit-schedule.php?editid=<?php echo htmlentities($row->schedule_id); ?>" class="btn btn-info btn-xs">Edit</a>
        <a href="manage-schedule.php?delid=<?php echo htmlentities($row->schedule_id); ?>" onclick="return confirm('Do you really want to delete?');" class="btn btn-danger btn-xs">Delete</a>
    </td>
</tr>
<?php } } else { ?>
<tr><td colspan="8" class="text-center">No records found.</td></tr>
<?php } ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="mt-4">
                        <ul class="pagination">
                            <li class="page-item <?php if ($page_no <= 1) echo 'disabled'; ?>">
                                <a class="page-link" <?php if ($page_no > 1) echo "href='?page_no=$previous_page'"; ?>>Previous</a>
                            </li>
                            <?php for ($counter = 1; $counter <= $total_no_of_pages; $counter++) {
                                if ($counter == $page_no) {
                                    echo "<li class='page-item active'><a class='page-link'>$counter</a></li>";
                                } else {
                                    echo "<li class='page-item'><a class='page-link' href='?page_no=$counter'>$counter</a></li>";
                                }
                            } ?>
                            <li class="page-item <?php if ($page_no >= $total_no_of_pages) echo 'disabled'; ?>">
                                <a class="page-link" <?php if ($page_no < $total_no_of_pages) echo "href='?page_no=$next_page'"; ?>>Next</a>
                            </li>
                        </ul>
                    </div>

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

