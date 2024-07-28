<div class="content-wrapper">
  <div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-10 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <!-- <h4 class="card-title">Default form</h4> -->
          <h4 class="card-title" style="color:#0ddbb9;">Report</h4>
          <p class="card-description" style="color: #464dee;">
            Tast Report
          </p>
          <div class="col-lg-12">
            <div class="form-group col-lg-4">
              <label><strong>Type:</strong></label>
              <div>
                <select class="select2 form-control form-control-lg" id="task_status" onchange="getEntry()">
                  <option value="-1">All</option>
                  <option value="P">Pending</option>
                  <option value="O">Ongoing</option>
                  <option value="F">Finished</option>
                </select>
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
                      <th style="font-size: 18px;color: #0ddbb9;">Task</th>
                      <th style="font-size: 18px;color: #0ddbb9;"># of Assignee</th>
                      <th style="font-size: 18px;color: #0ddbb9;">Assignee Submitted</th>
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
    getTaskList();
  });

  function updateNavTaskID(nav_task_id) {
    $("#nav_task_id").val("");
    $("#nav_task_id").val(nav_task_id);
    getTaskList();
    getEntry();
  }

  function getTaskList() {
    var nav_task_id = $("#nav_task_id").val();
    $.ajax({
      type: "POST",
      url: "ajax/getTaskList.php",
      data: {
        nav_task_id: nav_task_id
      },
      success: function(data) {
        $("#nav_task_list").html(data);
      }
    });
  }

  function getEntry() {
    var task_status = $("#task_status").val();
    // var nav_task_id = $("#nav_task_id").val();
    $.ajax({
      type: "POST",
      url: "ajax/taskReport.php",
      data: {
        task_status: task_status
      },
      success: function(data) {
        $("#tb_report").html(data);
      }
    });

  }
</script>