<?php include ('include/header.php') ?>
<div class="middle login-middle">
  <?php echo $this->session->getFlashdata("msg"); ?>
  <div class="row"> 
    <div class="col-sm-6">
      <div class="login-box">
        <h4>CREATE ACCOUNT</h4>
        <p>Please enter your email address to create an account.</p>
        
        <form class="form-new" id="do_signup" method="post" onsubmit="return do_signup(event)">
        <!-- Text input-->
        <div class="form-group">
          <label class="control-label">First name</label>  
          <div class="">
            <input type="text" class="form-control" name="first_name">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label">Last name</label>  
          <div class="">
            <input type="text" class="form-control" name="last_name">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label">Email</label>  
          <div class="">
            <input type="email" class="form-control" name="email">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label">Password</label>  
          <div class="">
            <input type="password" class="form-control" name="password">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label">Confirm Password</label>  
          <div class="">
            <input type="password" class="form-control" name="cnfm_password">
          </div>
        </div>
        <div class="form-group">
          <button type="submit" id="signup_btn" class="btn btn-warning">Create an Account</a>
        </div>
        </form>
      </div>
    </div>
    <div class="col-sm-6">
      <div class="login-box">
        <h4>ARE YOU ALREADY REGISTERED?</h4>
        <p>Please enter your Registered email address and password</p>
        
        <form class="form-new" action="#" id="do_login" method="post" onsubmit="return do_login(event)">
        <!-- Text input-->
        <div id="result"></div>
        <div class="form-group">
          <label class="control-label">Email</label>  
          <div class="">
            <input type="email" class="form-control" name="email1">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label">Password</label>  
          <div class="">
            <input type="password" class="form-control" name="password1">
          </div>
        </div>
        
        <!-- Text input-->
        <div class="form-group">  
          <div class="forgot-link">
          <a href="<?= base_url('forgot') ?>">Forgot your password?</a>
          </div>
        </div>
        <div class="form-group">
          <button type="submit" id="sub_btn" class="btn btn-success">Login</button>
        </div>
        </form>
      </div>
    </div>
  </div>
</div>
<?php include ('include/footer.php') ?>

<script>
  function do_login(e) 
  {
    e.preventDefault();
      $('.alert-danger').remove();
      $.ajax({
      url: '<?= base_url() ?>/Login/do_login',
      type: 'POST',
      cache:false,
      contentType: false,
      processData: false,
      data:new FormData($('#do_login')[0]),
      dataType: 'json',
      beforeSend: function() {        
        $('#sub_btn').prop('disabled' , true);
        $('#sub_btn').text('Processing..');
      },
      success : function(res){
        $('#sub_btn').prop('disabled' , false);
        $('#sub_btn').text('Sign In');
        if (res.status == 1) 
        {
            Swal.fire({
               title: "Success", 
               text: res.message, 
               icon: "success"
             }).then(function (result) {
              
              window.location.href = res.redirect;
              <?php if ($_GET['redirect']): ?>
                window.location.href = '<?= base_url($_GET['redirect']); ?>';
              <?php endif ?>
              

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
          $('#result').html(res.message);
        }
      }
    });
return false;
}
</script>
<script>
  function do_signup (e) 
  {
    e.preventDefault();
      $('.alert-danger').remove();
      $.ajax({
      url: '<?= base_url() ?>/Signup/do_signup',
      type: 'POST',
      cache:false,
      contentType: false,
      processData: false,
      data:new FormData($('#do_signup')[0]),
      dataType: 'json',
      beforeSend: function() {        
        $('#signup_btn').prop('disabled' , true);
        $('#signup_btn').text('Processing..');
      },
      success : function(res){
        $('#signup_btn').prop('disabled' , false);
        $('#signup_btn').text('Create an Account');
        if (res.status == 1) 
        {
            Swal.fire({
               title: "Success", 
               text: res.message, 
               icon: "success"
             }).then(function (result) {
            window.location.href = res.redirect;
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
</script>