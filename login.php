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
  <link rel="stylesheet" href="vendors/sweetalert/sweetalert.css">
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
                  <button id="btn_submit" style="width: 100%;" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">LOGIN</button>
                </div>
                <div class="text-center mt-4 font-weight-light">
                  Don't have an account? <a href="#" onclick="register()" class="text-primary">Create</a>
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

    <form action="" method='POST' id='frm_add'>
      <div class="modal fade" id="modal_entry" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="card-title">Register</h4>
            </div>
            <div class="modal-body">
              <div class="row">
                <input type="hidden" class="form-control modal_type" value="add" name="type">
                <input type="hidden" class="form-control" id="user_id" name="user_id">
                <div class="col-sm-4">
                  <div class="form-group">
                    <label for="exampleInputPassword4">First Name <strong style="color:red;">*</strong></label>
                    <input type="text" class="form-control" id="first_name" name="first_name" autocomplete="off" required>
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-group">
                    <label for="exampleInputPassword4">Middle Name</label>
                    <input type="text" class="form-control" id="middle_name" name="middle_name" autocomplete="off">
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-group">
                    <label for="exampleInputPassword4">Last Name <strong style="color:red;">*</strong></label>
                    <input type="text" class="form-control" id="last_name" name="last_name" autocomplete="off" required>
                  </div>
                </div>
                <div class="col-sm-6">

                  <div class="form-group">
                    <label>User Category <strong style="color:red;">*</strong></label>
                    <div>
                      <select class="select2 form-control form-control-lg" id="user_category" name="user_category" required style="width: 100%;">
                        <option value="">Please Select</option>
                        <option value="F">Faculty</option>
                        <option value="S">Staff</option>
                        <!-- <option value="P">Program Chair</option>
                        <option value="R">Registrar</option>
                        <option value="D">Dean</option> -->
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Program <strong style="color:red;">*</strong></label>
                    <div>
                      <select class="select2 form-control form-control-lg" id="program_id" name="program_id" style="width: 100%;">
                        <option value="">Please Select</option>
                        <?php
                        $fetch_program = $mysqli_connect->query("SELECT * FROM tbl_programs") or die(mysqli_error());
                        while ($pRpow = $fetch_program->fetch_array()) { ?>
                          <option value='<?= $pRpow['program_id'] ?>'><?= $pRpow['program_name'] ?></option>";
                        <?php }  ?>
                      </select>
                    </div>

                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-group">
                    <label for="exampleInputPassword4">Designation <strong style="color:red;">*</strong></label>
                    <input type="text" class="form-control" id="designation" name="designation" autocomplete="off" required>
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-group">
                    <label for="exampleInputPassword4">Academic Rank <strong style="color:red;">*</strong></label>
                    <input type="text" class="form-control" id="academic_rank" name="academic_rank" autocomplete="off" required>
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-group">
                    <label for="exampleInputPassword4">Username <strong style="color:red;">*</strong></label>
                    <input type="text" class="form-control" id="username" name="username" autocomplete="off" required>
                  </div>
                </div>

                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="exampleInputPassword4">Password <strong style="color:red;">*</strong></label>
                    <input type="password" class="form-control" id="password" name="password" autocomplete="off" required>
                  </div>
                </div>

                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="exampleInputPassword4">Confirm Password <strong style="color:red;">*</strong></label>
                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" autocomplete="off" required>
                  </div>
                </div>
              </div>

            </div>
            <div class="modal-footer">
              <button type="submit" id="btn_submit_entry" class="btn btn-primary">Save</button>
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
    </form>

    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- base:js -->
  <script src="vendors/base/vendor.bundle.base.js"></script>

  <script src="vendors/sweetalert/sweetalert2.js"></script>
  <script src="vendors/sweetalert/sweetalert.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="js/template.js"></script>

  <script type="text/javascript">
    function register() {
      $("#modal_entry").modal("show");
    }

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

    $("#frm_add").submit(function(e) {
      e.preventDefault();
      $("#btn_submit_entry").prop("disabled", true);
      var password = $("#password").val();
      var confirm_password = $("#confirm_password").val();
      if (confirm_password != password) {
        swal('Cannot Proceed!', "Passwords does not match!", "warning");
            $("#btn_submit_entry").prop("disabled", false);
      } else {
        $.ajax({
          type: "POST",
          url: "ajax/manageUser.php",
          data: $("#frm_add").serialize(),
          success: function(data) {
            if (data == 1) {
              swal("Success!", "Successfully created an account!", "success");
              $('#frm_add').each(function() {
                this.reset();
              });
              $("#modal_entry").modal("hide");
            } else if (data == 2) {
              swal("Cannot proceed!", "Account already exists!", "warning");
            } else {
              failed_query("Register user");
              alert(data);
            }
            $("#btn_submit_entry").prop("disabled", false);
          }
        });
      }
    });
  </script>

  <!-- endinject -->
  <!-- plugin js for this page -->
  <!-- End plugin js for this page -->
  <!-- Custom js for this page-->
  <!-- End custom js for this page-->
</body>

</html>