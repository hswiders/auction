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
		<div class="col-sm-9">
			<div class="right-side mb-5">
				<div class="rightjhead" style="display: block;">
					<h1 class="mb-3">"<?= $edit['first_name'] ?>" Account Settings</h1>
					<h5>Currency Info</h5>
				</div>
						
				<?php 
				$paypal_info = (array) json_decode($edit['paypal_info']); 
				$shipping_info = $this->common_model->GetSingleData('user_shipping_info' , ['user_id' => $edit['id']]);
				$seller_info = $this->common_model->GetSingleData('seller_billing_info' , ['user_id' => $edit['id']]); 

				?>
				
				  <div class="row">
						<div class="col-sm-10">
							<h6><b>Currency </b><h6><p> <?= $edit['currency'] ?></p>
						</div>
						<div class="col-sm-2">
							<a href="<?= base_url('admin/user-edit-currency/'.$edit['id']) ?>" class="btn btn-primary">Edit</a>
						</div>
					</div>
				</div>
				<div class="right-side mb-5">
					<div class="rightjhead" style="display: block;">
						
						<h5>Buying Info</h5>
					</div>
					
					
					
					<div class="row">
						<?php if ($paypal_info): ?>
						<div class="col-sm-5">
							<h6><b>Payment </b><h6><p><b> Paypal</b> for <?= $paypal_info['payer']->payer_info->email ?> <img width="50px" src="<?= base_url('assets/img/paypal_gray.png') ?>"></p>
						</div>
						<div class="col-sm-5">
							<h6><b>Billing info </b></h6> <p><?= $paypal_info['shipping_address']->line1 .' '.$paypal_info['shipping_address']->line2 ?></p>
						</div>
						<?php else:  ?>
							<div class="col-sm-10">
								<p>You do not have any payment information on file.</p>
							</div>
						<?php endif ?>
						
						<!-- <div class="col-sm-2">
							<a href="<?= base_url('edit-buyer-info') ?>" class="btn btn-primary">Edit</a>
						</div> -->
					</div>
				</div>
				<div class="right-side mb-5">
					<div class="rightjhead" style="display: block;">
						
						<h5>Shipping Info</h5>
					</div>
					
					<div class="row">
						<?php if ($shipping_info): ?>
						<div class="col-sm-10">
							<h6><b>Shipping </b></h6> <p><?= $shipping_info['address'] .' '.$shipping_info['address2'] ?></p>
						</div>
						<?php else:  ?>
							<div class="col-sm-10">
								<p>You do not have any shipping information on file.</p>
							</div>
						<?php endif ?>
						
						<div class="col-sm-2">
							<a href="<?= base_url('admin/user-edit-shipping/'.$edit['id']) ?>" class="btn btn-primary">Edit</a>
						</div>
					</div>
				</div>
				<div class="right-side mb-5">
					<div class="rightjhead" style="display: block;">
						
						<h5>Seller Info</h5>
					</div>
					
					<div class="row">
						<?php if ($seller_info): ?>
						<div class="col-sm-5">
							<h6><b>Payment </b><h6><p><b> <?= $seller_info['card_type'] ?></b> ending <?= substr($seller_info['card_number'], -4); ?> <img width="50px" src="<?= base_url('assets/img/'.strtolower($seller_info['card_type']) .'.png') ?>"> <br> exp <?= $seller_info['card_expire'] ?></p>
						</div>
						<div class="col-sm-5">
							<h6><b>Billing info </b></h6> <p><?= $seller_info['billing_address'] .' '.$seller_info['billing_address2'] ?></p>
						</div>
						<?php else:  ?>
							<div class="col-sm-10">
								<p>You do not have any payment information on file.</p>
							</div>
						<?php endif ?>
						
						<div class="col-sm-2">
							<a href="<?= base_url('admin/user-edit-seller-info/'.$edit['id']) ?>" class="btn btn-primary">Edit</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


<?php include ('include/footer.php') ?>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
