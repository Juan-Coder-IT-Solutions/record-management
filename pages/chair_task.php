<div class="content-wrapper">
    <div class="row">
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <!-- <h4 class="card-title">Default form</h4> -->
                    <h4 class="card-title" style="color:#0ddbb9;">Tasks Created</h4>
                    <p class="card-description" style="color: #464dee;">
                        View the tasks you’ve assigned to others and track their progress.
                    </p>
                    <div class="col-lg-12">
                        <div class="card mb-4">
                            <div class="table-responsive p-3">
                                <table class="table align-items-center table-flush table-hover" id="dt_task_created">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>
                                                <div class='form-check form-check-success'><label class='form-check-label'><input type='checkbox' class='dt_id' class='form-check-input' onchange="checkAll(this,'dt_id')"><i class='input-helper'></i></label></div>
                                            </th>
                                            <th></th>
                                            <th>#</th>
                                            <th>Task Title</th>
                                            <th>Description</th>
                                            <!-- <th>Encoded By</th> -->
                                            <th>Posted Date</th>
                                            <th>Deadline Date</th>
                                            <th>Progress</th>
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
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <!-- <h4 class="card-title">Default form</h4> -->
                    <h4 class="card-title" style="color:#0ddbb9;">Programs</h4>
                    <p class="card-description" style="color: #464dee;">
                        See the tasks assigned to you and manage your responsibilities.
                    </p>
                    <div class="col-lg-12">
                        <div class="card mb-4">
                            <div class="table-responsive p-3">
                                <table class="table align-items-center table-flush table-hover" id="dt_given_task">
                                    <thead class="thead-light">
                                        <tr>
                                            <th></th>
                                            <th>#</th>
                                            <th>Task</th>
                                            <th>Description</th>
                                            <th>Assigned by</th>
                                            <th>Status</th>
                                            <th>Posted Date</th>
                                            <th>Deadline</th>
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
<script>
    $(document).ready(function() {
        getEntry();
        getGivenTask();
    });

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
        $("#dt_task_created").DataTable().destroy();
        $("#dt_task_created").DataTable({
            "processing": true,
            "responsive": true,
            "ajax": {
                "type": "POST",
                "url": "ajax/datatables/chair_tasks.php",
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
                        return `<center>
                      <button class='btn btn-primary btn-circle btn-sm' onclick='getEntryDetails(${row.task_id})'><span class='mdi mdi-lead-pencil'></span></button><button class='btn btn-success btn-circle btn-sm' onclick='window.location="index.php?page=manage-assigned-task&id=${row.task_id}"'><span class='mdi mdi-account-multiple-plus'></span></button>
                    </center>`;
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
                // {
                //     "data": "encoded_by"
                // },
                {
                    "data": "posted_date"
                },
                {
                    "data": "deadline_date"
                },
                {
                    "mRender": function(data, type, row) {
                        return '<div class="progress"><div class="progress-bar bg-info" role="progressbar" style="width: ' + row.task_percentage + '%" title="' + row.task_percentage + '%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div></div>';
                    }
                }
            ]
        });

    }

    function getGivenTask() {
        $("#dt_given_task").DataTable().destroy();
        $("#dt_given_task").DataTable({
            "processing": true,
            "responsive": true,
            "ajax": {
                "type": "POST",
                "url": "ajax/datatables/given_tasks.php",
                "dataSrc": "data",
                "data": {
                    //type:type
                }
            },
            "columns": [{
                    "mRender": function(data, type, row) {
                        return "<center><button type='button' class='btn btn-info btn-circle btn-sm' onclick='window.location = \"index.php?page=assign-task&id=" + row.assigned_task_id + "\"'><span class='mdi mdi-file-document'></span></button></center>";

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
                    "mRender": function(data, type, row) {
                        return row.status == "P" ? "<span class='badge badge-warning'>Pending</span>" : (row.status == "AF" ? "<span class='badge badge-success'>Approved</span>" : "<span class='badge badge-primary'>Finished</span>");

                    }
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