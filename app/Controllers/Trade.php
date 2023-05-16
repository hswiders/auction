<?php

namespace App\Controllers;
use App\Models\Common_model;
use App\Models\Search_model;
class Trade extends BaseController {
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
        if ($slug) {
            $split = explode('-', $slug);
            $cat_id = end($split);
            if ($this->common_model->GetSingleData("categories", array("id"=>$cat_id))) {
                $data['active_cat'] = $cat_id;
            }
            else
            {
               return redirect('/','refresh');
            }
            
        }
        $data['categories'] = $this->common_model->GetAllData("categories", 'parent=0' , 'id' , 'desc');
        $data['brands'] = $this->common_model->GetAllData("brands", '' , 'id' , 'desc');

           
        return view('trade' , $data);
    }
    function trade_detail($slug)
    {
        $url = explode('-', $slug);
        $id  = end($url);
        $data['product'] = $this->common_model->GetSingleData("product", array("id"=>$id));
        $data['categories'] = $this->common_model->GetAllData('categories',array('parent'=>0),'id','desc');
        $data["product_image"] = $this->common_model->GetAllData("product_image", array("product_id"=>$id));
        $run = "SELECT * , product.id as p_id FROM product WHERE id IN (select product_id from exchange_list where user_id = '".$this->user_id."') ";
        $exchange = $this->db->query($run);
        $data["exchange_list"] = $exchange->getResultArray();
        if($data['product'])
        { 
            $data['in_hand_game'] = $this->common_model->GetSingleData('exchange_list',array('user_id' =>$this->user_id , 'product_id ' =>$id));
            $data['exchange_in_process'] = $this->common_model->GetSingleData('exchange_order' , array('user_id' =>$this->user_id , 'product_id ' =>$id , 'status' => 0));
            // $myProduct = [];
            // foreach ($exchange_list as $key => $value) {
            //     $product = $this->common_model->GetSingleData('product',array('id'=>$value['product_id']));
            //     array_push($myProduct, $product);

            // }
            // $data['products'] = $myProduct;
            return view('trade-detail', $data);
        }

        return view('404');
    }

    public function searchKey()
    {

        $value = $this->request->getVar('val');
        $class_type = $this->request->getVar('class_type');
        $product_id = $this->request->getVar('product_id');
            
        //$run = "SELECT * FROM product WHERE (title LIKE '%".$value."%' OR description LIKE '%".$value."%' OR format LIKE '%".$value."%' ) ";
        $run = "SELECT *, product.title as p_title, product.id as p_id FROM product INNER JOIN categories ON product.category AND product.subcategory=categories.id WHERE (product.title LIKE '%".$value."%' OR categories.title LIKE '%".$value."%' OR description LIKE '%".$value."%') AND product.id != $product_id AND product.class_type != $class_type AND created_by=0 ";
        $data = $this->db->query($run);
        if($data->getNumRows() > 0)
        {
            $output =  $data->getResultArray();
        }
        $html = "";
        $checked = $_POST['checked'];
        foreach($output as $val)
        {
            $grades = $this->common_model->GetSingleData('class_type' , array('id'=>$val["class_type"])); 
           
            $check2 = $this->common_model->GetSingleData('exchange_list' , array('product_id' => $val['p_id'],'user_id'=>$this->user_id)); 
            $add_btn = ($check2) ? '<a href="javascript:;" class="btn btn-danger product_ex_'. $val['p_id'] .'" onclick="return addToEx('.$val['p_id'] .')">Remove</a>' : '<a class="btn btn-primary product_ex_'. $val['p_id'] .'" href="javascript:;" onclick="return addToEx('.$val['p_id'] .')">Add to list</a>';
            $html .= '<li>';        
            $html .= '<label><div class="row">';        
            $html .= '<div class="col-md-3">';
            $image = $this->common_model->GetSingleData('product_image',array('product_id'=>$val['p_id'])); 
            $html .= '<img width="150px" src='.base_url().'/'.$image['image'].'>'; 
            $html .= '</div>'; 
            $html .= '<div class="col-md-5">';
            $html .= '<h3>'.$val['p_title'].' <span class="add-fav badge '. $grades["class_color"] .'" >
            Grade '.$grades["class_name"].'
          </span></h3>';
            
            $html .= '</div>';
            $html .= '<div class="col-md-4">';
            $html .= '<span class="add-fav" style="right: 40px;">
              '. $add_btn.'
            </span>';
            
            $html .= '</div>';
            $html .= '</div></label>';
            $html .= '</li>';
        }
        $output['html'] = $html;
        echo json_encode($output);
         
        
    }
    public function trade_this()
    {

        $id = implode(',', $this->request->getVar('ids'));
        $product_id = $this->request->getVar('product_id');
        $class_type = $this->request->getVar('class_type');
        $data['exchange_in_process'] = $this->request->getVar('exchange_in_process');
            
        $data['products'] = $this->common_model->GetAllData('product' , 'id IN('.$id.')');
        $data['p_to_ex'] = $this->common_model->GetSingleData('product' , 'id = '.$product_id);
        
        $html = "";

        $output['html'] = view('loop/trade_ajax_data' , $data);
        if (!$data['products']) {
            $output['html'] = '';
        }
        $output['status'] = 1;

        echo json_encode($output);
         
        
    }
    public function check_stocks()
    {

        $product_id = $this->request->getVar('product_id');
        $class_type = $this->request->getVar('class_type');
        
        $p_to_ex = $this->common_model->GetSingleData('product' , 'id = '.$product_id);

        $output['status'] = 0;
        if($p_to_ex['stock'] > 0)
        {
            $output = $this->checkout_quee($p_to_ex);
            
        }
        echo json_encode($output);
         
        
    }

    public function checkout_quee($p)
    {
        $where['product_id'] = $p['id'];
        $allquee = $this->common_model->GetAllData('checkout_quee' , $where);
        if($allquee)
        {

            foreach($allquee as $val)
            {
                $created_at = $val['added_time'];
                $current_date = date('Y-m-d H:i:s');
                $seconds = strtotime($current_date) - strtotime($created_at);
                $minutes = round($seconds / 60);
                
               if($minutes >= 2)
               {
                    $this->common_model->DeleteData('checkout_quee' , ['id' => $val['id']]);
               }
            }
        }
        
        
        $quee = $this->common_model->GetAllData('checkout_quee' , $where);
        $output['status'] = 0;
        if($quee)
        {
           if(count($quee) < $p['stock'])
           {
                $where['added_time'] = date('Y-m-d H:i:s');
                $where['user_id'] = $this->user_id;
                $this->common_model->InsertData('checkout_quee' , $where);
                $output['status'] = 1;
           }
        }
        else{
                $where['added_time'] = date('Y-m-d H:i:s');
                $where['user_id'] = $this->user_id;
                $this->common_model->InsertData('checkout_quee' , $where);
                $output['status'] = 1;
        }
        return $output;
    }
    public function do_delete()
    {

        $id = $this->request->getVar('id');  
        $data = $this->common_model->GetSingleData('exchange_order' , 'id = '.$id);
        $productData = $this->common_model->GetSingleData('product', array('id'=> $data['product_id'])); 
        $this->common_model->UpdateData('product', array('id'=> $productData['id']) , array('stock' => $productData['stock']+1));  
        $void = void_payment(@$data['payment_id']);
        $this->common_model->DeleteData('exchange_order' , 'id = '.$id);  
        $output['status'] = 1;
        echo json_encode($output); 
        
    }
    public function add_exchange()
    {
        $data['categories'] = $this->common_model->GetAllData("categories", 'parent=0' , 'id' , 'desc');
       return view('add-exchange' , $data);
         
        
    }
    public function submit_exchange_form()
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
        $this->validation->setRule('exchange_product_ids','exchange_product_ids' , 'trim|required');
        $this->validation->setRule('step_charge','step_charge' , 'trim|required');
        $this->validation->setRule('payment_method','payment_method' , 'trim|required');
        $this->validation->setRule('payment_id','payment_id' , 'trim|required');

        if($this->validation->withRequest($this->request)->run()==false)
        {
       
            $output['message']=$this->validation->getErrors();
            $output['status']= 0 ;       
        }
    
        else
        {
            $exchange_product_ids = $this->request->getVar('exchange_product_ids');
           
            
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
            $insert['product_id'] = $this->request->getVar('product_id'); 
            $insert['exchnage_product_id'] = $exchange_product_ids;
            $insert['grand_total'] = convert_currency($this->request->getVar('total_amount')  , 'HKD', $this->currency);
            $insert['price'] = convert_currency($this->request->getVar('step_charge')  , 'HKD', $this->currency);
            $insert['service_fee'] = convert_currency(($this->request->getVar('total_amount') - $this->request->getVar('step_charge')) - get_admin()['exchange_shipping_fee']  , 'HKD', $this->currency);
            $insert['shipping_fee'] = get_admin()['exchange_shipping_fee'] ;
            $insert['payment_method'] = $this->request->getVar('payment_method');
            $insert['payment_id'] = auth_payment($this->request->getVar('payment_id'));
            $insert['order_uniqueid'] = $this->randomString();
            $insert['status'] = 0;
            $insert['created_at'] = date('Y-m-d H:i:s');
            $insert['updated_at'] = date('Y-m-d H:i:s');
            
            $run = $this->common_model->InsertData('exchange_order',$insert);
            
            if($run)
            {
                
                $user = $this->common_model->GetSingleData('users',array('id'=> $this->user_id));
               
                $exchange_order = $this->common_model->GetSingleData('exchange_order',array('id'=> $run));
                
                $product_detail = $this->common_model->GetSingleData('product',array('id'=> $exchange_order['product_id']));
                $this->common_model->UpdateData('product', array('id'=> $product_detail['id']) , array('stock' => $product_detail['stock']-1));
                $this->sendExOrderCustomer($user , $exchange_order , $product_detail);
                $output['message']='Thank you very much Your Exchange order has been placed successfully.' ;
                $output['status']= 1 ;                  
                $output['redirect'] = base_url().'/exchange-order'; 
                $this->session->setFlashdata('success_msg' , '<div class="alert alert-success">Thank you very much! Your Exchange order has been placed successfully</div>');           
                $where['user_id'] = $this->user_id;
                $where['product_id'] = $product_detail['id'];
                $this->common_model->DeleteData('checkout_quee' , $where);
            }
            else 
            {
            
                $output['message']='<div class="alert alert-danger">Something went wrong</div>' ;
                $output['status']= 0 ;  
            
            }
         }
         echo json_encode($output);
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
    private function sendExOrderCustomer($user , $exchange_order , $product_detail)
    {

       $email = $user['email'];
                $subject="Exchange Game for ".$product_detail['title'];
                $body = '<p>Hello '.$user['first_name'].' </p><p> Thank you for using our services This is an email to inform you that your Exchange has been Recieved successfully. We will get back to you shortly</p>';
                $body .= '<p >Please <a href="'.base_url().'/exchange-order/">click here </a> to Check</p>';
                $send = $this->common_model->SendMail($email,$subject,$body);
                //echo $send;
                return $send;

       
    }
}
