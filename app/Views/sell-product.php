<?php include('include/sellHeader.php') ?>
<style>
body {font-family: Arial;}

/* Style the tab */
.tab {
  overflow: hidden;
  border: 1px solid #ccc;
  background-color: #f1f1f1;
}

/* Style the buttons inside the tab */
.tab a {
  background-color: inherit;
  float: left;
  border: none;
  outline: none;
  cursor: pointer;
  padding: 14px 82px;
  transition: 0.3s;
  font-size: 17px;
}

/* Change background color of buttons on hover */
.tab a:hover {
  background-color: #ddd;
}

/* Create an active/current tablink class */
.tab a.active {
  background-color: #ccc;
}

/* Style the tab content */
.tabcontent {
  display: none;
  padding: 6px 12px;
}
.price {
  font-size: 25px;
}
.boad {
  border-bottom: 1px dashed;
  padding-bottom: 15px;
}
.success_ul {
    list-style: disc!important;
    padding: 15px!important;
}
.inner-bis.social_share p {
    padding: 10px;
    font-size: 20px;
}
</style>
<?php 

use App\Models\Common_model;
$this->common_model = new Common_model();
$this->session = \Config\Services::session();
$this->auth_id = 0;
$this->auth = [];
$this->currency = 'HKD';
if ($this->session->has('user_id')) {
  $this->auth_id = $this->session->get('user_id');

  $this->auth = $this->common_model->GetSingleData('users' , array('id' =>$this->auth_id));
  $this->currency = $this->auth['currency'];
  //print_r($this->auth);
}

 ?>
<?php $id = $this->session->get('user_id'); 
$highestbid = get_hl_bid_price($check['id'])['grand_total'];
$lowestask = get_hl_price($check['id'])['lowest'];
$highgest_bid_order = get_hl_bid_price($check['id']);
//print_r($highgest_bid_order);
 $last_ask = $this->common_model->GetSingleData('sell_product' , array('user_id' => $id));
 $seller_info = $this->common_model->GetSingleData('seller_billing_info' , ['user_id' => $this->auth_id]); 
 $active_bid = $this->common_model->GetSingleData('orders' , array('user_id' => $this->auth_id , 'product_id' => $check['id'] , 'status' => 3));
 
?>
<div class="middle detail-page">
  	<div class="row" id="add_sell"></div>
</div>
<div class="modal fade" id="payment-meth" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  	<div class="modal-dialog modal-lg" role="document">
    	<div class="modal-content">
      		<div class="modal-header">
   				<div class="">
        			<h5 class="modal-title" id="exampleModalLabel">Billing/Shipping</h5>
    				<p class="m-0">Use Credit Card for Billing</p>
    			</div>  
        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          			<span aria-hidden="true">&times;</span>
        		</button>
      		</div>
      		<div class="modal-body">
    			<form class="form-new" id="addSell" onsubmit="return addSell(event)" method="post" action="#" enctype="multipart/form-data">
	      			<!-- Text input-->
	      			<div class="form-group">
	        			<label class="control-label">Credit Card</label>  
	        			<div class="">
	        				<input type="number" minlength="16" maxlength="16" placeholder="Card Number" name="card_number" value="<?= ($seller_info) ? $seller_info['card_number'] : '' ?>" class="form-control" required> 
	        				<input type="hidden" name="product_id" value="<?=$check['id']?>" class="form-control"> 
	        				<input type="hidden" name="user_id" value="<?=$id?>" class="form-control"> 
                  <input type="hidden" name="order_id" value="<?= ($highgest_bid_order) ? $highgest_bid_order['id'] : 0 ?>" class="form-control"> 
	        				<input type="hidden" name="price" id="price" class="form-control" > 
	        				<input type="hidden" name="dis_price" id="dis_price" class="form-control"> 
	        				<input type="hidden" name="validity_day" id="exp_date" class="form-control"> 
	        				<input type="hidden" name="status" id="sell_status" class="form-control"> 
	        				<input type="hidden" name="game_condition"  id="game_condition" class="form-control"> 
	        				<input type="hidden" name="product_owner" id="product_owner" value="<?= $check['created_by'] ?>" class="form-control"> 
	        			</div>
	      			</div>
	      			<!-- Text input-->
	      			<div class="form-group">  
	        			<div class="row">
	          				<div class="col-sm-3">
	          					<input type="month" placeholder="Expire" name="card_expire" value="<?= ($seller_info) ? $seller_info['card_expire'] : '' ?>" class="form-control" required> 
	          				</div>
	          				<div class="col-sm-3">
	          					<input minlength="3" maxlength="3" type="number" placeholder="CVV" name="card_cvv" class="form-control" value="<?= ($seller_info) ? $seller_info['card_cvv'] : '' ?>" required> 
	          				</div>
	        			</div>
	        		</div>
	        		<br>
       				<div class="row">
        				<div class="col-sm-12">
          				<!-- Text input-->
          					<div class="form-group">
            					<label class="control-label">Billing Info</label>  
            					<div class="">
            						<input type="text" placeholder="First Name" name="billing_first" value="<?= ($seller_info) ? $seller_info['billing_first'] : '' ?>" class="form-control" required> 
            					</div>
          					</div> 
          					<!-- Text input-->
          					<div class="form-group">    
            					<input type="text" placeholder="Last Name" name="billing_last" value="<?= ($seller_info) ? $seller_info['billing_last'] : '' ?>" class="form-control">  
          					</div> 
          					<!-- Text input-->
          					<div class="form-group">    
          	  				<!-- 	<select class="form-control">  
              						<option>India</option>
            					</select> -->
            					<input type="text" placeholder="Country" name="billing_country" value="<?= ($seller_info) ? $seller_info['billing_country'] : '' ?>" class="form-control" required>
          					</div>  
          					<!-- Text input-->
          					<div class="form-group">    
            					<input type="text" placeholder="Address" name="billing_address" value="<?= ($seller_info) ? $seller_info['billing_address'] : '' ?>" class="form-control">  
          					</div> 
          					<!-- Text input-->
          					<div class="form-group">    
            					<input type="text" placeholder="Address 2" name="billing_address2" value="<?= ($seller_info) ? $seller_info['billing_address2'] : '' ?>" class="form-control" required>  
          					</div> 
          					<!-- Text input-->
          					<div class="form-group">    
            					<input type="text" placeholder="City" name="billing_city" value="<?= ($seller_info) ? $seller_info['billing_city'] : '' ?>" class="form-control" required>  
          					</div> 
          					<!-- Text input-->
          					<div class="form-group">  
            					<div class="row">
              						<div class="col-sm-6">
              							<input type="text" placeholder="State/Province/Region" value="<?= ($seller_info) ? $seller_info['billing_state'] : '' ?>" name="billing_state" class="form-control" required> 
              						</div>
	              					<div class="col-sm-6">
	              						<input type="text" placeholder="Zip/Postal Code" value="<?= ($seller_info) ? $seller_info['billing_zip'] : '' ?>" name="billing_zip" class="form-control" required> 
	              					</div>
            					</div>
          					</div> 
        				</div>
      				</div>
    			
      		</div>
      		<div class="modal-footer">
        		<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> 
        		<button type="button" id="save-card"  class="btn btn-primary">Save Card</button> 
      		</div>
      		</form>
    	</div>
  	</div>
</div>
<script src="<?= base_url() ?>/assets/js/jquery.min.js"></script>
<script src="<?= base_url() ?>/assets/js/bootstrap.min.js"></script>
<script src="<?= base_url() ?>/assets/js/owl.carousel.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.4/dist/sweetalert2.all.min.js"></script>
<link rel="stylesheet" href="https://jqueryvalidation.org/files/demo/site-demos.css">
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.70/jquery.blockUI.min.js"></script>
<script>
  var highestbid = '<?= $highestbid ?>';
 jQuery.validator.setDefaults({
  debug: true,
  success: "valid"
});
 var addSell_form = $('#addSell'); 
  addSell_form.validate();
$(document).ready(function() 
{

  $('#seller').trigger('change')
  var bigimage = $("#big");
  var thumbs = $("#thumbs");
  //var totalslides = 10;
  var syncedSecondary = true;

  bigimage
    .owlCarousel({
    items: 1,
    slideSpeed: 2000,
    nav: true,
    autoplay: false,
    dots: false,
    loop: true,
    responsiveRefreshRate: 200,
    navText: [
      '<i class="fa fa-arrow-left" aria-hidden="true"></i>',
      '<i class="fa fa-arrow-right" aria-hidden="true"></i>'
    ]
  })
    .on("changed.owl.carousel", syncPosition);

  thumbs
    .on("initialized.owl.carousel", function() {
    thumbs
      .find(".owl-item")
      .eq(0)
      .addClass("current");
  })
    .owlCarousel({
    items: 4,
    dots: false,
    nav: false,
  margin:10,
    navText: [
      '<i class="fa fa-arrow-left" aria-hidden="true"></i>',
      '<i class="fa fa-arrow-right" aria-hidden="true"></i>'
    ],
    smartSpeed: 200,
    slideSpeed: 500,
    slideBy: 4,
    responsiveRefreshRate: 100
  })
    .on("changed.owl.carousel", syncPosition2);

  function syncPosition(el) {
    //if loop is set to false, then you have to uncomment the next line
    //var current = el.item.index;

    //to disable loop, comment this block
    var count = el.item.count - 1;
    var current = Math.round(el.item.index - el.item.count / 2 - 0.5);

    if (current < 0) {
      current = count;
    }
    if (current > count) {
      current = 0;
    }
    //to this
    thumbs
      .find(".owl-item")
      .removeClass("current")
      .eq(current)
      .addClass("current");
    var onscreen = thumbs.find(".owl-item.active").length - 1;
    var start = thumbs
    .find(".owl-item.active")
    .first()
    .index();
    var end = thumbs
    .find(".owl-item.active")
    .last()
    .index();

    if (current > end) {
      thumbs.data("owl.carousel").to(current, 100, true);
    }
    if (current < start) {
      thumbs.data("owl.carousel").to(current - onscreen, 100, true);
    }
  }

  function syncPosition2(el) {
    if (syncedSecondary) {
      var number = el.item.index;
      bigimage.data("owl.carousel").to(number, 100, true);
    }
  }

  thumbs.on("click", ".owl-item", function(e) {
    e.preventDefault();
    var number = $(this).index();
    bigimage.data("owl.carousel").to(number, 300, true);
  });
});

</script> 

<script>

$(document).on('change' , '.ask_price' , function()
{
  $('.meet_err').remove()
  askPrice = $('.ask_price').val();
  minAsk = <?= convert_currency($check['base_price'] , $this->currency , 'HKD') ?>;
  highBid = highestbid;
  if (minAsk > askPrice) 
  {
    $('#place_price').val('');
    $('#home').prepend('<label class="alert alert-danger meet_err">Your ask is doest not meeting with minimum ask </label>');
    return false;
    //$('#profile-tab').trigger('click');

  }
  if (parseInt(highBid) >= parseInt(askPrice)) 
  {
    if(parseInt(highBid) != 0)
    {
      $('#place_price').val('');
      $('#profile-tab').trigger('click');
    }
    
  }
  
})
$(document).on('keyup' , '.ask_price' , function()
{
  askPrice = $('.ask_price').val();
	var transPrice = (askPrice * <?= get_admin()['admin_commission'] ?>)/100;
	var prodPrice = (askPrice * <?= get_admin()['vat_tax'] ?>)/100;
	shipFee = <?= convert_currency(get_admin()['shipping_fee'] , $this->currency , 'HKD') ?>;
	$('.low').text(askPrice);
	$('.trans').text(transPrice);
	$('.prod').text(prodPrice);
  var totalPrice = (parseFloat(askPrice) - parseFloat(transPrice) - parseFloat(prodPrice) - parseFloat(shipFee)).toFixed(2);

	$('.total').text(totalPrice);
	$('.totalin').val(totalPrice);
})
$(document).on('change' , '[name="is_new"]' , function(argument) 
{
  
   if($(this).is(":checked"))
   {
      $('[name="is_new"]').prop('checked', true);
   }
   else 
   {
     $('[name="is_new"]').prop('checked', false);
   }
  
})
$(document).on('change' , '[name="is_ship_in_2_days"]' , function(argument) 
{
  
   if($(this).is(":checked"))
   {
      $('[name="is_ship_in_2_days"]').prop('checked', true);
   }
   else 
   {
     $('[name="is_ship_in_2_days"]').prop('checked', false);
   }
  
})

function addSell(event)
{ 
	event.preventDefault();	
	var data = new FormData($('#addSell')[0]);
  is_new = 0;
  is_ship_in_2_days = 0;
  if($('[name="is_new"]').is(":checked"))
  {
    is_new = 1;
  }
  if($('[name="is_ship_in_2_days"]').is(":checked"))
  {
    is_ship_in_2_days = 1;
  }
  data.append('is_ship_in_2_days' , is_ship_in_2_days);
  data.append('is_new' , is_new);
	$('.alert-danger').remove();
	$.ajax({
		url : '<?=base_url()?>/add-sell',
		type : 'post',
		data : data,
		processData : false,
		contentType : false,
		cache : false,
		dataType : 'json',
		beforeSend: function() {        

            $('#AddBtn').prop('disabled' , true);
            text = $('#AddBtn').text();
            $('#AddBtn').text('Processing..');
            clearInterval(interval);
             $.blockUI()


        },
		success  : function(result){
      $.unblockUI()
			$('#AddBtn').prop('disabled' , false);
            $('#AddBtn').text(text);
            if(result.status == 1)
        	  {
          		$('.side_sections').hide();   
                $('#sell_step_3').show(); 
        	}
        	else
        	{
          		$('.em').html(result.msg);
          		for (var err in result.message) {
        			$("[name='" + err + "']").after("<div  class='label alert-danger'>" + result.message[err] + "</div>");
        		}
          	}
		}
	}).fail(function(result) {
		$('#AddBtn').prop('disabled' , false);
            $('#AddBtn').text('Submit');
            console.log(result)
		Swal.fire({
               title: "Oops", 
               text: result.responseJSON.message, 
               icon: "error"
             }).then(function (result) {
            
            })
	});

}
<?php if ($is_already_sale): ?>
			
     window.location.href = '<?= base_url('edit-my-sell/'.$is_already_sale['product_id']) ?>'
            
		
		<?php endif; ?>

	async function getSell(d)
	{
    btn_text = $(d).text();
    $(d).prop('disabled' , true);
    $(d).text('Processing..');
    
    

		<?php if ($is_already_sale): ?>
		
        window.location.href = '<?= base_url('edit-my-sell/'.$is_already_sale['product_id']) ?>'
            	
		<?php else: ?>
		var c = $('.tabb.active').data('tab');
		var price = $('#'+c+'_price').val();
		var dis_price = $('#'+c+'_dis').val();
		var exp = 0;
		if (price == 0) {
			Swal.fire({
               title: "Oops", 
               text: 'Please insert price', 
               icon: "error"
             }).then(function (result) {
            		 $(d).prop('disabled' , false);
                  $(d).text(btn_text);
            });
             return false;
		}
    if (!addSell_form[0].checkValidity()) {
        //shipping_modal.show()
         //addSell_form.submit();
        $('#payment-meth').modal('show');
        $(d).prop('disabled' , false);
        $(d).text(btn_text);
        return false;
      };
		$('#sell_status').val(2);
		if(c == 'place')
		{
			$('#sell_status').val(1);
			exp = $('#'+c+'_exp').val();
		}
		$('#price').val(price);
		$('#dis_price').val(dis_price);
		$('#exp_date').val(exp);
		$('#game_condition').val($('#myRange').val());
		if ($('#home').hasClass('active'))
    {
      $('#ask_step_2').show();
      $('#ask_step_1').hide();
    }
   else 
   {
     $('#sell_step_2').show();
      $('#ask_step_1').hide();
   }
	<?php endif ?>
		
	}

function change_tab(text) {
  $('#review_btn').text('Review '+text);
  $('.c_btn').attr('id' , '');
  $('.'+text+'_btn').attr('id' , 'AddBtn');
}
change_tab('Ask');
 function do_checkout(e) {
    $('#addSell').submit();
  }
</script>
<script type="text/javascript">
  

  function getPageData(is_first=0) {

    $.ajax({
        url: "<?php echo base_url(); ?>/Sell/add_sell_data",
        type:"POST",
        data:{'product_id' : '<?= $check['id'] ?>' , 'highestbid' : highestbid, 'is_first' : is_first},
        dataType:'html',
        success:function(data) {
          if (data != 0) 
          {
            $('#add_sell').html(data);
            initSlider()
            highestbid = $('#highestbid_input').val()
            order_id = $('#highgest_bid_order_id').val()
            $('[name="order_id"]').val(order_id)
            $('#seller').trigger('change')
            initrangeslider()
            
          }
          
          
        }
      });
  }

  var interval = setInterval(getPageData, 2000);
  $(function () {
    getPageData(1)
  });

  function initrangeslider() 
  {
    var slider = document.getElementById("myRange");
            var output = document.getElementById("slide_output");
            output.innerHTML = slider.value; // Display the default slider value

            // Update the current slider value (each time you drag the slider handle)
            slider.oninput = function() {
              output.innerHTML = this.value;
            }
  }
  function initSlider() {
    var bigimage = $("#big");
  var thumbs = $("#thumbs");
  //var totalslides = 10;
  var syncedSecondary = true;

  bigimage
    .owlCarousel({
    items: 1,
    slideSpeed: 2000,
    nav: true,
    autoplay: false,
    dots: false,
    loop: true,
    responsiveRefreshRate: 200,
    navText: [
      '<i class="fa fa-arrow-left" aria-hidden="true"></i>',
      '<i class="fa fa-arrow-right" aria-hidden="true"></i>'
    ]
  })
    .on("changed.owl.carousel", syncPosition);

  thumbs
    .on("initialized.owl.carousel", function() {
    thumbs
      .find(".owl-item")
      .eq(0)
      .addClass("current");
  })
    .owlCarousel({
    items: 4,
    dots: false,
    nav: false,
  margin:10,
    navText: [
      '<i class="fa fa-arrow-left" aria-hidden="true"></i>',
      '<i class="fa fa-arrow-right" aria-hidden="true"></i>'
    ],
    smartSpeed: 200,
    slideSpeed: 500,
    slideBy: 4,
    responsiveRefreshRate: 100
  })
    .on("changed.owl.carousel", syncPosition2);

  function syncPosition(el) {
    //if loop is set to false, then you have to uncomment the next line
    //var current = el.item.index;

    //to disable loop, comment this block
    var count = el.item.count - 1;
    var current = Math.round(el.item.index - el.item.count / 2 - 0.5);

    if (current < 0) {
      current = count;
    }
    if (current > count) {
      current = 0;
    }
    //to this
    thumbs
      .find(".owl-item")
      .removeClass("current")
      .eq(current)
      .addClass("current");
    var onscreen = thumbs.find(".owl-item.active").length - 1;
    var start = thumbs
    .find(".owl-item.active")
    .first()
    .index();
    var end = thumbs
    .find(".owl-item.active")
    .last()
    .index();

    if (current > end) {
      thumbs.data("owl.carousel").to(current, 100, true);
    }
    if (current < start) {
      thumbs.data("owl.carousel").to(current - onscreen, 100, true);
    }
  }

  function syncPosition2(el) {
    if (syncedSecondary) {
      var number = el.item.index;
      bigimage.data("owl.carousel").to(number, 100, true);
    }
  }

  thumbs.on("click", ".owl-item", function(e) {
    e.preventDefault();
    var number = $(this).index();
    bigimage.data("owl.carousel").to(number, 300, true);
  });

  }

  $(document).on('change' , '.is_final_check' , function(){
    const checkboxes = $('.is_final_check');
    const submitButton = $('.to_disable');

      if (this.checked) {
        this.disabled = true;
      }

    if (checkboxes.filter(':checked').length === checkboxes.length) {
      submitButton.removeClass('disabled');
    } else {
      submitButton.addClass('disabled');
    }
  
  })
  $('#save-card').on('click' , function()
  {
    if($('#addSell').valid())
    {
      $('#payment-meth').modal('hide')
    }
  })
</script>