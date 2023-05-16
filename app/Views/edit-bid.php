<?php include ('include/header.php') ?>
<style type="text/css">
  label.error {
    color: #bd0b0b;
}
tr.my-ask
{
  position: relative;
}
tr.my-ask td:before {
    content: 'Your ask';
    background: #fff;
    font-size: 12px;
    position: absolute;
    padding: 0px 10px;
    left: 0;
    top: -3px;
}
tr.my-bid
{
  position: relative;
}
tr.my-bid td:before {
    content: 'Your bid';
    background: #fff;
    font-size: 12px;
    position: absolute;
    padding: 0px 10px;
    left: 0;
    top: -3px;
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
$this->user_id =  $this->session->get('user_id');
 $check = false; 
    if($this->user_id){
     $check = $this->common_model->GetSingleData('wishlist' , array('user_id'=>$this->user_id,'product_id' => $product['id'] )); 
     }
$highestbid = convert_currency(get_hl_bid_price($product['id'])['grand_total'], $this->currency , 'HKD');
$lowestask = convert_currency(get_hl_price($product['id'])['lowest'], $this->currency , 'HKD');
//print_r(generate_token());
?>
<div class="middle detail-page">
  <div class="row" id="edit_bid"></div>
</div>
<?php include ('include/footer.php') ?>
<script>
  function change_sdk (intent) 
  {
    var img = document.querySelector("#paypal_sdk_js");
    var src = img.src;
  
    if(intent == 'authorize')
    {
      $('#sell_product_id').val(0)
      img.src = src.replace('capture', intent);
    }
    else
    {
      $('#seller').trigger('change')
      img.src = src.replace( 'authorize' ,intent);
    }
     console.log(img.src);
      
  }


</script> 





<!-- Modal -->
<div class="modal fade" id="info-shopping" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
    <div class="">
        <h5 class="modal-title" id="exampleModalLabel">Shipping</h5>
    <p class="m-0">Please provide your shipping info</p>
    </div>  
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="checkout_form" onsubmit="return do_checkout(event)" method="post" enctype="multipart/form-data" >
      <div class="modal-body">

    <!-- Text input-->
    <div class="form-group">
      <label class="control-label">Shipping Info</label>  
      <div class="">
      <input type="text" required name="f_name" placeholder="First Name" class="form-control" value="<?= $edit['f_name'] ?>"> 
      <input type="hidden"  name="sell_product_id" id="sell_product_id" value="0"> 
      <input type="hidden"  name="product_id" id="product_id" value="<?= $product["id"] ?>"> 
      <input type="hidden"  name="grand_total" id="grand_total" value="<?= convert_currency($edit['grand_total'], $this->currency , 'HKD') ?>"> 
      <input type="hidden"  name="total_amount" id="total_amount" value="<?= convert_currency($edit['grand_total'] + $edit['admin_fee'], $this->currency , 'HKD')  ?>"> 
      <input type="hidden"  name="payment_method" id="payment_method" value="<?= $edit['payment_method'] ?>"> 
      <input type="hidden"  name="expire_day" value="<?= $edit['expire_day'] ?>"> 
      <input type="hidden"  name="order_id" value="<?= $edit['id'] ?>">  
      </div>
    </div> 
    <!-- Text input-->
    <div class="form-group">    
      <input type="text"  name="l_name" placeholder="Last Name" class="form-control" value="<?= $edit['l_name'] ?>">  
    </div> 
    <!-- Text input-->
    <div class="form-group">    
      <input type="text"  name="country" placeholder="Country" class="form-control" value="<?= $edit['country'] ?>">  
    </div> 
    <!-- Text input-->
    <div class="form-group">    
      <input type="text" required name="address" placeholder="Address" class="form-control" value="<?= $edit['address'] ?>">  
    </div> 
    <!-- Text input-->
    <div class="form-group">    
      <input type="text"  name="address2" placeholder="Address 2" class="form-control" value="<?= $edit['address2'] ?>">  
    </div> 
    <!-- Text input-->
    <div class="form-group">    
      <input type="text" required name="city" placeholder="City" class="form-control" value="<?= $edit['city'] ?>">  
    </div> 
    <!-- Text input-->
    <div class="form-group">  
      <div class="row">
        <div class="col-sm-6">
        <input type="text" required name="state" placeholder="State/Province/Region" class="form-control" value="<?= $edit['state'] ?>"> 
        </div>
        <div class="col-sm-6">
        <input type="text" required name="zipcode" placeholder="Zip/Postal Code" class="form-control" value="<?= $edit['zipcode']?>"> 
        </div>
      </div>
    </div> 
      </div>
      <div class="modal-footer">
        
        <button type="button" class="btn btn-primary" data-dismiss="modal" aria-label="Close" >Update Shipping</button> 
      </div>
    </form>
    </div>
  </div>
</div>
<div class="modal fade" id="latest_paypal_modal" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content stripe">
      <div class="modal-header">
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title">Pay with Paypal</h4>
      </div>  
        <div class="modal-body">
          <div class="man_box_walt">
            <div class="wollt1">
              <h3 class="text"> <i class="fa fa-money"></i> Amount <span><?= $this->currency ?><span class="latest-paypal-deposit-amount"></span></span> </h3>
              
            <div class="form-group">
              <div class="pay_btn paypal_btn" id="paypal_btn"></div>
            </div>
            </div>
            
          </div>
          
          
          
        
        </div>
        
    </div>
  </div>
</div>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
<script id="paypal_sdk_js" src="https://www.paypal.com/sdk/js?client-id=<?= paypal_client_id ?>&intent=authorize&currency=<?= $this->currency ?>"></script>
<!-- <script src="https://www.paypal.com/sdk/js?client-id=<?= paypal_client_id ?>"></script> -->
<script>
var lowestask = <?= $lowestask ?>;
var highestbid = <?= $highestbid ?>;
var latest_paypal_modal = new bootstrap.Modal(document.getElementById('latest_paypal_modal'), {
  keyboard: false,
  backdrop: 'static',
})
var shipping_modal = new bootstrap.Modal(document.getElementById('info-shopping'), {
  keyboard: false,
  backdrop: 'static',
})
var site_url = '<?= base_url() ?>'  
var checkout_form = $('#checkout_form');
checkout_form.validate();
function sub_check(d)
{
   btn_text = $(d).text();
   $(d).prop('disabled' , true);
   $(d).text('Processing..');

  setTimeout(function () 
  {
   $(d).prop('disabled' , false);
   $(d).text(btn_text);
   if (!checkout_form[0].checkValidity()) {
    //shipping_modal.show()
    $('#info-shopping').modal('show')
    return false;
  };
  if($('[name="payment"]:checked').val() == 'paypal')
  {
    var total = $('#final_price_buy').val();
    var bid_total = $('.price-total').text();
   intent = "CAPTURE";
   if ($('#home').hasClass('active'))
   {
      intent = "AUTHORIZE";
      total = $('#final_price_bid').text();
      bid_total = $('.bid_price').val();
      $('#sell_product_id').val();
   }
   if(total == 0)
{
  alert('Please enter valid amount');
  return false;
}
  if ($('#home').hasClass('active'))
   {
      $('#bid_step_2').show();
      $('#bid_step_1').hide();
   }
   else {
     $('#buy_step_2').show();
      $('#bid_step_1').hide();
   }
  //checkout_form.submit();
}
 else
  {
    //checkout();
    alert('Please choose payment gateway');
  }

  }, 1000)
  
}
  function do_checkout (e) {
    e.preventDefault()
  if (!checkout_form[0].checkValidity()) {
    //shipping_modal.show()
    $('#info-shopping').modal('show')
    return false;
  };
  //shipping_modal.hide();
  $('#info-shopping').modal('hide')
  if($('[name="payment"]:checked').val() == 'paypal')
  {
    var total = $('#final_price_buy').val();
    var bid_total = $('.price-total').text();
   intent = "CAPTURE";
   if ($('#home').hasClass('active'))
   {
      intent = "AUTHORIZE";
      total = $('#final_price_bid').text();
      bid_total = $('.bid_price').val();
      $('#sell_product_id').val();
   }
   if(total == 0)
{
  alert('Please enter valid amount');
  return false;
}
    PaymentGetway(total , 'checkout' , '' , intent);
    expire_day = $('#expire_day').val()
    $('.latest-paypal-deposit-amount').text(total);
    $('#grand_total').val(bid_total);
    $('#total_amount').val(total);
    $('#payment_method').val('paypal');
    $('[name="expire_day"]').val(expire_day);
    
    latest_paypal_modal.show()

  }
  else
  {
    //checkout();
    alert('Please choose payment gateway');
  }
  
}

function PaymentGetway(amt, type, planId='' , intent) {


  $('#paypal_btn').html('');
 
 paypal.Buttons({ 
  createOrder: function(data, actions) { 
 // This function sets up the details of the transaction, including the amount and line item details. 
 return actions.order.create({intent:intent , purchase_units: [{ amount: { value: amt } }] }); 
  }, 
 onApprove: function(data, actions) { 
 
   if (intent == "AUTHORIZE") 
   {
   // console.log(data); return;
      $("#checkout_form").append('<input type="hidden" name="payment_id" value="'+data.orderID+'">');
         //$("#support_cause").append('<input type="hidden" name="status" value="'+details.status+'">');
         checkout();
         return true;
   }
    return actions.order.capture().then(function(details) { 

        if (type == 'checkout') 
        {

         $("#checkout_form").append('<input type="hidden" name="payment_id" value="'+details.id+'">');
         //$("#support_cause").append('<input type="hidden" name="status" value="'+details.status+'">');
         checkout()
            
        } 

    }); 
  } 
  }).render('#paypal_btn'); 
  

  }
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
$(document).on('change' , '[name="in_original_box"]' , function(argument) 
{
  
   if($(this).is(":checked"))
   {
      $('[name="in_original_box"]').prop('checked', true);
   }
   else 
   {
     $('[name="in_original_box"]').prop('checked', false);
   }
  
})
$(document).on('change' , '[name="verified_authentic"]' , function(argument) 
{
  
   if($(this).is(":checked"))
   {
      $('[name="verified_authentic"]').prop('checked', true);
   }
   else 
   {
     $('[name="verified_authentic"]').prop('checked', false);
   }
  
})
  function checkout () 
  {
    data = new FormData($('#checkout_form')[0]);
    is_new = 0;
    in_original_box = 0;
    verified_authentic = 0;
    if($('[name="is_new"]').is(":checked"))
    {
      is_new = 1;
    }
    if($('[name="in_original_box"]').is(":checked"))
    {
      in_original_box = 1;
    }
    if($('[name="verified_authentic"]').is(":checked"))
    {
      verified_authentic = 1;
    }
    data.append('is_new' , is_new);
    data.append('in_original_box' , in_original_box);
    data.append('verified_authentic' , verified_authentic);

  latest_paypal_modal.hide()  
  $.ajax({
        url: "<?php echo base_url(); ?>/Shop/edit_checkout_form",
        type:"POST",
        cache:false,
        contentType: false,
        processData: false,
        data:data,
        dataType:'json',
        beforeSend:function(data) 
        {
          $.blockUI()
        },
        success:function(data) {
          $.unblockUI()
          if (data.status == 1) {
            $('.side_sections').hide();   
                $('#bid_step_3').show(); 
            
          } 
          else 
          {
            $("#MessageErr").html('<p class="alert alert-danger">'+data.message+'</p>');
            $('#AddBtn').prop('disabled', false);
            $('.btn-load').hide();
          }
        }
      });
 }

 $(document).on('change', '#seller' ,function() {
  //alert('hii')
   var sell_product_id = $(this).val();
   var price = $(this).find('option:selected').data('price');
   if (sell_product_id) 
   {
     $('#sell_product_id').val(sell_product_id);
   }

   $('.price-total').text(price);

 });

$(document).on('change' , '.bid_price' , function()
{
  bidPrice = $('.bid_price').val();
  
 if (parseInt(lowestask) <= parseInt(bidPrice))
  {
    if(parseInt(lowestask) != 0)
    {
      $('.bid_price').val('');
      $('#profile-tab').trigger('click');
    }
    
  }
  
})
$(document).on('keyup' , '.bid_price' , function()
{
  bidPrice = $('.bid_price').val();
  var transPrice = <?= convert_currency(get_admin()['bid_processing_fee'] , $this->currency , 'HKD') ?>;
  var prodPrice = 0;
  // var prodPrice = (bidPrice * <?= get_admin()['vat_tax'] ?>)/100;
  $('.low').text(bidPrice);
  $('.trans').text(transPrice);
  $('.prod').text(prodPrice);
  shipFee = <?= convert_currency(get_admin()['shipping_fee'] , $this->currency , 'HKD') ?>;
  var totalPrice = (parseInt(bidPrice) + parseInt(transPrice) + parseInt(prodPrice) + parseInt(shipFee));
  $('.total').text(totalPrice);
  $('.totalin').val(totalPrice);
  if (parseInt(highestbid) < parseInt(bidPrice)) 
  {
    $('.placedata').find('h5').text('You are about to be the highest bidder')
  }
  else if (parseInt(highestbid) == parseInt(bidPrice))
  {
    $('.placedata').find('h5').text('You are about to match the highest Bid. Their Bid will be accepted before yours')
  }
  else
  {
    $('.placedata').find('h5').text('You are not the highest Bid')
  }
})
</script>
<script type="text/javascript">


  function getPageData(is_first=0) {

    $.ajax({
        url: "<?php echo base_url(); ?>/Shop/edit_bid_data",
        type:"POST",
        data:{'product_id' : '<?= $product['id'] ?>' , 'lowestask' : lowestask, 'highestbid' : highestbid, 'is_first' : is_first},
        dataType:'html',
        success:function(data) {
          if (data != 0) 
          { 
            if (data == 1) 
            {
              clearInterval(interval);
              if ($("#bid_step_3").is(":visible")) {
                return false;
              }
               Swal.fire({
               title: "Warning", 
               text: 'Your bid has been taken, please check the completed record', 
               icon: "warning"
               }).then(function (result) {
                  window.location.href = '<?= base_url('buy-orders') ?>'


              })
               return false;
            }
            $('#edit_bid').html(data);
            initSlider()
            lowestask = $('#lowest_ask_input').val()
            highestbid = $('#highest_bid_input').val()
            $('.bid_price').keyup();
           
          }
          
          
        }
      });
  }

  var interval = setInterval(getPageData, 2000);
  $(function () {
    getPageData(1)
  });

  function initSlider(argument) {
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
</script>