<?php

namespace App\Controllers;

class Loan extends BaseController
{
    public function index(){

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://fetch-api-production.up.railway.app/loans',
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
            $data['loans'] = $responseObject->data;
        } else {
            $session->setFlashdata('msg', $responseObject->message);
        }

        $data['user_email'] = session()->get('email');
        $this->template('loan/list', $data); 
    }


    public function view(){
        if(isset($_GET['id'])){
            $loanRef = htmlspecialchars($_GET['id']);
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://fetch-api-production.up.railway.app/loans/byLoanRef',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_TIMEOUT => 60,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS =>'{
                    "loanRef":"'.$loanRef.'"}',
                CURLOPT_HTTPHEADER => array('Content-Type: application/json'),
                )
            );
            
            $response = curl_exec($curl);
            curl_close($curl); 

            $responseObject = json_decode($response);

            if($responseObject->code =="00"){
                $data['loan'] = $responseObject->data;

                $curl2 = curl_init();

                curl_setopt_array($curl2, array(
                    CURLOPT_URL => 'https://fetch-api-production.up.railway.app/loans/byLoanRef',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_TIMEOUT => 60,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS =>'{
                        "loanRef":"'.$loanRef.'"}',
                    CURLOPT_HTTPHEADER => array('Content-Type: application/json'),
                    )
                );
                
                $response2 = curl_exec($curl2);
                curl_close($curl2); 

                $response2Object = json_decode($response2);

                $data['loanSchedule'] = $response2Object->data;


            } else {
                $session->setFlashdata('msg', $responseObject->message);
            }


        } else {
            $data['loan'] = '';
        }

        $data['user_email'] = session()->get('email');
        $this->template('loan/view', $data); 
    }
}
