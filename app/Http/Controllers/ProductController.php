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

    public function store(ProductRequest $productRequest)
    {
        $product = new Product($productRequest->validationData());
        return response()->json(Auth::user()->merchant->products()->save($product));
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
       return response()->json(Product::find($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $productRequest, string $id)
    {
       $product = Product::find($id);
       $product->update($productRequest->validationData());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);
        $product->delete();
    }
}
