<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if (strlen($_SESSION['sturecmsaid'] == 0)) {
    header('location:logout.php');
} else {
    // 删除科目
    if (isset($_GET['delid'])) {
        $rid = $_GET['delid'];
        $sql = "DELETE FROM subject WHERE Subject_Code = :rid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':rid', $rid, PDO::PARAM_STR);
        $query->execute();
        echo "<script>alert('Subject deleted');</script>";
        echo "<script>window.location.href = 'manage-subject.php'</script>";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Student Enrollment Management || Manage Subject</title>
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
                        <h3 class="page-title">Manage Subject</h3>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                                <li class="breadcrumb-item active">Manage Subject</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="row">
                        <div class="col-md-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-sm-flex align-items-center mb-4">
                                        <h4 class="card-title mb-sm-0">Manage Subject</h4>
                                    </div>
                                    <div class="table-responsive border rounded p-1">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>S.No</th>
                                                    <th>Subject Code</th>
                                                    <th>Subject Name</th>
                                                    <th>Credit Hours</th>
                                                    <th>Graded</th>
                                                    <th>Elective</th>
                                                    <th>Prerequisite</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
<?php
$pageno = isset($_GET['pageno']) ? $_GET['pageno'] : 1;
$no_of_records_per_page = 10;
$offset = ($pageno - 1) * $no_of_records_per_page;

$ret = "SELECT Subject_Code FROM subject";
$query1 = $dbh->prepare($ret);
$query1->execute();
$total_rows = $query1->rowCount();
$total_pages = ceil($total_rows / $no_of_records_per_page);

$sql = "SELECT * FROM subject LIMIT $offset, $no_of_records_per_page";
$query = $dbh->prepare($sql);
$query->execute();
$results = $query->fetchAll(PDO::FETCH_OBJ);
$cnt = 1;

if ($query->rowCount() > 0) {
    foreach ($results as $row) {
?>
<tr>
    <td><?php echo htmlentities($cnt); ?></td>
    <td><?php echo htmlentities($row->Subject_Code); ?></td>
    <td><?php echo htmlentities($row->Subject_Name); ?></td>
    <td><?php echo htmlentities($row->Subject_Credit_Hours); ?></td>
    <td><?php echo $row->Graded ? 'Yes' : 'No'; ?></td>
    <td><?php echo $row->elective ? 'Yes' : 'No'; ?></td>
    <td><?php echo $row->Prerequirement_Subject_Code ? htmlentities($row->Prerequirement_Subject_Code) : 'None'; ?></td>

    <td>
        <a href="edit-subject-detail.php?editid=<?php echo htmlentities($row->Subject_Code); ?>" class="btn btn-info btn-xs">Edit</a>
        <a href="manage-subject.php?delid=<?php echo htmlentities($row->Subject_Code); ?>" onclick="return confirm('Are you sure you want to delete this subject?');" class="btn btn-danger btn-xs">Delete</a>
    </td>
</tr>
<?php $cnt++; } } ?>
</tbody>
                                        </table>
                                    </div>
                                    <div class="mt-4">
                                        <ul class="pagination">
                                            <li><a href="?pageno=1"><strong>First</strong></a></li>
                                            <li class="<?php if ($pageno <= 1) echo 'disabled'; ?>">
                                                <a href="<?php if ($pageno > 1) echo '?pageno=' . ($pageno - 1); ?>"><strong style="padding-left: 10px">Prev</strong></a>
                                            </li>
                                            <li class="<?php if ($pageno >= $total_pages) echo 'disabled'; ?>">
                                                <a href="<?php if ($pageno < $total_pages) echo '?pageno=' . ($pageno + 1); ?>"><strong style="padding-left: 10px">Next</strong></a>
                                            </li>
                                            <li><a href="?pageno=<?php echo $total_pages; ?>"><strong style="padding-left: 10px">Last</strong></a></li>
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
<?php } ?>
