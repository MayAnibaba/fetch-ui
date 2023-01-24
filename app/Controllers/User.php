<?php

namespace App\Controllers;

class User extends BaseController
{
    public function index(){
        //helper(['form']);
        return view('login');
    }

}
