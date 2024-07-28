<div class="content-wrapper">
  <div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-10 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <!-- <h4 class="card-title">Default form</h4> -->
          <h4 class="card-title" style="color:#0ddbb9;">Report</h4>
          <p class="card-description" style="color: #464dee;">
            Task Report
          </p>
          <div class="row">
            <div class="col-lg-12">
              <div class="form-group col-lg-4 d-flex align-items-center">
                <label class="mr-2"><strong>Program:</strong></label>
                <div class="flex-grow-1">
                  <select class="form-control form-control-lg" id="program_id">
                    <option value="-1">&mdash;ALL&mdash;</option>
                    <?php
                    $fetch = $mysqli_connect->query("SELECT * FROM tbl_programs") or die(mysqli_error());
                    while ($row = $fetch->fetch_array()) { ?>
                      <option value="<?= $row['program_id'] ?>"><?= $row['program_name'] ?></option>
                    <?php } ?>
                  </select>
                </div>
                <button type="button" onclick="getEntry()" class="btn btn-outline-warning btn-icon-text">
                  <i class="mdi mdi-reload btn-icon-prepend"></i>
                  Generate
                </button>
              </div>
            </div>
          </div>
          <div class="col-lg-12">
            <div class="card mb-4">
              <div class="table-responsive p-3">
                <table class="table align-items-center table-flush table-hover" id="dt_details">
                  <thead class="thead-light">
                    <tr>
                      <th style="font-size: 18px;color: #0ddbb9;">#</th>
                      <th style="font-size: 18px;color: #0ddbb9;">Name</th>
                      <th style="font-size: 18px;color: #0ddbb9;">Status</th>
                    </tr>
                  </thead>
                  <tbody id="tb_report">
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-1"></div>
  </div>
</div>

<input type="hidden" id="nav_task_id">
<script>
  $(document).ready(function() {
    getEntry();
  });

  function getEntry() {
    var program_id = $("#program_id").val();
    // var nav_task_id = $("#nav_task_id").val();
    $.ajax({
      type: "POST",
      url: "ajax/usersReport.php",
      data: {
        program_id: program_id
      },
      success: function(data) {
        $("#tb_report").html(data);
      }
    });

  }
</script>