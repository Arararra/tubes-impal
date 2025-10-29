<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Models\User;

use App\Http\Controllers\Api\SingleController;

Route::get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('/singles', SingleController::class);
