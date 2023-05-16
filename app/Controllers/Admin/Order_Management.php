<?php 
namespace App\Controllers\Admin;
use App\Controllers\BaseController;
class Order_Management extends BaseController {

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

  	public function order_list()
    {
        $data['order_list'] = $this->common_model->GetAllData('orders','','id','desc');
        return view('admin/admin-orderlist', $data);
    }
   

   /* public function BuyOrder() {
        $data["active_order"] = $this->common_model->GetAllData("orders", array("seller_id"=>0,'status'=>3),"id","desc");
        $data["progress_order"] = $this->common_model->GetAllData("orders", array("seller_id!="=>0,'status'=>0),"id","desc");
        $data["complete_order"] = $this->common_model->GetAllData("orders", array("seller_id!="=>0,'status'=>1),"id","desc");
        $data["expire_order"] = $this->common_model->GetAllData("orders", array('status'=>4),"id","desc");
        return view("buy-order", $data);
    }*/

    public function active_bid_product_list()
    {
        $data['bid_product_list'] = $this->common_model->GetAllData("orders", array("seller_id"=>0,'status'=>3),"id","desc");
       return view('admin/active-bid-list',$data);
    }

    public function complete_bid_product_list()
    {
        $data['bid_product_list'] = $this->common_model->GetAllData("orders", array("seller_id!="=>0,'status'=>1),"id","desc");
       return view('admin/complete-bid-list',$data);
    }

    public function expired_bid_product_list()
    {
        $data['bid_product_list'] = $this->common_model->GetAllData("orders", array('status'=>4),"id","desc");
       return view('admin/expired-bid-list',$data);
    }
//exchange Order

  public function pending_order_list()
    {
        $data['export'] = true;
        $data['pending_order_list'] = $this->common_model->GetAllData("exchange_order", array("status"=>0),"id","desc");
       return view('admin/pending_order_list',$data);
    }
    public function complete_order_list()
    {
        $data['export'] = true;
        $data['complete_order_list'] = $this->common_model->GetAllData("exchange_order", array("status"=>3),"id","desc");
       return view('admin/complete_order_list',$data);
    }
    public function approve_order_list()
    {
        $data['export'] = true;
        $data['approve_order_list'] = $this->common_model->GetAllData("exchange_order", array("status"=>1),"id","desc");
       return view('admin/approve_order_list',$data);
    }
    public function reject_order_list()
    {
        $data['export'] = true;
        $data['reject_order_list'] = $this->common_model->GetAllData("exchange_order", array("status"=>2),"id","desc");
       return view('admin/reject_order_list',$data);
    }

    public function accept_product() {        
        
        $id = $_POST['id'];
        $user_id = $_POST['user_id'];
        $update['status'] =$_POST['status'];

        $exchage_order = $this->common_model->GetSingleData('exchange_order', array('id'=> $id));
        $productData = $this->common_model->GetSingleData('product', array('id'=> $exchage_order['product_id']));
        if ($update['status'] != 3) 
        {
            
            $action = 'Approved';
            $update['approval_date'] = date('Y-m-d H:i:s');
        }
        else
        {
            $admin = get_admin();
            $capture_data = capture_payment($exchage_order['payment_id'] ,$exchage_order['grand_total']  );
            $update['payment_id'] =  $capture_data['payment_id'];
             /*Update admin Wallet--------*/
            $admin_total = $exchage_order['grand_total'];
            $purpose = "Recieved payment from Exchange order of ".$productData['title'];
            $this->common_model->UpdateData('admin',array('id'=> 1), array('wallet'=> $admin_total + $admin['wallet']));

            $this->common_model->InsertData('wallet_transactions', array('amount'=> $admin_total  , 't_type'=> 1 , 'purpose'=> $purpose ,'user_id'=> 0 ,'created_at'=> date('Y-m-d H:i:s'))); 
            $this->common_model->InsertData('exchange_list', array('product_id'=> $productData['id'] , 'user_id'=> $user_id) );
            $update['completed_date'] = date('Y-m-d H:i:s');
             
            $action = 'Delivered';
        }
         
        
         $Exproduct = $this->common_model->GetAllData('product', 'id IN('.$exchage_order['exchnage_product_id'].')'); 
         
        $run1 = $this->common_model->GetSingleData('users', array('id'=> $user_id));
        $email = $run1['email'];
        $run = $this->common_model->UpdateData('exchange_order', array('id'=> $id),$update);
        if ($run) {
        	 
            $subject="Exchange ".$action." For ".$productData['title'];    
        	$body = '<p>Hello '. $run1['first_name'].' '. $run1['last_name'].'</p>';
        	$body .= '<p>We are glad to  inform you that your request to exchange your <b>'.$productData['title'].' ('.gradeName($productData['class_type'] , true).')</b> with ';
             foreach ($Exproduct as $key => $Exvalue) 
            {
                $ExproductClass = $this->common_model->GetSingleData('class_type', array('id'=> $Exvalue['class_type']));
                if ($update['status'] == 3) 
                {

                    $this->common_model->UpdateData('product', array('id'=> $Exvalue['id']) , array('stock' => $Exvalue['stock']+1)); 
                    $this->common_model->DeleteData('exchange_list', array('product_id'=> $Exvalue['id'] , 'user_id'=> $user_id) ); 
                    
                }

               $body .= '<b>'.$Exvalue['title'].' ('.gradeName($Exvalue['class_type'] , true).')</b> , ';
            }
            
            $body .= '</p><p>has been '.$action.' by our team </p>';
        	$body .= '<p>Thank you for exchanging with <b>Game Xchange</b></p>';
        	$body .= '<p><b>Exchange details</b> :</p>';
        	$body .= '<p><b>Step Charge</b> : HKD'.$exchage_order['price'].' </p>';
        	$body .= '<p><b>Service fee</b> : HKD'.$exchage_order['service_fee'].' </p>';
            $body .= '<p><b>Shipping fee</b> : HKD'.$exchage_order['shipping_fee'].' </p>';
        	$body .= '<p><b>Total value</b> : HKD'.$exchage_order['grand_total'].' </p>';
						
            $send = $this->common_model->SendMail($email,$subject,$body);

        	$this->session->setFlashdata('msg', '<div class="alert alert-success">Product has been accepted successfully.</div>');
            $json['message'] = 'Product has been accepted successfully.';
            $json['status'] = 1;
        } else {
            $json['message'] = 'Error! Something went wrong';
            $json['status'] = 0;
        }
        echo json_encode($json);
    }


     public function reject_product() {        
        $this->validation->setRule('reason','Reason','trim|required');

        if($this->validation->withRequest($this->request)->run()==false)
        {
       
            $output['message']= $this->validation->getErrors();
            $output['status']= 0 ; 
             echo json_encode($output);
             exit();      
        }
        $id = $_POST['id'];
        //$email = $_POST['email'];
        $user_id = $_POST['user_id'];
        $update['status'] = 2;
        $update['reject_reason'] = $_POST['reason'];
        $update['reject_date'] = date('Y-m-d H:i:s');

        $exchage_order = $this->common_model->GetSingleData('exchange_order', array('id'=> $id));
        $productData = $this->common_model->GetSingleData('product', array('id'=> $exchage_order['product_id'])); 
        $this->common_model->UpdateData('product', array('id'=> $productData['id']) , array('stock' => $productData['stock']+1)); 
        
        $Exproduct = $this->common_model->GetAllData('product', 'id IN('.$exchage_order['exchnage_product_id'].')'); 

        $run1 = $this->common_model->GetSingleData('users', array('id'=> $user_id));
        $email = $run1['email'];
        $run = $this->common_model->UpdateData('exchange_order', array('id'=> $id),$update);
        if ($run) {
            $extra = '';
        	  if($_POST['status'] == 4)
              {
                $admin = get_admin();
                $extra = '<p>In case the product is rejected after it is received by us, we will have to charge a shipping charge and service fee for the return.</p>';
                $capture_data = capture_payment($exchage_order['payment_id'] ,$exchage_order['service_fee'] + $exchage_order['shipping_fee']  );
                $update['payment_id'] =  $capture_data['payment_id'];
                $run = $this->common_model->UpdateData('exchange_order', array('id'=> $id),$update);
                /*Update admin Wallet--------*/
                $admin_total = $exchage_order['service_fee'] + $exchage_order['shipping_fee'];
                $purpose = "Recieved Service fee and shipping fee on reject from Exchange order of ".$productData['title'];
                $this->common_model->UpdateData('admin',array('id'=> 1), array('wallet'=> $admin_total + $admin['wallet']));

                $this->common_model->InsertData('wallet_transactions', array('amount'=> $admin_total  , 't_type'=> 1 , 'purpose'=> $purpose ,'user_id'=> 0 ,'created_at'=> date('Y-m-d H:i:s'))); 
              }
            $subject="Exchange Rejected For ".$productData['title'];    
        	$body = '<p>Hello '. $run1['first_name'].' '. $run1['last_name'].'</p>';
        	$body .= '<p>We regret to  inform you that your request to exchange your <b>'.$productData['title'].' ('.gradeName($productData['class_type'] , true).')</b> with ';
            foreach ($Exproduct as $key => $Exvalue) 
            {
                
               $body .= '<b>'.$Exvalue['title'].' ('.gradeName($Exvalue['class_type'] , true).')</b> , ';
            }
            
        	$body .= '</p><p>has been rejected by our team due to "'.$update['reject_reason'].'" and we have refunded your payment accordingly.</p>';
        	$body .= $extra;
            $body .= '<p>Thank you for exchanging with <b>Game Xchange</b></p>';
        	$body .= '<p><b>Exchange details</b> :</p>';
        	$body .= '<p><b>Step Charge</b> : HKD'.$exchage_order['price'].' </p>';
        	$body .= '<p><b>Service fee</b> : HKD'.$exchage_order['service_fee'].' </p>';
            $body .= '<p><b>Shipping fee</b> : HKD'.$exchage_order['shipping_fee'].' </p>';
        	$body .= '<p><b>Total value</b> : HKD'.$exchage_order['grand_total'].' </p>';
            $send = $this->common_model->SendMail($email,$subject,$body);

        	$this->session->setFlashdata('msg', '<div class="alert alert-success">Product has been rejected successfully.</div>');
            $json['message'] = 'Product has been rejected successfully.';
            $json['status'] = 1;
        } else {
            $json['message'] = 'Error! Something went wrong';
            $json['status'] = 0;
        }
        echo json_encode($json);
    }

  	/*public function addProductGroup()
    {
        helper(['form']);
	    if ($this->request->getMethod() == "post") {
	        $validation =  \Config\Services::validation();

	        $rules = [
	            "title" => [
	                "label" => "Title", 
	                "rules" => "required|trim"
	            ],
	            
	        ];

	        if ($this->validate($rules)) {
				$insert['title'] = $_POST['title'];
				$insert['created_at'] = date('Y-m-d');
				
				$run = $this->common_model->InsertData('product_group', $insert);
				//$id = $run[0]->id;
		
				if($run)
				{
					
						$this->session->setFlashdata('msg', '<div class="alert alert-success">ProductGroup has been Added successfully.</div>');
						$output['status']=1;
						$output['message']="ProductGroup has been Added successfully.";
				}
			} else {
	        	$output['status']= 0 ; 
	            $output["validation"] = $validation->getErrors();
	        }
	    }
		echo json_encode($output);
    }

  	public function editProductGroup()
    {
        helper(['form']);
	    if ($this->request->getMethod() == "post") {
	        $validation =  \Config\Services::validation();

	        $rules = [
	            "title" => [
	                "label" => "Title", 
	                "rules" => "required|trim"
	            ],
	            
	        ];

	        if ($this->validate($rules)) {
				
				$id = $_POST['id'];
				$update['title'] = $_POST['title'];
				
				$run = $this->common_model->UpdateData('product_group',array('id'=>$id), $update);
				//$id = $run[0]->id;
		
				if($run)
				{
					
						$this->session->setFlashdata('msg', '<div class="alert alert-success">ProductGroup has been Updated successfully.</div>');
						$output['status']=1;
						$output['message']="ProductGroup has been Updated successfully.";
				}
			} else {
	        	$output['status']= 0 ; 
	            $output["validation"] = $validation->getErrors();
	        }
	    }
		echo json_encode($output);
    }

    
    public function deleteProductGroup() {        
        
        $id = $_POST['id'];
        $run = $this->common_model->DeleteData('product_group', array('id'=> $id));
        if ($run) {
            $json['message'] = 'Success! ProductGroup has been Deleted successfully';
            $json['status'] = 1;
        } else {
            $json['message'] = 'Error! Something went wrong';
            $json['status'] = 0;
        }
        echo json_encode($json);
    }*/




   
}