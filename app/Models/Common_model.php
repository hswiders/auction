<?php

namespace App\Models;

use CodeIgniter\Model;

class Common_model extends Model {

     public function __construct() {
        //parent::__construct();
        $this->db = \Config\Database::connect(); 
        $this->email = \Config\Services::email();     
    }


  public function GetAllData($table,$where=null,$ob=null,$obc='DESC',$limit=null,$offset=null,$select=null){
    //echo "hello2";
        try {
            $builder = $this->db->table($table);
            
            if($select) {
              $builder->select($select);
            }
            if($where) {
              $builder->where($where);
            }
            

            if($ob) {
              $builder->orderBy($ob,$obc);
            }
            if($limit) {
              $builder->limit($limit,$offset);
            }
            $query = $builder->get();
              //echo $this->db->getLastQuery();
            if ($query->getRow()) {
                // code...
                return $query->getResultArray();
            }
            
        } catch (\Exception $e) {
            return $e->getMessage();
            
        }
  }
  public function GetCountData($table,$where=null){
    //echo "hello2";
        try {
            $builder = $this->db->table($table);
            if($where) {
              $builder->where($where);
            }

           return $query = $builder->countAllResults();
              //echo $this->db->getLastQuery();
            
            
        } catch (\Exception $e) {
            return $e->getMessage();
            
        }
  }
  public function SendOrderConfirmed($data , $user , $product_detail , $act)
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
        $sub = "👍 Order Confirmed: ".$product_detail['title'];
        $this->email->setFrom(Email, Project);
       
        $this->email->setTo($toz);
        //$this->email->setMailtype("html"); 
        $this->email->setSubject($sub);
        $data["order"] = $data;
        $data['currency'] = $user['currency'];
        $msg = view('mail/order_confirmed' ,$data);
            
        $this->email->setMessage($msg);
        
        $run  = $this->email->send();
        if($run) {
            return 1;
          } else {
            return 0;
          } 
    }
    public function sendExpiredBid($order,$product_detail , $reason , $user)
    {
        
        $sub = "Bid Expired : ".$product_detail['title']." ";
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
        $data["order"] = $order;
        $data['currency'] = $user['currency'];
        $data["reason"] = $reason;
        $msg = view('mail/bid_expired' ,$data);
            
        $this->email->setMessage($msg);
        
        $run  = $this->email->send();
        if($run) {
            return 1;
          } else {
            return 0;
          }     
       
    }
    public function sendExpiredSell($order,$product_detail , $reason , $user)
    {
       
        $sub = "Ask Expired : ".$product_detail['title']." ";
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
        $data["sell_product"] = $order;
        $data['currency'] = $user['currency'];
        $data["reason"] = $reason;
        $msg = view('mail/ask_expired' ,$data);
            
        $this->email->setMessage($msg);
        
        $run  = $this->email->send();
        if($run) {
            return 1;
          } else {
            return 0;
          }     
       
    }
  function sendOrdertoSeller($data , $seller )
   {
        $user = $seller;
        
       //$this->sendSellerInstruction($data , $seller);
       $product_detail =  $this->GetSingleData('product',array('id'=> $data['product_id']));
        $toz = $user['email'];
        $sub = "✅You have sold items! ".$product_detail['title']." "; 
        
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
        $data["order"] = $data;
        $data['currency'] = $user['currency'];
        $msg = view('mail/sell_confirmed' ,$data);
            
        $this->email->setMessage($msg);
        
        $run  = $this->email->send();
        if($run) {
            return 1;
          } else {
            return 0;
          }
    
}
function sendSellerInstruction($data , $seller )
   {
        $user = $seller;
        
       
       $product_detail =  $this->GetSingleData('product',array('id'=> $data['product_id']));
        $toz = $user['email'];
        $sub = "CRM:".$data['order_uniqueid']." "; 
        
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
        $data["order"] = $data;
        $data['currency'] = $user['currency'];
        $data['user'] = $user;
        $msg = view('mail/sell_instruction' ,$data);
            
        $this->email->setMessage($msg);
        
        $run  = $this->email->send();
        if($run) {
            return 1;
          } else {
            return 0;
          }
    
}
  public function GetDataByOrderLimit($table,$where,$odf=NULL,$odc=NULL,$limit=NULL,$start=0) {

                    $builder = $this->db->table($table);
                    if($where) {
                      $builder->where($where);
                    }        

                    if($odf && $odc){
                      $builder->orderBy($odf,$odc);
                    }
                       
                    if($limit){
                      $builder->limit($limit, $start);
                    }

                    //$sql=$builder->get($table);
                    $query = $builder->get();
                    if ($query->getRow()) {
                        // code...
                       return $query->getResultArray();
                    }
    }

    public function GetDataById($table,$value) {
        //echo $table. $value;
         try {                
                $builder = $this->db->table($table);
                $builder->where('id', $value);
                $query = $builder->get();
                if ($query->getRow()) {
                    // code...
                   return $query->getRowArray();
                } else {
                    return array();
                }
            } catch (\Exception $e) {
                    echo $e->getMessage();
            
        }

  }

  public function InsertData($table,$data) {
    //echo $table; print_r($data); /*
    $builder = $this->db->table($table);
     if($builder->insert($data)){
      return $this->db->insertID();
    } else {
      return false;
    }
  }


  public function GetSingleData($table,$where=null,$ob=null,$obc='desc' , $select=null){
    $builder = $this->db->table($table);
    if($select) {
      $builder->select($select);
    }
    if($where) {
      $builder->where($where);
    }
    if($ob) {
      $builder->orderBy($ob,$obc);
    }
    $query = $builder->get();
        if ($query->getRow()) {
                        // code...
           return $query->getRowArray();
        } else {
            return array();
        }
  }

  public function UpdateData($table, $where, $data) {

    $builder = $this->db->table($table);
    $builder->where($where);
    $builder->update($data);
   // echo $builder->last_query();die;
    return ($this->db->affectedRows() > 0)?true:true;
  }
  
  public function DeleteData($table, $where) {
    $builder = $this->db->table($table);
    $builder->where($where);
    $builder->delete();
    
    return ($this->db->affectedRows() > 0)?true:false;     
  }

  public function GetColumnName($table,$where=null,$name=null,$double=null,$order_by=null,$order_col=null,$group_by=null) {     
    $builder = $this->db->table($table);
    if($name){
      $builder->select(implode(',',$name));
    } else {
      $builder->select('*');
    }
    
    if($where){
      $builder->where($where);
    }
        
    if($group_by) {
      $builder->groupBy($group_by);
    }
    
    if($order_by && $order_col){
      $builder->orderBy($order_by,$order_col);
    }
    
    $query = $builder->get();
    if($double){
      $data = array();
    } else {
      $data = false;
    }

    if($query->getRow()){
      if($double){
        $data = $query->getResult();
      } else {
        $data = $query->getRow();
      } 
      
    }
    return $data;
  }
   public function SendMail($toz,$sub,$body) {

    //  $to =$toz;  
    //  $from ='';
    // $headers ="From: ".$admin[0]['mail_from_title']." <".$from."> \n";
    // $headers .= "MIME-Version: 1.0\n";
    // $headers .= "Content-type: text/html; charset=iso-8859-1 \n";
    // $subject =$sub;

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
    
    $msg = view('mail/common' ,['subject' =>$sub ,'body' =>$body ]);
        
    $this->email->setMessage($msg);
    
    $run  = $this->email->send();
    
    if($run) {
      return 1;
    } else {
      return 0;
    }

  }
}