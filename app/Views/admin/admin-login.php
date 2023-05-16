<?php include ('include/header-admin.php') ?>
<div class="login-page">
	<div class="container">
	<section class="wrapper bg-transparent">
      <div class="container pb-14 pb-md-16">
        <div class="row">
          
          <div class="col-lg-7 col-xl-6 col-xxl-5 mx-auto mt-n20">
            <div class="card card_login" data-aos="zoom-in-down" data-aos-offset="400">
              <div class="text-center">
                <img src="<?= base_url() ?>/assets/img/logo.png" height="50px"></a></h1> 
              </div>
              <div class="card-body p-11 text-center">
                <div id="result"></div>
                <h2 class="mb-2 text-start">Welcome Back</h2>
                <p class="lead mb-4 text-start">Fill your email and password to sign in.</p>			
                <form class="text-end mb-3 form_login" action="#" id="login_form" method="post" onsubmit="return login_form()">
                  <div class="mb-4">
					<label>Email Address</label>
                    <input type="email" class="form-control" name="email">
                    
                  </div>
                  <div class="password-field mb-4">
					<label>Password</label>
                    <input type="password" class="form-control" name="password">
                    
                  </div>
                  <button type="submit" id="sub_btn" class="btn btn-primary btn-lg w-100 mb-2">Sign In</button>
                </form>
					</div>	
                <!-- /form -->
                <!-- <p class="mb-2 mt-4"><a href="<?= base_url() ?>/admin/forgot" class="hover">Forgot Password?</a></p> -->
                <!-- <p class="mb-0">Don't have an account? <a href="signup.php" class="hover">Sign up</a></p>  -->
              </div>
              <!--/.card-body -->
            </div>
            <!--/.card -->
          </div>
          <!-- /column -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container -->
    </section>
	</div>
</div>
<?php include ('include/footer-admin.php') ?>
<script type="text/javascript">
 
function login_form() {
  $('.alert-danger').remove();
      $.ajax({
      url: '<?= base_url() ?>/Admin/Admin/do_login',
      type: 'POST',
      cache:false,
      contentType: false,
      processData: false,
      data:new FormData($('#login_form')[0]),
      dataType: 'json',
      beforeSend: function() {        
        $('#sub_btn').prop('disabled' , true);
        $('#sub_btn').text('Processing..');
      },
      success : function(res){
        $('#sub_btn').prop('disabled' , false);
        $('#sub_btn').text('Submit');
        if (res.status == 1) {
          //alert(res.message)
          // alert(res.session)
          window.location.href = res.redirect;
        }
        else
        {
         
          $('#result').html(res.message);
          for (var err in res.validation) {
            
            $("[name='" + err + "']").after("<div  class='label alert-danger'>" + res.validation[err] + "</div>");
          }
        }
      }
    });
return false;
}
</script>