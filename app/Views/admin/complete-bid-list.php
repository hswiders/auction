
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
        			    <h4 class="d-flex justify-content-between">Bid Product management: 
                    
                    <!-- <a href="<?php echo base_url('Admin/product/productform'); ?>" class="btn btn-info">Add</a></h4>
 -->
                    </div>
                    
                    <div id="result"></div>
        		
        		    <?php
              $export = true;
            ?>
                <div class="table-responsive">    
                    <!-- <table id="example3" class="display dataTable dataTables_wrapper" style="width:100%"> -->
    <table  id="myTable" class="display dataTable dataTables_wrapper" style="width:100%">
        
      <thead>
          <tr>
             
                <th>Order Id</th>
                <th>Buyer Detail</th>
                <th>Seller Details</th>
                <th>Date of Purchase</th>
                <th>Product name</th>
                <th>Trade Details</th>
                <th>Bid Price</th>
                <th>Status</th>
                <th>Action</th>
                <th>Shipping Address</th>
                <th>Payment Details</th>
          </tr>
        </thead>
      <tbody>
        <?php
        $x = 1;
          if ($bid_product_list) {
            foreach ($bid_product_list as $key => $value) {
                ?>
          <tr>
            <td>
              <?= $value['order_uniqueid']; ?><bt>
              <?php if($value['admin_status'] == 0): ?>
                        <button type="button" class="btn btn-success btn-sm confirm-btn" id="confirm_btns<?php echo $value['id']; ?>" data-id="<?php echo $value['id']; ?>">Mark order as completed</button>
                       <?php endif; ?>
          </td>
                    <td><?php 
                        $userdata = $this->common_model->GetSingleData('users',array('id'=>$value['user_id']));
                        echo "<b>Name</b>: ".$userdata['first_name']."".$userdata['last_name'];echo "<br>";
                        echo "<b>Email</b>: ".$userdata['email'];

                    ?></td>
                     <td><?php 
                      $seller = $this->common_model->GetSingleData('users',array('id'=>$value['seller_id']));
                        echo "<b>Name</b>: ".$seller['first_name']."".$seller['last_name'];echo "<br>";
                         echo "<b>Email</b>: ".$seller['email'];

                    ?></td>
                    <td><?= date('d F Y h:i A', strtotime($value['created_at'])) ?></td>
                    <td><?php 
                    $product = $this->common_model->GetSingleData('product',array('id'=>$value['product_id']));
                        echo "<a href='". get_product_url($product) ."' target='_blank'>".$product['title']."</a>";
                    ?></td>
                   <td >
                              <ul>
                                <li style="white-space: nowrap;"><b>Playable : </b> <?= ($value['is_new'] == 1) ? '<i class="fa fa-check text-success" ></i>' : '<i class="fa fa-times text-danger" ></i>' ?></li>
                                <li style="white-space: nowrap;"><b>In Original Box : </b> <?= ($value['in_original_box'] == 1) ? '<i class="fa fa-check text-success" ></i>' : '<i class="fa fa-times text-danger" ></i>' ?></li>
                                <li style="white-space: nowrap;"><b>  Verified Authentic : </b> <?= ($value['verified_authentic'] == 1) ? '<i class="fa fa-check text-success" ></i>' : '<i class="fa fa-times text-danger" ></i>' ?></li>
                              </ul>
                            </td>
                    <td><?php 
                        echo "HKD".$value['grand_total'];
                       
                    ?></td>
                     <!-- <td><span class='badge badge-warning'>Progress</span></td> -->
                     
                     <td>
                     <?php if($value['admin_status'] == 0): ?>
                      <span Class='badge badge-danger'>Pending from admin side</span>
                       <?php else: ?>
                        <span Class='badge badge-success'>Completed</span>
                       <?php endif; ?>
                    </td>
                    
                      
                   <td>
                       <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myviewModal<?= $value['id']; ?>">Shipping Details</button>
                      
                    </td>
                    <td style="white-space:nowrap;">
                            <ul>
                              <li>Address : <?= $value['address']; ?> <?= $value['address2']; ?></li>
                              <li>Country : <?= $value['country']; ?> </li>
                              <li>State : <?= $value['state']; ?> </li>
                              <li>City : <?= $value['city']; ?> </li>
                            </ul>
                              
                            </td>
                            <td><?php 
                        echo "<b>Amount</b>: HKD".$value['grand_total'];echo "<br>";
                        echo "<b>Payment Method</b>: ".$value['payment_method'];echo "<br>";
                        echo "<b>Payment Id</b>: ".$value['payment_id'];echo "<br>";
                    ?></td>
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

<script>




function delete_product(id) {
        // event.preventDefault();
    if(confirm('Are you sure ?'))
    {
        $.ajax({
      url: '<?= base_url() ?>/Admin/Sell_Product/delete_sellproduct',
      type: 'POST',
      cache:false,
      data:{'id':id},
      dataType: 'json',
      beforeSend: function() {
        $('#delete_btns'+id).prop('disabled' , true);
        $('#delete_btns'+id).text('Processing..');
      },
      success : function(res){
        console.log(res);
        $('#delete_btns'+id).prop('disabled' , false);
        if (res.status == 1) {
           Swal.fire({
               title: "Success", 
               text: res.message, 
               icon: "success"
             }).then(function (result) {
            location.reload();
            })
        }
        
      }
    });
    }
    
}

function delete_product_image(id) {
        // event.preventDefault();
    if(confirm('Are you sure ?'))
    {
     $.ajax({
      url: '<?= base_url() ?>/Admin/Product/remove_pimage',
      type: 'POST',
      cache:false,
      data:{'id':id},
      dataType: 'json',
      beforeSend: function() {
        $('#delete_btns'+id).prop('disabled' , true);
        $('#delete_btns'+id).text('Processing..');
      },
      success : function(res){
        console.log(res);
        $('#delete_btns'+id).prop('disabled' , false);
        if (res.status == 1) {
         
         //location.reload();

        }
        
      }
    });
    }
    
}

</script>

<script>
$(document).ready(function() {
  //alert('hello');
  $('#category').on('change', function() {
      var category_id = this.value;
      $.ajax({
        url: '<?= base_url() ?>/Admin/Product/getsubcat',
        type: "POST",
        data: {
          category_id: category_id
        },
        cache: false,
        success: function(dataResult){
          $("#sub_category").html(dataResult);
        }
      });
    
    
  });
});
</script>

<script>
function fetchsubcat(id)
{
  //alert('hello');
  //alert(id)
  var category_id = id;
      $.ajax({
        url: '<?= base_url() ?>/Admin/Product/getsubcat',
        type: "POST",
        data: {
          category_id: category_id
        },
        cache: false,
        success: function(dataResult){
          $("#editsub_category").html(dataResult);
        }
      });
    
}
$('.confirm-btn').on('click', function(e) {
  e.preventDefault();

  var id = $(this).data('id');

  Swal.fire({
    title: 'Are you sure?',
    text: "This action cannot be undone!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, do it!'
  }).then((result) => {
    if (result.isConfirmed) {
      // Call the Ajax function to delete the record
      $.ajax({
      url: '<?= base_url() ?>/Admin/Product/confirm_order',
      type: 'POST',
      cache:false,
      data:{'id':id},
      dataType: 'json',
      beforeSend: function() {
        $('#confirm_btns'+id).prop('disabled' , true);
        $('#confirm_btns'+id).text('Processing..');
      },
      success : function(res){
        console.log(res);
        $('#confirm_btns'+id).prop('disabled' , false);
        $('#confirm_btns'+id).text('Mark order as completed');
        if (res.status == 1) {
         
         location.reload();

        }
        
      }
    });
    }
  })
});

</script>
