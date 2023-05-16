
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
                  <th>Reject Date</th>
                  <th>Product Recieved</th>
                  <th>Product Delivery</th>
                  <th>Payment Details</th>
                  
                  <th>Status</th>
                   <th>Reject Reason</th>
                   <th>Shipping Address</th>
                  <th>Action</th>
              </tr>
            </thead>
          <tbody>
            <?php
            $x = 1;
              if ($reject_order_list) {
                foreach ($reject_order_list as $key => $value) {
                    ?>
              <tr>
                <td><?= $x; ?></td>
                <td>Order ID :<?= $value['order_uniqueid'] ?></td>
                            <td style="white-space:nowrap;"><?php 
                                $userdata = $this->common_model->GetSingleData('users',array('id'=>$value['user_id']));
                                echo "<b>Name</b>: ".$userdata['first_name']."".$userdata['last_name'];
                            ?></td> 
                            <td><?= date('d F Y h:i A' , strtotime($value['reject_date'])) ?></td>
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
                              <p>Grand Total : <?= $value['grand_total']; ?> HKD</p>
                              <p>Shipping fee : <?= $value['shipping_fee']; ?> HKD</p>
                            </td>
                           
                            <td><span class='badge badge-danger'>Rejected</span></td>
                            <td>
                             <?= $value['reject_reason'] ?>
                            </td>
                            <td style="white-space:nowrap;">
                            <ul>
                              <li>Address : <?= $value['address']; ?> <?= $value['address2']; ?></li>
                              <li>Country : <?= $value['country']; ?> </li>
                              <li>State : <?= $value['state']; ?> </li>
                              <li>City : <?= $value['city']; ?> </li>
                            </ul>
                              
                            </td>

                           <td>
                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myviewModal<?= $value['id']; ?>">Shipping Details</button>
                            </td>
              </tr>


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

function reject_product() {
  $('.alert-danger').remove();
    
      $.ajax({
      url: '<?= base_url() ?>/Admin/Order_Management/reject_product',
      type: 'POST',
      cache:false,
      contentType: false,
      processData: false,
      data:new FormData($('#reject_product')[0]),
      dataType: 'json',
      beforeSend: function() {        
        $('#add_btn').prop('disabled' , true);
        $('#add_btn').text('Processing..');
      },
      success : function(res){
        $('#add_btn').prop('disabled' , false);
        $('#add_btn').text('Add');
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
          for (var err in res.validation) {
            
            $("[name='" + err + "']").after("<div  class='label alert-danger'>" + res.validation[err] + "</div>");
          }
        }
      }
    });
return false;    
}




</script>
