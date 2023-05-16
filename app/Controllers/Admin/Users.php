<?php 
namespace App\Controllers\Admin;
use App\Controllers\BaseController;
class Users extends BaseController {

	public function __construct() {   
        helper(['form', 'url']);
        $this->session = \Config\Services::session();
        return $this->check_login();
    } 
    public function check_login()
    {
      if (!$this->session->has('admin_id')) {
          header('Location: '.base_url('admin'));
      }
       
    }

  	public function user_management()
    {
        $data['data'] = $this->common_model->GetAllData('users','','id','desc');
        return view('admin/admin-userlist', $data);
    }

  	
  	

  	public function user_view($id)
    {
        $data['view'] = $this->common_model->GetSingleData('users',array('id'=>$id));
        return view('admin/admin-userview', $data);
    }
    
  	public function user_edit($id)
    {
        $data['edit'] = $this->common_model->GetSingleData('users',array('id'=>$id));
        return view('admin/admin-useredit', $data);
    }
    public function account_settings($id)
    {
        $data['edit'] = $this->common_model->GetSingleData('users',array('id'=>$id));
        return view('admin/account-settings', $data);
    }
    public function edit_seller_info($id)
    {
        $data['edit'] = $this->common_model->GetSingleData('users',array('id'=>$id));
        return view('admin/user-edit-seller-info' , $data);
    }
   public function edit_currency($id)
    {
        $data['edit'] = $this->common_model->GetSingleData('users',array('id'=>$id));
        return view('admin/user-edit-currency' , $data);
    }
   public function edit_shipping($id)
    {
        $data['edit'] = $this->common_model->GetSingleData('users',array('id'=>$id));
        return view('admin/user-edit-shipping' , $data);
    }
  	
    public function update_user()
    {
    	$this->validation->setRule('first_name','First Name','trim|required');
         $this->validation->setRule('last_name','Last Name','trim|required');
         //$this->validation->setRule('phone','Mobile','required|numeric|min_length[10]|max_length[12]');
         if($this->validation->withRequest($this->request)->run()==false)
        {
       
            $output['validation']=$this->validation->getErrors();
            $output['status']= 0 ;       
        }
        else
        {
        	$id = $_POST['id'];
			$update['first_name'] = $_POST['first_name'];
			$update['last_name'] = $_POST['last_name'];
			if(isset($_POST['currency']))
			$update['currency'] = $_POST['currency'];
			$run = $this->common_model->UpdateData('users',array('id' =>$id), $update);
			//$id = $run[0]->id;
	
			if($run)
			{
				
					$this->session->setFlashdata('msg', '<div class="alert alert-success">User Profile has been Updated successfully.</div>');
					$output['status']=1;
					$output['message']="User Profile has been Updated successfully.";
			}
	    }
		echo json_encode($output);
    }

    public function update_verify()
    {
    	$id = $_POST['id'];
    	
        $update['doc_verified'] = 1;        
	        
	    $run = $this->common_model->UpdateData('users',array('id' =>$id), $update);
	    $run1 = $this->common_model->GetSingleData('users',array('id' =>$id));
	    $email = $run1['email'];
	    if($run)
        {
            $subject="Document Verification Details!";    
        	$body = '<p>Hello '. $run1['first_name'].' '. $run1['last_name'].'</p>';
        	$body .= '<p>The following email is to inform you that your documents verification was successful.</p>';
            $send = $this->common_model->SendMail($email,$subject,$body);
            if($send)
            {
            	$output['status']=1;
            }   
                            

        }
		echo json_encode($output);	
				
    }

    public function update_reject()
    {
    	helper(['form']);
	    if ($this->request->getMethod() == "post") {
	        $validation =  \Config\Services::validation();

	        $rules = [
	            "reason" => [
	                "label" => "Reason", 
	                "rules" => "required|trim"
	            ]
	        ];
	        if ($this->validate($rules)) {
		    	$id = $_POST['id'];
		    	
		        $update['doc_verified'] = 3;        
		        $update['reason'] = $_POST['reason'];        
			        
			    $run = $this->common_model->UpdateData('users',array('id' =>$id), $update);
			    $run1 = $this->common_model->GetSingleData('users',array('id' =>$id));
			    $email = $run1['email'];
				if($run)
		        {
		            $subject="Document Verification Details!";    
		        	$body = '<p>Hello '. $run1['first_name'].' '. $run1['last_name'].'</p>';
		        	$body .= '<p>The following email is to inform you that your documents verification is not succeed please reupload them.</p>';
		        	$body .= '<p><strong>Reject Reason : </strong></p>';
		        	$body .= '<p>'.$run1['reason'].'</p>';
		            $send = $this->common_model->SendMail($email,$subject,$body); 
		            if($send)
		            {
		            	$output['status']=1;  
		            }  
		                          

		        }
		    } else {
	        	$output['status']= 0 ; 
	            $output["validation"] = $validation->getErrors();
	        }
	    }
		echo json_encode($output);
				
    }

    public function enableUser()
    {
      		$id = $_POST['id'];
          $checkuser = $this->common_model->GetSingleData('users',array('id'=>$id));
          if(!empty($checkuser)){
            if($checkuser['status']==1){
                $update['status']=0;
                $this->session->setFlashdata('msgs','<div class="alert alert-success">User has been disabled!!</div>');
            }else{
                $update['status']=1;
                $this->session->setFlashdata('msgs','<div class="alert "User has been enabled!!</div>');
            }   
            $run = $this->common_model->UpdateData('users',['id'=>$id], $update);
            if($run){
                $output['status']=1;
            }
          } else {
            $output['msgs']='<div class="alert alert-danger">Somthing wrong</div>';
            $output['status']=0;
        }

        echo json_encode($output);
    }


    public function deleteUser() {        
        
        $id = $_POST['id'];
        $run = $this->common_model->DeleteData('users', array('id'=> $id));
        if ($run) {
            $json['message'] = 'Success! User has been Deleted successfully';
            $json['status'] = 1;
        } else {
            $json['message'] = 'Error! Something went wrong';
            $json['status'] = 0;
        }
        echo json_encode($json);
    }
     public function do_update_shipping()
    {

         $this->validation->setRule('f_name','First Name','trim|required');
         $this->validation->setRule('l_name','Last Name','trim|required');
         $this->validation->setRule('country','Last Name','trim|required');
         $this->validation->setRule('address','Last Name','trim|required');
         $this->validation->setRule('address2','Last Name','trim|required');
         $this->validation->setRule('city','Last Name','trim|required');
         $this->validation->setRule('state','Last Name','trim|required');
         $this->validation->setRule('zipcode','Last Name','trim|required');
         //$this->validation->setRule('currency','Currency','trim|required');
         
        if($this->validation->withRequest($this->request)->run()==false)
        {
       
            $output['message']=$this->validation->getErrors();
            $output['status']= 0 ;       
        }
    
        else
        {

            $insert['first_name'] = $this->request->getVar('f_name');            
            $insert['user_id'] = $this->request->getVar('user_id');            
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
            $insert['user_id'] = $this->request->getVar('user_id');          
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

   
}