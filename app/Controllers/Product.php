<?php

namespace App\Controllers;
use App\Models\Common_model;
class Product extends BaseController
{
    public function __construct() {   
        helper(['form', 'url']);
        $this->session = \Config\Services::session();
        $this->common_model = new Common_model();
        $this->user_id =  $this->session->get('user_id');
        $this->user = $this->common_model->GetSingleData('users', array('id' => $this->user_id));
        $this->currency = $this->user['currency'];
        //return $this->check_login();
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

    public function myProducts() {
        $data["product"] = $this->common_model->GetAllData("product", array("created_by"=>$this->user_id),"id","desc");
        return view("my-products", $data);
    }

    public function editProduct($id) {
        $data['categories'] = $this->common_model->GetAllData('categories',array('parent'=>0),'id','desc');      
        $data["product"] = $this->common_model->GetSingleData("product", array("created_by"=>$this->user_id, 'id'=>$id));
        if ($data["product"]) {
          $data["product_image"] = $this->common_model->GetAllData("product_image", array("product_id"=>$id));
          return view("edit-product", $data);
         } else {
          header('Location: '.base_url('my-products'));
        }
    }

    public function removeImage() {
          $id = $_REQUEST['image_id'];

          $run = $this->common_model->DeleteData("product_image", array("id"=>$id));
          if ($run) {
             echo 1;
          } else {
            echo 0;
          }
     }

     public function removeProduct($id) {
 
           $run = $this->common_model->DeleteData("product", array("id"=>$id, 'created_by'=>$this->user_id));
           
          if ($run) {
                $this->common_model->DeleteData("sell_product", array("product_id"=>$id));
                $this->session->setFlashdata('msg', '<div class="alert alert-success">Product has been removed successfully.</div>');
              
          } else {
            $this->session->setFlashdata('msg', '<div class="alert alert-danger">Something went wrong.</div>');
          }
          header('Location: '.base_url('my-products'));
     }

    public function editProductAction() {
        $this->validation->setRule('title','Title','trim|required');
        $this->validation->setRule('description','Description','trim|required');
        $this->validation->setRule('category','Category','trim|required');
        $this->validation->setRule('subcategory','SubCategory','trim|required');
        $this->validation->setRule('format','Format','trim|required');
        $this->validation->setRule('ram','RAM','trim|required');
        //$this->validation->setRule('price','Price','trim|required');
        $this->validation->setRule('brand','Brand','trim|required');
        //$this->validation->setRule('class_type','class_type','trim|required');
        //$this->validation->setRule('product_group','product_group','trim|required');

        if($this->validation->withRequest($this->request)->run()==false)
        {
   
            $output['message']=$this->validation->getErrors();
            $output['status']= 0 ;       
        }

        else
        {
       // echo "hello";die;
            $id = $this->request->getVar('product_id');
            $insert['title']= $this->request->getVar('title');
            $insert['description']= $this->request->getVar('description');
            $insert['category']= $this->request->getVar('category');
            $insert['subcategory']= $this->request->getVar('subcategory');
            $insert['format']= $this->request->getVar('format');
            $insert['ram']= $this->request->getVar('ram');
            $insert['base_price']= 10;
            $insert['brand']= $this->request->getVar('brand');
            $insert['video_type'] = $this->request->getVar('video_type');
            $insert['youtube_url'] = $this->request->getVar('youtube_url');
           // $insert['conditions'] = $this->request->getVar('conditions');
            if(isset($_POST['mkt_price']))
            {
                $insert['mkt_price'] = $this->request->getVar('mkt_price');
            }
            if(isset($_POST['meta_score']))
            {
                $insert['meta_score'] = $this->request->getVar('meta_score');
            }
            if(isset($_POST['game_score']))
            {
                $insert['game_score'] = $this->request->getVar('game_score');
            }
            if(isset($_POST['factor_x']))
            {
                $insert['factor_x'] = $this->request->getVar('factor_x');
            }
            if(isset($_POST['factor_y']))
            {
                $insert['factor_y'] = $this->request->getVar('factor_y');
            }
            if(isset($_POST['factor_z']))
            {
                $insert['factor_z'] = $this->request->getVar('factor_z');
            }

           
            // /$insert['class_type']= '';
            $insert['product_group']= 0;
            $insert['updated_at'] =date('Y-m-d H:i:s');
            if(isset($_FILES['product_video']['name'])  && !empty($_FILES['product_video']['name']) )
            {
                $validated = $this->validate([
                'product_video' => [
                    'uploaded[product_video]',
                    'mime_in[product_video,video/mp4,video/x-m4v,video/*]',
                    'max_size[product_video,4096]',
                    ],
                ]);
        
 
                if (!$validated) {
                    $output['message'] = $this->validation->getErrors();
                    $output['status']= 0 ;
                    echo json_encode($output);
                    exit;
                }
          
                $name_array = explode('.',$_FILES['product_video']['name']);
                $ext = end($name_array);
                $new_name = rand().time().'.'.$ext;
                $tmp_name = $_FILES["product_video"]["tmp_name"];
                $path = 'assets/product_video/'.$new_name;
                if(move_uploaded_file($tmp_name,$path))
                {
                    $insert['product_video']=$path;
                    
                }
                else
                {
                    $output['message'] = ['product_video' => 'Something Wrong'];
                    $output['status']= 0 ;
                    echo json_encode($output);
                    exit;
                }
                
            }
            $run = $this->common_model->UpdateData('product', array("id"=>$id, "created_by"=>$this->user_id),$insert);


            
        
         //echo $this->db->last_query();die;
            if($run)  {  
              
              if(isset($_FILES['images']['name'])  && is_array($_FILES['images']['name']) && count($_FILES['images']['name']) > 0){
          
                $image_arr = $_FILES['images']['name'];
          
                foreach($image_arr as $key => $row){
                    $insert2 = array();
                    $name_array = explode('.',$_FILES['images']['name'][$key]);
                    $ext = end($name_array);
                    $new_name = rand().time().'.'.$ext;
            
                    $tmp_name = $_FILES["images"]["tmp_name"][$key];
                    $path = 'assets/product_image/'.$new_name;
            
                    if(move_uploaded_file($tmp_name,$path)){
                        $insert2['image']=$path;
                        $insert2['product_id']=$id;
                        $run1 = $this->common_model->InsertData('product_image', $insert2);
                    }
                }
            } 

         
                $this->session->setFlashdata('msg', '<div class="alert alert-success">Product has been updated successfully</div>');
                //$output['message']='Product has been added successfully' ;
                $output['status']= 1 ;                               

            } else {
        
                $output['message']='<div class="alert alert-danger">Something went wrong</div>' ;
                $output['status']= 0 ;  
        
            }
        }
        echo json_encode($output);
     }
     public function addproduct()
    {
        $this->validation->setRule('title','Title','trim|required');
        $this->validation->setRule('description','Description','trim|required');
        $this->validation->setRule('category','Category','trim|required');
        $this->validation->setRule('subcategory','SubCategory','trim|required');
        $this->validation->setRule('format','Format','trim|required');
        $this->validation->setRule('ram','RAM','trim|required');
        $this->validation->setRule('brand','Brand','trim|required');
        //$this->validation->setRule('price','Price','trim|required');
        //$this->validation->setRule('class_type','class_type','trim|required');
        //$this->validation->setRule('product_group','product_group','trim|required');

        if($this->validation->withRequest($this->request)->run()==false)
        {
   
            $output['message']=$this->validation->getErrors();
            $output['status']= 0 ;       
        }

        else
        {
       // echo "hello";die;
            $insert['title']= $this->request->getVar('title');
            $insert['description']= $this->request->getVar('description');
            $insert['category']= $this->request->getVar('category');
            $insert['subcategory']= $this->request->getVar('subcategory');
            $insert['format']= $this->request->getVar('format');
            $insert['ram']= $this->request->getVar('ram');
            $insert['base_price']= 10;
            $insert['brand']= $this->request->getVar('brand'); 
            $insert['video_type'] = $this->request->getVar('video_type');
            $insert['youtube_url'] = $this->request->getVar('youtube_url');
            //$insert['conditions'] = $this->request->getVar('conditions');
            if(isset($_POST['mkt_price']))
            {
                $insert['mkt_price'] = $this->request->getVar('mkt_price');
            }
            if(isset($_POST['meta_score']))
            {
                $insert['meta_score'] = $this->request->getVar('meta_score');
            }
            if(isset($_POST['game_score']))
            {
                $insert['game_score'] = $this->request->getVar('game_score');
            }
            if(isset($_POST['factor_x']))
            {
                $insert['factor_x'] = $this->request->getVar('factor_x');
            }
            if(isset($_POST['factor_y']))
            {
                $insert['factor_y'] = $this->request->getVar('factor_y');
            }
            if(isset($_POST['factor_z']))
            {
                $insert['factor_z'] = $this->request->getVar('factor_z');
            }
            $insert['created_by']= $this->user_id;
            if (isset($_POST['is_requested'])) {
                $this->requestMailToUser($insert);
                $insert['release_date']= $this->request->getVar('release_year');
                $insert['created_by']= 0;
                $insert['status']= 0;
            }
            $insert['product_group']= 0;
            $insert['created_at'] =date('Y-m-d H:i:s');
            if(isset($_FILES['product_video']['name'])  && !empty($_FILES['product_video']['name']) )
            {
                $validated = $this->validate([
                'product_video' => [
                    'uploaded[product_video]',
                    'mime_in[product_video,video/mp4,video/x-m4v,video/*]',
                    'max_size[product_video,4096]',
                    ],
                ]);
        
 
                if (!$validated) {
                    $output['message'] = $this->validation->getErrors();
                    $output['status']= 0 ;
                    echo json_encode($output);
                    exit;
                }
          
                $name_array = explode('.',$_FILES['product_video']['name']);
                $ext = end($name_array);
                $new_name = rand().time().'.'.$ext;
                $tmp_name = $_FILES["product_video"]["tmp_name"];
                $path = 'assets/product_video/'.$new_name;
                if(move_uploaded_file($tmp_name,$path))
                {
                    $insert['product_video']=$path;
                    
                }
                else
                {
                    $output['message'] = ['product_video' => 'Something Wrong'];
                    $output['status']= 0 ;
                    echo json_encode($output);
                    exit;
                }
                
            }            $run = $this->common_model->InsertData('product', $insert);


            if(isset($_FILES['images']['name'])  && is_array($_FILES['images']['name']) && count($_FILES['images']['name']) > 0){
          
                $image_arr = $_FILES['images']['name'];
          
                foreach($image_arr as $key => $row){
                    $insert2 = array();
                    $name_array = explode('.',$_FILES['images']['name'][$key]);
                    $ext = end($name_array);
                    $new_name = rand().time().'.'.$ext;
            
                    $tmp_name = $_FILES["images"]["tmp_name"][$key];
                    $path = 'assets/product_image/'.$new_name;
            
                    if(move_uploaded_file($tmp_name,$path)){
                        $insert2['image']=$path;
                        $insert2['product_id']=$run;
                        $run1 = $this->common_model->InsertData('product_image', $insert2);
                    }
                }
            }

        
         //echo $this->db->last_query();die;
            if($run)
            {  
         
                $this->session->setFlashdata('msg', '<div class="alert alert-success">Product has been added successfully</div>');
                $output['message']='Product has been added successfully' ;
                $output['status']= 1 ;                               
                $output['redirect']= base_url('sell').'/'.slugify($insert['title']).'/'.$run ;                               

            }
            else 
            {
        
                $output['message']='<div class="alert alert-danger">Something went wrong</div>' ;
                $output['status']= 0 ;  
        
            }
        }
        echo json_encode($output);
    }

     public function mySelling()  {
 //active     
        $sql = "select sell_product.*,  product.* , sell_product.id as sell_id from sell_product INNER JOIN product ON product.id=sell_product.product_id where sold_status = 0 and sell_product.user_id=".$this->user_id." ORDER BY sell_product.id desc";
        //echo $sql;
         $query = $this->db->query($sql); 

         $data["active_product"] = $query->getResultArray(); 

//progress  
       $sql1 = "select sell_product.*,  product.* , sell_product.id as sell_id from sell_product INNER JOIN product ON product.id=sell_product.product_id where sold_status = 1 and sell_product.user_id=".$this->user_id." ORDER BY sell_product.id desc";
        //echo $sql;
        $query = $this->db->query($sql1); 

        $data["progress_product"] = $query->getResultArray(); 
      
//complete  
       $sql2 = "select sell_product.*,  product.* , sell_product.id as sell_id from sell_product  INNER JOIN product ON product.id=sell_product.product_id where sold_status = 2 and sell_product.user_id=".$this->user_id." ORDER BY sell_product.id desc";
        //echo $sql;
        $query = $this->db->query($sql2); 

        $data["complete_product"] = $query->getResultArray(); 
//expire  
        $sql3 = "select sell_product.*,  product.* , sell_product.id as sell_id from sell_product INNER JOIN product ON product.id=sell_product.product_id where sold_status = 3 and sell_product.user_id=".$this->user_id." ORDER BY sell_product.id desc";
        //echo $sql;
        $query = $this->db->query($sql3); 

        $data["expire_product"] = $query->getResultArray(); 
       return view("my-selling", $data);
     }

  public function removeSelling($id) {
      $sell_product = $this->common_model->GetSingleData('sell_product',array('product_id'=> $id , 'user_id'=>$this->user_id));
        $run = $this->common_model->DeleteData("sell_product", array("product_id"=>$id, 'user_id'=>$this->user_id));
          
          if ($run) {
                $this->session->setFlashdata('msg', '<div class="alert alert-success">Selling has been removed successfully.</div>');
                $product_detail = $this->common_model->GetSingleData('product',array('id'=> $id));
                $this->sendCancelAsk($sell_product,$product_detail);
              
          } else {
            $this->session->setFlashdata('msg', '<div class="alert alert-danger">Something went wrong.</div>');
          }
          header('Location: '.base_url('my-selling'));
     }
     private function sendCancelAsk($sell_product,$product_detail)
    {
        $user = $this->user;
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

    private function requestMailToUser($product_detail)
    {
        $user = $this->user;
        $email = $user['email'];
        $subject="Game Request of ".$product_detail['title'];
        $body = '<p>Hello '.$user['first_name'].' </p><p> your request to add "'.$product_detail['title'].'" has been processed and we will add it as soon as possible. Thank you for using Gamex.</p>';
        
        $send = $this->common_model->SendMail($email,$subject,$body);   
       
    }
     public function mySellingDetail($id) {

         $data["sell_data"] = $this->common_model->GetSingleData("sell_product", array("product_id"=>$id, "user_id"=>$this->user_id));
         if ($data["sell_data"]) {
         $data["product"] = $this->common_model->GetSingleData("product", array("id"=>$id));
             return view("my-sell-detail", $data);
         } else {
           header('Location: '.base_url('my-selling')); 
         }
     }

     public function mySellingEdit($id) {
         $data["sell_data"] = $this->common_model->GetSingleData("sell_product", array("product_id"=>$id, "user_id"=>$this->user_id , "sold_status"=>0 , "status"=>1));
         if ($data["sell_data"]) {
         $data["product"] = $this->common_model->GetSingleData("product", array("id"=>$id));
             return view("edit-my-sell", $data);
         } else {
           header('Location: '.base_url('my-selling')); 
         }
     }

     public function editSell() {
        $this->validation->setRule('card_number','card number','trim|required');
        $this->validation->setRule('card_expire','card expire','trim|required');
        $this->validation->setRule('card_cvv','card cvv','trim|required');
        $this->validation->setRule('billing_first','billing name','trim|required');
        $this->validation->setRule('billing_last','billing last name','trim|required');
        $this->validation->setRule('billing_country','billing country','trim|required');
        $this->validation->setRule('billing_address','billing address','trim|required');
        $this->validation->setRule('billing_city','billing city','trim|required');
        $this->validation->setRule('billing_state','billing State/Province/Region','trim|required');
        $this->validation->setRule('billing_zip','billing Zip/Postal Code','trim|required');
        $this->validation->setRule('game_condition','game_condition','trim|required');
        if($this->validation->withRequest($this->request)->run()==false) {
   
            $output['message']=$this->validation->getErrors();
            $output['status']= 0 ;       
        } else {

            $id = $this->request->getVar('product_id');
            $seller_id = $this->request->getVar('user_id');
            $order_id = $this->request->getVar('order_id');
            $insert["card_number"] = $this->request->getVar('card_number');
            $insert["card_expire"] = $this->request->getVar('card_expire');
            $insert["card_cvv"] = $this->request->getVar('card_cvv');
            $insert["billing_first"] = $this->request->getVar('billing_first');
            $insert["billing_last"] = $this->request->getVar('billing_last');
            $insert["billing_country"] = $this->request->getVar('billing_country');
            $insert["billing_address"] = $this->request->getVar('billing_address'); 
            $insert["billing_city"] = $this->request->getVar('billing_city'); 
            $insert["billing_state"] = $this->request->getVar('billing_state'); 
            $insert["billing_zip"] = $this->request->getVar('billing_zip');
            $insert["game_condition"] = $this->request->getVar('game_condition');
            $insert['is_new'] = $this->request->getVar('is_new');
            $insert['is_ship_in_2_days'] = $this->request->getVar('is_ship_in_2_days');
            $insert["price"] = convert_currency($this->request->getVar('price') ,  'HKD' , $this->currency); 
            //$insert["total"] = $this->request->getVar('total'); 
            $insert["dis_price"] = convert_currency($this->request->getVar('dis_price')  , 'HKD'  , $this->currency ); 
            $insert['trans_fee'] = ($insert['price'] * get_admin()['admin_commission']) / 100;
            $insert['payment_fee'] = ($insert['price'] * get_admin()['vat_tax']) / 100;
            if ($this->request->getVar('validity_day')) {
                    $insert["validity_day"] = $this->request->getVar('validity_day');
                    $date = date('Y-m-d');
                    $insert['exp_date'] = date('Y-m-d' , strtotime('+ '.$insert['validity_day'].' days'));
             } else {
                $insert["validity_day"] = 0;
                $insert["exp_date"] = '';
             }
            $insert["status"] = $this->request->getVar('status');
            if ($insert['status'] ==  2) {
                $insert['sold_status'] = 2;
            }
            
            $seller_product = $this->common_model->GetSingleData("sell_product", array("product_id"=>$id, "user_id"=>$this->user_id , "sold_status"=>0));
            $run = $this->common_model->UpdateData("sell_product", array("product_id"=>$id, "user_id"=>$this->user_id , "sold_status"=>0), $insert);
            
            //echo $this->db->getLastQuery();
            if($run) { 
                //$output['message']='Product has been added successfully' ;
                if ($insert['status'] ==  2) 
                {
                    $output = do_sell_product($order_id , $seller_product['id'] , $seller_id);
                    return $this->response->setJSON( $output );
                }
                $product_detail = $this->common_model->GetSingleData('product',array('id'=> $id));
                
                if ($seller_product['price'] != $insert['price']) 
                {
                    $Newseller_product = $this->common_model->GetSingleData("sell_product", array("product_id"=>$id, "user_id"=>$this->user_id , "sold_status"=>0));
                    $this->sendAsktoCustomer($product_detail , $Newseller_product);
                    $this->sendAsktoLowestCustomer($product_detail , $Newseller_product );
                }
               
                $output['status']= 1 ; 
                $output['message']='Ask has been updated successfully' ;                              

            } else {
        
                $output['message']='<div class="alert alert-danger">Something went wrong</div>' ;
                $output['status']= 0 ;  
        
            }


        }
        echo json_encode($output);

     }
     private function sendAsktoCustomer($product_detail , $sell_detail )
    {
        $user = $this->user;
        
       
       
        $toz = $user['email'];
        $sub = "Your Ask Is Modified ! ".$product_detail['title']." "; 
        
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

        $lowest_sell = $this->common_model->GetAllData('sell_product' , 'sold_status = 0  AND product_id = '.$product_detail['id'].' AND price > '.$sell_detail['price'] , 'id' , 'desc');
        //echo $this->db->getLastQuery();
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
 /* public function add_to_fav(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'property_id' => 'required',
        ]);
        if ($validator->fails())
        {
            return response()->json($validator->errors(),422);
        }
        if (!Auth::id()) {
            return response()->json(["msg"=>"Please login to add favourite"],422);
        }
        $check = Favourites::where(['user_id' => Auth::id() , 'property_id'=>$request->property_id])->first();
        if ($check) {
            $check->delete();
            return response()->json(["status"=>false,"msg"=>"Property removed from favourites","redirect_location"=>route("user.myproperties")]);
        }
        $Favourites = new Favourites;
        $Favourites->user_id = Auth::id();
        $Favourites->property_id = $request->property_id;
        $Favourites->created_at = Carbon::now();
        $Favourites->updated_at = Carbon::now();
        $Favourites->save();
        return response()->json(["status"=>true,"msg"=>"Property Added to favourites","redirect_location"=>route("user.myproperties")]);
    }*/


/*public function add_to_fav()
    {
      //echo "hello";
        $this->validation->setRule('product_id','Product Id','trim|required');
        

        if($this->validation->withRequest($this->request)->run()==false)
        {
            return json_encode(["status"=>0,"msg"=>$this->validation->getErrors()]);
                   
        }

        else
        {
          $product_id = $this->request->getVar('product_id');
            if (!$this->user_id) {
              return json_encode(["status"=>2,"msg"=>"Please login product add to favorite"]);
             
            }
        $check = $this->common_model->GetSingleData('wishlist',array('user_id'=>$this->user_id,'product_id'=>$product_id));
        if(!empty($check))  {
          $check_delete = $this->common_model->DeleteData('wishlist',array('user_id'=>$this->user_id,'product_id'=>$product_id));
            return json_encode(["status"=>0,"msg"=>"Product removed from favourites"]);
           
        }
           $insert['user_id']= $this->user_id;
           $insert['product_id']= $product_id;
           $insert['created_at'] = date('Y-m-d');
            
             $run = $this->common_model->InsertData('wishlist', $insert);
             return json_encode(["status"=>1,"msg"=>"Product Added to favourites"]);
        }
        //echo json_encode($output);
    }*/

}
