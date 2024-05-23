<div class="horizontal-menu">
      <nav class="bottom-navbar">
        <div class="container">
          <ul class="nav page-navigation">
            <li class="nav-item <?= ($page == "" || $page == "dashboard"? "active":"") ?>">
              <a class="nav-link" href="./">
                <i class="mdi mdi-file-document-box menu-icon"></i>
                <span class="menu-title">Dashboard</span>
              </a>
            </li>
            <?php
            if($_SESSION['user_category'] != "F" AND $_SESSION['user_category'] != "S"){
            ?>
            <li class="nav-item <?= ($page == "programs"? "active":"") ?>">
              <a href="index.php?page=programs" class="nav-link">
                <i class="mdi mdi-cube-outline menu-icon"></i>
                <span class="menu-title">Programs</span>
              </a>
            </li>
            <?php } ?>
            <?php
            if($_SESSION['user_category'] == "F" || $_SESSION['user_category'] == "S"){
            ?>
            <li class="nav-item <?= ($page == "list-tasks"? "active":"") ?>">
              <a href="index.php?page=list-tasks" class="nav-link">
                <i class="mdi mdi-chart-gantt menu-icon"></i>
                <span class="menu-title">Task</span>
              </a>
            </li>
            <?php }else{ ?>
            <li class="nav-item <?= ($page == "tasks"? "active":"") ?>">
              <a href="index.php?page=tasks" class="nav-link">
                <i class="mdi mdi-chart-gantt menu-icon"></i>
                <span class="menu-title">Task</span>
              </a>
            </li>
            <?php } ?>
            <li class="nav-item <?= ($page == "users"? "active":"") ?>">
              <a href="index.php?page=users" class="nav-link">
                <i class="mdi mdi-account-multiple-outline menu-icon"></i>
                <span class="menu-title">Users</span>
              </a>
            </li>
            <?php
            if($_SESSION['user_category'] != "F" AND $_SESSION['user_category'] != "S"){
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
            <li class="nav-item <?= ($page == "profile"? "active":"") ?>">
              <a href="index.php?page=profile" class="nav-link">
                <i class="mdi mdi-account-circle menu-icon"></i>
                <span class="menu-title">Profile </span>
              </a>
            </li>
          </ul>
        </div>
      </nav>
    </div>
    