<?php

namespace App\Controllers;

class Transaction extends BaseController
{
    public function index(){
        $config = new \Config\AppConfig();

        $client = \Config\Services::curlrequest();
        $response = $client->get($config->backendUrl.'transactions');

        $responseObject = json_decode($response->getBody());

		if($responseObject->code =="00"){
            $data['transactions'] = $responseObject->data;
        } else {
            $session->setFlashdata('msg', $responseObject->message);
        }

        $data['user_email'] = session()->get('email');
        $this->template('transaction/list', $data); 
    }

    public function view(){
        $config = new \Config\AppConfig();

        if(isset($_GET['id'])){

            $body = array(
                'transRef' => htmlspecialchars($_GET['id'])
            );

            $client = \Config\Services::curlrequest();
            $response = $client->post($config->backendUrl.'transactions/byTransRef',['json'=>$body]);

            $responseObject = json_decode($response->getBody());
            $data['transaction'] = $responseObject->data;

        } else {
            $data['transaction'] = '';
        }
        
        $data['user_email'] = session()->get('email');
        $this->template('transaction/view', $data); 
    }

}
