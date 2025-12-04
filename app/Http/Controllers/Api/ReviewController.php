<?php

namespace App\Http\Controllers\Api;

use App\Models\Review;
use App\Models\Order;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reviews = Review::with('order:id,receipt')->get()->map(function ($review) {
            return [
                'id' => $review->id,
                'title' => $review->title,
                'body' => $review->body,
                'rating' => $review->rating,
                'order_receipt' => $review->order ? $review->order->receipt : null,
                'product_id' => $review->product_id,
            ];
        });

        return response()->json($reviews);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $review = Review::create($request->all());
        return $this->formatResponse($review);
    }

    /**
     * Display the specified resource.
     */
    public function show(Review $review)
    {
        $review->load('order:id,receipt');

        return response()->json([
            'id' => $review->id,
            'title' => $review->title,
            'body' => $review->body,
            'rating' => $review->rating,
            'order_receipt' => $review->order ? $review->order->receipt : null,
            'product_id' => $review->product_id,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Review $review)
    {
        $review->update($request->all());
        return $this->formatResponse($review);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $review)
    {
        $review->delete();
        return response()->json(null, 204);
    }

    /**
     * Add or update a review based on order_receipt.
     */
    public function addOrUpdateReview(Request $request)
    {
        $validatedData = $request->validate([
            'order_receipt' => 'required|string',
            'customer_whatsapp' => 'required|digits:5',
            'title' => 'required|string',
            'body' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $order = Order::where('receipt', $validatedData['order_receipt'])
            ->where('customer_whatsapp', 'like', "%{$validatedData['customer_whatsapp']}")
            ->first();

        if (!$order) {
            return response()->json(['error' => 'Invalid order receipt or customer WhatsApp'], 400);
        }

        $review = Review::where('order_id', $order->id)->first();

        if ($review) {
            $review->update([
                'title' => $validatedData['title'],
                'body' => $validatedData['body'],
                'rating' => $validatedData['rating'],
            ]);
        } else {
            $review = Review::create([
                'order_id' => $order->id,
                'title' => $validatedData['title'],
                'body' => $validatedData['body'],
                'rating' => $validatedData['rating'],
                'product_id' => $order->product_id,
            ]);
        }

        return $this->formatResponse($review);
    }

    private function formatResponse($review)
    {
        $review->load('order:id,receipt');
        return response()->json([
            'id' => $review->id,
            'title' => $review->title,
            'body' => $review->body,
            'rating' => $review->rating,
            'order_receipt' => $review->order ? $review->order->receipt : null,
            'product_id' => $review->product_id,
        ]);
    }
}
