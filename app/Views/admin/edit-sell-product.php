
<?php include ('include/header.php') ?>

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

/* Add some hover effects to buttons */
.form-container .btn:hover, .open-button:hover {
  opacity: 1;
}

/* button#reject {
    margin-right: 50px;
    margin-bottom: 15px;
    margin-top:20px;
    margin-left:20px;
} */
/* button#update {
    margin-right: 50px;
    margin-bottom: 15px;
    margin-top:20px;
    margin-left:20px;
} */

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
                    <div>
        			<h4 class="d-flex justify-content-between">Update Sell Product:</h4>

          <form id="edit_sellproduct" method="post" action="#" onsubmit="return edit_sellproduct(this , <?= $sell_product['id']; ?>)"  enctype="multipart/form-data">
            <div class="col-md-12 py-3">

              <div class="form-group">
                <label>User Name</label>
                <?php 
                  $userdata = $this->common_model->GetSingleData('users',array('id'=>$sell_product['user_id']));
                    
                  $username =  $userdata['first_name']." ".$userdata['last_name']?>
                <input type="text" class="form-control" value="<?php echo $username; ?>"  name="name" required placeholder="Name" readonly>
                <input type="hidden" class="form-control" value="<?= $sell_product['id']; ?>" name="id"  >
              </div>

              <div class="form-group">
                <label>Product Name</label>
                <?php 
                    $product = $this->common_model->GetSingleData('product',array('id'=>$sell_product['product_id']));
                  ?>
                <input type="text" class="form-control" value="<?php echo $product['title']; ?>"  name="name" required placeholder="Name" readonly>
              </div>

              <div class="form-group">
                <label>Product Owner</label>
                <?php 
                    $userdata = $this->common_model->GetSingleData('users',array('id'=>$sell_product['product_owner']));
                              
                    $username =  $userdata['first_name']." ".$userdata['last_name']?>
                <input type="text" class="form-control" value="<?php echo $username; ?>"  name="name" required placeholder="Name" readonly>
              </div>
              <div class="form-group">
                <label>Price</label>
                <input type="text" class="form-control ask_price" name="price" placeholder="Price" value="<?= $sell_product['price']; ?>" required>
              </div>
              <div class="inner-bis">
                                <p>Transaction Fee(10%)</p>
                                  <div class="ml-auto" >
                                    <?php $price = $sell_product['price'];
                          $trans = ($price * 10) / 100;?>
                          - HKD<span class="trans"><?= $trans ?></span>
                                  </div>
                              </div>
                              <div class="inner-bis">
                                <p>Payment proc.(3%)</p>
                                  <div class="ml-auto" >
                                    <?php $proc = ($price * 3) / 100;?>
                          - HKD<span class="prod"><?= $proc ?></span>
                                  </div>
                              </div>
                              <div class="inner-bis">
                                <p>Estimated Shipping</p>
                                  <div class="ml-auto" >
                                    Free
                                  </div>
                              </div>
              <div class="form-group">
                <label>Discount Price</label>
                <input type="text" readonly class="form-control" name="dis_price" id="dis_price" placeholder="Discount Price" value="<?= $sell_product['dis_price']; ?>" required>
              </div>
              <div class="form-group">
                <label>Expiry Date</label>
                <input type="date" min="<?php echo date('Y-m-d');?>" class="form-control" name="exp_date" placeholder="Date" value="<?= $sell_product['exp_date']; ?>" required>
              </div>
              <div class="inner-bis">
                              <p>Game condtion</p>
                                <div class="ml-auto" >
                                 <input type="range" min="1" max="100" name="game_condition" value="<?= $sell_product['game_condition'] ?>" class="slider" id="myRange">
                                 <div  class="badge badge-danger"><span id="slide_output"><?= $sell_product['game_condition'] ?></span><span>% New</span></div>
                               </div>
                            </div>
              <div class="mt-3 text-center">
                  <button type="submit"  id="update<?= $value['id']; ?>" class="btn btn-success">Update</button>
              </div>
                
                  
                </div>
           
        </form>
    
      </div>
                    
              
        		
        		  
        	   </div>
            </div>
        </div>
    </div>
</div>
<?php include ('include/footer.php') ?> 
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
  var slider = document.getElementById("myRange");
var output = document.getElementById("slide_output");
output.innerHTML = slider.value; // Display the default slider value

// Update the current slider value (each time you drag the slider handle)
slider.oninput = function() {
  output.innerHTML = this.value;
}
</script>
<script>
$(document).ready( function () {
    $('#myTable').DataTable();
} );

$('.ask_price').keyup(function()
{
  askPrice = $('.ask_price').val();
  var transPrice = (askPrice * 10)/100;
  var prodPrice = (askPrice * 3)/100;
  $('.low').text(askPrice);
  $('.trans').text(transPrice);
  $('.prod').text(prodPrice);
  var totalPrice = (askPrice - transPrice - prodPrice);
  $('.total').text(totalPrice);
  $('#dis_price').val(totalPrice);
})

function edit_sellproduct(el , id) {
    $('.alert-danger').remove();
      $.ajax({
      url: '<?= base_url() ?>/Admin/Sell_Product/update_sellproduct',
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
