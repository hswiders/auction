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




$id = $this->session->get('user_id'); 
$highestbid = convert_currency(get_hl_bid_price($check['id'])['grand_total'] , $this->currency , 'HKD');
$lowestask = convert_currency(get_hl_price($check['id'])['lowest'] , $this->currency , 'HKD');
$highgest_bid_order = get_hl_bid_price($check['id']);
//print_r($highgest_bid_order);
 $last_ask = $this->common_model->GetSingleData('sell_product' , array('user_id' => $id));
 $seller_info = $this->common_model->GetSingleData('seller_billing_info' , ['user_id' => $this->auth_id]);
 $active_bid = $this->common_model->GetSingleData('orders' , array('user_id' => $id , 'product_id' => $check['id'] , 'status' => 3));
 
?>
      <div class="col-sm-7"> 
        <input type="hidden" id="highestbid_input" value="<?= $highestbid ?>">
        <input type="hidden" id="highgest_bid_order_id" value="<?= ($highgest_bid_order) ? $highgest_bid_order['id'] : 0 ?>">
          <div class="left-detail-image">       
            <h2 class="text-center"><?=$check['title']?></h2>
        <h6 class="text-center">Highest Bid : <strong><?= $this->currency ?><?= $highestbid ?></strong> | Lowest Ask : <strong><?= $this->currency ?><span class="low1"><?= $lowestask ?></span></strong></h6>
        <?php $product_image = $this->common_model->GetAllData('product_image',array('product_id'=>$check['id'])); ?>
        <div class="outer">
          <div id="big" class="owl-carousel owl-theme">
            <?php if ($check["product_video"]): ?>
                  <?php 
                  $vidname = explode('.', $check["product_video"]);
                  $ext = end($vidname);
                   ?>
                  <div class="item">
                  <video width="100%" height="300px" autoplay loop muted controls>
                    <source src="<?php echo base_url($check["product_video"]);?>" type="video/<?= $ext ?>">
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
      <div class="col-sm-5"> 
      <?= gradeName($check["class_type"]); ?>
      <div class="game-score d-flex justify-content-between pl-2 bg-success text-white"> 
          <span class="game-score-title pt-2">Game Score</span>
          <span class="game-score-value  bg-warning p-2"><?= $check["game_score"]; ?></span>
        </div>
          <div class="right-detail-text">
            <?php if ($active_bid): ?>
            <div class="css-jj1cwa p-2">
              <p>Placing an Ask is not allowed because you have an active Bid on this item. Please remove your Bid to place an Ask</p>
            </div>
          <?php endif ?>
            <div class="card side_sections py-3 pl-3 pr-3" id="ask_step_1">
              <div class="place-buy">
        
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active tabb" id="home-tab" data-toggle="tab" data-tab="place" href="#home" role="tab" aria-controls="home" aria-selected="true" onclick="change_tab('Ask')">Place Ask</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link tabb" id="profile-tab" data-toggle="tab" data-tab="sell" href="#profile" role="tab" aria-controls="profile" aria-selected="false" onclick="change_tab('Order')">Sell Now</a>
                    </li> 
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                      <div class="placedata" >
                          <div class="mt-3">            
                            <div class="input-group">
                                <span class="input-group-btn"><?= $this->currency ?></span>
                                <input type="number" value="0" id="place_price" class="form-control ask_price" min="0" >
                                <input type="hidden"  id="place_dis" class="form-control totalin" min="0" >
                            </div>
                            <h5>You must meet the minimum Ask of <?= $this->currency ?><?= convert_currency($check['base_price'] , $this->currency , 'HKD')?></h5>
                          </div>
                          <div class="other-descripton">
                            <div class="deci-row">
                              <div class="inner-bis">
                                <p>Transaction Fee(<?= get_admin()['admin_commission'] ?>%)</p>
                                  <div class="ml-auto" >
                                    - <?= $this->currency ?> <span class="trans">0</span>
                                  </div>
                              </div>
                              <div class="inner-bis">
                                <p>Payment proc.(<?= get_admin()['vat_tax'] ?>%)</p>
                                  <div class="ml-auto" >
                                    - <?= $this->currency ?> <span class="prod">0</span>
                                  </div>
                              </div>
                              <div class="inner-bis">
                                <p>Estimated Shipping</p>
                                  <div class="ml-auto" >
                                  - <?= $this->currency ?><?= $shipping_fee = convert_currency(get_admin()['shipping_fee'] , $this->currency , 'HKD') ?>
                                  </div>
                              </div>
                              <div class="inner-bis">
                                <p>Total Payout</p>
                                  <div class="ml-auto" >
                                    <?= $this->currency ?> <span class="total">0</span>
                                  </div>
                              </div>
                              <input type="hidden" name="status" value="1">
                              <div class="inner-bis">
                                <p>Ask Expiration:</p>
                                  <div class="ml-auto">
                                    <select class="form-control" id="place_exp" name='exp_date'>
                                        <option value="1">1 Day</option>
                                        <option value="3">3 Days</option>
                                        <option value="7">7 Days</option>
                                        <option value="14">14 Days</option>
                                        <option value="30">30 Days</option>
                                        <option value="60">60 Days</option>
                                    </select>
                                  </div>
                              </div>
                              <!-- <div class="inner-bis">
                                <p>Please add a payment method</p>
                                  <div class="ml-auto" data-toggle="modal" data-target="#payment-meth">
                                    <i class="fa fa-pencil"></i>
                                  </div>
                              </div> -->
                              <div class="inner-bis">
                <?php if ($seller_info): ?>
                  <div class="d-block">
                    <b>Payment Info</b>
                      <span><i class="fa fa-credit-card"></i> <?= substr($seller_info['card_number'],0 , 4 )."************"; ?></span>
                  </div>
                <?php else: ?>
                <p>No Payment Info Provided</p>
                <?php endif ?>
                  <div class="ml-auto" data-toggle="modal" data-target="#payment-meth">
                    <i class="fa fa-pencil"></i>
                  </div>
                </div>
                            </div>
                          </div>             
              
                          
                      </div>
                    </div>
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                      <div class="placedata" >
                          <div class="mt-3">            
                            <h1 style="font-family:MetaSerifProB"><?= $this->currency ?><?= ($highestbid) ? $highestbid : 'No Bids Available' ?></h1>
                            <input type="hidden" value="<?= $highestbid ?>" id="sell_price" class="form-control ask_price" min="0" >
                              
                            <h5 style="text-align:left;">You are about to sell at the highest Bid price</h5>
                          </div>
                          <div class="other-descripton">
                            <div class="deci-row mt-4">
                              <div class="inner-bis">
                                <p>Transaction Fee(<?= get_admin()['admin_commission'] ?>%)</p>
                                  <div class="ml-auto" >
                                    <?php $price = $highestbid;
                          $trans = ($price *  get_admin()['admin_commission'] ) / 100;?>
                          <span>- <?= $this->currency ?><?= $trans ?></span>
                                  </div>
                              </div>
                              <div class="inner-bis">
                                <p>Payment proc.(<?= get_admin()['vat_tax'] ?>%)</p>
                                  <div class="ml-auto" >
                                    <?php $proc = ($price *  get_admin()['vat_tax'] ) / 100;?>
                          <span>- <?= $this->currency ?><?= $proc ?></span>
                                  </div>
                              </div>
                              <div class="inner-bis">
                                <p>Estimated Shipping</p>
                                  <div class="ml-auto" >
                                    - <?= $this->currency ?><?= $shipping_fee = convert_currency(get_admin()['shipping_fee'] , $this->currency , 'HKD') ?>
                                  </div>
                              </div>
                              <div class="inner-bis">
                                <p>Total Payout<br><small>Final price will be calculated at checkout</small></p>
                                  <div class="ml-auto" >
                                    <span><?= $this->currency ?><?= $price - $trans - $proc - $shipping_fee  ?></span>
                                    <input type="hidden"  id="sell_dis" value="<?=$price - $trans - $proc -  $shipping_fee  ?>" class="form-control" min="0" >
                                  </div>
                              </div>
                              <input type="hidden" name="status" value="2">
                            </div>
                          </div>             
                          <!-- <div class="fial-btn">
                            <a href="#" class="btn btn-success" data-toggle="modal" data-target="#payment-meth" >Next</a>
                          </div> -->
                      </div>
            
                    </div> 
                </div> 
                <div class="fial-btn">
                  <div class="inner-bis">
                    <p>Game condition</p>
                      <div class="ml-auto" >
                       <input type="range" min="1" max="100" value="50" class="slider" id="myRange">
                       <div  class="badge badge-danger"><span id="slide_output">50</span><span>% New</span></div>
                     </div>
                  </div>
                  <?php if ($active_bid): ?>
                  <button class="btn btn-success review_btn" id="review_btn" disabled>Review Ask</button>
                <?php else: ?>
                <a href="javascript:;" class="btn btn-success" id="review_btn" onclick="return getSell(this)">Review Ask</a>
              <?php endif ?>
                <!-- <a href="#" class="btn btn-success" data-toggle="modal" data-target="#payment-meth">Next</a> -->
              </div>
                     
              </div>
            </div>
            <div class="card side_sections py-3 pl-3 pr-3 " id="ask_step_2" style="display: none;">
              <div class="deci-row">
                <h2>Reveiw Ask</h2>
                <div class="inner-bis">
                  <p>Transaction Fee(<?= get_admin()['admin_commission'] ?>%)</p>
                  <div class="ml-auto" >
                    - <?= $this->currency ?><span class="trans">0</span>
                  </div>
                </div>
                <div class="inner-bis">
                  <p>Payment proc.(<?= get_admin()['vat_tax'] ?>%)</p>
                  <div class="ml-auto" >
                    - <?= $this->currency ?><span class="prod">0</span>
                  </div>
                </div>
                <div class="inner-bis">
                  <p>Estimated Shipping</p>
                  <div class="ml-auto" >
                  - <?= $this->currency ?><?= $shipping_fee = convert_currency(get_admin()['shipping_fee'] , $this->currency , 'HKD') ?>
                  </div>
                </div>
                <div class="inner-bis">
                  <p>Total Payout</p>
                  <div class="ml-auto" >
                    <?= $this->currency ?><span class="total">0</span>
                  </div>
                </div>
                 <div class="inner-bis">
                  <p>*Your ask may appear higher do to local duries and taxes.</p>
                </div>
                <div class="inner-bis">
                  <p><i class="fa fa-dollar"></i>&nbsp;&nbsp;Payout Method:Active</p>
                </div>
                <div class="inner-bis">
                  <p><i class="fa fa-credit-card"></i> <?= substr($seller_info['card_number'],0 , 4 )."************"; ?></p>
                </div>
                <div class="inner-bis">
                <p style="font-weight: 700;"><label> Final checks </label></p>
                </div>
                <div class="inner-bis">
                  <p style="margin-left: 20px;"><label><input type="checkbox" class="is_final_check" name="is_new" value="1" >&nbsp;&nbsp;My item is playable good condition with the original, undamaged box.</label></p>
                </div>
                <div class="inner-bis">
                  <p style="margin-left: 20px;"><label><input type="checkbox" class="is_final_check" name="is_ship_in_2_days" value="1" >&nbsp;&nbsp;I will ship within 2 business days of sales avoid penalties.</label></p>
                </div>
              </div>
              <div class="fial-btn">
                <a href="javascript:;" onclick="return location.reload()" class="btn btn-danger">Cancel</a>
                <a href="javascript:;" id="" onclick="return do_checkout(event)" class="btn btn-success c_btn to_disable Ask_btn disabled">Confirm Ask</a>
              </div>
            </div>
            <div class="card side_sections py-3 pl-3 pr-3 " id="sell_step_2" style="display: none;">
              <div class="deci-row mt-4">
                <h2>Reveiw Order</h2>
                <div class="inner-bis">
                  <p>Transaction Fee(<?= get_admin()['admin_commission'] ?>%)</p>
                  <div class="ml-auto" >
                    <?php $price = $highestbid;
                    $trans = ($price *  get_admin()['admin_commission']) / 100;?>
                    <span>- <?= $this->currency ?><?= $trans ?></span>
                  </div>
                </div>
                <div class="inner-bis">
                  <p>Payment proc.(<?= get_admin()['vat_tax'] ?>%)</p>
                  <div class="ml-auto" >
                    <?php $proc = ($price *  get_admin()['vat_tax'] ) / 100;?>
                    <span>- <?= $this->currency ?><?= $proc ?></span>
                  </div>
                </div>
                <div class="inner-bis">
                  <p>Estimated Shipping</p>
                  <div class="ml-auto" >
                  - <?= $this->currency ?><?= $shipping_fee = convert_currency(get_admin()['shipping_fee'] , $this->currency , 'HKD') ?>
                  </div>
                </div>
                <div class="inner-bis">
                  <p>Total Payout<br><small>Final price will be calculated at checkout</small></p>
                  <div class="ml-auto" >
                    <span><?= $this->currency ?><?=$price - $trans - $proc - $shipping_fee?></span>
                    
                  </div>
                </div>
                 <div class="inner-bis">
                  <p>*Your ask may appear higher do to local duries and taxes.</p>
                </div>
                <div class="inner-bis">
                  <p><i class="fa fa-dollar"></i>&nbsp;&nbsp;Payout Method:Active</p>
                </div>
                <div class="inner-bis">
                  <p><i class="fa fa-credit-card"></i> <?= substr($seller_info['card_number'],0 , 4 )."************"; ?></p>
                </div>
                <div class="inner-bis">
                <p style="font-weight: 700;"><label> Final checks </label></p>
                </div>
                <div class="inner-bis">
                  <p style="margin-left: 20px;"><label><input type="checkbox" class="is_final_check" name="is_new" value="1" >&nbsp;&nbsp;My item is playable good condition with the original, undamaged box.</label></p>
                </div>
                <div class="inner-bis">
                  <p style="margin-left: 20px;"><label><input type="checkbox" class="is_final_check" name="is_ship_in_2_days" value="1" >&nbsp;&nbsp;I will ship within 2 business days of sales avoid penalties.</label></p>
                </div>
              </div>
              <div class="fial-btn">
                <a href="javascript:;" onclick="return location.reload()" class="btn btn-danger">Cancel</a>
                <a href="javascript:;" onclick="return do_checkout(event)" class="btn btn-success c_btn Sell_btn to_disable disabled" >Confirm Sell</a>
              </div>
            </div>
            <div class="card  side_sections py-3 pl-3 pr-3 " id="sell_step_3" style="display: none;">
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
                 <?php  $url = get_product_url($check) ?>
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
          </div>
      </div>
    