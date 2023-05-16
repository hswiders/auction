<?php include ('include/header.php') ?> 

<style>

/* Style the tab */
.tab {
  overflow: hidden;
  border: 1px solid #ccc;
  background-color: #f1f1f1;
}

/* Style the buttons inside the tab */
.tab button {
  background-color: inherit;
  float: left;
  border: none;
  outline: none;
  cursor: pointer;
  padding: 14px 16px;
  transition: 0.3s;
  font-size: 17px;
}

/* Change background color of buttons on hover */
.tab button:hover {
  background-color: #ddd;
}

/* Create an active/current tablink class */
.tab button.active {
  background-color: #ccc;
}

/* Style the tab content */
.tabcontent {
  display: none;
  padding: 6px 12px;
  border: 1px solid #ccc;
  border-top: none;
}
</style>

<div class="account-page">
	<div class="row">
		<div class="col-sm-3">
			<?php include ('include/sidebar.php') ?> 
		</div>
		<div class="col-sm-9">
			<div class="right-side">
				<div class="rightjhead">
					<h1>My Buying Order List</h1>
 				</div>

		      <div class="infoaccount">
					<div class="row">
						<?= $this->session->getFlashdata('msg'); ?>
<div class="tab">
  <button class="tablinks" onclick="openorder(event, 'active')" id="defaultOpen">Active</button>
  <button class="tablinks" id="completeOpen" onclick="openorder(event, 'completed')">Completed</button>
 <!--  <button class="tablinks" onclick="openorder(event, 'completed')">Completed</button> -->
  <button class="tablinks" onclick="openorder(event, 'expire')">Expired</button>
</div>
    <div class="table-responsive tabcontent" id="active">

	   <table class="table table-bordered example3">
	      <thead>
			        <tr>
			            <th>Product</th>
                        <!-- <th>User Detail</th> -->
                        <th>Product Name</th>
                        <th>Trade Details</th>
                        <th> Status</th>
                        <th>Expire (Days)</th>
                        <th>Action</th>
			        </tr>
			      </thead>
					<tbody>
						<?php
						$x = 1;
							if ($active_order) {
								foreach ($active_order as $key => $value) {
                  $grand_total = convert_currency($value['grand_total'], $this->currency , 'HKD');
                  $admin_fee = convert_currency($value['admin_fee'], $this->currency , 'HKD');
                  $product = $this->common_model->GetSingleData('product',array('id'=>$value['product_id']));
  									?>
							         <tr>
								           <td><img src="<?= get_product_img_url($product) ?>" width="100" class="img-thumbnail"></td>
                            <!-- <td><?php 
                                $userdata = $this->common_model->GetSingleData('users',array('id'=>$value['user_id']));
                                echo "<b>Name</b>: ".$userdata['first_name']."".$userdata['last_name'];echo "<br>";
                                echo "<b>Email</b>: ".$userdata['email'];
                            ?></td>  -->
                            <td><?php 
                            
                                echo "<a href='". get_product_url($product) ."' target='_blank'>".$product['title']."</a>";
                            ?></td>
                            <td><?php 
                                echo "<b>Bid Amount</b>: ".$this->currency.$grand_total;echo "<br>";
                                echo "<b>Admin Fee</b>: ".$this->currency.$admin_fee;echo "<br>";
                                  $total = $grand_total+$admin_fee;
                                echo "<b>Total Amount</b>: ".$this->currency. $total;echo "<br>";
                            ?></td>
                            <td><span class='badge badge-info'>Active</span></td>
                            <td><?= get_expired_days($value['expire_date']); ?></td>
                           <td>
                               <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myviewModal<?= $value['id']; ?>"><i class="fa fa-eye"></i></button>

                               <a href="<?= base_url('edit-bid').'/'.slugify($product['title']).'-'.$product['id'] ; ?>" class="btn btn-primary btn-sm" > <i class="fa fa-pencil"></i> </a>
                               <a href="javascript:;" onclick="delete_bid(<?= $value['id'] ?>)" class="btn btn-danger btn-sm" > <i class="fa fa-trash"></i> </a>
                               
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
<!-- my code -->

<div class="table-responsive tabcontent" id="progress">

<table class="table table-bordered example3">
  <thead>
	        <tr>
	            <th>Image</th>
                <!-- <th>User Detail</th> -->
                <th>Product</th>
                <th>Seller Details</th>
                <th>Payment Details</th>
                
                <th>Bid Status</th>
                <th>Action</th>
	        </tr>
	      </thead>
			<tbody>
				<?php
				$x = 1;
					if ($progress_order) {
						foreach ($progress_order as $key => $value) {
                 $grand_total = convert_currency($value['grand_total'], $this->currency , 'HKD');
                  $admin_fee = convert_currency($value['admin_fee'], $this->currency , 'HKD');
                  $product = $this->common_model->GetSingleData('product',array('id'=>$value['product_id']));
								?>
					<tr>
						<td><img src="<?= get_product_img_url($product) ?>" width="100" class="img-thumbnail"></td>
                    <!-- <td><?php 
                        $userdata = $this->common_model->GetSingleData('users',array('id'=>$value['user_id']));
                        echo "<b>Name</b>: ".$userdata['first_name']."".$userdata['last_name'];echo "<br>";
                        echo "<b>Email</b>: ".$userdata['email'];

                    ?></td> -->
                    <td><?php 
                    
                        echo "<a href='". get_product_url($product) ."' target='_blank'>".$product['title']."</a>";
                    ?></td>
                    <td><?php 
                      $seller = $this->common_model->GetSingleData('users',array('id'=>$value['seller_id']));
                        echo "<b>Name</b>: ".$seller['first_name']."".$seller['last_name'];echo "<br>";
                         echo "<b>Email</b>: ".$seller['email'];

                    ?></td>
                    <td><?php 
                        echo "<b>Amount</b>: ".$this->currency.$grand_total;echo "<br>";
                        echo "<b>Payment Method</b>: ".$value['payment_method'];echo "<br>";
                        echo "<b>Payment Id</b>: ".$value['payment_id'];echo "<br>";
                    ?></td>
                     <!-- <td><?= date('d M Y h:i A') ?></td> -->
                     <td><span Class='badge badge-success'>Completed</span></td>
                   
                   <td>
                       <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myviewModal<?= $value['id']; ?>">Shipping Details</button>
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


<!-- my code -->


<!-- my code -->

<div class="table-responsive tabcontent" id="completed">

<table class="table table-bordered example3">
  <thead>
	        <tr>
	            <th>Product</th>
                <!-- <th>User Detail</th> -->
                <th>Product name</th>
                <th>Date of purchase</th>
                <th>Payment Details</th>
                <th>Order Id</th>
                <th> Status</th>
                <th>Action</th>
	        </tr>
	      </thead>
			<tbody>
				<?php
				$x = 1;

					if ($complete_order) {
						foreach ($complete_order as $key => $value) {
              $grand_total = convert_currency($value['grand_total'], $this->currency , 'HKD');
                  $admin_fee = convert_currency($value['admin_fee'], $this->currency , 'HKD');
                  $product = $this->common_model->GetSingleData('product',array('id'=>$value['product_id']));
								?>
					<tr>
						<td><img src="<?= get_product_img_url($product) ?>" width="100" class="img-thumbnail"></td>
                    <!-- <td><?php 
                        $userdata = $this->common_model->GetSingleData('users',array('id'=>$value['user_id']));
                        echo "<b>Name</b>: ".$userdata['first_name']."".$userdata['last_name'];echo "<br>";
                        echo "<b>Email</b>: ".$userdata['email'];

                    ?></td> -->
                    <td><?php 
                    
                        echo "<a href='". get_product_url($product) ."' target='_blank'>".$product['title']."</a>";
                    ?></td>
                    <td>Date : <?= date('d F , Y h:i A' , strtotime($value['updated_at'])) ?></td>
                    <td><?php 
                        echo "<b>Amount</b>: ".$this->currency.$grand_total;echo "<br>";
                        echo "<b>Payment Method</b>: ".$value['payment_method'];echo "<br>";
                        echo "<b>Payment Id</b>: ".$value['payment_id'];echo "<br>";
                        
                    ?></td>
                    <td><?php echo "<b>Order Id</b>: <a target='_blank' href='".base_url('order-details/'.$value['id'])."'>".$value['order_uniqueid'];echo "</a><br>"; ?></td>
                    <td><span class='badge badge-success'>Completed</span></td>
                   
                   <td>
                       <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myviewModal<?= $value['id']; ?>">Shipping Details</button>
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


<!-- my code -->

<!-- my code -->

<div class="table-responsive tabcontent" id="expire">

<table class="table table-bordered example3">
  <thead>
	        <tr>
	            <th>Product</th>
                <!-- <th>User Detail</th> -->
                <th>Product name</th>
                <th>Payment Details</th>
                <th> Status</th>
                <th>Expired Date</th>
	        </tr>
	      </thead>
			<tbody>
				<?php
				$x = 1;
					if ($expire_order) {
						foreach ($expire_order as $key => $value) {
              $grand_total = convert_currency($value['grand_total'], $this->currency , 'HKD');
                  $admin_fee = convert_currency($value['admin_fee'], $this->currency , 'HKD');
                  $product = $this->common_model->GetSingleData('product',array('id'=>$value['product_id']));
								?>
					<tr>
						<td><img src="<?= get_product_img_url($product) ?>" width="100" class="img-thumbnail"></td>
                    <!-- <td><?php 
                        $userdata = $this->common_model->GetSingleData('users',array('id'=>$value['user_id']));
                        echo "<b>Name</b>: ".$userdata['first_name']."".$userdata['last_name'];echo "<br>";
                        echo "<b>Email</b>: ".$userdata['email'];

                    ?></td> -->
                    <td><?php 
                   
                        echo "<a href='". get_product_url($product) ."' target='_blank'>".$product['title']."</a>";
                    ?></td>
                    
                    <td><?php 
                        echo "<b>Bid Amount</b>: ".$this->currency.$grand_total;echo "<br>";
                        echo "<b>Admin Fee</b>: ".$this->currency.$admin_fee;echo "<br>";
                        $total1 = $grand_total+$admin_fee;
                        echo "<b>Total Amount</b>: $".$total1;echo "<br>";
                    ?></td>
                    <td><span class='badge badge-danger'>Expired</span></td>
                   
                   <td>
                       <?= $value['expire_date'] ?>
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


<!-- my code -->


					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php include ('include/footer.php') ?>
<script>
function openorder(evt, cityName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}
<?php if (@$_GET['type'] == 'completed'): ?>
  $(document).ready(function() {
    $('#completeOpen').trigger('click')
  });
  
<?php endif ?>
// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();
</script>
<script type="text/javascript">
  function delete_bid (id) {
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
        form_data = new FormData();
        form_data.append('order_id' , id)
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