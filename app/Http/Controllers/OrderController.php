<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store()
    {
        $cart = Auth::user()->customer->cart;

        if ($cart) {
            $totalPrice = 0.0;
            $orderItems = [];
            $orderIndexIndex = 0;
            foreach ($cart as $item) {
                $totalPrice += $item['price'];
                $orderItems[$orderIndexIndex++] = new OrderItem(['product_id' => $item->product_id, 'price' => $item->price, 'quantity' => $item->quantity]);
            }

            $order = new Order(['total_price' => $totalPrice, 'status' => 'pending']);
            $order = Auth::user()->customer->orders()->save($order);
            foreach ($cart as $item) {
                $totalPrice += $item['price'];
            }
            
            $order->orderItems()->saveMany($orderItems);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
