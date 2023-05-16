
<?php include ('include/header.php') ?>

<div class="page-header">
	<div class="container">
		<div class="d-flex">
			<h1>Admin dashboard</h1>
		</div>
	</div>
</div>
<div class="admin-dash">
	<div class="container">
        <div class="row">
            <?php include ('include/sidebar.php') ?>
            <div class="col-md-9">
        		<div class="table-part">
                    <div>
        			    <h4 class="d-flex justify-content-between">Exchange Order management: 
                    
                    <!-- <a href="<?php echo base_url('Admin/product/productform'); ?>" class="btn btn-info">Add</a></h4>
 -->
                    </div>
                    
                    <div id="result"></div>
        		
        		    <div class="table-responsive">		
        		        <!-- <table id="example3" class="display dataTable dataTables_wrapper" style="width:100%"> -->
    <table  id="myTable" class="display dataTable dataTables_wrapper" style="width:100%">
        <thead>
              <tr>
                  <th>S. No.</th>
                  <th>Exchange Order Id</th>
                  <th>User Detail</th>
                  <th>Created Date</th>
                  <th>Product Recieved</th>
                  <th>Product Delivery</th>
                  <th>Payment Details</th>
                  
                  <th>Status</th>
                   <th>Shipping Address</th>
                  <th>Action</th>
              </tr>
            </thead>
          <tbody>
            <?php
            $x = 1;
              if ($pending_order_list) {
                foreach ($pending_order_list as $key => $value) {
                    ?>
              <tr>
                <td><?= $x; ?></td>
                <td>Order ID :<?= $value['order_uniqueid'] ?></td>
                            <td style="white-space:nowrap;"><?php 
                                $userdata = $this->common_model->GetSingleData('users',array('id'=>$value['user_id']));
                                echo "<b>Name</b>: ".$userdata['first_name']."".$userdata['last_name'];
                            ?></td> 
                            <td><?= date('d F Y h:i A' , strtotime($value['created_at'])) ?></td>
                            <td style="white-space:nowrap;"><?php 
                            $product = $this->common_model->GetSingleData('product',array('id'=>$value['product_id']));
                                echo "<span style='display: inline-block;'><a href='". get_product_url($product) ."' target='_blank'>".$product['title']."</a>  ".gradeName($product['class_type'])." </span>";
                            ?></td>
                             <td style="white-space:nowrap;"><?php 
                             $Exproduct = $this->common_model->GetAllData('product', 'id IN('.$value['exchnage_product_id'].')');
                            foreach ($Exproduct as $key => $exvalue) {
                              echo " <span style='display: inline-block;'> <a href='". get_product_url($exvalue) ."' target='_blank'>".$exvalue['title']."</a>".gradeName($exvalue['class_type'])." </span> ,";
                            }
                                
                            ?></td>
                            <td>
                              <p>Step Charge : <?= $value['price']; ?> HKD</p>
                              <p>Service Fee : <?= $value['service_fee']; ?> HKD</p>
                              <p>Shipping fee : <?= $value['shipping_fee']; ?> HKD</p>
                              <p>Grand Total : <?= $value['grand_total']; ?> HKD</p>
                            </td>
                           
                            <td><span class='badge badge-danger'>Pending</span></td>
                            <td style="white-space:nowrap;">
                            <ul>
                              <li>Address : <?= $value['address']; ?> <?= $value['address2']; ?></li>
                              <li>Country : <?= $value['country']; ?> </li>
                              <li>State : <?= $value['state']; ?> </li>
                              <li>City : <?= $value['city']; ?> </li>
                            </ul>
                              
                            </td>
                           <td>
                             <button class="btn btn-success btn-sm" onclick="accept_product(<?php echo $value['id']; ?>,1,<?php echo $userdata['id']; ?>)" id="btn_load<?= $value['id']; ?>" >Accept</button>
                              <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#myrejectModal<?= $value['id']; ?>">Reject</button> 
                               <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myviewModal<?= $value['id']; ?>">Shipping Details</button>
                            </td>
              </tr>
<!-- reject Modal -->
<div class="modal" id="myrejectModal<?= $value['id']; ?>">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Reject Exchange order</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
        <form id="reject_product<?= $value['id'] ?>" method="post" action="#" onsubmit="return reject_product('<?= $value['id'] ?>')" >
            <div class="col-md-12 py-3">
                <div>
                    <label>Reason</label>
                    <textarea class="form-control" name="reason" required></textarea>
                    <input type="hidden" name="id" value="<?= $value['id']; ?>">
                    <input type="hidden" name="user_id" value="<?= $userdata['id'];?> ">
                    <input type="hidden" name="status" value="2">
                </div>
               
                <div class="mt-3 text-center">
                    <button type="submit" id="add_btn<?= $value['id'] ?>"  class="btn btn-success">Reject</button>
                </div>
                
            </div>
        </form>
    

    </div>
  </div>
</div>
<!-- reject Modal -->

<!-- View Modal -->
<?=  view('admin/modals/shipping_modal' , ['ship' => $value]); ?>
<!-- View Modal -->

      <?php
      $x++;
      }
    }
  ?>

                        </tbody>
                  </table>
        	        </div>
        	    </div>
            </div>
        </div>
    </div>
</div>
<?php include ('include/footer.php') ?> 
<script type="text/javascript">

  function accept_product(id,status,user_id)
   {
    if(confirm('Are you sure?'))
    {
    $.ajax({
          type: "POST",
          url: "<?php echo base_url('Admin/Order_Management/accept_product'); ?>",
          data: {id:id,status:status,user_id:user_id},
          dataType: "json",
          beforeSend:function(){
          $('#submit'+id).prop('disabled',true);
          $('#btn_load'+id).show();
        },
          success: function(res){
            if(res.status == 1)  //json status return by controller
            {
              Swal.fire({
                 title: "Success", 
                 text: res.message, 
                 icon: "success"
               }).then(function (result) {
              location.reload();
              })
            }
            else
            {
              $('.error-msg').html(data.message);
              $('#submit'+id).prop('disabled',false);
              $('#btn_load'+id).hide();
            }
              
          },
          
     });
    }

   }

function reject_product(id) {
  $('.alert-danger').remove();
    
      $.ajax({
      url: '<?= base_url() ?>/Admin/Order_Management/reject_product',
      type: 'POST',
      cache:false,
      contentType: false,
      processData: false,
      data:new FormData($('#reject_product'+id)[0]),
      dataType: 'json',
      beforeSend: function() {        
        $('#add_btn'+id).prop('disabled' , true);
        $('#add_btn'+id).text('Processing..');
      },
      success : function(res){
        $('#add_btn'+id).prop('disabled' , false);
        $('#add_btn'+id).text('Add');
        if (res.status == 1) {
            Swal.fire({
               title: "Success", 
               text: res.message, 
               icon: "success"
             }).then(function (result) {
            location.reload();
            })         
        }
        else
        {
         
          $('#result').html(res.message);
          for (var err in res.message) {
            
            $("[name='" + err + "']").after("<div  class='label alert-danger'>" + res.message[err] + "</div>");
          }
        }
      }
    });
return false;    
}

</script>
