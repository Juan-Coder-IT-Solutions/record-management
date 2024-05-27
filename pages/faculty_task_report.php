<div class="content-wrapper">
  <div class="row">
    <div class="col-md-2 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <form class="forms-sample">
            <div class="col-md-12">
              <ul class="nav nav-pills nav-justified" id="nav_task_list"></ul>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="col-md-10 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <!-- <h4 class="card-title">Default form</h4> -->
          <h4 class="card-title" style="color:#0ddbb9;">Report</h4>
          <p class="card-description" style="color: #464dee;">
            Faculty Task Submission
          </p>
          <div class="col-lg-12">
              <div class="form-group col-lg-4">
                <!-- <label><strong>Type:</strong></label> -->
                <div>
                  <select class="select2 form-control form-control-lg" id="task_status" onchange="getEntry()">
                    <option value="A">All</option>
                    <option value="OT">On-time</option>
                    <option value="LS">Late submit</option>
                    <option value="NS">No submission</option>
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
                      <th>#</th>
                      <th>Task Title</th>
                      <th>Faculty</th>
                      <th>Description</th>
                      <th>File Name</th>
                      <th>Submission Date</th>
                      <th>Posted Date</th>
                      <th>Deadline Date</th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<input type="hidden" id="nav_task_id">
<script>
  $(document).ready(function() {
    getEntry();
    getTaskList();
  });

  function updateNavTaskID(nav_task_id){
    $("#nav_task_id").val("");
    $("#nav_task_id").val(nav_task_id);
    getTaskList();
    getEntry();
  }

  function getTaskList(){
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
    var nav_task_id = $("#nav_task_id").val();
    $("#dt_details").DataTable().destroy();
    $("#dt_details").DataTable({
      "processing": true,
      "responsive": true,
      "ajax": {
        "type": "POST",
        "url": "ajax/datatables/faculty_task_report.php",
        "dataSrc": "data",
        "data": {
          task_status:task_status,
          task_id:nav_task_id
        }
      },
      "columns": [
        {
          "data": "count"
        },
        {
          "data": "task_title"
        },
        {
          "data": "faculty_name"
        },
        {
          "data": "task_desc"
        },
        {
          "data": "file_name"
        },
        {
          "data": "submission_date"
        },
        {
          "data": "posted_date"
        },
        {
          "data": "deadline_date"
        }
      ]
    });


  }
</script>