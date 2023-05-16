<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Models\Common_model;
class Search_model extends Model {

     public function __construct() {
        //parent::__construct();
       $this->session = \Config\Services::session();
        $this->db = \Config\Database::connect(); 
        $this->email = \Config\Services::email();
        $this->common_model = new Common_model();
        $builder = $this->db->table('users');  
        $this->user_id =  $this->session->get('user_id'); 
        $this->user = $this->common_model->GetSingleData('users', array('id' => $this->user_id));  
    }

    function fetch_filter_type($type)
   {

    $this->builder->distinct();
    $this->builder->select($type);
    $this->builder->where('product_status', '1');
    $query = $builder->get();
    return $query->getResultArray();
   }
   function make_query($data)
   {
    
      $query = "SELECT * FROM product WHERE status=1 ";

      if(isset($data['category']) && !empty($data['category']))
      {
         $query .= "AND (category = '".$data['category']."' OR subcategory = '".$data['category']."') ";
      }
      
      if(isset($data['base_price']) && !empty($data['base_price']))
      {
         //format : 20-40
         
         if ($data['base_price'] != '0;0') 
         {
            $ageData = explode(';', $data['base_price']);
          
            $min = convert_currency($ageData[0]  , 'HKD' , $data['currency']);
            $max = convert_currency($ageData[1]  , 'HKD' , $data['currency']);
           
            $query .= " AND lowest_ask >= ".$min." AND lowest_ask <= ".$max." AND lowest_ask != 0 ";
         }
         
      }
      if(isset($data['sale_price']) && !empty($data['sale_price']))
      {
         //format : 20-40
         
         if ($data['sale_price'] != '0;0') 
         {
            $ageData = explode(';', $data['sale_price']);
            $min = convert_currency($ageData[0]  , 'HKD' , $data['currency']);
            $max = convert_currency($ageData[1]  , 'HKD' , $data['currency']);
            
            $query .= " AND last_sale_price >= ".$min." AND last_sale_price <= ".$max." AND last_sale_price != 0 ";
         }
         
      }

      if(isset($data['brand']) && !empty($data['brand']))
      {
       $brand = $data['brand'];
       $query .= 'AND (';
       foreach ($brand as $key => $value) {
        if (count($brand) == $key +1 ) {
          $query .= " subcategory = '".$value."' ";
        }
        else
        {
         $query .= "subcategory = '".$value."' OR ";
        }
       }
       $query .= ') ';
      }
     

      if(isset($data['search']) && !empty($data['search']))
      {
       $search = $data['search'];
       $query .= "AND (title LIKE '%".$search."%' OR description LIKE '%".$search."%' OR brand IN(select id from brands where title LIKE '%".$search."%') ) ";
      }

      

      return $query;
   }
   function count_all($data)
   {
      $query = $this->make_query($data);
      $data = $this->db->query($query);
      return $data->getNumRows();
   }
   function fetch_data($limit, $start, $data)
   {
      $query = $this->make_query($data);
      if ($data['sortby'] == '') {
         $data['sortby'] = 'lowest_ask=0-asc';
      }
      $orderby = explode('-', $data['sortby']);
      $co = str_replace("=0","",$orderby[0]);

      $query .= ' ORDER BY '.$orderby[0].' '.$orderby[1].' ,'.$co;
      
      $query .= ' LIMIT '.$start.', ' . $limit;
      //return $query;
      
      $col = 3;
      if ($data['viewby'] == 'list') 
      {
         $col = 12;
      }
      $data = $this->db->query($query);
      return view('loop/product', ['products'=>$data->getResultArray() , 'col'=>$col]);
      
    }

}