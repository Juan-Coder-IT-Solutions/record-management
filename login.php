<?php
require_once 'core/config.php';

if (isset($_SESSION['rm_user_id'])) {
  header("Location: index.php");
  exit;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>CHMSU - Record Management System</title>
  <!-- base:css -->
  <link rel="stylesheet" href="vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="vendors/base/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="css/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="images/chmsu.png" />
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-stretch auth auth-img-bg">
        <div class="row flex-grow">
          <div class="col-lg-6 d-flex align-items-center justify-content-center">
            <div class="auth-form-transparent text-left p-3">
              <div class="brand-logo">
                <!-- <img src="images/logo.png" alt="logo"> -->
              </div>
              <h4>Welcome back!</h4>
              <form class="pt-3" action="" method="POST" id='frm_login'>
                <div class="form-group">
                  <label for="exampleInputEmail">Username</label>
                  <div class="input-group">
                    <div class="input-group-prepend bg-transparent">
                      <span class="input-group-text bg-transparent border-right-0">
                        <i class="mdi mdi-account-outline text-primary"></i>
                      </span>
                    </div>
                    <input type="text" id="userlogin" class="form-control border-left-0" placeholder="Username">
                  </div>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword">Password</label>
                  <div class="input-group">
                    <div class="input-group-prepend bg-transparent">
                      <span class="input-group-text bg-transparent border-right-0">
                        <i class="mdi mdi-lock-outline text-primary"></i>
                      </span>
                    </div>
                    <input type="password" id="userpassword" class="form-control border-left-0" placeholder="Password">
                  </div>
                </div>
                <div class="my-3">
                  <button id="btn_submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">LOGIN</button>
                </div>
              </form>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="row">
              <img style="width: 100%;padding:80px;" src="images/chmsu.png">
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- base:js -->
  <script src="vendors/base/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="js/template.js"></script>

  <script type="text/javascript">
    $("#frm_login").submit(function(e) {
      e.preventDefault();

      var userlogin = $("#userlogin").val();
      var userpassword = $("#userpassword").val();

      $("#btn_submit").prop("disabled", true);
      $("#btn_submit").html("<span class='fa fa-spin fa-spinner'></span> Logging in ...");
      $.ajax({
        type: "POST",
        url: "core/login.php",
        data: {
          userlogin: userlogin,
          userpassword: userpassword
        },
        success: function(data) {
          if (data == 1) {
            window.location = 'index.php';
          } else {
            alert(data);
          }

          $("#btn_submit").prop("disabled", false);
          $("#btn_submit").html("LOGIN");
        }
      });
    });
  </script>

  <!-- endinject -->
  <!-- plugin js for this page -->
  <!-- End plugin js for this page -->
  <!-- Custom js for this page-->
  <!-- End custom js for this page-->
</body>

</html>