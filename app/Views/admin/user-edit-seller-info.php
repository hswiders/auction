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
		<?php $seller_info = $this->common_model->GetSingleData('seller_billing_info' , ['user_id' => $edit['id']]); ?>
		<div class="col-sm-9">
			<div class="right-side">
				<div class="rightjhead">
					<h1>Billing Info</h1>
				</div>
				<p>Provide your billing Info</p>		
				
				<div class="row">
					<div class="col-sm-8">
						<form class="form-new" action="#" id="do_update" method="post" onsubmit="return do_update(event)">
						<!-- Text input-->
              <div class="form-group">
                <label class="control-label">Credit Card</label>  
                <div class="">
                  <input readonly type="number" placeholder="Card Number" name="card_number" value="<?= ($seller_info) ? $seller_info['card_number'] : '' ?>" class="form-control" required> 
                 <input type="hidden" name="user_id" value="<?= $edit['id'] ?>" class="form-control"> 
                </div>
              </div>
              <!-- Text input-->
              <div class="form-group">  
                <div class="row">
                    <div class="col-sm-3">
                      <input readonly type="text" placeholder="Expire" name="card_expire" value="<?= ($seller_info) ? $seller_info['card_expire'] : '' ?>" class="form-control" required> 
                    </div>
                    <div class="col-sm-3">
                      <input readonly type="number" placeholder="CVV" name="card_cvv" class="form-control" value="<?= ($seller_info) ? $seller_info['card_cvv'] : '' ?>" required> 
                    </div>
                </div>
              </div>
              <br>
						<!-- Text input-->
                    <div class="form-group">
                      <label class="control-label">Billing Info</label>  
                      <div class="">
                        <input type="text" placeholder="First Name" name="billing_first" value="<?= ($seller_info) ? $seller_info['billing_first'] : '' ?>" class="form-control" required> 
                      </div>
                    </div> 
                    <!-- Text input-->
                    <div class="form-group">    
                      <input type="text" placeholder="Last Name" name="billing_last" value="<?= ($seller_info) ? $seller_info['billing_last'] : '' ?>" class="form-control">  
                    </div> 
                    <!-- Text input-->
                    <div class="form-group">    
                      <!--  <select class="form-control">  
                          <option>India</option>
                      </select> -->
                      <input type="text" placeholder="Country" name="billing_country" value="<?= ($seller_info) ? $seller_info['billing_country'] : '' ?>" class="form-control" required>
                    </div>  
                    <!-- Text input-->
                    <div class="form-group">    
                      <input type="text" placeholder="Address" name="billing_address" value="<?= ($seller_info) ? $seller_info['billing_address'] : '' ?>" class="form-control">  
                    </div> 
                    <!-- Text input-->
                    <div class="form-group">    
                      <input type="text" placeholder="Address 2" name="billing_address2" value="<?= ($seller_info) ? $seller_info['billing_address2'] : '' ?>" class="form-control" required>  
                    </div> 
                    <!-- Text input-->
                    <div class="form-group">    
                      <input type="text" placeholder="City" name="billing_city" value="<?= ($seller_info) ? $seller_info['billing_city'] : '' ?>" class="form-control" required>  
                    </div> 
                    <!-- Text input-->
                    <div class="form-group">  
                      <div class="row">
                          <div class="col-sm-6">
                            <input type="text" placeholder="State/Province/Region" value="<?= ($seller_info) ? $seller_info['billing_state'] : '' ?>" name="billing_state" class="form-control" required> 
                          </div>
                          <div class="col-sm-6">
                            <input type="text" placeholder="Zip/Postal Code" value="<?= ($seller_info) ? $seller_info['billing_zip'] : '' ?>" name="billing_zip" class="form-control" required> 
                          </div>
                      </div>
                    </div> 
						
							<div class="form-group">
								<button type="submit" id="sub_btn" class="btn btn-primary">Update</a>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php include ('include/footer.php') ?>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
>


<script>
  
  function do_update (e) 
  {
    e.preventDefault();
      $('.alert-danger').remove();
      $.ajax({
      url: '<?= base_url() ?>/Admin/Users/do_update_seller',
      type: 'POST',
      cache:false,
      contentType: false,
      processData: false,
      data:new FormData($('#do_update')[0]),
      dataType: 'json',
      beforeSend: function() {        
        $('#sub_btn').prop('disabled' , true);
        $('#sub_btn').text('Processing..');
      },
      success : function(res){
        $('#sub_btn').prop('disabled' , false);
        $('#sub_btn').text('Submit');
        if (res.status == 1) 
        {
            Swal.fire({
               title: "Success", 
               text: res.message, 
               icon: "success"
             }).then(function (result) {
            	window.location.href = '<?= base_url('admin/account-settings/'.$edit['id']) ?>'
            })
           
        }
        else
        {
          for (var err in res.message) {
            
            $("[name='" + err + "']").after("<div  class='label alert-danger'>" + res.message[err] + "</div>");
          }
        }
      }
    });
return false;
}
$('#dob').on('change', function(event) {
	dob = new Date($(this).val());

	age = _calculateAge(dob);
	$('#age').val(age)
});  
function _calculateAge(birthday) { // birthday is a date
    var ageDifMs = Date.now() - birthday.getTime();
    var ageDate = new Date(ageDifMs); // miliseconds from epoch
    return Math.abs(ageDate.getUTCFullYear() - 1970);
}

// Start upload preview image
// 	var $uploadCrop,
// 	tempFilename,
// 	rawImg,
// 	imageId;
// 	function readFile(input) {
// 			if (input.files && input.files[0]) {
//             var reader = new FileReader();
//             reader.onload = function (e) {
// 				$('.upload-demo').addClass('ready');
// 				$('#cropImagePop').modal('show');
// 	            rawImg = e.target.result;
//             }
//             reader.readAsDataURL(input.files[0]);
//         }
//         else {
// 	        swal("Sorry - you're browser doesn't support the FileReader API");
// 	    }
// 	}

// 	$uploadCrop = $('#upload-demo').croppie({
// 		viewport: {
// 			width: 200,
// 			height: 200,
// 		},
// 		enforceBoundary: true,
// 		enableExif: true
// 	});
// 	$('#cropImagePop').on('shown.bs.modal', function(){
// 		// alert('Shown pop');
// 		$uploadCrop.croppie('bind', {
//       		url: rawImg
//       	}).then(function(){
//       		console.log('jQuery bind complete');
//       	});
// 	});

// 	$('#profile-upload').on('change', function () 
// 	{
// 	 imageId = $(this).data('id'); tempFilename = $(this).val();
//   $('#cancelCropBtn').data('id', imageId); readFile(this); 
// });
// 	$('#cropImageBtn').on('click', function (ev) {
// 		$uploadCrop.croppie('result', {
// 			type: 'canvas',
// 			size: {width: 200, height: 200}
// 		}).then(function (resp) {
// 			$('#item-img-output').attr('src', resp);
// 			upload_file(resp , 'image')
// 			$('#cropImagePop').modal('hide');
// 		});
// 	});
				// End upload preview image
        
</script>