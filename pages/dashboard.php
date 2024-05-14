<?php
$row = user_row($_SESSION['rm_user_id']);
?>
<div class="content-wrapper">
  <div class="row mt-4">
    <div class="col-sm-8 flex-column d-flex stretch-card">
      <div class="row">
        <div class="col-lg-4 d-flex grid-margin stretch-card">
          <div class="card sale-diffrence-border">
            <div class="card-body">
              <h2 class="text-dark mb-2 font-weight-bold"><?= total_user(); ?></h2>
              <h4 class="card-title mb-2">Users</h4>
              <small class="text-muted">total number of user</small>
            </div>
          </div>
        </div>
        <div class="col-lg-4 d-flex grid-margin stretch-card">
          <div class="card sale-visit-statistics-border">
            <div class="card-body">
              <h2 class="text-dark mb-2 font-weight-bold"><?= total_program(); ?></h2>
              <h4 class="card-title mb-2">Programs</h4>
              <small class="text-muted">total number of programs</small>
            </div>
          </div>
        </div>
        <div class="col-lg-4 d-flex grid-margin stretch-card">
          <div class="card sale-diffrence-border">
            <div class="card-body">
              <h2 class="text-dark mb-2 font-weight-bold"><?= total_task(); ?></h2>
              <h4 class="card-title mb-2">Task</h4>
              <small class="text-muted">total number of task</small>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-4 mb-3 mb-lg-0">
      <div class="card congratulation-bg text-center">
        <div class="card-body pb-0">
          <!-- <img src="images/dashboard/face29.png" alt="" /> -->
          <h2 class="mt-3 text-white mb-3 font-weight-bold">
            Hi, <?= getUser($_SESSION['rm_user_id']) ?>!
          </h2>
          <strong><?= program_name($row['program_id']) ?></strong>
          <p>
            Welcome back!
          </p>
          <a class="btn btn-warning" onclick="logout()">
            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
            Logout
          </a>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  function logout() {
    swal({
        title: "Are you sure?",
        text: "You will not be log-out!",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes, log-out it!",
        cancelButtonText: "No, cancel!",
        closeOnConfirm: false,
        closeOnCancel: false
      },
      function(isConfirm) {
        if (isConfirm) {

          window.location = "core/logout.php";

        } else {
          swal("Cancelled", "Entries are safe :)", "error");
        }
      });
  }
</script>