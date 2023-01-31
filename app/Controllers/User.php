<?php

namespace App\Controllers;

class User extends BaseController
{
    public function index(){

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://fetch-api-production.up.railway.app/users',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 60,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));
        
        $response = curl_exec($curl);
        curl_close($curl);
		
        //print_r($response);

        $responseObject = json_decode($response);
        //print_r($responseObject);


		if($responseObject->code =="00"){
            $data['users'] = $responseObject->data;
        } else {
            $session->setFlashdata('msg', $responseObject->message);
        }

        $data['user_email'] = session()->get('email');
        $this->template('user/list', $data); 
    }

}
