<?php
$assigned_task_id = $_GET['id'];
$fetch = $mysqli_connect->query("SELECT * FROM tbl_assigned_tasks WHERE assigned_task_id ='$assigned_task_id '") or die(mysqli_error());
$row = $fetch->fetch_array();
$task_row = task_row($row['task_id']);


if (isset($_GET['notif'])) {
    $mysqli_connect->query("UPDATE tbl_notifications SET status=0 WHERE notification_id='$_GET[notif]'") or die(mysqli_error());
}
// <span class='btn btn-inverse-warning btn-fw btn-sm'>Pending</span>" : (row.status == "O" ? "<span class='btn btn-inverse-info btn-fw btn-sm'>Ongoing</span>" : "<span class='btn btn-inverse-success btn-fw btn-sm'>Finished</span>
if ($task_row['status'] == "P") {
    $status = "<span class='btn btn-inverse-warning btn-fw btn-sm'>Pending</span>";
} else {
    if ($row['status'] == "U") {
        $status = "<span class='btn btn-inverse-info btn-fw btn-sm'>Uploaded</span>";
    } else if ($row['status'] == "A") {
        $status = "<span class='btn btn-inverse-success btn-fw btn-sm'>Approved</span>";
    } else if ($row['status'] == "R") {
        $status = "<span class='btn btn-inverse-danger btn-fw btn-sm'>Revision</span>";
    } else if ($row['status'] == "C") {
        $status = "<span class='btn btn-inverse-primary btn-fw btn-sm'>Checking</span>";
    } else {
        $status = "<span class='btn btn-inverse-warning btn-fw btn-sm'>Not Uploaded</span>";
    }
}

?>
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-3 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <hr>
                    <form class="forms-sample">
                        <?php if ($row['user_id'] == $user_id) { ?>
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
                        <?php } ?>
                        <hr>
                        <h2 class="card-title" style="color:#0ddbb9;"><?= $task_row['task_title'] ?></h2>
                        <p>Status: <?= $status ?></p>
                        <p>Description: <?= $task_row['task_desc']; ?></p>
                        <p>Posted: <?= $task_row['posted_date'] ?></p>
                        <p>Deadline: <?= $task_row['deadline_date'] ?></p>
                        <hr>
                    </form>
                    <div id="con_comment" class="row" style="max-height: 200px;overflow-y: auto;">
                        <?php
                        $fetchComments = $mysqli_connect->query("SELECT * FROM tbl_comments WHERE assigned_task_id='$assigned_task_id'");
                        while ($comRow = $fetchComments->fetch_array()) { ?>

                            <?php if ($comRow['user_id'] != $user_id) { ?>
                                <div class="col-md-8">
                                    <address class="text-primary">
                                        <p style="text-align: left;" class="font-weight-bold"><?= $comRow['comment'] ?></p>
                                        <p style="text-align: left;font-size:8px;color: #9E9E9E;"><?= time_ago($comRow['date_added']) ?></p>
                                    </address>
                                </div>
                                <div class="col-md-4">
                                </div>
                            <?php } ?>
                            <?php if ($comRow['user_id'] == $user_id) { ?>
                                <div class="col-md-4">
                                </div>
                                <div class="col-md-8">
                                    <address class="text-success">
                                        <p style="text-align: right;" class="font-weight-bold">
                                            <?= $comRow['comment'] ?>
                                        </p>
                                        <p style="text-align: right;font-size:8px;color: #9E9E9E;"><?= time_ago($comRow['date_added']) ?></p>
                                    </address>
                                </div>
                            <?php } ?>
                        <?php } ?>

                    </div>
                    <textarea style="height: 90px;" id="comment" class="form-control" placeholder="Leave comment"></textarea>
                    <button class="btn btn-primary" onclick="submitComment(<?= $assigned_task_id ?>)" style="width: 100%;">Submit</button>
                </div>
            </div>
        </div>
        <input type="hidden" id="assigned_task_id" value="<?= $assigned_task_id ?>">
        <input type="hidden" id="assigned_user_id" value="<?= $row['user_id'] ?>">
        <input type="hidden" id="task_id" value="<?= $row['task_id'] ?>">
        <div class="col-md-9 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h1 class="card-title"><?= getUser($row['user_id']) ?></h1>
                    <!-- <p class="card-description" style="color: #464dee;">
                        Manage Files
                    </p> -->
                    <?php
                    if ($task_row['user_id'] == $user_id or $_SESSION['user_category'] == "D") { ?>
                        <div class="col-lg-12">
                            <div class="template-demo">
                                <button type="button" <?= $row['status'] == "U" || $row['status'] == "R" ? "" : "hidden"; ?> onclick="changeStatus('C')" class="btn btn-info btn-fw">Checking</button>
                                <button type="button" <?= $row['status'] == "C" ? "" : "hidden"; ?> onclick="changeStatus('R')" class="btn btn-warning btn-fw">Revision</button>
                                <button type="button" <?= $row['status'] == "C" || $row['status'] == "R" ? "" : "hidden"; ?> onclick="changeStatus('A')" class="btn btn-success btn-fw">Approved</button>
                            </div>
                        </div>
                        <hr>
                    <?php } ?>
                    <div class="col-lg-12">
                        <div class="card mb-4">
                            <div class="table-responsive p-3">
                                <table class="table align-items-center table-flush table-hover" id="dt_details">
                                    <thead class="thead-light">
                                        <tr>
                                            <!-- <th>
                                                <div class='form-check form-check-success'><label class='form-check-label'><input type='checkbox' class='dt_id' class='form-check-input' onchange="checkAll(this,'dt_id')"><i class='input-helper'></i></label></div>
                                            </th> -->
                                            <th></th>
                                            <th>#</th>
                                            <th>File Name</th>
                                            <th>Preview</th>
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
                        <input type="hidden" value="<?= $assigned_task_id; ?>" name="assigned_task_id">
                        <input type="hidden" value="<?= $row['task_id']; ?>" name="task_id">
                        <input type="hidden" value="<?= $task_row['user_id']; ?>" name="user_id">
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
<!-- Modal for File Preview -->
<div class="modal fade" id="fileModal" tabindex="-1" role="dialog" aria-labelledby="fileModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="fileModalLabel">File Preview</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="modalContent"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<script>
    function openModal(filePath, type) {
        var modalContent = document.getElementById('modalContent');
        if (type === 'image') {
            modalContent.innerHTML = "<img src='" + filePath + "' alt='Image Preview' style='width: 100%; height: auto;' />";
        } else if (type === 'pdf') {
            modalContent.innerHTML = "<iframe src='" + filePath + "' style='width: 100%; height: 400px;' frameborder='0'></iframe>";
        } else if (type === 'audio') {
            modalContent.innerHTML = "<audio controls style='width: 100%;'><source src='" + filePath + "' type='audio/mpeg'>Your browser does not support the audio tag.</audio>";
        } else if (type === 'video') {
            modalContent.innerHTML = "<video controls style='width: 100%;'><source src='" + filePath + "' type='video/mp4'>Your browser does not support the video tag.</video>";
        }
        // Show the modal
        $('#fileModal').modal('show');
    }

    $(document).ready(function() {
        getEntry();
        scrollToBottom();
    });

    function scrollToBottom() {
        var commentsDiv = document.getElementById("con_comment");
        commentsDiv.scrollTop = commentsDiv.scrollHeight;
    }

    function uploadShow() {
        $("#modal_upload").modal("show");
    }

    function changeStatus(status) {
        var assigned_task_id = $("#assigned_task_id").val();
        var assigned_user_id = $("#assigned_user_id").val();
        var task_id = $("#task_id").val();
        swal({
                title: "Are you sure?",
                text: "You will not be able to recover these entries!",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Yes, change it!",
                cancelButtonText: "No, cancel!",
                closeOnConfirm: false,
                closeOnCancel: false
            },
            function(isConfirm) {
                if (isConfirm) {
                    $.ajax({
                        type: "POST",
                        url: "ajax/taskChangeStatus.php",
                        data: {
                            status: status,
                            assigned_task_id: assigned_task_id,
                            user_id: assigned_user_id,
                            task_id: task_id
                        },
                        success: function(data) {
                            if (data == 1) {
                                success_update();
                                location.reload();
                            } else {
                                failed_query("Programs");
                            }

                        }
                    });

                } else {
                    swal("Cancelled", "Entries are safe :)", "error");
                }
            });
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
                    location.reload();
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

    function submitComment(id) {
        var comment = $('#comment').val();
        if (comment.length > 0) {
            $.ajax({
                type: "POST",
                url: "ajax/addComment.php",
                data: {
                    id: id,
                    comment: comment
                },
                success: function(data) {
                    if (data == 1) {
                        success_add();
                        $('#comment').val('');
                        getComments(id);
                        scrollToBottom();
                    } else {
                        failed_query("Comment");
                    }
                }
            });
        } else {
            swal("Cannot proceed!", "Please enter a comment!", "warning");
        }
    }

    function getComments(assigned_task_id) {
        $.ajax({
            type: "POST",
            url: "ajax/getComments.php",
            data: {
                assigned_task_id: assigned_task_id
            },
            success: function(data) {
                $("#con_comment").html(data);
                scrollToBottom();
            }
        });
    }

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
            "columns": [
                // {
                //     "mRender": function(data, type, row) {
                //         return "<div class='form-check form-check-success'><label class='form-check-label'><input type='checkbox' value=" + row.file_id + " class='dt_id form-check-input'><i class='input-helper'></i></label></div>";
                //     }
                // },
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
                    "data": "preview", // New column for file previews
                    "orderable": false // Disable ordering for the preview column
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