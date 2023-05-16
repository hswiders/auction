<?php 
namespace App\Controllers\Admin;
use App\Controllers\BaseController;
use App\Services\HyperwalletService;
use App\Services\PaypalService;
class AdminWallet extends BaseController {

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

  	public function my_wallet()
    {
        $data['my_wallet'] = $this->common_model->GetAllData('wallet_transactions',array('user_id'=>0),'id','desc');
        $data['admin'] = $this->common_model->GetSingleData('admin',array('id'=>1));
        return view('admin/my_wallet', $data);
    }

    public function withdrawal_requests()
    {
        $where = "user_id != 0 and status = 0";
        $data['withdrawal_requests'] = $this->common_model->GetAllData('wallet_transactions',$where,'id','desc');
        $data['status'] = 0;
        return view('admin/withdrawal_requests', $data);
    }
    public function completed_withdrawal()
    {
        $where = "user_id != 0 and status = 1 and is_withdrawal = 1";
        $data['withdrawal_requests'] = $this->common_model->GetAllData('wallet_transactions',$where,'id','desc');
        $data['status'] = 1;
        return view('admin/withdrawal_requests', $data);
    }
    public function rejected_withdrawal()
    {
        $where = "user_id != 0 and status = 2 and is_withdrawal = 1";
        $data['withdrawal_requests'] = $this->common_model->GetAllData('wallet_transactions',$where,'id','desc');
        $data['status'] = 1;
        return view('admin/withdrawal_requests', $data);
    }

    public function accept_status()
    {
          
          $id = $_POST['id'];
          $update['status'] = 0;
          $update['is_withdrawal'] = 1;
          $user_id = $_POST['user_id'];
          $amount = $_POST['amount'];
          
          $userData = $this->common_model->GetSingleData('users',['id'=>$user_id]);
          $trans = $this->common_model->GetSingleData('wallet_transactions',['id'=>$id]);
          $payout_info = $this->common_model->GetSingleData('hw_users',['id'=> $trans['payout_id']]);
            if( $payout_info['payout_type'] == "paypal" )
            {
                $amount = convert_currency($amount , 'USD' ,'HKD');
                $currency = 'USD';

            }
            else
            {
                $currency = 'HKD';
            }
          
         
            $data = [
                "clientTransferId" => generateRandomString(8),
                "destinationAmount" => $amount,
                "destinationCurrency" => $currency,
                "notes" => "Withdrawal Transfer",
                "memo" => "Transfer to ". $userData['first_name'],
                "sourceToken" => $payout_info['user_token'],
                "destinationToken" => ( $payout_info['payout_type'] == "paypal" ) ? $payout_info['paypal_token'] : $payout_info['bank_token']
            ]; 
            $data1 = [
                "amount" => $amount,
                "clientPaymentId" => generateRandomString(8),
                "currency" => $currency,
                "destinationToken" => $payout_info['user_token'],
                "programToken" => $_ENV['hyper_program_token'],
                "purpose" => "OTHER"
            ];
          
            $data2 = [
                "transition" => "SCHEDULED",
                "notes" => "Completing Transfer to ". $userData['first_name'],
                
            ];
         $data1['api_url'] = "payments";
         $data['api_url'] = "transfers";
        
         $res1 = runCurl($data1 ); //create payment api
         if($res1['httpcode'] != 201)
         {
                $output['status']=0;
                $output['message'] = $res1['response']->errors[0]->message;
                return json_encode($output);
                
         }
         $res = runCurl($data ); // create transfer api
         if($res['httpcode'] != 201)
         {
                $output['status']=0;
                $output['message'] = $res['response']->errors[0]->message;
                return json_encode($output);
                
         }
         $data2['api_url'] = "transfers/".$res['response']->token."/status-transitions";
         $res2 = runCurl($data2 ); // commit transfer api
         if($res2['httpcode'] != 201)
         {
                $output['status']=0;
                $output['message'] = $res2['response']->errors[0]->message;
                return json_encode($output);
                
         }
         //echo $_ENV['hyper_program_token'];
         $update['transfer_response'] = json_encode($res['response']);
         
         //print_r($res); 
        // print_r($res1); 
         //print_r($update); die;
        $run = $this->common_model->UpdateData('wallet_transactions',['id'=>$id], $update);
          if($run)
             {
              
               $subject="Withdrawal Request Accepted";    
               $body = '<p>Dear '. $userData['first_name'].' '. $userData['last_name'].'</p>';
               $body .= "<p>We are pleased to inform you that your withdrawal request for ".$amount." has been accepted. The funds have been transferred to your bank account and should be available within 3 business days.</p>";
               $send = $this->common_model->SendMail($userData['email'],$subject,$body);
               
                $this->session->setFlashdata('msg', '<div class="alert alert-success">Withdrawal request has been approved successfully.</div>');
              $output['status']=1;
              $output['message']="Withdrawal request has been approved successfully.";
              }else
               {
                  $this->session->setFlashdata('msg', '<div class="alert alert-success">Something Went Wrong.</div>');
                $output['status']=1;
                $output['message']="Something Went Wrong.";
               }
           echo json_encode($output);
    }

    public function reject_reason()
    {
            $this->validation->setRule('reason','reason','trim|required');

  
           if($this->validation->withRequest($this->request)->run()==false) {

              $output['message']=$this->validation->getErrors();
              $output['status']= 0;     
              echo json_encode($output);
              exit();

          }
          $id = $_POST['id'];
          $user_id = $_POST['user_id'];
          $reason = $_POST['reason'];
          $amount = $_POST['amount'];
          $userData = $this->common_model->GetSingleData('users',['id'=>$user_id]);
          $run = $this->common_model->UpdateData('wallet_transactions',['id'=>$id] , ['status' => 2 , 'purpose' => 'Rejected due to '.$reason]);
          $update1['wallet'] = $userData['wallet']+$amount;
            $this->common_model->UpdateData('users',['id'=>$user_id], $update1);
           if($run)
             {

               $subject="Withdrawal Request Rejected";    
               $body = '<p>Dear '. $userData['first_name'].' '. $userData['last_name'].'</p>';
               $body .= '<p>We regret to inform you that your withdrawal request for '.$amount.' has been rejected. The reason for the rejection is: '.$reason.'</p>';
               $body .= "<p>Please note that the funds will remain in your wallet balance. If you have any questions or concerns, please don't hesitate to contact us</p>";
                $send = $this->common_model->SendMail($userData['email'],$subject,$body);
               // $send = $this->common_model->SendMail('ashish.webwiders@gmail.com',$subject,$body);
        
              $this->session->setFlashdata('msg', '<div class="alert alert-success">Withdrawal request has been rejected successfully.</div>');
              $output['status']=1;
              $output['message']="Withdrawal request has been rejected successfully.";
              }else
               {
                  $this->session->setFlashdata('msg', '<div class="alert alert-success">Something Went Wrong.</div>');
                $output['status']=1;
                $output['message']="Something Went Wrong.";
               }
           echo json_encode($output);
    }
  	
    public function Sorting(){
        $i = 0;
        $data = explode(',', $_POST['data']);
        foreach ($data as $value) {
            $insert['sorting'] = $i;
            $where['id'] = $value;
            $run = $this->common_model->UpdateData('categories',$where , $insert);
            $i++;
        }
            
        
    }
    public function transferPayment()
    {
        // Create transfer request
        $hyperwalletService = new HyperwalletService();
        $transfer = $hyperwalletService->createTransfer(
            'clientTransferId',
            'paypal_account_token',
            'USD',
            '10.00'
        );

        // Create payout request
        $paypalService = new PaypalService();
        $payout = $paypalService->createPayout(
            'senderBatchId',
            'recipient_email@example.com',
            'USD',
            '10.00'
        );

        // Print results
        echo 'Transfer ID: ' . $transfer->getToken() . '<br>';
        echo 'Payout ID: ' . $payout->getBatchHeader()->getPayoutBatchId() . '<br>';
    }
  
}