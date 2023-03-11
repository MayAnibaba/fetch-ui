<?php

namespace App\Controllers;

class Token extends BaseController
{
    public function create(){
        $config = new \Config\AppConfig();

        if(isset($_GET['id'])){

            $body = array(
                'loanRef' => htmlspecialchars($_GET['id'])
            );
    
            $client = \Config\Services::curlrequest();
            $response = $client->post($config->backendUrl.'users/loans/byLoanRef',['json'=>$body]);
    
            $responseObject = json_decode($response->getBody());

            if($responseObject->code =="00"){
                //paystack transaction initialize
                $Transaction = new \Matscode\Paystack\Transaction( $config->paystackPrivateKey );
                $response = $Transaction
                            ->setCallbackUrl(base_url().'/callback') 
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
        $config = new \Config\AppConfig();
        sleep(5); // wait for data to come in

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
                "Authorization: Bearer $config->paystackPrivateKey",
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



                $body = array(
                    'token' => $paystackResponseObject->data->authorization->authorization_code,
                    'email' => $paystackResponseObject->data->customer->email,
                    'tokenExpiry' => $cardExpiry,
                    'data' => htmlspecialchars($paystackresponse)
                );

                $client = \Config\Services::curlrequest();
                $backEndResponse = $client->post($config->backendUrl.'tokens/create',['json'=>$body]);
                

                $backendResponseObject = json_decode($backEndResponse->getBody());
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
