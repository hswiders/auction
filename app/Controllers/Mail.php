<?php

namespace App\Controllers;
use App\Models\Common_model;
class Mail extends BaseController
{

    public function order_delivered()
    {
        // $id = $_GET['id'];
        //echo "hello"; die;
        $data['social_list'] = $this->common_model->GetAllData('social_links','','id','desc');
        $data["order"] = $this->common_model->GetSingleData("orders");
        $data["faq_list"] = $this->common_model->GetAllData('faqs','','id','desc',3);
        
        return view('mail/order_delivered',$data);
    }

    public function order_shipped()
    {
        $data['social_list'] = $this->common_model->GetAllData('social_links','','id','desc');

        $data["order"] = $this->common_model->GetSingleData("orders");
        $data["faq_list"] = $this->common_model->GetAllData('faqs','','id','desc',3);
        
        return view('mail/order_shipped',$data);
    }

    public function lowest_ask()
    {
        $data["sell_product"] = $this->common_model->GetSingleData("sell_product");
        
        return view('mail/lowest_ask',$data);
    }

    public function order_confirmed($order)
    {
        $config = array();
        $config['mailType'] = "html";
        $config['charset'] = "utf-8";
        $config['newline'] = "\r\n";
        $config['CRLF'] = "\r\n";
        $config['wordwrap'] = TRUE;
        $config['validate'] = FALSE;
    
        $this->email->initialize($config);
        $toz = $user['email'];
        $sub = "👍 Order Confirmed: ".$product_details['title'];
        $this->email->setFrom(Email, Project);
       
        $this->email->setTo($toz);
        //$this->email->setMailtype("html"); 
        $this->email->setSubject($sub);
        $data["order"] = $data;
        $msg = view('mail/order_confirmed' ,$data);
            
        $this->email->setMessage($msg);
        
        $run  = $this->email->send();
        if($run) {
            return 1;
          } else {
            return 0;
          } 
    }

    public function ask_canceled()
    {
        $config = array();
        $config['mailType'] = "html";
        $config['charset'] = "utf-8";
        $config['newline'] = "\r\n";
        $config['CRLF'] = "\r\n";
        $config['wordwrap'] = TRUE;
        $config['validate'] = FALSE;
    
        $this->email->initialize($config);
        $sub = "Your Ask Has Been Removed!";
        $this->email->setFrom(Email, Project);
       
        $this->email->setTo($toz);
        //$this->email->setMailtype("html"); 
        $this->email->setSubject($sub);
        $data["sell_product"] = $this->common_model->GetSingleData("sell_product");
        $msg = view('mail/ask_canceled' ,$data);
            
        $this->email->setMessage($msg);
        
        $run  = $this->email->send();
        if($run) {
            return 1;
          } else {
            return 0;
          } 
    }

    public function bid_canceled()
    {       
        $config = array();
        $config['mailType'] = "html";
        $config['charset'] = "utf-8";
        $config['newline'] = "\r\n";
        $config['CRLF'] = "\r\n";
        $config['wordwrap'] = TRUE;
        $config['validate'] = FALSE;
    
        $this->email->initialize($config);
        $sub = "Your Bid Is Canceled!";
        $this->email->setFrom(Email, Project);
       
        $this->email->setTo($toz);
        //$this->email->setMailtype("html"); 
        $this->email->setSubject($sub);
        $data["order"] = $this->common_model->GetSingleData("orders");
        $msg = view('mail/bid_canceled' ,$data);
            
        $this->email->setMessage($msg);
        
        $run  = $this->email->send();
        if($run) {
            return 1;
          } else {
            return 0;
          }  
    }

    public function bid_live()
    {
        $config = array();
        $config['mailType'] = "html";
        $config['charset'] = "utf-8";
        $config['newline'] = "\r\n";
        $config['CRLF'] = "\r\n";
        $config['wordwrap'] = TRUE;
        $config['validate'] = FALSE;
    
        $this->email->initialize($config);
        $sub = "Your Bid Is Live!";
        $this->email->setFrom(Email, Project);
       
        $this->email->setTo($toz);
        //$this->email->setMailtype("html"); 
        $this->email->setSubject($sub);
        $data["order"] = $this->common_model->GetSingleData("orders");
        $msg = view('mail/bid_live' ,$data);
            
        $this->email->setMessage($msg);
        
        $run  = $this->email->send();
        if($run) {
            return 1;
          } else {
            return 0;
          }     
    }


 }
