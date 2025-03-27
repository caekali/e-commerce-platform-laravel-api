<?php

namespace App\Http\Controllers;

use App\Http\Requests\CartRequest;
use App\Http\Requests\UpdateCartRequest;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customer = Auth::user()->customer;
        return response()->json($customer->cart->items);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CartRequest $cartRequest)
    {
        $customer = Auth::user()->customer;
        $cart = Cart::where('customer_id', $customer->id)->first();
        if (!$cart) {
            $customer->cart()->save(new Cart());
            $cart = Cart::where('customer_id', $customer->id)->get();
        }
        $customer->refresh();
        $cart->items()->save(new CartItem($cartRequest->validated()));
    }

    public function update(UpdateCartRequest $request, $cartId)
    {
        $cart = Cart::find($cartId);
        $cartItem = $cart->items()->find($request['cart_item_id']);
        $cartItem->update($request->safe()->only(['quantity']));
    }


    public function destroy($cartId)
    {
        $cart = Cart::find($cartId);
        $cart->delete();
    }
}
