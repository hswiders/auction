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
$highestbid = convert_currency(get_hl_bid_price($product['id'])['grand_total'] , $this->currency , 'HKD');
$lowestask = convert_currency(get_hl_price($product['id'])['lowest'] , $this->currency , 'HKD');
$base_price = convert_currency($product['base_price'] , $this->currency , 'HKD');
$highgest_bid_order = get_hl_bid_price($product['id']);
 
?>
     
      <div class="col-sm-7"> 
        <input type="hidden" id="highestbid_input" value="<?= $highestbid ?>">
        <input type="hidden" id="highgest_bid_order_id" value="<?= ($highgest_bid_order) ? $highgest_bid_order['id'] : 0 ?>">
          <div class="left-detail-image">       
            <h2 class="text-center"><?= $product['title']?></h2>
        <h6 class="text-center">Highest Bid : <strong><?= $this->currency ?><?= $highestbid ?></strong> | Lowest Ask : <strong><?= $this->currency ?><span class="1low1"><?= $lowestask ?></span></strong></h6>
        <?php $product_image = $this->common_model->GetAllData('product_image',array('product_id'=>$product['id'])); ?>
        <div class="outer">
          <div id="big" class="owl-carousel owl-theme">
            <?php if ($product["product_video"]): ?>
                  <?php 
                  $vidname = explode('.', $product["product_video"]);
                  $ext = end($vidname);
                   ?>
                  <div class="item">
                  <video width="100%" height="300px" autoplay loop muted controls>
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
      <?= gradeName($product["class_type"]); ?>
      <div class="game-score d-flex justify-content-between pl-2 bg-success text-white"> 
          <span class="game-score-title pt-2">Game Score</span>
          <span class="game-score-value  bg-warning p-2"><?= $product["game_score"]; ?></span>
        </div>
          <div class="right-detail-text">
            <div class="card side_sections py-3 pl-3 pr-3" id="ask_step_1">
              <div class="place-buy">
        
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link tabb myTablink <?= ($sell_data["status"] == 1) ? "active":""; ?>" onclick="change_tab('Ask')" id="home-tab" data-toggle="tab" href="#home" data-tab="place" role="tab" aria-controls="home" aria-selected="true">Modify Ask</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link tabb myTablink <?= ($sell_data["status"] == 2) ? "active":""; ?>" onclick="change_tab('Sell')" id="profile-tab" data-toggle="tab" href="#profile" data-tab="sell" role="tab" aria-controls="profile" aria-selected="false">Sell Out</a>
                    </li> 
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade <?= ($sell_data["status"] == 1) ? "show active":""; ?>" id="home" role="tabpanel" aria-labelledby="home-tab">
                      <div class="placedata" >
                          <div class="mt-3">            
                            <div class="input-group">
                                <span class="input-group-btn"><?= $this->currency ?></span>
                                <input type="number" value="<?= convert_currency($sell_data["price"] , $this->currency , 'HKD'); ?>" id="place_price" class="form-control ask_price" min="1" >
                                <input type="hidden"  id="place_dis" class="form-control totalin" min="0" >
                            </div>
                            <h5>You must meet the minimum Ask of <?= $this->currency ?> <?= $base_price ?></h5>
                          </div>
                          <div class="other-descripton">
                            <div class="deci-row">
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
                              <input type="hidden" name="status" value="1">
                              <div class="inner-bis">
                                <p>Bid Expiration:</p>
                                  <div class="ml-auto">
                                    <select class="form-control" id="place_exp" name='exp_date'>
                                        <option value="1" <?= ($sell_data["validity_day"] == 1) ? "selected":""; ?> >1 Day</option>
                                        <option value="3" <?= ($sell_data["validity_day"] == 3) ? "selected":""; ?> >3 Days</option>
                                        <option value="7" <?= ($sell_data["validity_day"] == 7) ? "selected":""; ?> >7 Days</option>
                                        <option value="14" <?= ($sell_data["validity_day"] == 14) ? "selected":""; ?> >14 Days</option>
                                        <option value="30" <?= ($sell_data["validity_day"] == 30) ? "selected":""; ?> >30 Days</option>
                                        <option value="60" <?= ($sell_data["validity_day"] == 60) ? "selected":""; ?> >60 Days</option>
                                    </select>
                                  </div>
                              </div>
                              <div class="inner-bis">
                                <p>payment method</p>
                                  <div class="ml-auto" onclick="return getSell(true)">
                                    <span><i class="fa fa-credit-card"></i> <?= substr($sell_data['card_number'],0 , 4 )."************"; ?></span> <i class="fa fa-pencil"></i>
                                  </div>
                              </div>
                              <!-- <div class="inner-bis">
                                <p>No Shipping Info Provided</p>
                                  <div class="ml-auto" data-toggle="modal" data-target="#info-shopping">
                                    <i class="fa fa-pencil"></i>
                                  </div>
                              </div> -->
                            </div>
                          </div>             
              
                          <div class="fial-btn">
                            <div class="inner-bis">
                              <p>Game condtion</p>
                                <div class="ml-auto" >
                                 <input type="range" min="1" max="100" value="<?= $sell_data['game_condition'] ?>" class="slider" id="myRange">
                                 <div  class="badge badge-danger"><span id="slide_output"><?= $sell_data['game_condition'] ?></span><span>% New</span></div>
                               </div>
                            </div>
                            <a href="javascript: void(0)" class="btn btn-success" onclick="return getSell()">Update Ask</a>
                            <!-- <a href="#" class="btn btn-success" data-toggle="modal" data-target="#payment-meth">Next</a> -->
                          </div>
                      </div>
                    </div>
                    <div class="tab-pane fade <?= ($sell_data["status"] == 2) ? "show active":""; ?>" id="profile" role="tabpanel" aria-labelledby="profile-tab">
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
                                    <?php $price =  $highestbid;
                          $trans = ($price *  get_admin()['admin_commission']) / 100;?>
                          <span>- <?= $this->currency ?><?= $trans ?></span>
                                  </div>
                              </div>
                              <div class="inner-bis">
                                <p>Payment proc.(<?= get_admin()['vat_tax'] ?>%)</p>
                                  <div class="ml-auto" >
                                    <?php $proc = ($price * get_admin()['vat_tax'] ) / 100;?>
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
                                  <div class="ml-auto" ><?= $this->currency ?>
                                    <span class="sell_out_disc_price"><?=$price - $trans - $proc - $shipping_fee?></span>
                                  </div>
                              </div>
                              <div class="inner-bis">
                                <p>payment method</p>
                                  <div class="ml-auto" onclick="return getSell(true)">
                                    <span><i class="fa fa-credit-card"></i> <?= substr($sell_data['card_number'],0 , 4 )."************"; ?></span> <i class="fa fa-pencil"></i>
                                  </div>
                              </div>
                              <input type="hidden" name="status" value="2">
                            </div>
                          </div>             
                          <div class="fial-btn">
                            <a href="javascript: void(0)" class="btn btn-success" onclick="return getSell()">Sell Now</a>
                          </div>
                      </div>
            
                    </div> 
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
                  <p><i class="fa fa-credit-card"></i> <?= substr($sell_data['card_number'],0 , 4 )."************"; ?></p>
                </div>
                <div class="inner-bis">
                <p style="font-weight: 700;"><label> Final checks </label></p>
                </div>
                <div class="inner-bis">
                  <p style="margin-left: 20px;"><label><input type="checkbox" name="is_new" value="1" <?= ($sell_data['is_new']) ? 'checked' : '' ?>>&nbsp;&nbsp;My item is playable good condition with the original, undamaged box.</label></p>
                </div>
                <div class="inner-bis">
                  <p style="margin-left: 20px;"><label><input type="checkbox" name="is_ship_in_2_days" value="1" <?= ($sell_data['is_ship_in_2_days']) ? 'checked' : '' ?>>&nbsp;&nbsp;I will ship within 2 business days of sales avoid penalties.</label></p>
                </div>
              </div>
              <div class="fial-btn">
                <a href="javascript:;" onclick="return location.reload()" class="btn btn-danger">Cancel</a>
                <a href="javascript:;" id="" onclick="return do_checkout(event)" class="btn btn-success c_btn Ask_btn">Confirm Ask</a>
              </div>
            </div>
            <div class="card side_sections py-3 pl-3 pr-3 " id="sell_step_2" style="display: none;">
              <div class="deci-row mt-4">
                <h2>Reveiw Sell</h2>
                <div class="inner-bis">
                  <p>Transaction Fee(<?= get_admin()['admin_commission'] ?>%)</p>
                  <div class="ml-auto" >
                    <?php $price = $highestbid;
                    $trans = ($price * get_admin()['admin_commission'] ) / 100;?>
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
                    <span><?= $this->currency ?><?=$price - $trans - $proc - $shipping_fee ?></span>
                    
                  </div>
                </div>
                <div class="inner-bis">
                  <p>*Your ask may appear higher do to local duries and taxes.</p>
                </div>
                <div class="inner-bis">
                  <p><i class="fa fa-dollar"></i>&nbsp;&nbsp;Payout Method:Active</p>
                </div>
                <div class="inner-bis">
                  <p><i class="fa fa-credit-card"></i> <?= substr($sell_data['card_number'],0 , 4 )."************"; ?></p>
                </div>
                <div class="inner-bis">
                <p style="font-weight: 700;"><label> Final checks </label></p>
                </div>
                <div class="inner-bis">
                  <p style="margin-left: 20px;"><label><input type="checkbox" name="is_new" value="1" <?= ($sell_data['is_new']) ? 'checked' : '' ?>>&nbsp;&nbsp;My item is playable good condition with the original, undamaged box.</label></p>
                </div>
                <div class="inner-bis">
                  <p style="margin-left: 20px;"><label><input type="checkbox" name="is_ship_in_2_days" value="1" <?= ($sell_data['is_ship_in_2_days']) ? 'checked' : '' ?>>&nbsp;&nbsp;I will ship within 2 business days of sales avoid penalties.</label></p>
                </div>
              </div>
              <div class="fial-btn">
                <a href="javascript:;" onclick="return location.reload()" class="btn btn-danger">Cancel</a>
                <a href="javascript:;" onclick="return do_checkout(event)" class="btn btn-success c_btn Sell_btn">Confirm Sell</a>
              </div>
            </div>
            <div class="card side_sections py-3 pl-3 pr-3 " id="sell_step_3" style="display: none;">
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
          </div>
      </div>
    