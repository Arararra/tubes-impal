<?php

namespace App\Http\Controllers\Api;

use App\Models\Order;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::with('orderProducts.product')->get()->map(function ($order) {
            return [
                'id' => $order->id,
                'customer_name' => $order->customer_name,
                'customer_address' => $order->customer_address,
                'customer_whatsapp' => $order->customer_whatsapp,
                'receipt' => $order->receipt,
                'shipping_receipt' => $order->shipping_receipt,
                'status' => $order->status,
                'total' => $order->total,
                'paid_date' => $order->paid_date,
                'products' => $order->orderProducts->map(function ($op) {
                    return [
                        'id' => $op->product->id,
                        'name' => $op->product->title,
                        'quantity' => $op->quantity,
                        'price' => $op->price,
                        'subtotal' => $op->quantity * $op->price,
                    ];
                }),
            ];
        });

        return response()->json($orders);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $order = Order::create($request->all());

        if ($request->has('order_products')) {
            foreach ($request->order_products as $op) {
                $order->orderProducts()->create($op);
            }
        }

        return $this->show($order);
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        $order->load('orderProducts.product');

        $response = [
            'id' => $order->id,
            'customer_name' => $order->customer_name,
            'customer_address' => $order->customer_address,
            'customer_whatsapp' => $order->customer_whatsapp,
            'receipt' => $order->receipt,
            'shipping_receipt' => $order->shipping_receipt,
            'status' => $order->status,
            'total' => $order->total,
            'paid_date' => $order->paid_date,
            'products' => $order->orderProducts->map(function ($op) {
                return [
                    'id' => $op->product->id,
                    'name' => $op->product->title,
                    'quantity' => $op->quantity,
                    'price' => $op->price,
                    'subtotal' => $op->quantity * $op->price,
                ];
            }),
        ];

        return response()->json($response);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        $order->update($request->all());

        if ($request->has('order_products')) {
            $order->orderProducts()->delete();
            foreach ($request->order_products as $op) {
                $order->orderProducts()->create($op);
            }
        }

        return $this->show($order);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        $order->delete();
        return response()->json(null, 204);
    }
}
