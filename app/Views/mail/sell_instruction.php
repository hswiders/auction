<?php 
use App\Models\Common_model;
$this->common_model = new Common_model;
$this->db      = \Config\Database::connect();
$this->currency = $currency;                                                     
$product = $this->common_model->GetSingleData('product',array('id'=> $order['product_id'])); 
$image = $this->common_model->GetSingleData('product_image',array('product_id'=> $product['id'])); 
$category= $this->common_model->GetSingleData('categories',array('id'=> $product['category']));
$highestbid = convert_currency(get_hl_bid_price($product['id'])['grand_total'] , $this->currency , 'HKD');
$lowestask = convert_currency(get_hl_price($product['id'])['lowest'] , $this->currency , 'HKD');
$social_list = $this->common_model->GetAllData('social_links','','id','desc');
$faq_list = $this->common_model->GetAllData('faqs','','id','desc',3);   
$grand_total = convert_currency($order['grand_total'] ,  $this->currency , 'HKD');                                                     
$admin_fee = convert_currency($order['admin_fee'] ,  $this->currency , 'HKD');                                                     
 ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>
<div>
<div style="font-size:9pt;font-family:&quot;Segoe UI&quot;,&quot;Helvetica Neue&quot;,sans-serif;direction:ltr">
<div><font style="vertical-align:inherit"><font style="vertical-align:inherit"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">hello stanten,</font></font></font></font></div>
<div>&nbsp;</div>
<div><font style="vertical-align:inherit"><font style="vertical-align:inherit"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Thank you for contacting <?= Project ?>. </font></font></font><font style="vertical-align:inherit"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Welcome to the <?= Project ?> sales family, </font></font></font></font><font style="vertical-align:inherit"><font style="vertical-align:inherit"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">it's great to hear from one of our family members and I'd be more than happy to help you.</font></font></font></font></div>
<div>&nbsp;</div>
<div><font style="vertical-align:inherit"><font style="vertical-align:inherit"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Congratulations on your recent sale! </font></font></font><font style="vertical-align:inherit"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">I'd be happy to assist you with questions about how to ship. </font></font></font></font><font style="vertical-align:inherit"><font style="vertical-align:inherit"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Attached is the shipping label for your order, please follow the directions on the shipping label.</font></font></font></font></div>
<div>&nbsp;</div>
<div><font style="vertical-align:inherit"><font style="vertical-align:inherit"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Thank you for your support of our <?= Project ?>. </font></font></font></font><font style="vertical-align:inherit"><font style="vertical-align:inherit"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Please contact us for any additional assistance. </font></font></font></font><br>
&nbsp;<br><font style="vertical-align:inherit"><font style="vertical-align:inherit"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
Sincerely, </font></font></font></font><br><font style="vertical-align:inherit"><font style="vertical-align:inherit"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
Salt</font></font></font></font></div>
</div>
</div>
</body>
</html>