<?php

namespace App\Controllers;

class Signup extends BaseController
{
    // public function __construct() 
    // {
    //     $this->check_login();
    //     error_reporting(1);
    // }
    public function __construct() {   
        helper(['form', 'url']);
        $this->session = \Config\Services::session();
        return $this->check_login();
    } 
    public function index()
    {
        return view('signup');
    }
    public function check_login()
    {
      if ($this->session->has('user_id')) {
          header('Location: '.base_url('dashboard'));
          exit;
      }
       
    }
    public function do_signup()
    {

         $this->validation->setRule('first_name','First Name','trim|required');
         $this->validation->setRule('last_name','Last Name','trim|required');
         
         $this->validation->setRule('password','Password','trim|required|min_length[6]|max_length[25]');
         $this->validation->setRule('cnfm_password','Confirm Password','trim|required|min_length[6]|max_length[25]|matches[password]');
         // $this->validation->setRule('phone','Mobile','required');
         // $this->validation->setRule('cpassword','Confirm Password','alpha_numeric_spaces|trim|required|matches[password]');
         $this->validation->setRule('email','Email','trim|required|valid_email|is_unique[users.email]',array('is_unique' =>'This email already exit'));

        $code = rand();
        if($this->validation->withRequest($this->request)->run()==false)
        {
       
            $output['message']=$this->validation->getErrors();
            $output['status']= 0 ;       
        }
    
        else
        {
            $insert['first_name'] = $this->request->getVar('first_name');            
            $insert['last_name'] = $this->request->getVar('last_name');            
            $insert['email'] = $this->request->getVar('email');
            $insert['username'] = $this->random_username($insert['first_name'].' '.$insert['last_name']);
            $insert['password'] = base64_encode($this->request->getVar('password'));
            $insert['status'] = 1;
            $insert['create_date'] = date('Y-m-d H:i:s');
            $insert['token'] = md5(mt_rand(100000,999999)) ;

            $run = $this->common_model->InsertData('users',$insert);

            if($run)
            {
                $user_id =   $this->session->set('user_id',$run);  
                $login_id = $this->session->get('user_id'); 

                $user = $this->common_model->GetSingleData('users',array('id'=>$login_id));
                $email = $this->request->getVar('email');
                $subject="Account created !";
                $body = '<p style="font-size: 16px;color: #000;padding: 5px;">Hello '.$this->request->getVar('first_name').' </p><p> Congratulation! This is an email to inform you that your account has been created successfully.</p>';
                $body .= '<p style="font-size: 16px;color: #000;padding: 5px;">Please <a href="'.base_url().'/verify-email/'.$run.'/'.$insert['token'].'">click here </a> to verify your account</p>';
                $send = $this->common_model->SendMail($email,$subject,$body);       
             
                $output['message']='Your account has been created successfully. Please check your email to verify your account' ;
                $output['status']= 1 ;                  
                $output['redirect']=base_url().'/dashboard' ;                  

            }
            else 
            {
            
                $output['message']='<div class="alert alert-danger">Something went wrong</div>' ;
                $output['status']= 0 ;  
            
            }
         }
         echo json_encode($output);
    }
    function random_username($string) 
    {
        return vsprintf('%s%s%d', [sscanf(strtolower($string), '%s %2s'), random_int(0, 100)]);
    }
}
