<?php 

use App\Models\Common_model;
$this->common_model = new Common_model();
$this->session = \Config\Services::session();
$this->user_id =  $this->session->get('user_id');
$this->currency = 'HKD';
if ($this->session->has('user_id')) {
  $this->auth_id = $this->session->get('user_id');

  $this->auth = $this->common_model->GetSingleData('users' , array('id' =>$this->auth_id));
  $this->currency = $this->auth['currency'];
  //print_r($this->auth);
}
 $check = false; 
    if($this->user_id){
     $check = $this->common_model->GetSingleData('wishlist' , array('user_id'=>$this->user_id,'product_id' => $product['id'] )); 
     }
$highestbid = convert_currency(get_hl_bid_price($product['id'])['grand_total'] , $this->currency , 'HKD');
$lowestask = convert_currency(get_hl_price($product['id'])['lowest'] , $this->currency , 'HKD');
 ?>

    
    <div class="col-sm-6"> 
      <h6 class="text-center">Highest Bid : <strong><?= $this->currency ?><?= $highestbid ?></strong> | Lowest Ask : <strong><?= $this->currency ?><span class="low1"><?= $lowestask ?></span></strong></h6>
      <input type="hidden" id="lowest_ask_input" value="<?= $lowestask ?>">
      <input type="hidden" id="highest_bid_input" value="<?= $highestbid ?>">
      <div class="left-detail-image">       
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
    </div>
    <div class="col-sm-6"> 
      <div class="right-detail-text"> 
        <h3><?= $product["title"]; ?><?= gradeName($product["class_type"]); ?>
          <span class="add-fav">
            <a href="javascript:;" onclick="return addToFav(<?php echo $product['id'] ?>)"><i class="fa <?= ($check) ? 'fa-heart' : 'fa-heart-o' ?> product_heart_<?= $product['id'] ?>"></i></a>
          </span>
        </h3>
        <div class="game-score d-flex justify-content-between pl-2 bg-success text-white"> 
          <span class="game-score-title pt-2">Game Score</span>
          <span class="game-score-value  bg-warning p-2"><?= $product["game_score"]; ?></span>
        </div>
        <ul>
          <li><b>FORMATE:</b> <?= $product["format"]; ?><br></li>

          <li><?php
        $category = $this->common_model->GetSingleData("categories", array("id"=>$product["category"]));
        $sub_category = $this->common_model->GetSingleData("categories", array("id"=>$product["subcategory"]));
         $price = get_hl_price($product["id"]);
         $price_lowest = convert_currency($price['lowest'] , $this->currency , 'HKD'); 
           echo $category["title"].' '.$sub_category["title"]; ?></li>
           <li>Release_date: <?= $product["release_date"]; ?></li>
         </ul>
        <p><?= $product["description"]; ?></p>
        <div class="card side_sections py-3 pl-3 pr-3" id="bid_step_1">
        <div class="place-buy">
        
        <ul class="nav nav-tabs" id="myTab" role="tablist">
          <li class="nav-item">
          <a class="nav-link active" onclick="change_sdk('authorize')"  id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="false">Modify Bid</a>
          </li>
          <li class="nav-item">
          <a class="nav-link "  id="profile-tab" onclick="change_sdk('capture')" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="true">Buy Now</a>
          </li> 
        </ul>
        <div class="tab-content" id="myTabContent">
          <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
            <div class="placedata" >
              <div class="mt-3">            
                <div class="input-group">
                  
                  <span class="input-group-btn"><?= $this->currency ?></span>
                  <input type="number"  class="form-control bid_price" value="<?= convert_currency($edit['grand_total'] , $this->currency , 'HKD') ?>">
                </div>
                <h5>You are not the highest Bid</h5>
              </div>
              <div class="other-descripton">
              <div class="deci-row">
                <div class="inner-bis">
                <p>Bid Expiration:</p>
                  <div class="ml-auto">
                    <select class="form-control" id="expire_day">
                      <option <?= ($edit['expire_day'] == 1) ? 'selected' : ''?> value="1">1 Day</option>
                      <option <?= ($edit['expire_day'] == 3) ? 'selected' : ''?> value="3">3 Days</option>
                      <option <?= ($edit['expire_day'] == 7) ? 'selected' : ''?> value="7">7 Days</option>
                      <option <?= ($edit['expire_day'] == 24) ? 'selected' : ''?> value="14">14 Days</option>
                      <option <?= ($edit['expire_day'] == 30) ? 'selected' : ''?> value="30">30 Days</option>
                     
                    </select>
                  </div>
                </div>
                <div class="inner-bis">
                <p>Please choose a payment method</p><br>
                  <div class="form-group w-100">
                    <label><input type="radio" name="payment1" value="paypal" checked> <img width="150px" src="https://www.paypalobjects.com/webstatic/mktg/logo/AM_mc_vs_dc_ae.jpg"></label>
                  </div>
                </div>
                <div class="inner-bis">
                <?php if ($edit): ?>
                  <div class="d-block">
                    <b>Shipping Info</b>
                      <p><?= $edit['f_name'] ?> <?= $edit['l_name'] ?></p>
                      <p><?= $edit['address'] ?> <?= $edit['city'] ?> <?= $edit['state'] ?> <?= $edit['country'] ?></p>
                  </div>
                <?php else: ?>
                <p>No Shipping Info Provided</p>
                <?php endif ?>
                  <div class="ml-auto" data-toggle="modal" data-target="#info-shopping">
                    <i class="fa fa-pencil"></i>
                  </div>
                </div>
              </div>
              </div>
              
              
              <div class="fial-btn">
              <a onclick="return <?= ($this->user_id) ? 'sub_check(this)' : 'window.location.href =\''.base_url('login').'\'' ?>" href="javascript:;" class="btn btn-success">Update Bid</a>
              </div>
            </div>
          </div>
          <div class="tab-pane fade " id="profile" role="tabpanel" aria-labelledby="profile-tab">
            <div class="placedata" >
              <div class="mt-3">            
                <h1 style="font-family:MetaSerifProB"><?= $this->currency ?><span class="price-total"><?= ($price_lowest) ? $price_lowest : 'No Ask Available' ?></span></h1>
                <h5 style="text-align:left;">You are about to purchase this product at the lowest Ask price</h5>
              </div>
              <div class="other-descripton">
              <div class="deci-row mt-4">
                <div class="inner-bis" style="border:0px">
                <p>Lowest Price<br><small>Final price will be calculated at checkout</small></p>
                  <div class="ml-auto" >
                    
                    <h4 style="font-family:MetaSerifProB"><?= $this->currency ?><?= $price_lowest; ?> </h4>
                  </div>
                </div>
                
                <div class="inner-bis" style="display: none;">
                <p>Please choose seller</p>
                  <select class="form-control" name="seller" id="seller">
                    <?php foreach (get_product_sellers($product['id']) as $key => $value): ?>
                      <option data-price="<?= convert_currency($value['price'] , $this->currency , 'HKD') ?>" value="<?= $value['id'] ?>"><?= $value['seller_name'].' - $'.$value['price'] ?></option>
                    <?php endforeach ?>
                    
                  </select>
                </div>
                <div class="inner-bis">
                <p>Please choose a payment method</p><br>
                  <div class="form-group w-100">
                    <label><input type="radio" name="payment" value="paypal" checked> <img width="150px" src="https://www.paypalobjects.com/webstatic/mktg/logo/AM_mc_vs_dc_ae.jpg"></label>
                  </div>
                </div>
                <div class="inner-bis">
                <p>No Shipping Info Provided</p>
                  <div  class="ml-auto" data-toggle="modal" data-target="#info-shopping">
                    <i class="fa fa-pencil"></i>
                  </div>
                </div>
              </div>
              </div>
              
              
              <div class="fial-btn"> 
               <?php if ($price_lowest == 0): ?>
                <button class="btn btn-success review_btn" disabled>Review Order</button>
              <?php else: ?>
              <a href="javascript:;" onclick="return <?= ($this->user_id) ? 'sub_check(this)' : 'window.location.href =\''.base_url('login').'\'' ?>" class="btn btn-success">Review Order</a>
              <?php endif ?>
              </div>
            </div>
          
          </div> 
        </div> 
          
          
        </div>
        </div>
         <div class="card side_sections py-3 pl-3 pr-3 " id="bid_step_2" style="display: none;">
          <div class="deci-row">
            <h2>Reveiw Bid</h2>
                <div class="inner-bis">
                  <p>Processing Fee</p>
                    <div class="ml-auto" >
                      + <?= $this->currency ?><span class="trans"><?= convert_currency(get_admin()['bid_processing_fee'] , $this->currency , 'HKD')?></span>
                    </div>
                </div>
                <!-- <div class="inner-bis">
                  <p>Payment proc.(<?= get_admin()['vat_tax'] ?>%)</p>
                    <div class="ml-auto" >
                     + <?= $this->currency ?><span class="prod">0</span>
                    </div>
                </div> -->
                 <div class="inner-bis">
                  <p>Estimated Shipping</p>
                    <div class="ml-auto" >
                      + <?= $this->currency ?><?= $shipping_fee = convert_currency(get_admin()['shipping_fee'] , $this->currency , 'HKD') ?>
                    </div>
                </div>
                <div class="inner-bis">
                  <p>Total To Pay</p>
                    <div class="ml-auto" >
                      <?= $this->currency ?><span class="total" id="final_price_bid">0</span>
                    </div>
                </div>
                <div class="inner-bis">
                  <p>*All Applicable import duties and taxes are include in price.</p>
                </div>
                <div class="inner-bis">
                  <p><i class="fa fa-envelope"></i>&nbsp;&nbsp;<?= ($this->user_id) ? $this->user_id['email'] : '' ?></p>
                </div>
                <div class="inner-bis">
                  <p><i class="fa fa-home"></i> 
                    <?php if ($edit): ?>
                      <?= $edit['address'] ?> <?= $edit['city'] ?> <?= $edit['state'] ?> <?= $edit['country'] ?>
                    <?php endif ?>
                    
                  </p>
                </div>
                
                <div class="inner-bis">
                  <p style="margin-left: 20px;"><label><input type="checkbox" name="is_new" value="1" <?= ($edit['is_new']==1) ? 'checked' : '' ?>>&nbsp;&nbsp;Playable</label></p>
                </div>
                <div class="inner-bis">
                  <p style="margin-left: 20px;"><label><input type="checkbox" name="in_original_box" value="1" <?= ($edit['in_original_box']==1) ? 'checked' : '' ?>>&nbsp;&nbsp;In Original Box</label></p>
                </div>
                <div class="inner-bis">
                  <p style="margin-left: 20px;"><label><input type="checkbox" name="verified_authentic" value="1" <?= ($edit['verified_authentic']==1) ? 'checked' : '' ?>>&nbsp;&nbsp;Verified Authentic</label></p>
                </div>
                
        </div>
        <div class="fial-btn"> 
                <a href="javascript:;" onclick="return location.reload()" class="btn btn-danger">Cancel</a>
                <a href="javascript:;" onclick="return <?= ($this->user_id) ? 'do_checkout(event)' : 'window.location.href =\''.base_url('login').'\'' ?>" class="btn btn-success">Confirm Bid</a>
              </div>
      </div>
        <div class="card side_sections py-3 pl-3 pr-3 " id="buy_step_2" style="display: none;">
          <div class="deci-row mt-4">
            <h2>Reveiw Order</h2>
            <div class="inner-bis">
                  <p>Processing Fee</p>
                    <div class="ml-auto" >
                      <?php 
                      $trans = convert_currency(get_admin()['bid_processing_fee'] , $this->currency , 'HKD');
                      $final_price = $price_lowest;
                      ?>
                      + <?= $this->currency ?><span class="trans"><?= $trans ?></span>
                    </div>
                </div>
                <!-- <div class="inner-bis">
                  <p>Payment proc.(<?= get_admin()['vat_tax'] ?>%)</p>
                    <div class="ml-auto" >
                      <?php $proc = ($final_price *  get_admin()['vat_tax'] ) / 100;?>
            <span>+ <?= $this->currency ?><?= $proc ?></span>
                    </div>
                </div> -->
                 <div class="inner-bis">
                  <p>Estimated Shipping</p>
                    <div class="ml-auto" >
                      + <?= $this->currency ?><?= $shipping_fee ?>
                    </div>
                </div>
                <div class="inner-bis">
                  <p>Total to Pay<br><small>Final price will be calculated at checkout</small></p>
                    <div class="ml-auto" >
                      <span><?= $this->currency ?><?=$final_price + $trans  + $shipping_fee ?></span>
                      <input type="hidden"  id="final_price_buy" value="<?= $final_price + $trans  + $shipping_fee ?>" class="form-control" min="0" >
                    </div>
                </div>
                 <div class="inner-bis">
                  <p>*All Applicable import duties and taxes are include in price.</p>
                </div>
                <div class="inner-bis">
                  <p><i class="fa fa-envelope"></i>&nbsp;&nbsp;<?= ($this->user_id) ? $this->user_id['email'] : '' ?></p>
                </div>
                <div class="inner-bis">
                  <p><i class="fa fa-home"></i> 
                    <?php if ($edit): ?>
                      <?= $edit['address'] ?> <?= $edit['city'] ?> <?= $edit['state'] ?> <?= $edit['country'] ?>
                    <?php endif ?>
                    
                  </p>
                </div>
               <!--  <div class="inner-bis">
                  <p><label><input type="checkbox" name="is_new" value="1" <?= ($edit['is_new']) ? 'checked' : '' ?>>&nbsp;&nbsp;New & Unworn</label></p>
                </div>
                <div class="inner-bis">
                  <p><label><input type="checkbox" name="in_original_box" value="1" <?= ($edit['in_original_box']) ? 'checked' : '' ?>>&nbsp;&nbsp;In Original Box</label></p>
                </div>
                <div class="inner-bis">
                  <p><label><input type="checkbox" name="verified_authentic" value="1" <?= ($edit['verified_authentic']) ? 'checked' : '' ?>>&nbsp;&nbsp;Verified Authentic</label></p>
                </div> -->
      </div>
            <div class="fial-btn"> 
              <a href="javascript:;" onclick="return location.reload()" class="btn btn-danger">Cancel</a>
              <a href="javascript:;" onclick="return <?= ($this->user_id) ? 'do_checkout(event)' : 'window.location.href =\''.base_url('login').'\'' ?>" class="btn btn-success">Confirm Buy</a>
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
                <div class="">
                  <h5>Share Your Ask</h5>
                 <?php  $url = get_product_url($product) ?>
                  <div class="inner-bis social_share">
                    <p><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?=$url?>"><i class="fa fa-facebook"></i></a></p>
                    <p><a target="_blank" href="https://twitter.com/home?status=<?= $url ?>"><i class="fa fa-twitter"></i></a></p>
                    <p><a target="_blank" href="https://pinterest.com/pin/create/button/?url=<?= $url ?>"><i class="fa fa-pinterest"></i></a></p>
                    <p><a target="_blank" href="mailto:?subject=Please checkout my ask&amp;body=Check out this site <?= $url ?>"><i class="fa fa-envelope"></i></a></p>
                  </div>  
                </div>
              </div>
              <div class="fial-btn">
                <a href="javascript:;" onclick="return location.reload()" class="btn btn-primary">Finish</a>
               
              </div>
            </div>
        <div class="old-detial mt-3">
          <div class="lasr-sale">
            <p class="m-0">Last Sale:</p>
            <h6><?= $this->currency ?><?= ($sales) ? convert_currency($sales[0]['grand_total'] , $this->currency , 'HKD') : '0' ?></h6>
          </div>
          <div class="old-chart">
            <a  href="#" data-toggle="modal" data-target="#view-asks" class="btn btn-outline btn-sm">View Asks</a>
            <a  href="#" data-toggle="modal" data-target="#view-bids" class="btn btn-outline btn-sm">View Bids</a>
            <a  href="#" data-toggle="modal" data-target="#view-sales" class="btn btn-outline btn-sm">View Sales</a>
          </div>
        </div>
      </div>
    </div>
  
   <!-- Modal -->
<div class="modal fade" id="view-asks" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header">
    <div class="">
        <h5 class="modal-title" id="exampleModalLabel">All Asks</h5>
    <p class="m-0">The data below is global and does not include applicable fees calculated at checkout.</p>
    </div>  
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="">
    <div class="table-responsive">
      <table class="table">
        <tr>
          <th>Quantity</th>
          <th>Ask Price</th>
        </tr>
        <?php foreach ($asks as $key => $value): ?>
          <?php 
          $hilighted = '';
          if ($this->user_id) {
            if ($this->user_id == $value['user_id']) {
              $hilighted = 'bg-warning my-ask';
            }
          }

           ?>
          <tr class="<?= $hilighted ?>">
          <td>1</td>
          <td><?= $this->currency ?><?= convert_currency($value['price'] , $this->currency , 'HKD') ?></td>
        </tr>
        <?php endforeach ?>
        
        
      </table>
    </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> 
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="view-bids" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header">
    <div class="">
        <h5 class="modal-title" id="exampleModalLabel">All Bids</h5>
    <p class="m-0">The data below is global and does not include applicable fees calculated at checkout.</p>
    </div>  
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="">
    <div class="table-responsive">
      <table class="table">
        <tr>
          <th>Quantity</th>
          <th>Bid Price</th>
        </tr>
         <?php foreach ($bids as $key => $value): ?>
          <?php 
          $hilighted = '';
          if ($this->user_id) {
            if ($this->user_id == $value['user_id']) {
              $hilighted = 'bg-warning my-bid';
            }
          }

           ?>
          <tr class="<?= $hilighted ?>">
          <td>1</td>
          <td><?= $this->currency ?><?= convert_currency($value['grand_total'] , $this->currency , 'HKD') ?></td>
        </tr>
        <?php endforeach ?>
        
      </table>
    </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> 
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="view-sales" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
    <div class="">
        <h5 class="modal-title" id="exampleModalLabel">All Sales</h5>
    <p class="m-0">The data below is global and does not include applicable fees calculated at checkout.</p>
    </div>  
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="">
    <div class="table-responsive">
      <table class="table">
        <tr>
          <th>Date</th>
          <th>Time</th>
          <th>Sale Price</th>
        </tr>
         <?php foreach ($sales as $key => $value): ?>
          <tr>
          <td><?= date('M d, Y' , strtotime($value['created_at'])) ?></td>
          <td><?= date('H:i A' , strtotime($value['created_at'])) ?></td>
          <td><?= $this->currency ?><?= convert_currency($value['grand_total'] , $this->currency , 'HKD') ?></td>
        </tr>
        <?php endforeach ?>
        
      </table>
    </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> 
      </div>
    </div>
  </div>
</div>