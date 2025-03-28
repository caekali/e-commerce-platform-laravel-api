<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterCustomerRequest;
use App\Http\Requests\RegisterMerchantRequest;
use App\Models\Customer;
use App\Models\Merchant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function addCustomer(RegisterCustomerRequest $registerCustomerRequest)
    {
        $validatedData = $registerCustomerRequest->validationData();
        $user =  User::create($validatedData);

        $customer = new Customer([
            'address' => $validatedData['address'],
        ]);

        return response()->json($user->customer()->save($customer));
    }

    public function addMerchant(RegisterMerchantRequest $registerMerchantRequest)
    {
        $validatedData = $registerMerchantRequest->validationData();
        $user =  User::create($validatedData);

        $merchant = new Merchant([
            'store_name' => $validatedData['store_name'],
            'store_logo' => $validatedData['store_logo']
        ]);

        return response()->json($user->merchant()->save($merchant));
    }

    public function login(LoginRequest $LoginRequest)
    {
        if (!Auth::attempt($LoginRequest->validationData())) {
            return response()->json(['message' => 'Bad credentials']);
        }

        return response()->json(['token' =>  Auth::user()->createToken("auth_token")->plainTextToken]);
    }
}
