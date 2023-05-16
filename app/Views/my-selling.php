<?php include ('include/header.php');



$this->user_id =  $this->session->get('user_id');

 ?> 



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

					<h1>My Sell List</h1>

 				</div>

				<div class="infoaccount">

					<div class="row">

						<?= $this->session->getFlashdata('msg'); 

						//print_r($product); ?>

<div class="tab">

  <button class="tablinks" onclick="openorder(event, 'active')" id="defaultOpen">Active</button>

  <button class="tablinks" onclick="openorder(event, 'completed')">Completed</button>

  <!-- <button class="tablinks" onclick="openorder(event, 'completed')">Completed</button> -->

  <button class="tablinks" onclick="openorder(event, 'expire')">Expired</button>

</div>

				<div class="table-responsive tabcontent" id="active">



						<table class="table table-bordered example3">

						      <thead>

							        <tr>

							          <th>Product</th>

							          <th>Product name</th>


							          <th>Payment details</th>

							          <th>Status</th>

							          <th>Expire (Days)</th>

							          <!-- <th>Status</th> -->

							          <th>Action</th>

							        </tr>

						      </thead>

								<tbody>

									<?php 

									$x = 1;

										if ($active_product) {

											foreach ($active_product as $key => $value) {
												$asked_price = convert_currency($value["price"] , $this->currency , 'HKD');
												$total_recv = convert_currency($value["dis_price"] , $this->currency , 'HKD');
												$admin_fee = $asked_price - $total_recv;
		      									?>

										<tr>

											<td><img src="<?= get_product_img_url($value) ?>" width="100" class="img-thumbnail"></td>

											<td><?= "<a href='". get_product_sell_url($value) ."' target='_blank'>".$value['title']."</a>"; ?></td>

										

											<td>
												 <?php 
                        echo "<b>Asked price</b>: ".$this->currency.$asked_price;echo "<br>";
                        echo "<b>Admin Fee</b>: ".$this->currency.$admin_fee;echo "<br>";
                        echo "<b>Total Recieve</b>: ".$this->currency.$total_recv;echo "<br>";
                    ?>
											
													
												</td>

											<td><span Class='badge badge-info'>Active</span></td>

											<td><?= get_expired_days($value['exp_date']); ?></td>

											<!-- <td><?php  

												if($value["status"] == 1){

													echo "<span Class='badge badge-primary'>Ask Price</span>";

												}else{

													echo "<span Class='badge badge-success'>Sell Now</span>";

												}

											?></td> -->

											<td>

											<?php 

											  if($value["sold_status"] == 0){

											?>

												<a class="btn btn-sm btn-primary" href="<?= base_url('edit-my-sell/'.$value["id"].'') ?>"><i class="fa fa-edit" aria-hidden="true"></i></a>

												<a class="btn btn-sm btn-danger" href="<?= base_url('Product/removeSelling/'.$value["id"].'') ?>" onclick="return confirm('Are you sure?')"><i class="fa fa-trash" aria-hidden="true"></i></a>

											<?php

											}

											  ?>

											<a class="btn btn-sm btn-info" href="<?= base_url('my-sell-detail/'.$value["id"]) ?>"><i class="fa fa-eye" aria-hidden="true"></i></a>

												

											</td>

										</tr>			      									

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

				          <th>Sl. No.</th>

				          <th>Product</th>

				          <th>Date of sold</th>

				          <th>Payment Details</th>

				          <th>Bid Status</th>

				          

				          <th>Action</th>

				        </tr>

			      </thead>

					<tbody>

						<?php 

						$x = 1;

							if ($progress_product) {

								//print_r($progress_product);

								 

								foreach ($progress_product as $key => $value) { 

									

							     $progress_data = $this->common_model->GetSingleData('orders',array('seller_id'=>$this->user_id ,'sell_product_id'=>$value['sell_id'],'status'=>0));

							     //print_r(  $progress_data);

							     if(empty($progress_data))

							     {

							     	continue;

							     }

								?>

							<tr>

								<td><?= $x; ?></td>

								<td><?php 

                               $product = $this->common_model->GetSingleData('product',array('id'=>$progress_data['product_id']));

                               echo "<a href='". get_product_sell_url($product) ."' target='_blank'>".$product['title']."</a>";

                               ?></td>

								<td><?= date('d F Y h:i A' , strtotime($progress_data['created_at'])) ?></td>

								<td><?php 

			                        echo "<b>Bid Approved Amount</b>: ".$this->currency ?><?= convert_currency($progress_data["grand_total"] , $this->currency , 'HKD');echo "<br>";

			                        echo "<b>You will Recieve</b>: ".$value['dis_price'];echo "<br>";

			                        echo "<b>Payment Id</b>: ".$progress_data['payment_id'];echo "<br>";
			                        

			                    ?></td>

								<!-- <td><span Class='badge badge-warning'>Progress</span></td> -->

								<td><span Class='badge badge-success'>Completed</span></td>

								<td>

								 <a class="btn btn-sm btn-info" href="<?= base_url('my-sell-detail/'.$value["id"]) ?>"><i class="fa fa-eye" aria-hidden="true"></i></a>&nbsp;

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

                  <div class="col-md-8"><b><?= $progress_data['f_name']." ".$progress_data['l_name']; ?></b></div>

            </div>

            <hr>



              <div class="row">

                    <div class="col-md-4">Country</div>

                    <div class="col-md-8"><b><?= $progress_data['country']; ?></b></div>

               </div>

              <hr>



              <div class="row">

                    <div class="col-md-4">City</div>

                    <div class="col-md-8"><b><?= $progress_data['city']; ?></b></div>

               </div>

              <hr>

               <div class="row">

                    <div class="col-md-4">State</div>

                    <div class="col-md-8"><b><?= $progress_data['state']; ?></b></div>

               </div>

              <hr>

               <div class="row">

                    <div class="col-md-4">Address 1</div>

                    <div class="col-md-8"><b><?= $progress_data['address']; ?></b></div>

               </div>

              <hr>

              <div class="row">

                    <div class="col-md-4">Address 2</div>

                    <div class="col-md-8"><b><?= $progress_data['address2']; ?></b></div>

               </div>

              <hr>

              <div class="row">

                    <div class="col-md-4">Zipcode</div>

                    <div class="col-md-8"><b><?= $progress_data['zipcode']; ?></b></div>

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

				          <th>Product name</th>

				          <th>Date of sold</th>

				          <th>Payment Details</th>
				          <th>Order ID</th>

				          <th>Ask Status</th>
				          <th>Admin Approval Status</th>

				          <th>Action</th>

				        </tr>

			      </thead>

					<tbody>

						<?php 

						$x = 1;

							if ($complete_product) {

								//print_r($complete_product);

								 

								foreach ($complete_product as $key => $value) { 

									

							     $complete_data = $this->common_model->GetSingleData('orders',array('seller_id'=>$this->user_id ,'sell_product_id'=>$value['sell_id'],'status'=>1));
							     $product = $this->common_model->GetSingleData('product',array('id'=>$complete_data['product_id']));
							     if(empty($complete_data))

							     {

							     	continue;

							     }

								?>

							<tr>

								<td><img src="<?= get_product_img_url($product) ?>" width="100" class="img-thumbnail"></td>

								<td><?php 

                               

                               echo "<a href='". get_product_sell_url($product) ."' target='_blank'>".$product['title']."</a>";

                               ?></td>

								<td><?= date('d F Y h:i A' , strtotime($complete_data['created_at'])) ?></td>

								<td><?php 

			                        echo "<b>Bid Approved Amount</b>: ".$this->currency ?><?= convert_currency($complete_data["grand_total"] , $this->currency , 'HKD');echo "<br>";

									echo "<b>You will Recieve</b>: ".$this->currency ?><?= convert_currency($value['dis_price'] , $this->currency , 'HKD');echo "<br>";

			                        echo "<b>Method</b>: Wallet<br>";
			                        
			                    ?></td>

								<td><?= $complete_data['order_uniqueid']; ?></td>
								<td><span Class='badge badge-success'>Completed</span></td>

								<td>
									<?php if($complete_data['admin_status'] == 1 ):  ?>
										<span Class='badge badge-success'>Completed</span>
									<?php else:  ?>
										<span Class='badge badge-danger'>Pending</span>
									<?php endif;  ?>

								</td>

								<td>

								 <a class="btn btn-sm btn-info" href="<?= base_url('my-sell-detail/'.$value["id"]) ?>"><i class="fa fa-eye" aria-hidden="true"></i></a>

								   <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myviewModal<?= $value['id']; ?>">Post Details</button>

								</td>

							</tr>	



							<!-- View Modal -->

<div class="modal" id="myviewModal<?= $value['id']; ?>">

  <div class="modal-dialog">

    <div class="modal-content">



      <!-- Modal Header -->

      <div class="modal-header">

        <h4 class="modal-title">Post Details</h4>

        <button type="button" class="close" data-dismiss="modal">&times;</button>

      </div>



      <!-- Modal body -->

      <div class="modal-body">

            <div class="row">

                  <div class="col-md-4">Name</div>

                  <div class="col-md-8"><b>Gamex</b></div>

            </div>

            <hr>

               <div class="row">

                    <div class="col-md-4">Address </div>

                    <div class="col-md-8"><b><?= get_admin()['address']; ?></b></div>

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

				          <th>Product name</th>

				         

				          <th>Trade Details</th>

				          <th>Status</th>

				          <th>Expired Date</th>

				          <!-- <th>Action</th> -->

				        </tr>

			      </thead>

					<tbody>

						<?php 

						$x = 1;

							if ($expire_product) {

								foreach ($expire_product as $key => $value) {
									$asked_price = convert_currency($value["price"] , $this->currency , 'HKD');
												$total_recv = convert_currency($value["dis_price"] , $this->currency , 'HKD');
												$admin_fee = $asked_price - $total_recv;
  									?>

							<tr>

								<td><img src="<?= get_product_img_url($value) ?>" width="100" class="img-thumbnail"></td>

								<td><?= "<a href='". get_product_sell_url($value) ."' target='_blank'>".$value['title']."</a>"; ?></td>

								

								<td><?php 

			                       
 												echo "<b>Asked price</b>: ".$this->currency.$asked_price;echo "<br>";
                        echo "<b>Admin Fee</b>: ".$this->currency.$admin_fee;echo "<br>";
                        echo "<b>Total Recieve</b>: ".$this->currency.$total_recv;echo "<br>";

			                    ?></td>

								<td><span Class='badge badge-danger'>Expired</span></td>

								<td><?= $value['exp_date'] ?></td>

								<!-- <td>

								<?php 

								  if($value["sold_status"] == 0){

								?>

									<a class="btn btn-sm btn-primary" href="<?= base_url('edit-my-sell/'.$value["id"].'') ?>"><i class="fa fa-edit" aria-hidden="true"></i></a>

									<a class="btn btn-sm btn-danger" href="<?= base_url('Product/removeSelling/'.$value["id"].'') ?>" onclick="return confirm('Are you sure?')"><i class="fa fa-trash" aria-hidden="true"></i></a>

								<?php

								}

								  ?>

								<a class="btn btn-sm btn-info" href="<?= base_url('my-sell-detail/'.$value["id"]) ?>"><i class="fa fa-eye" aria-hidden="true"></i></a>

									

								</td> -->

							</tr>			      									

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

	<?php if (isset($_GET['completed'])): ?>

		openorder('' , 'completed');


	<?php endif ?>

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



// Get the element with id="defaultOpen" and click on it

document.getElementById("defaultOpen").click();

</script>