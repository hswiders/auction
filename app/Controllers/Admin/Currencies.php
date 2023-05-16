<?php 
namespace App\Controllers\Admin;
use App\Controllers\BaseController;
class Currencies extends BaseController {

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

  	public function currencies_management()
    {
        $data['currencies'] = $this->common_model->GetAllData('currency','','id','desc');
        $data['currencies_rate'] = $this->common_model->GetAllData('currency_conversion_rate','','id','desc');
        return view('admin/currencieslist', $data);
    }

  	public function addCurrencies()
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
				
				$run = $this->common_model->InsertData('currency', $insert);
				//$id = $run[0]->id;
		
				if($run)
				{
					
						$this->session->setFlashdata('msg', '<div class="alert alert-success">Currencies has been Added successfully.</div>');
						$output['status']=1;
						$output['message']="Currencies has been Added successfully.";
				}
			} else {
	        	$output['status']= 0 ; 
	            $output["validation"] = $validation->getErrors();
	        }
	    }
		echo json_encode($output);
    }

  	public function editCurrencies()
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
				
				$run = $this->common_model->UpdateData('currency',array('id'=>$id), $update);
				//$id = $run[0]->id;
		
				if($run)
				{
					
						$this->session->setFlashdata('msg', '<div class="alert alert-success">Currencies has been Updated successfully.</div>');
						$output['status']=1;
						$output['message']="Currencies has been Updated successfully.";
				}
			} else {
	        	$output['status']= 0 ; 
	            $output["validation"] = $validation->getErrors();
	        }
	    }
		echo json_encode($output);
    }

    public function edit_conversion_rate()
    {
        helper(['form']);
	    if ($this->request->getMethod() == "post") {
	        $validation =  \Config\Services::validation();

	        $rules = [
	            "rate" => [
	                "label" => "Rate", 
	                "rules" => "required|trim"
	            ],
	           
	            
	        ];

	        if ($this->validate($rules)) {
				
				$id = $_POST['id'];
				$update['rate'] = $_POST['rate'];
		        $run = $this->common_model->UpdateData('currency_conversion_rate',array('id'=>$id), $update);
				//$id = $run[0]->id;
		
				if($run)
				{
					
						$this->session->setFlashdata('msg', '<div class="alert alert-success">Currencies conversion rate has been Updated successfully.</div>');
						$output['status']=1;
						$output['message']="Currencies conversion rate has been Updated successfully.";
				}
			} else {
	        	$output['status']= 0 ; 
	            $output["validation"] = $validation->getErrors();
	        }
	    }
		echo json_encode($output);
    }

    
    public function deleteCurrencies() {        
        
        $id = $_POST['id'];
        $run = $this->common_model->DeleteData('currency', array('id'=> $id));
        if ($run) {
            $json['message'] = 'Success! Currency has been Deleted successfully';
            $json['status'] = 1;
        } else {
            $json['message'] = 'Error! Something went wrong';
            $json['status'] = 0;
        }
        echo json_encode($json);
    }

   
}