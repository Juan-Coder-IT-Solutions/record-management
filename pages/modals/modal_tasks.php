<form action="" method='POST' id='frm_add'>
  <div class="modal fade" id="modal_entry" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="card-title">Task Details</h4>
        </div>
        <div class="modal-body">
          <div class="row">
            <input type="hidden" class="form-control modal_type" name="type">
            <input type="hidden" class="form-control" id="task_id" name="task_id">
            <div class="col-sm-12">
              <div class="form-group">
                <label for="exampleInputPassword4">Task Title <strong style="color:red;">*</strong></label>
                <input type="text" class="form-control" id="task_title" name="task_title" autocomplete="off" required>
              </div>
            </div>
            <div class="col-sm-12">
              <div class="form-group">
                <label for="exampleInputPassword4">Description</label>
                <textarea class="form-control" id="task_desc" name="task_desc" autocomplete="off"></textarea>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label for="exampleInputPassword4">Posted Date <strong style="color:red;">*</strong></label>
                <input type="date" class="form-control" id="posted_date" name="posted_date" autocomplete="off" required>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label for="exampleInputPassword4">Deadline Date <strong style="color:red;">*</strong></label>
                <input type="date" class="form-control" id="deadline_date" name="deadline_date" autocomplete="off" required>
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