<?php

namespace App\Controllers;

class Pages extends BaseController
{
    public function __construct()
    {
        $this->session = \Config\Services::session();
        helper(['form', 'url']);
    }
    public function terms()
    {
        return view('terms');
    }
    public function warrenty_refund()
    {
        // $data['products'] = $this->news->where('id',$id)->first();
        return view('warrenty-and-refund');
    }
}
