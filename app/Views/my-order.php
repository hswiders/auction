<?php include ('include/header.php') ?> 
<div class="account-page">
	<div class="row">
		<div class="col-sm-3">
			<?php include ('include/sidebar.php') ?> 
		</div>
		<div class="col-sm-9">
			<div class="right-side">
				<div class="rightjhead">
					<h1>My Sales Order List</h1>
 				</div>
				<div class="infoaccount">
					<div class="row">
						<?= $this->session->getFlashdata('msg'); ?>
							<div class="table-responsive">

									<table class="table table-bordered" id="example3">
									      <thead>
									        <tr>
									            <th>S. No.</th>
			                                    <th>User Detail</th>
			                                    <th>Product</th>
			                                    <!-- <th>Seller Details</th> -->
			                                    <th>Payment Details</th>
			                                    <th>Status</th>
			                                    <th>Action</th>
									        </tr>
									      </thead>
			      						<tbody>
			      							<?php
			      							$x = 1;
			      								if ($order) {
			      									foreach ($order as $key => $value) {
			      										$grand_total = convert_currency($value['grand_total'], $this->currency , 'HKD');
                  $admin_fee = convert_currency($value['admin_fee'], $this->currency , 'HKD');
 				      									?>
			      								<tr>
			      									<td><?= $x; ?></td>
				                                    <td><?php 
				                                        $userdata = $this->common_model->GetSingleData('users',array('id'=>$value['user_id']));
				                                        echo "<b>Name</b>: ".$userdata['first_name']."".$userdata['last_name'];echo "<br>";
				                                        echo "<b>Email</b>: ".$userdata['email'];

				                                    ?></td>
				                                    <td><?php 
				                                    $product = $this->common_model->GetSingleData('product',array('id'=>$value['product_id']));
				                                        echo "<a href='". get_product_url($product) ."' target='_blank'>".$product['title']."</a>";
				                                    ?></td>
				                                    <!-- <td><?php 
				                                      $seller = $this->common_model->GetSingleData('users',array('id'=>$value['seller_id']));
				                                        echo "<b>Name</b>: ".$seller['first_name']."".$seller['last_name'];echo "<br>";
				                                         echo "<b>Email</b>: ".$seller['email'];

				                                    ?></td> -->
				                                    <td><?php 
				                                        echo "<b>Amount</b>: ".$this->currency.$grand_total;echo "<br>";
				                                        echo "<b>Payment Method</b>: ".$value['payment_method'];echo "<br>";
				                                        echo "<b>Payment Id</b>: ".$value['payment_id'];echo "<br>";
				                                    ?></td>
				                                    <td><?php
				                                        if($value['status'] == 0){
				                                            echo "<span class='badge badge-warning'>Pending</span>";
				                                        }elseif($value['status'] == 1){
				                                            echo "<span class='badge badge-success'>Delivered</span>";
				                                        }else{
				                                            echo "<span class='badge badge-danger'>Cancelled</span>";
				                                        }
				                                    ?></td>
				                                   
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
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php include ('include/footer.php') ?>
<script type="text/javascript">
 
</script>