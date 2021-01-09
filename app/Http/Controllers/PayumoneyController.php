<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Softon\Indipay\Facades\Indipay;
use Illuminate\Support\Facades\Auth;
use App\Order;
use App\Shipping;
use App\Admin;
use Session;

class PayumoneyController extends Controller
{
    public function payumoneyPayment()
    {
        // Get the order id from the session
        $order_id = Session::get('order_id');
        // Fetch the order details on the basis of order id
        $orderDetails = Order::where('id', '=', $order_id)->get();
        $orderDetails = json_decode(json_encode($orderDetails));
        // cart Details
        $orderCart = unserialize(base64_decode($orderDetails[0]->cart));
        // cart total price
        $orderTotal = unserialize(base64_decode($orderDetails[0]->total_price));
        // Get Authenticate user
        $authId = Auth::id();
        // Fetch the shipping address on the basic of Authenticate user id
        $shipAddress = Shipping::where('user_id', '=', $authId)->get();
        $shipAddress = json_decode(json_encode($shipAddress));

        $parameters = [
            'txnid' => 1234578907+$order_id,
            'order_id' => $order_id,
            'amount' => $orderTotal,
            'firstname' => $shipAddress[0]->first_name,
            'lastname'  => $shipAddress[0]->last_name,
            'email' => $shipAddress[0]->email,
            'phone' => $shipAddress[0]->phone,
            'productinfo' => $order_id,
            'service_provider' => '',
            'zipcode' => $shipAddress[0]->zip_code,
            'city' => $shipAddress[0]->city,
            'state' => $shipAddress[0]->state,
            'country' => $shipAddress[0]->country,
            'address1' => $shipAddress[0]->address,
            'address2' => '',
            'curl' => url('payumoney/response'),
          ];
          
          $order = Indipay::prepare($parameters);
          return Indipay::process($order);
    }

    public function payumoneyResponse(Request $request){
        $response = Indipay::response($request);
        if($response['status'] == "success" && $response['unmappedstatus'] == "captured"){
           
            // Get the order id from the session
            $order_id = Session::get('order_id');

            // Update Order
            Order::where('id', $order_id)->update(['status' => 'Payment Captured']);
            
            // Get Order detail
            $productDetails = Order::where('id', $order_id)->get();
            $productDetails = json_decode(json_encode($productDetails,true));
            $user_id = $productDetails['user_id'];
            $userDetails = Shipping::where('user_id', $user_id)->get();
            $email = $userDetails['email'];
            // Get Admin Email
            $admin = Admin::all();
            $admin = json_decode(json_encode($admin));
            $admin_email = $admin['email'];

            $messageData = [
                'email' => $email,
                'name'  => $userDetails['first_name'],
                'productDetails' => $productDetails,
                'userDetails' => $userDetails
            ];
            Mail::to($email)->send(new ProductConfirmation($messageData));
            Mail::to($admin_email)->send(new ProductConfirmationAdmin($messageData));
            
        }else{
            dd('failed');
        }
    }
}
