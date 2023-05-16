<?php 

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Product extends BaseController {

	public function __construct() {   
        helper(['form', 'url']);
        $this->session = \Config\Services::session();
        $this->db = \Config\Database::connect(); 
        return $this->check_login();
        //$this->load->library("upload",$config);
    } 

    public function check_login()
    {
        if (!$this->session->has('admin_id')) {
            header('Location: '.base_url('admin'));
        }
       
    }

    public function admin_product_list()
    {
        //echo "hello"; die;
        $where = 'created_by = 0';
        $data['type'] = 'Admin';
        if (isset($_GET['category'])) 
        {
            $cat = $this->common_model->GetSingleData('categories',array('id'=>$_GET['category']),'id','desc');
            $data['type'] = '<a href="'.base_url('admin/categories-management').'" class="btn btn-info" >Back</a> '.$cat['title'];
            $where .= ' AND (category ='.$_GET['category'].' OR subcategory ='.$_GET['category'].')';
        }
        if (@$_GET['filter_by'] == 'available_stocks') 
        {
           
            $data['type'] = 'Available Stocks';
            $where .= ' AND stock > 0';
        }
        
        if (isset($_GET['group'])) 
        {
            $g = $this->common_model->GetSingleData('product_group',array('id'=>$_GET['group']),'id','desc');
            $data['type'] = '<a href="'.base_url('admin/product-group-management').'" class="btn btn-info" >Back</a> '.$g['title'];
            $where .= ' AND (product_group ='.$_GET['group'].')';
        }
        $data['product_list'] = $this->common_model->GetAllData('product',$where,'id','desc');
        $data['categories'] = $this->common_model->GetAllData('categories',array('parent'=>0),'id','desc');
        $data['export'] = true;
        
        
        return view('admin/product-list',$data);
    }
    public function admin_ajax_product_list()
{
    $where = 'created_by = 0';

    if (isset($_GET['category'])) {
        $where .= ' AND (category =' . $_GET['category'] . ' OR subcategory =' . $_GET['category'] . ')';
    }

    if (@$_GET['filter_by'] == 'available_stocks') {
        $where .= ' AND stock > 0';
    }

    if (isset($_GET['group'])) {
        $where .= ' AND (product_group =' . $_GET['group'] . ')';
    }

    $total_records = $this->db->table('product')->where($where)->countAllResults('products');

    $query = $this->db->table('product')->select('*')->where($where)->orderBy('id', 'DESC');

    if (isset($_GET['length']) && $_GET['length'] != '') {
        $query->limit($_GET['length'], $_GET['start']);
    } else {
        $query->limit(10, 0);
    }

    $product_list = $query->get()->getResultArray();

    foreach ($product_list as $key => $product) {
        $category = $this->common_model->GetSingleData('categories', ['id' => $product['category']]);
        $subcategory = $this->common_model->GetSingleData('categories', ['id' => $product['subcategory']]);
        $grade = $this->common_model->GetSingleData('class_type',['id'=>$product['class_type']]);
        $product_list[$key]['sno'] = $key+1;
        $product_list[$key]['category'] = $category['title'];
        $product_list[$key]['subcategory'] = $subcategory['title'];
        $product_list[$key]['class_type'] = $grade['class_name'];

        if ($product['status'] == 0)
        {
            $action = '<button class="btn btn-success" id="" onclick="accept_product('.$product['id'] .')">Approve</button>';
        } 
        else 
        {
            $action = '<a href="'. base_url('Admin/product/editproductform?id='.$product['id']) .'" class="btn btn-success" >Edit</a>';
        } 
        
        $product_list[$key]['action'] = '
            <div style="display:flex">
              '.$action.'
                <button class="btn btn-danger" id="delete_btns" onclick="delete_product(' . $product['id'] . ')">Delete</button>
                <button class="btn btn-primary" data-toggle="modal" data-target="#myviewModal' . $product['id'] . '">View</button>
                ' . view('admin/modals/product_modal', ['prod' => $product], ['cache' => 0]) . '
            </div>';
    }

    $data = array(
        "draw" => intval($_GET['draw']),
        "recordsTotal" => $total_records,
        "recordsFiltered" => $total_records,
        "data" => $product_list
    );

    echo json_encode($data);
}


 
    public function getsubcat()
    {
        
        $category_id=$_POST["category_id"];
        $result = $this->common_model->GetAllData('categories',array('parent'=>$category_id),'id','desc'); ?>
        <option value="">Select SubCategory</option>
        <?php
        foreach($result as $value) {
        ?>
        <option value="<?php echo $value["id"];?>"><?php echo $value["title"];?></option>

        <?php
        }

    }

    public function productform()
    {
        //echo "hello";
       $data['categories'] = $this->common_model->GetAllData('categories',array('parent'=>0),'id','desc');
       return view('admin/add-product',$data);
    }

    public function addproduct()
    {
        $this->validation->setRule('title','Title','trim|required');
       // $this->validation->setRule('description','Description','trim|required');
        $this->validation->setRule('category','Category','trim|required');
        $this->validation->setRule('subcategory','SubCategory','trim|required');
        $this->validation->setRule('format','Format','trim|required');
        $this->validation->setRule('brand','Brand','trim|required');
        //$this->validation->setRule('release_date','release_date','trim|required');
        $this->validation->setRule('price','Price','trim|required');
        $this->validation->setRule('class_type','class_type','trim|required');
        $this->validation->setRule('video_type','video_type','trim|required');
        
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
            $insert['release_date']= $this->request->getVar('release_date');
            $insert['base_price']= $this->request->getVar('price');
            $insert['brand']= $this->request->getVar('brand');
            $insert['class_type']= $this->request->getVar('class_type');
            $insert['video_type'] = $this->request->getVar('video_type');
            $insert['youtube_url'] = $this->request->getVar('youtube_url');
            $insert['conditions'] = $this->request->getVar('conditions');
            
            $insert['product_group']= isset($_POST['product_group']) ? implode(',', $this->request->getVar('product_group')) : '';
            $insert['created_by']= 0;
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
            if(isset($_POST['stock']) && !empty($_POST['stock']))
            {
                $insert['stock'] = $_POST['stock'];
            } else {
                $insert['stock'] = 0;
            }
            $insert['created_at'] =date('Y-m-d H:i:s');
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
            $run = $this->common_model->InsertData('product', $insert);

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

            }
            else 
            {
        
                $output['message']='<div class="alert alert-danger">Something went wrong</div>' ;
                $output['status']= 0 ;  
        
            }
        }
        echo json_encode($output);
  
    }

    public function editproductform()
    {
        //echo "hello";
        $id = $_GET['id'];
        $data['categories'] = $this->common_model->GetAllData('categories',array('parent'=>0),'id','desc');
        $data['product'] = $this->common_model->GetSingleData('product',array('id'=>$id));
        return view('admin/edit-product',$data);
    }

    public function updateproduct()
    {
        $this->validation->setRule('title','Title','trim|required');
       // $this->validation->setRule('description','Description','trim|required');
        $this->validation->setRule('category','Category','trim|required');
        $this->validation->setRule('subcategory','SubCategory','trim|required');
        $this->validation->setRule('format','Format','trim|required');
        //$this->validation->setRule('release_date','release_date','trim|required');
        $this->validation->setRule('price','Price','trim|required');
        $this->validation->setRule('brand','Brand','trim|required');
        $this->validation->setRule('class_type','class_type','trim|required');
       // $this->validation->setRule('product_group','product_group','trim|required');
        if($this->validation->withRequest($this->request)->run()==false)
        {
   
            $output['message']=$this->validation->getErrors();
            $output['status']= 0 ;       
        }

        else
        {
       // echo "hello";die;
            $id = $this->request->getVar('id');
            $insert['title']= $this->request->getVar('title');
            $insert['description']= $this->request->getVar('description');
            $insert['category']= $this->request->getVar('category');
            $insert['subcategory']= $this->request->getVar('subcategory');
            $insert['format']= $this->request->getVar('format');
            $insert['ram']= $this->request->getVar('ram');
            $insert['release_date']= $this->request->getVar('release_date');
            $insert['base_price']= $this->request->getVar('price');
            $insert['brand']= $this->request->getVar('brand');
            $insert['class_type']= $this->request->getVar('class_type');
             $insert['video_type'] = $this->request->getVar('video_type');
            $insert['youtube_url'] = $this->request->getVar('youtube_url');
            $insert['conditions'] = $this->request->getVar('conditions');
            $insert['product_group']= isset($_POST['product_group']) ? implode(',', $this->request->getVar('product_group')) : '';
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
            if(isset($_POST['stock']) && !empty($_POST['stock']))
            {
                $insert['stock'] = $_POST['stock'];
            } else {
                $insert['stock'] = 0;
            }
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
            $run = $this->common_model->UpdateData('product',array('id'=>$id),$insert);

       
           /*  if(!empty($_FILES['image']['name']))
           {
                $newName = explode('.',$_FILES['image']['name']);
                $ext = end($newName);
                $fileName = 'assets/product_image/'.rand().time().'.'.$ext;
                move_uploaded_file($_FILES['image']['tmp_name'], $fileName);
                $insert1['image']= $fileName ; 
           }
            $insert1['product_id']= $run;
            $run1 = $this->common_model->InsertData('product_image', $insert1);*/

            //print_r($_FILES['images']['name']);die;
            if($_FILES['images']['name'])
            {


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
            } 
     
          
         //echo $this->db->last_query();die;
            if($run)
            {  
         
                $this->session->setFlashdata('msg', '<div class="alert alert-success">Product has been Updated successfully</div>');
                $output['message']='Product has been Updated successfully' ;
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

    public function deleteproduct()
    {
        //echo "hello";
        $id = $this->request->getVar('id');  
            
        $run = $this->common_model->DeleteData('product',array('id'=>$id));
        if($run)
        {  
            $output['message']='Product has been Deleted successfully' ;
            $output['status']= 1 ;  
            $this->session->setFlashdata('msg', '<div class="alert alert-success">Product has been Deleted successfully</div>');
                                            

        }
        else  {
            
            $output['message']='<div class="alert alert-danger">Something went wrong</div>' ;
            $output['status']= 0 ; 
            
        }
        
        echo json_encode($output);
    }
    public function user_product_list()
    {
        //echo "hello";
        $data['product_list'] = $this->common_model->GetAllData('product',array('created_by!='=>0),'id','desc');
        $data['categories'] = $this->common_model->GetAllData('categories',array('parent'=>0),'id','desc');
        $data['type'] = 'User';
        return view('admin/product-list',$data);
    }

    public function user_requested_product_list()
    {
        //echo "hello";
        $data['product_list'] = $this->common_model->GetAllData('product',array('created_by'=>0 , 'status'=>0),'id','desc');
        $data['categories'] = $this->common_model->GetAllData('categories',array('parent'=>0),'id','desc');
        $data['type'] = 'User Requested';
        return view('admin/product-list',$data);
    }

    public function remove_pimage()
    {
        //echo "hello";
        $id = $this->request->getVar('id');  
            
        $run = $this->common_model->DeleteData('product_image',array('id'=>$id));
        if($run)
        {  
            $output['message']='Product Image has been Removed successfully' ;
            $output['status']= 1 ;  
            $this->session->setFlashdata('msg', '<div class="alert alert-success">Product Image has been Removed successfully</div>');
        }
        else             
        {
            
            $output['message']='<div class="alert alert-danger">Something went wrong</div>' ;
            $output['status']= 0 ; 
            
        }
         
        echo json_encode($output);
    }

    public function markFeature()
    {
        $update['is_featured'] = $this->request->getVar('is_featured'); 
        $id = $this->request->getVar('id'); 
        $run = $this->common_model->UpdateData('product', array('id'=>$id), $update);
        if($run)
        { 
            if($this->request->getVar('is_featured') == 1)
            {
                $output['message']='Product Marked as Featured' ;
                $output['status']= 1 ;
            } else {
                $output['message']='Product Marked as Unfeatured' ;
                $output['status']= 1 ;
            }
            
        } else {
            $output['message']='Something went Wrong' ;
            $output['status']= 0 ;
        }
        echo json_encode($output);
    } 
    public function accept_product() {        
        
        $id = $_POST['id'];
        $update['status'] = 1;
        $run = $this->common_model->UpdateData('product', array('id'=> $id),$update);
        if ($run) {
              
            $this->session->setFlashdata('msg', '<div class="alert alert-success">Product has been Approved successfully.</div>');
            $json['message'] = 'Product has been Approved successfully.';
            $json['status'] = 1;
        } else {
            $json['message'] = 'Error! Something went wrong';
            $json['status'] = 0;
        }
        echo json_encode($json);
    }

    public function sort_grade()
    {

        $sort_by = $_POST['sort_by'];
        $type = $_POST['type'];

        $db      = \Config\Database::connect();
        $builder = $db->table('product');
        $builder->select('product.*' , 'class_type.points');
        $builder->join('class_type', 'class_type.id = product.class_type');
        
        
        if($type == 'Admin') {
            if($sort_by == 1)
            {
                $builder->where('product.created_by', 0);
                $builder->orderBy('class_type.points', 'desc');
                $run = $builder->get()->getResultArray();
            } elseif($sort_by == 0) {
                $builder->where('product.created_by', 0);
                $builder->orderBy('class_type.points', 'asc');
                $run = $builder->get()->getResultArray();
            } else {
                $run = $this->common_model->GetAllData('product',array('created_by'=>0 , 'status'=>0),'id','desc');
            }
        } elseif($type == 'User') {
            if($sort_by == 1)
            {
                $builder->where('product.created_by','!=',0);
                $builder->orderBy('class_type.points', 'desc');
                $run = $builder->get()->getResultArray();
            } elseif($sort_by == 0) {
                $builder->where('product.created_by','!=',0);
                $builder->orderBy('class_type.points', 'asc');
                $run = $builder->get()->getResultArray();
            } else {
                $run = $this->common_model->GetAllData('product',array('created_by!='=>0),'id','desc');
            }
        } elseif($type == 'User Requested')
        {
            if($sort_by == 1)
            {
                $builder->where('product.created_by', 0);
                $builder->where('product.status', 0);
                $builder->orderBy('class_type.points', 'desc');
                $run = $builder->get()->getResultArray();
            } elseif($sort_by == 0) {
                $builder->where('product.created_by', 0);
                $builder->where('product.status', 0);
                $builder->orderBy('class_type.points', 'asc');
                $run = $builder->get()->getResultArray();
            } else {
                $run = $this->common_model->GetAllData('product',array('created_by'=>0 , 'status'=>0),'id','desc');
            }
        }
        
        
        
        $html = '<table id="myTable" class="display dataTable dataTables_wrapper" style="width:100%">
            <thead>
                <tr>
                    <th>S. No.</th>';
                                    
                                    if($type == 'User'){
                                    $html .= '<th>User Name</th>';
                                    }
                                    
                                   $html .= '<th>ProductId</th>
                                    <th>Title</th>
                                    <th>Market Price</th>
                                    <th>Grade</th>
                                    <th>Stocks</th>
                                    <th>Category</th>
                                    <th>SubCategory</th>
                                    <th>format</th>
                                    <th>Release Date</th>
                                    <th>Publishers</th>
                                    <th>Base Price</th>
                                  
                                    <th>Action</th>
                </tr>
            </thead><tbody class="fw-semibold text-gray-600">';
            if($run)
            {
                $j=1;
                foreach($run as $val)
                {
                    $cat = $this->common_model->GetSingleData('categories',array('id'=>$val['category']));
                    $subcat = $this->common_model->GetSingleData('categories',array('id'=>$val['subcategory']));
                    $grade = $this->common_model->GetSingleData('class_type',['id'=>$val['class_type']]); 
                                    
                    
                        $html .= '<tr>';
                        $html .= '<td>'.$j.'</td>';

                         if($type == 'User')
                        {
                            $userdata = $this->common_model->GetSingleData('users',array('id'=>$val['created_by']));
                            $html .= '<td>'.$userdata['first_name'].' '.$userdata['last_name'].'</td>';
                        } 
                        $html .= '<td>'.$val['id'].'</td>';
                        $html .= '<td>'.$val['title'].'</td>';
                        $html .= '<td>'.$val['mkt_price'].'</td>';
                        $html .= '<td>'.$grade['class_name'].'</td>';
                        $html .= '<td>'.$val['stock'].'</td>';
                        $html .= '<td>'.$cat['title'].'</td>';
                        $html .= '<td>'.$subcat['title'].'</td>';
                        $html .= '<td>'.$val['format'].'</td>';
                        $html .= '<td>'.$val['release_date'].'</td>';
                        $html .= '<td>'.getData('brands' , $val['brand'] , 'title').'</td>';
                       
                        $html .= '<td>HKD'.$val['base_price'].'</td>';
                        
                        $html .= '<td>';
                        $html .= '<div style="display:flex">';
                        if($val['status'] == 0) {
                        $html .= '<button class="btn btn-success" id="" onclick="accept_product('.$val['id'].')">Approve</button>';
                        } else {
                        $html .= '<a href="'.base_url().'/Admin/product/editproductform?id='.$val['id'].'" class="btn btn-success" >Edit</a>';
                        }
                                          
                        $html .= '<button class="btn btn-danger" id="delete_btns" onclick="delete_product('.$val['id'].')">Delete</button>
                                <button class="btn btn-primary" data-toggle="modal" data-target="#myviewModal'.$val['id'].'">View</button>
                                            
                                            
                                         
<!-- view modal -->

<div class="modal" id="myviewModal'.$val['id'].'">
    <div class="modal-dialog">
        <div class="modal-content">

        <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Product Details</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

      <!-- Modal body -->
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4">Title</div>
                    <div class="col-md-8"><b>'.$val['title'].'</b></div>
                </div>
                <hr>';
                
                if($type == 'User') {
                $userdata = $this->common_model->GetSingleData('users',['id'=>$val['created_by']]);
                $html .= '<div class="row">
                    <div class="col-md-4">User Name</div>
                    <div class="col-md-8"><b>'.$userdata['first_name']." ".$userdata['last_name'].'</b></div>
                </div>
                  
                <hr>';
                }
                  
                $html .= '<div class="row">
                    <div class="col-md-4">Category</div>
                    <div class="col-md-8"><b>'.$cat['title'].'</b></div>
                </div>
                  
                <hr>
                <div class="row">
                    <div class="col-md-4">SubCategory</div>
                    <div class="col-md-8"><b>'. $subcat['title'].'</b></div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-4">Brand</div>';
                    $b = $this->common_model->GetSingleData('brands', array('id'=>$val['brand']));
                $html .= '<div class="col-md-8"><b>'.$b['title'].'</b></div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-4">Format</div>
                    <div class="col-md-8"><b>'.$val['format'].'</b></div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-4">Release Date</div>
                    <div class="col-md-8"><b>'.$val['release_date'].'</b></div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-4">Price</div>
                    <div class="col-md-8"><b>HKD'.$val['base_price'].'</b></div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-4">Image</div>
                       
                    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">';
                        
                            $product_image = $this->common_model->GetAllData('product_image',array('product_id'=>$val['id']));
                            $i = 0;
                            foreach ($product_image as $key => $pimage) {
                            $i++;
                            
                        $html .= '<div class="carousel-item';
                        if($i == 1) { 
                         $html .=  'active';
                        }
                        $html .= '">
                                <img style="height: 100px;width: 100px;" class="d-block" src="'.base_url($pimage["image"]).'" alt="">
                            </div>';
                            
                            }
                        $html .= '</div>
                        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>   
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- view modal -->
                                            
   
                                           
                                        </div>';
                        $html .= '</td>';
                        $html .= '</tr>';
                    
                   $j++;

                }

            }
            $html .= '</tbody>';
            $html .= '</table>';
            $output['html'] = $html;
        echo json_encode($output);
    }


    public function ImportProducts()
    {

        
        $res['status'] = 0;   
        if(!empty($_FILES['image']['name']))
           {
                $newName = explode('.',$_FILES['image']['name']);
                $ext = end($newName);
                if ($ext != 'csv') {
                    $res['message'] = "<div class='alert alert-danger'>Invalid File</div>";
                    
                    echo json_encode($res);
                    exit;
                }
                $file_name = 'assets/uploads/file_csv.'.$ext;
                move_uploaded_file($_FILES['image']['tmp_name'], $file_name);
                
           }
           else
           {
                $res['message'] = "<div class='alert alert-danger'>Please choose file</div>";
               echo json_encode($res);
               exit;

           }
           
        if(file_exists($file_name)){
            
            // Open uploaded CSV file with read-only mode
            $csvFile = fopen($file_name, 'r');
           
            // Skip the first line
            // fgetcsv($csvFile);
           
             $i = 0;
            // Parse data from CSV file line by line
            while(($line = fgetcsv($csvFile)) !== FALSE){
                // Get row data
                if($i == 0)
                {
                    $keys = $line;
                    $i++;
                    continue;
                }
                $j = 1;
                foreach($keys as $num => $head)
                {

                    if ($j == 2) 
                    {
                        $where['id'] = $line[$num];
                    }
                    elseif($j == 3) 
                    {
                        $insert['title'] = $line[$num];
                    }
                    elseif($j == 4) 
                    {
                        $insert['description'] = $line[$num];
                    }
                    elseif($j == 5) 
                    {
                        $insert['product_group'] = '';
                        if($line[$num])
                        {
                            $g = $this->common_model->GetSingleData('product_group' ,array('title' => $line[$num] ));
                            if($g)
                            {
                                $insert['product_group'] = $g['id'];
                            }
                        }
                        
                    }
                    elseif($j == 6) 
                    {
                        $insert['mkt_price'] = $line[$num];
                    }
                    elseif($j == 7) 
                    {
                        $grade = $this->common_model->GetSingleData('class_type' ,array('class_name' => $line[$num] )) ;
                        $insert['class_type'] = $grade['id'];
                    }
                    elseif($j == 8) 
                    {
                        $insert['game_score'] = $line[$num];
                    }
                    elseif($j == 9) 
                    {
                        $insert['meta_score'] = $line[$num];
                    }
                    elseif($j == 11) 
                    {
                       
                        $insert['category'] = get_cat_id_by_name($line[$num]);
                    }
                    elseif($j == 12) 
                    {
                       
                        $insert['subcategory'] = get_cat_id_by_name($line[$num] , $insert['category']);
                    }
                    elseif($j == 13) 
                    {
                       
                        $insert['format'] = $line[$num];
                    }
                    elseif($j == 14) 
                    {
                        if($line[$num])
                        {

                            $insert['release_date'] = date('Y-m-d' , strtotime($line[$num]));
                        }
                    }
                    elseif($j == 15) 
                    {
                       if(get_brand_id_by_name($line[$num]))
                       {
                        $insert['brand'] = get_brand_id_by_name($line[$num]);
                       }
                        
                    }
                    elseif($j == 16) 
                    {
                       
                        $insert['base_price'] = (int)filter_var($line[$num], FILTER_SANITIZE_NUMBER_INT);;
                    }
                   
                   
                    $j++;
                    
                }

                 $has_product = $this->common_model->GetSingleData('product' , $where );
                 if($has_product)
                 {
                    //print_r($insert);
                    $this->common_model->UpdateData('product' , $where , $insert);
                 }
                 else
                 {
                    $this->common_model->InsertData('product' , $insert);
                 }
                $i++;
            }
            
           
            fclose($csvFile);
            
            $res['message'] = "Products has been Updated successfully";
            $res['status'] = 1;
            $res['data'] = $insert;
        }else
        {
            $res['message'] = "File not found on server";
            $res['status'] = 0;
        }
        echo json_encode($res);
        exit;
        

    }
    public function ImportProducts_new()
    {

        
        $res['status'] = 0;   
        if(!empty($_FILES['image']['name']))
           {
                $newName = explode('.',$_FILES['image']['name']);
                $ext = end($newName);
                if ($ext != 'csv') {
                    $res['message'] = "<div class='alert alert-danger'>Invalid File</div>";
                    
                    echo json_encode($res);
                    exit;
                }
                $file_name = 'assets/uploads/file_csv.'.$ext;
                move_uploaded_file($_FILES['image']['tmp_name'], $file_name);
                
           }
           else
           {
                $res['message'] = "<div class='alert alert-danger'>Please choose file</div>";
               echo json_encode($res);
               exit;

           }
           
        if(file_exists($file_name)){
            
            // Open uploaded CSV file with read-only mode
            $csvFile = fopen($file_name, 'r');
           
            // Skip the first line
            // fgetcsv($csvFile);
           
             $i = 0;
            // Parse data from CSV file line by line
            while(($line = fgetcsv($csvFile)) !== FALSE){
                // Get row data
                if($i == 0)
                {
                    $keys = $line;
                    $i++;
                    continue;
                }
                $j = 1;
                foreach($keys as $num => $head)
                {

                    if ($j == 2) 
                    {
                        $where['id'] = $line[$num];
                    }
                    elseif($j == 4) 
                    {
                        $insert['title'] = $line[$num];
                    }
                    elseif($j == 5) 
                    {
                        $insert['description'] = $line[$num];
                    }
                    
                    elseif($j == 6) 
                    {
                        $insert['game_score'] = $line[$num];
                    }
                    elseif($j == 7) 
                    {
                        $insert['meta_score'] = $line[$num];
                    }
                    elseif($j == 3) 
                    {
                       
                        $insert['category'] = get_cat_id_by_name($line[$num]);
                    }
                    elseif($j == 8) 
                    {
                       
                        $insert['subcategory'] = get_cat_id_by_name($line[$num] , $insert['category']);
                    }
                  
                    elseif($j == 9) 
                    {
                        //print_r($line[$num]);
                        if($line[$num])
                        {
                            $date = \DateTime::createFromFormat('d/m/Y', $line[$num]);
                            //echo $date->format('Y-m-d');
                            if($date)
                            {
                                $insert['release_date'] = $date->format('Y-m-d');
                            }
                            
                        }
                    }
                    elseif($j == 11) 
                    {
                        
                       if(get_brand_id_by_name($line[$num]))
                       {
                        $insert['brand'] = get_brand_id_by_name($line[$num]);
                       }
                        
                    }
                    elseif($j == 12) 
                    {
                       
                        $insert2['image'] = $line[$num];
                       
                        
                    }
                    elseif($j == 15) 
                    {
                       
                        // $video_url = $line[$num]; // assuming this contains the URL of the video
    
                        // // Get the filename from the URL
                        // $file_name = basename($video_url);
                        
                        // // Set the folder path where you want to save the video file
                        // $folder_path = "assets/product_video/";
                        
                        // // Combine the folder path and file name to create the full path of the video file
                        // $full_path = $folder_path . $file_name;
                        
                        // // Download the video file from the URL and save it in the specified folder
                        // file_put_contents($full_path, file_get_contents($video_url));
                        $insert['product_video'] = $line[$num];
                        $insert['video_type'] = 1;
                    }
                   
                   
                    $j++;
                    
                }

                 $has_product = $this->common_model->GetSingleData('product' , $where );
                // print_r($insert);die;
                 if($has_product)
                 {
                    //print_r($insert);
                    $this->common_model->UpdateData('product' , $where , $insert);
                 }
                 else
                 {
                    $id = $this->common_model->InsertData('product' , $insert);
                    
                        $insert2['product_id']=$id;
                        $run1 = $this->common_model->InsertData('product_image', $insert2);
                 }
                $i++;
            }
            
           
            fclose($csvFile);
            
            $res['message'] = "Products has been Updated successfully";
            $res['status'] = 1;
            $res['data'] = $insert;
        }else
        {
            $res['message'] = "File not found on server";
            $res['status'] = 0;
        }
        echo json_encode($res);
        exit;
        

    }
    public function confirm_order()
    {
        $res['status'] =1;
        $res['message'] ='Message ';
        $where['id'] = $_POST['id'];
        $order = $this->common_model->GetSingleData('orders' , $where);
        if($order)
        {
            $where['id'] = $order['sell_product_id'];
            $sell_product = $this->common_model->GetSingleData('sell_product' , $where);
            
            $admin = get_admin();
            $seller = get_user($sell_product['user_id']);
            $product = get_product($sell_product['product_id']);
            $admin_total_from_seller = $sell_product['shipping_fee'] + $sell_product['trans_fee'] + $sell_product['payment_fee'];
            $admin_total_from_buyer = $order['shipping_fee'] + $order['trans_fee'] + $order['payment_fee'];
            $admin_total = $admin_total_from_seller + $admin_total_from_buyer;
            $seller_total = $sell_product['dis_price'];
            $admin_purpose_buyer = "Fees and commission credited for sale of product '".$product['title']."' from Buyer.";
            $admin_purpose_seller = "Fees and commission credited for sale of product '".$product['title']."' from Seller.";
            $seller_purpose = "Payment credited for sale of product '".$product['title'];
            /*Update admin Wallet--------*/
            $this->common_model->UpdateData('admin',array('id'=> 1), array('wallet'=> $admin_total + $admin['wallet']));
            $this->common_model->UpdateData('orders',array('id'=> $order['id']), array('admin_status'=> 1));
            $this->common_model->InsertData('wallet_transactions', array('amount'=> $admin_total_from_seller  , 't_type'=> 1 , 'purpose'=> $admin_purpose_seller ,'user_id'=> 0 ,'created_at'=> date('Y-m-d H:i:s'))); 
            $this->common_model->InsertData('wallet_transactions', array('amount'=> $admin_total_from_buyer  , 't_type'=> 1 , 'purpose'=> $admin_purpose_buyer ,'user_id'=> 0 ,'created_at'=> date('Y-m-d H:i:s'))); 

            /*Update Seller Wallet--------*/
            $this->common_model->UpdateData('users',array('id'=> $seller['id']), array('wallet'=> $seller_total + $seller['wallet']));
            $this->common_model->InsertData('wallet_transactions', array('amount'=> $seller_total  , 't_type'=> 1 ,'purpose'=> $seller_purpose ,'user_id'=> $seller['id'] ,'created_at'=> date('Y-m-d H:i:s')));
            $subject = "Your sale on ".$product['title']." has been approved and funds credited to your wallet";
            $mail_content  = "<p>Dear ".$seller['first_name']." ".$seller['last_name'].",</p>
            <p>We would like to inform you that your sale of the product ".$product['title']." has been approved by our admin team. The total amount of HKD".$seller_total." has been credited to your wallet.</p>
            <p>You can now make a withdrawal request to transfer the funds to your local bank account. Please note that our team will review your request and process it within 7 working days.</p>
            <p>Thank you for choosing our platform to sell your products. If you have any questions or concerns, feel free to contact our support team.</p>";
            $send = $this->common_model->SendMail($seller['email'],$subject,$mail_content);   
        }   
        echo json_encode($res);
    }
}