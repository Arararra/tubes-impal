<?php

namespace App\Http\Controllers\Api;

use App\Models\Single;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SingleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Single::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $single = Single::create($request->all());
        return response()->json($single, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Single $single)
    {
        return response()->json($single);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Single $single)
    {
        $single->update($request->all());
        return response()->json($single);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Single $single)
    {
        $single->delete();
        return response()->json(null, 204);
    }
}
