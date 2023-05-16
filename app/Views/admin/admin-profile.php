
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
        			<h4>Edit Profile</h4>
                    <?= $this->session->getFlashdata('msg'); ?>
            <div class="card card_login" data-aos="zoom-in-down" data-aos-offset="400">
              <div class="card-body p-11 text-center">
                <div id="result"></div>           
                <form class="text-end mb-3 form_login" action="#" id="update_form" method="post" onsubmit="return update_form()">
                  <div class="mb-4">
                    <label>Name</label>
                    <input type="text" class="form-control" name="name" value="<?= $data['name'] ?>" >                    
                  </div>
                  <div class="password-field mb-4">
                    <label>Email</label>
                    <input type="email" class="form-control" value="<?= $data['email'] ?>" name="email" readonly>                    
                  </div>
                  <div class="password-field mb-4">
                    <label>Phone</label>
                    <input type="number" class="form-control"  value="<?= $data['contact_number'] ?>" name="contact_number">                    
                  </div>
                  <div class="password-field mb-4">
                    <label>Trasaction Fee (%)</label>
                    <input type="number" class="form-control"  value="<?= $data['admin_commission'] ?>" name="admin_commission">                    
                  </div>
                  <div class="password-field mb-4">
                    <label>Processing Fee (%)</label>
                    <input type="number" class="form-control"  value="<?= $data['vat_tax'] ?>" name="vat_tax">                    
                  </div>
                  <div class="password-field mb-4">
                    <label>Bid Processing Fee (HKD)</label>
                    <input type="number"  step="0.1" class="form-control"  value="<?= $data['bid_processing_fee'] ?>" name="bid_processing_fee">                    
                  </div>
                   <div class="password-field mb-4">
                    <label>Exchnage Service Fee</label>
                    <input type="number" class="form-control"  value="<?= $data['exchnage_service_fee'] ?>" name="exchnage_service_fee">                    
                  </div>
                   <div class="password-field mb-4">
                    <label>Shipping Fee (HKD)</label>
                    <input type="number" class="form-control"  value="<?= $data['shipping_fee'] ?>" name="shipping_fee">                    
                  </div>
                   <div class="password-field mb-4">
                    <label>Exchange Shipping Fee (HKD)</label>
                    <input type="number" class="form-control"  value="<?= $data['exchange_shipping_fee'] ?>" name="exchange_shipping_fee">                    
                  </div>
                  
                  <div class="password-field mb-4">
                    <label>Phone</label>
                    <input type="number" class="form-control"  value="<?= $data['contact_number'] ?>" name="contact_number">                    
                  </div>
                  <div class="password-field mb-4">
                    <label>Company Address</label>
                    <input type="text" class="form-control"  value="<?= $data['address'] ?>" name="address">                    
                  </div>
                  <div class="password-field mb-4">
                    <label>Minimum Withdrawal</label>
                    <input type="number" min="1" class="form-control"  value="<?= $data['minimum_withdraw'] ?>" name="minimum_withdraw">                    
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
 
function update_form() {
  $('.alert-danger').remove();
      $.ajax({
      url: '<?= base_url() ?>/Admin/AdminDashboard/update_profile',
      type: 'POST',
      cache:false,
      contentType: false,
      processData: false,
      data:new FormData($('#update_form')[0]),
      dataType: 'json',
      beforeSend: function() {        
        $('#sub_btn').prop('disabled' , true);
        $('#sub_btn').text('Processing..');
      },
      success : function(res){
        $('#sub_btn').prop('disabled' , false);
        $('#sub_btn').text('Update');
        if (res.status == 1) {

            Swal.fire({
               title: "Success", 
               text: res.message, 
               icon: "success"
             }).then(function (result) {
            location.reload();
            })
          
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
