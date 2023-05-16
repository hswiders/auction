<?php

namespace App\Controllers;
use App\Models\Common_model;
class Order extends BaseController
{
    public function __construct() {   
        helper(['form', 'url']);
        $this->session = \Config\Services::session();
        $this->common_model = new Common_model();
        $this->user_id =  $this->session->get('user_id');
        $this->user = $this->common_model->GetSingleData('users', array('id' => $this->user_id));
        return $this->check_login();
    } 
    
    public function check_login() {
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

    public function myOrder() {
        $data["order"] = $this->common_model->GetAllData("orders", array("seller_id"=>$this->user_id),"id","desc");
        return view("my-order", $data);
    }

   public function BuyOrder() {
        $data["active_order"] = $this->common_model->GetAllData("orders", array("user_id"=>$this->user_id,'status'=>3),"id","desc");
        $data["progress_order"] = $this->common_model->GetAllData("orders", array("user_id"=>$this->user_id,'status'=>0),"id","desc");
        $data["complete_order"] = $this->common_model->GetAllData("orders", array("user_id"=>$this->user_id,'status'=>1),"id","desc");
        $data["expire_order"] = $this->common_model->GetAllData("orders", array('user_id'=>$this->user_id,'status'=>4),"id","desc");
        return view("buy-order", $data);
    }
    //exchange Order

  public function exchange_order_list()
    {
        $data['pending_order_list'] = $this->common_model->GetAllData("exchange_order", array("user_id"=>$this->user_id,"status"=>0),"id","desc");
        $data['approve_order_list'] = $this->common_model->GetAllData("exchange_order", array("user_id"=>$this->user_id,"status"=>1),"id","desc");
        $data['complete_order_list'] = $this->common_model->GetAllData("exchange_order", array("user_id"=>$this->user_id,"status"=>3),"id","desc");
        $data['reject_order_list'] = $this->common_model->GetAllData("exchange_order", array("user_id"=>$this->user_id,"status"=>2),"id","desc");
        return view("exchange_order_list", $data);
    }
   /* public function approve_order_list()
    {
        $data['approve_order_list'] = $this->common_model->GetAllData("exchange_order", array("status"=>1),"id","desc");
        return view("exchange_order_list", $data);
    }
    public function reject_order_list()
    {
        $data['reject_order_list'] = $this->common_model->GetAllData("exchange_order", array("status"=>2),"id","desc");
        return view("exchange_order_list", $data);
    }*/

 }
