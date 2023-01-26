<?php

namespace App\Controllers;

class Token extends BaseController
{
    public function create(){

        

        $secretKey = 'sk_test_45213c0b37221dc3a914a01a3ebace00f47f82c2';
        // creating the transaction object
        $Transaction = new \Matscode\Paystack\Transaction( $secretKey );
        $data = 
        [
            'email'  => 'customer@email.com',
            'amount' => 500000 // amount is treated in kobo using this method
        ];
        $response = $Transaction->initialize($data);

        print_r($response);
        return view('token/create', );
    }

    public function call_back(){

        
    }

}
