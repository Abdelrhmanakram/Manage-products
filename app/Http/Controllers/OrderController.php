<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::all();

        return response()->json([
            'status' => 'success',
            'data' => $orders
        ], 200);
    }

    public function show($id)
    {
        $order = Order::find($id);

        if (!$order) {
            return response()->json([
               'status' => 'error',
               'message' => 'Order not found'
            ], 404);
        }

        return response()->json([
           'status' =>'success',
            'data' => $order
        ], 200);
    }

    public function store(OrderRequest $request)
    {
        $order = Order::create($request->validated());

        return response()->json([
            'status' => 'success',
            'data' => $order
        ], 201);
    }

    public function update(OrderRequest $request, $id)
    {
        $order = Order::find($id);

        if (!$order) {
            return response()->json([
                'status' => 'error',
                'message' => 'Order not found'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $order
        ], 200);
    }

    public function destroy($id)
    {
        $order = Order::find($id);

        if (!$order) {
            return response()->json([
               'status' => 'error',
               'message' => 'Order not found'
            ], 404);
        }

        $order->delete();

        return response()->json([
           'status' =>'success',
           'message' => 'Order deleted successfully'
        ], 200);
    }
}
