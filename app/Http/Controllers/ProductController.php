<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index()
    {
        return response()->json(Product::all());
    }

    public function getProductsByMerchant($merchantId)
    {
        return response()->json(Product::where('merchant_id', $merchantId)->get());
    }

    public function store(ProductRequest $productRequest, $merchantId)
    {
        $product = new Product($productRequest->validationData());
        $merchant = Auth::user()->merchant;
        return response()->json($merchant->products()->save($product));
    }

    public function show(string $id)
    {
        return response()->json(Product::find($id));
    }

    public function update(ProductRequest $productRequest, $merchantId, string $productId)
    {
        $product = Product::find($productId);
        $product->update($productRequest->validationData());
    }

    public function destroy($merchantId, string $productId)
    {
        $product = Product::find($productId);
        $product->delete();
    }
}
