<?php

namespace App\Http\Controllers;

use App\Http\Requests\CartRequest;
use App\Http\Requests\UpdateCartRequest;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Auth::user()->customer->cart);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CartRequest $cartRequest)
    {
        $cart = new Cart($cartRequest->validated());
        Auth::user()->customer->cart()->save($cart);
    }


    public function update(UpdateCartRequest $request, $cartId)
    {
        $cart = Cart::find($cartId);
        $cart->update($request->validationData());
    }


    public function destroy($cartId)
    {
        $cart = Cart::find($cartId);
        $cart->delete();
    }
}
