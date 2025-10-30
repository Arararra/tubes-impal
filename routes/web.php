<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
	$apiHost = env('API_HOST');
  $token = env('BEARER_TOKEN');
	
  $singles = Http::withToken($token)->get(url("$apiHost/api/singles"))->json();
  $categories = Http::withToken($token)->get(url("$apiHost/api/categories"))->json();
  $products = Http::withToken($token)->get(url("$apiHost/api/products"))->json();
	$reviews = Http::withToken($token)->get(url("$apiHost/api/reviews"))->json();
	
  return view('index', [
		'singles' => $singles,
		'categories' => $categories,
		'products' => $products,
		'reviews' => $reviews,
	]);
});
