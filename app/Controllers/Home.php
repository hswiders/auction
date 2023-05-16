<?php

namespace App\Controllers;
use App\Models\Common_model;
use App\Models\Search_news;
class Home extends BaseController
{
    public function __construct()
    {
        $this->session = \Config\Services::session();
        helper(['form', 'url' , 'cookie']);
        $this->common_model = new Common_model();
        $this->search_news = new Common_model();
        $this->db = \Config\Database::connect();
        $this->user_id =  $this->session->get('user_id');
        $this->user = $this->common_model->GetSingleData('users', array('id' => $this->user_id));

    }
    public function index()
    {
        $data['footer_banner'] = $this->common_model->GetAllData('footer_banner');
        $product_group = $this->common_model->GetAllData('product_group','status=1','sorting','asc');
        $groups = [];
        foreach ($product_group as $key => $value) {
            $value['products'] = $this->common_model->GetAllData('product','status=1 AND find_in_set('.$value['id'].' , product_group)','id','desc');
            array_push($groups, $value);
        }
        //print_r($groups); die;
        $data['product_group'] = $groups;
        
    
        return view('index' , $data);
    }
   
    
    public function logout()
    {
        $this->session->remove('user_id');
        $this->session->setFlashdata('msg','<div class="alert alert-success">You have been Logged out successfully.</div>');
        return redirect('login');
    }
    public function verify_email($id,$token)
    {
        $true = false;
        if($id && $token){
        $data = $this->common_model->GetSingleData('users',array('id'=>$id,'email_verified'=>'0'));
            if($data){
                if($data['email_verified'] == 0){
                    if($data['token'] == $token){
                        
                        $update['email_verified'] = 1;
                        $run = $this->common_model->UpdateData('users',array('id'=>$id),$update);
                        if($run){
                                               
                            $user = $this->common_model->GetSingleData('users',array('id'=>$id));
                            $arr['token']='' ;
                            $uid = $this->common_model->UpdateData('users',array('id'=>$id),$arr);

                            $this->session->setFlashdata('msg','<div class="alert alert-success">Your email has been verified successfully.</div>');
                            $true = true;
                           
                        
                        }else{
                            
                            $this->session->setFlashdata('msg','<div class="alert alert-danger">Server not responding, please try again later.</div>');
                           
                            
                        }
                    } else {
                        $this->session->setFlashdata('msg','<div class="alert alert-danger">User not authorized or link is expired.</div>');
                        
                    }
                } else {
                    $this->session->setFlashdata('msg','<div class="alert alert-success">Your account is already verified, You can access your account.</div>');
                    
                }
            } else {
                $this->session->setFlashdata('msg','<div class="alert alert-danger">User not authorized or link is expired.</div>');
                
            }
        } else {
            $this->session->setFlashdata('msg','<div class="alert alert-danger">User not authorized or invalid token code.</div>');
            
        }
        
            if($this->session->get('user_id')) 
            {
                return redirect('profile');
            }
            else
            {
                return redirect('login');
            }
    }
    public function verify_pending()
    {
        return view('verify_pending');
    }
    public function sendEmail_veification()
      {
           $user_id = $this->session->get('user_id');
           if($user_id)
           {

           $user = $this->common_model->GetSingleData('users',array('id'=>$user_id,'email_verified'=>1));
       if($user)
      {
              return redirect('dashboard');
            }
            $user_data = $this->common_model->GetSingleData('users',array('id'=>$user_id,'email_verified'=>0));
            $email = $user_data['email'];
   
      $insert['token'] = md5(mt_rand(100000,999999)) ;

      $uid = $this->common_model->UpdateData('users',array('id'=>$user_id),$insert);


            $subject="Verify Email!";    
            $body = '<p style="font-size: 16px;color: #000;padding: 5px;">Hello '. $user_data['first_name'].'</p><p style="font-size: 16px;color: #000;padding: 5px;"> Please verify your email address.</p>';
            $body .= '<p style="font-size: 16px;color: #000;padding: 5px;">Please <a href="'.base_url().'/verify-email/'.$user_id.'/'.$insert['token'].'">click here </a> to verify your account</p>';
             
      
          $send = $this->common_model->SendMail($email,$subject,$body);
                
          $this->session->setFlashdata('msg','We have sent you a verification link to '.$email.', please check it and verify your account.It may be in your Spam/Bulk/Junk folder.');

            //$data['status']=1;
            return redirect('verification-pending-screen');
       }
       else
       {
         return redirect('login');
       }
     }
     
    public function reset_password($id,$token)
    {
        $true = false;
        if($id && $token)
        {
            $data['user'] = $this->common_model->GetSingleData('users',array('id'=>$id , 'reset_token'=>$token));
            if (!$data['user']) {
                return redirect('/');
            }
            $data['token'] = $token;
            return view('reset_password', $data);
        }
        else
        {
            return redirect('/');
        }

            
    }
    public function do_reset()
    {
       
        $this->validation->setRule('user_id','user_id','trim|required');
        $this->validation->setRule('password','new password','trim|required|min_length[6]|max_length[25]');
        $this->validation->setRule('token','token','trim|required');
        $this->validation->setRule('cpassword','confirm new password','trim|required|matches[password]');

        if($this->validation->withRequest($this->request)->run()==false)
        {
            $output['message']=$this->validation->getErrors();
            $output['status']= 2 ;       
        }
    
        else
        {
            $token = $this->request->getVar('token');
            $user_id = $this->request->getVar('user_id');
            $password = $this->request->getVar('password');
           
            $run = $this->common_model->GetSingleData('users',array('reset_token' =>$token , 'id' =>$user_id ));
            
            if($run)
            {
                $password = base64_encode($password) ;
                $this->common_model->UpdateData('users',array('id' =>$user_id ) , ['password' => $password , 'reset_token' =>'']);
                
                
                $output['message']='Success! Your  password  has been Changed successfully' ;
                $output['type']='success' ;
                $output['status']= 1 ;                  
                $output['redirect']= base_url('login') ;  
                
           } 
           else 
           {
            
            $output['message']='Error! Token is not valid.' ;
            $output['type']='error' ;
            $output['status']= 0 ;                  
            $output['redirect']= base_url('login') ;                  

            }
            
         }
         echo json_encode($output);
    } 
    public function do_subscribe()
    {
       
        $this->validation->setRule('email','email','trim|required|is_unique[newsletter.email]' ,array(
                'required'      => 'You have not provided email.',
                'is_unique'     => 'This email is already subscribed.'
        ));
        

        if($this->validation->withRequest($this->request)->run()==false)
        {
            $output['message']=$this->validation->getErrors();
            $output['status']= 2 ;       
        }
    
        else
        {
            $email = $this->request->getVar('email');
            
            $run = $this->common_model->InsertData('newsletter',array('email' =>$email));
            
            if($run)
            {
                
                
                $output['message']='Success! Your  email  has been Subscribed successfully' ;
                $output['type']='success' ;
                $output['status']= 1 ;                  
                $output['redirect']= base_url('login') ;  
                
           } 
           else 
           {
            
            $output['message']='Error! Something wrong.' ;
            $output['type']='error' ;
            $output['status']= 0 ;                  
            $output['redirect']= base_url('login') ;                  

            }
            
         }
         echo json_encode($output);
    }


    public function faq_list()
    {
        //echo "hello";
        $data['faq_list'] = $this->common_model->GetAllData('faqs','','id','desc');
        return view('faq-list',$data);
    }
    public function gamex_products()
    {
        //echo "hello";
        $data['gamex_products'] = $this->common_model->GetAllData('product','created_by=0','id','desc');
        return view('gamex-products',$data);
    }

    public function add_to_fav()
    {
      //echo "hello";
        $this->validation->setRule('product_id','Product Id','trim|required');
        

        if($this->validation->withRequest($this->request)->run()==false)
        {
            return json_encode(["status"=>0,"msg"=>$this->validation->getErrors()]);
                   
        }

        else
        {
          $product_id = $this->request->getVar('product_id');
            if (!$this->user_id) {
              return json_encode(["status"=>2,"msg"=>"Please login product add to favorite"]);
             
            }
        $check = $this->common_model->GetSingleData('wishlist',array('user_id'=>$this->user_id,'product_id'=>$product_id));
        if(!empty($check))  {
          $check_delete = $this->common_model->DeleteData('wishlist',array('user_id'=>$this->user_id,'product_id'=>$product_id));
            return json_encode(["status"=>0,"msg"=>"Product removed from favourites"]);
           
        }
           $insert['user_id']= $this->user_id;
           $insert['product_id']= $product_id;
           $insert['created_at'] = date('Y-m-d');
            
             $run = $this->common_model->InsertData('wishlist', $insert);
             return json_encode(["status"=>1,"msg"=>"Product Added to favourites"]);
        }
        //echo json_encode($output);
    }
    public function add_to_ex()
    {
      //echo "hello";
        $this->validation->setRule('product_id','Product Id','trim|required');
        

        if($this->validation->withRequest($this->request)->run()==false)
        {
            return json_encode(["status"=>0,"msg"=>$this->validation->getErrors()]);
                   
        }

        else
        {
          $product_id = $this->request->getVar('product_id');
            if (!$this->user_id) {
              return json_encode(["status"=>2,"msg"=>"Please login product add to Exchange List"]);
             
            }
        $check = $this->common_model->GetSingleData('exchange_list',array('user_id'=>$this->user_id,'product_id'=>$product_id));
        if(!empty($check))  {
          $check_delete = $this->common_model->DeleteData('exchange_list',array('user_id'=>$this->user_id,'product_id'=>$product_id));
            return json_encode(["status"=>0,"msg"=>"Product removed from Exchange List"]);
           
        }
           $insert['user_id']= $this->user_id;
           $insert['product_id']= $product_id;
           $insert['created_at'] = date('Y-m-d');
            
             $run = $this->common_model->InsertData('exchange_list', $insert);
             return json_encode(["status"=>1,"msg"=>"Product Added to Exchange List"]);
        }
        //echo json_encode($output);
    }
    public function oneHourCron()
    {
         $wallet_status = $this->common_model->GetAllData('wallet_transactions',array('status'=>0));
        foreach ($wallet_status as $key => $value) 
        {
            if($value['transfer_response'])
            {
                 $transfer_response = json_decode($value['transfer_response']);
                  //print_r($transfer_response);
                 $data3['api_url'] = "transfers/".$transfer_response->token;
                 
                 $res3 = runCurl($data3 , "GET" );
                 if($res3['httpcode'] != 200)
                 {
                    $transferRes = $res3['response'];
                    if($transferRes && $transferRes->status == 'COMPLETED')
                    { 
                        $update['status'] = 1;
                        $run = $this->common_model->UpdateData('wallet_transactions',['id'=>$value['id']], $update);
                        if($run)
                        {
                            $payout_info = $this->common_model->GetSingleData('hw_users',['id'=> $value['payout_id']]);
                            $userData = $this->common_model->GetSingleData('users',['id'=>$value['user_id']]);
                            $subject="Withdrawal Request Completed";    
                            $body = '<p>Dear '. $userData['first_name'].' '. $userData['last_name'].'</p>';
                            $body .= "<p>We are pleased to inform you that your withdrawal request for ".$value['amount']." has been completed. The funds have been transferred to your ".$payout_info['payout_type']." account and should be available within 3 business days.</p>";
                            $send = $this->common_model->SendMail($userData['email'],$subject,$body);
                            
                                $this->session->setFlashdata('msg', '<div class="alert alert-success">Withdrawal request has been approved successfully.</div>');
                            $output['status']=1;
                            $output['message']="Withdrawal request has been approved successfully.";
                        }
                        else
                        {
                            $this->session->setFlashdata('msg', '<div class="alert alert-success">Something Went Wrong.</div>');
                            $output['status']=1;
                            $output['message']="Something Went Wrong.";
                        }
                    } 
                 }
                 else
                 {
                     echo '<pre>';
                     print_r($res3);
                     echo '</pre><br/><br/>';
                 }
            }
            else
             {
                 echo '<pre>';
                 echo 'No response for #'.$value['id'];
                
                 echo '</pre><br/><br/>';
             }
        }
    }
    public function updateDataCron()
    {
        $orders = $this->common_model->GetAllData('orders',array('status'=>3));
        foreach ($orders as $key => $value) 
        {
            $expire_date = strtotime($value['expire_date']);
            $current_date = strtotime(date('Y-m-d'));
            if ($expire_date <= $current_date) 
            {
                $update['status'] = 4;
                $this->common_model->UpdateData('orders',array('id'=>$value['id']) , $update);
                $data = void_payment($value['payment_id']);
                print_r($data);
                echo "date matched <br>";
            }
            else{
                $date1 = new \DateTime($value['expire_date']);
                $date2 = new \DateTime(date('Y-m-d H:i:s'));

                $interval = $date1->diff($date2);
                $hours = $interval->h + ($interval->days * 24);
                $product_details = $this->common_model->GetSingleData('product' ,array('id'=>$value['product_id']));
                if ($hours == 2) {
                    $this->common_model->sendExpiredBid($value , $product_details , '' , $this->user);
                }
            }
        }

        $sell_product = $this->common_model->GetAllData('sell_product',array('sold_status'=>0));
        foreach ($sell_product as $key => $value) 
        {
            $expire_date = strtotime($value['exp_date']);
            $current_date = strtotime(date('Y-m-d'));
            if ($expire_date <= $current_date) 
            {
                $update['sold_status'] = 3;
                $this->common_model->UpdateData('sell_product',array('id'=>$value['id']) , $update);
                echo "date matched for sell product ";
            }
            else{
                $date1 = new \DateTime($value['exp_date']);
                $date2 = new \DateTime(date('Y-m-d H:i:s'));

                $interval = $date1->diff($date2);
                $hours = $interval->h + ($interval->days * 24);
                $product_details = $this->common_model->GetSingleData('product' ,array('id'=>$value['product_id']));
                if ($hours == 2) {
                    $this->common_model->sendExpiredSell($value , $product_details , '' , $this->user);
                }
            }
            
        }
       

    }
}
