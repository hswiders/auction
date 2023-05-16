<?php include ('include/header.php') ?>
<div class="account-page">
	<div class="row">
		<div class="col-sm-3">
			<?php include ('include/sidebar.php') ?> 
		</div>
		<div class="col-sm-9">
			<div class="right-side">
				<div class="rightjhead">
					<h1>Profile</h1>
				</div>
				<p>Change your profile settings</p>		
				
				<div class="row">
					<div class="col-sm-8">
						<form class="form-new" action="#" id="do_update" method="post" onsubmit="return do_update(event)">
						<!-- Text input-->
							<div class="form-group">
							  <label class="control-label">First Name</label>  
							  <div class="">
							  <input type="text" name="first_name" value="<?= $this->auth['first_name'] ?>" class="form-control"> 
							  </div>
							</div>
						<!-- Text input-->
							<div class="form-group">
							  <label class="control-label">Last Name</label>  
							  <div class="">
							  <input type="text" name="last_name" value="<?= $this->auth['last_name'] ?>" class="form-control"> 
							  </div>
							</div>
						<!-- Text input-->
							<!-- <div class="form-group">
							  <label class="control-label">Username</label>  
							  <div class="">
							  <input type="text" readonly name="username" value="<?= $this->auth['username'] ?>" class="form-control"> 
							  </div>
							</div> -->
						<!-- Text input-->
							<!-- <div class="form-group">
							  <label class="control-label">Selected Currency</label>  
							  <div class="">
							  <select class="form-control" name="currency"> 
								<?php $curr = $this->common_model->GetAllData('currency' , '' , 'id' , 'desc'); ?>
								<?php foreach ($curr as $key => $value): ?>
									<option value="<?= $value['id'] ?>"><?= $value['title'] ?></option>
								<?php endforeach ?>
								
							  </select>
							  </div>
							</div> -->
						<!-- Text input-->
							<div class="form-group">
							  <label class="control-label">Contact Info</label>  
							  <div class="">
							  <input type="email" readonly name="email" value="<?= $this->auth['email'] ?>" class="form-control"> 
							  </div>
							</div>
						<!-- Text input-->
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
      url: '<?= base_url() ?>/User/do_update',
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
            	location.reload()
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