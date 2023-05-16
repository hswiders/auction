<?php

namespace App\Controllers;
use App\Models\Common_model;
class User extends BaseController
{
    public function __construct() {   
        helper(['form', 'url']);
        $this->session = \Config\Services::session();
        $this->common_model = new Common_model();
        $this->user_id =  $this->session->get('user_id');
        $this->user = $this->common_model->GetSingleData('users', array('id' => $this->user_id));
        if (!$this->user) {
            $this->session->remove('user_id');
            header('Location: '.base_url('login'));
            exit;
        }
        return $this->check_login();
    } 
    
    public function check_login()
    {
      if ($this->session->has('user_id')) {
       if($this->user['email_verified']==0)
       {
         header('Location: '.base_url('verification-pending-screen'));
         exit;
       }
          
      }
      else
      {
        header('Location: '.base_url('login'));
        exit;
      }
       
    }
    public function index()
    {
        return view('dashboard');
    }
    public function account_settings()
    {
        return view('settings');
    }
   public function edit_buyer_info()
    {
        return view('edit_buyer_info');
    }
    public function edit_seller_info()
    {
        return view('edit-seller-info');
    }
   public function edit_currency()
    {
        return view('edit-currency');
    }
   public function edit_shipping()
    {
        return view('edit-shipping');
    }
   
    public function profile()
    {
        
        return view('edit-profile');
    }
    public function change_password()
    {
        
        return view('change-password');
    }
    public function auth_cancel()
    {
        
        echo "cancelled";
        exit;
    }
    public function auth_return()
    {
        
        $pay_token = $_GET['token'];
        $curl = curl_init();
        $token = get_paypal_acess_token();
        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://api-m.sandbox.paypal.com/v1/payments/billing-agreements/'.$pay_token.'/agreement-execute',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_HTTPHEADER => array(
            'Accept-Language: en_US',
            'Accept: application/json',
            'Authorization: Bearer '.$token.''
          ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $this->common_model->UpdateData('users' , ['id' => $this->user_id] , ['paypal_info' => $response]);
        echo "success";
        exit;
    }
   
    public function do_update()
    {

         $this->validation->setRule('first_name','First Name','trim|required');
         $this->validation->setRule('last_name','Last Name','trim|required');
         //$this->validation->setRule('currency','Currency','trim|required');
         
        if($this->validation->withRequest($this->request)->run()==false)
        {
       
            $output['message']=$this->validation->getErrors();
            $output['status']= 0 ;       
        }
    
        else
        {

            $insert['first_name'] = $this->request->getVar('first_name');            
            $insert['last_name'] = $this->request->getVar('last_name');            
            if (isset($_POST['currency'])) 
            {
               $insert['currency'] = $this->request->getVar('currency');
            }
            
            
            
            $insert['update_date'] = date('Y-m-d H:i:s');
            

            $run = $this->common_model->UpdateData('users', array('id'=> $this->user_id) ,$insert );

            if($run)
            {  
             
                $output['message']='Your profile has been updated successfully.' ;
                $output['status']= 1 ;                               

            }
            else 
            {
            
                $output['message']='<div class="alert alert-danger">Something went wrong</div>' ;
                $output['status']= 0 ;  
            
            }
         }
         echo json_encode($output);
    }
    public function do_update_shipping()
    {

         $this->validation->setRule('f_name','First Name','trim|required');
         $this->validation->setRule('l_name','Last Name','trim|required');
         $this->validation->setRule('country','country','trim|required');
         $this->validation->setRule('address','address','trim|required');
         $this->validation->setRule('city','city','trim|required');
         $this->validation->setRule('state','state','trim|required');
         $this->validation->setRule('zipcode','zipcode','trim|required');
         //$this->validation->setRule('currency','Currency','trim|required');
         
        if($this->validation->withRequest($this->request)->run()==false)
        {
       
            $output['message']=$this->validation->getErrors();
            $output['status']= 0 ;       
        }
    
        else
        {

            $insert['first_name'] = $this->request->getVar('f_name');            
            $insert['user_id'] = $this->user_id;            
            $insert['last_name'] = $this->request->getVar('l_name');            
            $insert['country'] = $this->request->getVar('country');            
            $insert['address'] = $this->request->getVar('address');            
            $insert['address2'] = $this->request->getVar('address2');            
            $insert['city'] = $this->request->getVar('city');            
            $insert['state'] = $this->request->getVar('state');            
            $insert['zipcode'] = $this->request->getVar('zipcode');            
            
            
            $insert['created_at'] = date('Y-m-d H:i:s');
            $insert['updated_at'] = date('Y-m-d H:i:s');
            
            
            $has_already = $this->common_model->GetSingleData('user_shipping_info', array('user_id'=> $this->user_id));
            if ($has_already) 
            {
                $run = $this->common_model->UpdateData('user_shipping_info', array('user_id'=> $this->user_id) ,$insert );
            }
            else
            {
                 $run = $this->common_model->InsertData('user_shipping_info' ,$insert );
            }
            

            if($run)
            {  
             
                $output['message']='Your Shipping has been updated successfully.' ;
                $output['status']= 1 ;                               

            }
            else 
            {
            
                $output['message']='<div class="alert alert-danger">Something went wrong</div>' ;
                $output['status']= 0 ;  
            
            }
         }
         echo json_encode($output);
    }
    public function do_update_seller()
    {

         $this->validation->setRule('card_number','card_number','trim|required');
         $this->validation->setRule('card_expire','card_expire','trim|required');
         $this->validation->setRule('card_cvv','card_cvv','trim|required');
         $this->validation->setRule('billing_first','billing_first','trim|required');
         $this->validation->setRule('billing_last','billing_last','trim|required');
         $this->validation->setRule('billing_country','billing_country','trim|required');
         $this->validation->setRule('billing_address','billing_address','trim|required');
         $this->validation->setRule('billing_address2','billing_address2','trim|required');
         $this->validation->setRule('billing_city','billing_city','trim|required');
         $this->validation->setRule('billing_state','billing_state','trim|required');
         $this->validation->setRule('billing_zip','billing_zip','trim|required');
         //$this->validation->setRule('currency','Currency','trim|required');
         
        if($this->validation->withRequest($this->request)->run()==false)
        {
       
            $output['message']=$this->validation->getErrors();
            $output['status']= 0 ;   
              
        }
    
        else
        {
            $c = $this->request->getVar('card_number');
            $check = check_cc($c, false);    
            if(!$check)
            {
                $output['message']= ['card_number' => 'Please enter valid card number'];
                $output['status']= 0 ;  
                echo json_encode($output);
                 exit;    
            }       
            $insert['user_id'] = $this->user_id;            
            $insert['card_number'] = $this->request->getVar('card_number');            
            $insert['card_expire'] = $this->request->getVar('card_expire');            
            $insert['card_cvv'] =  $this->request->getVar('card_cvv');           
            $insert['card_type'] = $check;            
            $insert['billing_first'] = $this->request->getVar('billing_first');            
            $insert['billing_last'] = $this->request->getVar('billing_last');            
            $insert['billing_country'] = $this->request->getVar('billing_country');            
            $insert['billing_address'] = $this->request->getVar('billing_address');            
            $insert['billing_address2'] = $this->request->getVar('billing_address2');            
            $insert['billing_city'] = $this->request->getVar('billing_city');            
            $insert['billing_state'] = $this->request->getVar('billing_state');            
            $insert['billing_zip'] = $this->request->getVar('billing_zip');            
            
            
            $insert['created_at'] = date('Y-m-d H:i:s');
            $insert['updated_at'] = date('Y-m-d H:i:s');
            
            
            $has_already = $this->common_model->GetSingleData('seller_billing_info', array('user_id'=> $this->user_id));
            if ($has_already) 
            {
                $run = $this->common_model->UpdateData('seller_billing_info', array('user_id'=> $this->user_id) ,$insert );
            }
            else
            {
                 $run = $this->common_model->InsertData('seller_billing_info' ,$insert );
            }
            

            if($run)
            {  
             
                $output['message']='Your Seller Billing has been updated successfully.' ;
                $output['status']= 1 ;                               

            }
            else 
            {
            
                $output['message']='<div class="alert alert-danger">Something went wrong</div>' ;
                $output['status']= 0 ;  
            
            }
         }
         echo json_encode($output);
    }
    
    public function do_forgot()
    {
       
        $this->validation->setRule('email','Email','trim|required|valid_email');

        if($this->validation->withRequest($this->request)->run()==false)
        {
            $output['message']=$this->validation->getErrors();
            $output['status']= 2 ;       
        }
    
        else
        {
            $email = $this->request->getVar('email');
           
            $run = $this->common_model->GetSingleData('users',array('email' =>$email ));
            
            if($run)
            {
                $insert['reset_token'] = md5(mt_rand(100000,999999)) ;
                $where['id'] = $run['id'] ;

                $this->common_model->UpdateData('users', $where , $insert);

                $subject="Reset password";
                $body = '<p style="text-align: left;color: black; padding:5px 0;">Hello! '.$run['first_name'].',</p>';               
                $body .= '<p style="text-align: left;color: black; padding:5px 0;">This is an automatic message . If you did not start the Reset Password process recently, please ignore this email.</p>';                
                $body .= '<p style="text-align: left;color: black; padding:5px 0;">You indicated that you forgot your login password. Please click below to reset your '.Project.' account password.</p>'; 

                $body .= '<a href="'.base_url().'/reset-password/'.$run['id'].'/'.$insert['reset_token'].'" style="margin-top: 30px;font-size: 18px;font-weight: 450;font-family: ProximaNova, Helvetica, Arial, sans-serif;color: rgb(255, 255, 255);background: #000;text-decoration: none;border-radius: 2px;border: 0px;display: inline-block;line-height: 35px;padding: 5px 15px;text-size-adjust: 100%;">Reset Password</a>';
                
                

                $this->common_model->SendMail($email,$subject,$body);
                
                $output['message']='You will receive an email with a link to reset your password.' ;
                $output['type']='success' ;
                $output['status']= 1 ;                  
                $output['redirect']= base_url('dashboard') ;  
                
               } 
               else 
               {
                
                $output['message']='Error! This email id does not exists in our system.' ;
                $output['type']='error' ;
                $output['status']= 0 ;                  
                $output['redirect']= base_url('dashboard') ;                  

                }
            
         }
         echo json_encode($output);
    }
    public function do_change_password()
    {

         $this->validation->setRule('curr_password','Current Password','trim|required');
         $this->validation->setRule('password','Password','trim|required|min_length[6]|max_length[12]');
    
         $this->validation->setRule('c_password','Confirm Password','trim|required|matches[password]');

        if($this->validation->withRequest($this->request)->run()==false)
        {
       
            $output['message']=$this->validation->getErrors();
            $output['status']= 0 ;       
        }
    
        else
        {
            $curr_password = base64_encode($this->request->getVar('curr_password'));
            $new_password = base64_encode($this->request->getVar('password'));
            if($this->user['password'] == $curr_password)
            {
                $insert['password'] = $new_password; 
                $insert['update_date'] = date('Y-m-d H:i:s');
                $run = $this->common_model->UpdateData('users', array('id'=> $this->user_id) ,$insert );
                if($run)
                {  
                    $output['message']='Your Password has been updated successfully.' ;
                    $output['status']= 1 ;                               
                    $output['redirect']= base_url().'/profile' ;                               
                }
                else 
                {
                    $output['message']='<div class="alert alert-danger">Something went wrong</div>' ;
                    $output['status']= 0 ;  
                } 
            }
            else 
            {
                $output['message']= ['curr_password' => 'Current password is incorrect'] ;
                $output['status']= 0 ;
            }            
            
            
         }
         echo json_encode($output);
    }
    public function do_create_agreement()
    {

        $curl = curl_init();
        $token = get_paypal_acess_token();
        $curr_date = date('Y-m-d' , strtotime("+ 1 day"));
        $curr_time = '00:00:00';
        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://api-m.sandbox.paypal.com/v1/payments/billing-agreements',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS =>'{
            "name": "Override Agreement",
            "description": "PayPal payment agreement that overrides merchant preferences and shipping fee and tax information.",
            "start_date": "'.$curr_date.'T'.$curr_time.'Z",
            "payer": {
                "payment_method": "paypal",
                "payer_info": {
                    "email": "'.$this->user['email'].'"
                }
            },
            "plan": {
                "id": "P-6SC98085JM707305RGGK3HOI"
            },
            "override_merchant_preferences": {
                "return_url": "'.base_url('auth_return').'",
                "cancel_url": "'.base_url('auth_cancel').'",
                "auto_bill_amount": "YES",
                "initial_fail_amount_action": "CONTINUE",
                "max_fail_attempts": "11"
            }
        }',
          CURLOPT_HTTPHEADER => array(
            'Accept-Language: en_US',
            'Accept: application/json',
            'Authorization: Bearer '.$token.'',
            'Content-Type: application/json'
          ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;

    }

    public function wish_list()
    {
       
        $wishlist = $this->common_model->GetAllData('wishlist',array('user_id' =>$this->user_id));
        $myProduct = [];
        foreach ($wishlist as $key => $value) {
            $product = $this->common_model->GetSingleData('product',array('id'=>$value['product_id']));
            array_push($myProduct, $product);

        }
        $data['products'] = $myProduct;
        return view('my-wishlist',$data);
    }
    public function exchange_list()
    {
       
        $exchange_list = $this->common_model->GetAllData('exchange_list',array('user_id' =>$this->user_id));
        $myProduct = [];
        foreach ($exchange_list as $key => $value) {
            $product = $this->common_model->GetSingleData('product',array('id'=>$value['product_id']));
            if ($product) {
                 array_push($myProduct, $product);
            }
           

        }
        //print_r($myProduct);
        $data['products'] = $myProduct;
        return view('my-exchange_list',$data);
    }
    

}
