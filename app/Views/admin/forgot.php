<?php include ('include/header.php') ?>
<div class="login-page">
	<div class="container">
	<section class="wrapper bg-transparent">
      <div class="container pb-14 pb-md-16">
        <div class="row">
          <div class="col-lg-7 col-xl-6 col-xxl-5 mx-auto mt-n20">
            <div class="card card_login" data-aos="zoom-in-down" data-aos-offset="400">
              <div class="card-body p-11 text-center">
                <h2 class="mb-2 text-start">Forgot Password</h2>
                <p class="lead mb-4 text-start">Fill your registered email id</p>			
                 <form class="text-end mb-3 form_login" action="#" id="do_forgot" method="post" onsubmit="return do_forgot(event)">
                  <div class="mb-4">
					          <label>Email Address</label>
                    <input type="email" class="form-control" name="email">
                  </div> 
                  <button type="submit" id="sub_btn" class="btn btn-primary btn-lg w-100 mb-2">Send</button>
                </form> 
                <!-- /form --> 
                <p class="mb-0 mt-4"> <a href="<?= base_url('admin') ?>" class="hover">Back to Sign in</a></p> 
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

  function do_forgot(e) 
  {
    e.preventDefault();
      $('.alert-danger').remove();
      $.ajax({
      url: '<?= base_url() ?>/Admin/Admin/do_forgot',
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
        $('#sub_btn').text('Submit');
        if (res.status == 1) 
        {
            Swal.fire({
               title: "Success", 
               text: res.message, 
               icon: "success"
             }).then(function (result) {
                window.location.reload();
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