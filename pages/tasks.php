<div class="content-wrapper">
  <div class="row">
    <div class="col-md-2 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <!-- <h4 class="card-title">Default form</h4> -->
          <!-- <p class="card-description">
            Manage
          </p> -->
          <form class="forms-sample">
            <div class="col-md-12">
              <button style="width: 100%;" type="button" onclick="addEntry()" class="btn btn-primary btn-icon-text">
                <i class="mdi mdi-plus-circle btn-icon-prepend"></i>
                Add Entry
              </button>
            </div>
            <div class="col-md-12">
              <button onclick="deleteEntry()" id="btn_delete" style="width: 100%;" type="button" class="btn btn-danger btn-icon-text">
                <i class="mdi mdi-close-circle btn-icon-prepend"></i>
                Delete Entry
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="col-md-10 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <!-- <h4 class="card-title">Default form</h4> -->
          <h4 class="card-title" style="color:#0ddbb9;">Tasks</h4>
          <p class="card-description" style="color: #464dee;">
            Manage Tasks
          </p>
          <div class="col-lg-12">
            <div class="card mb-4">
              <div class="table-responsive p-3">
              <table class="table align-items-center table-flush table-hover" id="dt_details">
                  <thead class="thead-light">
                    <tr>
                      <th>
                        <div class='form-check form-check-success'><label class='form-check-label'><input type='checkbox' class='dt_id' class='form-check-input' onchange="checkAll(this,'dt_id')"><i class='input-helper'></i></label></div>
                      </th>
                      <th></th>
                      <th>#</th>
                      <th>Task Title</th>
                      <th>Description</th>
                      <th>Encoded By</th>
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

<?php require_once 'modals/modal_tasks.php'; ?>
<?php require_once 'modals/modal_add_task_assigned.php'; ?>
<script>
  $(document).ready(function() {
    getEntry();
  });

  function deleteEntry() {
    var count_checked = $(".dt_id:checked").length;
    var tb = "tbl_tasks";
    var keyword = "task_id";

    if (count_checked > 0) {
      swal({
          title: "Are you sure?",
          text: "You will not be able to recover these entries!",
          type: "warning",
          showCancelButton: true,
          confirmButtonClass: "btn-danger",
          confirmButtonText: "Yes, delete it!",
          cancelButtonText: "No, cancel!",
          closeOnConfirm: false,
          closeOnCancel: false
        },
        function(isConfirm) {
          if (isConfirm) {
            var checkedValues = $(".dt_id:checked").map(function() {
              return $(this).val();
            }).get();

            $("#btn_delete").prop('disabled', true);

            $.ajax({
              type: "POST",
              url: "ajax/deleteBulkEntries.php",
              data: {
                id: checkedValues,
                tb: tb,
                keyword: keyword
              },
              success: function(data) {
                if (data == 1) {
                  success_delete();
                  getEntry();
                } else {
                  failed_query("Programs");
                }

                $("#btn_delete").prop('disabled', false);
              }
            });

          } else {
            swal("Cancelled", "Entries are safe :)", "error");
          }
        });
    } else {
      swal("Cannot proceed!", "Please select entries to delete!", "warning");
    }
  }

  function getEntryDetails(id) {
    $("#modal_entry").modal("show");
    var tb = "tbl_tasks";
    var keyword = "task_id";

    $.ajax({
      type: "POST",
      url: "ajax/getDetails.php",
      data: {
        id: id,
        tb: tb,
        keyword: keyword
      },
      success: function(data) {
        var json = JSON.parse(data);
        console.log(data);
        $("#task_title").val(json.task_title);
        $("#task_desc").val(json.task_desc);
        $("#posted_date").val(json.posted_date);
        $("#deadline_date").val(json.deadline_date);
        $("#task_id").val(json.task_id);
        $(".modal_type").val("update");
      }
    });
  }

  function getAssignedTask(id, task_title) {
    $('.select2').select2({
        dropdownParent: $('#modal_entry_task_assign')
      });
    $("#task_id_assign").val(id);
    $("#modal_entry_task_assign").modal("show");
    $("#assign_title").html(task_title);
    getEntryAssigned();
   
  }

  $("#frm_add").submit(function(e) {
    e.preventDefault();
    $("#btn_submit_entry").prop("disabled", true);
    var type = $(".modal_type").val();
    $.ajax({
      type: "POST",
      url: "ajax/manageTasks.php",
      data: $("#frm_add").serialize(),
      success: function(data) {
        if (data == 1) {
          if (type == "add") {
            success_add();
            $('#frm_add').each(function() {
              this.reset();
            });
          } else {
            success_update();
          }
          getEntry();
          $("#modal_entry").modal("hide");
        } else if (data == 2) {
          entry_already_exists();
        } else {
          failed_query("Programs");
          alert(data);
        }
        $("#btn_submit_entry").prop("disabled", false);
      }

    });

  });

  function getEntry() {
    $("#dt_details").DataTable().destroy();
    $("#dt_details").DataTable({
      "processing": true,
      "responsive": true,
      "ajax": {
        "type": "POST",
        "url": "ajax/datatables/tasks.php",
        "dataSrc": "data",
        "data": {
          //type:type
        }
      },
      "columns": [{
          "mRender": function(data, type, row) {
            return "<div class='form-check form-check-success'><label class='form-check-label'><input type='checkbox' value=" + row.task_id + " class='dt_id form-check-input'><i class='input-helper'></i></label></div>";
          }
        },
        {
          "mRender": function(data, type, row) {
            return "<center><button class='btn btn-primary btn-circle btn-sm' onclick='getEntryDetails(" + row.task_id + ")'><span class='mdi mdi-lead-pencil'></span></button><button class='btn btn-warning btn-circle btn-sm' onclick='getAssignedTask(" + row.task_id + ", \""+row.task_title+"\")'><span class='mdi mdi-account-multiple-plus'></span></button></center>";

          }
        },
        {
          "data": "count"
        },
        {
          "data": "task_title"
        },
        {
          "data": "task_desc"
        },
        {
          "data": "encoded_by"
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

  
  function deleteAssign(id) {
    
    var tb = "tbl_assigned_tasks";
    var keyword = "assigned_task_id";
    swal({
        title: "Are you sure?",
        text: "You will not be able to recover these entries!",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "No, cancel!",
        closeOnConfirm: false,
        closeOnCancel: false
      },
      function(isConfirm) {
        if (isConfirm) {
          
          $.ajax({
            type: "POST",
            url: "ajax/deleteEntries.php",
            data: {
              id: id,
              tb: tb,
              keyword: keyword
            },
            success: function(data) {
              if (data == 1) {
                success_delete();
                getEntryAssigned();
                
              } else {
                failed_query("Assign Task Delete");
              }

              $("#btn_delete").prop('disabled', false);
            }
          });

        } else {
          swal("Cancelled", "Entries are safe :)", "error");
        }
      });
  }

  function getEntryAssigned() {
    var task_id = $("#task_id_assign").val();
    $("#dt_details_2").DataTable().destroy();
    $("#dt_details_2").DataTable({
      "processing": true,
      "responsive": true,
      "ajax": {
        "type": "POST",
        "url": "ajax/datatables/assigned_task.php",
        "dataSrc": "data",
        "data": {
          task_id:task_id
        }
      },
      "columns": [
        {
          "mRender": function(data, type, row) {
            return "<center><button type='button' class='btn btn-info btn-circle btn-sm' onclick='window.location = \"index.php?page=assign-task&id=" + row.assigned_task_id + "\"'><span class='mdi mdi-file-document'></span></button><button type='button' class='btn btn-danger btn-circle btn-sm' onclick='deleteAssign(" + row.assigned_task_id + ")'><span class='mdi mdi-delete'></span></button></center>";

          }
        },
        {
          "data": "count"
        },
        {
          "data": "full_name"
        },
        {
          "data": "comment"
        }
      ]
    });

  }

  $("#frm_add_task_assign").submit(function(e) {
    e.preventDefault();
    $("#btn_assign_entry").prop("disabled", true);
    var type = $(".modal_type").val();
    $.ajax({
      type: "POST",
      url: "ajax/addAssignTask.php",
      data: $("#frm_add_task_assign").serialize(),
      success: function(data) {
        if (data == 1) {
          success_add();
          getEntryAssigned();
        } else if (data == 2) {
          entry_already_exists();
        } else {
          failed_query("Assign Task");
          alert(data);
        }
        $("#btn_assign_entry").prop("disabled", false);
      }

    });

  });

</script>