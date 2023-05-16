<?php 
namespace App\Controllers\Admin;
use App\Controllers\BaseController;
class Banner extends BaseController {

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

  	public function banner_list()
    {
        $data['banner'] = $this->common_model->GetAllData('banner','','id','desc');
        return view('admin/banner-list', $data);
    }

  	public function addBanner()
    {
        helper(['form']);
	    if ($this->request->getMethod() == "post") {
	        $validation =  \Config\Services::validation();

	        $rules = [
	            "link" => [
	                "label" => "Link", 
	                "rules" => "required|trim"
	            ],
	            
	        ];

	        if ($this->validate($rules)) {
				$insert['link'] = $_POST['link'];
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
				
				$run = $this->common_model->InsertData('banner', $insert);
				//$id = $run[0]->id;
		
				if($run)
				{
					
						$this->session->setFlashdata('msg', '<div class="alert alert-success">Banner has been Added successfully.</div>');
						$output['status']=1;
						$output['message']="Banne has been Added successfully.";
				}
			} else {
	        	$output['status']= 0 ; 
	            $output["validation"] = $validation->getErrors();
	        }
	    }
		echo json_encode($output);
    }

  	public function editBanner()
    {
        helper(['form']);
	    if ($this->request->getMethod() == "post") {
	        $validation =  \Config\Services::validation();

	        $rules = [
	            "link" => [
	                "label" => "link", 
	                "rules" => "required|trim"
	            ],
	            
	        ];

	        if ($this->validate($rules)) {
				
				$id = $_POST['id'];
				$update['link'] = $_POST['link'];

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
				
				$run = $this->common_model->UpdateData('banner',array('id'=>$id), $update);
				//$id = $run[0]->id;
		
				if($run)
				{
					
						$this->session->setFlashdata('msg', '<div class="alert alert-success">Banner has been Updated successfully.</div>');
						$output['status']=1;
						$output['message']="Banner has been Updated successfully.";
				}
			} else {
	        	$output['status']= 0 ; 
	            $output["validation"] = $validation->getErrors();
	        }
	    }
		echo json_encode($output);
    }

    
    public function deleteBanner() {        
        
        $id = $_POST['id'];
        $run = $this->common_model->DeleteData('banner', array('id'=> $id));
        if ($run) {
            $json['message'] = 'Success! Banner has been Deleted successfully';
            $json['status'] = 1;
        } else {
            $json['message'] = 'Error! Something went wrong';
            $json['status'] = 0;
        }
        echo json_encode($json);
    }
    
   public function footer_banner_list()
    {
        $data['banner'] = $this->common_model->GetAllData('footer_banner','','id','desc');
        return view('admin/footer-banner-list', $data);
    }

    public function editfooterBanner()
    {
        helper(['form']);
	    if ($this->request->getMethod() == "post") {
	        $validation =  \Config\Services::validation();

	        $rules = [
	            "link" => [
	                "label" => "link", 
	                "rules" => "required|trim"
	            ],
	            
	        ];

	        if ($this->validate($rules)) {
				
				$id = $_POST['id'];
				$update['link'] = $_POST['link'];

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
				
				$run = $this->common_model->UpdateData('footer_banner',array('id'=>$id), $update);
				//$id = $run[0]->id;
		
				if($run)
				{
					
						$this->session->setFlashdata('msg', '<div class="alert alert-success">Footer Banner has been Updated successfully.</div>');
						$output['status']=1;
						$output['message']="Footer Banner has been Updated successfully.";
				}
			} else {
	        	$output['status']= 0 ; 
	            $output["validation"] = $validation->getErrors();
	        }
	    }
		echo json_encode($output);
    }
}