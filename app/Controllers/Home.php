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
        helper(['curl']);
        //$userModel = new UserModel();
        $email = $_POST['email'];
        $password = $_POST['password'];
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://localhost:3000/users/login',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 60,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>'{
                "email":"'.$email.'",
                "password":"'.$password.'"}',
            CURLOPT_HTTPHEADER => array('Content-Type: application/json'),
            )
        );
        
        $response = curl_exec($curl);
        curl_close($curl);
		
        //print_r($response);

        $responseObject = json_decode($response);
        print_r($responseObject);


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

        $data['user_email'] = session()->get('email');
        return view('dashboard', $data);
    }
}
