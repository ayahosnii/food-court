<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Nafezly\Payments\Classes\FawryPayment;
use Nafezly\Payments\Classes\PaymobPayment;

class PaymentController extends Controller
{
    public function payWithFawryView()
    {
        $model = new FawryPayment();
        // Define the data array with the required values
        $data = [
            'fawry_url' => 'https://developer.fawrystaging.com',
            'fawry_merchant' => 'your-merchant-code',
            'payment_id' => 'your-payment-id',
            'user_name' => 'John Doe',
            'user_phone' => '1234567890',
            'user_email' => 'john@example.com',
            'user_id' => 'user-123',
            'amount' => 100.00, // Replace with the actual amount
            'item_quantity' => 1, // Replace with the actual quantity
            'secret' => 'your-secret-key', // Replace with your secret key
        ];

        return view('vendor.payments.html.fawry', compact('data', 'model'));
    }
    public function payWithPaymobView()
    {

        return view('vendor.payments.html.paymob');
    }

    public function payWithFawry(Request $request){
        $payment = new FawryPayment();
        $response = $payment
            ->setUserFirstName($first_name)
            ->setUserLastName($last_name)
            ->setUserEmail($email)
            ->setUserPhone($phone)
            ->setAmount($amount)
            ->pay();


        dd($response);
        //output
        //[
        //    'payment_id'=>"", // refrence code that should stored in your orders table
        //    'redirect_url'=>"", // redirect url available for some payment gateways
        //    'html'=>"" // rendered html available for some payment gateways
        //]

    }

    public function verifyWithFawry(Request $request){
        $payment = new FawryPayment();
        $response = $payment->verify($request);


        dd($response);
        //output
        //[
        //    'success'=>true,//or false
        //    'payment_id'=>"PID",
        //    'message'=>"Done Successfully",//message for client
        //    'process_data'=>""//payment response
        //]
    }
 

}
