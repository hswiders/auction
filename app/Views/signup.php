<?php include ('include/header.php') ?>
<div class="login-page">
  <div class="container">
    <section class="wrapper bg-transparent">
      <div class="container pb-14 pb-md-16">
        <div class="row">
          <div class="col-lg-7 col-xl-6 col-xxl-5 mx-auto mt-n20">
            <div class="card card_login" data-aos="zoom-in-down" data-aos-offset="400">
              <div class="card-body p-11 text-center">
                <h2 class="mb-2 text-start">Signup its free!!</h2>
                <p class="lead mb-4 text-start">Fill your personal detail</p>
                <form class="text-end mb-3 form_login" action="#" id="do_signup" method="post" onsubmit="return do_signup(event)">
                  <div class="mb-4">
                    <label>Your First name</label>
                    <input type="text" class="form-control" name="first_name">
                  </div>
                  <div class="mb-4">
                    <label>Your Last name</label>
                    <input type="text" class="form-control" name="last_name">
                  </div>
                  <div class="mb-4">
                    <label>Email Address</label>
                    <input type="email" class="form-control" name="email">
                  </div>
                  <div class="password-field mb-4">
                    <label>Password</label>
                    <input type="password" class="form-control" name="password">
                  </div>
                  <button type="submit" id="sub_btn" class="btn btn-primary btn-lg w-100 mb-2">Sign Up</button>
                </form>
                <div class="quick-login">
                  <span>Quick Sign Up</span>
                </div>
                <div class="socail-login">
                  <div class="row">
                    <div class="col-sm-6">
                      <a href="javascript:;"><img src="<?= base_url() ?>/assets/img/login-google.png"></a>
                    </div>
                    <div class="col-sm-6">
                      <a href="javascript:;"><img src="<?= base_url() ?>/assets/img/login-facebook.png"></a>
                    </div>
                  </div>
                </div>
                <!-- /form -->
                <p class="mb-0 mt-3">I have already an account? <a href="<?= base_url('login') ?>" class="hover">Sign in</a></p>
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
<?php include ('include/footer.php') ?>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.4/dist/sweetalert2.all.min.js"></script>
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