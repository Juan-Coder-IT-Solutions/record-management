<div class="modal fade" id="modal_upload_file" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update File</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="" method='POST' id='frm_upload_file'>
          <input type="hidden" class="form-control" id="upload_file_id" name="file_id">
          <div class="form-group" id="div_file" style="margin-bottom: 0rem;">
            <label for="message-text" class="col-form-label">File:</label>
            <input type="file" class="form-control" id="file" autocomplete="off" min='1' required name="file">
          </div>
      </div>
      <div class="modal-footer">
        <button type="submit" id="btn_upload_file" class="btn btn-primary"><span class="fa fa-plus-circle"></span> Save</button>
      </form>
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><span class="fa fa-times-circle"></span> Close</button>
      </div>
    </div>
  </div>
</div>