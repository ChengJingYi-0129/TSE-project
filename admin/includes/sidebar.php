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
          $sql = "SELECT * FROM admin WHERE Admin_ID = :aid";
          $query = $dbh->prepare($sql);
          $query->bindParam(':aid', $aid, PDO::PARAM_INT);
          $query->execute();
          $admin = $query->fetch(PDO::FETCH_OBJ);
          ?>
          <p class="profile-name"><?= htmlentities($admin->Admin_name); ?></p>
          <p class="designation">Administrator</p>
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

    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#classMenu" aria-expanded="false" aria-controls="classMenu">
        <span class="menu-title">Class</span>
        <i class="icon-layers menu-icon"></i>
      </a>
      <div class="collapse" id="classMenu">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"><a class="nav-link" href="add-class.php">Add Class</a></li>
          <li class="nav-item"><a class="nav-link" href="manage-class.php">Manage Class</a></li>
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
          <li class="nav-item"><a class="nav-link" href="add-Lec.php">Add lecturer</a></li>
          <li class="nav-item"><a class="nav-link" href="manage-Lec.php">Manage lecturer</a></li>
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

    <li class="nav-item">
      <a class="nav-link" href="search.php">
        <span class="menu-title">Search</span>
        <i class="icon-magnifier menu-icon"></i>
      </a>
    </li>
  </ul>
</nav>
