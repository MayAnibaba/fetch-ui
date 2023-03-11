<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(){
        //helper(['form']);
        return view('login');
    }

    public function login(){
        $session = session();

        $body = array(
            'email' => htmlspecialchars($_POST['email']),
            'password' => htmlspecialchars($_POST['password'])
        );

        $client = \Config\Services::curlrequest();
        $response = $client->post('https://fetch-api-production.up.railway.app/users/login',['json'=>$body]);

        $responseObject = json_decode($response->getBody());
        //print_r($responseObject);

		if($responseObject->code =="00"){

            $ses_data = [
                'id' => $responseObject->data->id,
                'email' => $responseObject->data->email,
                'isLoggedIn' => TRUE
            ];
            $session->set($ses_data);
   
            return redirect()->to('/dashboard');
        } else {
            $session->setFlashdata('msg', $responseObject->message);
            return redirect()->to('/');
        }
    }

    public function logout(){
        session();
        session_destroy();
        return redirect()->to('/');
    }

    public function dashboard(){
        $session = session();

        $client = \Config\Services::curlrequest();
        $response = $client->post('https://fetch-api-production.up.railway.app/dashboard');

        $responseObject = json_decode($response->getBody());

        $data['dashboard'] = $responseObject;
        $data['user_email'] = session()->get('email');
        $this->template('dashboard', $data); 

    }
}
