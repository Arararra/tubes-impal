<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Models\User;

use App\Http\Controllers\Api\SingleController;

Route::middleware('auth.bearer')->group(function () {
    Route::get('/test', function (Request $request) {
        return response()->json(['message' => 'Authorized']);
    });

    Route::apiResource('/singles', SingleController::class);
});
