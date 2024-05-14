<?php

include 'core/config.php';

$page = (isset($_GET['page']) && $_GET['page'] != '') ? $_GET['page'] : '';
checkLoginStatus();

$user_id = $_SESSION['rm_user_id'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <title>Record Management System</title>
  <!-- base:css -->
  <link rel="stylesheet" href="vendors/mdi/css/materialdesignicons.min.css" />
  <link rel="stylesheet" href="vendors/base/vendor.bundle.base.css" />
  <link rel="stylesheet" href="vendors/select2/select2.min.css">
  <link rel="stylesheet" href="vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
  <link rel="stylesheet" href="css/style.css" />
  <link href="vendors/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  <link rel="stylesheet" href="vendors/sweetalert/sweetalert.css">


  <!-- endinject -->
  <!-- Plugin js for this page-->
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="js/template.js"></script>
  <!-- endinject -->
  <!-- plugin js for this page -->
  <!-- End plugin js for this page -->

  <script src="vendors/base/vendor.bundle.base.js"></script>
  <script src="vendors/sweetalert/sweetalert2.js"></script>
  <script src="vendors/sweetalert/sweetalert.js"></script>
  <script src="vendors/chart.js/Chart.min.js"></script>
  <script src="vendors/progressbar.js/progressbar.min.js"></script>
  <script src="vendors/chartjs-plugin-datalabels/chartjs-plugin-datalabels.js"></script>
  <script src="vendors/justgage/raphael-2.1.4.min.js"></script>
  <script src="vendors/justgage/justgage.js"></script>
  <script src="js/jquery.cookie.js" type="text/javascript"></script>
  <script src="vendors/datatables/jquery.dataTables.min.js"></script>
  <script src="vendors/datatables/dataTables.bootstrap4.min.js"></script>
  <script src="vendors/select2/select2.min.js"></script>

  <!-- endinject -->
  <link rel="shortcut icon" href="images/chmsu.png" />

</head>
<body>
  <div class="container-scroller">
    <!-- partial:partials/_horizontal-navbar.html -->
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
            <li class="nav-item <?= ($page == "programs"? "active":"") ?>">
              <a href="index.php?page=programs" class="nav-link">
                <i class="mdi mdi-cube-outline menu-icon"></i>
                <span class="menu-title">Programs</span>
              </a>
            </li>
            <li class="nav-item <?= ($page == "tasks"? "active":"") ?>">
              <a href="index.php?page=tasks" class="nav-link">
                <i class="mdi mdi-chart-gantt menu-icon"></i>
                <span class="menu-title">Task</span>
              </a>
            </li>
            <li class="nav-item <?= ($page == "users"? "active":"") ?>">
              <a href="index.php?page=users" class="nav-link">
                <i class="mdi mdi-account-multiple-outline menu-icon"></i>
                <span class="menu-title">Users</span>
              </a>
            </li>
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
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">

      <div class="main-panel">

        <?php require_once 'routes/routes.php'; ?>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <footer class="footer">
          <div class="footer-wrap">
            <div class="d-sm-flex justify-content-center justify-content-sm-between">
              <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright ©
                Carlos Hilado Memorial State University 2024</span>
            </div>
          </div>
        </footer>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- base:js -->
  <!-- Custom js for this page-->
  <!-- End custom js for this page-->
  <script>
    $(document).ready(function() {
      // alert(1);
    });


    function alertNotify(title, message, type) {
      swal("" + title + "", "" + message + "", "" + type + "");
    }

    function success_add() {
      swal("Success!", "Successfully added entry!", "success");
    }

    function success_update() {
      swal("Success!", "Successfully updated entry!", "success");
    }

    function success_finish() {
      swal("Success!", "Successfully finished entry!", "info");
    }

    function success_approved() {
      swal("Success!", "Successfully Approved entry!", "info");
    }

    function success_delete() {
      swal("Success!", "Successfully deleted entry!", "success");
    }

    function failed_query(data) {
      swal("Failed to execute query!", data, "warning");
      //alert('Something is wrong. Failed to execute query. Please try again.');
    }

    function entry_already_exists() {
      swal("Cannot proceed!", "Entry already exists!", "warning");
    }

    function addEntry() {
      $(".modal_type").val("add");
      $('.select2').select2({
        dropdownParent: $('#modal_entry')
      });

      $("#div_password").show();
      $("#modal_entry").modal("show");
    }

    function checkAll(ele, ref) {
      var checkboxes = document.getElementsByClassName(ref);
      if (ele.checked) {
        for (var i = 0; i < checkboxes.length; i++) {
          if (checkboxes[i].type == 'checkbox') {
            checkboxes[i].checked = true;
          }
        }
      } else {
        for (var i = 0; i < checkboxes.length; i++) {
          //console.log(i)
          if (checkboxes[i].type == 'checkbox') {
            checkboxes[i].checked = false;
          }
        }
      }
    }
  </script>
</body>

</html>