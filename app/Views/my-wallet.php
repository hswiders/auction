<?php include ('include/header.php') ?> 
<div class="account-page">
	<div class="row">
		<div class="col-sm-3">
			<?php include ('include/sidebar.php') ?> 
		</div>
		<div class="col-sm-9">
			<div class="right-side">
				<div class="rightjhead d-flex align-items-center justify-content-between">
					<h1>Wallet Transactions</h1>
					<div>
						<span class="wallet-amount fs-2">
							Wallet Amount : <?= $this->currency.convert_currency($this->auth['wallet'], $this->currency , 'HKD'); ?>
						</span>
						<?php if (!$is_already_requested): ?>
							<?php if (!$payouts): ?>
								<a href="<?= base_url('payout-info') ?>"  class="btn btn-danger btn-block" >Withdraw amount</a>
							<?php else: ?>
								<button type="button"  class="btn btn-danger btn-block" data-toggle="modal" data-target="#withdrawModal">Withdraw amount</button>
							<?php endif; ?>
						<?php else: ?>
                            <button class="btn btn-primary" type="button" onclick="already_requested()">Withdraw amount</button>
                        <?php endif ?>
						</div>
 				</div>
				<div class="infoaccount">
					<div class="row">
					
						<?= $this->session->getFlashdata('msg'); ?>
							<div class="table-responsive">

									<table class="table table-bordered" id="example3">
									      <thead>
									        <tr>
									            <th>S. No.</th>
												<th>Created at</th>
			                                    <th>Amount</th>
			                                    <th>Purpose</th>
			                                    <th>Type</th>
			                                    <th>Status</th>
			                                
									        </tr>
									      </thead>
			      						<tbody>
			      							<?php
			      							$x = 1;
			      								if ($data) {
			      									foreach ($data as $key => $value) {
			      										$amount = convert_currency($value['amount'], $this->currency , 'HKD');
                  										$admin_fee = convert_currency($value['admin_fee'], $this->currency , 'HKD');
 				      									?>
			      								<tr>
			      									<td><?= $x; ?></td>
			      									<td><?= date('Y-m-d' , strtotime($value['created_at']))?></td>
				                                    <td><?= $this->currency.$amount; ?></td>
				                                    <td><?= $value['purpose'] ?></td>
				                                    
				                                    <td><?php 
													if($value['t_type'] == 1)
													{
				                                        echo "<span class='bg-success badge text-white'>Credited</span>";
													}
													else 
													{
														echo "<span class='bg-danger badge text-white'>Debited</span>";
													}
				                                    ?>
													</td>
				                                    <td><?php
				                                        if($value['status'] == 0){
				                                            echo "<span class='badge badge-warning'>Pending</span>";
				                                        }elseif($value['status'] == 1){
				                                            echo "<span class='badge badge-success'>Completed</span>";
				                                        }else{
				                                            echo "<span class='badge badge-danger'>Cancelled</span>";
				                                        }
				                                    ?></td>
				                                   
				                                   
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
<!-- Modal -->
<div class="modal fade" id="withdrawModal" tabindex="-1" role="dialog" aria-labelledby="withdrawModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="withdrawModalLabel">Withdraw to bank</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
	  <form action="#" id="withdraw_amount" method="post" onsubmit="return withdraw_amount(event)" enctype="multipart/form-data" autocomplete="off">
      <div class="modal-body">
        <div class="form-group">
            <label for="withdraw-amount">Withdraw amount</label>
            <input type="number" class="form-control" id="withdraw-amount" name="amount" required>
			<p class="badge badge-info">Min Withdraw amount :<?=  $this->currency.convert_currency(get_admin()['minimum_withdraw'] , $this->currency , 'HKD') ?></p>  
        </div>
        
		<div class="form-group ">
			<label for="country-code">Select Payout Method</label>
			<select id="country-code" name="payout_id" class="form-control">
				<option value="">--Select Payout Method--</option>
				<?php foreach ($payouts as $key => $value): ?>
					<option value="<?= $value['id'] ?>"><?= $value['payout_type'] ?></option>
				<?php endforeach; ?>
				
			</select>
		</div>
    
</div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" id="add_btn" class="btn btn-primary">Withdraw</button>
      </div>
	  </form>
    </div>
  </div>
</div>
<?php include ('include/footer.php') ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/dataTables.bootstrap.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js" ></script>
<script type="text/javascript">

 $(document).ready( function () {
    $('#example3').DataTable();
} );

function withdraw_amount(event) {

event.preventDefault();
$('.alert-error').remove();
$.ajax({
  url: '<?= base_url() ?>/Wallet/withdraw_amount',
  type: 'POST',
  cache:false,
  contentType: false,
  processData: false,
  data:new FormData($('#withdraw_amount')[0]),
  dataType: 'json',
  beforeSend: function() {
	$('#add_btn').prop('disabled' , true);
	$('#add_btn').text('Processing..');
  },
  success : function(res){
	$('#add_btn').prop('disabled' , false);
	$('#add_btn').text('Submit');
	if (res.status == 1) {
	  Swal.fire({
			icon: 'success',
			title: 'Success',
			text: res.message,
 
		})
		.then((willDelete) => {
		  
			location.reload();
		  
		});
	}
	else
	{
	  
		for (var err in res.message) 
		{
	
			$("[name='" + err + "']").after("<div  class='label alert-danger alert-error'>" + res.message[err] + "</div>");
			$("[name='" + err + "']").focus();
		}
	   
	  
	}
  }
});
}  

function already_requested() 
   {
        
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'You have already requested for withdrawal please let admin complete your pending request!',
 
        })
   }
</script>
