<?php

namespace App\Controllers;
use App\Models\Common_model;
use App\Models\Search_model;
class Shop extends BaseController {
    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->common_model = new Common_model();
        $this->search_model = new Search_model();
        $this->user_id =  $this->session->get('user_id');
        $this->user = $this->common_model->GetSingleData('users', array('id' => $this->user_id));
        $this->currency = $this->user['currency'];
        helper(['form', 'url' , 'cookie']);
    }
    public function check_login()
    {
      if ($this->session->has('user_id')) {
        return true ;
      }
      else
      {
        return false;
      }
       
    }
    public function index($slug=false)
    {
        
        $data['active_cat'] = 0;
        $data['title'] = 'Shop';
        $this->update_all_products();
        if ($slug) {
            $split = explode('-', $slug);
            $cat_id = end($split);
            $catData = $this->common_model->GetSingleData("categories", array("id"=>$cat_id));
            if ($catData) {
                $data['active_cat'] = $cat_id;
                $data['title'] = $catData['title'];
            }
            else
            {
               return redirect('/','refresh');
            }
            
        }
        $data['categories'] = $this->common_model->GetAllData("categories", 'parent=0' , 'id' , 'desc');
        $data['brands'] = $this->common_model->GetAllData("brands", '' , 'id' , 'desc');
        
        return view('shop' , $data);
    }
    public function send_test_mail()
    {
       
        $act = 'Order';
        $order = $this->common_model->GetSingleData('orders',array('id'=> 1));
        $product_detail = $this->common_model->GetSingleData('product',array('id'=> $order['product_id']));
        $order['email'] = '';
        if(@$_GET['email'])
        {
            $order['email'] = $_GET['email'];
        }
        $out = $this->sendOrdertoCustomer($order , $product_detail , $act );  
        $data["order"] = $order;
        $data['currency'] = $this->user['currency'];
        $msg = view('mail/bid_live' ,$data);
        return $msg;
    }
    function update_all_products()
    {  
        $sales = $this->common_model->GetAllData("orders", array("status"=>1) , 'id' , 'desc'); 
        $exchange = $this->common_model->GetAllData("exchange_order", array( "status"=>3) , 'id' , 'desc'); 
           
        foreach ($sales as $key => $value)
        {
            $sales = $this->common_model->GetAllData("orders", array("product_id"=>$value['product_id'] , "status"=>1) , 'id' , 'desc'); 
            $exchange = $this->common_model->GetAllData("exchange_order", array("product_id"=>$value['product_id'] , "status"=>3) , 'id' , 'desc'); 
           
            
            $up['lowest_ask'] = get_hl_price($value['product_id'])['lowest'];
            $up['conditions'] = get_hl_price($value['product_id'])['game_condition'];
            $up['no_of_exchange'] = count($exchange);
            $up['no_of_sales'] = count($sales);
            $up['last_sale_price'] = ($sales) ? $sales[0]['grand_total'] : 0;
      
            $this->common_model->UpdateData('product' , array('id' => $value['product_id']) , $up);
        }
        foreach ($exchange as $key => $value)
        {
            $sales = $this->common_model->GetAllData("orders", array("product_id"=>$value['product_id'] , "status"=>1) , 'id' , 'desc'); 
            $exchange = $this->common_model->GetAllData("exchange_order", array("product_id"=>$value['product_id'] , "status"=>3) , 'id' , 'desc'); 
           
            
            $up['lowest_ask'] = get_hl_price($value['product_id'])['lowest'];
            $up['conditions'] = get_hl_price($value['product_id'])['game_condition'];
            $up['no_of_exchange'] = count($exchange);
            $up['no_of_sales'] = count($sales);
            $up['last_sale_price'] = ($sales) ? $sales[0]['grand_total'] : 0;
      
            $this->common_model->UpdateData('product' , array('id' => $value['product_id']) , $up);
        }
            
            
    }
    function product_detail($slug)
    {
        $url = explode('-', $slug);
        $id  = end($url);
        $data['product'] = $this->common_model->GetSingleData("product", array("id"=>$id));
        $data['asks'] = $this->common_model->GetAllData("sell_product", array("product_id"=>$id , "status"=>1 , "sold_status"=>0) , 'id' , 'desc');
        $data['bids'] = $this->common_model->GetAllData("orders", array("product_id"=>$id , "seller_id"=>0 , "status"=>3) , 'id' , 'desc');
        $data['sales'] = $this->common_model->GetAllData("orders", array("product_id"=>$id , "status"=>1) , 'id' , 'desc');
        $data["product_image"] = $this->common_model->GetAllData("product_image", array("product_id"=>$id));
        if($data['product'])
        { 
            $data['edit'] = $this->common_model->GetSingleData("orders", array("product_id"=>$id , "user_id"=>$this->user_id , "status"=>3) , 'id' , 'desc');
            if(array_key_exists('recentviewed', $_COOKIE))
            {
                //already set

                $cookie_get=get_cookie('recentviewed');
                $cookieres=unserialize($cookie_get);
                ///check product already present
                if(!in_array($id, $cookieres))
                {
                    $cookieres[]=$id;
                }
                delete_cookie('recentviewed');

                ///again set cookie
                $cookievalue=serialize($cookieres);
                $cookiearr=array(
                    'name'=>'recentviewed',
                    'value'=>$cookievalue,
                    'expire'=>'86400'
                );
                set_cookie($cookiearr);

            } else { 
            ///cookie set
            $cookie_data[]= $id;
            $cookievalue=serialize($cookie_data);
            $cookiearr=array(
                'name'=>'recentviewed',
                'value'=>$cookievalue,
                'expire'=>'86400'
            );
            set_cookie($cookiearr);
            }
            return view('product-detail', $data);
        }
        return view('404');
    }

    function add_bid_data()
    {
       
        $id  = $_POST['product_id'];
        $data['product'] = $this->common_model->GetSingleData("product", array("id"=>$id));
        $data['asks'] = $this->common_model->GetAllData("sell_product", array("product_id"=>$id , "status"=>1 , "sold_status"=>0) , 'id' , 'desc');
        $data['bids'] = $this->common_model->GetAllData("orders", array("product_id"=>$id , "seller_id"=>0 , "status"=>3) , 'id' , 'desc');
        
        $data['sales'] = $this->common_model->GetAllData("orders", array("product_id"=>$id , "status"=>1) , 'id' , 'desc');
        $data["product_image"] = $this->common_model->GetAllData("product_image", array("product_id"=>$id));
        if($data['product'])
        {
            $highest_bid_current = convert_currency(get_hl_bid_price($id)['grand_total'] , $this->currency , 'HKD'); 
            $lowest_ask_current = convert_currency(get_hl_price($id)['lowest'] , $this->currency , 'HKD'); 
            //echo $lowest_ask_current;
            $lowest_ask_prev = $_POST['lowestask'];
            $highest_bid_prev = $_POST['highestbid'];
            if ($_POST['is_first'] == 0) 
            {
                if ($lowest_ask_prev != $lowest_ask_current  ) {
                    echo view('loop/add_bid_data', $data);
                    exit;
                }
                if ($highest_bid_prev != $highest_bid_current  ) {
                    echo view('loop/add_bid_data', $data);
                    exit;
                }

            }
            else
            {
                echo view('loop/add_bid_data', $data);
            }
            
           
        }
        echo 0;
    }
    function edit_bid_data()
    {
       
        $id  = $_POST['product_id'];
        $data['product'] = $this->common_model->GetSingleData("product", array("id"=>$id));
       $data['asks'] = $this->common_model->GetAllData("sell_product", array("product_id"=>$id , "status"=>1 , "sold_status"=>0) , 'id' , 'desc');
        $data['bids'] = $this->common_model->GetAllData("orders", array("product_id"=>$id , "seller_id"=>0 , "status"=>3) , 'id' , 'desc');
        $data['sales'] = $this->common_model->GetAllData("orders", array("product_id"=>$id , "status"=>1) , 'id' , 'desc');
        $data["product_image"] = $this->common_model->GetAllData("product_image", array("product_id"=>$id));

        
        if($data['product'])
        {
            $highest_bid_current = convert_currency(get_hl_bid_price($id)['grand_total'] , $this->currency , 'HKD'); 
            $lowest_ask_current = convert_currency(get_hl_price($id)['lowest'] , $this->currency , 'HKD'); 
            //echo $lowest_ask_current;
            $lowest_ask_prev = $_POST['lowestask'];
            $highest_bid_prev = $_POST['highestbid'];
            $data['edit'] = $this->common_model->GetSingleData("orders", array("product_id"=>$id , "user_id"=>$this->user_id , "status"=>3) , 'id' , 'desc');
            if (!$data['edit']) {
                echo 1;
                exit;
            }
            if ($_POST['is_first'] == 0) 
            {
                if ($lowest_ask_prev != $lowest_ask_current  ) {
                    echo view('loop/edit_bid_data', $data);
                    exit;
                }
                if ($highest_bid_prev != $highest_bid_current  ) {
                    echo view('loop/edit_bid_data', $data);
                    exit;
                }

            }
            else
            {
                echo view('loop/edit_bid_data', $data);
            }
            
           
        }
        echo 0;
        
        
    }
    
    function edit_bid($slug)
    {
        $url = explode('-', $slug);
        $id  = end($url);
        $data['product'] = $this->common_model->GetSingleData("product", array("id"=>$id));
        $data['asks'] = $this->common_model->GetAllData("sell_product", array("product_id"=>$id , "status"=>1 , "sold_status"=>0) , 'id' , 'desc');
        $data['bids'] = $this->common_model->GetAllData("orders", array("product_id"=>$id , "seller_id"=>0 , "status"=>3) , 'id' , 'desc');
        $data['sales'] = $this->common_model->GetAllData("orders", array("product_id"=>$id , "status"=>1) , 'id' , 'desc');
        $data["product_image"] = $this->common_model->GetAllData("product_image", array("product_id"=>$id));
        if($data['product'])
        { 
            $data['edit'] = $this->common_model->GetSingleData("orders", array("product_id"=>$id , "user_id"=>$this->user_id , "status"=>3) , 'id' , 'desc');
            if($data['edit'])
            {
                return view('edit-bid', $data);
            }
        }
        return view('404');
    }

    private function randomString()
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i=0; $i<13; $i++) 
        {
         $randomString.= $characters[rand(0, $charactersLength - 1)];
        }
       return $randomNumber= $randomString;
    }

    public function submit_checkout_form()
    {
        if (!$this->check_login()) 
        {
            $output['message']='Please login' ;
            $output['status']= 0 ;
             echo json_encode($output);
             return false; 
        }
        $this->validation->setRule('f_name','f_name' , 'trim|required');
        //$this->validation->setRule('l_name','l_name' , 'trim|required');
        $this->validation->setRule('country','country' , 'trim|required');
        $this->validation->setRule('city','city' , 'trim|required');
        $this->validation->setRule('state','state' , 'trim|required');
        $this->validation->setRule('zipcode','zipcode' , 'trim|required');
        $this->validation->setRule('address','address' , 'trim|required');
        //$this->validation->setRule('address2','address2' , 'trim|required');
        $this->validation->setRule('sell_product_id','sell_product_id' , 'trim|required');
        $this->validation->setRule('grand_total','grand_total' , 'trim|required');
        $this->validation->setRule('payment_method','payment_method' , 'trim|required');
        $this->validation->setRule('payment_id','payment_id' , 'trim|required');

        if($this->validation->withRequest($this->request)->run()==false)
        {
       
            $output['message']=$this->validation->getErrors();
            $output['status']= 0 ;       
        }
    
        else
        {
            $sell_product_id = $this->request->getVar('sell_product_id');
            $expire_day = $this->request->getVar('expire_day');

            $expire_date = date('Y-m-d H:i' , strtotime('+ '.$expire_day.' Days'));
            $this->common_model->UpdateData('sell_product' , array('id' => $sell_product_id) , array('sold_status' => 2));
            $sell_product = $this->common_model->GetSingleData('sell_product' , array('id' => $sell_product_id));
            
            $insert['first_name'] = $this->request->getVar('f_name');     
            $insert['last_name'] = $this->request->getVar('l_name'); 
            $insert['country'] = $this->request->getVar('country');
            $insert['city'] = $this->request->getVar('city');
            $insert['state'] = $this->request->getVar('state');
            $insert['zipcode'] = $this->request->getVar('zipcode');
            $insert['address'] = $this->request->getVar('address');
            $insert['address2'] = $this->request->getVar('address2');
            $insert['user_id'] = $this->user_id;
            $has_already = $this->common_model->GetSingleData('user_shipping_info', array('user_id'=> $this->user_id));
            if ($has_already) 
            {
                $run = $this->common_model->UpdateData('user_shipping_info', array('user_id'=> $this->user_id) ,$insert );
            }
            else
            {
                 $run = $this->common_model->InsertData('user_shipping_info' ,$insert );
            }
            unset($insert['first_name']);
            unset($insert['last_name']);
            $insert['f_name'] = $this->request->getVar('f_name');
            $insert['l_name'] = $this->request->getVar('l_name');
            $insert['seller_id'] = ($sell_product) ? $sell_product['user_id'] : 0;
            $insert['product_id'] = $this->request->getVar('product_id');
            
            $insert['expire_day'] = $this->request->getVar('expire_day');
            $insert['expire_date'] = $expire_date;
            
            $insert['sell_product_id'] = $this->request->getVar('sell_product_id');
            $insert['is_new'] = $this->request->getVar('is_new');
            $insert['in_original_box'] = $this->request->getVar('in_original_box');
            $insert['verified_authentic'] = $this->request->getVar('verified_authentic');
            $insert['grand_total'] = convert_currency($this->request->getVar('grand_total')  , 'HKD', $this->currency);
            $insert['trans_fee'] = get_admin()['bid_processing_fee'];
            $insert['payment_fee'] = 0;
            $insert['admin_fee'] = convert_currency(($this->request->getVar('total_amount') - $this->request->getVar('grand_total'))  , 'HKD', $this->currency);
            $insert['shipping_fee'] = get_admin()['shipping_fee'];
            $insert['payment_method'] = $this->request->getVar('payment_method');
            $insert['payment_id'] = ($sell_product) ? $this->request->getVar('payment_id') : auth_payment($this->request->getVar('payment_id'));
            
            $insert['order_uniqueid'] = $this->randomString();
            $insert['status'] = ($sell_product) ? 1 : 3;
            $insert['created_at'] = date('Y-m-d H:i:s');
            $insert['updated_at'] = date('Y-m-d H:i:s');
            

            $run = $this->common_model->InsertData('orders',$insert);

            if($run)
            {
                
                $user = $this->common_model->GetSingleData('users',array('id'=> $this->user_id));
                $seller = $this->common_model->GetSingleData('users',array('id'=> $insert['seller_id']));
                $order = $this->common_model->GetSingleData('orders',array('id'=> $run));
                
                $act = 'Bid';
                $product_detail = $this->common_model->GetSingleData('product',array('id'=> $order['product_id']));
                if ($seller) 
                {
                    $act = 'Order';
                    $user =  $this->common_model->GetSingleData("users" , array('id' => $order['user_id'] ));
                    $Total_orders = $this->common_model->GetAllData("orders" , array('product_id' => $order['product_id'] , 'status' => 1 ));
                    $update1['no_of_sales'] = ($Total_orders) ? count($Total_orders) : 0;
                    $update1['last_sale_price'] = $order['grand_total'];

                    $this->common_model->UpdateData("product" , array('id' => $order['product_id'] ) , $update1);
                    $this->common_model->SendOrderConfirmed($order ,  $user , $product_detail , 'Order');
                    $this->common_model->sendOrdertoSeller($order , $seller);
                }
                else 
                {
                    $this->sendOrdertoCustomer($order , $product_detail , $act);  
                    $this->sendbidtoHighestCustomer($order , $product_detail );  
                }  

                 
             
                $output['message']='Congratulation! Your '.$act.' has been placed successfully.' ;
                $output['status']= 1 ;                  
                $output['redirect'] = base_url().'/order-details/'.$run ; 
                $this->session->setFlashdata('success_msg' , '<div class="alert alert-success">Congratulation! Your '.$act.' has been placed successfully</div>');           

            }
            else 
            {
            
                $output['message']='<div class="alert alert-danger">Something went wrong</div>' ;
                $output['status']= 0 ;  
            
            }
         }
         echo json_encode($output);
    }
    private function sendbidtoHighestCustomer($order  , $product_detail  )
    {

        $high_bid = $this->common_model->GetAllData('orders' , 'status=3 AND product_id = '.$product_detail['id'].' AND grand_total < '.$order['grand_total'] , 'id' , 'desc');
       // print_r($high_bid);
        if (!$high_bid) {
            return false;
        }

        foreach ($high_bid as $key => $value) 
        {
            $user = $this->common_model->GetSingleData('users' , array('id'=> $value['user_id']));
        
            $config = array();
            $config['mailType'] = "html";
            $config['charset'] = "utf-8";
            $config['newline'] = "\r\n";
            $config['CRLF'] = "\r\n";
            $config['wordwrap'] = TRUE;
            $config['validate'] = FALSE;
        
            $this->email->initialize($config);
            $toz = $user['email'];
            $data['currency'] = $user['currency'];
            $sub = "🗣 New Highest Bid! ".$product_detail['title'];
            $this->email->setFrom(Email, Project);
           
            $this->email->setTo($toz);
            //$this->email->setMailtype("html"); 
            $this->email->setSubject($sub);
            $data["order"] = $value;
            $msg = view('mail/highest_bid',$data);
                
            $this->email->setMessage($msg);
            
            $run  = $this->email->send();
            if($run) {
                return 1;
              } else {
                return 0;
              } 
          }
        

       
    }
    public function edit_checkout_form()
    {
        if (!$this->check_login()) 
        {
            $output['message']='Please login' ;
            $output['status']= 0 ;
             echo json_encode($output);
             return false; 
        }
        $this->validation->setRule('f_name','f_name' , 'trim|required');
        //$this->validation->setRule('l_name','l_name' , 'trim|required');
        $this->validation->setRule('country','country' , 'trim|required');
        $this->validation->setRule('city','city' , 'trim|required');
        $this->validation->setRule('state','state' , 'trim|required');
        $this->validation->setRule('zipcode','zipcode' , 'trim|required');
        $this->validation->setRule('address','address' , 'trim|required');
        //$this->validation->setRule('address2','address2' , 'trim|required');
        $this->validation->setRule('sell_product_id','sell_product_id' , 'trim|required');
        $this->validation->setRule('grand_total','grand_total' , 'trim|required');
        $this->validation->setRule('payment_method','payment_method' , 'trim|required');
        $this->validation->setRule('payment_id','payment_id' , 'trim|required');

        if($this->validation->withRequest($this->request)->run()==false)
        {
       
            $output['message']=$this->validation->getErrors();
            $output['status']= 0 ;       
        }
    
        else
        {
            $sell_product_id = $this->request->getVar('sell_product_id');
            $expire_day = $this->request->getVar('expire_day');
            $order_id = $this->request->getVar('order_id');
            $order = $this->common_model->GetSingleData('orders',array('id'=> $order_id));
            void_payment($order['payment_id']);
            $expire_date = date('Y-m-d H:i' , strtotime('+ '.$expire_day.' Days'));
            $this->common_model->UpdateData('sell_product' , array('id' => $sell_product_id) , array('sold_status' => 2));
            $sell_product = $this->common_model->GetSingleData('sell_product' , array('id' => $sell_product_id));
            $insert['f_name'] = $this->request->getVar('f_name');
            $insert['l_name'] = $this->request->getVar('l_name');
            $insert['seller_id'] = ($sell_product) ? $sell_product['user_id'] : 0;
            $insert['product_id'] = $this->request->getVar('product_id');
            $insert['user_id'] = $this->user_id;
            $insert['expire_day'] = $this->request->getVar('expire_day');
            $insert['expire_date'] = $expire_date;
            $insert['country'] = $this->request->getVar('country');
            $insert['city'] = $this->request->getVar('city');
            $insert['state'] = $this->request->getVar('state');
            $insert['zipcode'] = $this->request->getVar('zipcode');
            $insert['address'] = $this->request->getVar('address');
            $insert['address2'] = $this->request->getVar('address2');
            $insert['sell_product_id'] = $this->request->getVar('sell_product_id');
            $insert['is_new'] = $this->request->getVar('is_new');
            $insert['in_original_box'] = $this->request->getVar('in_original_box');
            $insert['verified_authentic'] = $this->request->getVar('verified_authentic');
            $insert['grand_total'] = convert_currency($this->request->getVar('grand_total')  , 'HKD', $this->currency);
            $insert['trans_fee'] = get_admin()['bid_processing_fee'];
            $insert['payment_fee'] = ($insert['grand_total'] * get_admin()['vat_tax']) / 100;
            $insert['admin_fee'] = convert_currency(($this->request->getVar('total_amount') - $this->request->getVar('grand_total'))  , 'HKD', $this->currency);
            $insert['shipping_fee'] = get_admin()['shipping_fee'];
            $insert['payment_method'] = $this->request->getVar('payment_method');
            $insert['payment_id'] = ($sell_product) ? $this->request->getVar('payment_id') : auth_payment($this->request->getVar('payment_id'));
            $insert['order_uniqueid'] = $this->randomString();
            $insert['status'] = ($sell_product) ? 1 : 3;
            $insert['created_at'] = date('Y-m-d H:i:s');
            $insert['updated_at'] = date('Y-m-d H:i:s');
            

            

            if($order_id)
            {
                $this->common_model->UpdateData('orders', array('id' => $order_id) , $insert);
                $user = $this->common_model->GetSingleData('users',array('id'=> $this->user_id));
                $seller = $this->common_model->GetSingleData('users',array('id'=> $insert['seller_id']));
                $newOrder = $this->common_model->GetSingleData('orders',array('id'=> $order['id']));
                
                
                $act = 'Bid';
                $product_detail = $this->common_model->GetSingleData('product',array('id'=> $order['product_id']));
                if ($seller) 
                {
                    $act = 'Order';
                    $this->common_model->sendOrdertoSeller($newOrder , $seller);
                    $this->common_model->SendOrderConfirmed($newOrder ,  $this->user , $product_detail , 'Order');
                   
                }
                if ($order['grand_total'] != $insert['grand_total']) 
                {
                    
                    if (!$seller) 
                    {
                        $this->sendbidtoHighestCustomer($newOrder , $product_detail ); 
                    }
                    
                    $this->sendOrdertoCustomer($newOrder , $product_detail , $act , 'modified');
                }  
                     
             
                $output['message']='Congratulation! Your '.$act.' has been Updated successfully.' ;
                $output['status']= 1 ;                  
                $output['redirect']=base_url().'/order-details/'.$order_id ; 
                $this->session->setFlashdata('success_msg' , '<div class="alert alert-success">Congratulation! Your '.$act.' has been Updated successfully</div>');           

            }
            else 
            {
            
                $output['message']='<div class="alert alert-danger">Something went wrong</div>' ;
                $output['status']= 0 ;  
            
            }
         }
         echo json_encode($output);
    }
    public function delete_bid()
    {
        
        $order_id = $this->request->getVar('order_id');
        $order = $this->common_model->GetSingleData('orders',array('id'=> $order_id));
        $product_detail = $this->common_model->GetSingleData('product',array('id'=> $order['product_id']));
        void_payment($order['payment_id']);
        $this->common_model->DeleteData('orders' , array('id' => $order_id));
        $reason = isset($_POST['reason']) ? $_POST['reason'] : '';

        $this->sendCancelBid($order,$product_detail  , $reason);
        $output['message']='Bid has been Deleted successfully' ;
        $output['status']= 1 ;  
            
            
         echo json_encode($output);
    }
    private function sendCancelBid($order,$product_detail , $reason)
    {
        $user = $this->user;
        $sub = "Bid Canceled: ".$product_detail['title']." ";
        $toz = $user['email'];
        
        $config = array();
        $config['mailType'] = "html";
        $config['charset'] = "utf-8";
        $config['newline'] = "\r\n";
        $config['CRLF'] = "\r\n";
        $config['wordwrap'] = TRUE;
        $config['validate'] = FALSE;
    
        $this->email->initialize($config);
        
        $this->email->setFrom(Email, Project);
       
        $this->email->setTo($toz);
        //$this->email->setMailtype("html"); 
        $this->email->setSubject($sub);
        $data["order"] = $order;
        $data["reason"] = $reason;
        $msg = view('mail/bid_canceled' ,$data);
            
        $this->email->setMessage($msg);
        
        $run  = $this->email->send();
        if($run) {
            return 1;
          } else {
            return 0;
          }     
       
    }
   
    
    private function sendOrdertoCustomer($data , $product_detail , $act , $is_modified= false)
    {
        $user = $this->user;
        
       
       
        $toz = $user['email'];
        $sub = "Your Bid Is Live! ".$product_detail['title']." "; 
        if($is_modified)
        {
            $sub = "Your Bid Is Modified ! ".$product_detail['title']." "; 
        }
        
        
        $config = array();
        $config['mailType'] = "html";
        $config['charset'] = "utf-8";
        $config['newline'] = "\r\n";
        $config['CRLF'] = "\r\n";
        $config['wordwrap'] = TRUE;
        $config['validate'] = FALSE;
    
        $this->email->initialize($config);
        
        $this->email->setFrom(Email, Project);
        if($data['email'])
        {
            $toz = $data['email'];
        }
        $this->email->setTo($toz);
        //$this->email->setMailtype("html"); 
        $this->email->setSubject($sub);
        $data["order"] = $data;
        $data['currency'] = $user['currency'];
        $msg = view('mail/bid_live' ,$data);
            
        $this->email->setMessage($msg);
        
        $run  = $this->email->send();
        if($run) {
            return 1;
          } else {
            return 0;
          }     

       
    }
   
    function orderDetails($id)
    {
        $data['order'] = $this->common_model->GetSingleData("orders", array("id"=>$id));
       
        
        if($data['order'])
        {
            $data['user'] = $this->common_model->GetSingleData("users", array("id"=>$data['order']['user_id']));
            return view('order-details', $data);
        }
        return view('404');
    }
    function fetch_data()
     {
      sleep(1);
      
      $pager = \Config\Services::pager();
      $config = array();
      
      $config['total_rows'] = $this->search_model->count_all($_POST);
      $config['per_page'] = 8;
      
      // $this->pagination->initialize($config);
      $page = $this->request->uri->getSegment(3);
      $total = $config['total_rows'];
      $start = ($page - 1) * $config['per_page'];
      $output = array(
       'pagination_link'  => $pager->makeLinks($page, $config['per_page'], $total, 'ajax_full'),
       'product_list'   => $this->search_model->fetch_data($config["per_page"], $start, $_POST),
       'total' => 'There are '.$config['total_rows'].' Products.'
      );
      echo json_encode($output);
     }
}
