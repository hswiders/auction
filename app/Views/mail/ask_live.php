<?php 
use App\Models\Common_model;
$this->common_model = new Common_model;
$this->db      = \Config\Database::connect();
//print_r($sell);
$this->currency = $currency;                                                     
$product = $this->common_model->GetSingleData('product',array('id'=> $sell['product_id'])); 
$image = $this->common_model->GetSingleData('product_image',array('product_id'=> $product['id'])); 
$category= $this->common_model->GetSingleData('categories',array('id'=> $product['category']));
$highestbid = convert_currency(get_hl_bid_price($product['id'])['grand_total'] , $this->currency , 'HKD');
$lowestask = convert_currency(get_hl_price($product['id'])['lowest'] , $this->currency , 'HKD');
$social_list = $this->common_model->GetAllData('social_links','','id','desc');
$faq_list = $this->common_model->GetAllData('faqs','','id','desc',3); 
$sell_price = convert_currency($sell["price"], $this->currency , 'HKD');                                                      
$dis_price = convert_currency($sell["dis_price"], $this->currency , 'HKD');
$trans_fee = convert_currency($sell['trans_fee'] ,  $this->currency , 'HKD');                                                     
$payment_fee = convert_currency($sell['payment_fee'] ,  $this->currency , 'HKD'); 
$shipping_fee = convert_currency($sell['shipping_fee'] ,  $this->currency , 'HKD');                                                   
 ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>
<table style="border-collapse:collapse;margin:0 auto" border="0" width="100%" cellspacing="0" cellpadding="0" align="center" bgcolor="#eae8e3">
<tbody>
<tr>
<td style="text-align:center" align="center" valign="top" bgcolor="#eae8e3" width="640">
<table style="border-collapse:collapse;margin:0 auto;table-layout:fixed;max-width:100%" border="0" width="640" cellspacing="0" cellpadding="0" align="center">
<tbody>
<tr>
<td style="border-collapse:collapse;padding:0px" align="center" valign="top" width="640">
<table style="border-collapse:collapse" border="0" width="640" cellspacing="0" cellpadding="0" align="center">
<tbody>
<tr>
<td>
<table border="0" width="640" cellspacing="0" cellpadding="0" align="center">    
<tbody>
<tr>
<td style="font-family:Arial,Helvetica Neue,Helvetica,sans-serif;color:#a0a0a0;font-size:0px;margin:0px;line-height:0px" align="center" width="640">Remember, when your Ask matches an Bid, the item is Sold...<br> &nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;<wbr>&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;<wbr>&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;<wbr>&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;<wbr>&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;<wbr>&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;<wbr>&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;<wbr>&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;<wbr>&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;<wbr>&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;<wbr>&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;<wbr>&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;<wbr>&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;<wbr>&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;<wbr>&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;<wbr>&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;<wbr>&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;<wbr>&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;<wbr>&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;<wbr>&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;<wbr>&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;<wbr>&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;<wbr>&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;<wbr>&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;<wbr>&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;<wbr>&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;<wbr>&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;<wbr>&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;<wbr>&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;<wbr>&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;<wbr>&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;</td>
</tr>
</tbody>
</table>
</td>
</tr>
 
<tr>
<td id="m_-1044079087543220284ydp93773b1ayiv7473363770wrapper" width="100%">
<table style="border-collapse:collapse;min-width:100%" border="0" width="100%" cellspacing="0" cellpadding="0" align="center">
<tbody>
<tr>
<td style="border:1px #bfbcb3 solid" bgcolor="#D4D1C7" width="100%">
<table style="border-collapse:collapse" border="0" width="100%" cellspacing="0" cellpadding="0" align="center">
<tbody> 
<tr>
<td align="center" valign="top" bgcolor="#3e4c96" width="640">
<table style="border-collapse:collapse;margin:0" border="0" width="640" height="340" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td id="m_-1044079087543220284ydp93773b1ayiv7473363770padding_45_bottom" style="border-collapse:collapse;min-height:250px;padding:45px 190px 0 105px" align="left" valign="top"><a href="#"><img style="display:block;border:none;font-family:Arial,Helvetica Neue,Helvetica,sans-serif;color:#d4d1c7;text-transform:none;font-size:15px;letter-spacing:1px;line-height:25px" src="<?= base_url() ?>/assets/img/logo1.png" alt="<?= Project ?>" width="50" height="auto" class="CToWUd" data-bit="iit"></a></td>
<td style="padding:40px 40px 20px 0px" align="center" valign="top" bgcolor="#3e4c96" width="50%">
<table style="border-collapse:collapse;margin:0" border="0" cellspacing="0" cellpadding="0">
<tbody> 
<tr>
<td id="m_-1044079087543220284ydp93773b1ayiv7473363770letterHeader" style="font-family:Arial,Helvetica Neue,Helvetica,sans-serif;font-size:55px;color:#d4d1c7;text-decoration:none;text-align:left;line-height:55px;font-weight:600" align="right">Your Ask Is Live!</td>
</tr>
<tr>
<td id="m_-1044079087543220284ydp93773b1ayiv7473363770padding_45_bottom" style="font-family:Arial,Helvetica Neue,Helvetica,sans-serif;font-size:25px;color:#d4d1c7;text-decoration:none;text-align:left;line-height:30px;font-weight:400" align="right"><?= $product['title'] ?></td>
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
<td bgcolor="#D4D1C7" width="100%">
<table style="border-collapse:collapse" border="0" width="100%" cellspacing="0" cellpadding="0" align="center">
<tbody>
<tr>
<td align="center" valign="top" bgcolor="#D4D1C7" width="320">
<table style="border-collapse:collapse;margin:0" border="0" width="320" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td style="border-collapse:collapse;padding:45px 0px 0 45px" align="left" valign="top" height="100%"><a href="<?= get_product_sell_url($product);?>"><img style="display:block;border:none;font-family:Arial,Helvetica Neue,Helvetica,sans-serif;color:rgb(0,0,0);text-transform:none;font-size:15px;letter-spacing:1px;line-height:25px;width:200px;max-width:200px" src="<?= base_url() ?>/assets/img/logo.png" alt="<?= Project ?>" class="CToWUd" data-bit="iit"></a></td>
</tr>
</tbody>
</table>
</td>
<td align="center" valign="top" bgcolor="#D4D1C7" width="320">
<table style="border-collapse:collapse;margin:0" border="0" width="320" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td id="m_-1044079087543220284ydp93773b1ayiv7473363770subheaderText" align="left" valign="top" bgcolor="#D4D1C7" width="320">
<table style="border-collapse:collapse;margin:0" border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td style="font-family:Arial,Helvetica Neue,Helvetica,sans-serif;font-size:15px;color:#000000;text-decoration:none;text-align:left;line-height:18px;font-weight:600;padding:40px 40px 5px 0" align="right" width="280">Your Ask Amount</td>
</tr>
<tr>
<td id="m_-1044079087543220284ydp93773b1ayiv7473363770price" style="font-family:Arial,Helvetica Neue,Helvetica,sans-serif;font-size:85px;color:#3e4c96;text-decoration:none;text-align:left;line-height:75px;font-weight:600;padding:0px 40px 40px 0" align="right" width="280"><?= $this->currency ?><?= $sell_price ?></td>
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
<td style="padding:10px 20px 45px 105px;line-height:0;font-size:0" colspan="2" bgcolor="#D4D1C7">
<table border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td id="m_-1044079087543220284ydp93773b1ayiv7473363770notop" style="font-family:Arial,Helvetica Neue,Helvetica,sans-serif;font-size:18px;color:#000005;text-decoration:none;text-align:left;line-height:24px;font-weight:400" align="center" width="100%">Thank you for placing a Ask on our marketplace. We'll send you updates on other Asks and higher Bids for this item should you ever want to adjust. Remember, the quickest way to sell this is to just to <a href="<?= get_product_sell_url($product);?>">Sell Now</a>.</td>
</tr>
</tbody>
</table>
</td>
</tr>
 
<tr>
<td style="padding:0;background-color:#ffffff" colspan="2" align="center" width="640" height="auto">
<table border="0" cellspacing="0" cellpadding="0" align="center">
<tbody>
<tr>
<td align="center">
<table border="0" cellspacing="0" cellpadding="0" align="center">
<tbody>
<tr>
<td style="border-collapse:collapse;margin:0;padding:15px" align="left" width="260"><a href="<?= get_product_url($product);?>"><img style="display:block;border:none;font-family:Arial,Helvetica Neue,Helvetica,sans-serif;font-size:22px;color:rgb(0,99,64);text-decoration:none;text-align:center;letter-spacing:1px;width:260px;max-width:800px" src="<?= base_url($image['image']) ?>" alt="<?= $product['title'] ?>" class="CToWUd" data-bit="iit"></a></td>
 
<td align="left" width="280">
<table border="0" cellspacing="0" cellpadding="0" align="center">
<tbody>
<tr>
<td style="font-family:Arial,Helvetica Neue,Helvetica,sans-serif;font-size:24px;color:#006340;text-decoration:none;text-align:left;line-height:30px;padding:30px 15px 15px 15px;font-weight:500" width="280"><a href="<?= get_product_url($product);?>" style="color:#3e4c96;text-decoration:none"><?= $product['title'] ?></a></td>
</tr>
 
<tr>
<td style="font-family:Arial,Helvetica Neue,Helvetica,sans-serif;font-size:13px;color:#000000;text-decoration:none;text-align:left;line-height:16px;font-weight:600;padding:0 0 0 15px" width="280">
<ul style="list-style-type:none;margin:0;padding:5px 0 0 0">   
<li style="list-style-type:none;margin:0">Category:</span>&nbsp;<?= $category['title'] ?></li>

<li style="list-style-type:none;margin:0">Condition:</span>&nbsp;<ul>
                                <li style="white-space: nowrap;"><b>Playable : </b> <?= ($sell['is_new'] == 1) ? '&#10003;' : '&#10539;' ?></li>
                                <li style="white-space: nowrap;"><b>Ship in 2 business days : </b> <?= ($sell['is_ship_in_2_days'] == 1) ? '&#10003;' : '&#10539;' ?></li>
                                <li style="white-space: nowrap;"><b>  Game Condition : </b> <?= $sell['game_condition'].'%'; ?></li>
                              </ul></li>
 
<li style="list-style-type:none;margin:0">Release Date:</span>&nbsp;<?= $product['release_date'] ?></li>

<li style="list-style-type:none;margin:0">Format:</span>&nbsp;<?= $product['format'] ?></li>
  
<li style="list-style-type:none;margin:0">Highest Bid:&nbsp;<?= $this->currency ?><?= number_format($highestbid) ?>&nbsp;&nbsp;&nbsp; Lowest Ask:&nbsp;<?= $this->currency ?><?= number_format($lowestask) ?>&nbsp;&nbsp;&nbsp; </li>
 </ul>
</td>
</tr>
<tr>
<td style="font-family:Arial,Helvetica Neue,Helvetica,sans-serif;font-size:13px;color:#000005;text-decoration:none;text-align:left;line-height:16px;font-weight:600;padding:15px 0 0 15px" width="280">Your Ask Expiration:&nbsp; <?= date('d F Y',strtotime($sell['exp_date'])); ?></td>
</tr>
 
<tr>
<td style="font-family:Arial,Helvetica Neue,Helvetica,sans-serif;color:#000000;text-decoration:none;text-align:left;font-weight:400;padding:15px 0 0 15px" width="280">
<table border="0" cellspacing="0" cellpadding="0" align="left">
<tbody>
<tr>
<td style="font-family:Arial,Helvetica Neue,Helvetica,sans-serif;font-size:13px;color:#000000;text-decoration:none;text-align:left;line-height:16px;font-weight:600;min-width:200px" width="200">Your Ask:</td>
<td style="font-family:Arial,Helvetica Neue,Helvetica,sans-serif;font-size:13px;color:#000000;text-decoration:none;text-align:right;line-height:16px;font-weight:600" align="right"><?= $this->currency ?><?= number_format($sell_price) ?></td>
</tr>
</tbody>
</table>

<table border="0" cellspacing="0" cellpadding="0" align="left">
<tbody>
<tr>
<td style="font-family:Arial,Helvetica Neue,Helvetica,sans-serif;font-size:13px;color:#000000;text-decoration:none;text-align:left;line-height:16px;font-weight:600;min-width:200px" width="200">Transaction Fee:</td>
<td style="font-family:Arial,Helvetica Neue,Helvetica,sans-serif;font-size:13px;color:#000000;text-decoration:none;text-align:right;line-height:16px;font-weight:600" align="right"><?= $this->currency ?><?= $trans_fee ?></td>
</tr>
</tbody>
</table>
<table border="0" cellspacing="0" cellpadding="0" align="left">
<tbody>
<tr>
<td style="font-family:Arial,Helvetica Neue,Helvetica,sans-serif;font-size:13px;color:#000000;text-decoration:none;text-align:left;line-height:16px;font-weight:600;min-width:200px" width="200">Payment proc.:</td>
<td style="font-family:Arial,Helvetica Neue,Helvetica,sans-serif;font-size:13px;color:#000000;text-decoration:none;text-align:right;line-height:16px;font-weight:600" align="right"><?= $this->currency ?><?= $payment_fee ?></td>
</tr>
</tbody>
</table>

<table border="0" cellspacing="0" cellpadding="0" align="left">
<tbody>
<tr>
<td style="font-family:Arial,Helvetica Neue,Helvetica,sans-serif;font-size:13px;color:#000000;text-decoration:none;text-align:left;line-height:16px;font-weight:600;min-width:200px" width="200">Shipping:</td>
<td style="font-family:Arial,Helvetica Neue,Helvetica,sans-serif;font-size:13px;color:#000000;text-decoration:none;text-align:right;line-height:16px;font-weight:600" align="right"><?= $this->currency ?> <?= $shipping_fee ?></td>
</tr>
</tbody>
</table>

<table border="0" cellspacing="0" cellpadding="0" align="left">
<tbody>
<tr>
<td style="font-family:Arial,Helvetica Neue,Helvetica,sans-serif;font-size:0px;color:#ffffff;text-decoration:none;text-align:left;line-height:0px;padding:5px 0 0 0;border-bottom:0px solid #000000" colspan="2" width="240">&nbsp;&nbsp;</td>
</tr>
<tr>
<td style="font-family:Arial,Helvetica Neue,Helvetica,sans-serif;font-size:14px;text-decoration:none;text-align:left;line-height:18px;font-weight:600;display:inline-block;min-width:200px;text-transform:uppercase;color:#3e4c96" width="200">Total Payment</td>
<td style="text-align:right;font-family:Arial,Helvetica Neue,Helvetica,sans-serif;font-size:14px;color:#3e4c96;text-decoration:none;line-height:18px;font-weight:600" align="right"><?= $this->currency ?><?= $dis_price ?></td>
</tr>
</tbody>
</table>
</td>
</tr>
 
<tr>
<td style="font-family:Arial,Helvetica Neue,Helvetica,sans-serif;font-size:18px;color:#000000;text-decoration:none;text-align:center;line-height:16px;font-weight:normal;padding:15px 0 30px 15px" align="center" width="100%">
<table border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td style="border-radius:2px;padding:8px 18px" align="center" bgcolor="#000000"><a href="<?= get_product_sell_url($product);?>" style="font-size:20px;font-family:Arial,Helvetica Neue,Helvetica,sans-serif;color:#ffffff;text-decoration:none;border-radius:2px;border:0;display:inline-block;line-height:35px;padding:0 10px;font-weight:500">View Asks</a></td>
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
<td colspan="2" align="left">
<table border="0" cellspacing="0" cellpadding="0" align="left">
<tbody>
<tr>
<td style="padding:0 0 15px 15px;font-family:Arial,Helvetica Neue,Helvetica,sans-serif;font-size:13px;color:#000000;text-decoration:none;text-align:left;line-height:16px;font-weight:300;font-style:italic" align="center" width="100%">*All applicable duties and VAT are included in the total price of this item.</td>
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
<td style="line-height:0;font-size:0;display:block" colspan="2">
<table border="0" width="100%" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td style="padding:30px 0" colspan="2" align="center" bgcolor="#6572bf">
<table style="display:block" border="0" cellspacing="0" cellpadding="0" align="center">
<tbody>
<tr>
<td style="font-family:Arial,Helvetica Neue,Helvetica,sans-serif;font-size:18px;color:#000000;text-decoration:none;text-align:left;line-height:24px;font-weight:600;padding-top:0px;padding-left:105px;padding-right:105px" align="center" width="100%">Frequently Asked Questions</td>
</tr>
<tr>
<td style="font-family:Arial,Helvetica Neue,Helvetica,sans-serif;font-size:18px;color:#000000;text-decoration:none;text-align:left;line-height:24px;font-weight:normal;padding-top:5px;padding-left:105px;padding-right:105px" align="center" width="100%">
<ul style="margin:0;margin-left:15px;padding:0;font-family:Arial,Helvetica Neue,Helvetica,sans-serif;color:#006340;font-size:15px;line-height:20px;font-weight:400" type="disc">
<?php if(!empty($faq_list)) { 
    foreach ($faq_list as $key => $value) { ?>
<li style="font-family:Arial,Helvetica Neue,Helvetica,sans-serif;color:#fff;font-size:15px;line-height:18px;font-weight:400"><a href="<?= base_url() ?>/faq" style="text-decoration:none;color:#fff" ><?= $value['ques']?></a></li>
<?php } } ?>
</ul>
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
<td style="padding:0" align="left" bgcolor="#3e4c96" width="100%">
<table border="0" width="640" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td style="padding:45px 30px 0px 0px" align="left">
<!-- <table border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td style="font-family:Arial,Helvetica Neue,Helvetica,sans-serif;font-size:18px;color:#d4d1c7;text-decoration:none;text-align:left;line-height:24px;font-weight:normal;padding-left:105px;padding-bottom:45px" align="center">
<ul style="margin:0;padding:0;font-family:Arial,Helvetica Neue,Helvetica,sans-serif;color:#d4d1c7;font-size:18px;line-height:24px;font-weight:600;display:inline-block;list-style-type:none">
<li style="display:inline-block;padding:0 5px 0 0;margin:0!important"><a href="#" style="text-decoration:none;color:#d4d1c7">Email Settings</a></li>
<li style="display:inline-block;border-left:#d4d1c7 1px solid;padding:0 10px"><a href="#" style="text-decoration:none;color:#d4d1c7;margin:0" >Help</a></li>

<li style="display:inline-block;border-left:#d4d1c7 1px solid;padding-left:10px;margin:0"><a href="#" style="text-decoration:none;color:#d4d1c7">Jobs</a></li>
</ul>
</td>
</tr>
</tbody>
</table> -->
</td>
</tr>
</tbody>
</table>
</td>
</tr>
 
<tr>
<td style="border-collapse:collapse;padding:15px" align="center" bgcolor="#eae8e3">
<table style="border-collapse:collapse" border="0" width="100%" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td style="border-collapse:collapse; padding-bottom: 10px;" align="center"><a href="#"><img style="display:block;border:none;font-family:ProximaNova,Helvetica,Arial,sans-serif;color:#006340;text-transform:none;font-size:15px;letter-spacing:1px;line-height:25px;max-width:130px;font-weight:400" src="<?= base_url() ?>/assets/img/logo.png" alt="<?= Project ?>" width="130" height="auto" class="CToWUd" data-bit="iit"></a></td>
</tr>

<tr>
<td style="border-collapse:collapse;border:0;display:block;padding-bottom:15px" align="center">
<table style="border:none;border-collapse:collapse" border="0" cellspacing="0" cellpadding="0" align="center">
<tbody>
<tr>
<?php if(!empty($social_list)) { 
foreach ($social_list as $key => $value) { ?>
<td style="font-size:1px;line-height:1px;width:45px">&nbsp;</td>
<td valign="middle" width="30">
<a href="<?= $value['link']?>" style="text-align:center" rel="noreferrer noopener" target="_blank">
<img alt="<?= $value['title']?>" width="30" height="30" border="0" style="display:inline-block" src="<?= base_url($value['image']) ?>" class="CToWUd" data-bit="iit">
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
<td style="font-family:Arial,Helvetica Neue,Helvetica,sans-serif;font-size:10px;color:#3e4c96;font-weight:400;text-decoration:none;text-align:center;line-height:12px;padding-top:10px" width="100%">©2022 <?= Project ?>. All Rights Reserved.</td>
</tr>
 
<tr>
<td style="font-family:Arial,Helvetica Neue,Helvetica,sans-serif;font-size:10px;color:#3e4c96;font-weight:400;text-decoration:none;text-align:center;line-height:12px;padding-top:5px" width="100%">The sender of this email is <?= Project ?> </td>
</tr>
 
<tr>
<td style="font-family:Arial,Helvetica Neue,Helvetica,sans-serif;font-size:10px;color:#3e4c96;font-weight:400;text-decoration:none;text-align:center;line-height:12px;padding-top:5px" width="100%"></td>
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
</td>
</tr>
</tbody>
</table>
</body>
</html>