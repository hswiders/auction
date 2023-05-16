<?php 
namespace App\Controllers\Admin;
use App\Controllers\BaseController;
class ProductGroup extends BaseController {

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

  	public function product_group_management()
    {
        $data['product_group'] = $this->common_model->GetAllData('product_group','','sorting','asc');
        return view('admin/product_grouplist', $data);
    }

  	public function addProductGroup()
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
				
				$run = $this->common_model->InsertData('product_group', $insert);
				//$id = $run[0]->id;
		
				if($run)
				{
					
						$this->session->setFlashdata('msg', '<div class="alert alert-success">ProductGroup has been Added successfully.</div>');
						$output['status']=1;
						$output['message']="ProductGroup has been Added successfully.";
				}
			} else {
	        	$output['status']= 0 ; 
	            $output["validation"] = $validation->getErrors();
	        }
	    }
		echo json_encode($output);
    }

  	public function editProductGroup()
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
				
				$run = $this->common_model->UpdateData('product_group',array('id'=>$id), $update);
				//$id = $run[0]->id;
		
				if($run)
				{
					
						$this->session->setFlashdata('msg', '<div class="alert alert-success">ProductGroup has been Updated successfully.</div>');
						$output['status']=1;
						$output['message']="ProductGroup has been Updated successfully.";
				}
			} else {
	        	$output['status']= 0 ; 
	            $output["validation"] = $validation->getErrors();
	        }
	    }
		echo json_encode($output);
    }

    
    public function deleteProductGroup() {        
        
        $id = $_POST['id'];
        $run = $this->common_model->DeleteData('product_group', array('id'=> $id));
        if ($run) {
            $json['message'] = 'Success! ProductGroup has been Deleted successfully';
            $json['status'] = 1;
        } else {
            $json['message'] = 'Error! Something went wrong';
            $json['status'] = 0;
        }
        echo json_encode($json);
    }
    public function hide_show_group() {        
        
        $id = $_POST['id'];
        $run = $this->common_model->UpdateData('product_group', array('id'=> $id) , ['status' => $_POST['status']]);
        if ($run) {
            $json['message'] = 'Success! ProductGroup has been changed successfully';
            $json['status'] = 1;
        } else {
            $json['message'] = 'Error! Something went wrong';
            $json['status'] = 0;
        }
        echo json_encode($json);
    }
     public function Sorting(){
        $i = 0;
        $data = explode(',', $_POST['data']);
        foreach ($data as $value) {
            $insert['sorting'] = $i;
            $where['id'] = $value;
            $run = $this->common_model->UpdateData('product_group',$where , $insert);
            $i++;
        }
            
        
    }



   
}