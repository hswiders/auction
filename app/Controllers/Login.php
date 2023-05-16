<?php

namespace App\Controllers;

class Login extends BaseController
{
	public function __construct() {   
        helper(['form', 'url']);
        $this->session = \Config\Services::session();
        return $this->check_login();
    } 
    public function check_login()
    {
      if ($this->session->has('user_id')) {
          header('Location: '.base_url('profile'));
      }
       
    }
    public function index()
    {
        return view('login');
    }
    public function forgot()
    {
        return view('forgot');
    }
    public function do_login()
    {
        $this->validation->setRule('password1','Password','trim|required');
        $this->validation->setRule('email1','Email','trim|required|valid_email');

        if($this->validation->withRequest($this->request)->run()==false)
        {
            $output['message']=$this->validation->getErrors();
            $output['status']= 2 ;       
        }
    
        else
        {
        	$email = $this->request->getVar('email1');
			$password =  base64_encode($this->request->getVar('password1'));
			$run = $this->common_model->GetSingleData('users',array('email' =>$email ,'password'=>$password));
            
            if($run)
            {
                if ($run['status'] == 1) 
                {
                    $this->session->set('user_id',$run['id']);  
                 
                    $output['message']='You are logged in successfully.' ;
                    $output['status']= 1 ;                  
                    $output['redirect']= base_url('/') ; 
                }
                else
                {
                    $output['message']='<div class="alert alert-danger">Your account has been disabled. please contact admin</div>' ;
                    $output['status']= 0 ; 
                }
                                 

            }
            else 
            {
            
                $output['message']='<div class="alert alert-danger">Invalid Login details</div>' ;
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

                $subject="Forgot password";
                $body = '<p style="text-align: left;color: black; padding:5px 0;">Hello! '.$run['first_name'].',</p>';               
                $body .= '<p style="text-align: left;color: black; padding:5px 0;">This is an automatic message . If you did not start the Forgot Password process recently, please ignore this email.</p>';                
                $body .= '<p style="text-align: left;color: black; padding:5px 0;">You indicated that you forgot your login password. Please click below to reset your '.Project.' account password.</p>'; 

                $body .= '<a href="'.base_url().'/reset-password/'.$run['id'].'/'.$insert['reset_token'].'" style="margin-top: 30px;font-size: 18px;font-weight: 450;font-family: ProximaNova, Helvetica, Arial, sans-serif;color: rgb(255, 255, 255);background: #000;text-decoration: none;border-radius: 2px;border: 0px;display: inline-block;line-height: 35px;padding: 5px 15px;text-size-adjust: 100%;">Reset Password</a>';
                
                

                $this->common_model->SendMail($email,$subject,$body);
                
                $output['message']='If there is an account associated with the provided email address, then you will receive an email with a link to reset your password.' ;
                $output['type']='success' ;
                $output['status']= 1 ;                  
                $output['redirect']= base_url('forgot') ;  
                
               } 
               else 
               {
                
                $output['message']='Error! This email id does not exists in our system.' ;
                $output['type']='error' ;
                $output['status']= 0 ;                  
                $output['redirect']= base_url('forgot') ;                  

                }
            
         }
         echo json_encode($output);
    }
    
    
}
