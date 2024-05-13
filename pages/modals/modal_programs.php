     <form action="" method='POST' id='frm_add'>
       <div class="modal fade" id="modal_entry" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog" role="document">
           <div class="modal-content">
             <div class="modal-header">
               <h4 class="card-title">Program Details</h4>
             </div>
             <div class="modal-body">
               <div class="row">
                 <input type="hidden" class="form-control modal_type" name="type">
                 <input type="hidden" class="form-control" id="program_id" name="program_id">
                 <div class="col-sm-12">
                   <div class="form-group">
                     <label for="exampleInputPassword4">Program</label>
                     <input type="text" class="form-control" placeholder="Program name" id="program_name" name="program_name" autocomplete="off" required>
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