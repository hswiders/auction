<!-- View Modal -->
<div class="modal" id="myviewModal<?= $ship['id']; ?>">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Shipping Details</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      
      <!-- Modal body -->
      <div class="modal-body">
            <div class="row">
                  <div class="col-md-4">Recipient</div>
                  <div class="col-md-8"><b><?= $ship['f_name']." ".$ship['l_name']; ?></b></div>
            </div>
            <hr>  
            <div class="row">
                  <div class="col-md-4">Product Name</div>
                  <div class="col-md-8"><b><?= productName($ship['product_id']); ?></b></div>
            </div>
            <hr>

              <div class="row">
                    <div class="col-md-4">Country</div>
                    <div class="col-md-8"><b><?= $ship['country']; ?></b></div>
               </div>
              <hr>

              <div class="row">
                    <div class="col-md-4">City</div>
                    <div class="col-md-8"><b><?= $ship['city']; ?></b></div>
               </div>
              <hr>
               <div class="row">
                    <div class="col-md-4">State</div>
                    <div class="col-md-8"><b><?= $ship['state']; ?></b></div>
               </div>
              <hr>
               <div class="row">
                    <div class="col-md-4">Address 1</div>
                    <div class="col-md-8"><b><?= $ship['address']; ?></b></div>
               </div>
              <hr>
              <div class="row">
                    <div class="col-md-4">Address 2</div>
                    <div class="col-md-8"><b><?= $ship['address2']; ?></b></div>
               </div>
              <hr>
              <div class="row">
                    <div class="col-md-4">Zipcode</div>
                    <div class="col-md-8"><b><?= $ship['zipcode']; ?></b></div>
               </div>
              
          </div>
    
      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="printData('#myviewModal<?= $ship['id']; ?>')">Print</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
<!-- View Modal -->