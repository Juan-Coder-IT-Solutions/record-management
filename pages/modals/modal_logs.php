<div class="modal fade" id="modal_logs" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="card-title">History</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="table-responsive p-3">
            <table style="width: 100%;" class="table align-items-center table-flush table-hover" id="dt_sub_details">
              <thead class="thead-light">
                <tr>
                  <th>#</th>
                  <th>Remarks</th>
                  <th>From</th>
                  <th>Updated to</th>
                  <th>Encoded By</th>
                  <th>Date</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<script>
  function getSubDetails(type) {
    $("#dt_sub_details").DataTable().destroy();
    $("#dt_sub_details").DataTable({
      "processing": true,
      "responsive": true,
      "ajax": {
        "type": "POST",
        "url": "ajax/datatables/logs.php",
        "dataSrc": "data",
        "data": {
          type:type
        }
      },
      "columns": [
        {
          "data": "count"
        },
        {
          "data": "remarks"
        },
        {
          "data": "updated_from"
        },
        {
          "data": "updated_to"
        },
        {
          "data": "encoded_by"
        },
        {
          "data": "date_added"
        }
      ]
    });

  }
</script>