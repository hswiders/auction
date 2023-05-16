<?php include ('include/header.php') ?> 
<div class="account-page">
	<div class="row">
		<div class="col-sm-3">
			<?php include ('include/sidebar.php') ?> 
		</div>
		<div class="col-sm-9">
			<div class="right-side">
				<div class="rightjhead">
					<h1>My WishList</h1>
 				</div>
				<div class="infoaccount">
					
						<?= $this->session->getFlashdata('msg'); ?>
							<?= view('loop/product', ['products'=>$products , 'col'=>3]);  ?>
					
				</div>
			</div>
		</div>
	</div>
</div>
<?php include ('include/footer.php') ?>
<script type="text/javascript">
 
</script>