<?php

namespace App\Controllers;

class User extends BaseController
{
    public function index(){
        $config = new \Config\AppConfig();

        $client = \Config\Services::curlrequest();
        $response = $client->get($config->backendUrl.'users');

        $responseObject = json_decode($response->getBody());

		if($responseObject->code =="00"){
            $data['users'] = $responseObject->data;
        } else {
            $session->setFlashdata('msg', $responseObject->message);
        }

        $data['user_email'] = session()->get('email');
        $this->template('user/list', $data); 
    }

}
