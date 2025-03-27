<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateCustomerRequest;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        return response()->json(Customer::with('user')->get());
    }

    public function update(UpdateCustomerRequest $updateCustomerRequest, $id)
    {
        $customer = Customer::find($id);
        $customer->update($updateCustomerRequest->safe()->only(['address']));
        $user = $customer->user();
        $user->update($updateCustomerRequest->safe()->except(['address']));
    }

    public function show($id)
    {
        return response()->json(Customer::with('user')->find($id));
    }

    public function destroy($id)
    {
        $customer = Customer::find($id);
        $user = $customer->user();
        $user->delete();
    }
}
