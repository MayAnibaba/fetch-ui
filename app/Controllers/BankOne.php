<?php

namespace App\Controllers;

class BankOne extends BaseController
{

    public function getBankOneProxy(){
        $session = session();
        $type = $_GET['type'];
        $id = $_GET['id'];

        if($type=='account'){
            $url = "https://api.mybankone.com/BankOneWebAPI/api/Loan/GetLoanByAccountNumber/2?authtoken=c1aaceaa-b1f1-42cf-a2d6-cb8fe02a2fee&loanAccountNumber=".$id."&institutionCode=100781";
        } else {
            $url = "https://api.mybankone.com/BankOneWebAPI/api/Loan/GetLoanRepaymentSchedule/2?authtoken=c1aaceaa-b1f1-42cf-a2d6-cb8fe02a2fee&loanAccountNumber=".$id."&institutionCode=100781";
        }
        
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

        if(curl_errno($curl)){
            $data['response'] = curl_error($curl);
        } else {
            print_r($response);
            $data['response'] = $response;
        }

        curl_close($curl);
        return view('proxy/view', $data);

    }

}
