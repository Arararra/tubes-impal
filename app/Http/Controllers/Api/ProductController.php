<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with(['categories:id,title,image'])->get()
            ->map(function ($product) {
                $product->categories->makeHidden('pivot');
                return $product;
            });

        return response()->json($products);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|string',
            'body' => 'required|string',
            'price' => 'required|numeric', // Ensure price is a number
            'stock' => 'required|integer', // Ensure stock is an integer
        ]);

        // Create the product with validated data
        $product = Product::create($validatedData);

        if ($request->has('category_ids')) {
            $product->categories()->sync($request->category_ids);
        }
        
        $product->load(['categories:id,title,image']);
        $product->categories->makeHidden('pivot');

        return response()->json($product, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {   
        $product->load(['categories:id,title,image']);
        $product->categories->makeHidden('pivot');

        return response()->json($product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'image' => 'sometimes|required|string',
            'body' => 'sometimes|required|string',
            'price' => 'sometimes|required|numeric', // Ensure price is a number
            'stock' => 'sometimes|required|integer', // Ensure stock is an integer
        ]);

        // Update the product with validated data
        $product->update($validatedData);

        if ($request->has('category_ids')) {
            $product->categories()->sync($request->category_ids);
        }

        $product->load(['categories:id,title,image']);
        $product->categories->makeHidden('pivot');

        return response()->json($product);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json(null, 204);
    }
}
