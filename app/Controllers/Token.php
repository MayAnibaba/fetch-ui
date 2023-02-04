<?php

namespace App\Controllers;

class Token extends BaseController
{
    public function create(){

        print_r($_GET);
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
            ));
            
            $response = curl_exec($curl);
            curl_close($curl);
            
            //print_r($response);

            $responseObject = json_decode($response);
            //print_r($responseObject);


            if($responseObject->code =="00"){
                //paystack transaction initialize
                $secretKey = 'sk_test_45213c0b37221dc3a914a01a3ebace00f47f82c2';
                $Transaction = new \Matscode\Paystack\Transaction( $secretKey );
                // $data = 
                // [
                //     'email'  => $responseObject->data->email,
                //     'amount' => 5000 // amount is treated in kobo using this method
                // ];

                $response = $Transaction
                            ->setCallbackUrl(base_url().'callback') // to override/set callback_url, it can also be set on your dashboard 
                            ->setEmail( $responseObject->data->email, )
                            ->setAmount( 5000 ) // amount is treated in Naira while using this method
                            ->initialize();

                //$response = $Transaction->initialize($data);
                $data['paystack_url'] = $response->authorizationUrl;
        
                //print_r($response);
                return view('token/create', $data);

            } else {
                echo "Error wrong ref";
                //$session->setFlashdata('msg', $responseObject->message);
            }

        } else {
            echo "Error no ref";
        }
       
    }

    public function call_back(){
        return view('token/callback');
    }

}
