<?php
use App\Models\Common_model;

$this->session = \Config\Services::session();
$this->common_model = new Common_model();
$this->db = \Config\Database::connect(); 
if(!function_exists('checkConnections')){
    function checkConnections($user_id){
         
         echo 'hello';
       return $this->common_model->GetSingleData('users' , array('id'=> $user_id));
    }
}