<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        //$UserModel = new \App\Models\UserModel();
       //dd($UserModel );
        return view('welcome_message');
    }
   
}
