
<?php include ('include/header.php') ?>

<style>
    .dashboard {
        background-color: #5662a6;
        height:500px;
    }
    span.nav-text {
        color: white;
    }
    .deznav {
        padding: 20px 5px 0px 5px !important;
    }
    li {
        padding-top: 5px;
        padding-bottom: 5px;
    }
    i.fa {
        color: white;
    }
</style>
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

            <div class="col-md-9">
        		<div class="table-part">
        			<h4>Change Password</h4>
                    <?= $this->session->getFlashdata('msg'); ?>
            <div class="card card_login" data-aos="zoom-in-down" data-aos-offset="400">
              <div class="card-body p-11 text-center">
                <div id="result"></div>           
                <form class="text-end mb-3 form_login" action="#" id="update_password" method="post" onsubmit="return update_password()">
                  <div class="mb-4">
                    <label>Current Password</label>
                    <input type="password" class="form-control" name="old_pass" >                    
                  </div>
                  <div class="password-field mb-4">
                    <label>New Password</label>
                    <input type="password" class="form-control"  name="new_pass">                    
                  </div>
                  <div class="password-field mb-4">
                    <label>Confirm New Password</label>
                    <input type="password" class="form-control" name="cnew_pass">                    
                  </div>
                  <button type="submit" id="sub_btn" class="btn btn-primary btn-lg w-100 mb-2">Update</button>
                </form>
              </div>
              <!--/.card-body -->
            </div>
        		
        		   
        	   </div>
            </div>
        </div>
    </div>
</div>
<?php include ('include/footer.php') ?> 
<script type="text/javascript">
 
function update_password() {
  $('.alert-danger').remove();
      $.ajax({
      url: '<?= base_url() ?>/Admin/Admin/update_password',
      type: 'POST',
      cache:false,
      contentType: false,
      processData: false,
      data:new FormData($('#update_password')[0]),
      dataType: 'json',
      beforeSend: function() {        
        $('#sub_btn').prop('disabled' , true);
        $('#sub_btn').text('Processing..');
      },
      success : function(res){
        $('#sub_btn').prop('disabled' , false);
        $('#sub_btn').text('Update');
        if (res.status == 1) {

            window.location.reload();
          // alert(res.session)
          
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
