
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
            <div class="col-md-9">
        		<div class="table-part">
          <div>
        			<h4 class="d-flex justify-content-between">Sell Product Details:</h4>
                    <div class="row">
                        <div class="col-md-6">User Name</div>
                        <div class="col-md-6"><b><?php 
                            $userdata = $this->common_model->GetSingleData('users',array('id'=>$sell_product['user_id']));
                              
                            echo $userdata['first_name']." ".$userdata['last_name']?></b></div>
                   </div>
                  <hr>
                  
                  <div class="row">
                        <div class="col-md-6">product Name</div>
                        <div class="col-md-6"><b><?php 
                          $product = $this->common_model->GetSingleData('product',array('id'=>$sell_product['product_id']));
                            
                          echo $product['title']?></b></div>
                   </div>
                  <hr>

                   <div class="row">
                        <div class="col-md-6">product Owner</div>
                        <div class="col-md-6"><b><?php 
                            $userdata = $this->common_model->GetSingleData('users',array('id'=>$sell_product['product_owner']));
                              
                            echo $userdata['first_name']." ".$userdata['last_name']?></b></div>
                   </div>
                  <hr>

                  <div class="row">
                        <div class="col-md-6">Status</div>
                        <div class="col-md-6"><b><?php
                           if($value['status'] == 1)
                           {
                            echo "<span Class='badge badge-success'>Bid Price</span>";
                           }else
                           {
                            echo "<span Class='badge badge-primary'>Original Price</span>";
                           }
                        ?></b></div>
                   </div>
                  <hr>
                   <div class="row">
                    <div class="col-md-6">Price</div>
                    <div class="col-md-6"><b>HKD<?= $sell_product['price']; ?></b></div>
                   </div>
                <hr>
                 <div class="row">
                    <div class="col-md-6">Discount Price</div>
                    <div class="col-md-6"><b>HKD<?= $sell_product['dis_price']; ?></b></div>
                   </div>
                <hr>
                 <div class="row">
                    <div class="col-md-6">Expiry Date</div>
                    <div class="col-md-6"><b><?= $sell_product['exp_date']; ?></b></div>
                   </div>
                <hr>

                <h4 class="d-flex justify-content-between">Billing Detail:</h4>

                <div class="row">
                    <div class="col-md-6"><label>Card Number</label></div>
                    <div class="col-md-6"><b><?= $sell_product['card_number']; ?></b></div>
                   </div>
                <hr>
                  <div class="row">
                    <div class="col-md-6"><label>Card CVV Number</label></div>
                    <div class="col-md-6"><b><?= $sell_product['card_cvv']; ?></b></div>
                   </div>
                <hr>
                <div class="row">
                    <div class="col-md-6"><label>Billing First</label></div>
                    <div class="col-md-6"><b><?= $sell_product['billing_first']; ?></b></div>
                   </div>
                <hr>
                 <div class="row">
                    <div class="col-md-6"><label>Billing Last</label></div>
                    <div class="col-md-6"><b><?= $sell_product['billing_last']; ?></b></div>
                   </div>
                <hr>
                 <div class="row">
                    <div class="col-md-6"><label>Billing Country</label></div>
                    <div class="col-md-6"><b><?= $sell_product['billing_country']; ?></b></div>
                   </div>
                <hr>
                  <div class="row">
                    <div class="col-md-6"><label>Billing State</label></div>
                    <div class="col-md-6"><b><?= $sell_product['billing_state']; ?></b></div>
                   </div>
                <hr>
                  <div class="row">
                    <div class="col-md-6"><label>Billing City</label></div>
                    <div class="col-md-6"><b><?= $sell_product['billing_city']; ?></b></div>
                   </div>
                <hr>
                <div class="row">
                    <div class="col-md-6"><label>Billing Address</label></div>
                    <div class="col-md-6"><b><?= $sell_product['billing_address']; ?></b></div>
                   </div>
                <hr>
                <div class="row">
                    <div class="col-md-6"><label>Alternate Billing Address</label></div>
                    <div class="col-md-6"><b><?= $sell_product['billing_address2']; ?></b></div>
                   </div>
                <hr>
                <div class="row">
                    <div class="col-md-6"><label>Billing Zipcode</label></div>
                    <div class="col-md-6"><b><?= $sell_product['billing_zip']; ?></b></div>
                   </div>
                <hr>

           </div>
                    
             </div>
            </div>
        </div>
    </div>
</div>
<?php include ('include/footer.php') ?> 
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

<script>
$(document).ready( function () {
    $('#myTable').DataTable();
} );

function add_product() {
  $('.alert-danger').remove();
    
      $.ajax({
      url: '<?= base_url() ?>/Admin/Product/addproduct',
      type: 'POST',
      cache:false,
      contentType: false,
      processData: false,
      data:new FormData($('#add_product')[0]),
      dataType: 'json',
      beforeSend: function() {        
        $('#add_btn').prop('disabled' , true);
        $('#add_btn').text('Processing..');
      },
      success : function(res){
        $('#add_btn').prop('disabled' , false);
        $('#add_btn').text('Add');
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
          for (var err in res.message) {
            
            $("[name='" + err + "']").after("<div  class='label alert-danger'>" + res.message[err] + "</div>");
          }
        }
      }
    });
return false;    
}
function edit_product(el , id) {
    $('.alert-danger').remove();
      $.ajax({
      url: '<?= base_url() ?>/Admin/Product/updateproduct',
      type: 'POST',
      cache:false,
      contentType: false,
      processData: false,
      data:new FormData($(el)[0]),
      dataType: 'json',
      beforeSend: function() {        
        $('#update'+id).prop('disabled' , true);
        $('#update'+id).text('Processing..');
      },
      success : function(res){
        $('#update'+id).prop('disabled' , false);
        $('#update'+id).text('Update');
        if (res.status == 1) {
            Swal.fire({
               title: "Success", 
               text: res.message, 
               icon: "success"
             }).then(function (result) {
            window.location.reload();
            })         
        }
        else
        {
         
          $('#result').html(res.message);
          for (var err in res.message) {
            
            $("[name='" + err + "']").after("<div  class='label alert-danger'>" + res.message[err] + "</div>");
          }
        }
      }
    });
return false;    
}

function delete_product(id) {
        // event.preventDefault();
    if(confirm('Are you sure ?'))
    {
        $.ajax({
      url: '<?= base_url() ?>/Admin/Product/deleteproduct',
      type: 'POST',
      cache:false,
      data:{'id':id},
      dataType: 'json',
      beforeSend: function() {
        $('#delete_btns'+id).prop('disabled' , true);
        $('#delete_btns'+id).text('Processing..');
      },
      success : function(res){
        console.log(res);
        $('#delete_btns'+id).prop('disabled' , false);
        if (res.status == 1) {
           Swal.fire({
               title: "Success", 
               text: res.message, 
               icon: "success"
             }).then(function (result) {
            location.reload();
            })
        }
        
      }
    });
    }
    
}

function delete_product_image(id) {
        // event.preventDefault();
    if(confirm('Are you sure ?'))
    {
     $.ajax({
      url: '<?= base_url() ?>/Admin/Product/remove_pimage',
      type: 'POST',
      cache:false,
      data:{'id':id},
      dataType: 'json',
      beforeSend: function() {
        $('#delete_btns'+id).prop('disabled' , true);
        $('#delete_btns'+id).text('Processing..');
      },
      success : function(res){
        console.log(res);
        $('#delete_btns'+id).prop('disabled' , false);
        if (res.status == 1) {
         
         location.reload();

        }
        
      }
    });
    }
    
}

</script>

<script>
$(document).ready(function() {
  //alert('hello');
  $('#category').on('change', function() {
      var category_id = this.value;
      $.ajax({
        url: '<?= base_url() ?>/Admin/Product/getsubcat',
        type: "POST",
        data: {
          category_id: category_id
        },
        cache: false,
        success: function(dataResult){
          $("#sub_category").html(dataResult);
        }
      });
    
    
  });
});
</script>

<script>
function fetchsubcat(id)
{
  //alert('hello');
  //alert(id)
  var category_id = id;
      $.ajax({
        url: '<?= base_url() ?>/Admin/Product/getsubcat',
        type: "POST",
        data: {
          category_id: category_id
        },
        cache: false,
        success: function(dataResult){
          $("#editsub_category").html(dataResult);
        }
      });
    
}
  
</script>
