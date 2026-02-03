<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Fetch 4 latest products for the "Popular Product" section
        $products = Product::latest()->take(4)->get();

        return view('welcome', compact('products'));
    }
}
