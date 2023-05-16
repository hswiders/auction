<?php include 'include/header.php'; ?>
<div class="account-page">
    <div class="row">
        <div class="col-sm-3">
            <?php include 'include/sidebar.php'; ?>
        </div>
        <?php $seller_info = $this->common_model->GetSingleData('hw_users', ['user_id' => $this->auth_id]); ?>
        <div class="col-sm-9">
            <div class="right-side">
                <div class="rightjhead">
                    <h1>Payout Center</h1>
                    <div class="text-right w-100">
                    <?php if(!$is_bank_added || !$is_paypal_added): ?>
                      <button type="button"  class="btn btn-danger" data-toggle="modal" data-target="#payoutModal">Add Payout</button>
					<?php endif; ?>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-bordered ">
                                <thead>
                                    <tr>
                                        <th>Type</th>
                                        <th>ID name</th>
                                        <th>Method details</th>
                                        <th>Currency / Country</th>
                                        <th>Action</th>
                                    </tr>

                                </thead>
                                <tbody>
                                    <?php foreach ($data as $item): ?> 
                                    <tr>
                                        <td><?= $item['payout_type'] ?></td>
                                        <td><?= $item['firstName'].' '.$item['lastName'] ?></td>
                                        <td><?= $item['addressLine1']?></td>
                                        <td><?= $item['transferMethodCurrency'].' '.$item['transferMethodCountry'] ?></td>
                                        <td><button type="button" name="" id="" class="btn btn-success btn-sm " data-toggle="modal" data-target="#payoutModal<?= $item['id'] ?>"> Edit</button></td>
                                    </tr>
                                     <!-- Modal -->
    <div class="modal fade" id="payoutModal<?= $item['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="payoutModal<?= $item['id'] ?>Label"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="payoutModal<?= $item['id'] ?>Label">Add Payout</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="#" id="update_payout<?= $item['id'] ?>" method="post" onsubmit="return update_payout(event , <?= $item['id'] ?>)"
                    enctype="multipart/form-data" autocomplete="off">
                    <div class="modal-body">
                        <div name="message"></div>
                        
                        <div class="form-group ">
                            <label for="profile-type<?= $item['id'] ?>">Profile type</label>
                            <select name="profileType" id="profile-type<?= $item['id'] ?>" class="form-control">
                                <option <?= ($item['profileType'] == "INDIVIDUAL") ? "selected" : '' ?> value="INDIVIDUAL">INDIVIDUAL</option>
                                <option <?= ($item['profileType'] == "BUSINESS") ? "selected" : '' ?> value="BUSINESS">BUSINESS</option>
                            </select>
                        </div>
                        <div class="form-group ">
                            <label >First name</label>
                            <input type="text" class="form-control"  name="firstName" value="<?= $item['firstName'] ?>">
                            <input type="hidden" class="form-check-input"  name="payout_type" value="<?= $item['payout_type'] ?>" >
                            <input type="hidden" class="form-check-input"  name="id" value="<?= $item['id'] ?>" >
                        </div>
                        <div class="form-group  ">
                            <label >Last name</label>
                            <input type="text" class="form-control"name="lastName" value="<?= $item['lastName'] ?>">
                        </div>
                        <div class="form-group ">
                            <label >DOB (YYYY-MM-DD)</label>
                            <input type="date" class="form-control"  name="dateOfBirth" value="<?= $item['dateOfBirth'] ?>">
                            <input type="hidden" class="form-control"  name="email" value="<?= $item['email'] ?>" required disabled>
                        </div>
                        
                        <div class="form-group ">
                            <label >Address line 1</label>
                            <input type="text" class="form-control"  name="addressLine1" value="<?= $item['addressLine1'] ?>" required>
                        </div>
                        <div class="form-group ">
                            <label >City</label>
                            <input type="text" class="form-control" name="city" value="<?= $item['city'] ?>" required>
                        </div>
                        <div class="form-group ">
                            <label >State/Province</label>
                            <input type="text" class="form-control"  name="stateProvince" value="<?= $item['stateProvince'] ?>"
                                required>
                                <input type="hidden" class="form-control"  name="country" value="HK">
                        </div>
                        
                        <div class="form-group ">
                            <label >Postal code</label>
                            <input type="number" class="form-control"  name="postalCode" value="<?= $item['postalCode'] ?>" required>
                        </div>
                        <div class="form-group ">
                            <label >Business name (if profile type is business)</label>
                            <input type="text" class="form-control"  name="businessName" value="<?= ($item['profileType'] == "BUSINESS") ? $item['firstName'] : ''; ?>">
                        </div>

                        <div class="form-group ">
                            <label for="">Transfer Method Country | Transfer Method Currency</label>
                            <select name="transferMethod"  class="form-control">
                                <option>HK|HKD</option>
                                
                               
                            </select>
                        </div>
                        <?php if($item['payout_type'] == 'paypal'): ?>
                        <div class="form-group ">
                            <label for="">Paypal Email</label>
                            <input type="text" name="accountId" value="<?= $item['accountId'] ?>" id="" class="form-control">
                        </div>
                        <?php endif ?>
                        <?php if($item['payout_type'] == 'bank'): ?>

                        <div class="form-group ">
                            <label for="">Branch ID</label>
                            <input type="text" name="branchId" value="<?= $item['branchId'] ?>" id="" class="form-control">
                        </div>
                        <div class="form-group ">
                            <label for="">Bank ID</label>
                            <input type="text" name="bankId" value="<?= $item['bankId'] ?>" id="" class="form-control">
              
                        </div>
                        <div class="form-group ">
                            <label for="">Account Number</label>
                            <input type="text" name="bankAccountId" value="<?= $item['bankAccountId'] ?>" id="" class="form-control">
                        </div>
                        <?php endif ?>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" id="update_btn<?= $item['id'] ?>" class="btn btn-primary">Update Method</button>
                    </div>
                 </form>


            </div>
        </div>
    </div>
                                    <?php endforeach; ?> 
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
    <div class="modal fade" id="payoutModal" tabindex="-1" role="dialog" aria-labelledby="payoutModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="payoutModalLabel">Add Payout</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="#" id="add_payout" method="post" onsubmit="return add_payout(event)"
                    enctype="multipart/form-data" autocomplete="off">
                    <div class="modal-body">
                        <div name="message"></div>
                        <div class="form-group">
                            <label for="payout-type">Payout type</label>
                            <div>
                            <?php if(!$is_bank_added): ?>
                                <div class="form-check form-check-inline">
                                    <input type="radio" class="form-check-input" id="payout-type-bank"
                                        name="payout_type" value="bank" required>
                                    <label for="payout-type-bank" class="form-check-label">Bank</label>
                                </div>
                            <?php endif; ?>

                            <?php if(!$is_paypal_added): ?>

                                <div class="form-check form-check-inline">
                                    <input type="radio" class="form-check-input" id="payout-type-paypal"
                                        name="payout_type" value="paypal" required>
                                    <label for="payout-type-paypal" class="form-check-label">PayPal</label>
                                </div>
                            <?php endif; ?>

                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="profile-type">Profile type</label>
                            <select name="profileType" id="profile-type" class="form-control">
                                <option value="INDIVIDUAL">INDIVIDUAL</option>
                                <option value="BUSINESS">BUSINESS</option>
                            </select>
                        </div>
                        <div class="form-group ">
                            <label for="first-name">First name</label>
                            <input type="text" class="form-control" id="first-name" name="firstName">
                        </div>
                        <div class="form-group  ">
                            <label for="last-name">Last name</label>
                            <input type="text" class="form-control" id="last-name" name="lastName">
                        </div>
                        <div class="form-group ">
                            <label for="date-of-birth">DOB (YYYY-MM-DD)</label>
                            <input type="date" class="form-control" id="date-of-birth" name="dateOfBirth">
                            <input type="hidden" class="form-control" id="email" name="email" value="<?= $this->user['email'] ?>" >
                        </div>
                       
                        <div class="form-group ">
                            <label for="address-line1">Address line 1</label>
                            <input type="text" class="form-control" id="address-line1" name="addressLine1" required>
                        </div>
                        <div class="form-group ">
                            <label for="city">City</label>
                            <input type="text" class="form-control" id="city" name="city" required>
                        </div>
                        <div class="form-group ">
                            <label for="state-province">State/Province</label>
                            <input type="text" class="form-control" id="state-province" name="stateProvince"
                                required>
                            <input type="hidden" class="form-control"  name="country" value="HK">
                        </div>
                       
                        <div class="form-group ">
                            <label for="postal-code">Postal code</label>
                            <input type="number" class="form-control" id="postal-code" name="postalCode" required>
                        </div>
                        <div class="form-group ">
                            <label for="business-name">Business name (if profile type is business)</label>
                            <input type="text" class="form-control" id="business-name" name="businessName">
                        </div>

                        <div class="form-group ">
                            <label for="">Transfer Method Country | Transfer Method Currency</label>
                            <select name="transferMethod" class="form-control">
                                <option>HK|HKD</option>
                                
                               
                            </select>
                        </div>

                       
                        <div class="form-group paypal-fields">
                            <label for="">Paypal Email</label>
                            <input type="text" name="accountId" id="" class="form-control">
                        </div>
                        <div class="form-group bank-fields">
                            <label for="">Branch ID</label>
                            <input type="text" name="branchId" id="" class="form-control">
                        </div>
                        <div class="form-group bank-fields">
                            <label for="">Bank ID</label>
                            <input type="text" name="bankId" id="" class="form-control">
                            
                            
                        </div>
                        <div class="form-group bank-fields">
                            <label for="">Account Number</label>
                            <input type="text" name="bankAccountId" id="" class="form-control">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" id="add_btn" class="btn btn-primary">Add Method</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <?php include 'include/footer.php'; ?>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    


    <script>
       $(document).ready( function () {
   
	$('.paypal-fields').hide()
			$('.bank-fields').hide()
} );

function add_payout(event) {

event.preventDefault();
$('.alert-error').remove();
$.ajax({
  url: '<?= base_url() ?>/Wallet/createPayoutMethod',
  type: 'POST',
  cache:false,
  contentType: false,
  processData: false,
  data:new FormData($('#add_payout')[0]),
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
function update_payout(event , id) 
{

    event.preventDefault();
    $('.alert-error').remove();
    $.ajax({
    url: '<?= base_url() ?>/Wallet/UpdatePayoutMethod',
    type: 'POST',
    cache:false,
    contentType: false,
    processData: false,
    data:new FormData($('#update_payout'+id)[0]),
    dataType: 'json',
    beforeSend: function() {
        $('#update_btn'+id).prop('disabled' , true);
        $('#update_btn'+id).text('Processing..');
    },
    success : function(res){
        $('#update_btn'+id).prop('disabled' , false);
        $('#update_btn'+id).text('Submit');
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
$('input[name="payout_type"]').on('change' , function(){
		val = $('input[name="payout_type"]:checked').val()
		
		if(val == 'paypal')
		{
			$('.paypal-fields').show()
			$('.bank-fields').hide()
		}
		else
		{
			$('.paypal-fields').hide()
			$('.bank-fields').show()
		}
   })
    </script>
