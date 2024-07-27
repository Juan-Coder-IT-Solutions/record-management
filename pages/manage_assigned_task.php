<div class="content-wrapper">
  <div class="row">
    <div class="col-md-3 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title"><?= taskNname($_GET['id']) ?></h4>
          <!-- <p class="card-description">
            Manage
          </p> -->
          <form action="" method='POST' id='frm_add_task_assign'>
            <input type="hidden" value="<?= $_GET['id'] ?>" name="task_id" id="task_id_assign">
            <div class="form-group">
              <label>Select Assignee</label>
              <select class="js-example-basic-multiple w-100" style="width:100%" multiple="multiple" id="user_id" name="user_id[]">
                <option value="">Please Select</option>
                <?php
                $fetch_program = $mysqli_connect->query("SELECT * FROM tbl_users") or die(mysqli_error());
                while ($pRpow = $fetch_program->fetch_array()) { ?>
                  <option value='<?= $pRpow['user_id'] ?>'><?= $pRpow['first_name'] . " " . $pRpow['middle_name'] . " " . $pRpow['last_name'] ?></option>";
                <?php }  ?>
              </select>
            </div>
            <button type="submit" id="btn_assign_entry" class="btn btn-primary">Add</button>
          </form>
        </div>
      </div>
    </div>
    <div class="col-md-9 grid-margin stretch-card">
      <div class="card">
        
        <div class="card-body">
          <p class="card-description">
            List of Assignee
          </p>
          <div class="table-responsive p-3">
            <table class="table align-items-center table-flush table-hover" id="dt_details_2" style="width:100%">
              <thead class="thead-light">
                <tr>
                  <th></th>
                  <th>#</th>
                  <th>Name</th>
                  <th>Comment</th>
                  <th>Encoded By</th>
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
<script>
  $(document).ready(function() {
    $('.js-example-basic-multiple').select2();
    getEntryAssigned();
  });

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
          task_id: task_id
        }
      },
      "columns": [{
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
        },
        {
          "data": "encoded_by"
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