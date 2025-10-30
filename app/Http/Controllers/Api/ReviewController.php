<?php

namespace App\Http\Controllers\Api;

use App\Models\Review;
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
