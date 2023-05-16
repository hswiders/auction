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
$social_list = $this->common_model->GetAllData('social_links','','id','desc');
$faq_list = $this->common_model->GetAllData('faqs','','id','desc',3);
$sell_price = convert_currency($sell_product["price"], $this->currency , 'HKD');                                                      
$dis_price = convert_currency($sell_product["dis_price"], $this->currency , 'HKD');
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
<table align="center" border="0" width="100%" cellspacing="0" cellpadding="0" bgcolor="#eae8e3" style="border-collapse:collapse;margin:0 auto"><tbody><tr><td align="center" colspan="1" rowspan="1" valign="top" bgcolor="#eae8e3" width="640" style="text-align:center">
<table align="center" border="0" width="640" cellspacing="0" cellpadding="0" style="border-collapse:collapse;margin:0 auto;table-layout:fixed;max-width:100%"><tbody><tr><td align="center" colspan="1" rowspan="1" valign="top" width="640" style="border-collapse:collapse;padding:0px">
<table align="center" border="0" width="640" cellspacing="0" cellpadding="0" style="border-collapse:collapse"><tbody><tr><td colspan="1" rowspan="1">
<table align="center" border="0" width="640" cellspacing="0" cellpadding="0"><tbody><tr><td align="center" colspan="1" rowspan="1" width="640" style="font-family:Arial,Helvetica Neue,Helvetica,sans-serif;color:#a0a0a0;font-size:0px;margin:0px;line-height:0px">
There’s a new low Ask on the item you’re selling...<br clear="none">
&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;<wbr>&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;<wbr>&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;<wbr>&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;<wbr>&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;<wbr>&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;<wbr>&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;<wbr>&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;<wbr>&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;<wbr>&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;<wbr>&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;<wbr>&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;<wbr>&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;<wbr>&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;<wbr>&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;<wbr>&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;<wbr>&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;<wbr>&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;<wbr>&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;<wbr>&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;<wbr>&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;<wbr>&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;<wbr>&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;<wbr>&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;<wbr>&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;<wbr>&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;<wbr>&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;<wbr>&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;<wbr>&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;<wbr>&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;<wbr>&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;</td></tr></tbody></table>
</td></tr><tr><td colspan="1" rowspan="1" id="m_-4062437623522576962m_7250510105398106006ydpd5e59783yiv5761140105x_wrapper" width="100%">
<table align="center" border="0" width="100%" cellspacing="0" cellpadding="0" style="border-collapse:collapse;min-width:100%"><tbody><tr><td colspan="1" rowspan="1" bgcolor="#3e4c96" width="100%">
<table align="center" border="0" width="100%"  cellspacing="0" cellpadding="0" style="border-collapse:collapse"><tbody><tr><td align="center" colspan="2" rowspan="1" valign="top" bgcolor="#3e4c96" width="640" >
<table border="0" width="640"  cellspacing="0" cellpadding="0" style="border-collapse:collapse;margin:0"><tbody><tr><td align="left" colspan="1" rowspan="1" height="300px" valign="top" id="m_-4062437623522576962m_7250510105398106006ydpd5e59783yiv5761140105x_padding_45_bottom" height="250" style="border-collapse:collapse;padding:45px 190px 0 105px">
<a shape="rect" href="<?= base_url() ?>"><img alt="<?= Project ?>" width="50" height="auto" style="display:block;border:none;font-family:Arial,Helvetica Neue,Helvetica,sans-serif;color:#d4d1c7;text-transform:none;font-size:15px;letter-spacing:1px;line-height:25px" src="<?= base_url() ?>/assets/img/logo1.png" class="CToWUd" data-bit="iit"></a></td><td align="center" colspan="1" rowspan="1" valign="top" id="m_-4062437623522576962m_7250510105398106006ydpd5e59783yiv5761140105x_padding_45_bottom" bgcolor="#3e4c96" width="50%" style="padding:40px 40px 20px 0px">
<table border="0" cellspacing="0" cellpadding="0" style="border-collapse:collapse;margin:0"><tbody><tr><td align="right" colspan="1" rowspan="1" id="m_-4062437623522576962m_7250510105398106006ydpd5e59783yiv5761140105x_letterHeader" style="font-family:Arial,Helvetica Neue,Helvetica,sans-serif;font-size:48px;color:#d4d1c7;text-decoration:none;text-align:left;line-height:50px;font-weight:600">
New Lowest Ask!</td></tr></tbody></table>
</td></tr></tbody></table>
</td></tr><tr><td align="center" colspan="1" rowspan="1" valign="top" bgcolor="#000000" width="640">
<table border="0" width="640" cellspacing="0" cellpadding="0" style="border-collapse:collapse;margin:0"><tbody><tr><td align="center" colspan="2" rowspan="1" valign="top" bgcolor="#000000" width="640">
<table border="0" width="640" cellspacing="0" cellpadding="0" style="border-collapse:collapse;margin:0"><tbody><tr><td align="center" colspan="1" rowspan="1" valign="top" bgcolor="#000000" width="640">
<table border="0" width="640" cellspacing="0" cellpadding="0" style="border-collapse:collapse;margin:0;display:inline-block"><tbody><tr><td align="left" colspan="1" rowspan="1" valign="top" bgcolor="#000000" width="195" style="padding:0 20px 0 105px;display:inline-block;max-width:195px">
<table border="0" width="195" cellspacing="0" cellpadding="0" style="border-collapse:collapse;margin:0;display:inline-block;max-width:195px"><tbody><tr><td align="left" colspan="1" rowspan="1" width="195" style="font-family:Arial,Helvetica Neue,Helvetica,sans-serif;font-size:15px;color:#d4d1c7;text-decoration:none;text-align:left;line-height:15px;font-weight:600;padding:40px 0px 10px 0;display:block">
Your Ask</td></tr><tr><td align="left" colspan="1" rowspan="1" width="190" style="font-family:Arial,Helvetica Neue,Helvetica,sans-serif;font-size:50px;color:#d4d1c7;text-decoration:none;text-align:left;line-height:50px;font-weight:600;padding:0px 40px 40px 0;letter-spacing:normal">
<?= $this->currency ?><?= $sell_price ?></td></tr></tbody></table>
</td><td align="left" colspan="1" rowspan="1" valign="top" bgcolor="#000000" width="250" style="display:inline-block">
<table border="0" width="250" cellspacing="0" cellpadding="0" style="border-collapse:collapse;margin:0;display:inline-block"><tbody><tr><td align="right" colspan="1" rowspan="1" width="250" style="font-family:Arial,Helvetica Neue,Helvetica,sans-serif;font-size:15px;color:#d4d1c7;text-decoration:none;text-align:left;line-height:15px;font-weight:600;padding:40px 0px 10px 0">
New Lowest Ask</td></tr><tr><td align="left" colspan="1" rowspan="1" style="font-family:Arial,Helvetica Neue,Helvetica,sans-serif;font-size:50px;color:#d4d1c7;text-decoration:none;text-align:left;line-height:50px;font-weight:600;padding:0px 40px 40px 0;letter-spacing:normal">
$ <?= number_format($lowestask) ?></td></tr></tbody></table>
</td></tr></tbody></table>
</td></tr></tbody></table>
</td></tr></tbody></table>
</td></tr><tr><td colspan="2" rowspan="1" id="m_-4062437623522576962m_7250510105398106006ydpd5e59783yiv5761140105x_topcopy30" bgcolor="#000000" style="padding:0px 20px 0px 105px;line-height:0;font-size:0">
<table border="0" cellspacing="0" cellpadding="0"><tbody><tr><td align="center" colspan="1" rowspan="1" width="100%" style="font-family:Arial,Helvetica Neue,Helvetica,sans-serif;font-size:18px;color:#000000;text-decoration:none;text-align:center;line-height:16px;font-weight:normal;padding:20px 40px 20px 0">
<table align="left" border="0" cellspacing="0" cellpadding="0"><tbody><tr><td align="center" colspan="1" rowspan="1" bgcolor="#D4D1C7" style="border-radius:2px;padding:8px 18px;border:1px solid #000000">
<a shape="rect" href="<?= get_product_sell_url($product);?>" style="font-size:20px;font-family:Arial,Helvetica Neue,Helvetica,sans-serif;color:#000000;text-decoration:none;border-radius:2px;border:0;display:inline-block;line-height:35px;padding:0 10px;font-weight:500">Update
 Your Ask</a></td></tr></tbody></table>
</td></tr></tbody></table>
</td></tr><tr><td colspan="2" rowspan="1" bgcolor="#000000" style="padding:0 20px 45px 105px;line-height:0;font-size:0">
<table border="0" cellspacing="0" cellpadding="0"><tbody><tr><td align="center" colspan="1" rowspan="1" width="100%" style="font-family:Arial,Helvetica Neue,Helvetica,sans-serif;font-size:18px;color:#d4d1c7;text-decoration:none;text-align:left;line-height:24px;font-weight:400">
There’s a new lowest Ask on the item you’re selling. As a reminder, the lowest Ask tends to sell first, so if you’re looking to make a move now is the time.
<a shape="rect" href="<?= get_product_sell_url($product);?>" style="text-decoration:underline;color:#d4d1c7">
Update your Ask</a> price to sell this even quicker!</td></tr></tbody></table>
</td></tr><tr><td align="center" colspan="2" rowspan="1" width="640" height="auto" style="padding:0;background-color:#ffffff">
<table align="center" border="0" cellspacing="0" cellpadding="0"><tbody><tr><td align="center" colspan="1" rowspan="1">
<table align="center" border="0" cellspacing="0" cellpadding="0"><tbody><tr><td align="left" colspan="1" rowspan="1" width="260" style="border-collapse:collapse;margin:0;padding:15px">
<a shape="rect" href="<?= get_product_sell_url($product);?>"><img alt="<?= $product['title'] ?>" style="display:block;border:none;font-family:Arial,Helvetica Neue,Helvetica,sans-serif;font-size:22px;color:rgb(0,0,0);text-decoration:none;text-align:center;letter-spacing:1px;width:260px;max-width:800px" src="<?= base_url($image['image']) ?>" class="CToWUd" data-bit="iit"></a></td><td align="left" colspan="1" rowspan="1" width="280">
<table align="center" border="0" cellspacing="0" cellpadding="0"><tbody><tr><td colspan="1" rowspan="1" width="280" style="font-family:Arial,Helvetica Neue,Helvetica,sans-serif;font-size:24px;color:#d4d1c7;text-decoration:none;text-align:left;line-height:30px;padding:30px 15px 15px 15px;font-weight:500">
<a shape="rect" href="<?= get_product_sell_url($product);?>" style="color:#000000;text-decoration:none"><?= $product['title'] ?></a></td></tr><tr><td colspan="1" rowspan="1" width="280" style="font-family:Arial,Helvetica Neue,Helvetica,sans-serif;font-size:13px;color:#000000;text-decoration:none;text-align:left;line-height:16px;font-weight:600;padding:0 0 0 15px">
<ul style="list-style-type:none;margin:0;padding:5px 0 0 0"><li style="list-style-type:none;margin:0">Category:</span>&nbsp;<?= $category['title'] ?></li><li style="list-style-type:none;margin:0">Condition:</span>&nbsp;<ul>
<li style="white-space: nowrap;"><b>Playable : </b> <?= ($sell['is_new'] == 1) ? '&#10003;' : '&#10539;' ?></li>
                                <li style="white-space: nowrap;"><b>Ship in 2 business days : </b> <?= ($sell['is_ship_in_2_days'] == 1) ? '&#10003;' : '&#10539;' ?></li>
                                <li style="white-space: nowrap;"><b>  Game Condition : </b> <?= $sell['game_condition'].'%'; ?></li>
                              </ul></li><li style="list-style-type:none;margin:0">Release Date:</span>&nbsp;<?= $product['release_date'] ?></li><li style="list-style-type:none;margin:0">Format:</span>&nbsp;<?= $product['format'] ?></li><li style="list-style-type:none;margin:0">Highest Bid:&nbsp;<?= $this->currency ?><?= number_format($highestbid) ?>&nbsp;&nbsp;&nbsp; Lowest Ask:&nbsp;<?= $this->currency ?><?= number_format($lowestask) ?>&nbsp;&nbsp;&nbsp;
</li></ul>
</td></tr><tr><td colspan="1" rowspan="1" width="280" style="font-family:Arial,Helvetica Neue,Helvetica,sans-serif;font-size:13px;color:#000005;text-decoration:none;text-align:left;line-height:16px;font-weight:600;padding:15px 0 0 15px">
Your Ask Expiration:&nbsp; September 11</td></tr><tr><td colspan="1" rowspan="1" width="280" style="font-family:Arial,Helvetica Neue,Helvetica,sans-serif;color:#000000;text-decoration:none;text-align:left;font-weight:400;padding:15px 0 0 15px">
<table align="left" border="0" cellspacing="0" cellpadding="0"><tbody><tr><td colspan="1" rowspan="1" width="200" style="font-family:Arial,Helvetica Neue,Helvetica,sans-serif;font-size:13px;color:#000000;text-decoration:none;text-align:left;line-height:16px;font-weight:600;min-width:200px">
Your Ask:</td><td align="right" colspan="1" rowspan="1" style="font-family:Arial,Helvetica Neue,Helvetica,sans-serif;font-size:13px;color:#000000;text-decoration:none;text-align:right;line-height:16px;font-weight:600">
<?= $this->currency ?><?= $sell_price ?></td></tr></tbody></table>
<table align="left" border="0" cellspacing="0" cellpadding="0"><tbody><tr><td colspan="1" rowspan="1" width="200" style="font-family:Arial,Helvetica Neue,Helvetica,sans-serif;font-size:13px;color:#000000;text-decoration:none;text-align:left;line-height:16px;font-weight:600;min-width:200px">
Transaction Fee (10%):</td><td align="right" colspan="1" rowspan="1" style="font-family:Arial,Helvetica Neue,Helvetica,sans-serif;font-size:13px;color:#000000;text-decoration:none;text-align:right;line-height:16px;font-weight:600">
<?= $this->currency ?> <?= $trans = $sell_price*10/100 ?></td></tr></tbody></table>
<table align="left" border="0" cellspacing="0" cellpadding="0"><tbody><tr><td colspan="1" rowspan="1" width="200" style="font-family:Arial,Helvetica Neue,Helvetica,sans-serif;font-size:13px;color:#000000;text-decoration:none;text-align:left;line-height:16px;font-weight:600;min-width:200px">
Payment Proc. (3%):</td><td align="right" colspan="1" rowspan="1" style="font-family:Arial,Helvetica Neue,Helvetica,sans-serif;font-size:13px;color:#000000;text-decoration:none;text-align:right;line-height:16px;font-weight:600">
<?= $this->currency ?> <?=$payment = $sell_price*3/100 ?></td></tr></tbody></table>
<table align="left" border="0" cellspacing="0" cellpadding="0"><tbody><tr><td colspan="1" rowspan="1" width="200" style="font-family:Arial,Helvetica Neue,Helvetica,sans-serif;font-size:13px;color:#000000;text-decoration:none;text-align:left;line-height:16px;font-weight:600;min-width:200px">
Shipping:</td><td align="right" colspan="1" rowspan="1" style="font-family:Arial,Helvetica Neue,Helvetica,sans-serif;font-size:13px;color:#000000;text-decoration:none;text-align:right;line-height:16px;font-weight:600">
<?= $this->currency ?> 0.0</td></tr></tbody></table>
<table align="left" border="0" cellspacing="0" cellpadding="0"><tbody><tr><td colspan="2" rowspan="1" width="240" style="font-family:Arial,Helvetica Neue,Helvetica,sans-serif;font-size:0px;color:#ffffff;text-decoration:none;text-align:left;line-height:0px;padding:5px 0 0 0;border-bottom:0px solid #000000">
&nbsp;&nbsp;</td></tr><tr><td colspan="1" rowspan="1" width="200" style="font-family:Arial,Helvetica Neue,Helvetica,sans-serif;font-size:14px;text-decoration:none;text-align:left;line-height:18px;font-weight:600;display:inline-block;min-width:200px;text-transform:uppercase;color:#000000">
Total Payout</td><td align="right" colspan="1" rowspan="1" style="text-align:right;font-family:Arial,Helvetica Neue,Helvetica,sans-serif;font-size:14px;color:#000000;text-decoration:none;line-height:18px;font-weight:600">
<?= $this->currency ?> <?=$total = $sell_price-$trans-$payment; ?></td></tr></tbody></table>
</td></tr><tr><td align="center" colspan="1" rowspan="1" width="100%" style="font-family:Arial,Helvetica Neue,Helvetica,sans-serif;font-size:18px;color:#000000;text-decoration:none;text-align:center;line-height:16px;font-weight:normal;padding:15px 0 30px 15px">
<table border="0" cellspacing="0" cellpadding="0"><tbody><tr><td align="center" colspan="1" rowspan="1" bgcolor="#000000" style="border-radius:2px;padding:8px 18px">
<a shape="rect" href="<?= get_product_sell_url($product);?>" style="font-size:20px;font-family:Arial,Helvetica Neue,Helvetica,sans-serif;color:#ffffff;text-decoration:none;border-radius:2px;border:0;display:inline-block;line-height:35px;padding:0 10px;font-weight:500">View
 Ask</a></td></tr></tbody></table>
</td></tr></tbody></table>
</td></tr><tr><td align="left" colspan="2" rowspan="1"></td></tr></tbody></table>
</td></tr></tbody></table>
</td></tr></tbody></table>
</td></tr><tr><td align="left" colspan="1" rowspan="1" bgcolor="#3e4c96" width="100%" style="padding:0">
<table border="0" width="640" cellspacing="0" cellpadding="0"><tbody><tr><td align="left" colspan="1" rowspan="1" style="padding:45px 30px 45px 0px">
<!-- <table border="0" cellspacing="0" cellpadding="0"><tbody><tr><td align="center" colspan="1" rowspan="1" style="font-family:Arial,Helvetica Neue,Helvetica,sans-serif;font-size:18px;color:#d4d1c7;text-decoration:none;text-align:left;line-height:24px;font-weight:normal;padding-left:105px">
<ul style="margin:0;padding:0;font-family:Arial,Helvetica Neue,Helvetica,sans-serif;color:#d4d1c7;font-size:18px;line-height:24px;font-weight:600;display:inline-block;list-style-type:none"><li style="display:inline-block;padding-right:5px;margin:0"><a shape="rect" href="#" style="text-decoration:none;color:#d4d1c7">Email
 Settings</a></li><li style="display:inline-block;border-left:#d4d1c7 1px solid;padding:0 10px;margin:0">
<a shape="rect" href="#" style="text-decoration:none;color:#d4d1c7">Help</a></li><li style="display:inline-block;border-left:#d4d1c7 1px solid;padding-left:10px;margin:0">
<a shape="rect" href="#" style="text-decoration:none;color:#d4d1c7">Jobs</a></li></ul>
</td></tr></tbody></table> -->
</td></tr></tbody></table>
</td></tr><tr><td align="center" colspan="1" rowspan="1" bgcolor="#000000" style="border-collapse:collapse;padding:15px">
<table border="0" width="100%" cellspacing="0" cellpadding="0" style="border-collapse:collapse"><tbody><tr><td align="center" colspan="1" rowspan="1" style="border-collapse:collapse; padding-bottom: 10px;"><a shape="rect" href="<?= base_url() ?>"><img alt="<?= Project ?>" width="130" height="auto" style="display:block;border:none;font-family:ProximaNova,Helvetica,Arial,sans-serif;color:#d4d1c7;text-transform:none;font-size:15px;letter-spacing:1px;line-height:25px;max-width:130px;font-weight:400" src="<?= base_url() ?>/assets/img/logo.png" class="CToWUd" data-bit="iit"></a></td></tr><tr><td align="center" colspan="1" rowspan="1" style="border-collapse:collapse;border:0;display:block;padding-bottom:15px">
<table align="center" border="0" cellspacing="0" cellpadding="0" style="border:none;border-collapse:collapse"><tbody><tr>
<?php if(!empty($social_list)) { 
foreach ($social_list as $key => $value) { ?>
<td style="font-size:1px;line-height:1px;width:45px">&nbsp;</td>
<td valign="middle" width="30">
<a href="<?= $value['link']?>" style="text-align:center" rel="noreferrer noopener" target="_blank">
<img alt="<?= $value['title']?>" width="30" height="30" border="0" style="display:inline-block" src="<?= base_url($value['image']) ?>" class="CToWUd" data-bit="iit">
</a>
</td>
<?php  $i++; }  }?></tr></tbody></table>
</td></tr><tr><td colspan="1" rowspan="1" style="padding:0 30px 30px 30px;text-align:center">
<table border="0" width="100%" cellspacing="0" cellpadding="0"><tbody><tr><td colspan="1" rowspan="1" width="100%" style="font-family:Arial,Helvetica Neue,Helvetica,sans-serif;font-size:10px;color:#d4d1c7;font-weight:400;text-decoration:none;text-align:center;line-height:12px;padding-top:10px">
©2022 <?= Project ?>. All Rights Reserved.</td></tr><tr><td colspan="1" rowspan="1" width="100%" style="font-family:Arial,Helvetica Neue,Helvetica,sans-serif;font-size:10px;color:#d4d1c7;font-weight:400;text-decoration:none;text-align:center;line-height:12px;padding-top:5px">
The sender of this email is <?= Project ?> </td></tr><tr><td colspan="1" rowspan="1" width="100%" style="font-family:Arial,Helvetica Neue,Helvetica,sans-serif;font-size:10px;color:#d4d1c7;font-weight:400;text-decoration:none;text-align:center;line-height:12px;padding-top:5px">
<a shape="rect" href="#" style="text-decoration:none;color:#d4d1c7">To unsubscribe, click here.</a></td></tr></tbody></table>
</td></tr></tbody></table>
</td></tr></tbody></table>
</td></tr></tbody></table>
</td></tr></tbody></table>
</td></tr></tbody></table>
</body>
</html>