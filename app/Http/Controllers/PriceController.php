<?php

namespace App\Http\Controllers;

use App\Http\Requests\priceRequest;
use App\Models\Price;
use Illuminate\Support\Facades\DB;

class PriceController extends Controller
{
    public function index()
    {
        $prices=Price::all();

        return response()->json([
            'status' => 'success',
            'data' => $prices
        ], 200);
    }

    public function show($id)
    {
        $price=Price::find($id);
        if (!$price) {
            return response()->json([
                'status' => 'error',
                'message' => 'Price not found'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $price
        ], 200);

    }

    public function store(priceRequest $request)
    {
        $price = Price::create($request->validated());

        return response()->json([
            'status' => 'success',
            'data' => $price
        ], 201);
    }

    public function update(priceRequest $request, $id)
    {
        $price = Price::find($id);
        if (!$price) {
            return response()->json([
               'status' => 'error',
               'message' => 'Price not found'
            ], 404);
        }

        $price->update($request->validated());

        return response()->json([
           'status' => 'success',
            'data' => $price
        ], 200);
    }

    public function destroy($id)
    {
        $price = Price::find($id);
        if (!$price) {
            return response()->json([
               'status' => 'error',
               'message' => 'Price not found'
            ], 404);
        }

        $price->delete();

        return response()->json([
           'status' => 'success',
           'message' => 'Price deleted'
        ], 204);
    }

    public function getCurrentProductPrice($id)
{
    $currentDate = now();

    $productWithCurrentPrice = DB::table('products')
        ->select(
            'products.id as product_id',
            'products.name as product_name',
            'products.description',
            'prices.price as current_price'
        )
        ->join('prices', 'products.id', '=', 'prices.product_id')
        ->where('products.id', $id)
        ->where('prices.start_date', '<=', $currentDate)
        ->where('prices.end_date', '>=', $currentDate)
        ->first();

    return response()->json($productWithCurrentPrice);
}
}
