<?php

namespace App\Controllers;
use App\Models\Common_model;
use App\Models\Search_news;
class Sell extends BaseController
{
    public function __construct() {   
        helper(['form', 'url']);
        $this->session = \Config\Services::session();
        $this->common_model = new Common_model();
        $this->search_news = new Common_model();
        $this->db = \Config\Database::connect();

        $this->user_id =  $this->session->get('user_id');
        $this->user = $this->common_model->GetSingleData('users', array('id' => $this->user_id));
        $this->currency = $this->user['currency'];
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
       public function index()
    {
        return view('sell');
    }
   
    public function searchKey()
    {

        $value = $this->request->getVar('val');
            
        //$run = "SELECT * FROM product WHERE (title LIKE '%".$value."%' OR description LIKE '%".$value."%' OR format LIKE '%".$value."%' ) ";
        $run = "SELECT *, product.title as p_title, product.id as p_id FROM product INNER JOIN categories ON product.category AND product.subcategory=categories.id WHERE (product.title LIKE '%".$value."%' OR categories.title LIKE '%".$value."%' OR description LIKE '%".$value."%')";
        $data = $this->db->query($run);
        if($data->getNumRows() > 0)
        {
            $output =  $data->getResultArray();
        }
        $html = "";
        foreach($output as $val)
        {
            $html .= '<a href='.base_url().'/sell/'.slugify($val["p_title"]).'/'.$val["p_id"].'><div class="row">';        
            $html .= '<div col-md-4>';
            $image = $this->common_model->GetSingleData('product_image',array('product_id'=>$val['p_id'])); 
            $html .= '<img width="150px" src='.base_url().'/'.$image['image'].'>'; 
            $html .= '</div>'; 
            $html .= '<div col-md-6>';
            $html .= '<h3>'.$val['p_title'].'</h3>';
            $html .= '<p>'.substr(strip_tags($val['description']), 0, 50).'...</p>';
            $html .= '</div>';
            $html .= '</div></a>';
        }
        $output['html'] = $html;
        echo json_encode($output);
         
        
    }
    public function create_product()
    {
        $data['categories'] = $this->common_model->GetAllData('categories',array('parent'=>0),'id','desc');
        return view('create-product',$data);
    }

    
    public function addSell()
    {
        $this->validation->setRule('product_id', 'product_id', 'trim|required');
        $this->validation->setRule('product_owner', 'product_owner', 'trim|required');
        $this->validation->setRule('user_id', 'user_id', 'trim|required');
        $this->validation->setRule('status', 'status', 'trim|required');
        $this->validation->setRule('price', 'price', 'trim|required');
        $this->validation->setRule('dis_price', 'dis_price', 'trim|required');
        $this->validation->setRule('validity_day', 'validity_day', 'trim|required');
        //$this->validation->setRule('exp_date', 'exp_date', 'trim|required');
        $this->validation->setRule('card_number', 'card_number', 'trim|required');
        $this->validation->setRule('card_expire', 'card_expire', 'trim|required');
        $this->validation->setRule('card_cvv', 'card_cvv', 'trim|required');
        $this->validation->setRule('billing_first', 'billing_first', 'trim|required');
        $this->validation->setRule('billing_last', 'billing_last', 'trim|required');
        $this->validation->setRule('billing_country', 'billing_country', 'trim|required');
        $this->validation->setRule('billing_address', 'billing_address', 'trim|required');
        $this->validation->setRule('billing_address2', 'billing_address2', 'trim|required');
        $this->validation->setRule('billing_city', 'billing_city', 'trim|required');
        $this->validation->setRule('billing_state', 'billing_state', 'trim|required');
        $this->validation->setRule('billing_zip', 'billing_zip', 'trim|required');
        $this->validation->setRule('game_condition', 'game_condition', 'trim|required');

        if($this->validation->withRequest($this->request)->run()==false)
        {
   
            $output['message']=$this->validation->getErrors();
            $output['status']= 0 ;
            return $this->response->setJSON( $output );
        }

        else
        {

       // echo "hello";die;
            $c = $this->request->getVar('card_number');
            $check = check_cc($c, false);    
            if(!$check)
            {
                $output['message']= ['card_number' => 'Please enter valid card number'];
                $output['status']= 0 ;  
                echo json_encode($output);
                 exit;    
            }
            $seller_id = $this->request->getVar('user_id');
            $order_id = $this->request->getVar('order_id');
            $insert['card_number'] = $this->request->getVar('card_number');
            $insert['card_expire'] = $this->request->getVar('card_expire');
            $insert['card_cvv'] = $this->request->getVar('card_cvv');
            $insert['card_type'] = $check;    
            $insert['billing_first'] = $this->request->getVar('billing_first');
            $insert['billing_last'] = $this->request->getVar('billing_last');
            $insert['billing_country'] = $this->request->getVar('billing_country');
            $insert['billing_address'] = $this->request->getVar('billing_address');
            $insert['billing_address2'] = $this->request->getVar('billing_address2');
            $insert['billing_city'] = $this->request->getVar('billing_city');
            $insert['billing_state'] = $this->request->getVar('billing_state');
            $insert['billing_zip'] = $this->request->getVar('billing_zip');
            $insert['user_id'] = $this->request->getVar('user_id');
            $has_already = $this->common_model->GetSingleData('seller_billing_info', array('user_id'=> $this->user_id));
            if ($has_already) 
            {
                $run = $this->common_model->UpdateData('seller_billing_info', array('user_id'=> $this->user_id) ,$insert );
            }
            else
            {
                 $run = $this->common_model->InsertData('seller_billing_info' ,$insert );
            }
            unset($insert['card_type']);
            $insert['product_id'] = $this->request->getVar('product_id');
            $insert['sold_status'] = 0;
            if ($this->common_model->GetSingleData('sell_product' , $insert )) 
            {
                $output['message']='You can not Ask twice';
                $output['status']= 2 ;
               
                return $this->response->setStatusCode(422)->setJSON( $output );
            }
            $insert['product_owner'] = $this->request->getVar('product_owner');
            $insert['status'] = $this->request->getVar('status');
            $insert['price'] = convert_currency($this->request->getVar('price') ,  'HKD' , $this->currency);
            $insert['dis_price'] = convert_currency($this->request->getVar('dis_price') , 'HKD' , $this->currency);
            $insert['trans_fee'] = ($insert['price'] * get_admin()['admin_commission']) / 100;
            $insert['payment_fee'] = ($insert['price'] * get_admin()['vat_tax']) / 100;
            $insert['shipping_fee'] = get_admin()['shipping_fee'];
            $insert['validity_day'] = $this->request->getVar('validity_day');
            // $insert['exp_date'] = $this->request->getVar('exp_date');
            
            
            $insert['game_condition'] = $this->request->getVar('game_condition');
            $insert['is_new'] = $this->request->getVar('is_new');
            $insert['is_ship_in_2_days'] = $this->request->getVar('is_ship_in_2_days');
        
            $insert['exp_date'] = ($insert['validity_day'] == 0) ? date('Y-m-d') : date('Y-m-d' , strtotime( '+ '.$insert['validity_day'].' days'));
            $insert['created_at'] =date('Y-m-d H:i:s');
            $insert['updated_at'] =date('Y-m-d H:i:s');
            if ($insert['status'] ==  2) {
                $insert['sold_status'] = 2;
            }
            $sell_product_id = $this->common_model->InsertData('sell_product', $insert);
        
         //echo $this->db->last_query();die;
            if($sell_product_id)
            {  
                if ($insert['status'] ==  2) 
                {
                    $output = do_sell_product($order_id , $sell_product_id , $seller_id);
                    return $this->response->setJSON( $output );
                }
                else
                {
                    $product_detail = $this->common_model->GetSingleData('product',array('id'=> $insert['product_id']));
                    $sell_detail = $this->common_model->GetSingleData('sell_product',array('id'=> $sell_product_id));
                    $this->sendAsktoCustomer($product_detail , $sell_detail );
                    $this->sendAsktoLowestCustomer($product_detail , $sell_detail );
                }
         
                $this->session->setFlashdata('msg', '<div class="alert alert-success">Your ask has  been placed successfully</div>');
                $output['message']='Your ask has been placed successfully' ;
                $output['status']= 1 ;                               
                $output['redirect']= base_url('edit-my-sell/'.$insert['product_id']) ;                               

            }
            else 
            {
        
                $output['message']='<div class="alert alert-danger">Something went wrong</div>' ;
                $output['status']= 0 ;  
        
            }
        }
        return $this->response->setJSON( $output );
    }
    private function sendAsktoCustomer($product_detail , $sell_detail )
    {
        $user = $this->user;
        
       
       
        $toz = $user['email'];
        $sub = "Your Ask Is Live! ".$product_detail['title']." "; 
        
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
        $data["sell"] = $sell_detail;
        $data['currency'] = $user['currency'];
        $msg = view('mail/ask_live' ,$data);
            
        $this->email->setMessage($msg);
        
        $run  = $this->email->send();
        if($run) {
            return 1;
          } else {
            return 0;
          }     

       
    }
    private function sendAsktoLowestCustomer($product_detail , $sell_detail  )
    {

        $lowest_sell = $this->common_model->GetAllData('sell_product' , 'sold_status = 0 AND product_id = '.$product_detail['id'].' AND price > '.$sell_detail['price'] , 'id' , 'desc');

        if (!$lowest_sell) {
            return false;
        }

        foreach ($lowest_sell as $key => $value) 
        {
            $user = $this->common_model->GetSingleData('users' , array('id'=> $value['user_id']));
        
            $config = array();
            $config['mailType'] = "html";
            $config['charset'] = "utf-8";
            $config['newline'] = "\r\n";
            $config['CRLF'] = "\r\n";
            $config['wordwrap'] = TRUE;
            $config['validate'] = FALSE;
        
            $this->email->initialize($config);
            $toz = $user['email'];
            $sub = "🗣 New Lowest Ask! ".$product_detail['title'];
            $this->email->setFrom(Email, Project);
           
            $this->email->setTo($toz);
            //$this->email->setMailtype("html"); 
            $this->email->setSubject($sub);
            $data["sell_product"] = $value;
            $data['currency'] = $user['currency'];
            $msg = view('mail/lowest_ask',$data);
                
            $this->email->setMessage($msg);
            
            $run  = $this->email->send();
            if($run) {
                return 1;
              } else {
                return 0;
              } 
          }
        

       
    }
    public function getsubcat()
    {
        
        $category_id=$_POST["category_id"];
        $result = $this->common_model->GetAllData('categories',array('parent'=>$category_id),'id','desc');
        ?>
        <option value="">Select SubCategory</option>
        <?php
        foreach($result as $value) {
        ?>
            <option value="<?php echo $value["id"];?>"><?php echo $value["title"];?></option>

        <?php
        }

    }

    public function sell_product($title, $id)
    {
        
        $data['check'] = $this->common_model->GetSingleData('product', array('id'=>$id));
        $data['is_already_sale'] = $this->common_model->GetSingleData('sell_product', array('product_id'=> $id , 'user_id'=> $this->user_id , 'status'=> 1 , 'sold_status'=> 0 ));
        return view('sell-product', $data);
    }
    function add_sell_data()
    {
       
        $id  = $_POST['product_id'];
        $data['check'] = $this->common_model->GetSingleData('product', array('id'=>$id));
        $data['is_already_sale'] = $this->common_model->GetSingleData('sell_product', array('product_id'=> $id , 'user_id'=> $this->user_id , 'status'=> 1 , 'sold_status'=> 0 ));
        if($data['check'])
        {
            $highestbid_current = convert_currency(get_hl_bid_price($id)['grand_total'], $this->currency , 'HKD');
           
            $lowest_ask_current = convert_currency(get_hl_price($id)['lowest'], $this->currency , 'HKD'); 
            $highestbid_prev = $_POST['highestbid'];
            if ($_POST['is_first'] == 0) 
            {
                if ($highestbid_prev == $highestbid_current) {
                    echo 0;
                    exit;
                }
            }
            
            echo view('loop/add_sell_data', $data);
        }
        
    }
    function edit_sell_data()
    {
       
        $id  = $_POST['product_id'];
        $data["sell_data"] = $this->common_model->GetSingleData("sell_product", array("product_id"=>$id, "user_id"=>$this->user_id , "sold_status"=>0 , "status"=>1));
        
        if($data["sell_data"])
        {
            $data["product"] = $this->common_model->GetSingleData("product", array("id"=>$id));
            $highestbid_current = convert_currency(get_hl_bid_price($id)['grand_total'], $this->currency , 'HKD');
           
            $lowest_ask_current = convert_currency(get_hl_price($id)['lowest'], $this->currency , 'HKD'); 
            $highestbid_prev = $_POST['highestbid'];
            if ($_POST['is_first'] == 0) 
            {
                if ($highestbid_prev == $highestbid_current) {
                    echo 0;
                    exit;
                }
            }
            
            echo view('loop/edit_sell_data', $data);
        }
        else 
        {
            echo 'reload';
        }
    }
}
