<?php

namespace App\Http\Controllers;

use App\Http\Requests\productRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class productController extends Controller
{
    public function index()
    {
        $products = Product::all();

        return response()->json([
            'status' => 'success',
            'data' => $products
        ], 200);
    }

    public function show($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json([
               'status' => 'error',
               'message' => 'Product not found'
            ], 404);
        }

        return response()->json([
           'status' =>'success',
            'data' => $product
        ], 200);
    }

    public function store(productRequest $request)
    {
        $product = Product::create($request->validated());

        return response()->json([
            'status' => 'success',
            'data' => $product
        ], 201);
    }

    public function update(productRequest $request, $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                'status' => 'error',
                'message' => 'Product not found'
            ], 404);
        }

        if ($request->hasFile('image')) {

            $imagePath = $request->file('image')->store('products', 'public');

            $product->image = $imagePath;
        }

        $product->update($request->except('image'));

        return response()->json([
            'status' => 'success',
            'data' => $product
        ], 200);
    }

    public function destroy($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json([
               'status' => 'error',
               'message' => 'Product not found'
            ], 404);
        }

        $product->delete();

        return response()->json([
           'status' =>'success',
           'message' => 'Product deleted successfully'
        ], 200);
    }

}
