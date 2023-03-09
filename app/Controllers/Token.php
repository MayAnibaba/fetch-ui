<?php

namespace App\Controllers;

class Token extends BaseController
{
    public function create(){

        //print_r($_GET);
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
                //$secretKey = 'sk_test_45213c0b37221dc3a914a01a3ebace00f47f82c2';
                $secretKey = 'sk_live_caba5bab937b62f7d7f367b0b5ac8951674e9257';
                $Transaction = new \Matscode\Paystack\Transaction( $secretKey );
                $response = $Transaction
                            ->setCallbackUrl(base_url().'/callback') // to override/set callback_url, it can also be set on your dashboard 
                            ->setEmail( $responseObject->data->email, )
                            ->setAmount( 50 ) // amount is treated in Naira while using this method
                            ->initialize();

                $data['paystack_url'] = $response->authorizationUrl;
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

        $secretKey = 'sk_test_45213c0b37221dc3a914a01a3ebace00f47f82c2';
        if($_GET['reference']){

            $curl = curl_init();
            $paystack_reference = htmlspecialchars($_GET['reference']);
  
            curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.paystack.co/transaction/verify/$paystack_reference",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "Authorization: Bearer $secretKey",
                "Cache-Control: no-cache",
            ),
            ));
            
            $paystackresponse = curl_exec($curl);
            $paystackerr = curl_error($curl);
            //print_r($paystackresponse);
        
            curl_close($curl);
            
            if ($paystackerr) {
                $data['success'] = false;
                $data['message'] = "cURL Error #:" . $paystackerr;

            } else {


                $paystackResponseObject = json_decode($paystackresponse);
                //print_r($paystackresponse);

                $cardExpiry  = $paystackResponseObject->data->authorization->exp_year . '-' . $paystackResponseObject->data->authorization->exp_month . '-28';

                curl_setopt_array($curl, array(
                    CURLOPT_URL => 'https://fetch-api-production.up.railway.app/tokens/create',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_TIMEOUT => 60,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS =>'{
                        "token":"'.$paystackResponseObject->data->authorization->authorization_code.'","email":"'.$paystackResponseObject->data->customer->email.'","tokenExpiry":"'.$cardExpiry.'","data":"'. htmlspecialchars($paystackresponse).'"}',
                    CURLOPT_HTTPHEADER => array('Content-Type: application/json'),
                ));
                
                $backendresponse = curl_exec($curl);
                curl_close($curl);

                $backendResponseObject = json_decode($backendresponse);
                //print_r($backendResponseObject);

                if($backendResponseObject->code == '00'){
                    $data['success'] = true;
                    $data['response'] = $paystackResponseObject;
                } else {
                    $data['success'] = false;
                    $data['response'] = $paystackResponseObject;
                }
                
            }

            return view('token/callback', $data);
        } else {

            return view('token/callback', $data);
        }

    }

}
