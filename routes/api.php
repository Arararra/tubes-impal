<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Api\SingleController;
use App\Http\Controllers\Api\CategoryController;

Route::middleware('auth.bearer')->group(function () {
    Route::get('/', function (Request $request) {
        return response()->json(['message' => 'Authorized']);
    });

    Route::apiResource('/singles', SingleController::class);
    Route::apiResource('/categories', CategoryController::class);
});
