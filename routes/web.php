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

Route::get('/catalog', function () {
	$apiHost = env('API_HOST');
  $token = env('BEARER_TOKEN');
	
  $categories = Http::withToken($token)->get(url("$apiHost/api/categories"))->json();
  $products = Http::withToken($token)->get(url("$apiHost/api/products"))->json();
	
  return view('catalog.index', [
		'categories' => $categories,
		'products' => $products,
	]);
});

Route::get('/{slug?}', function ($slug) {
	$apiHost = env('API_HOST');
  $token = env('BEARER_TOKEN');
	
  $single = Http::withToken($token)->get(url("$apiHost/api/singles/$slug"))->json();

	if (!$single) abort(404);
	
  return view('single', [
		'pageTitle' => $single['title'] ?? '404',
		'body' => $single['body'] ?? '',
		'accordions' => $single['accordions'] ?? [],
	]);
});
