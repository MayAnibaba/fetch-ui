<?php

namespace App\Controllers;

class Home extends BaseController
{

    public function getBankOneProxy(){
        $session = session();
        $url = $_POST['URl'];
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 60,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array('Content-Type: application/json'),
            )
        );
        
        $response = curl_exec($curl);
        curl_close($curl);
		
        print_r($response);
    }



    public function logout(){
        session();
        session_destroy();
        return redirect()->to('/');
    }

    public function dashboard(){
        $session = session();

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://fetch-api-production.up.railway.app/dashboard',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 60,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
        ));
        
        $response = curl_exec($curl);
        curl_close($curl);

        $responseObject = json_decode($response);
        $data['dashboard'] = $responseObject;
    

        $data['user_email'] = session()->get('email');
        $this->template('dashboard', $data); 
        //return view('dashboard', $data);
    }
}
