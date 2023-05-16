<?php 

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Sell_Product extends BaseController {

	public function __construct() {   
        helper(['form', 'url']);
        $this->session = \Config\Services::session();
        return $this->check_login();
        //$this->load->library("upload",$config);
    } 

    public function check_login()
    {
      if (!$this->session->has('admin_id')) {
          header('Location: '.base_url('admin'));
      }
       
    }

   public function active_sell_product_list()
    {
        $data['product_list'] = $this->common_model->GetAllData('sell_product',array('sold_status'=>0),'id','desc');
        $data['status'] = 'active';
       return view('admin/sell-product-list',$data);
    }
    public function complete_sell_product_list()
    {
        $data['status'] = 'complete';
        $data['product_list'] = $this->common_model->GetAllData('sell_product',array('sold_status'=>2),'id','desc');
       return view('admin/sell-product-list',$data);
    }
    public function expired_sell_product_list()
    {
        $data['status'] = 'expire';
        $data['product_list'] = $this->common_model->GetAllData('sell_product',array('sold_status'=>3),'id','desc');
       return view('admin/sell-product-list',$data);
    }

    public function viewsellproduct()
    {
        //echo "hello";
       $id = $_GET['id'];
       $data['sell_product'] = $this->common_model->GetSingleData('sell_product',array('id'=>$id));
       return view('admin/view-sell-product',$data);
    }
    public function editproductform()
    {
        
       $id = $_GET['id'];
       $data['sell_product'] = $this->common_model->GetSingleData('sell_product',array('id'=>$id));
       return view('admin/edit-sell-product',$data);
    }

    public function update_sellproduct()
{
    $this->validation->setRule('price','Price','trim|required');
    $this->validation->setRule('dis_price','Discount Price','trim|required');
    $this->validation->setRule('exp_date','Expiry Date','trim|required');
    $this->validation->setRule('game_condition','game_condition','trim|required');

    if($this->validation->withRequest($this->request)->run()==false)
    {
   
        $output['message']=$this->validation->getErrors();
        $output['status']= 0 ;       
    }

    else
    {
       // echo "hello";die;
        $id = $this->request->getVar('id');
        $update['price']= $this->request->getVar('price');
        $update['dis_price']= $this->request->getVar('dis_price');
        $update['exp_date']= $this->request->getVar('exp_date');
        $update['game_condition']= $this->request->getVar('game_condition');
        
        $run = $this->common_model->UpdateData('sell_product',array('id'=>$id),$update);

       if($run)
        {  
         
            $this->session->setFlashdata('msg', '<div class="alert alert-success">Sell Product has been Updated successfully</div>');
            $output['message']='Sell Product has been Updated successfully' ;
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

public function delete_sellproduct()
    {
        //echo "hello";
            $id = $this->request->getVar('id');  
            $sell_product = $this->common_model->GetSingleData('sell_product',array('id'=> $id ));
            $run = $this->common_model->DeleteData('sell_product',array('id'=>$id));
            if($run)
            {  
                $output['message']='Product has been Deleted successfully' ;
                $output['status']= 1 ;  
                $product_detail = $this->common_model->GetSingleData('product',array('id'=> $sell_product['product_id']));
                $reason = isset($_POST['reason']) ? $_POST['reason'] : '';
                $this->sendCancelAsk($sell_product,$product_detail , $reason);
                $this->session->setFlashdata('msg', '<div class="alert alert-success">Sell Product has been Deleted successfully</div>');
                                            

            }
            else             {
            
                $output['message']='<div class="alert alert-danger">Something went wrong</div>' ;
                $output['status']= 0 ; 
            
            }
         
         echo json_encode($output);
     }
     private function sendCancelAsk($sell_product,$product_detail , $reason)
    {
        $user = $this->common_model->GetSingleData('users',array('id'=> $sell_product['user_id'] ));
        $sub = "Ask Canceled: ".$product_detail['title']."  ";
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
        $data["reason"] = $reason;
        $data["sell_product"] = $sell_product;
        $data['currency'] = $user['currency'];
        $msg = view('mail/ask_canceled' ,$data);
            
        $this->email->setMessage($msg);
        
        $run  = $this->email->send();
        if($run) {
            return 1;
          } else {
            return 0;
          }   
       
    }

 }