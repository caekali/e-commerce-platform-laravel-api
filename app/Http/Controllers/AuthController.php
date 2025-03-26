<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\NewCustomerRequest;
use App\Http\Requests\NewMerchantRequest;
use App\Models\Customer;
use App\Models\Merchant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function addCustomer(NewCustomerRequest $newCustomerRequest)
    {
        $validatedData = $newCustomerRequest->validationData();
        $user =  User::create($validatedData);

        $customer = new Customer([
            'address' => $validatedData['address'],
        ]);

        return response()->json($user->customer()->save($customer));
    }

    public function addMerchant(NewMerchantRequest $newMerchantRequest)
    {
        $validatedData = $newMerchantRequest->validationData();
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
        return response()->json(['message' => 'Login was successful']);
    }
}
