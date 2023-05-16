<?php 
use App\Models\Common_model;
$this->common_model = new Common_model;
$this->db      = \Config\Database::connect();
$this->currency = $currency;
                                                      
$product = $this->common_model->GetSingleData('product',array('id'=> $sell_product['product_id']));
$image = $this->common_model->GetSingleData('product_image',array('product_id'=> $product['id'])); 
$category= $this->common_model->GetSingleData('categories',array('id'=> $product['category'])); 
$highestbid = convert_currency(get_hl_bid_price($product['id'])['grand_total'] , $this->currency , 'HKD');
$lowestask = convert_currency(get_hl_price($product['id'])['lowest'] , $this->currency , 'HKD');
$data['social_list'] = $this->common_model->GetAllData('social_links','','id','desc');
$sell = $sell_product;   
                                                        
 ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>
<table align="center" style="border-collapse:collapse;margin:0 auto" border="0" width="100%" cellspacing="0" cellpadding="0" bgcolor="#eae8e3"><tbody><tr><td align="center" colspan="1" rowspan="1" valign="top" style="text-align:center" bgcolor="#eae8e3" width="640">
<table align="center" style="border-collapse:collapse;margin:0 auto;table-layout:fixed;max-width:100%" border="0" width="640" cellspacing="0" cellpadding="0"><tbody><tr><td align="center" colspan="1" rowspan="1" valign="top" style="border-collapse:collapse;padding:0px" width="640">
<table align="center" style="border-collapse:collapse" border="0" width="640" cellspacing="0" cellpadding="0"><tbody><tr><td colspan="1" rowspan="1">
<table align="center" border="0" width="640" cellspacing="0" cellpadding="0"><tbody><tr><td align="center" colspan="1" rowspan="1" style="font-family:Arial,Helvetica Neue,Helvetica,sans-serif;color:#a0a0a0;font-size:0px;margin:0px;line-height:0px" width="640">We have removed your Ask from our marketplace<br clear="none"> &nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;<wbr>&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;<wbr>&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;<wbr>&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;<wbr>&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;<wbr>&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;<wbr>&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;<wbr>&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;<wbr>&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;<wbr>&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;<wbr>&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;<wbr>&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;<wbr>&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;<wbr>&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;<wbr>&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;<wbr>&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;<wbr>&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;<wbr>&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;<wbr>&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;<wbr>&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;<wbr>&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;<wbr>&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;<wbr>&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;<wbr>&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;<wbr>&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;<wbr>&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;<wbr>&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;<wbr>&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;<wbr>&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;<wbr>&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;<wbr>&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;</td></tr></tbody></table>
</td></tr><tr><td colspan="1" rowspan="1" id="m_-3797675800526072139ydpa7229e77yiv5555231669ydpcab2bd6fyiv4100266104wrapper" width="100%">
<table align="center" style="border-collapse:collapse;min-width:100%" border="0" width="100%" cellspacing="0" cellpadding="0"><tbody><tr><td colspan="1" rowspan="1" style="border:1px #bfbcb3 solid" bgcolor="#4F4A9E" width="100%">
<table align="center" style="border-collapse:collapse" border="0" width="100%" cellspacing="0" cellpadding="0"><tbody><tr><td align="center" colspan="2" rowspan="1" valign="top" bgcolor="#3e4c96" width="640">
<table style="border-collapse:collapse;margin:0" border="0" width="640" height="340" cellspacing="0" cellpadding="0"><tbody><tr><td align="left" colspan="1" rowspan="1" valign="top" id="m_-3797675800526072139ydpa7229e77yiv5555231669ydpcab2bd6fyiv4100266104padding_45_bottom" style="border-collapse:collapse;padding:45px 190px 0 105px" height="250"><a shape="rect" href="<?= base_url() ?>"><img style="display:block;border:none;font-family:Arial,Helvetica Neue,Helvetica,sans-serif;color:#d4d1c7;text-transform:none;font-size:15px;letter-spacing:1px;line-height:25px" src="<?= base_url() ?>/assets/img/logo1.png" alt="<?= Project ?>" width="50" height="auto" class="CToWUd" data-bit="iit"></a></td><td align="center" colspan="1" rowspan="1" valign="top" id="m_-3797675800526072139ydpa7229e77yiv5555231669ydpcab2bd6fyiv4100266104padding_45_bottom" style="padding:40px 40px 20px 0px" bgcolor="#3e4c96" width="50%">
<table style="border-collapse:collapse;margin:0" border="0" cellspacing="0" cellpadding="0"><tbody><tr><td align="right" colspan="1" rowspan="1" id="m_-3797675800526072139ydpa7229e77yiv5555231669ydpcab2bd6fyiv4100266104letterHeader" style="font-family:Arial,Helvetica Neue,Helvetica,sans-serif;font-size:40px;color:#d4d1c7;text-decoration:none;text-align:left;line-height:40px;font-weight:600">Your ask is about to expire</td></tr></tbody></table>
</td></tr></tbody></table>
</td></tr><tr><td align="center" colspan="1" rowspan="1" valign="top" bgcolor="#000000" width="640">
<table style="border-collapse:collapse;margin:0" border="0" width="640" cellspacing="0" cellpadding="0"><tbody><tr><td align="center" colspan="1" rowspan="1" valign="top" bgcolor="#000000" width="320">
<table style="border-collapse:collapse;margin:0" border="0" width="320" cellspacing="0" cellpadding="0"><tbody><tr><td align="left" colspan="1" rowspan="1" valign="top" style="border-collapse:collapse;padding:45px 0px 0 45px" height="100%"><a shape="rect" href="<?= base_url();?>"><img style="display:block;border:none;font-family:Arial,Helvetica Neue,Helvetica,sans-serif;color:rgb(212,209,199);text-transform:none;font-size:15px;letter-spacing:1px;line-height:25px;width:200px;max-width:200px" src="<?= base_url() ?>/assets/img/cross.png" alt="<?= Project ?>" class="CToWUd" data-bit="iit"></a></td></tr></tbody></table>
</td><td align="center" colspan="1" rowspan="1" valign="top" bgcolor="#000000" width="320">
<table style="border-collapse:collapse;margin:0" border="0" width="320" cellspacing="0" cellpadding="0"><tbody><tr><td align="left" colspan="1" rowspan="1" valign="top" id="m_-3797675800526072139ydpa7229e77yiv5555231669ydpcab2bd6fyiv4100266104subheaderText" bgcolor="#000000" width="320">
<table style="border-collapse:collapse;margin:0" border="0" cellspacing="0" cellpadding="0"><tbody><tr><td align="right" colspan="1" rowspan="1" style="font-family:Arial,Helvetica Neue,Helvetica,sans-serif;font-size:15px;color:#d4d1c7;text-decoration:none;text-align:left;line-height:18px;font-weight:600;padding:40px 40px 5px 0" width="280">Your ask amount</td></tr><tr><td align="right" colspan="1" rowspan="1" id="m_-3797675800526072139ydpa7229e77yiv5555231669ydpcab2bd6fyiv4100266104price" style="font-family:Arial,Helvetica Neue,Helvetica,sans-serif;font-size:85px;color:#d4d1c7;text-decoration:none;text-align:left;line-height:75px;font-weight:600;padding:0px 40px 40px 0" width="280"><?= $this->currency ?><?= convert_currency($sell_product['price'], $this->currency , 'HKD') ?></td></tr></tbody></table>
</td></tr></tbody></table>
</td></tr></tbody></table>
</td></tr><tr><td colspan="2" rowspan="1" id="m_-3797675800526072139ydpa7229e77yiv5555231669ydpcab2bd6fyiv4100266104topcopy30" style="padding:45px 20px 45px 105px;line-height:0;font-size:0" bgcolor="#000000">
<table border="0" cellspacing="0" cellpadding="0"><tbody><tr>
  <td align="center" colspan="1" rowspan="1" style="font-family:Arial,Helvetica Neue,Helvetica,sans-serif;font-size:18px;color:#d4d1c7;text-decoration:none;text-align:left;line-height:24px;font-weight:400;padding-bottom:15px" width="100%">Your Ask for the <?= $product['title'] ?> is about to expire and is no longer active on our marketplace. Please review the ask or sell now by clicking below.</td>
  
</tr><tr><td align="center" colspan="1" rowspan="1" style="font-family:Arial,Helvetica Neue,Helvetica,sans-serif;font-size:18px;color:#000000;text-decoration:none;text-align:center;line-height:16px;font-weight:normal;padding:20px 40px 20px 0" width="100%">
<table align="left" border="0" cellspacing="0" cellpadding="0"><tbody><tr><td align="center" colspan="1" rowspan="1" style="border-radius:2px;padding:8px 18px;border:1px solid #000000" bgcolor="#D4D1C7"><a shape="rect" href="<?= get_product_sell_url($product);?>" style="font-size:20px;font-family:Arial,Helvetica Neue,Helvetica,sans-serif;color:#000000;text-decoration:none;border-radius:2px;border:0;display:inline-block;line-height:35px;padding:0 10px;font-weight:500">Update Ask</a></td></tr></tbody></table>
</td></tr></tbody></table>
</td></tr><tr><td align="center" colspan="2" rowspan="1" style="padding:0;background-color:#ffffff" width="640" height="auto">
<table align="center" border="0" cellspacing="0" cellpadding="0"><tbody><tr><td align="center" colspan="1" rowspan="1">
<table align="center" border="0" cellspacing="0" cellpadding="0"><tbody><tr><td align="left" colspan="1" rowspan="1" style="border-collapse:collapse;margin:0;padding:15px" width="260"><a shape="rect" href="<?= get_product_url($product);?>"><img style="display:block;border:none;font-family:Arial,Helvetica Neue,Helvetica,sans-serif;font-size:22px;color:rgb(0,0,0);text-decoration:none;text-align:center;letter-spacing:1px;width:260px;max-width:800px" src="<?= base_url($image['image']) ?>" alt="<?= $product['title'] ?>" class="CToWUd" data-bit="iit"></a></td><td align="left" colspan="1" rowspan="1" width="280">
<table align="center" border="0" cellspacing="0" cellpadding="0"><tbody><tr><td colspan="1" rowspan="1" style="font-family:Arial,Helvetica Neue,Helvetica,sans-serif;font-size:24px;color:#d4d1c7;text-decoration:none;text-align:left;line-height:30px;padding:30px 15px 15px 15px;font-weight:500" width="280"><a shape="rect" href="<?= get_product_url($product);?>" style="color:#000000;text-decoration:none" ><?= $product['title'] ?></a></td></tr><tr><td colspan="1" rowspan="1" style="font-family:Arial,Helvetica Neue,Helvetica,sans-serif;font-size:13px;color:#000000;text-decoration:none;text-align:left;line-height:16px;font-weight:600;padding:0 0 0 15px" width="280">
<ul style="list-style-type:none;margin:0;padding:5px 0 0 0"><li style="list-style-type:none;margin:0">Category:&nbsp;<?= $category['title'] ?></li> <li style="list-style-type:none;margin:0">Condition:</span>&nbsp;<ul>
<li style="white-space: nowrap;"><b>Playable : </b> <?= ($sell['is_new'] == 1) ? '&#10003;' : '&#10539;' ?></li>
                                <li style="white-space: nowrap;"><b>Ship in 2 business days : </b> <?= ($sell['is_ship_in_2_days'] == 1) ? '&#10003;' : '&#10539;' ?></li>
                                <li style="white-space: nowrap;"><b>  Game Condition : </b> <?= $sell['game_condition'].'%'; ?></li>
                              </ul></li><li style="list-style-type:none;margin:0">Release Date:</span>&nbsp;<?= $product['release_date'] ?></li><li style="list-style-type:none;margin:0">Format:</span>&nbsp;<?= $product['format'] ?></li><li style="list-style-type:none;margin:0">Highest Bid:&nbsp;<?= $this->currency ?><?= $highestbid; ?>&nbsp;&nbsp;&nbsp; Lowest Ask:&nbsp;<?= $this->currency ?><?= $lowestask; ?>&nbsp;&nbsp;&nbsp; </li></ul>
</td></tr><tr><td align="center" colspan="1" rowspan="1" style="font-family:Arial,Helvetica Neue,Helvetica,sans-serif;font-size:18px;color:#000000;text-decoration:none;text-align:center;line-height:16px;font-weight:normal;padding:15px 0 30px 15px" width="100%">
<table border="0" cellspacing="0" cellpadding="0"><tbody><tr><td align="center" colspan="1" rowspan="1" style="border-radius:2px;padding:8px 18px" bgcolor="#000000"><a shape="rect" href="<?= get_product_sell_url($product);?>" style="font-size:20px;font-family:Arial,Helvetica Neue,Helvetica,sans-serif;color:#ffffff;text-decoration:none;border-radius:2px;border:0;display:inline-block;line-height:35px;padding:0 10px;font-weight:500" >Sell Now</a></td></tr></tbody></table>
</td></tr></tbody></table>
</td></tr></tbody></table>
</td></tr></tbody></table>
</td></tr></tbody></table>
</td></tr><tr><td align="left" colspan="1" rowspan="1" style="padding:0" bgcolor="#3e4c96" width="100%">
<!--<table border="0" width="640" cellspacing="0" cellpadding="0"><tbody><tr><td align="left" colspan="1" rowspan="1" style="padding:45px 30px 45px 0px">
 <table border="0" cellspacing="0" cellpadding="0"><tbody><tr><td align="center" colspan="1" rowspan="1" style="font-family:Arial,Helvetica Neue,Helvetica,sans-serif;font-size:18px;color:#d4d1c7;text-decoration:none;text-align:left;line-height:24px;font-weight:normal;padding-left:105px">
<ul style="margin:0;padding:0;font-family:Arial,Helvetica Neue,Helvetica,sans-serif;color:#d4d1c7;font-size:18px;line-height:24px;font-weight:600;display:inline-block;list-style-type:none"><li style="display:inline-block;padding-right:5px;margin:0"><a shape="rect" href="#" style="text-decoration:none;color:#d4d1c7">Email Settings</a></li><li style="display:inline-block;border-left:#d4d1c7 1px solid;padding:0 10px;margin:0"><a shape="rect" href="#" style="text-decoration:none;color:#d4d1c7" >Help</a></li><li style="display:inline-block;border-left:#d4d1c7 1px solid;padding-left:10px;margin:0"><a shape="rect" href="#" style="text-decoration:none;color:#d4d1c7" >Jobs</a></li></ul>
</td></tr></tbody></table>
</td></tr></tbody></table> -->
</td></tr><tr><td align="center" colspan="1" rowspan="1" style="border-collapse:collapse;padding:15px" bgcolor="#000000">
<table style="border-collapse:collapse;" border="0" width="100%" cellspacing="0" cellpadding="0"><tbody><tr><td align="center" colspan="1" rowspan="1" style="border-collapse:collapse; padding-bottom: 10px;"><a shape="rect" href="<?= get_product_url($product);?>"><img style="display:block;border:none;font-family:ProximaNova,Helvetica,Arial,sans-serif;color:#d4d1c7;text-transform:none;font-size:15px;letter-spacing:1px;line-height:25px;max-width:130px;font-weight:400" src="<?= base_url() ?>/assets/img/cross.png" alt="<?= Project ?>" width="130" height="auto" class="CToWUd" data-bit="iit"></a></td></tr><tr><td align="center" colspan="1" rowspan="1" style="border-collapse:collapse;border:0;display:block;padding-bottom:15px">
<table align="center" style="border:none;border-collapse:collapse" border="0" cellspacing="0" cellpadding="0"><tbody><tr>
                                            <?php if(!empty($social_list)) { 
                                            foreach ($social_list as $key => $value) { ?>
                                              <td style="font-size:1px;line-height:1px;width:45px">&nbsp;</td>
                                              <td valign="middle" width="30">
                                                <a href="<?= $value['link']?>" style="text-align:center" rel="noreferrer noopener" target="_blank">
                                                <img alt="<?= $value['title']?>" width="30" height="30" border="0" style="display:inline-block" src="<?= base_url($value['image'])?>" class="CToWUd" data-bit="iit">
                                                </a>
                                              </td>
                                              <?php  $i++; }  }?>
                                            </tr></tbody></table>
</td></tr><tr><td colspan="1" rowspan="1" style="padding:0 30px 30px 30px;text-align:center">
<table border="0" width="100%" cellspacing="0" cellpadding="0"><tbody><tr><td colspan="1" rowspan="1" style="font-family:Arial,Helvetica Neue,Helvetica,sans-serif;font-size:10px;color:#d4d1c7;font-weight:400;text-decoration:none;text-align:center;line-height:12px;padding-top:10px" width="100%">©2022 <?= Project ?>. All Rights Reserved.</td></tr><tr><td colspan="1" rowspan="1" style="font-family:Arial,Helvetica Neue,Helvetica,sans-serif;font-size:10px;color:#d4d1c7;font-weight:400;text-decoration:none;text-align:center;line-height:12px;padding-top:5px" width="100%">The sender of this email is <?= Project ?> </td></tr><tr><td colspan="1" rowspan="1" style="font-family:Arial,Helvetica Neue,Helvetica,sans-serif;font-size:10px;color:#d4d1c7;font-weight:400;text-decoration:none;text-align:center;line-height:12px;padding-top:5px" width="100%"></td></tr></tbody></table>
</td></tr></tbody></table>
</td></tr></tbody></table>
</td></tr></tbody></table>
</td></tr></tbody></table>
</td></tr></tbody></table>
</body>
</html>