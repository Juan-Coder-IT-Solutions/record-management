     <form action="" method='POST' id='frm_add_grades'>
       <div class="modal fade" id="modal_entry_grades" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog" role="document">
           <div class="modal-content">
             <div class="modal-header">
               <h4 class="card-title"><span id="can_title"></span></h4>
             </div>
             <div class="modal-body">
               <div class="row">
                 <input type="hidden" class="form-control" id="assigned_task_id" name="assigned_task_id">
                 <div class="col-sm-12">
                   <div class="form-group">
                     <label for="exampleInputPassword4">Grade</label>
                     <input type="number" min="0" max="100" class="form-control" id="task_grades" name="task_grades" autocomplete="off" required>
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