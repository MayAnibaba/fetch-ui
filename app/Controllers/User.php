<?php

namespace App\Controllers;

class User extends BaseController
{
    public function index(){

        $data['user_email'] = session()->get('email');
        $this->template('user/list', $data); 
    }

}
