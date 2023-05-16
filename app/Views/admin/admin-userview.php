<?php include ('include/header.php') ?>
<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"> -->
<style>
    .dashboard {
        background-color: #5662a6;
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
    .open-button {
  background-color: #555;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  opacity: 0.8;
  position: fixed;
  bottom: 23px;
  right: 28px;
  width: 280px;
}

/* The popup form - hidden by default */
.form-popup {
    width: 500px;
    position: absolute;
    bottom: 0%;
    right: 0%;
    left: 0%;
    border: 3px solid #f1f1f1;
    z-index: 9;
}

/* Add styles to the form container */
.form-container {
  max-width: 300px;
  padding: 10px;
  background-color: white;
}

/* Full-width input fields */
.form-container input[type=text], .form-container input[type=password] {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  border: none;
  background: #f1f1f1;
}

/* When the inputs get focus, do something */
.form-container input[type=text]:focus, .form-container input[type=password]:focus {
  background-color: #ddd;
  outline: none;
}

/* Set a style for the submit/login button */
.form-container .btn {
  background-color: #04AA6D;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  width: 100%;
  margin-bottom:10px;
  opacity: 0.8;
}

/* Add a red background color to the cancel button */
.form-container .cancel {
  background-color: red;
}

textarea#reason {
  margin-left: 20px;
  width: 92%;
  margin-top: 20px;
  height: 150px;
}

/* Add some hover effects to buttons */
.form-container .btn:hover, .open-button:hover {
  opacity: 1;
}
button#reject {
    margin-right: 20px;
    margin-bottom: 15px;
}
i.fa.fa-close {
    color: #f10606;
    font-size:15px;
}
.rejected {
    color: red;
}
.not_upload {
    color:#9890b9;
}
.verified {
    color:#1d7304;
}
.pending {
    color:#9890b9;
}
i.fa.fa-exclamation {
    background-color: #9890b9;
    color: white;
    padding: 5px;
    border-radius: 50%;
}
i.fa.fa-hourglass {
    color: #9890b9;
    font-size: 15px;
}
i.fa.fa-check {
    color: #1d7304;
}

</style>
<div class="page-header">
	<div class="container">
		<div class="d-flex">
			<h1>Admin dashboard</h1>
		</div>
	</div>
</div>
<div class="admin-dash adminUser-view">
	<div class="container">
        <div class="row">
            <?php include ('include/sidebar.php') ?>
            <div class="col-md-9">
        		<div class="table-part">
                    
            			<h4>"<?= $view['first_name']. ' ' .$view['last_name']?>" Details: 
                        <?php if($view['status'] == 1) { ?>
                            <span class="alert alert-success">Enabled</span>
                        <?php } else { ?>
                            <span class="alert alert-danger">Disabled</span>
                            <?php } ?>
                        </h4>
            		
            		    <div class="table-responsive" style="display:flex">		
            		      <div class="col-md-6">
                        <h5>General Information</h5><br/>
                            <p><strong>Name : </strong><?= $view['first_name']. ' ' .$view['last_name']?></p>      
                            <p><strong>Email : </strong><?= $view['email'] ?></p>      
                            <p><strong>Username : </strong><?= $view['username'] ?></p>      
                            <p><strong>Currency : </strong>
                                <?php $currency = $this->common_model->GetSingleData('currency', array('id'=>$view['currency'])); ?>
                                 <?= $currency['title'] ?>
                    
                            </p>
                          </div>
            	   </div>

                  
                </div>
            </div>
            
        </div>
    </div>
</div>
<!-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script> -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
<?php include ('include/footer.php') ?>
<script>
    
    $(document).ready(function(){
        $('#myForm').hide();
    });

function openForm() {
  document.getElementById("myForm").style.display = "block";
}

function closeForm() {
  document.getElementById("myForm").style.display = "none";
}

function verify_user(id)
{
    
    $.ajax({
      url: '<?= base_url() ?>/Admin/Users/update_verify',
      type: 'POST',
      cache:false,
      data:{'id':id},
      dataType: 'json',
      beforeSend: function() {        
        $('#Verify').prop('disabled' , true);
        $('#Verify').text('Processing..');
      },
      success : function(res){
        $('#Verify').prop('disabled' , false);
        $('#Verify').text('Verify');
        if (res.status == 1) {
            window.location.reload();
          
        }
      }
    });
    return false;
}

function reject_user() {
    $('.alert-danger').remove();
      $.ajax({
      url: '<?= base_url() ?>/Admin/Users/update_reject',
      type: 'POST',
      cache:false,
      contentType: false,
      processData: false,
      data:new FormData($('#reject_user')[0]),
      dataType: 'json',
      beforeSend: function() {        
        $('#sub_btn').prop('disabled' , true);
        $('#sub_btn').text('Processing..');
      },
      success : function(res){
        $('#sub_btn').prop('disabled' , false);
        $('#sub_btn').text('Submit');
        if (res.status == 1) {
            window.location.reload();
          
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