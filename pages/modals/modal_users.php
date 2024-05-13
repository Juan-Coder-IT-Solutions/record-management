<form action="" method='POST' id='frm_add'>
  <div class="modal fade" id="modal_entry" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="card-title">User Details</h4>
        </div>
        <div class="modal-body">
          <div class="row">
            <input type="hidden" class="form-control modal_type" name="type">
            <input type="hidden" class="form-control" id="user_id" name="user_id">
            <div class="col-sm-4">
              <div class="form-group">
                <label for="exampleInputPassword4">First Name <strong style="color:red;">*</strong></label>
                <input type="text" class="form-control" id="first_name" name="first_name" autocomplete="off" required>
              </div>
            </div>
            <div class="col-sm-4">
              <div class="form-group">
                <label for="exampleInputPassword4">Middle Name</label>
                <input type="text" class="form-control" id="middle_name" name="middle_name" autocomplete="off">
              </div>
            </div>
            <div class="col-sm-4">
              <div class="form-group">
                <label for="exampleInputPassword4">Last Name <strong style="color:red;">*</strong></label>
                <input type="text" class="form-control" id="last_name" name="last_name" autocomplete="off" required>
              </div>
            </div>
            <div class="col-sm-6">

              <div class="form-group">
                <label>User Category <strong style="color:red;">*</strong></label>
                <div>
                  <select class="select2 form-control form-control-lg" id="user_category" name="user_category" required style="width: 100%;">
                    <option value="">Please Select</option>
                    <option value="F">Faculty</option>
                    <option value="S">Staff</option>
                    <option value="P">Program Chair</option>
                    <option value="R">Registrar</option>
                    <option value="D">Dean</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label>Program <strong style="color:red;">*</strong></label>
                <div>
                  <select class="select2 form-control form-control-lg" id="program_id" name="program_id" style="width: 100%;">
                    <option value="">Please Select</option>
                    <?php
                      $fetch_program = $mysqli_connect->query("SELECT * FROM tbl_programs") or die(mysqli_error());
                      while($pRpow = $fetch_program->fetch_array()) { ?>
                        <option value='<?= $pRpow['program_id'] ?>'><?= $pRpow['program_name'] ?></option>";
                    <?php }  ?>
                  </select>
                </div>

              </div>
            </div>
            <div class="col-sm-4">
              <div class="form-group">
                <label for="exampleInputPassword4">Designation <strong style="color:red;">*</strong></label>
                <input type="text" class="form-control" id="designation" name="designation" autocomplete="off" required>
              </div>
            </div>
            <div class="col-sm-4">
              <div class="form-group">
                <label for="exampleInputPassword4">Academic Rank <strong style="color:red;">*</strong></label>
                <input type="text" class="form-control" id="academic_rank" name="academic_rank" autocomplete="off" required>
              </div>
            </div>
            <div class="col-sm-4">
              <div class="form-group">
                <label for="exampleInputPassword4">Username <strong style="color:red;">*</strong></label>
                <input type="text" class="form-control" id="username" name="username" autocomplete="off" required>
              </div>
            </div>
            
            <div class="col-sm-12" id="div_password">
              <div class="form-group">
                <label for="exampleInputPassword4">Password <strong style="color:red;">*</strong></label>
                <input type="password" class="form-control" id="password" name="password" autocomplete="off" required>
              </div>
            </div>
          </div>

        </div>
        <div class="modal-footer">
          <button type="submit" id="btn_submit_entry" class="btn btn-primary">Save</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</form>