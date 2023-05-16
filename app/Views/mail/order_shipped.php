<?php 
use App\Models\Common_model;
$this->common_model = new Common_model;
$this->db      = \Config\Database::connect();

                                                      
$product = $this->common_model->GetSingleData('product',array('id'=> $order['product_id'])); 
$image = $this->common_model->GetSingleData('product_image',array('product_id'=> $product['id'])); 
$category= $this->common_model->GetSingleData('categories',array('id'=> $product['category'])); 
                                                        
 ?>
<body>
    <table border="0" width="100%" cellspacing="0" cellpadding="0" align="center" bgcolor="#Efefef" style="border-collapse:collapse;margin:0 auto">
        <tbody>
            <tr>
              <td align="center" valign="top" bgcolor="#efefef" style="text-align:center">
                <table border="0" width="640" cellspacing="0" cellpadding="0" align="center" style="border-collapse:collapse;margin:0 auto;table-layout:fixed;max-width:640">
                  <tbody>
                    <tr>
                      <td align="center" valign="top" width="600" style="border-collapse:collapse;padding:0px">
                        <table border="0" width="640" cellspacing="0" cellpadding="0" align="center" style="border-collapse:collapse">
                          <tbody>
                              <td id="m_-6873406447582534963ydp94a5df9fyiv4828781233x_wrapper" bgcolor="#EFEFEF" width="640">
                                <table border="0" width="640" cellspacing="0" cellpadding="0" align="center" style="border-collapse:collapse">
                                  <tbody>
                                    <tr>
                                      <td align="center" style="border-collapse:collapse;font-size:0;line-height:0;padding:0;margin:0;min-height:0">
                                        <table border="0" width="100%" cellspacing="0" cellpadding="0" bgcolor="#5662a6" style="border-collapse:collapse">
                                          <tbody>
                                            <tr>
                                              <td align="center" width="65" style="border-collapse:collapse;padding:15px 0 0px 30px;line-height:30px;height:auto">
                                                <a href="#" rel="noreferrer noopener" target="_blank">
                                                  <img alt="<?= Project ?>" width="65" height="auto" style="display:block;border:none;font-family:ProximaNova,Helvetica,Arial,sans-serif;color:#ffffff;text-transform:none;font-size:15px;letter-spacing:1px;line-height:30px;max-width: 180px;width: 180px;" src="<?= base_url() ?>/assets/img/logo.png" class="CToWUd" data-bit="iit">
                                                </a>
                                              </td>
                                              <td align="center" style="border-collapse:collapse;padding:15px 0px 0 30px;border:none;font-family:ProximaNova,Helvetica,Arial,sans-serif;font-size:12px;color:#ffffff;text-decoration:none;text-transform:uppercase;text-align:right;font-weight:400;min-width: 200px;display:inline-block;line-height:15px;height:auto"> Delivered to <br> your Door: </td>
                                              <td align="center" style="border-collapse:collapse;padding:15px 30px 0 0px;border:none;font-family:ProximaNova,Helvetica,Arial,sans-serif;font-size:26px;color:#ffffff;text-decoration:none;text-transform:uppercase;text-align:right;width: 170px;display:inline-block;font-weight:500;line-height:30px;height:auto">
                                                <span id="m_-6873406447582534963ydp94a5df9fyiv4828781233x_estimated" style="font-weight:400;display:none">Delivered on:&nbsp;&nbsp;&nbsp;</span><?= date('Y-m-d',strtotime($order['created_at'])); ?>
                                              </td>
                                            </tr>
                                          </tbody>
                                        </table>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td align="center" style="border-collapse:collapse;padding:0;line-height:0;font-size:0">
                                        <img alt="" style="display:block;border:none;font-family:ProximaNova,Helvetica,Arial,sans-serif;text-transform:none;font-size:15px;letter-spacing:1px;line-height:25px;max-width:800px;text-align:left;width:640px" src="../assets/img/01.png" class="CToWUd a6T" data-bit="iit" tabindex="0">
                                        <div class="a6S" dir="ltr" style="opacity: 0.01; left: 894.5px; top: 444px;">
                                          <div id=":1vn" class="T-I J-J5-Ji aQv T-I-ax7 L3 a5q" role="button" tabindex="0" aria-label="Download attachment " data-tooltip-class="a1V" data-tooltip="Download">
                                            <div class="akn">
                                              <div class="aSK J-J5-Ji aYr"></div>
                                            </div>
                                          </div>
                                        </div>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td bgcolor="#FFFFFF" style="padding:0 30px">
                                        <table border="0" cellspacing="0" cellpadding="0">
                                          <tbody>
                                            <tr>
                                              <td align="center" width="640" style="font-family:ProximaNova,Helvetica,Arial,sans-serif;font-size:30px;color:#000005;text-decoration:none;text-align:center;line-height:36px;font-weight:600">
                                                <a href="#" style="color:#000000;text-decoration:none" rel="noreferrer noopener" target="_blank">Order Verified & Shipped!</a>
                                              </td>
                                            </tr>
                                          </tbody>
                                        </table>
                                      </td>
                                    </tr>

                                    <tr>
                                      <td align="center" bgcolor="#FFFFFF" style="padding:0px;line-height:0;font-size:0">
                                        <table border="0" cellspacing="0" cellpadding="0">
                                          <tbody>
                                            <tr>
                                              <td align="center" width="100%" style="font-family:'Ringside Wide',Ringside,'Arial Black','Arial Bold',Arial,Helvetica,sans-serif;font-size:18px;color:#000000;text-decoration:none;text-align:center;line-height:16px;font-weight:normal;padding:30px;background-color:#ffffff">
                                                <table border="0" cellspacing="0" cellpadding="0" align="center">
                                                  <tbody>
                                                    <tr>
                                                      <td align="center" bgcolor="#5662a6" style="border-radius:2px;padding:10px 18px">
                                                      <a href="#" style="font-size:18px;font-family:ProximaNova,Helvetica,Arial,sans-serif;color:#ffffff;text-decoration:none;border-radius:2px;border:0;display:inline-block;line-height:35px;padding:0 15px;font-weight:500" rel="noreferrer noopener" target="_blank">Track
                                                      Your Order</a>
                                                    </td>
                                                    </tr>
                                                  </tbody>
                                                </table>
                                              </td>
                                            </tr>
                                          </tbody>
                                        </table>
                                      </td>
                                      </tr>

                                    <tr>
                                      <td bgcolor="#FFFFFF" style="padding:30px">
                                        <table border="0" cellspacing="0" cellpadding="0">
                                          <tbody>
                                            <tr>
                                              <td align="center" width="640" style="font-family:ProximaNova,Helvetica,Arial,sans-serif;font-size:18px;color:#000005;text-decoration:none;text-align:left;line-height:24px;font-weight:400"> 
                                                Time to get excited! Your <?= Project ?> purchase has officially passed verification and is getting shipped to you ASAP. Tracking information can be found here and your estimated delivery date is <?= date('Y-m-d',strtotime($order['created_at'])); ?>.<br><br>
                                                Due to the global impact of COVID-19, your order may run into unexpected delays.</td>
                                            </tr>
                                          </tbody>
                                        </table>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td align="center" bgcolor="#FAFAFA" style="padding:45px 0">
                                        <table border="0" cellspacing="0" cellpadding="0" align="center">
                                          <tbody>
                                            <tr>
                                              <td align="center" bgcolor="#Ffffff" width="580" style="border:5px solid #efefef">
                                                <table border="0" cellspacing="0" cellpadding="0" align="center">
                                                  <tbody>
                                                    <tr>
                                                      <td align="center" bgcolor="#ffffff">
                                                        <table border="0" cellspacing="0" cellpadding="0" align="center">
                                                          <tbody>
                                                          <tr>
                                                            <td align="left" bgcolor="#FFFFFF" width="260" style="border-collapse:collapse;margin:0;padding:15px">
                                                            <a href="<?= get_product_url($product);?>" rel="noreferrer noopener" target="_blank" >
                                                                <img alt="<?= $product['title'] ?>" src="../<?= $image['image'] ?>" style="width:260px;max-width:800px" class="CToWUd" data-bit="iit">
                                                            </a>
                                                            </td>
                                                            <td align="left" bgcolor="#FFFFFF" width="280">
                                                            <table border="0" cellspacing="0" cellpadding="0" align="center">
                                                                <tbody>
                                                                <tr>
                                                                    <td id="m_-6873406447582534963ydp94a5df9fyiv4828781233x_productname" width="280" style="font-family:ProximaNova,Helvetica,Arial,sans-serif;font-size:24px;color:#5662a6;text-decoration:none;text-align:left;line-height:30px;padding:30px 15px 15px 15px;font-weight:500">
                                                                    <a href="<?= get_product_url($product);?>" style="color:#5662a6;text-decoration:none" rel="noreferrer noopener" target="_blank"><?= $product['title'] ?></a>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td width="280" style="font-family:ProximaNova,Helvetica,Arial,sans-serif;font-size:12px;color:#000000;text-decoration:none;text-align:left;line-height:16px;font-weight:400;padding:0 0 0 15px">
                                                                    <ul style="list-style-type:none;margin:0;padding:5px 0 0 0">
                                                                        <li style="list-style-type:none;margin:0">
                                                                        <span style="font-weight:500">Category:</span>&nbsp;<?= $category['title'] ?>
                                                                        </li>
                                                                        <li style="list-style-type:none;margin:0">Condition:</span>&nbsp;<ul>
                                <li style="white-space: nowrap;"><b>Playable : </b> <?= ($order['is_new'] == 1) ? '&#10003;' : '&#10539;' ?></li>
                                <li style="white-space: nowrap;"><b>In Original Box : </b> <?= ($order['in_original_box'] == 1) ? '&#10003;' : '&#10539;' ?></li>
                                <li style="white-space: nowrap;"><b>  Verified Authentic : </b> <?= ($order['verified_authentic'] == 1) ? '&#10003;' : '&#10539;' ?></li>
                              </ul></li>
                                                                        <li style="list-style-type:none;margin:0">Realease Date:</span>&nbsp;<?= $product['release_date'] ?></li>
                                                                        <li style="list-style-type:none;margin:0">
                                                                        <span style="font-weight:500">Format:</span>&nbsp;<?= $product['format'] ?>
                                                                        </li>
                                                                        <!-- <li style="list-style-type:none;margin:0">
                                                                        <span style="font-weight:500">Condition:</span>&nbsp;New, 100% Authentic
                                                                        </li> -->
                                                                        <li style="list-style-type:none;margin:0">
                                                                        <span style="font-weight:500">Order number:</span>&nbsp;<?= $order['order_uniqueid'] ?>
                                                                        </li>
                                                                    </ul>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td width="280" style="font-family:ProximaNova,Helvetica,Arial,sans-serif;color:#000000;text-decoration:none;text-align:left;font-weight:400;padding:15px 0 0 15px">
                                                                    <table border="0" cellspacing="0" cellpadding="0" align="left">
                                                                        <tbody>
                                                                        <tr>
                                                                            <td width="200" style="font-family:ProximaNova,Helvetica,Arial,sans-serif;font-size:12px;color:#000000;text-decoration:none;text-align:left;line-height:16px;font-weight:400;min-width:200px">
                                                                            <span style="font-weight:500">Purchase Price:</span>
                                                                            </td>
                                                                            <td align="right" style="font-family:ProximaNova,Helvetica,Arial,sans-serif;font-size:12px;color:#000000;text-decoration:none;text-align:right;line-height:16px;font-weight:400"> $<?= $order['grand_total'] ?></td>
                                                                        </tr>
                                                                        </tbody>
                                                                    </table>
                                                                    <table border="0" cellspacing="0" cellpadding="0" align="left">
                                                                        <tbody>
                                                                        <tr>
                                                                            <td width="200" style="font-family:ProximaNova,Helvetica,Arial,sans-serif;font-size:12px;color:#000000;text-decoration:none;text-align:left;line-height:16px;font-weight:400;min-width:200px">
                                                                            <span style="font-weight:500">Processing Fee:</span>
                                                                            </td>
                                                                            <td align="right" style="font-family:ProximaNova,Helvetica,Arial,sans-serif;font-size:12px;color:#000000;text-decoration:none;text-align:right;line-height:16px;font-weight:400"> $<?= $order['admin_fee'] ?></td>
                                                                        </tr>
                                                                        </tbody>
                                                                    </table>
                                                                    <table border="0" cellspacing="0" cellpadding="0" align="left">
                                                                        <tbody>
                                                                        <tr>
                                                                            <td width="200" style="font-family:ProximaNova,Helvetica,Arial,sans-serif;font-size:12px;color:#000000;text-decoration:none;text-align:left;line-height:16px;font-weight:400;min-width:200px">
                                                                            <span style="font-weight:500">Shipping:</span>
                                                                            </td>
                                                                            <td align="right" style="font-family:ProximaNova,Helvetica,Arial,sans-serif;font-size:12px;color:#000000;text-decoration:none;text-align:right;line-height:16px;font-weight:400"> $0.00</td>
                                                                        </tr>
                                                                        </tbody>
                                                                    </table>
                                                                    <table border="0" cellspacing="0" cellpadding="0" align="left">
                                                                        <tbody>
                                                                        <tr>
                                                                            <td colspan="2" width="240" style="font-family:ProximaNova,Helvetica,Arial,sans-serif;font-size:0px;color:#ffffff;text-decoration:none;text-align:left;line-height:0px;padding:5px 0 0 0;border-bottom:1px solid #000000"> &nbsp;&nbsp;</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td width="200" style="font-family:ProximaNova,Helvetica,Arial,sans-serif;font-size:14px;color:#000000;text-decoration:none;text-align:left;line-height:18px;font-weight:400;display:inline-block;min-width:200px;text-transform:uppercase">
                                                                            <span style="font-weight:500">Total Payment</span>
                                                                            </td>
                                                                            <td align="right" style="text-align:right;font-family:ProximaNova,Helvetica,Arial,sans-serif;font-size:14px;color:#000000;text-decoration:none;line-height:18px;font-weight:400">
                                                                            <span style="font-weight:500">$<?= $order['grand_total'] + $order['admin_fee'] ?></span>
                                                                            </td>
                                                                        </tr>
                                                                        </tbody>
                                                                    </table>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td id="m_-6873406447582534963ydp94a5df9fyiv4828781233x_vieworder" align="center" width="100%" style="font-family:'Ringside Wide',Ringside,'Arial Black','Arial Bold',Arial,Helvetica,sans-serif;font-size:18px;color:#000000;text-decoration:none;text-align:center;line-height:16px;font-weight:normal;padding:15px 0 30px 15px;background-color:#ffffff">
                                                                    <table border="0" cellspacing="0" cellpadding="0">
                                                                        <tbody>
                                                                        <tr>
                                                                            <td align="center" bgcolor="#000000" style="border-radius:2px;padding:10px 18px">
                                                                            <a href="<?= base_url() ?>/buy-orders" style="font-size:18px;font-family:ProximaNova,Helvetica,Arial,sans-serif;color:#ffffff;text-decoration:none;border-radius:2px;border:0;display:inline-block;line-height:35px;padding:0 15px;font-weight:500" rel="noreferrer noopener" target="_blank">View Order</a>
                                                                            </td>
                                                                        </tr>
                                                                        </tbody>
                                                                    </table>
                                                                    </td>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                            </td>
                                                        </tr>
                                                          </tbody>
                                                        </table>
                                                      </td>
                                                    </tr>
                                                    <tr>
                                                      <td align="left">
                                                        <table border="0" cellspacing="0" cellpadding="0" align="left">
                                                          <tbody>
                                                            <tr>
                                                              <td align="center" bgcolor="#ffffff" style="padding:0 0 15px 15px;font-family:ProximaNova,Helvetica,Arial,sans-serif;font-size:13px;color:#000000;text-decoration:none;text-align:left;line-height:16px;font-weight:300;font-style:italic"> *All applicable duties and VAT are included in the total price of this item.</td>
                                                            </tr>
                                                          </tbody>
                                                        </table>
                                                      </td>
                                                    </tr>
                                                  </tbody>
                                                </table>
                                              </td>
                                            </tr>
                                          </tbody>
                                        </table>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td align="center" bgcolor="#FFFFFF" style="padding:0px;border:0;margin:0;line-height:0;font-size:0">
                                        <table border="0" cellspacing="0" cellpadding="0" align="center">
                                          <tbody>
                                            <tr>
                                              <td align="center" bgcolor="#FFFFFF" style="padding:30px">
                                                <table border="0" cellspacing="0" cellpadding="0" align="center">
                                                  <tbody>
                                                    <tr>
                                                      <td align="center" width="640" style="font-family:ProximaNova,Helvetica,Arial,sans-serif;font-size:18px;color:#000005;text-decoration:none;text-align:center;line-height:22px;font-weight:500;text-transform:uppercase"> Frequently Asked Questions</td>
                                                    </tr>
                                                    <?php if(!empty($faq_list)) { 
                                                    foreach ($faq_list as $key => $value) { ?>
                                                <tr>
                                                    <td align="center" width="640" style="font-family:ProximaNova,Helvetica,Arial,sans-serif;font-size:18px;color:#000005;text-decoration:none;text-align:left;line-height:24px;font-weight:400;padding-top:15px;padding-left:75px;padding-right:75px"> • <a href="<?= base_url() ?>/faq" style="text-decoration:none;color:#5662a6" rel="noreferrer noopener" target="_blank" > <?= $value['ques']?></a>
                                                    </td>
                                                </tr><?php } } ?>
                                                  </tbody>
                                                </table>
                                              </td>
                                            </tr>
                                          </tbody>
                                        </table>
                                      </td>
                                    </tr>
                                    <!-- <tr>
                                      <td id="m_-6873406447582534963ydp94a5df9fyiv4828781233x_footer" align="center" bgcolor="#5662a6" width="100%" style="font-size:13px;text-align:center;color:#fafafa;line-height:23px;padding:15px 30px;font-family:ProximaNova,Helvetica,Arial,sans-serif">
                                        <a href="#" style="text-decoration:none;color:#ffffff;font-weight:500" rel="noreferrer noopener" target="_blank">Email Settings </a>
                                        <span style="color:#5662a6">x</span>| <span style="color:#5662a6">x</span>
                                        <a href="#" style="text-decoration:none;color:#ffffff;font-weight:500" rel="noreferrer noopener" target="_blank"> Help </a>
                                        <span style="color:#5662a6">x</span>| <span style="color:#5662a6">x</span>
                                        <a href="#" style="color: #fff; text-decoration: none;" rel="noreferrer noopener" target="_blank"> Jobs</a>
                                      </td>
                                    </tr> -->
                                    <tr>
                                      <td align="center" style="border-collapse:collapse;padding:15px">
                                        <table border="0" width="100%" cellspacing="0" cellpadding="0" style="border-collapse:collapse">
                                          <tbody>
                                            <tr>
                                              <td align="center" style="border-collapse:collapse">
                                                <a href="#" rel="noreferrer noopener" target="_blank">
                                                  <img alt="<?= Project ?>" width="130" height="auto" style="display:block;border:none;font-family:ProximaNova,Helvetica,Arial,sans-serif;color:#5662a6;text-transform:none;font-size:15px;letter-spacing:1px;line-height:25px;max-width:130px;font-weight:400" src="<?= base_url() ?>/assets/img/logo.png" class="CToWUd" data-bit="iit">
                                                </a>
                                              </td>
                                            </tr>
                                          </tbody>
                                        </table>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td align="center" style="border-collapse:collapse;border:0;display:block;padding-bottom:15px">
                                        <table border="0" cellspacing="0" cellpadding="0" align="center" style="border:none;border-collapse:collapse">
                                          <tbody>
                                            <tr>
                                            <?php if(!empty($social_list)) { 
                                            foreach ($social_list as $key => $value) { ?>
                                              <td style="font-size:1px;line-height:1px;width:45px">&nbsp;</td>
                                              <td valign="middle" width="30">
                                                <a href="<?= $value['link']?>" style="text-align:center" rel="noreferrer noopener" target="_blank">
                                                <img alt="<?= $value['title']?>" width="30" height="30" border="0" style="display:inline-block" src="../<?= $value['image']?>" class="CToWUd" data-bit="iit">
                                                </a>
                                              </td>
                                              <?php  $i++; }  }?>
                                            </tr>
                                          </tbody>
                                        </table>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td style="padding:0 30px 30px 30px;text-align:center">
                                        <table border="0" width="100%" cellspacing="0" cellpadding="0">
                                          <tbody>
                                            <tr>
                                              <td width="100%" style="font-family:ProximaNova,Helvetica,Arial,sans-serif;font-size:10px;color:#c8c1be;font-weight:400;text-decoration:none;text-align:center;line-height:12px;padding-top:10px"> ©2021 <?= Project ?>. All Rights Reserved.</td>
                                            </tr>
                                            <tr>
                                              <td width="100%" style="font-family:ProximaNova,Helvetica,Arial,sans-serif;font-size:10px;color:#c8c1be;font-weight:400;text-decoration:none;text-align:center;line-height:12px;padding-top:10px"> The sender of this email is <?= Project ?></td>
                                            </tr>
                                          </tbody>
                                        </table>
                                      </td>
                                    </tr>
                                  </tbody>
                                </table>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </td>
            </tr>
        </tbody>
    </table>
