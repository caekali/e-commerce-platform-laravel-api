<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterMerchantRequest;
use App\Http\Requests\UpdateMerchantRequest;
use App\Models\Merchant;
use Illuminate\Http\Request;

class MerchantController extends Controller
{
    public function index()
    {
        return response()->json(Merchant::with('user')->get());
    }

    public function update(UpdateMerchantRequest $updateMerchantRequest, $id)
    {
        $merchant = Merchant::find($id);
        $merchant->update($updateMerchantRequest->safe()->only(['store_name', 'store_logo']));
        $user = $merchant->user();
        $user->update($updateMerchantRequest->safe()->except(['store_name', 'store_logo']));
    }

    public function show($id)
    {
        return response()->json(Merchant::with('user')->find($id));
    }

    public function destroy($id)
    {
        $merchant = Merchant::find($id);
        $user = $merchant->user();
        $user->delete();
    }
}
