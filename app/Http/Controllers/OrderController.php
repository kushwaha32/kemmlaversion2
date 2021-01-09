<?php

namespace App\Http\Controllers;

use App\Order;
use App\User;
use App\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Session;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate requist

        $request->validate([
            "pamentOp" => "required|string"
        ]);

        // get order from the session

        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        $carContent = base64_encode(serialize($cart->getContents()));
        $cartTotalPrice = base64_encode(serialize($cart->getTotalPrice()));
        // get Auth id
        
        $userId = Auth::id();

        // check for the payUmoney
        if($request->pamentOp == 'payumoney'){
            
           $order = Order::create([
                    "user_id" => $userId,
                    "cart"    => $carContent,
                    "total_price" => $cartTotalPrice,
                    "status" => "pending",
                    "payment_method" => $request->pamentOp
                ]);
                Session::put('order_id', $order->id);
                return redirect('/payumoney');

        }
        
        
        
       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
