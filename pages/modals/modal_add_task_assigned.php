<form action="" method='POST' id='frm_add_task_assign'>
  <div class="modal fade" id="modal_entry_task_assign" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="card-title"><span id="assign_title"></span></h4>
        </div>
        <div class="modal-body">
          <div class="row">
            <input type="hidden" class="form-control modal_type" name="type">
            <input type="hidden" class="form-control" id="task_id_assign" name="task_id">
            <div class="col-sm-12">
              
              <div class="form-group">
                <!-- <label for="exampleInputPassword4">User <strong style="color:red;">*</strong></label>
                <div> -->
                  <!-- class="select2 form-control form-control-lg" -->
                  <select class="js-example-basic-multiple w-100" style="width:100%" multiple="multiple"  id="user_id" name="user_id">
                    <option value="">Please Select</option>
                    <?php
                    $fetch_program = $mysqli_connect->query("SELECT * FROM tbl_users") or die(mysqli_error());
                    while ($pRpow = $fetch_program->fetch_array()) { ?>
                      <option value='<?= $pRpow['user_id'] ?>'><?= $pRpow['first_name'] . " " . $pRpow['middle_name'] . " " . $pRpow['last_name'] ?></option>";
                    <?php }  ?>
                  </select>
                <!-- </div> -->
              </div>
            </div>
            <div class="col-sm-12">
              <div class="card">
                <div class="table-responsive p-3">
                  <table class="table align-items-center table-flush table-hover" id="dt_details_2" style="width:100%">
                    <thead class="thead-light">
                      <tr>
                        <th></th>
                        <th>#</th>
                        <th>Name</th>
                        <th>Comment</th>
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
        <div class="modal-footer">
          <button type="submit" id="btn_assign_entry" class="btn btn-primary">Add</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</form>