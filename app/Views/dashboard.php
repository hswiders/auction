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
					<a href="<?= base_url('profile') ?>" class="btn btn-light">Edit Profile</a>
				</div>
				<div class="infoaccount">
					<div class="row">
						<div class="col-sm-4">
							<div class="set-value">
								<h3>Name</h3>
								<h4><?= $this->auth['first_name'].' '.$this->auth['last_name'] ?></h4>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="set-value">
								<h3>Email Address</h3>
								<h4><?= $this->auth['email'] ?></h4>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="set-value">
								<h3>Username</h3>
								<h4><?= $this->auth['first_name'] ?></h4>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="set-value">
								<h3>Reset Password</h3>
								
								 <form class="text-end" action="#" id="do_forgot" method="post" onsubmit="return do_forgot(event)">
				                  
				                    <input type="hidden" class="form-control" name="email" value="<?= $this->auth['email'] ?>">
				                  
				                  <button type="submit" id="sub_btn" class="btn btn-dark btn-sm mt-3">Reset Password</button>
				                </form> 
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php include ('include/footer.php') ?>
<script type="text/javascript">
	function do_forgot(e) 
  {
    e.preventDefault();
      $('.alert-danger').remove();
      $.ajax({
      url: '<?= base_url() ?>/User/do_forgot',
      type: 'POST',
      cache:false,
      contentType: false,
      processData: false,
      data:new FormData($('#do_forgot')[0]),
      dataType: 'json',
      beforeSend: function() {        
        $('#sub_btn').prop('disabled' , true);
        $('#sub_btn').text('Processing..');
      },
      success : function(res){
        $('#sub_btn').prop('disabled' , false);
        $('#sub_btn').text('Reset Password');
        if (res.status == 1) 
        {
            Swal.fire({
               title: "Success", 
               text: res.message, 
               icon: "success"
             }).then(function (result) {
                window.location.href = res.redirect
            })
           
        }
        else if(res.status == 2)
        {
          for (var err in res.message) {
            
            $("[name='" + err + "']").after("<div  class='label alert-danger'>" + res.message[err] + "</div>");
          }
        }
        else
        {
          Swal.fire({
               title: "Error", 
               text: res.message, 
               icon: "error"
             }).then(function (result) {
              window.location.href = res.redirect
            })
        }
      }
    });
return false;
}  
</script>