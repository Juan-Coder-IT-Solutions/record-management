<?php
  $count_notif = total_unread_notification($user_id);
?>
<div class="horizontal-menu">
  <nav class="navbar top-navbar col-lg-12 col-12 p-0">
    <div class="container-fluid">
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-between">

        <ul class="navbar-nav navbar-nav-left">

        </ul>
        <ul class="navbar-nav navbar-nav-rught">
          <li class="nav-item dropdown">

            <a class="nav-link count-indicator dropdown-toggle d-flex align-items-center justify-content-center" id="notificationDropdown" href="#" data-bs-toggle="dropdown">
              <i class="mdi mdi-bell mx-0"></i>
              <?php if ($count_notif > 0) { ?>
                <span class="count bg-warning"><?= $count_notif ?></span>
              <?php } ?>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
              <p class="mb-0 font-weight-normal float-left dropdown-header">Notifications</p>

              <?php
              $fetch_notif = $mysqli_connect->query("SELECT * FROM tbl_notifications WHERE user_id='$user_id' AND status=1") or die(mysqli_error());
              while ($nRow = $fetch_notif->fetch_array()) { ?>
                <a onclick="readNotif(<?= $nRow['notification_id'] ?>, <?= $nRow['assigned_task_id'] ?>)" class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <!-- <div class="preview-icon bg-info">
                      <i class="mdi mdi-information"></i>
                    </div> -->
                    <i style="font-size: 25px;color: #00BCD4;" class="mdi mdi-information"></i>
                  </div>
                  <div class="preview-item-content">
                    <h5 class="preview-tit font-weight-bold"><?= $nRow['title'] ?></h5>
                    <p style="font-size: 15px;">
                      <?= taskNname($nRow['task_id']) ?>
                    </p>
                    <p style="font-size: 12px;" class="font-weight-light small-text mb-0 text-muted"><?= time_ago($nRow['date_added']) ?></p>
                  </div>
                </a>
              <?php } ?>
            </div>
          </li>

          <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" id="profileDropdown">
              <span class="nav-profile-name"><?= getUser($user_id) ?></span>
              <i style="font-size: x-large;" class="mdi mdi-account-circle menu-icon"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
              <a onclick="window.location='index.php?page=profile'" class="dropdown-item">
                <i class="mdi mdi-settings text-primary"></i>
                Profile
              </a>
              <a onclick="logout()" class="dropdown-item">
                <i class="mdi mdi-logout text-primary"></i>
                Logout
              </a>
            </div>
          </li>
        </ul>

        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="horizontal-menu-toggle">
          <span class="mdi mdi-menu"></span>
        </button>
      </div>
    </div>
  </nav>
  <nav class="bottom-navbar">
    <div class="container">
      <ul class="nav page-navigation">
        <li class="nav-item <?= ($page == "" || $page == "dashboard" ? "active" : "") ?>">
          <a class="nav-link" href="./">
            <i class="mdi mdi-file-document-box menu-icon"></i>
            <span class="menu-title">Dashboard</span>
          </a>
        </li>
        <?php
        if ($_SESSION['user_category'] != "F" and $_SESSION['user_category'] != "S") {
        ?>
          <li class="nav-item">
            <a href="index.php?page=programs" class="nav-link">
              <i class="mdi mdi-cube-outline menu-icon"></i>
              <span class="menu-title">Programs</span>
            </a>
          </li>
        <?php } ?>
        <?php
        if ($_SESSION['user_category'] == "F" || $_SESSION['user_category'] == "S") {
        ?>
          <li class="nav-item">
            <a href="index.php?page=list-tasks" class="nav-link">
              <i class="mdi mdi-chart-gantt menu-icon"></i>
              <span class="menu-title">Task</span>
            </a>
          </li>
        <?php } else { ?>
          <li class="nav-item <?= ($page == "tasks" ? "active" : "") ?>">
            <a href="index.php?page=tasks" class="nav-link">
              <i class="mdi mdi-chart-gantt menu-icon"></i>
              <span class="menu-title">Task</span>
            </a>
          </li>
        <?php } ?>
        <li class="nav-item <?= ($page == "users" ? "active" : "") ?>">
          <a href="index.php?page=users" class="nav-link">
            <i class="mdi mdi-account-multiple-outline menu-icon"></i>
            <span class="menu-title">Users</span>
          </a>
        </li>
        <?php
        if ($_SESSION['user_category'] != "F" and $_SESSION['user_category'] != "S") {
        ?>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="mdi mdi-chart-pie menu-icon"></i>
              <span class="menu-title">Report</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="submenu">
              <ul>
                <li class="nav-item"><a class="nav-link" href="index.php?page=faculty-task-report">Faculty Task Submission</a></li>
              </ul>
            </div>
          </li>
        <?php } ?>
      </ul>
    </div>
  </nav>
</div>