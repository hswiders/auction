<?php 
namespace App\Controllers\Admin;
use App\Controllers\BaseController;
class Categories extends BaseController {

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

  	public function categories_management()
    {
        $data['categories'] = $this->common_model->GetAllData('categories',array('parent'=>0),'sorting','asc');
        return view('admin/categorieslist', $data);
    }

  	public function addCategories()
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
				
				$run = $this->common_model->InsertData('categories', $insert);
				//$id = $run[0]->id;
		
				if($run)
				{
					
						$this->session->setFlashdata('msg', '<div class="alert alert-success">Categories has been Added successfully.</div>');
						$output['status']=1;
						$output['message']="Categories has been Added successfully.";
				}
			} else {
	        	$output['status']= 0 ; 
	            $output["validation"] = $validation->getErrors();
	        }
	    }
		echo json_encode($output);
    }

  	public function editCategories()
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
				
				$run = $this->common_model->UpdateData('categories',array('id'=>$id), $update);
				//$id = $run[0]->id;
		
				if($run)
				{
					
						$this->session->setFlashdata('msg', '<div class="alert alert-success">Categories has been Updated successfully.</div>');
						$output['status']=1;
						$output['message']="Categories has been Updated successfully.";
				}
			} else {
	        	$output['status']= 0 ; 
	            $output["validation"] = $validation->getErrors();
	        }
	    }
		echo json_encode($output);
    }

    
    public function deleteCategories() {        
        
        $id = $_POST['id'];
        $run = $this->common_model->DeleteData('categories', array('id'=> $id));
        if ($run) {
            $json['message'] = 'Success! Categories has been Deleted successfully';
            $json['status'] = 1;
        } else {
            $json['message'] = 'Error! Something went wrong';
            $json['status'] = 0;
        }
        echo json_encode($json);
    }

    public function subcategories_management()
    {
    	$data['categories'] = $this->common_model->GetAllData('categories',array('parent'=>0),'id','desc');
        $data['subcategories'] = $this->common_model->GetAllData('categories',array('parent!='=>0),'id','desc');
        return view('admin/subcategorieslist', $data);
    }

    public function addsubcat()
    {
        //echo "hello";die;
       
        $this->validation->setRule('title','Title','trim|required');
        //$this->validation->setRule('title','Title','trim|required|is_unique[categories.title]');
        $this->validation->setRule('category','Category','trim|required');
       
	if($this->validation->withRequest($this->request)->run()==false)
        {
       
            $output['message']=$this->validation->getErrors();
            $output['status']= 0 ;       
        }
    
        else
        {
           // echo "hello";die;
            $check = $this->common_model->GetSingleData('categories', ['title'=>$_POST['title'],'parent'=>$_POST['category']]);
            //print_r($check); die;
            if(!$check)
            {
                $insert['title']= $this->request->getVar('title');
                $insert['parent']= $this->request->getVar('category');
                $insert['created_at'] =date('Y-m-d H:i:s');
                $run = $this->common_model->InsertData('categories', $insert);

                if($run)
                {  
                 
                    $this->session->setFlashdata('msg', '<div class="alert alert-success">Sub Category has been added successfully</div>');
                    $output['message']='Sub Category has been added successfully' ;
                    $output['status']= 1 ;                               

                }
                else 
                {
                
                    $output['message']='<div class="alert alert-danger">Something went wrong</div>' ;
                    $output['status']= 0 ;  
                
                }
            } else {
                $output['msg']='<div class="alert alert-danger">This Subcategory already exist for this category</div>' ;
                $output['status']= 0 ; 
            }
           
         }
         echo json_encode($output);
      
    }

    public function editSubCategories()
    {
       $this->validation->setRule('title','Title','trim|required');
       $this->validation->setRule('category','Category','trim|required');
       
        if($this->validation->withRequest($this->request)->run()==false)
        {
            $output['message']=$this->validation->getErrors();
            $output['status']= 0 ;       
        }
        else
        {
            $id = $this->request->getVar('id');
            $update['title']= $this->request->getVar('title');  
            $update['parent']= $this->request->getVar('category');  
            $check = $this->common_model->GetSingleData('categories', ['id!='=> $id, 'title'=>$this->request->getVar('title'), 'parent'=>$_POST['category']]);
            if($check){
                $output['message']['title']="The Subcategory Name field must contain a unique value.";
                $output['status']= 0 ;  
            }else{
                $run = $this->common_model->UpdateData('categories',array('id'=>$id), $update);
                if($run){  
                    $this->session->setFlashdata('msg', '<div class="alert alert-success">Sub Category has been updated successfully</div>');
                    $output['message']='Sub Category has been updated successfully' ;
                    $output['status']= 1 ;                               
                }
                else 
                {
                    $output['message']='<div class="alert alert-danger">Something went wrong</div>' ;
                    $output['status']= 0 ;  
                }
            }
        }
         echo json_encode($output);
    }

    public function deleteSubCategories() {        
        
        $id = $_POST['id'];
        $run = $this->common_model->DeleteData('categories', array('id'=> $id));
        if ($run) {
            $json['message'] = 'Success! SubCategories has been Deleted successfully';
            $json['status'] = 1;
        } else {
            $json['message'] = 'Error! Something went wrong';
            $json['status'] = 0;
        }
        echo json_encode($json);
    }

    public function social_management()
    {
        $data['social'] = $this->common_model->GetSingleData('social',array('id'=>1));
        return view('admin/social-links', $data);
    }

    public function update_social()
    {
       
        $id = $this->request->getVar('id');
        $update['facebook']= $this->request->getVar('facebook');  
        $update['twitter']= $this->request->getVar('twitter');  
        $update['linkedin']= $this->request->getVar('linkedin');  
        $update['youtube']= $this->request->getVar('youtube');  
        $update['whatsapp']= $this->request->getVar('whatsapp');  
        $update['footer_about']= $this->request->getVar('footer_about');  
        
        $run = $this->common_model->UpdateData('social',array('id'=>$id), $update);
        if($run)
        {  
            $this->session->setFlashdata('msg', '<div class="alert alert-success">Social Links has been updated successfully</div>');
            $output['message']='Social Links has been updated successfully' ;
            $output['status']= 1 ;                               
        }
        else 
        {
            $output['message']='<div class="alert alert-danger">Something went wrong</div>' ;
            $output['status']= 0 ;  
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
   
}