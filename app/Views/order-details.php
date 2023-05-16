<?php include ('include/header.php') ?>
<style type="text/css">
</style>
<?php 
$grand_total = convert_currency($order['grand_total'], $this->currency , 'HKD');
$trans_fee = convert_currency($order['trans_fee'], $this->currency , 'HKD');
$shipping_fee = convert_currency($order['shipping_fee'], $this->currency , 'HKD');
$total = $grand_total+$trans_fee+$shipping_fee;
?>

<div class="middle detail-page">
  <div class="row">
    <div class="col-sm-12"> 
		<div class="container">
			<?= $this->session->getFlashdata('success_msg') ?>
			<div class="order-success">
				<div class="set-mobie-1">
					<table style="width:100%; border:0px">
						<tbody style="border:0px">
							<tr style="border:0px">
								<td style="border:0px"><h2>Order Details</h2></td>
								<td style="border:0px; text-align:right"><h5 class="text-right" style="text-align: right;"><span>#<?= $order['order_uniqueid'] ?></span></h5>
								<address>
									
									<p><b> Order Date</b>
										<span>
											<?= date('M d, Y', strtotime($order['created_at'])) ?>
										</span><br>
										
										
									</p>
								</address>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<hr>
					<div class="col-lg-7 mx-auto">
						
						<div class="row ${1| ,row-cols-2,row-cols-3, auto,justify-content-md-center,|}">
						<?php 

$product = $this->common_model->GetSingleData('product' , array('id' => $order['product_id']));
$product_images = $this->common_model->GetSingleData('product_image' , array('product_id' => $order['product_id']));
$seller = $this->common_model->GetSingleData('users' , array('id' => $order['seller_id']));
 ?>
							<div class="col">
								Product name 
							</div>
							<div class="col">
							<a href="<?= get_product_url($product) ?>">
																			<b><?= $product['title'] ?></b>
																			
																		</a>
							</div>

						</div>
						<hr>
						<div class="row ${1| ,row-cols-2,row-cols-3, auto,justify-content-md-center,|}">
							<div class="col">
								Your Purchase Price : 
							</div>
							<div class="col">
							<?= $this->currency.$grand_total ?>
							</div>

						</div>
						<hr>
						<div class="row ${1| ,row-cols-2,row-cols-3, auto,justify-content-md-center,|}">
							<div class="col">
								Processing Fee : 
							</div>
							<div class="col">
							<?= $this->currency.$trans_fee ?>
							</div>
						</div>
						<hr>
						<div class="row ${1| ,row-cols-2,row-cols-3, auto,justify-content-md-center,|}">
							<div class="col">
								Shipping Fee : 
							</div>
							<div class="col">
							<?= $this->currency.$shipping_fee ?>
							</div>
						</div>
						<hr>
						<div class="row ${1| ,row-cols-2,row-cols-3, auto,justify-content-md-center,|}">
							<div class="col">
								Total : 
							</div>
							<div class="col">
							<?= $this->currency.$total ?>
							</div>
						</div>
						<hr>
						<address>
											<div class="hdr">Shipping Address</div>
											<p><?= $order['f_name'] ?> <?= $order['l_name'] ?><br>
												<?= $user['email'] ?><br>
												<?= $user['phone'] ?><br>
												<?= $order['address'] ?> <?= $order['address2'] ?> <?= $order['city'] ?> <?= $order['state'] ?> <?= $order['zipcode'] ?> <br>
												<br>
											</p>
											
										</address>
					</div>

				
				</div>
			</div>
			<!-- <div class="ord-items">
				<div class="row">
					<div class="col-md-12">
						<div class="panel panel-default">
							<div class="panel-heading">
								<h4 class="panel-title" style="margin-bottom:10px;"><strong>Order summary</strong></h4>
							</div>
							<div class="panel-body">
								<?php 

								$product = $this->common_model->GetSingleData('product' , array('id' => $order['product_id']));
								$product_images = $this->common_model->GetSingleData('product_image' , array('product_id' => $order['product_id']));
								$seller = $this->common_model->GetSingleData('users' , array('id' => $order['seller_id']));
								 ?>
								<div class="table-responsive">
									<table class="table table-condensed" style="background:#fff;">
										<thead>
											<tr>
												<td><strong>Item</strong></td>
												<td><strong>Price ($)</strong></td>
												<td><strong>Status</strong></td>
												
												
											</tr>
										</thead>
										<tbody>
											<tr>
												<td class="row" style="vertical-align: middle;">
													<table style="border:0px;">
														<tbody style="border:0px;">
															<tr style="border:0px;">
																<td style="width:80px;border:0px;">
																	<div class="img">
																		<img src="<?= base_url($product_images['image']) ?>" width="75" style="height: 75px; width: 75px;">
																	</div>
																	
																</td>
																<td style="border:0px;">
																	<div class="">
																		<a href="<?= get_product_url($product) ?>">
																			<b><?= $product['title'] ?></b>
																			
																		</a>
																		<br><span class="text-muted">Seller : <?= $seller['first_name'] ?></span>
																	</div>
																</td>
															</tr>
														</tbody>
													</table>
													
												</td>
												<td>
													$<?= $order['grand_total'] ?>
													
												</td>
												<td>
													<?php if ($order['status'] == 1): ?>
														<span class="badge bg-success">Delivered</span>
													<?php elseif ($order['status'] == 2): ?>
														<span class="badge bg-danger">Cancelled</span>
													<?php else: ?>
														<span class="badge bg-danger">Pending</span>
													<?php endif ?>
													
												</td>
												
												
												
											</tr>
										
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div> -->
		</div>
		</div>
    </div>
    </div>
</div>
<?php include ('include/footer.php') ?>