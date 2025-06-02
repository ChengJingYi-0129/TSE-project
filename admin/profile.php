<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

// 确保讲师已登录
if (!isset($_SESSION['sturecmsaid']) || empty($_SESSION['sturecmsaid'])) {
    header('Location: logout.php');
    exit();
}

$lecid = $_SESSION['sturecmsaid'];

// 更新资料逻辑
if (isset($_POST['submit'])) {
    $mobilenumber = $_POST['mobilenumber'];
    $email = $_POST['email'];

    $sql = "UPDATE lecturer SET 
                Contact_Num = :mobilenumber, 
                email = :email 
            WHERE lecturer_id = :lecid";
    $query = $dbh->prepare($sql);
    $query->bindParam(':mobilenumber', $mobilenumber, PDO::PARAM_STR);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->bindParam(':lecid', $lecid, PDO::PARAM_STR);
    $query->execute();

    echo '<script>alert("Profile updated successfully")</script>';
    echo "<script>window.location.href ='lecturer_profile.php'</script>";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Lecturer Profile</title>
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
                    <h3 class="page-title">Lecturer Profile</h3>
                </div>
                <div class="row">
                    <div class="col-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title text-center">Your Profile</h4>
                                <form class="forms-sample" method="post">
                                    <?php
                                    $sql = "SELECT * FROM lecturer WHERE lecturer_id = :lecid";
                                    $query = $dbh->prepare($sql);
                                    $query->bindParam(':lecid', $lecid, PDO::PARAM_STR);
                                    $query->execute();
                                    $result = $query->fetch(PDO::FETCH_OBJ);

                                    if ($result) {
                                    ?>
                                    <div class="form-group">
                                        <label>Lecturer ID</label>
                                        <input type="text" class="form-control" value="<?php echo htmlentities($result->lecturer_id); ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label>First Name</label>
                                        <input type="text" class="form-control" value="<?php echo htmlentities($result->first_name); ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label>Last Name</label>
                                        <input type="text" class="form-control" value="<?php echo htmlentities($result->last_name); ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label>Contact Number</label>
                                        <input type="text" name="mobilenumber" value="<?php echo htmlentities($result->Contact_Num); ?>" class="form-control" maxlength="10" pattern="[0-9]+" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" name="email" value="<?php echo htmlentities($result->email); ?>" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Faculty</label>
                                        <select class="form-control" disabled>
                                            <?php
                                            $sqlf = "SELECT * FROM faculty";
                                            $qf = $dbh->prepare($sqlf);
                                            $qf->execute();
                                            $faculties = $qf->fetchAll(PDO::FETCH_OBJ);
                                            foreach ($faculties as $f) {
                                                $selected = ($result->faculty_id == $f->faculty_id) ? 'selected' : '';
                                                echo "<option value='{$f->faculty_id}' $selected>{$f->faculty_name}</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary mr-2" name="submit">Update</button>
                                    <?php } else { ?>
                                        <p class="text-danger">Lecturer profile not found.</p>
                                    <?php } ?>
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
