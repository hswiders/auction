<?php

namespace App\Controllers;
use App\Models\Common_model;
use Dotenv\Dotenv;
class Wallet extends BaseController
{
    public function __construct() {   
        helper(['form', 'url']);
        $this->session = \Config\Services::session();
        $this->common_model = new Common_model();
        $this->user_id =  $this->session->get('user_id');
        $this->user = $this->common_model->GetSingleData('users', array('id' => $this->user_id));
        $this->currency = $this->user['currency'];
        $dotenv = Dotenv::createImmutable(ROOTPATH);
        $dotenv->load();
        if (!$this->user) {
            $this->session->remove('user_id');
            header('Location: '.base_url('login'));
            exit;
        }
        return $this->check_login();
    } 
    
    public function check_login()
    {
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
    public function myWallet()
    {
      
      $data['is_already_requested'] = $this->common_model->GetSingleData('wallet_transactions', array('user_id' => $this->user_id , 'status' => 0));
      $data['data'] = $this->common_model->GetAllData('wallet_transactions' , ['user_id' => $this->user_id] , 'id' , 'desc');
      $data['payouts'] =  $this->common_model->GetAllData('hw_users' , ['user_id' =>$this->user_id]);
        return view('my-wallet' ,$data);
    }
    public function payout_info()
    {

        $data['data'] =  $this->common_model->GetAllData('hw_users' , ['user_id' =>$this->user_id]);
        $data['is_paypal_added'] =  $this->common_model->GetAllData('hw_users' , ['user_id' =>$this->user_id , 'payout_type' =>'paypal']);
        $data['is_bank_added'] =  $this->common_model->GetAllData('hw_users' , ['user_id' =>$this->user_id , 'payout_type' =>'bank']);
        
        return view('edit-payout-info' ,$data);
    }
    public function withdraw_amount() 
    {
     
        $min = convert_currency(get_admin()['minimum_withdraw'] , $this->currency , 'HKD')-1;
        $request = service('request');
        $this->validation->setRules([
        
          'payout_id' => 'trim|required',
          'amount' => "numeric|required|greater_than[$min]",
      ]);
      
      if (!$this->validation->run($request->getPost()))
      {
          $output['message'] = $this->validation->getErrors();
          $output['status'] = 0;
      }
        else
        {
          //die;
        	$insert['amount'] = convert_currency($_POST['amount'] , 'HKD' , $this->currency);
        	$insert['payout_id'] = $_POST['payout_id'];
        	
          $insert['t_type'] = 2;
          $insert['user_id'] = $this->user_id;
          $insert['purpose'] = 'Withdrawal Request';
          $insert['status'] = 0;
          $insert['created_at'] = date('Y-m-d H:i:s');
			if ($this->user['wallet'] > $insert['amount']) 
			{
        $update1['wallet'] =$this->user['wallet']-$insert['amount'];
            $this->common_model->UpdateData('users',['id'=>$this->user_id], $update1);
          $this->common_model->InsertData('wallet_transactions', $insert);
          
          $output['message']='Withdrawal request has been sent to admin successfully';
          $output['status']= 1 ;
			}
			else
			{
          $output['message']=['amount' => 'Not enough amount in your wallet'];
          $output['status']= 0 ;
			}
        	
        }
        echo json_encode($output);
    }
    public function createPayoutMethod()
    {
      $virtual_ac_programtoken = $_ENV['hyper_program_token'];
      $transferMethod = explode("|", $_POST["transferMethod"]);
      $data = [
          "addressLine1" => $_POST["addressLine1"],
          "city" => $_POST["city"],
          "clientUserId" => generateRandomString(),
          "country" => $_POST["country"],
          "dateOfBirth" => $_POST["dateOfBirth"],
          "email" => $_POST["email"],
          "firstName" => $_POST["firstName"],
          "lastName" => $_POST["lastName"],
          "postalCode" => $_POST["postalCode"],
          "profileType" => $_POST["profileType"],
          "programToken" => $virtual_ac_programtoken,
          "stateProvince" => $_POST["stateProvince"]
      ];
      if ($_POST["profileType"] == "BUSINESS") {
          $data["businessName"] = $_POST["businessName"];
      }
      $data['api_url'] = "users";
    
      $res = runCurl($data );
      if ($res['httpcode'] !== 201)
      {
        //print_r($res['response']->errors);
        $output['status'] = 0;
        $fieldName = 'message';
        if(isset($res['response']->errors[0]->fieldName))
        {
          $fieldName = $res['response']->errors[0]->fieldName;
          
        }
        $phrase = "The value you provided for this field is already registered with another user";

        if (strpos($res['response']->errors[0]->message, $phrase) !== false) {
            $token = substr($res['response']->errors[0]->message, strlen($phrase));
            $token = str_replace(' ', '', $token);
            $data['api_url'] = "users/".$token;
           
            $res = runCurl($data , "GET");
           
            // $res['response']->token = $token; 
        }
        else{
          $output['message'] = [$fieldName => $res['response']->errors[0]->message];
          $output['data'] = $res;
          return json_encode($output);
        }
        
      }
      
      
      if($_POST['payout_type'] == 'paypal')
      {
        $data['api_url'] = "users/" . $res['response']->token . "/paypal-accounts";
        $data['type'] = "PAYPAL_ACCOUNT";
        $data['accountId'] = $_POST['accountId']; 
        
        $data['transferMethodCountry'] = 'US'; 
        $data['transferMethodCurrency'] = 'USD'; 
      }
      else 
      {
        $data['api_url'] = "users/" . $res['response']->token . "/bank-accounts";
        $data['branchId'] = $_POST['branchId']; 
        $data['bankAccountId'] = $_POST['bankAccountId']; 
        $data['bankId'] = $_POST['bankId']; 
        $data['bankAccountPurpose'] = 'SAVING'; 
        $data['type'] = "BANK_ACCOUNT";
        $data['bankAccountRelationship'] = 'SELF'; 
        $data['transferMethodCountry'] = $transferMethod[0]; 
        $data['transferMethodCurrency'] =  $transferMethod[1]; 
      }
      
      $res1 = runCurl($data);

      if ($res1['httpcode'] === 201) {
        $ins['user_id'] = $this->user_id;
        $ins['user_token'] = $res['response']->token;
        $ins['status'] = $res['response']->status;
        $ins['clientUserId'] = $res['response']->clientUserId;
        $ins['addressLine1'] = $res['response']->addressLine1;
        $ins['city'] = $res['response']->city;
        $ins['country'] = $res['response']->country;
        $ins['dateOfBirth'] = $_POST["dateOfBirth"];
        $ins['email'] = $res['response']->email;
        $ins['firstName'] = ($res['response']->firstName == "" ? $res['response']->businessName : $res['response']->firstName);
        $ins['lastName'] = $_POST["lastName"];
        $ins['postalCode'] = $res['response']->postalCode;
        $ins['profileType'] = $res['response']->profileType;
        $ins['stateProvince'] = $res['response']->stateProvince;
        $ins['payout_type'] = $_POST["payout_type"];
        $ins['full_user_response'] = json_encode($res['response']); 
        if($ins['payout_type'] == 'bank')
        {
          $ins['bankAccountPurpose'] = 'SAVING';
          $ins['full_bank_response'] = json_encode($res1['response']); 
          $ins['branchId'] = $_POST["branchId"];
          $ins['bankId'] = $_POST["bankId"];
          $ins['bankAccountId'] = $_POST['bankAccountId'];
          $ins['bank_token'] = $res1['response']->token;
        }
        else
        {
          $ins['full_paypal_response'] = json_encode($res1['response']); 
          $ins['accountId'] = $_POST["accountId"];
          $ins['paypal_token'] = $res1['response']->token; 
          
        }
        
        $ins['transferMethodCountry'] = $transferMethod[0];
        $ins['transferMethodCurrency'] = $transferMethod[1];
        $ins['created_at'] = date('Y-m-d H:i:s');
        $ins['updated_at'] = date('Y-m-d H:i:s');
              
        $run = $this->common_model->InsertData('hw_users' , $ins);
        $output['data'] = $res;
        $output['data1'] = $res1;
        $output['status'] = 1;
        $output['message'] = "New record inserted successfully";
        return json_encode($output);
      } else {
        // print_r($data);
        // print_r($res1);
       
        $output['status'] = 0;
        $fieldName = 'message';
        if(isset($res1['response']->errors[0]->fieldName))
        {
          $fieldName = $res1['response']->errors[0]->fieldName;
        }
        $output['message'] = [$fieldName => $res1['response']->errors[0]->message];
        $output['data'] = $res;
        $output['data1'] = $data;
        return json_encode($output);

      }
  }
    public function updatePayoutMethod()
    {
      $virtual_ac_programtoken = $_ENV['hyper_program_token'];
      $transferMethod = explode("|", $_POST["transferMethod"]);
      $payoutMethod = $this->common_model->GetSingleData('hw_users' ,['id' => $_POST['id']]);
      $data = [
          "addressLine1" => $_POST["addressLine1"],
          "city" => $_POST["city"],
          "clientUserId" => $payoutMethod['clientUserId'],
          "country" => $_POST["country"],
          "dateOfBirth" => $_POST["dateOfBirth"],
          "firstName" => $_POST["firstName"],
          "lastName" => $_POST["lastName"],
          "postalCode" => $_POST["postalCode"],
          "profileType" => $_POST["profileType"],
          "programToken" => $virtual_ac_programtoken,
          "stateProvince" => $_POST["stateProvince"]
      ];
      if ($_POST["profileType"] == "BUSINESS") {
          $data["businessName"] = $_POST["businessName"];
      }
      $data['api_url'] = "users/".$payoutMethod['user_token'];
    
      $res = runCurl($data , "PUT");
      if ($res['httpcode'] !== 200)
      {
        //print_r($res['response']->errors);
        $output['status'] = 0;
        $fieldName = 'message';
        if(isset($res['response']->errors[0]->fieldName))
        {
          $fieldName = $res['response']->errors[0]->fieldName;
          
        }
        $phrase = "The value you provided for this field is already registered with another user";

        if (strpos($res['response']->errors[0]->message, $phrase) !== false) {
            $token = substr($res['response']->errors[0]->message, strlen($phrase));
            $token = str_replace(' ', '', $token);
            $data['api_url'] = "users/".$token;
           
            $res = runCurl($data , "GET");
           
            // $res['response']->token = $token; 
        }
        else{
          $output['message'] = [$fieldName => $res['response']->errors[0]->message];
          $output['data'] = $res;
          return json_encode($output);
        }
        
      }
      
      
      if($_POST['payout_type'] == 'paypal')
      {
        $data['api_url'] = "users/" . $res['response']->token . "/paypal-accounts/".$payoutMethod['paypal_token'];
        $data['type'] = "PAYPAL_ACCOUNT";
        $data['accountId'] = $_POST['accountId']; 
        $data['transferMethodCountry'] = 'US'; 
        $data['transferMethodCurrency'] =  "USD";
      }
      else 
      {
        $data['api_url'] = "users/" . $res['response']->token . "/bank-accounts/".$payoutMethod['bank_token'];
        $data['branchId'] = $_POST['branchId']; 
        $data['bankAccountId'] = $_POST['bankAccountId']; 
        $data['bankAccountPurpose'] = $_POST['bankAccountPurpose']; 
        $data['type'] = "BANK_ACCOUNT";
        $data['bankAccountRelationship'] = 'OWN_COMPANY'; 
        $data['transferMethodCountry'] = $transferMethod[0]; 
        $data['transferMethodCurrency'] =  $transferMethod[1];
      }
       
      $res1 = runCurl($data , "PUT");

      if ($res1['httpcode'] === 200) {
        $ins['user_id'] = $this->user_id;
        $ins['user_token'] = $res['response']->token;
        $ins['status'] = $res['response']->status;
        $ins['clientUserId'] = $res['response']->clientUserId;
        $ins['addressLine1'] = $res['response']->addressLine1;
        $ins['city'] = $res['response']->city;
        $ins['country'] = $res['response']->country;
        $ins['dateOfBirth'] = $_POST["dateOfBirth"];
        $ins['email'] = $res['response']->email;
        $ins['firstName'] = ($res['response']->firstName == "" ? $res['response']->businessName : $res['response']->firstName);
        $ins['lastName'] = $_POST["lastName"];
        $ins['postalCode'] = $res['response']->postalCode;
        $ins['profileType'] = $res['response']->profileType;
        $ins['stateProvince'] = $res['response']->stateProvince;
        $ins['payout_type'] = $_POST["payout_type"];
        $ins['full_user_response'] = json_encode($res['response']);
        if($ins['payout_type'] == 'bank')
        {
          $ins['bankAccountPurpose'] = $_POST['bankAccountPurpose'];
          $ins['full_bank_response'] = json_encode($res1['response']); 
          $ins['branchId'] = $_POST["branchId"];
          $ins['bankAccountId'] = $_POST['bankAccountId'];
          $ins['bank_token'] = $res1['response']->token;
        }
        else
        {
          $ins['full_paypal_response'] = json_encode($res1['response']); 
          $ins['accountId'] = $_POST["accountId"];
          $ins['paypal_token'] = $res1['response']->token; 
          
        }
        
        $ins['transferMethodCountry'] = $transferMethod[0];
        $ins['transferMethodCurrency'] = $transferMethod[1];
        $ins['created_at'] = date('Y-m-d H:i:s');
        $ins['updated_at'] = date('Y-m-d H:i:s');
              
        $run = $this->common_model->UpdateData('hw_users' , ['id' => $_POST['id']] , $ins);
        $output['data'] = $res;
        $output['data1'] = $res1;
        $output['status'] = 1;
        $output['message'] = "record updated successfully";
        return json_encode($output);
      } else {
        // print_r($data);
        // print_r($res1);
       
        $output['status'] = 0;
        $fieldName = 'message';
        if(isset($res1['response']->errors[0]->fieldName))
        {
          $fieldName = $res1['response']->errors[0]->fieldName;
        }
        $output['message'] = [$fieldName => $res1['response']->errors[0]->message];
        $output['data'] = $res;
        return json_encode($output);

      }
  }
  
 
 
}
