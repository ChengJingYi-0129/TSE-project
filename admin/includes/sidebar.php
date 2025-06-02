<?php
$role = isset($_SESSION['role']) ? $_SESSION['role'] : 'admin';
?>
<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    <li class="nav-item nav-profile">
      <a href="#" class="nav-link">
        <div class="profile-image">
          <img class="img-xs rounded-circle" src="images/faces/face8.jpg" alt="profile image">
          <div class="dot-indicator bg-success"></div>
        </div>
        <div class="text-wrapper">
  <?php
  $aid = $_SESSION['sturecmsaid'];
  $role = $_SESSION['role'];

  if ($role === 'admin') {
      $sql = "SELECT Admin_name AS display_name FROM admin WHERE Admin_ID = :aid";
  } else {
      $sql = "SELECT CONCAT(first_name, ' ', last_name) AS display_name FROM lecturer WHERE lecturer_id = :aid";
  }

  $query = $dbh->prepare($sql);
  $query->bindParam(':aid', $aid, PDO::PARAM_STR);
  $query->execute();
  $user = $query->fetch(PDO::FETCH_OBJ);
  ?>
  <p class="profile-name"><?= htmlentities($user->display_name); ?></p>
  <p class="designation"><?= ucfirst($role); ?></p>
</div>

      </a>
    </li>

    <li class="nav-item nav-category">
      <span class="nav-link">Dashboard</span>
    </li>

    <li class="nav-item">
      <a class="nav-link" href="dashboard.php">
        <span class="menu-title">Dashboard</span>
        <i class="icon-screen-desktop menu-icon"></i>
      </a>
    </li>

    <?php if ($role === 'admin') { ?>
    <!-- Admin-only menus -->
    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#subjectMenu" aria-expanded="false" aria-controls="subjectMenu">
        <span class="menu-title">Subject</span>
        <i class="icon-layers menu-icon"></i>
      </a>
      <div class="collapse" id="subjectMenu">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"><a class="nav-link" href="add-subject.php">Add Subject</a></li>
          <li class="nav-item"><a class="nav-link" href="manage-subject.php">Manage Subject</a></li>
        </ul>
      </div>
    </li>

    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#scheduleMenu" aria-expanded="false" aria-controls="scheduleMenu">
        <span class="menu-title">Schedule</span>
        <i class="icon-layers menu-icon"></i>
      </a>
      <div class="collapse" id="scheduleMenu">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"><a class="nav-link" href="add-schedule.php">Add Schedule</a></li>
          <li class="nav-item"><a class="nav-link" href="manage-schedule.php">Manage Schedule</a></li>
        </ul>
      </div>
    </li>

    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#LecMenu" aria-expanded="false" aria-controls="LecMenu">
        <span class="menu-title">Lecturers</span>
        <i class="icon-people menu-icon"></i>
      </a>
      <div class="collapse" id="LecMenu">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"><a class="nav-link" href="add-Lec.php">Add Lecturer</a></li>
          <li class="nav-item"><a class="nav-link" href="manage-Lec.php">Manage Lecturer</a></li>
        </ul>
      </div>
    </li>

    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#studentMenu" aria-expanded="false" aria-controls="studentMenu">
        <span class="menu-title">Students</span>
        <i class="icon-people menu-icon"></i>
      </a>
      <div class="collapse" id="studentMenu">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"><a class="nav-link" href="add-students.php">Add Students</a></li>
          <li class="nav-item"><a class="nav-link" href="manage-students.php">Manage Students</a></li>
        </ul>
      </div>
    </li>
    <?php } ?>

    <li class="nav-item">
      <a class="nav-link" href="manage-enrollments.php">
        <span class="menu-title">Enrollments</span>
        <i class="icon-doc menu-icon"></i>
      </a>
    </li>
<?php if ($role === 'lecturer') { ?>
    <li class="nav-item">
      <a class="nav-link" href="manage-timetable.php">
        <span class="menu-title">Timetable</span>
        <i class="icon-calendar menu-icon"></i>
      </a>
    </li>
<?php } ?>
    
  </ul>
</nav>
