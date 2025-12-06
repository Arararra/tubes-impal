<?php

namespace App\Http\Controllers\Api;

use App\Models\Order;
use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

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
                'customer_city' => $order->customer_city,
                'customer_postcode' => $order->customer_postcode,
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
            'customer_city' => $order->customer_city,
            'customer_postcode' => $order->customer_postcode,
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

    /**
     * Handle the checkout process.
     */
    public function checkout(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_whatsapp' => 'required|string|max:15',
            'customer_city' => 'required|string|max:255',
            'customer_postcode' => 'required|string|max:10',
            'customer_address' => 'required|string',
            'cart' => 'required|array',
            'cart.*.id' => 'required|integer',
            'cart.*.name' => 'required|string|max:255',
            'cart.*.qty' => 'required|integer|min:1',
            'cart.*.price' => 'required|numeric|min:0',
        ]);

        $cart = $validated['cart'];

        foreach ($cart as $item) {
            $product = Product::find($item['id']);
            if (!$product || $item['qty'] > $product->stock) {
                return response()->json([
                    'message' => 'Sepertinya stok produk tidak mencukupi untuk pesanan Anda!',
                ], 400);
            }
        }

        $total = array_reduce($cart, function ($sum, $item) {
            return $sum + ($item['price'] * $item['qty']);
        }, 0);

        $receipt = 'INV' . str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT);

        $order = Order::create([
            'customer_name' => $validated['customer_name'],
            'customer_whatsapp' => $validated['customer_whatsapp'],
            'customer_city' => $validated['customer_city'],
            'customer_postcode' => $validated['customer_postcode'],
            'customer_address' => $validated['customer_address'],
            'receipt' => $receipt,
            'status' => 'paid',
            'paid_date' => now(),
            'total' => $total,
        ]);

        foreach ($cart as $item) {
            $order->orderProducts()->create([
                'product_id' => $item['id'],
                'quantity' => $item['qty'],
                'price' => $item['price'],
            ]);

            $product = Product::find($item['id']);
            if ($product) {
                $product->decrement('stock', $item['qty']);
            }
        }

        try {
            $pdf = PDF::loadView('receipt', [
                'order' => $order,
                'products' => $cart,
            ]);

            return response()->streamDownload(function () use ($pdf) {
                echo $pdf->output();
            }, "receipt_{$receipt}.pdf", [
                "Content-Type" => "application/pdf",
                "Access-Control-Expose-Headers" => "Content-Disposition",
            ]);
        } catch (\Exception $e) {
            \Log::error('PDF Generation Error: ' . $e->getMessage());
            return response()->json([
                'message' => 'Failed to generate receipt PDF.'
            ], 500);
        }
    }
}
