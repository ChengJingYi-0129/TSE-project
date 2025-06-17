<?php
session_start();
include('includes/dbconnection.php');

if (!isset($_SESSION['sturecmsaid']) || empty($_SESSION['sturecmsaid'])) {
    header("Location: logout.php");
    exit();
}

// 表单处理逻辑
if (isset($_POST['submit'])) {
    $id = $_POST['Student_ID'];
    $name = $_POST['Student_Name'];
    $password = $_POST['password'];
    $contact = $_POST['Student_Contact_Number'];
    $regdate = $_POST['Date_Registered'];
    $gradate = $_POST['Date_Graduated'];
    $faculty_id = $_POST['faculty_id'];

    // 检查是否重复
    $check = $dbh->prepare("SELECT Student_ID FROM student_info WHERE Student_ID = :id");
    $check->bindParam(':id', $id);
    $check->execute();

    if ($check->rowCount() > 0) {
        echo "<script>alert('Student ID already exists');</script>";
    } else {
        $sql = "INSERT INTO student_info (Student_ID, Student_Name, Student_Password, Student_Contact_Number, Date_Registered, Date_Graduated, faculty_id)
                VALUES (:id, :name, :password, :contact, :regdate, :gradate , :faculty_id)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':id', $id);
        $query->bindParam(':name', $name);
        $query->bindParam(':password', $password);
        $query->bindParam(':contact', $contact);
        $query->bindParam(':regdate', $regdate);
        $query->bindParam(':gradate', $gradate);
        $query->bindParam(':faculty_id', $faculty_id);
        

        if ($query->execute()) {
            echo "<script>alert('Student added successfully');</script>";
            echo "<script>window.location.href='add-students.php';</script>";
        } else {
            echo "<script>alert('Error occurred');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Student Enrollment Management || Add Students</title>
  <link rel="stylesheet" href="vendors/simple-line-icons/css/simple-line-icons.css">
  <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
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
          <h3 class="page-title"> Add Students </h3>
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
              <li class="breadcrumb-item active" aria-current="page"> Add Students</li>
            </ol>
          </nav>
        </div>
        <div class="row">
          <div class="col-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h3 class="card-title" style="text-align: center;">Add Student Info</h3>
                <hr />
                <form class="forms-sample" method="post">
                  <div class="form-group">
                    <label>Student ID</label>
                    <input type="text" name="Student_ID" class="form-control" required>
                  </div>
                  <div class="form-group">
                    <label>Student Name</label>
                    <input type="text" name="Student_Name" class="form-control" required>
                  </div>
                  <div class="form-group">
                    <label>Faculty</label>
                    <select name="faculty_id" class="form-control" required>
                      <?php
                      $sql = "SELECT * FROM faculty";
                      $query = $dbh->prepare($sql);
                      $query->execute();
                      $results = $query->fetchAll(PDO::FETCH_OBJ);
                      foreach ($results as $result) {
                          echo "<option value='" . htmlentities($result->faculty_id) . "'>" . htmlentities($result->faculty_name) . "</option>";
                      }
                      ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" required>
                  </div>
                  <div class="form-group">
                    <label>Contact Number</label>
                    <input type="text" name="Student_Contact_Number" class="form-control" required pattern="[0-9]+">
                  </div>
                  <div class="form-group">
                    <label>Date Registered</label>
                    <input type="date" name="Date_Registered" class="form-control" required>
                  </div>
                  <div class="form-group">
                    <label>Date Graduated</label>
                    <input type="date" name="Date_Graduated" class="form-control" required>
                  </div>
                  <button type="submit" class="btn btn-primary mr-2" name="submit">Add Student</button>
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
