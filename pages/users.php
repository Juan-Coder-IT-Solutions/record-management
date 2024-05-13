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
          <h4 class="card-title" style="color:#0ddbb9;">Users</h4>
          <p class="card-description" style="color: #464dee;">
            Manage Users
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
                      <th>Full Name</th>
                      <th>User Category</th>
                      <th>Program</th>
                      <th>Designation</th>
                      <th>Academic Rank</th>
                      <th>Date</th>
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

<?php require_once 'modals/modal_users.php'; ?>
<script>
  $(document).ready(function() {
    getEntry();
  });

  function deleteEntry() {
    var count_checked = $(".dt_id:checked").length;
    var tb = "tbl_users";
    var keyword = "user_id";

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
            var checkedValues = $(".dt_id:checked").map(function() { // Corrected checkbox value retrieval
              return $(this).val();
            }).get();

            console.log("sample", checkedValues);
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
    var tb = "tbl_users";
    var keyword = "user_id";

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
        $("#first_name").val(json.first_name);
        $("#middle_name").val(json.middle_name);
        $("#last_name").val(json.last_name);
        $("#user_category").val(json.user_category);
        $("#username").val(json.username);
        $("#program_id").val(json.program_id);
        $("#designation").val(json.designation);
        $("#academic_rank").val(json.academic_rank);
        $("#password").val(json.password);
        $("#user_id").val(json.user_id);
        $(".modal_type").val("update");
        $("#div_password").hide();
      }
    });
  }



  $("#frm_add").submit(function(e) {
    e.preventDefault();
    $("#btn_submit_entry").prop("disabled", true);
    var type = $(".modal_type").val();
    $.ajax({
      type: "POST",
      url: "ajax/manageUser.php",
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
        "url": "ajax/datatables/users.php",
        "dataSrc": "data",
        "data": {
          //type:type
        }
      },
      "columns": [{
          "mRender": function(data, type, row) {
            return "<div class='form-check form-check-success'><label class='form-check-label'><input type='checkbox' value=" + row.user_id + " class='dt_id form-check-input'><i class='input-helper'></i></label></div>";
          }
        },
        {
          "mRender": function(data, type, row) {
            return "<center><button class='btn btn-primary btn-circle btn-sm' onclick='getEntryDetails(" + row.user_id + ")'><span class='mdi mdi-lead-pencil'></span></button></center>";
          }
        },
        {
          "data": "count"
        },
        {
          "data": "full_name"
        },
        {
          "data": "category"
        },
        {
          "data": "program"
        },
        {
          "data": "designation"
        },
        {
          "data": "academic_rank"
        },
        {
          "data": "date_added"
        }
      ]
    });

  }
</script>