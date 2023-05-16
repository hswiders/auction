<?php 

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Faq_Management extends BaseController {

	public function __construct() {   
        helper(['form', 'url']);
        $this->session = \Config\Services::session();
        return $this->check_login();
        //$this->load->library("upload",$config);
    } 

    public function check_login()
    {
        if (!$this->session->has('admin_id')) {
            header('Location: '.base_url('admin'));
        }
       
    }

    public function faq_list()
    {
        //echo "hello";
        $data['faq_list'] = $this->common_model->GetAllData('faqs','','id','desc');
        return view('admin/faq-list',$data);
    }

 
    

    

    public function addFaq()
    {
        $this->validation->setRule('ques','Question','trim|required');
        $this->validation->setRule('ans','Answer','trim|required');
        
       if($this->validation->withRequest($this->request)->run()==false)
        {
   
            $output['message']=$this->validation->getErrors();
            $output['status']= 0 ;       
        }

        else
        {
       
            $insert['ques']= $this->request->getVar('ques');
            $insert['ans']= $this->request->getVar('ans');
            
            $insert['created_at'] =date('Y-m-d H:i:s');
            $run = $this->common_model->InsertData('faqs', $insert);

            if($run)
            {  
         
                $this->session->setFlashdata('msg', '<div class="alert alert-success">FAQS has been added successfully</div>');
                $output['message']='FAQS has been added successfully' ;
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

  public function editFaq()
    {
        $this->validation->setRule('ques','Question','trim|required');
        $this->validation->setRule('ans','Answer','trim|required');
        
        

        if($this->validation->withRequest($this->request)->run()==false)
        {
   
            $output['message']=$this->validation->getErrors();
            $output['status']= 0 ;       
        }

        else
        {
       
            $id = $this->request->getVar('id');
            $insert['ques']= $this->request->getVar('ques');
            $insert['ans']= $this->request->getVar('ans');
            
        
            $insert['updated_at'] =date('Y-m-d H:i:s');
            $run = $this->common_model->UpdateData('faqs',array('id'=>$id),$insert);

       
            if($run)
            {  
         
                $this->session->setFlashdata('msg', '<div class="alert alert-success">FAQS has been Updated successfully</div>');
                $output['message']='FAQS has been Updated successfully' ;
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

    public function deleteFaq()
    {
        //echo "hello";
        $id = $this->request->getVar('id');  
            
        $run = $this->common_model->DeleteData('faqs',array('id'=>$id));
        if($run)
        {  
            $output['message']='FAQS has been Deleted successfully' ;
            $output['status']= 1 ;  
            $this->session->setFlashdata('msg', '<div class="alert alert-success">FAQS has been Deleted successfully</div>');
                                            

        }
        else  {
            
            $output['message']='<div class="alert alert-danger">Something went wrong</div>' ;
            $output['status']= 0 ; 
            
        }
        
        echo json_encode($output);
    }
    
    

    
}