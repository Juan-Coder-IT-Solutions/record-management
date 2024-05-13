<?php
$assigned_task_id = $_GET['id'];
$fetch = $mysqli_connect->query("SELECT * FROM tbl_assigned_tasks WHERE assigned_task_id ='$assigned_task_id '") or die(mysqli_error());
$row = $fetch->fetch_array();
$task_row = task_row($row['task_id']);
?>
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-2 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <hr>
                    <form class="forms-sample">
                        <div class="col-md-12">
                            <button style="width: 100%;" type="button" onclick="uploadShow()" class="btn btn-primary btn-icon-text">
                                <i class="mdi mdi-upload btn-icon-prepend"></i>
                                Upload File
                            </button>
                        </div>
                        <div class="col-md-12">
                            <button onclick="deleteEntry()" id="btn_delete" style="width: 100%;" type="button" class="btn btn-danger btn-icon-text">
                                <i class="mdi mdi-close-circle btn-icon-prepend"></i>
                                Delete Entry
                            </button>
                        </div>
                        <hr>
                        <h2 class="card-title" style="color:#0ddbb9;"><?= $task_row['task_title'] ?></h2>
                        <p>Description: <?= $task_row['task_desc']; ?></p>
                        <p>Posted: <?= $task_row['posted_date'] ?></p>
                        <p>Deadline: <?= $task_row['deadline_date'] ?></p>
                        <hr>
                    </form>
                </div>
            </div>
        </div>
        <input type="hidden" id="assigned_task_id" value="<?= $assigned_task_id ?>">
        <div class="col-md-10 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title"><?= getUser($row['user_id']) ?></h4>
                    <p class="card-description" style="color: #464dee;">
                        Manage Files
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
                                            <th>File Name</th>
                                            <th>Date Added</th>
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
<form action="" method='POST' id='frm_upload'>
    <div class="modal fade" id="modal_upload" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="card-title"><?= $task_row['task_title'] ?></h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" class="form-control" value="<?= $assigned_task_id; ?>" name="assigned_task_id">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="exampleInputPassword4">File</label>
                                <input type="file" id="file_name" class="form-control" autocomplete="off" min='1' required name="file">
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" id="btn_submit_entry" class="btn btn-primary">Upload</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</form>
<script>
    $(document).ready(function() {
        getEntry();
    });

    function uploadShow() {
        $("#modal_upload").modal("show");
    }

    function deleteEntry() {
        var count_checked = $(".dt_id:checked").length;
        var tb = "tbl_assigned_task_files";
        var keyword = "file_id";

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

    $("#frm_upload").submit(function(e) {
        e.preventDefault();
        $("#btn_submit_entry").prop("disabled", true);
        $.ajax({
            type: "POST",
            url: "ajax/uploadTaskFile.php",
            data: new FormData(this),
            processData: false,
            contentType: false,
            success: function(data) {
                if (data == 1) {
                    success_add();
                    $('#file_name').val("");
                    getEntry();
                    $("#modal_upload").modal("hide");
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
        var assigned_task_id = $("#assigned_task_id").val();
        $("#dt_details").DataTable().destroy();
        $("#dt_details").DataTable({
            "processing": true,
            "responsive": true,
            "ajax": {
                "type": "POST",
                "url": "ajax/datatables/assigned_task_file.php",
                "dataSrc": "data",
                "data": {
                    assigned_task_id: assigned_task_id
                }
            },
            "columns": [{
                    "mRender": function(data, type, row) {
                        return "<div class='form-check form-check-success'><label class='form-check-label'><input type='checkbox' value=" + row.file_id + " class='dt_id form-check-input'><i class='input-helper'></i></label></div>";
                    }
                },
                {
                    "data": "btn_download"
                },
                {
                    "data": "count"
                },
                {
                    "data": "file_name"
                },
                {
                    "data": "date_added"
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
</script>