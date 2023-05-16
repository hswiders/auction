<?php 
namespace App\Controllers\Admin;
use App\Controllers\BaseController;
class SocialLinks extends BaseController {

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

  	public function social_links_management()
    {
        $data['social_links'] = $this->common_model->GetAllData('social_links', '' ,'id','desc');
        $data['social'] = $this->common_model->GetSingleData('social', 'id=1' );
        return view('admin/social-links', $data);
    }

  	public function addSocialLinks()
    {
        helper(['form']);
	    if ($this->request->getMethod() == "post") {
	        $validation =  \Config\Services::validation();

	        $rules = [
	            "title" => [
	                "label" => "Title", 
	                "rules" => "required|trim"
	            ],
                "link" => [
                    "label" => "Link", 
                    "rules" => "required|trim"
                ],
	            
	        ];

	        if ($this->validate($rules)) {
				$insert['title'] = $_POST['title'];
                $insert['link'] = $_POST['link'];

              if(!empty($_FILES['image']['name']))
               {
                    $newName = explode('.',$_FILES['image']['name']);
                    $ext = end($newName);
                    $fileName = 'assets/social_icon/'.rand().time().'.'.$ext;
                    move_uploaded_file($_FILES['image']['tmp_name'], $fileName);
                    $insert['image']= $fileName ; 
               }
			  $insert['created_at'] = date('Y-m-d');
				
				$run = $this->common_model->InsertData('social_links', $insert);
				//$id = $run[0]->id;
		
				if($run)
				{
					
						$this->session->setFlashdata('msg', '<div class="alert alert-success">SocialLinks has been Added successfully.</div>');
						$output['status']=1;
						$output['message']="SocialLinks has been Added successfully.";
				}
			} else {
	        	$output['status']= 0 ; 
	            $output["validation"] = $validation->getErrors();
	        }
	    }
		echo json_encode($output);
    }

  	public function editSocialLinks()
    {
        helper(['form']);
	    if ($this->request->getMethod() == "post") {
	        $validation =  \Config\Services::validation();

	        $rules = [
	            "title" => [
	                "label" => "Title", 
	                "rules" => "required|trim"
	            ],
                "link" => [
                    "label" => "Link", 
                    "rules" => "required|trim"
                ],
	            
	        ];

	        if ($this->validate($rules)) {
				
				$id = $_POST['id'];
				$update['title'] = $_POST['title'];
                $update['link'] = $_POST['link'];
                if(!empty($_FILES['image']['name']))
               {
                    $newName = explode('.',$_FILES['image']['name']);
                    $ext = end($newName);
                    $fileName = 'assets/social_icon/'.rand().time().'.'.$ext;
                    move_uploaded_file($_FILES['image']['tmp_name'], $fileName);
                    $update['image']= $fileName ; 
               }
				
				$run = $this->common_model->UpdateData('social_links',array('id'=>$id), $update);
				//$id = $run[0]->id;
		
				if($run)
				{
					
						$this->session->setFlashdata('msg', '<div class="alert alert-success">SocialLinks has been Updated successfully.</div>');
						$output['status']=1;
						$output['message']="SocialLinks has been Updated successfully.";
				}
			} else {
	        	$output['status']= 0 ; 
	            $output["validation"] = $validation->getErrors();
	        }
	    }
		echo json_encode($output);
    }

    
    public function deleteSocialLinks() {        
        
        $id = $_POST['id'];
        $run = $this->common_model->DeleteData('social_links', array('id'=> $id));
        if ($run) {
            $json['message'] = 'Success! SocialLinks has been Deleted successfully';
            $json['status'] = 1;
        } else {
            $json['message'] = 'Error! Something went wrong';
            $json['status'] = 0;
        }
        echo json_encode($json);
    }

    
    
   
}