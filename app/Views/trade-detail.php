<?php include ('include/header.php') ?>
<?php 
  
  $grades = $this->common_model->GetSingleData('class_type' , array('id'=>$product["class_type"])); 

$this->user_id =  $this->session->get('user_id');

$shipping_info = $this->common_model->GetSingleData('user_shipping_info' , ['user_id' => $this->user_id]); 

?>

<style type="text/css">
  ul.games_list {
    border-bottom: 1px dashed;
    list-style: none;
    height: 300px;
    overflow-x: scroll;
}
</style>
<div class="middle detail-page">
  <div class="row" id="trade_detail">
     <div class="col-sm-6"> 
      <h3><?= $product["title"]; ?>
          <span class="add-fav badge <?= $grades["class_color"] ?>" >
            Grade <?= $grades["class_name"]; ?>
          </span>
        </h3>
      <div class="left-detail-image"> 
        <?php if ($in_hand_game): ?>
          <?php $in_hand_game = 1; ?>
          <div class="alert alert-warning">This game appears in your exchange list,  you may already have it</div>
        <?php else: ?>
          <?php $in_hand_game = 0; ?>
        <?php endif ?>   
        <div class="outer">
          <div id="big" class="owl-carousel owl-theme">
            <?php if ($product["product_video"]): ?>
                  <?php 
                  $vidname = explode('.', $product["product_video"]);
                  $ext = end($vidname);
                   ?>
                  <div class="item">
                  <video width="100%" height="300px" autoplay loop muted >
                    <source src="<?php echo base_url($product["product_video"]);?>" type="video/<?= $ext ?>">
                  Your browser does not support the video tag.
                  </video>
                </div>
                <?php endif ?>
            <?php

              if ($product_image) {
               foreach ($product_image as $keyp => $product_imageV) {
                 ?>
                        <div class="item">
                        <img src="<?= base_url($product_imageV["image"]) ?>">
                        </div> 

                 <?php
               }
             } ?>  
          </div>
          <div id="thumbs" class="owl-carousel owl-theme">
             <?php if ($product["product_video"]): ?>
                  <?php 
                  $vidname = explode('.', $product["product_video"]);
                  $ext = end($vidname);
                   ?>
                  <div class="item">
                  <video width="100%" height="100px" autoplay loop muted >
                    <source src="<?php echo base_url($product["product_video"]);?>" type="video/<?= $ext ?>">
                  Your browser does not support the video tag.
                  </video>
                </div>
                <?php endif ?>
             <?php
              if ($product_image) {
               foreach ($product_image as $keyp => $product_imageV) {
                 ?>
                  <div class="item">
                  <img src="<?= base_url($product_imageV["image"]) ?>">
                  </div>
                 <?php
               }
             } ?>   
             
          </div>
        </div>
      </div>
      <div class="right-detail-text"> 
        
        <ul>
          <li><b>FORMATE:</b> <?= $product["format"]; ?><br></li>
           <li>
            <?php
              $category = $this->common_model->GetSingleData("categories", array("id"=>$product["category"]));
              $sub_category = $this->common_model->GetSingleData("categories", array("id"=>$product["subcategory"]));
              echo $category["title"].' '.$sub_category["title"]; 
            ?>
            </li>
            <li>Release_date: <?= $product["release_date"]; ?></li>
        </ul>
        <p><?= $product["description"]; ?></p>
      </div>
    </div>
    <div class="col-sm-6">
      <div class="d-flex justify-content-between mt-2 mb-3">
        <h2>Select game to Exchange</h2> 

        <?php if ($this->auth): ?>
          <a href="<?= base_url('add-exchange') ?>" class="btn btn-primary">Add game to list +</a>
        <?php else: ?>
          <a href="<?= base_url('login') ?>" class="btn btn-primary">Add game to list +</a>
        <?php endif ?>
        
      </div>
      <div class="warning-msg">
        <?php if ($exchange_in_process): ?>
          <?php $exchange_in_process = 1; ?>
          <?php $disabled = 'disabled'; ?>
          <div class="alert alert-danger">This game exchange has already been processed. Please allow the current exchange to complete, then try again</div>
        <?php else: ?>
          <?php $exchange_in_process = 0; ?>
          <?php $disabled = ''; ?>
        <?php endif ?>
      </div>
      <ul class="games_list hide_after_succ">
        <?php if ($exchange_list): ?>

        <?php foreach ($exchange_list as $key => $val): ?>
          <?php 
          $check = $this->common_model->GetSingleData('exchange_order','user_id='.$this->user_id.' AND FIND_IN_SET('.$val['p_id'].' , exchnage_product_id) AND (status = 0 OR status = 1)');
            if ($val['p_id'] == $product['id'] ) {
              continue;
            }
            if (!$exchange_in_process) {
              if ($check) 
              {
                $disabled = 'disabled';
              }
              else
              {
                $disabled = '';
              }
            }
           ?>
         <li class=" border my-2">        
            <label class="w-100"><div class="row align-items-center"> 
                
            <div class="col-md-4"> 
              <input type="checkbox" <?= $disabled ?> class="ex_checkbox"  value="<?= $val["p_id"] ?>" onchange="trade_this(this , <?= $val["p_id"] ?>)">    
            <?php $image = $this->common_model->GetSingleData('product_image',array('product_id'=> $val['p_id']));  ?>
            <?php $grades = $this->common_model->GetSingleData('class_type' , array('id'=>$val["class_type"]));   ?>
            <img width="50px" src="<?= base_url() ?>/<?= $image['image'] ?>"> 
            </div> 
            <div class="col-md-4">
                <h6><?= $val['title'] ?> </h6>
               
            <p><?= substr(strip_tags($val['description']), 0, 50) ?>...</p>
            </div>
            <div class="col-md-4">
             
                <?= gradeName($val['class_type']) ?>
              
            </div>
            </div></label>
            </li>
          <?php endforeach ?>
          <?php else: ?>
            <li class="alert alert-danger"> No games found in exchange list please add games</li>
          <?php endif; ?>
      </ul>
      
      <div class="p_data">
        
      </div>
    </div>
    </div>
  </div>
</div>
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
      <input type="text" required name="f_name" placeholder="First Name" class="form-control" value="<?= ($shipping_info) ? $shipping_info['first_name'] : '' ?>"> 
      <input type="hidden"  name="product_id" id="product_id" value="<?= $product["id"] ?>"> 
      <input type="hidden"  name="exchange_product_ids" id="exchange_product_ids" value="" required> 
      <input type="hidden"  name="step_charge" id="step_charge" > 
      <input type="hidden"  name="total_amount" id="total_amount" > 
      <input type="hidden"  name="payment_method" id="payment_method" > 
      </div>
    </div> 
    <!-- Text input-->
    <div class="form-group">    
      <input type="text"  name="l_name" placeholder="Last Name" class="form-control" value="<?= ($shipping_info) ? $shipping_info['last_name'] : '' ?>">  
    </div> 
    <!-- Text input-->
    <div class="form-group">    
        <input type="text"  name="country" placeholder="Country" class="form-control" value="<?= ($shipping_info) ? $shipping_info['country'] : '' ?>">  
    </div>  
    <!-- Text input-->
    <div class="form-group">    
      <input type="text" required name="address" placeholder="Address" class="form-control" value="<?= ($shipping_info) ? $shipping_info['address'] : '' ?>">  
    </div> 
    <!-- Text input-->
    <div class="form-group">    
      <input type="text"  name="address2" placeholder="Address 2" class="form-control" value="<?= ($shipping_info) ? $shipping_info['address2'] : '' ?>">   
    </div> 
    <!-- Text input-->
    <div class="form-group">    
      <input type="text" required name="city" placeholder="City" class="form-control" value="<?= ($shipping_info) ? $shipping_info['city'] : '' ?>">  
    </div> 
    <!-- Text input-->
    <div class="form-group">  
      <div class="row">
        <div class="col-sm-6">
        <input type="text" required name="state" placeholder="State/Province/Region" class="form-control" value="<?= ($shipping_info) ? $shipping_info['state'] : '' ?>"> 
        </div>
        <div class="col-sm-6">
        <input type="text" required name="zipcode" placeholder="Zip/Postal Code" class="form-control" value="<?= ($shipping_info) ? $shipping_info['zipcode'] : '' ?>"> 
        </div>
      </div>
    </div> 
      </div>
      <div class="modal-footer">
     
        <button type="button" class="btn btn-primary" data-dismiss="modal" aria-label="Close" >Save Shipping</button> 
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
<?php include ('include/footer.php') ?>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
<script id="paypal_sdk_js" src="https://www.paypal.com/sdk/js?client-id=<?= paypal_client_id ?>&intent=authorize&currency=<?= $this->currency ?>"></script>
<script type="text/javascript">
  jQuery(document).ready(function($) {
    initSlider()
  });
   function initSlider(id="") {
    var bigimage = $("#big"+id);
  var thumbs = $("#thumbs"+id);
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
<script>
 

  function delete_div(id )
  {
    elem = $('.ex_checkbox[value="'+id+'"]')
    elem.prop('checked', false)
    elem.trigger('change')
   
  }
  var disabled_checkbox = $('.ex_checkbox:disabled');
  function trade_this(elem , product_id) {
    blockui('show')
    $('.too_manyy').remove();
    $('.ex_checkbox').prop('disabled', false);
    disabled_checkbox.prop('disabled', true);
    class_type = <?= $product['class_type'] ?>;
    ids = [0];
      if($(elem).is(':checked'))
      {
        ids.push(product_id)
      }
    $('.ex_checked').each(function(index, el) {
      id = $(el).data('id');
      if(id != product_id)
      {
        ids.push(id)
      }
    });
    console.log(ids)
    $.ajax({
      url: '<?=base_url()?>/Trade/trade_this',
      type: 'post',
      data: {ids: ids , product_id: <?= $product['id'] ?> , class_type: class_type , exchange_in_process: '<?= $exchange_in_process ?>' },
      dataType: 'json',
      success: function(data){
        blockui('hide')
        if (data.status == 0) {
          Swal.fire({
               title: "Error", 
               text: data.message, 
               icon: "error"
             }).then(function (result) {
            
            })
            return false;      
        }
        $('.p_data').html(data.html);
        //$('.search-wrapper').hide();
        if ($('#qty_zyadahogai').length) 
        {
          $('.ex_checkbox').prop('disabled', true);
          $('.ex_checkbox:checked').prop('disabled', false);
          if ($('.ex_checkbox:checked').length > 1) 
          {
            if ($('#point_zyadahogai').length) 
            {
              $('.warning-msg').html('<div class="alert alert-danger too_manyy">Too many games selected for exchange</div>');
            }
          }
          
        }
         $('.datas').html('');
         initSlider(2)
      }
    })
  }
  function change_trade() {
   
    $('#trade_product_data').html('');
    $('.search-wrapper').show();
    $('.datas').html('');
      
  }

  $(document).on('change', '#agree_to_pay', function(event) {
    event.preventDefault();
    if ($(this).is(':checked')) 
    {
       $('#proceed_btn').removeClass('disabled');
    }
    else
    {
      $('#proceed_btn').addClass('disabled');
      
    }
  });
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
    var total = $('#final_price_ex').text();

    var step_total = $('.step_charge').text();
   intent = "AUTHORIZE";
  
   if(total == 0)
  {
    alert('Please enter valid amount');
    return false;
  }

  checkstocks(total , intent , step_total)
  //countdown()
  setTimeout(function () {
    latest_paypal_modal.hide()
    if(!$('#bid_step_3').is(':visible'))
    {
      $('#bid_step_2').hide();
      $('.hide_after_succ').hide();
      $('.alert-danger').hide();
      $('#bid_step_5').show();
      $('#paypal_btn').html('');
    }
    
  }, 120000);   

  }
  else
  {
    //checkout();
    alert('Please choose payment gateway');
  }
  
}

function checkstocks(total , intent , step_total) 
{
    $.ajax({
        url: '<?=base_url()?>/Trade/check_stocks',
        type: 'post',
        data: {product_id: '<?= $product['id'] ?>' },
        dataType: 'json',
        success: function(data){
          blockui('hide')
          if(data.status == 1)
          {
            PaymentGetway(total , 'checkout' , '' , intent);
    
            $('.latest-paypal-deposit-amount').text(total);
            $('#step_charge').val(step_total);
            $('#exchange_product_ids').val($('#ex_product_ids').val());
            $('#total_amount').val(total);
            $('#payment_method').val('paypal');
            
            latest_paypal_modal.show()
          }
          else{
            do_outOfStock();
          }

          
        }
      });

    
}
function do_outOfStock() {
  $('#bid_step_2').hide();
    $('.hide_after_succ').hide();
    $('.alert-danger').hide();
    $('#bid_step_4').show();
    document.body.scrollTop = 0; // For Safari
  document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
}
function PaymentGetway(amt, type, planId='' , intent) {


  $('#paypal_btn').html('');
 
 paypal.Buttons({ 
  createOrder: function(data, actions) { 
 // This function sets up the details of the transaction, including the amount and line item details. 
 return actions.order.create({intent:intent , purchase_units: [{ amount: { value: amt  } }] }); 
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
function checkout () 
  {
    data = new FormData($('#checkout_form')[0]);
    
    latest_paypal_modal.hide()  
  $.ajax({
        url: "<?php echo base_url(); ?>/Trade/submit_exchange_form",
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
          $.unblockUI();
          if (data.status == 1) {

             $('#bid_step_2').hide();
             $('.hide_after_succ').hide();
             $('.alert-danger').hide();
             $('#bid_step_3').show();
             $('.finnish_btn').attr('href' , data.redirect);
              
            
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

var interval;
var minutes = 2;
var seconds = 00;
var $toast;
function countdown() {
  clearInterval(interval);
  interval = setInterval( function() {
      
      seconds -= 1;
      if (minutes < 0) return;
      else if (seconds < 0 && minutes != 0) {
          minutes -= 1;
          seconds = 59;
      }
      else if (seconds < 10 && length.seconds != 2) seconds = '0' + seconds;
      if($toast)
      {
        toastr.clear($toast);
      }
      $toast = toastr['success'](minutes + ':' + seconds, 'Success!!', {
                    
                    positionClass: 'toast-top-right',
                    
                    preventDuplicates: true,
                    newestOnTop: true,
                });

      if (minutes == 0 && seconds == 0) clearInterval(interval);
  }, 1000);
}
</script>
