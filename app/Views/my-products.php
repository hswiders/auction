<?php include ('include/header.php') ?> 
<div class="account-page">
	<div class="row">
		<div class="col-sm-3">
			<?php include ('include/sidebar.php') ?> 
		</div>
		<div class="col-sm-9">
			<div class="right-side">
				<div class="rightjhead">
					<h1>My Product List</h1>
 				</div>
				<div class="infoaccount">
					<div class="row">
						<?= $this->session->getFlashdata('msg'); ?>
							<div class="table-responsive">

									<table class="table table-bordered">
									      <thead>
										        <tr>
										        	<th>Sl. No.</th>
										          <th>Title</th>
										          <th>Description</th>
										          <th>Base Price</th>
										          <th>Action</th>
										        </tr>
									      </thead>
			      						<tbody>
			      							<?php
			      							$x = 1;
			      								if ($product) {
			      									foreach ($product as $key => $value) {
 				      									?>
			      								<tr>
			      									<td><?= $x; ?></td>
			      									<td><?= $value["title"]; ?></td>
			      									<td><?= $value["description"]; ?></td>
			      									<td>HKD<?= $value["base_price"]; ?></td>
			      									<td>
			      										<a class="btn btn-sm btn-info" href="<?= base_url('product-detail/'.$value["id"]) ?>"><i class="fa fa-eye" aria-hidden="true"></i></a>
			      										<a class="btn btn-sm btn-primary" href="<?= base_url('edit-product/'.$value["id"].'') ?>"><i class="fa fa-edit" aria-hidden="true"></i></a>
			      										<a class="btn btn-sm btn-danger" href="<?= base_url('Product/removeProduct/'.$value["id"].'') ?>" onclick="return confirm('Are you sure?')"><i class="fa fa-trash" aria-hidden="true"></i></a>
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
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php include ('include/footer.php') ?>
<script type="text/javascript">
 
</script>