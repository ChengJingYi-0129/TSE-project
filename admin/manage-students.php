<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['sturecmsaid'] == 0)) {
  header('location:logout.php');
} else {
  // Delete student
  if (isset($_GET['delid'])) {
    $rid = $_GET['delid'];
    $sql = "DELETE FROM student_info WHERE Student_ID = :rid";
    $query = $dbh->prepare($sql);
    $query->bindParam(':rid', $rid, PDO::PARAM_STR);
    $query->execute();
    echo "<script>alert('Data deleted');</script>";
    echo "<script>window.location.href = 'manage-students.php'</script>";
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Student Enrollment Management || Manage Students</title>
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
          <h3 class="page-title"> Manage Students </h3>
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
              <li class="breadcrumb-item active" aria-current="page"> Manage Students</li>
            </ol>
          </nav>
        </div>
        <div class="row">
          <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <div class="d-sm-flex align-items-center mb-4">
                  <h4 class="card-title mb-sm-0">Manage Students</h4>
                  <a href="#" class="text-dark ml-auto mb-3 mb-sm-0"> View all Students</a>
                </div>
                <div class="table-responsive border rounded p-1">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>S.No</th>
                        <th>Student ID</th>
                        <th>Student Name</th>
                        <th>Contact Number</th>
                        <th>Date Registered</th>
                        <th>Date Graduated</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $page_no = isset($_GET['page_no']) ? $_GET['page_no'] : 1;
                      $total_records_per_page = 10;
                      $offset = ($page_no - 1) * $total_records_per_page;
                      $previous_page = $page_no - 1;
                      $next_page = $page_no + 1;
                      $adjacents = "2";

                      $query1 = $dbh->prepare("SELECT COUNT(*) as total FROM student_info");
                      $query1->execute();
                      $total_records = $query1->fetch(PDO::FETCH_OBJ)->total;
                      $total_no_of_pages = ceil($total_records / $total_records_per_page);
                      $second_last = $total_no_of_pages - 1;

                      $sql = "SELECT * FROM student_info LIMIT $offset, $total_records_per_page";
                      $query = $dbh->prepare($sql);
                      $query->execute();
                      $results = $query->fetchAll(PDO::FETCH_OBJ);
                      $cnt = 1;
                      if ($query->rowCount() > 0) {
                        foreach ($results as $row) {
                      ?>
                      <tr>
                        <td><?php echo htmlentities($cnt); ?></td>
                        <td><?php echo htmlentities($row->Student_ID); ?></td>
                        <td><?php echo htmlentities($row->Student_Name); ?></td>
                        <td><?php echo htmlentities($row->Student_Contact_Number); ?></td>
                        <td><?php echo htmlentities($row->Date_Registered); ?></td>
                        <td><?php echo htmlentities($row->Date_Graduated); ?></td>
                        <td>
                          <a href="edit-student-detail.php?editid=<?php echo htmlentities($row->Student_ID); ?>" class="btn btn-info btn-xs" target="_blank">Edit</a>
                          <a href="manage-students.php?delid=<?php echo htmlentities($row->Student_ID); ?>" onclick="return confirm('Do you really want to Delete ?');" class="btn btn-danger btn-xs">Delete</a>
                        </td>
                      </tr>
                      <?php $cnt++; }} ?>
                    </tbody>
                  </table>
                </div>
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
<?php } ?>
