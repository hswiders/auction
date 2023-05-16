<?php 
namespace App\Controllers\Admin;
use App\Controllers\BaseController;
class Admin extends BaseController {

	public function __construct() {   
        helper(['form', 'url']);
        $this->session = \Config\Services::session();
        //return $this->check_login();
    } 
    public function check_login()
    {
      if ($this->session->has('admin_id')) {
          header('Location: '.base_url('admin/dashboard'));
      }
       
    }

  	public function login()
    {
    	$this->check_login();
        return view('admin/admin-login');
    }

  	

  	public function Forgot()
    {
    	return view('admin/forgot');
    }

	

    public function do_login()
	{
		helper(['form']);
	    if ($this->request->getMethod() == "post") {
	        $validation =  \Config\Services::validation();

	        $rules = [
	            "email" => [
	                "label" => "Email", 
	                "rules" => "required|valid_email|"
	            ],
	            "password" => [
	                "label" => "Password", 
	                "rules" => "required"
	            ]
	        ];

	        if ($this->validate($rules)) {
				$email = $_POST['email'];
				$password = $_POST['password'];
				$run = $this->common_model->GetSingleData('admin',array('email' =>$email ,'password'=>$password));
				//$id = $run[0]->id;
		
				if($run)
				{
					$this->session->set('admin_id', $run['id']);
	  		 		$login_id = $this->session->get('admin_id');
		 				//session()->set('admin_id', $run['id']);                   
						//$output['session']= $login_id;
						$output['message']= 'Login successfully';
						$output['status']=1;
	 					$output['redirect']= 'admin/dashboard';
				}
				else 
				{
					$output['message']='<div class="alert alert-danger">Invaild login Details !</div>';  
				}
	        } else {
	        	$output['status']= 0 ; 
	            $output["validation"] = $validation->getErrors();
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
           
            $run = $this->common_model->GetSingleData('admin',array('email' =>$email ));
            
            if($run)
            {
                $subject="Forgot Password!";    
            	$body = '<p>Hello '. $run['name'].'</p>';
            	$body .= '<p>You indicated that you forgot your login password.</p>';
            	$body .= '<p>Your password is ' .$run['password']. '</p>';
	            $send = $this->common_model->SendMail($email,$subject,$body);
	            if($send){
		            $output['message']='Password has Been Sent To Your Email' ;
	                $output['status']= 1 ;
	            } else 
	            {
	            	$output['message']='Something Went Wrong' ;
	                $output['status']= 0 ;

	            }                   

            }
            else 
            {
            
                $output['message']='<div class="alert alert-danger">Invalid Email id</div>' ;
                $output['status']= 0 ;  
            
            }
         }
         echo json_encode($output);
    }

   /* public function subscription_list()
    {
        $data['subscription_list'] = $this->common_model->GetAllData('newsletter','','id','desc');
        return view('admin/subscription-list', $data);
    }*/
}
    