
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
                  <th>S. No.</th>
                        <th>User Detail</th>
                        <th>Created Date & Time</th>
                        <th>Product name</th>
                        <th>Expire (Days)</th>
                        <th>Trade Details</th>
                        <th>Bid Price</th>
                        <th>Status</th>
                        
                       
                        <th>Shipping Address</th>
                        <th>Action</th>
              </tr>
            </thead>
          <tbody>
            <?php
            $x = 1;
              if ($bid_product_list) {
                foreach ($bid_product_list as $key => $value) {
                  $exp_status = get_expired_days($value['expire_date']);
                  if($exp_status == 'Expired')
                  {
                    $this->common_model->UpdateData('orders', array('id'=>$value['id']) , array('status'=>4));
                    continue;
                  }
                    ?>
              <tr>
                <td><?= $x; ?></td>
                            <td><?php 
                                $userdata = $this->common_model->GetSingleData('users',array('id'=>$value['user_id']));
                                echo "<b>Name</b>: ".$userdata['first_name']."".$userdata['last_name'];echo "<br>";
                                echo "<b>Email</b>: ".$userdata['email'];

                            ?></td> 
                            <td><?= date('d F Y h:i A', strtotime($value['created_at'])) ?></td>
                            <td><?php 
                            $product = $this->common_model->GetSingleData('product',array('id'=>$value['product_id']));
                                echo "<a href='". get_product_url($product) ."' target='_blank'>".$product['title']."</a>";
                            ?></td>
                             <td><?= $exp_status ?></td>
                             <td >
                              <ul>
                                <li style="white-space: nowrap;"><b>Playable : </b> <?= ($value['is_new'] == 1) ? '<i class="fa fa-check text-success" ></i>' : '<i class="fa fa-times text-danger" ></i>' ?></li>
                                <li style="white-space: nowrap;"><b>In Original Box : </b> <?= ($value['in_original_box'] == 1) ? '<i class="fa fa-check text-success" ></i>' : '<i class="fa fa-times text-danger" ></i>' ?></li>
                                <li style="white-space: nowrap;"><b>  Verified Authentic : </b> <?= ($value['verified_authentic'] == 1) ? '<i class="fa fa-check text-success" ></i>' : '<i class="fa fa-times text-danger" ></i>' ?></li>
                              </ul>
                            </td>
                            <td><?php 
                                echo "<b>Amount</b>: HKD".$value['grand_total'];echo "<br>";
                            ?></td>
                            <td><span class='badge badge-info'>Active</span></td>
                           
                            
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
                               <a href="javascript:;" onclick="delete_bid(1 , <?= $value['id'] ?>)" class="btn btn-danger btn-sm" > <i class="fa fa-trash"></i> </a>
                            </td>
              </tr>
<!-- View Modal -->
<?=  view('admin/modals/shipping_modal' , ['ship' => $value]); ?>
<!-- View Modal -->
<!-- reject Modal -->
<div class="modal" id="delete_bid_modal<?= $value['id']; ?>">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Delete BID</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
        
            <div class="col-md-12 py-3">
                <div>
                    <label>Reason</label>
                    <textarea class="form-control" id="delete_bid_reason<?= $value['id']; ?>" required></textarea>
                    
                </div>
               
                <div class="mt-3 text-center">
                    <button type="button" id="add_btn<?= $value['id'] ?>" onclick="delete_bid(0 , <?= $value['id'] ?>)"  class="btn btn-danger">Delete</button>
                </div>
                
            </div>
    
    

    </div>
  </div>
</div>
<!-- reject Modal -->
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
  
</script>
<script type="text/javascript">
  function delete_bid (show_modal , id) 
  {
    if(show_modal == 1)
    {
      $('#delete_bid_modal'+id).modal('show');
      return false;
      
    }
    reason = $('#delete_bid_reason'+id).val();
   // alert(reason);

    if(reason.trim() == '')
    {
      alert('reason can not be empty');
      return false;
    }

    Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
      if (result.isConfirmed) {
        $('#delete_bid_modal'+id).modal('hide');
        form_data = new FormData();
        form_data.append('order_id' , id);
        form_data.append('reason' , reason);
        $.ajax({
        url: "<?php echo base_url(); ?>/Shop/delete_bid",
        type:"POST",
        cache:false,
        contentType: false,
        processData: false,
        data:form_data,
        dataType:'json',
        success:function(data) {
          if (data.status == 1) {
            Swal.fire(
              'Deleted!',
              'Your Bid has been deleted.',
              'success'
            )
            location.reload()
          } 
          else 
          {
           Swal.fire(
              'Something Wrong',
               data.message,
              'error'
            )
          }
        }
      });
        
      }
  })
  
 }
</script>