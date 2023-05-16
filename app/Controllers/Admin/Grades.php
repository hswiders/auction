<?php 
namespace App\Controllers\Admin;
use App\Controllers\BaseController;
class Grades extends BaseController {

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

  	public function grade_rates()
    {
        $data['grade_rates'] = $this->common_model->GetAllData('grade_rates','','id','desc');
        $data['grade_cat'] = $this->common_model->GetAllData('class_type','','id','asc');
        return view('admin/grade_rates', $data);
    }

  	public function add_grade_rates()
    {
        helper(['form']);
	    if ($this->request->getMethod() == "post") {
	        $validation =  \Config\Services::validation();

	        $rules = [
	            "grade_from" => [
	                "label" => "grade_from", 
	                "rules" => "required|trim"
	            ],
                "grade_to" => [
                    "label" => "grade_to", 
                    "rules" => "required|trim"
                ],
                "rate" => [
                    "label" => "rate", 
                    "rules" => "required|trim"
                ],
	            
	        ];

	        if ($this->validate($rules)) {
				$insert['grade_from'] = $_POST['grade_from'];
                $insert['grade_to'] = $_POST['grade_to'];
                $check = $this->common_model->GetSingleData('grade_rates', $insert);
                if ($check) {
                    $output['status']= 0 ; 
                    $output["validation"] = ['message' => 'This combination already exist'];
                    echo json_encode($output);
                    exit;
                }
                $insert['rate'] = $_POST['rate'];
				$insert['created_at'] = date('Y-m-d');
				
				$run = $this->common_model->InsertData('grade_rates', $insert);
				//$id = $run[0]->id;
		
				if($run)
				{
					
						$this->session->setFlashdata('msg', '<div class="alert alert-success">Grade rate has been Added successfully.</div>');
						$output['status']=1;
						$output['message']="Grade rate has been Added successfully.";
				}
			} else {
	        	$output['status']= 0 ; 
	            $output["validation"] = $validation->getErrors();
	        }
	    }
		echo json_encode($output);
    }

  	public function edit_grade_rates()
    {
        helper(['form']);
	    if ($this->request->getMethod() == "post") {
	        $validation =  \Config\Services::validation();

	        $rules = [
                "grade_from" => [
                    "label" => "grade_from", 
                    "rules" => "required|trim"
                ],
                "grade_to" => [
                    "label" => "grade_to", 
                    "rules" => "required|trim"
                ],
                "rate" => [
                    "label" => "rate", 
                    "rules" => "required|trim"
                ],
                
            ];

	        if ($this->validate($rules)) {
				
				$id = $_POST['id'];
				$insert['grade_from'] = $_POST['grade_from'];
                $insert['grade_to'] = $_POST['grade_to'];
                $check = $this->common_model->GetSingleData('grade_rates', ['grade_from' => $_POST['grade_from'] , 'grade_to' => $_POST['grade_to'] , 'id !=' => $id ]);
                if ($check) {
                    $output['status']= 0 ; 
                    $output["validation"] = ['message'.$id => 'This combination already exist'];
                    echo json_encode($output);
                    exit;
                }
                $insert['rate'] = $_POST['rate'];
                $insert['updated_at'] = date('Y-m-d');
				
				$run = $this->common_model->UpdateData('grade_rates',array('id'=>$id), $insert);
				//$id = $run[0]->id;
		
				if($run)
				{
					
						$this->session->setFlashdata('msg', '<div class="alert alert-success">Grade rate has been Updated successfully.</div>');
						$output['status']=1;
						$output['message']="Grade rate has been Updated successfully.";
				}
			} else {
	        	$output['status']= 0 ; 
	            $output["validation"] = $validation->getErrors();
	        }
	    }
		echo json_encode($output);
    }

    
    public function delete_grade_rates() {        
        
        $id = $_POST['id'];
        $run = $this->common_model->DeleteData('grade_rates', array('id'=> $id));
        if ($run) {
            $json['message'] = 'Success! Grade rate has been Deleted successfully';
            $json['status'] = 1;
        } else {
            $json['message'] = 'Error! Something went wrong';
            $json['status'] = 0;
        }
        echo json_encode($json);
    }

  public function grade_list()
    {
        $data['grade_list'] = $this->common_model->GetAllData('class_type','','id','desc');
        return view('admin/grade_list', $data);
    }

  public function add_grade()
    {
        helper(['form']);
        if ($this->request->getMethod() == "post") {
            $validation =  \Config\Services::validation();

            $rules = [
                "class_name" => [
                    "label" => "Class Name", 
                    "rules" => "required|trim|is_unique[class_type.class_name]',array('is_unique' =>'This class name already exit')"
                ],
                "bg_color" => [
                    "label" => "Background Color", 
                    "rules" => "required|trim"
                ],
                "text_color" => [
                    "label" => "Text Color", 
                    "rules" => "required|trim"
                ],
                "points" => [
                    "label" => "Points", 
                    "rules" => "required|trim"
                ],
                
            ];

            if ($this->validate($rules)) {


                $insert['class_name'] = $_POST['class_name'];
                $insert['bg_color'] = $_POST['bg_color'];
                $insert['text_color'] = $_POST['text_color'];
                $insert['points'] = $_POST['points'];
                $insert['created_at'] = date('Y-m-d H:i:s');
                
                $run = $this->common_model->InsertData('class_type', $insert);
                //$id = $run[0]->id;
        
                if($run)
                {
                    
                        $this->session->setFlashdata('msg', '<div class="alert alert-success">Grade has been Added successfully.</div>');
                        $output['status']=1;
                        $output['message']="Grade has been Added successfully.";
                }
            } else {
                $output['status']= 0 ; 
                $output["validation"] = $validation->getErrors();
            }
        }
        echo json_encode($output);
    }

    public function edit_grade()
    {
        helper(['form']);
        if ($this->request->getMethod() == "post") {
            $validation =  \Config\Services::validation();

            $rules = [
                "class_name" => [
                    "label" => "Class Name", 
                    "rules" => "required|trim"
                ],
                "bg_color" => [
                    "label" => "Background Color", 
                    "rules" => "required|trim"
                ],
                "text_color" => [
                    "label" => "Text Color", 
                    "rules" => "required|trim"
                ],
                "points" => [
                    "label" => "Points", 
                    "rules" => "required|trim"
                ],
                
            ];

            if ($this->validate($rules)) {
                
                $id = $_POST['id'];
                $check = $this->common_model->GetSingleData('class_type', ['class_name' => $_POST['class_name'] , 'id !=' => $id ]);
                if ($check) {
                    $output['status']= 0 ; 
                    $output["validation"] = ['message'.$id => 'This class name already exist'];
                    echo json_encode($output);
                    exit;
                }
                $insert['class_name'] = $_POST['class_name'];
                $insert['bg_color'] = $_POST['bg_color'];
                $insert['text_color'] = $_POST['text_color'];
                $insert['points'] = $_POST['points'];
                $insert['updated_at'] = date('Y-m-d');
                
                $run = $this->common_model->UpdateData('class_type',array('id'=>$id), $insert);
                //$id = $run[0]->id;
        
                if($run)
                {
                    
                        $this->session->setFlashdata('msg', '<div class="alert alert-success">Grade has been Updated successfully.</div>');
                        $output['status']=1;
                        $output['message']="Grade has been Updated successfully.";
                }
            } else {
                $output['status']= 0 ; 
                $output["validation"] = $validation->getErrors();
            }
        }
        echo json_encode($output);
    }
    public function delete_grade() {        
        
        $id = $_POST['id'];
        $run = $this->common_model->DeleteData('class_type', array('id'=> $id));
        if ($run) {
            $json['message'] = 'Success! Grade  has been Deleted successfully';
            $json['status'] = 1;
        } else {
            $json['message'] = 'Error! Something went wrong';
            $json['status'] = 0;
        }
        echo json_encode($json);
    }

    public function step_charges()
    {
        $data['steps'] = $this->common_model->GetAllData('step_charge','','id','asc');
        return view('admin/step-charge-list', $data);
    }

    public function edit_step_charge()
    {
        
        $validation =  \Config\Services::validation();

        $rules = [
            "step" => [
                "label" => "Step", 
                "rules" => "required|trim"
                ],
            "charge" => [
                "label" => "Charge", 
                "rules" => "required|trim"
            ],
                
        ];

        if ($this->validate($rules)) {
            $update['step'] = $this->request->getVar('step');
            $update['charge'] = $this->request->getVar('charge');
            $id = $this->request->getVar('id');
            $run = $this->common_model->UpdateData('step_charge',['id'=>$id], $update);
            if($run)
            {
                $this->session->setFlashdata('msg', '<div class="alert alert-success">Step Charges has been Updated successfully.</div>');
                $output['status']=1;
                $output['message']="Step Charges has been Updated successfully.";
            } else {
                $output['status']=0;
                $output['message']="Something went wrong.";
            }
        } else {
            $output['status']= 0 ; 
            $output["validation"] = $validation->getErrors();
        }
        echo json_encode($output);
    }

   
}