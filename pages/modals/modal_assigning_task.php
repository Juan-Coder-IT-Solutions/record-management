<form action="" method='POST' id='frm_add_task_assign'>
    <div class="modal fade" id="modal_entry_task_assign" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="card-title"><?= taskNname($_GET['id']) ?></h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" value="<?= $_GET['id'] ?>" name="task_id" id="task_id_assign">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Chairperson</h4>
                                    <div class="table-responsive p-3">
                                        <table class="table align-items-center table-flush table-hover" id="dt_assign_1" style="width:100%;">
                                            <thead class="thead-light" style="background: #C8E6C9;">
                                                <tr>
                                                    <th></th>
                                                    <th>Full name</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <h4 class="card-title">Registrar</h4>
                                    <div class="table-responsive p-3">
                                        <table class="table align-items-center table-flush table-hover" id="dt_assign_2" style="width:100%">
                                            <thead class="thead-light" style="background: #C8E6C9;">
                                                <tr>
                                                    <th></th>
                                                    <th>Full name</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                
                                <div class="card-body">
                                    <h4 class="card-title">Faculty</h4>
                                    <div class="table-responsive p-3">
                                        <table class="table align-items-center table-flush table-hover" id="dt_assign_3" style="width:100%">
                                            <thead class="thead-light" style="background: #C8E6C9;">
                                                <tr>
                                                    <th></th>
                                                    <th>Full name</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <h4 class="card-title">Staff</h4>
                                    <div class="table-responsive p-3">
                                        <table class="table align-items-center table-flush table-hover" id="dt_assign_4" style="width:100%">
                                            <thead class="thead-light" style="background: #C8E6C9;">
                                                <tr>
                                                    <th></th>
                                                    <th>Full name</th>
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
                <div class="modal-footer">
                    <button type="submit" id="btn_assign_entry" class="btn btn-primary">Add</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
    function getAssign1() {
        $("#dt_assign_1").DataTable().destroy();
        $("#dt_assign_1").DataTable({
            "processing": true,
            "responsive": true,
            "paging": false, 
            "info": false, 
            "ajax": {
                "type": "POST",
                "url": "ajax/datatables/get_users.php",
                "dataSrc": "data",
                "data": {
                    user_category: 'P'
                }
            },
            "columns": [{
                    "mRender": function(data, type, row) {
                        return "<div class='form-check form-check-success'><label class='form-check-label'><input type='checkbox' value=" + row.user_id + " name='user_id[]' class='dt_id form-check-input'><i class='input-helper'></i></label></div>";
                    }
                },
                {
                    "data": "full_name"
                }
            ]
        });

    }

    function getAssign2() {
        $("#dt_assign_2").DataTable().destroy();
        $("#dt_assign_2").DataTable({
            "processing": true,
            "responsive": true,
            "paging": false, 
            "info": false, 
            "ajax": {
                "type": "POST",
                "url": "ajax/datatables/get_users.php",
                "dataSrc": "data",
                "data": {
                    user_category: 'R'
                }
            },
            "columns": [{
                    "mRender": function(data, type, row) {
                        return "<div class='form-check form-check-success'><label class='form-check-label'><input type='checkbox' value=" + row.user_id + " name='user_id[]' class='dt_id form-check-input'><i class='input-helper'></i></label></div>";
                    }
                },
                {
                    "data": "full_name"
                }
            ]
        });

    }

    function getAssign3() {
        $("#dt_assign_3").DataTable().destroy();
        $("#dt_assign_3").DataTable({
            "processing": true,
            "responsive": true, 
            "paging": false, 
            "info": false, 
            "ajax": {
                "type": "POST",
                "url": "ajax/datatables/get_users.php",
                "dataSrc": "data",
                "data": {
                    user_category: 'F'
                }
            },
            "columns": [{
                    "mRender": function(data, type, row) {
                        return "<div class='form-check form-check-success'><label class='form-check-label'><input type='checkbox' value=" + row.user_id + " name='user_id[]' class='dt_id form-check-input'><i class='input-helper'></i></label></div>";
                    }
                },
                {
                    "data": "full_name"
                }
            ]
        });

    }

    function getAssign4() {
        $("#dt_assign_4").DataTable().destroy();
        $("#dt_assign_4").DataTable({
            "processing": true,
            "responsive": true,
            "paging": false, 
            "info": false, 
            "ajax": {
                "type": "POST",
                "url": "ajax/datatables/get_users.php",
                "dataSrc": "data",
                "data": {
                    user_category: 'S'
                }
            },
            "columns": [{
                    "mRender": function(data, type, row) {
                        return "<div class='form-check form-check-success'><label class='form-check-label'><input type='checkbox' value=" + row.user_id + " name='user_id[]' class='dt_id form-check-input'><i class='input-helper'></i></label></div>";
                    }
                },
                {
                    "data": "full_name"
                }
            ]
        });

    }
</script>