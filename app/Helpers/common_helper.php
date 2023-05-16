<?php
use App\Models\Common_model;

global $common_model;
global $session;
global $db;
$session = \Config\Services::session();
$common_model = new App\Models\Common_model();

$db = \Config\Database::connect(); 


if(!function_exists('categoryName')){
    function categoryName($id)
    {
      
        $cat = $GLOBALS["common_model"]->GetSingleData('categories' , array('id'=> $id));
         return $cat['title'];      
      
    } 
    function get_cat_id_by_name($name , $main=false)
    {
        $where['title'] = $name;
        if ($main) 
        {
            $where['parent'] = $main;
        }
        
        $cat = $GLOBALS["common_model"]->GetSingleData('categories' , $where);
        if($cat)
        {
            return $cat['id'];
        }
        else
        {
            //$cat = $GLOBALS["common_model"]->InsertData('categories' , array('title'=> $name));
            return '';
        }
               
      
    } 
    function get_brand_id_by_name($name)
    {
      
        $cat = $GLOBALS["common_model"]->GetSingleData('brands' , array('title'=> $name));
        if($cat)
        {
            return $cat['id'];
        }
        else
        {
            //$cat = $GLOBALS["common_model"]->InsertData('brands' , array('title'=> $name));
            return '';
        }
               
      
    } 
    function productName($id)
    {
      
        $cat = $GLOBALS["common_model"]->GetSingleData('product' , array('id'=> $id));
         return $cat['title'];      
      
    }
    function getYoutubeEmbedUrl ($url) {
      $parsedUrl = parse_url($url);
      # extract query string
      parse_str(@$parsedUrl['query'], $queryString);
      $youtubeId = @$queryString['v'] ?? substr(@$parsedUrl['path'], 1);

      return "https://youtube.com/embed/{$youtubeId}?rel=0&modestbranding=1&autohide=1&mute=1&showinfo=0&controls=0&autoplay=1";
    }
    function getYoutubeThumbUrl ($url) {
      $parsedUrl = parse_url($url);
      # extract query string
      parse_str(@$parsedUrl['query'], $queryString);
      $youtubeId = @$queryString['v'] ?? substr(@$parsedUrl['path'], 1);
      
      return "http://img.youtube.com/vi/{$youtubeId}/sddefault.jpg";
    }
    function getData( $table ,$id , $col= '*' )
    {
      
        $data = $GLOBALS["common_model"]->GetSingleData($table , array('id'=> $id) , '' , '' ,$col);
         if($col == '*')
         {
            return $data;
         }
        return @$data[$col];      
      
    }
    function productImages( $prod_id )
    {
      
        $product_image = $GLOBALS["common_model"]->GetAllData('product_image',array('product_id'=>$prod_id));
        return $product_image;
      
    }
     function gradeName($id , $no_style=false)
    {
      
        $cat = $GLOBALS["common_model"]->GetSingleData('class_type' , array('id'=> $id));
        if($no_style)
        {
            return 'GRADE '.$cat['class_name'].''; 
        }
        return '<p class="p-2 m-0" style="background:'.$cat['bg_color'].'; color:'.$cat['text_color'].'">GRADE '.$cat['class_name'].'</p>';      
      
    }

if(!function_exists('getUserById')){
    function getUserById($id)
    {
      
        $user = $GLOBALS["common_model"]->GetSingleData('users' , array('id'=> $id));
         return $user;      
      
    }
}
function getAllNotifications($id)
{
   

    $data = $GLOBALS["common_model"]->GetAllData('notification' , array('user_id' => $id) , 'id' , 'desc' , 10);
    return $data;

}
function getUnreadNotifications($id)
{

    $data = $GLOBALS["common_model"]->GetAllData('notification' , array('user_id' => $id , 'is_read' => 0));
    return $data;

}

  function slugify($text, string $divider = '-')
  {
  // replace non letter or digits by divider
    $text = preg_replace('~[^\pL\d]+~u', $divider, $text);

    // transliterate
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

    // remove unwanted characters
    $text = preg_replace('~[^-\w]+~', '', $text);

    // trim
    $text = trim($text, $divider);

    // remove duplicate divider
    $text = preg_replace('~-+~', $divider, $text);

    // lowercase
    $text = strtolower($text);

    if (empty($text)) {
      return 'n-a';
    }

    return $text;
  }
  
  function greeting_msg() {
    $hour = date('H');
    if ($hour >= 18) {
       $greeting = "Good Evening";
    } elseif ($hour >= 12) {
        $greeting = "Good Afternoon";
    } elseif ($hour < 12) {
       $greeting = "Good Morning";
    }
    return $greeting;
}
function get_product_url($value) {
   return base_url('').'/product/'.slugify($value['title']).'-'.$value['id'];
    
}

function get_product_img_url($value) 
{
    $img = $GLOBALS['common_model']->GetSingleData('product_image' , ['product_id' => $value['id']]);
    $img_url = ($img) ? $img['image'] : 'assets/uploads/default.jpg';
   return base_url($img_url);
    
}
function get_trade_url($value) {
   return base_url('').'/trade-detail/'.slugify($value['title']).'-'.$value['id'];
    
}
function get_product_sell_url($value) {
   return base_url('').'/sell/'.slugify($value['title']).'/'.$value['id'];
    
}
function get_related_products($cat_id) {
   $related =  $GLOBALS['common_model']->GetAllData("product" , 'category = '.$cat_id  , 'id' , 'desc' , 6);
   return $related;
    
}
function get_recent_viewed_products($id) {
   if(array_key_exists('recentviewed', $_COOKIE))
        {
            
            $cookie_get=get_cookie('recentviewed');
            $cookieres=unserialize($cookie_get);
            $productids=implode("','", $cookieres);

            ///get product details
            $where="id IN ('$productids') AND id != ".$id;
            $recentviewedList = $GLOBALS['common_model']->GetAllData("product" , $where , 'id' , 'desc' , 6);
            //print_r( $recentviewedList );
            return $recentviewedList ;
        }
        return false;
    
}
function get_hl_price($id=0) 
{
    // echo $id; die;
    if(!$id)
    {
        $id = 0;
    }
   $query = $GLOBALS['db']->query("SELECT * , MIN(  `price` ) AS  `lowest` , MAX(  `price` ) AS  `highest` FROM  `sell_product` where product_id = $id AND sold_status = 0 AND status = 1 ");
   if ($query->getRowArray()['lowest']) {
           
    //echo $GLOBALS['db']->getLastQuery();
      return $query->getRowArray();
   }
    
   return ['lowest' => 0 , 'highest' => 0 , 'game_condition' => 0];
    
}


function get_askprice_flter($min , $max) 
{
   $query = $GLOBALS['db']->query("SELECT product_id  FROM  `sell_product` where price >= ".$min." AND price <= ".$max." AND sold_status = 0 AND status=1");
   if ($query->getResultArray()) {
      $data = $query->getResultArray();
      $ids = [];
      foreach ($data as $key => $value) 
      {
          array_push($ids , $value['product_id']);
      }
      return implode(',', $ids);
   }
   return '0';
    
}
function update_lowest_ask($product_id) 
{
    $lowestask = get_hl_price($product_id)['lowest'];

   $update1['lowest_ask'] = $lowestask;
   $GLOBALS['common_model']->UpdateData("product" , array('id' => $product_id ) , $update1);
   return true;
    
}

function get_hl_bid_price($id) {
    //echo "SELECT * , MIN(  `grand_total` ) AS  `lowest` , MAX(  `grand_total` ) AS  `highest` FROM  `orders` where product_id = $id AND seller_id = 0"; die;
   $query = $GLOBALS['db']->query("SELECT * FROM  `orders` where grand_total = (select Max(grand_total) from orders where product_id = '".$id."' AND seller_id = 0 AND status = 3) AND product_id = '".$id."' AND seller_id = 0 AND status = 3");
   //print_r($query->getRowArray());
   if ($query->getRowArray()) {
      return $query->getRowArray();
   }
   return ['id'=>0 ,'lowest' => 0 , 'grand_total' => 0];
    
}
function get_product_sellers($id) {
   $query = $GLOBALS['common_model']->GetAllData("sell_product" , array('product_id' => $id , 'sold_status' => 0 , 'status' => 1) , 'price' , 'asc');
   $seller_ids = [];
   $sellers = [];
   foreach ($query as $key => $value) 
   {
        if (in_array($value['user_id'], $seller_ids)) {
            continue;
        }
        $seller = $GLOBALS['common_model']->GetSingleData("users" , 'id = '.$value['user_id'] );
        $value['seller_name']  = $seller['first_name'].' '.$seller['last_name'];
       array_push($seller_ids, $value['user_id']);
       array_push($sellers, $value);
   }
   
    return $sellers;
}

function do_sell_product($order_id , $sell_product_id , $seller_id) {
    $order = $GLOBALS['common_model']->GetSingleData("orders" , array('id' => $order_id , 'status' => 3 ));
    
    if ($order) 
    {
        $paid = capture_payment($order['payment_id'] , $order['grand_total']);
        if ($paid['status'] == 1) 
        {
            $update['sell_product_id'] = $sell_product_id;
            $update['seller_id'] = $seller_id;
            $update['status'] = 1;
            $update['payment_id'] = $paid['payment_id'];
            $update['updated_at'] = date('Y-m-d H:i:s');

            $GLOBALS['common_model']->UpdateData("orders" , array('id' => $order_id ) , $update);
            $Total_orders = $GLOBALS['common_model']->GetAllData("orders" , array('product_id' => $order['product_id'] , 'status' => 1 ));
            $update1['no_of_sales'] = ($Total_orders) ? count($Total_orders) : 0;
            $update1['last_sale_price'] = $order['grand_total'];
            $GLOBALS['common_model']->UpdateData("product" , array('id' => $order['product_id'] ) , $update1);
            $product_detail = $GLOBALS['common_model']->GetSingleData("product" , array('id' => $order['product_id'] ) );
            $user = $GLOBALS['common_model']->GetSingleData("users" , array('id' => $order['user_id'] ));
            $seller = $GLOBALS['common_model']->GetSingleData("users" , array('id' => $seller_id ));
            
            $GLOBALS['common_model']->SendOrderConfirmed($order ,  $user , $product_detail , 'Order');
            $GLOBALS['common_model']->SendOrderConfirmed($order ,  $seller , $product_detail , 'Order');
            $GLOBALS['common_model']->sendOrdertoSeller($order , $seller);
            return ['status' => 1 , 'message' => 'Product Sold Successfully' , 'redirect' => base_url('my-selling?completed=true')];
        }
        else
        {
            return ['status' => 0 , 'message' => 'something wrong'];
        }
   
    }
    else
    {
        return ['status' => 0 , 'message' => 'Invalid order'];
    }
   
}

function generateRandomString($length = 10)
  {
      $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
      $charactersLength = strlen($characters);
      $randomString = '';
      for ($i = 0; $i < $length; $i++) {
          $randomString .= $characters[random_int(0, $charactersLength - 1)];
      }
      return $randomString;
  }
 function generate_token()
 {
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://api-m.sandbox.paypal.com/v1/oauth2/token',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS => 'grant_type=client_credentials&ignoreCache=true&return_authn_schemes=true&return_client_metadata=true&return_unconsented_scopes=true',
      CURLOPT_HTTPHEADER => array(
        'Authorization: Basic '.base64_encode(paypal_client_id.':'.paypal_client_secret),
        'Content-Type: application/x-www-form-urlencoded'
      ),
    ));

    $response = curl_exec($curl);
    //echo $response;
    curl_close($curl);
    return (array) json_decode($response);
 }

 function auth_payment($payment_id )
 {
    $curl = curl_init();
    $token = generate_token()['access_token'];
    //echo $token;
    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://api-m.sandbox.paypal.com/v2/checkout/orders/'.$payment_id.'/authorize',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json',
        'Prefer: return=representation',
        //'PayPal-Request-Id: 3f9f2e56-530f-4364-bc5a-65a5e8e1837a',
        'Authorization: Bearer '.$token.''
      ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    $res = (array) json_decode($response);
    //print_r($res); die;
    $output['status'] = 0;
    if (isset($res['id'])) 
    {
        $auth_id = $res['purchase_units'][0]->payments->authorizations[0]->id;
        $amount = $res['purchase_units'][0]->payments->authorizations[0]->amount->value;
        return $auth_id;
    }
    return $output;
 }

 function void_payment($auth_id )
 {
    $curl = curl_init();
    $token = generate_token()['access_token'];
    //echo $token;
    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://api-m.sandbox.paypal.com/v2/payments/authorizations/'.$auth_id.'/void',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json',
        'Prefer: return=representation',
        //'PayPal-Request-Id: 3f9f2e56-530f-4364-bc5a-65a5e8e1837a',
        'Authorization: Bearer '.$token.''
      ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    $res = (array) json_decode($response);
    //print_r($res); die;
   
    return $res;
    
 }
 
 function capture_payment($auth_id , $amount)
 {
    $curl = curl_init();
    $token = generate_token()['access_token'];
    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://api-m.sandbox.paypal.com/v2/payments/authorizations/'.$auth_id.'/capture',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS =>'{
        "invoice_id": "'.time().'",
        "final_capture": true,
        "note_to_payer": "Bid Approved",
        "soft_descriptor": "Bid Approved"
    }',
      CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json',
        //'PayPal-Request-Id: f8a0a3cb-dec7-4358-99da-911dd84ae603',
        'Prefer: return=representation',
        'Authorization: Bearer '.$token.''
      ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    $res = (array) json_decode($response);
    //print_r($res);
    $output['status'] = 0;
    if (isset($res['id'])) 
    {
        $output['payment_id'] = $res['id'];
        $output['status'] = 1;
    }
    return $output;
 }

function get_monthly_sales_data($product_id , $no_of_month=0 , $currency)
{
    $from_month = abs(date('m') - $no_of_month);

    $month = strtotime(date('Y-'.$from_month.'-01'));
    $end = strtotime("+ 1 days");
    //echo $month; die;
    $monthData = [];
    $graphData = [];
    while($month < $end)
    {
        $year = date('Y' , $month);
        $day = date('d' , $month);
        $mn = date('m' , $month);

        $where = "product_id = $product_id AND status = 1 AND day(`created_at`) = $day AND month(`created_at`) = $mn";
        $data = $GLOBALS['common_model']->GetAllData('orders' , $where);
        $v['d'] = $day;
        $v['m'] = $mn;
        $v['y'] = $year;
        if ($data) 
        {
            $amount = 0; 
            foreach ($data as $key => $value) 
            {
                $amount += $value['grand_total']; 
               
            }
            $amount = $amount / count($data);
            $v['price'] = ($value) ? convert_currency($amount , $currency , 'HKD') : 'null';
                array_push($graphData, $v);
        }
        else
        {
            $month = strtotime("+1 day", $month);
             continue;
            $v['price'] =  'null';
            array_push($graphData, $v);
        }
        
        
       
        
        $month = strtotime("+1 day", $month);
    }
    $data['graphData'] = $graphData;
    $data['monthData'] = $monthData;
    return $data;

}
function get_last_3day_sale($product_id)
{
    //$tdate = date('Y-m-d' , strtotime('-3 day'));
    $date = date('Y-m-d');
    $where = "product_id = $product_id AND status = 1 AND  day(`created_at` ) >= day('$date')-3  AND day(`created_at` ) <=  day('$date')";
    $data = $GLOBALS['common_model']->GetAllData('orders' , $where);
    //print_r($where);
    $count = count($data);
    return $count;
}
function get_avg_sale($sale , $currency)
{
    $avg_sale = $GLOBALS['common_model']->GetAllData('orders',array('product_id'=> $sale[0]['product_id'] , 'status'=> 1) ,'id' ,'desc','' ,'' , 'AVG(grand_total)');
    
      return $currency.convert_currency(round($avg_sale[0]['AVG(grand_total)']) , $currency , 'HKD');
}
function get_total_active_ask($product_id)
{
    
    $where = "product_id = $product_id AND sold_status = 0 ";
    $data = $GLOBALS['common_model']->GetAllData('sell_product' , $where);
    $count = count($data);
    return $count;
    
}
function get_admin()
{
    
    $where = "id = 1";
    $data = $GLOBALS['common_model']->GetSingleData('admin' , $where);
    
    return $data;
    
}
function get_user($id)
{
    
    $where = "id = $id";
    $data = $GLOBALS['common_model']->GetSingleData('users' , $where);
    
    return $data;
    
}
function get_product($id)
{
    
    $where = "id = $id";
    $data = $GLOBALS['common_model']->GetSingleData('product' , $where);
    
    return $data;
    
}
function get_12month_trade($id , $currency) {
   $query = $GLOBALS['db']->query("SELECT * , MIN(  `grand_total` ) AS  `lowest` , MAX(  `grand_total` ) AS  `highest` FROM  `orders` where product_id = $id AND status = 1"  );
   if ($query->getRowArray()['lowest']) {
      return $currency.convert_currency($query->getRowArray()['lowest'], $currency , 'HKD') .'- '.$currency.convert_currency($query->getRowArray()['highest'], $currency , 'HKD');
   }
   return '-- - --';
    
}
function get_paypal_acess_token()
{
    $curl = curl_init();
    $auth = base64_encode(paypal_client_id.':'.paypal_client_secret);
    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://api-m.sandbox.paypal.com/v1/oauth2/token',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS => 'grant_type=client_credentials',
      CURLOPT_HTTPHEADER => array(
        'Authorization: Basic '.$auth.'',
        'Content-Type: application/x-www-form-urlencoded'
      ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    $token = json_decode($response);
    return $token->access_token;
}
function convert_currency($amount , $currency_to , $currency_from)
{
    $where['currency_from'] = $currency_from;
    $where['currency_to'] = $currency_to;
    $data = $GLOBALS['common_model']->GetSingleData('currency_conversion_rate' , $where);
    if ($data) 
    {
        return round(($amount * $data['rate']) , 2) ;
    }
    return $amount;
}
function get_expired_days($future_date)
{
    $current_date = strtotime(date('Y-m-d'));
    $future_date = strtotime($future_date);
    if($future_date >= $current_date){
        $r = ceil(abs($future_date - $current_date) / 86400);
        return $days_between = "Expire In ".$r." Days";

    }else{

        return "Expired";

    }
}
function check_cc($cc, $extra_check = false){

        $cards = array(
            "visa" => "(4\d{12}(?:\d{3})?)",
            "amex" => "/^([34|37]{2})([0-9]{13})$/",
            "jcb" => "(35[2-8][89]\d\d\d{10})",
            "maestro" => "((?:5020|5038|6304|6579|6761)\d{12}(?:\d\d)?)",
            "solo" => "((?:6334|6767)\d{12}(?:\d\d)?\d?)",
            "mastercard" => "(5[1-5]\d{14})",
            "switch" => "(?:(?:(?:4903|4905|4911|4936|6333|6759)\d{12})|(?:(?:564182|633110)\d{10})(\d\d)?\d?)",
        );
        $names = array("Visa", "American Express", "JCB", "Maestro", "Solo", "Mastercard", "Switch");
        $matches = array();
        $pattern = "#^(?:".implode("|", $cards).")$#";
        $result = preg_match($pattern, str_replace(" ", "", $cc), $matches);
        if($extra_check && $result > 0){
            $result = (validatecard($cc))?1:0;
        }
        return ($result>0)?$names[sizeof($matches)-2]:false;
    }
function extractList($array, &$list, $temp = array()) {
    if (count($temp) > 0 && ! in_array($temp, $list))
        $list[] = $temp;
    for($i = 0; $i < sizeof($array); $i ++) {
        $copy = $array;
        $elem = array_splice($copy, $i, 1);
        if (sizeof($copy) > 0) {
            $add = array_merge($temp, array($elem[0]));
            sort($add);
            extractList($copy, $list, $add);
        } else {
            $add = array_merge($temp, array($elem[0]));
            sort($add);
            if (! in_array($temp, $list)) {
                $list[] = $add;
            }
        }
    }
}
function check_if_too_many($sum , $array)
{
    if (in_array($sum , $array)) 
    {
        if (count($array) > 1) 
        {
            return true;
        }

    }
    $list = array();

    # Extract All Unique Conbinations
    extractList($array, $list);

    #Filter By SUM = $sum
    $list = array_filter($list,function($var) use ($sum) { return(array_sum($var) >= $sum);});
    $data = array();
    if($list)
    {
        //print_r($list); die;
        $i = 0;
        foreach($list as  $k)
        {
            if ($i > 0) {
                continue;
            }
            foreach($k as $p)
            {
                //echo "hi";
                unset($array[array_search($p , $array)]);
            }
            $i++;
        }
    }
    else
    {
        $array = array();
    }

    return $array;
}

function get_withdrawal_count()
{
    $where = "user_id != 0 and status = 0";
    $data = $GLOBALS['common_model']->GetAllData('wallet_transactions' , $where);
    $wallet_count = count($data);

    return $wallet_count;
    
}
 function runCurl($data , $request = "POST")
 {
      $api_url = $_ENV['hyper_url'].$data['api_url'];
     
      $virtual_ac_un = $_ENV['hyper_username'] ;
      $virtual_ac_pss = $_ENV['hyper_password'];
     

    $cl = curl_init();
    if($request == "GET")
    {
      curl_setopt($cl, CURLOPT_URL, $api_url);
      curl_setopt($cl, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($cl, CURLOPT_HTTPHEADER, array(
          "Content-Type: application/json",
          "Accept: application/json"
      ));
      curl_setopt($cl, CURLOPT_USERPWD,  $virtual_ac_un . ":" . $virtual_ac_pss);
      curl_setopt($cl, CURLOPT_CUSTOMREQUEST, "GET");
    }
    else
    {
        curl_setopt_array($cl, array(
          CURLOPT_URL => $api_url,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => $request,
          CURLOPT_POSTFIELDS => json_encode($data),
          CURLOPT_USERPWD => $virtual_ac_un . ":" . $virtual_ac_pss,
          CURLOPT_HTTPHEADER => array(
              'Content-Type: application/json',
              'Accept: application/json',
          ),
      ));
    }
    

    $response = curl_exec($cl);
    $httpcode = curl_getinfo($cl, CURLINFO_HTTP_CODE);
    
    curl_close($cl);
   // print_r($api_url);
    $res = json_decode($response);
    $d['httpcode'] = $httpcode;
    $d['response'] = $res;
    return $d;
 }
}