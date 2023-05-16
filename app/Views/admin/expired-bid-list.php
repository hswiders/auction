
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
                            <th>Expired Date</th>
                            <th>Product name</th>
                            <th>Trade details</th>
                            <th>Bid Price</th>
                            <th>Status</th>
                            <th>Action</th>
                      </tr>
                    </thead>
                  <tbody>
                <?php
                $x = 1;
                  if ($bid_product_list) {
                    foreach ($bid_product_list as $key => $value) {
                      
                        ?>
                  <tr>
                    <td><?= $x; ?></td>
                     <td><?php 
                        $userdata = $this->common_model->GetSingleData('users',array('id'=>$value['user_id']));
                        echo "<b>Name</b>: ".$userdata['first_name']."".$userdata['last_name'];echo "<br>";
                        echo "<b>Email</b>: ".$userdata['email'];

                    ?></td> 
                    <td><?= date('Y-m-d h:i A' , strtotime($value['expire_date'])) ?></td>
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
                        echo "<b>Amount</b>: HKD".$value['grand_total'];echo "<br>";
                    ?></td>
                    <td><span class='badge badge-danger'>Expired</span></td>
                   
                   <td>
                   
                       <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myviewModal<?= $value['id']; ?>">View</button>
                    </td>
          </tr>
<!-- View Modal -->
<div class="modal" id="myviewModal<?= $value['id']; ?>">
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
                  <div class="col-md-4">Name</div>
                  <div class="col-md-8"><b><?= $value['f_name']." ".$value['l_name']; ?></b></div>
            </div>
            <hr>

              <div class="row">
                    <div class="col-md-4">Country</div>
                    <div class="col-md-8"><b><?= $value['country']; ?></b></div>
               </div>
              <hr>

              <div class="row">
                    <div class="col-md-4">City</div>
                    <div class="col-md-8"><b><?= $value['city']; ?></b></div>
               </div>
              <hr>
               <div class="row">
                    <div class="col-md-4">State</div>
                    <div class="col-md-8"><b><?= $value['state']; ?></b></div>
               </div>
              <hr>
               <div class="row">
                    <div class="col-md-4">Address 1</div>
                    <div class="col-md-8"><b><?= $value['address']; ?></b></div>
               </div>
              <hr>
              <div class="row">
                    <div class="col-md-4">Address 2</div>
                    <div class="col-md-8"><b><?= $value['address2']; ?></b></div>
               </div>
              <hr>
              <div class="row">
                    <div class="col-md-4">Zipcode</div>
                    <div class="col-md-8"><b><?= $value['zipcode']; ?></b></div>
               </div>
              
          </div>
    
      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
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
  
</script>
