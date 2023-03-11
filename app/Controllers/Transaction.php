<?php

namespace App\Controllers;

class Transaction extends BaseController
{
    public function index(){


        $client = \Config\Services::curlrequest();
        $response = $client->get('https://fetch-api-production.up.railway.app/transactions');

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

        if(isset($_GET['id'])){

            $body = array(
                'transRef' => htmlspecialchars($_GET['id'])
            );

            $client = \Config\Services::curlrequest();
            $response = $client->post('https://fetch-api-production.up.railway.app/transactions/byTransRef',['json'=>$body]);

            $responseObject = json_decode($response->getBody());
            $data['transaction'] = $responseObject->data;

        } else {
            $data['transaction'] = '';
        }
        
        $data['user_email'] = session()->get('email');
        $this->template('transaction/view', $data); 
    }

}
