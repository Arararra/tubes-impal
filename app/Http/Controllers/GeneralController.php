<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Collection;

class GeneralController extends Controller
{
    public function home() {
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
    }

    public function products(Request $request)
    {
        $apiHost = env('API_HOST');
        $token = env('BEARER_TOKEN');
        
        $categories = Http::withToken($token)->get(url("$apiHost/api/categories"))->json();
        $products = Http::withToken($token)->get(url("$apiHost/api/products"))->json();

        $search = $request->get('search');
        $category = $request->get('category');
        $sort = $request->get('sort'); // 1=Nama A-Z, 2=Nama Z-A, 3=Harga Terendah, 4=Harga Tertinggi
        $page = $request->get('page', 1);
        $perPage = 8;

        if ($category) {
            $products = array_filter($products, function ($p) use ($category) {
                return collect($p['categories'])->pluck('id')->contains(intval($category));
            });
        }

        if ($search) {
            $products = array_filter($products, function ($p) use ($search) {
                return stripos($p['title'], $search) !== false;
            });
        }

        $total = count($products);

        if ($sort) {
            switch ($sort) {
                case '1':
                    usort($products, fn($a, $b) => strcmp($a['title'], $b['title']));
                    break;
                case '2':
                    usort($products, fn($a, $b) => strcmp($b['title'], $a['title']));
                    break;
                case '3':
                    usort($products, fn($a, $b) => $a['price'] <=> $b['price']);
                    break;
                case '4':
                    usort($products, fn($a, $b) => $b['price'] <=> $a['price']);
                    break;
            }
        }

        $products = array_slice($products, ($page - 1) * $perPage, $perPage);
        
        return view('products.index', [
            'categories' => $categories,
            'products' => $products,
            'total' => $total,
            'perPage' => $perPage,
            'currentPage' => $page,
            'selectedCategory' => $category,
            'selectedSort' => $sort,
        ]);
    }

    public function orderCheck(Request $request) {
        $apiHost = env('API_HOST');
        $token = env('BEARER_TOKEN');
        
        $invoice = $request->get('invoice', '0');
        $order = Http::withToken($token)->get(url("$apiHost/api/orders/$invoice"))->json() ?? [];
        $whatsapp = $order['customer_whatsapp'] ?? '';

        return view('order-check', [
            'order' => $order,
            'whatsapp' => $whatsapp
        ]);
    }
    
    public function checkout() {
        return view('checkout.index', []);
    }
    public function checkoutPayment() {
        return view('checkout.index', []);
    }

    public function single($slug) {
        $apiHost = env('API_HOST');
        $token = env('BEARER_TOKEN');
            
        $single = Http::withToken($token)->get(url("$apiHost/api/singles/$slug"))->json();

            if (!$single) abort(404);
            
        return view('single', [
            'pageTitle' => $single['title'] ?? '404',
            'body' => $single['body'] ?? '',
            'accordions' => $single['accordions'] ?? [],
        ]);
    }
}
