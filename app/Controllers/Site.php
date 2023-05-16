<?php

namespace App\Controllers;
use App\Models\Common_model;
use App\Models\Search_news;
class Site extends BaseController
{
    public function __construct() {   
        helper(['form', 'url']);
        $this->session = \Config\Services::session();
        $this->common_model = new Common_model();
        $this->search_news = new Common_model();
        $this->db = \Config\Database::connect();
        
        $this->user_id =  $this->session->get('user_id');
        $this->user = $this->common_model->GetSingleData('users', array('id' => $this->user_id));
        return $this->check_login();
    } 
    
    public function check_login()
    {
        if ($this->session->has('user_id')) {
            if($this->user['email_verified']==0)
            {
                header('Location: '.base_url('verification-pending-screen'));
            }          
        }
        else
        {
            header('Location: '.base_url('login'));
        }
       
    }
 

}
