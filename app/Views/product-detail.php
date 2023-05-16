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
.gray_box {
    background: #cdcdcd;
    margin: 10px;
    padding: 10px;
}

.chart_ul {
    background: #ddd;
    padding: 7px 0;
    border-radius: 10px;
}
.chart_ul a
{
  padding: 10px 30px;
  color: #000;
  font-weight: 700;
}
.chart_ul a.active
{
  background: #000;
  color: #fff;
}
</style>
<?php
$this->user_id =  $this->session->get('user_id');
 $check = false; 
    if($this->user_id){
     $check = $this->common_model->GetSingleData('wishlist' , array('user_id'=>$this->user_id,'product_id' => $product['id'] )); 
     }
$highestbid = get_hl_bid_price($product['id'])['grand_total'];
$lowestask = get_hl_price($product['id'])['lowest'];
//print_r(generate_token());
 $last_bid = $this->common_model->GetSingleData('orders' , array('user_id' => $this->user_id));
$shipping_info = $this->common_model->GetSingleData('user_shipping_info' , ['user_id' => $this->user_id]); 
 $active_ask = $this->common_model->GetSingleData('sell_product' , array('user_id' => $this->user_id , 'product_id' => $product['id'] , 'sold_status' => 0));
?>

<div class="middle detail-page">
  <div class="row" id="add_bid"></div>
  <div class="pro-pack six-item">
  <div class="container">
    <div class="pack-head">
      <h4>Related Products</h4>
      <a href="<?= base_url('shop') ?>">See all</a>
    </div>
    <div class="pack-body">
      <?= view('loop/product', ['products'=>get_related_products($product['category']) , 'col'=>2]);  ?>
    </div>
  </div>
</div>
<div class="pro-pack six-item">
  <div class="container">
    <div class="pack-head">
      <h4>Recently Viewed</h4>
      <a href="<?= base_url('shop') ?>">See all</a>
    </div>
    <div class="pack-body">
      <?= view('loop/product', ['products'=>get_recent_viewed_products($product['id']) , 'col'=>2]);  ?>
    </div>
  </div>
</div>
<div class="pack-head">
     
      <a href="#" data-toggle="modal" data-target="#view-sales" >View Sales</a>
    </div>
<figure class="highcharts-figure">
  <ul class="nav chart_ul">
    <li>
      <a href="javascript:;" class="chart_nav active" data-id="#1_month_container">1M</a>
    </li>
    <li>
      <a href="javascript:;" class="chart_nav" data-id="#3_month_container">3M</a>
    </li>
    <li>
      <a href="javascript:;" class="chart_nav" data-id="#6_month_container">6M</a>
    </li>
    <li>
      <a href="javascript:;" class="chart_nav" data-id="#12_month_container">1Y</a>
    </li>
  </ul>
  <div id="1_month_container" class="chart_container"></div>
  <div id="3_month_container" class="chart_container" style="display: none;"></div>
  <div id="6_month_container" class="chart_container" style="display: none;"></div>
  <div id="12_month_container" class="chart_container" style="display: none;"></div>
</figure>
<div class="pro-pack six-item">
  <div class="container">
    <div class="pack-head">
      <h4>12-Month Historical</h4>
      
    </div>
    <div class="pack-body">
      <div class="row">
        <div class="col-md-4  ">

          <div class="gray_box">
            <h5><?= get_12month_trade($product['id'] , $this->currency) ?></h5>
            <p>12-Month Trade Range</p>
          </div>
      </div>
        <div class="col-md-4  ">
          <div class="gray_box">
            <h5><?= get_12month_trade($product['id'] , $this->currency) ?> </h5>
            <p>All-Time Trade Range</p>
          </div>
      </div>
        <!-- <div class="col-md-4  ">
          <div class="gray_box">
            <h5>-- - --</h5>
            <p>Volatility</p>
          </div>
      </div> -->
        <div class="col-md-4  ">
          <div class="gray_box">
            <h5><?= count($sales) ?></h5>
            <p>Number of Sales</p>
          </div>
        </div>
        <div class="col-md-4  ">
          <div class="gray_box">
            <h5>

              <?php if ($sales): ?>
                <?= abs(round((convert_currency($sales[0]['grand_total'] , $this->currency , 'HKD') / convert_currency($product['base_price'] , $this->currency , 'HKD') -1) * 100))  ?>% 
              <?php else: ?>
                -- - --
              <?php endif ?>
            </h5>
            <p>Price <?= ($sales[0]['grand_total'] > $product['base_price']) ? "Premium" : "Discount" ?></p>
          </div>
        </div>
      
        <div class="col-md-4  ">
          <div class="gray_box">
            <h5>
              <?php if ($sales): ?>
                <?= get_avg_sale($sales , $this->currency) ?>
              <?php else: ?>
                -- - --
              <?php endif ?>
            </h5>
            <p>Average Sale Price</p>
          </div>
      </div>

         <div class="col-md-4  ">
          <div class="gray_box">
            <h5>
              <?php if ($sales && isset($sales[0]) && isset($sales[1]) && isset($sales[2]) ): ?>
              <?php $avg_3_sale = ($sales[0]['grand_total'] + $sales[1]['grand_total'] + $sales[2]['grand_total']) / 3;    ?>
                <?php if ($sales[0]['grand_total'] > $avg_3_sale ): ?>
               
                 ▲ <?= $this->currency ?><?= $up = convert_currency($sales[0]['grand_total'] , $this->currency , 'HKD')  ?> Uptrend
                
                <?php else: ?>
               
                  ▼ <?= $this->currency ?><?= $up = convert_currency($sales[0]['grand_total'] , $this->currency , 'HKD')  ?> Downtrend
                
                <?php endif ?>
              <?php else: ?>
                -- - --
              <?php endif ?>
            </h5>
            <p>TREND</p>
          </div>
      </div>
        
      </div>
    </div>
  </div>
</div> 
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
      <input type="text" required name="f_name" placeholder="First Name" class="form-control" value="<?= ($shipping_info) ? $shipping_info['first_name'] : '' ?>"> 
      <input type="hidden"  name="sell_product_id" id="sell_product_id" value="0"> 
      <input type="hidden"  name="product_id" id="product_id" value="<?= $product["id"] ?>"> 
      <input type="hidden"  name="grand_total" id="grand_total" > 
      <input type="hidden"  name="total_amount" id="total_amount" > 
      <input type="hidden"  name="payment_method" id="payment_method" > 
      <input type="hidden"  name="expire_day"> 
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
     //alert(total)
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
        url: "<?php echo base_url(); ?>/Shop/submit_checkout_form",
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

$(document).on('change', '#seller' , function() {
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
  var totalPrice = (parseFloat(bidPrice) + parseFloat(transPrice) + parseFloat(prodPrice) + parseFloat(shipFee));
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
 <?php if ($edit): ?>
      
     window.location.href = '<?= base_url('edit-bid/'.slugify($product['title']).'-'.$product['id']) ?>'
                
    <?php endif; ?>
</script>

<!-- Highcharjs----------------------------------------------------- -->
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/series-label.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script type="text/javascript" id="graph_common">
  $('.chart_nav').on('click' , function(){
    id = $(this).data('id')
    $('.chart_container').hide();
    $('.chart_nav').removeClass('active');
    $(this).addClass('active');
    $(id).show();
  })
</script>
<script type="text/javascript" id="1_monthly_price_history_js">
  <?php 
  $graph_data = get_monthly_sales_data($product['id'] , 1 , $this->currency);

   ?>
  Highcharts.chart('1_month_container', {
    chart: {
      type: 'area',
      zoomType: 'x',
      panning: true,
      panKey: 'shift',
     
    },
    title: {
      text: '1 Months Sales'
    },

    xAxis: {
      type: 'datetime',
      dateTimeLabelFormats: {
        month: '%e. %b',
        year: '%b'
      },
      title: {
        text: 'Date'
      },
      tickInterval: 1000 * 60 * 60 * 24 * 5,

      accessibility: {
        description: 'Months of the year'
      }
      
    },
    
    yAxis: {
      startOnTick: true,
      endOnTick: false,
      maxPadding: 0.35,
       title: {
        text: null
      },
      title: {
        text: 'Sales'
      },
      labels: {
        formatter: function () {
          return '<?= $this->currency ?>'+this.value ;
        }
      }
    },
    tooltip: {
      crosshairs: true,
      valuePrefix : '<?= $this->currency ?>',
      shared: true
    },
   plotOptions: {
      line: {
        marker: {
          enabled: false
        }
      }
    },
     series: [{
        type: 'area',
        name: 'Sales',
        data: [
         <?php foreach ($graph_data['graphData'] as $key => $value): ?>
          [Date.UTC(<?= $value['y'] ?>, <?= $value['m']-1 ?>, <?= $value['d'] ?>), <?= $value['price'] ?>],
          <?php endforeach ?>
          
        ]
      }]
  });

</script>
<script type="text/javascript" id="3_monthly_price_history_js">
  <?php 
  $graph_data = get_monthly_sales_data($product['id'] , 3 , $this->currency);

   ?>
  Highcharts.chart('3_month_container', {
    chart: {
      type: 'area',
      zoomType: 'x',
      panning: true,
      panKey: 'shift',
     
    },
    title: {
      text: '3 Months Sales'
    },

    xAxis: {
      type: 'datetime',
      dateTimeLabelFormats: {
        month: '%e. %b',
        year: '%b'
      },
      title: {
        text: 'Date'
      },
      tickInterval: 1000 * 60 * 60 * 24 * 11,

      accessibility: {
        description: 'Months of the year'
      }
      
    },
    
    yAxis: {
      startOnTick: true,
      endOnTick: false,
      maxPadding: 0.35,
       title: {
        text: null
      },
      title: {
        text: 'Sales'
      },
      labels: {
        formatter: function () {
          return '<?= $this->currency ?>'+this.value ;
        }
      }
    },
    tooltip: {
      crosshairs: true,
      valuePrefix : '<?= $this->currency ?>',
      shared: true
    },
   plotOptions: {
      line: {
        marker: {
          enabled: false
        }
      }
    },
     series: [{
        type: 'area',
        name: 'Sales',
        data: [
         <?php foreach ($graph_data['graphData'] as $key => $value): ?>
          [Date.UTC(<?= $value['y'] ?>, <?= $value['m']-1 ?>, <?= $value['d'] ?>), <?= $value['price'] ?>],
          <?php endforeach ?>
          
        ]
      }]
  });

</script>
<script type="text/javascript" id="12_monthly_price_history_js">
  <?php 
  $graph_data = get_monthly_sales_data($product['id'] , 12 , $this->currency);

   ?>
  Highcharts.chart('12_month_container', {
    chart: {
      type: 'area',
      zoomType: 'x',
      panning: true,
      panKey: 'shift',
     
    },
    title: {
      text: '1 Year Sales'
    },

    xAxis: {
      type: 'datetime',
      dateTimeLabelFormats: {
        month: '%e. %b',
        year: '%b'
      },
      title: {
        text: 'Date'
      },
      tickInterval: 1000 * 60 * 60 * 24 * 30,

      accessibility: {
        description: 'Months of the year'
      }
      
    },
    
    yAxis: {
      startOnTick: true,
      endOnTick: false,
      maxPadding: 0.35,
       title: {
        text: null
      },
      title: {
        text: 'Sales'
      },
      labels: {
        formatter: function () {
          return '<?= $this->currency ?>'+this.value ;
        }
      }
    },
    tooltip: {
      crosshairs: true,
      valuePrefix : '<?= $this->currency ?>',
      shared: true
    },
   plotOptions: {
      line: {
        marker: {
          enabled: false
        }
      }
    },
     series: [{
        type: 'area',
        name: 'Sales',
        data: [
         <?php foreach ($graph_data['graphData'] as $key => $value): ?>
          [Date.UTC(<?= $value['y'] ?>, <?= $value['m']-1 ?>, <?= $value['d'] ?>), <?= $value['price'] ?>],
          <?php endforeach ?>
          
        ]
      }]
  });

</script>
<script type="text/javascript" id="6_monthly_price_history_js">
  <?php 
  $graph_data = get_monthly_sales_data($product['id'] , 6 , $this->currency );

   ?>
  Highcharts.chart('6_month_container', {
    chart: {
      type: 'area',
      zoomType: 'x',
      panning: true,
      panKey: 'shift',
     
    },
    title: {
      text: '6 Months Sales'
    },

    xAxis: {
      type: 'datetime',
      dateTimeLabelFormats: {
        month: '%e. %b',
        year: '%b'
      },
      title: {
        text: 'Date'
      },
      tickInterval: 1000 * 60 * 60 * 24 * 22,

      accessibility: {
        description: 'Months of the year'
      }
      
    },
    
    yAxis: {
      startOnTick: true,
      endOnTick: false,
      maxPadding: 0.35,
       title: {
        text: null
      },
      title: {
        text: 'Sales'
      },
      labels: {
        formatter: function () {
          return '<?= $this->currency ?>'+this.value ;
        }
      }
    },
    tooltip: {
      crosshairs: true,
      valuePrefix : '<?= $this->currency ?>',
      shared: true
    },
   plotOptions: {
      line: {
        marker: {
          enabled: false
        }
      }
    },
     series: [{
        type: 'area',
        name: 'Sales',
        data: [
         <?php foreach ($graph_data['graphData'] as $key => $value): ?>
          [Date.UTC(<?= $value['y'] ?>, <?= $value['m']-1 ?>, <?= $value['d'] ?>), <?= $value['price'] ?>],
          <?php endforeach ?>
          
        ]
      }]
  });

</script>

<script type="text/javascript">
  

  function getPageData(is_first=0) {

    $.ajax({
        url: "<?php echo base_url(); ?>/Shop/add_bid_data",
        type:"POST",
        data:{'product_id' : '<?= $product['id'] ?>' , 'lowestask' : lowestask, 'highestbid' : highestbid, 'is_first' : is_first},
        dataType:'html',
        success:function(data) {
          if (data != 0) 
          {
              if ($("#bid_step_3").is(":visible")) {
                return false;
              }
            $('#add_bid').html(data);
            initSlider()
            lowestask = $('#lowest_ask_input').val()
            highestbid = $('#highest_bid_input').val()
            
          }
          
          
        }
      });
  }

  setInterval(getPageData, 2000);
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