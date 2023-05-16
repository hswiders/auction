<?php 
namespace App\Controllers\Admin;
use App\Controllers\BaseController;
class Brand extends BaseController {

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

  	public function brand_list()
    {
        $data['brand'] = $this->common_model->GetAllData('brands','','id','desc');
        return view('admin/brand-list', $data);
    }

  	public function addBrand()
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

				if(isset($_FILES['images']['name'])){
          
                
                    $name_array = explode('.',$_FILES['images']['name']);
                    $ext = end($name_array);
                    $new_name = rand().time().'.'.$ext;
            
                    $tmp_name = $_FILES["images"]["tmp_name"];
                    $path = 'assets/uploads/'.$new_name;
            
                    if(move_uploaded_file($tmp_name,$path)){
                        $insert['image']=$path;
                    }
                
            	} 
				
				$run = $this->common_model->InsertData('brands', $insert);
				//$id = $run[0]->id;
		
				if($run)
				{
					
						$this->session->setFlashdata('msg', '<div class="alert alert-success">Brand has been Added successfully.</div>');
						$output['status']=1;
						$output['message']="Brand has been Added successfully.";
				}
			} else {
	        	$output['status']= 0 ; 
	            $output["validation"] = $validation->getErrors();
	        }
	    }
		echo json_encode($output);
    }

  	public function editBrand()
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

				if(isset($_FILES['images']['name'])){
          
                
                    $name_array = explode('.',$_FILES['images']['name']);
                    $ext = end($name_array);
                    $new_name = rand().time().'.'.$ext;
            
                    $tmp_name = $_FILES["images"]["tmp_name"];
                    $path = 'assets/uploads/'.$new_name;
            
                    if(move_uploaded_file($tmp_name,$path)){
                        $update['image']=$path;
                    }
                
            	} 
				
				$run = $this->common_model->UpdateData('brands',array('id'=>$id), $update);
				//$id = $run[0]->id;
		
				if($run)
				{
					
						$this->session->setFlashdata('msg', '<div class="alert alert-success">Brand has been Updated successfully.</div>');
						$output['status']=1;
						$output['message']="Brand has been Updated successfully.";
				}
			} else {
	        	$output['status']= 0 ; 
	            $output["validation"] = $validation->getErrors();
	        }
	    }
		echo json_encode($output);
    }

    
    public function deleteBrand() {        
        
        $id = $_POST['id'];
        $run = $this->common_model->DeleteData('brands', array('id'=> $id));
        if ($run) {
            $json['message'] = 'Success! Brand has been Deleted successfully';
            $json['status'] = 1;
        } else {
            $json['message'] = 'Error! Something went wrong';
            $json['status'] = 0;
        }
        echo json_encode($json);
    }
   
}