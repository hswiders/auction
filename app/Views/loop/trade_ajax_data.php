<?php 

use App\Models\Common_model;
$this->common_model = new Common_model();
$this->session = \Config\Services::session();
$this->user_id =  $this->session->get('user_id');
$this->auth = [];
$this->currency = 'HKD';
if ($this->session->has('user_id')) {
  $this->auth_id = $this->session->get('user_id');

  $this->auth = $this->common_model->GetSingleData('users' , array('id' =>$this->auth_id));
  $this->currency = $this->auth['currency'];
  //print_r($this->auth);
}

$shipping_info = $this->common_model->GetSingleData('user_shipping_info' , ['user_id' => $this->user_id]); 
$ids = [];
$point_arr = [];
 ?>
<style type="text/css">
  .blink-hard {
  animation: blinker 1s step-end infinite;
}
.blink-soft {
  animation: blinker 1.5s linear infinite;
}
@keyframes blinker {
  50% {
    opacity: 0;
  }
}
</style>
<?php if ($products): ?>
     <ul class="p-0 hide_after_succ" >
             <?php $points = 0; ?>
            <?php foreach ($products as $key => $value): ?>
              <?php 
              $p_img = $this->common_model->GetSingleData("product_image", array("product_id"=>$value['id']));
              
               $p_grade = $this->common_model->GetSingleData("class_type", array("id"=>$value['class_type'])); 
               $points += $p_grade['points'];
               array_push($point_arr, $p_grade['points']);
               $ids[] = $value['id'] ;
               ?>
              <li class="d-flex justify-content-between bg-gray ex_checked" data-id="<?= $value['id'] ?> ">
                <img width="40px" src="<?= base_url($p_img['image']) ?>">
                 <p class="p-2 m-0"><?= $value['title'] ?></p> 
                 <?= gradeName($value['class_type']) ?>
                 <p class="p-2 m-0">Points : <?= $p_grade['points'] ?></p> 
                 <a href="javascript:;" onclick="delete_div(<?= $value['id'] ?>)"><i class="fa fa-times p-2"></i></a>
               </li>
            <?php endforeach ?>
         
          
        </ul>
        <div id="trade_product_data">
        <div class="card side_sections py-3 pl-3 pr-3 " id="bid_step_2" >
          <input type="hidden" name="" id="ex_product_ids" value="<?= implode(',' , $ids) ?>">
          <div class="deci-row">
            <h2>Reveiw Order</h2>
            <?php 
            // print_r($p_to_ex);
            $p_to_grade = $this->common_model->GetSingleData('class_type' , array('id'=>$p_to_ex["class_type"])); 
            $target_point = $p_to_grade['points'];
            $step = $target_point - $points;
            $charge = 0;
            if ($step >= 1) {
              $step_data = $this->common_model->GetSingleData('step_charge' , ['step' => $step]);
              $charge = $step_data['charge'];
            }
            $service_fee =  convert_currency(get_admin()['exchnage_service_fee'] ,  $this->currency ,'HKD'); 
            $price =  convert_currency($charge  , $this->currency , 'HKD'); 
            $shipping_fee = convert_currency(get_admin()['exchange_shipping_fee'] , $this->currency , 'HKD');
            $grand_total =  $price + $service_fee + $shipping_fee ; 
            ?>
                <div class="inner-bis">
                  <p>Step Charge 
                    <?php if ($target_point > $points): ?>
                      <br><label class="alert alert-danger"><input type="checkbox" id="agree_to_pay" name=""> Agree to pay step charge ?</label>

                    <?php else: ?>
                      <input type="hidden" name="" id="qty_zyadahogai">
                      <?php if (check_if_too_many($target_point ,$point_arr)): ?>
                         <input type="hidden" name="" id="point_zyadahogai">
                      <?php endif ?>
                    <?php endif ?>
                    </p>

                    <div class="ml-auto" >
                      + <?= $this->currency ?><span class="step_charge"><?= $price ?></span>
                      
                    </div>
                </div>
                <div class="inner-bis">
                  <p>Service Fee</p>
                    <div class="ml-auto" >
                      + <?= $this->currency ?><span class="trans"><?= $service_fee ?></span>
                    </div>
                </div>
                
                 <div class="inner-bis">
                  <p>Estimated Shipping</p>
                    <div class="ml-auto" >
                      + <?= $this->currency ?><?= $shipping_fee ?>
                    </div>
                </div>
                <div class="inner-bis">
                  <p>Total To Pay</p>
                    <div class="ml-auto" >
                      <?= $this->currency ?><span class="total" id="final_price_ex"><?= $grand_total ?></span>
                    </div>
                </div>
                <div class="inner-bis">
                  <p>*All Applicable import duties and taxes are include in price.</p>
                </div>
                <div class="inner-bis blink-hard">
                  <p>*Note : Exchanges cannot be cancelled or changed, so please check carefully before proceeding</p>
                </div>
               <div class="inner-bis">
                <p>Please choose a payment method</p><br>
                  <div class="form-group w-100">
                    <label><input type="radio" name="payment" value="paypal" checked> <img width="150px" src="https://www.paypalobjects.com/webstatic/mktg/logo/AM_mc_vs_dc_ae.jpg"></label>
                  </div>
                </div>
                <div class="inner-bis">
                <?php if ($shipping_info): ?>
                  <div class="d-block">
                    <b>Shipping Info</b>
                      <p><?= $shipping_info['f_name'] ?> <?= $shipping_info['l_name'] ?></p>
                      <p><?= $shipping_info['address'] ?> <?= $shipping_info['city'] ?> <?= $shipping_info['state'] ?> <?= $shipping_info['country'] ?></p>
                  </div>
                      
                <?php else: ?>
                <p>No Shipping Info Provided</p>
                <?php endif ?>
                  <div  class="ml-auto" data-toggle="modal" data-target="#info-shopping">
                    
                    <i class="fa fa-pencil"></i>
                  </div>
                </div>
                
        </div>
        <div class="fial-btn"> 
                <a href="javascript:;" onclick="location.reload()" class="btn btn-danger">Cancel</a>
                <?php if($p_to_ex['stock'] == 0): ?>
                  <a href="javascript:;" id="proceed_btn" onclick="return <?= ($this->user_id) ? 'do_outOfStock(event)' : 'window.location.href =\''.base_url('login').'\'' ?>"  class="btn btn-success <?= ($target_point > $points) ? 'disabled' : ((check_if_too_many($target_point ,$point_arr)) ? 'disabled' : '') ?>">Proceed</a>
                <?php else: ?>
                  <a href="javascript:;" id="proceed_btn" onclick="return <?= ($this->user_id) ? 'do_checkout(event)' : 'window.location.href =\''.base_url('login').'\'' ?>"  class="btn btn-success <?= ($target_point > $points) ? 'disabled' : ((check_if_too_many($target_point ,$point_arr)) ? 'disabled' : '') ?>">Proceed</a>
                <?php endif; ?>
                
               
              </div>
      </div>
      <div class="card side_sections py-3 pl-3 pr-3 " id="bid_step_3" style="display: none;">
              <div class="deci-row mt-4">
                <h2>Success</h2>
                <div class="">
                  <h5>Reminder</h5>
                  <ul class="success_ul">
                    <li><?= Project ?> requires that games are deadstock and 100%
                    authentic.</li>
                    <li>Buyers have the option to Bid on your games or buy them
                    immediately</li>
                    <li><?= Project ?> is not an auction so games are not automatically
                    sold to the highest bidder.</li>
                    <li>.You can accept a buyer's Bid at any time to complete a
                    transaction.</li>
                  </ul>
                    
                </div>
               <!--  -->
              </div>
              <div class="fial-btn">
                <a href="javascript:;" class="btn btn-primary finnish_btn">Finish</a>
               
              </div>
            </div>
      <div class="card side_sections py-3 pl-3 pr-3 " id="bid_step_4" style="display: none;">
              <div class="deci-row mt-4">
                <h2 class="text-center" style="font-size: 30px;font-weight: 600;letter-spacing: 1px;color: #5662a6;">Failed</h2>
                <div class="text-center out_stock">
                  <a href="#"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i></a>
                  <h5>Sorry Out of stock</h5>
                  
                    
                </div>
               <!--  -->
              </div>
              <div class="fial-btn">
                <a href="<?= base_url('exchange-order') ?>" class="btn btn-primary finnish_btn">Finish</a>
               
              </div>
            </div>
      <div class="card side_sections py-3 pl-3 pr-3 " id="bid_step_5" style="display: none;">
              <div class="deci-row mt-4">
                <h2 class="text-center" style="font-size: 30px;font-weight: 600;letter-spacing: 1px;color: #5662a6;">Failed</h2>
                <div class="text-center out_stock">
                  <a href="#"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i></a>
                  <h5>Session Timeout</h5>
                  
                    
                </div>
               <!--  -->
              </div>
              <div class="fial-btn">
                <a href="" class="btn btn-primary finnish_btn">Try Again</a>
               
              </div>
            </div>
       <?php else: ?>
            <li class="alert alert-danger">No Product found in exchange list</li>
          <?php endif ?>