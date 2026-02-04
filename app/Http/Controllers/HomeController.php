<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::withAvg('reviews', 'rating')->latest();
        
        // Filter by category if provided
        if ($request->has('category') && $request->category) {
            $query->where('category', $request->category);
        }
        
        // Fetch 4 products for the "Popular Product" section
        $products = $query->take(4)->get();
        
        // Get selected category for highlighting
        $selectedCategory = $request->get('category');
        
        // Fetch all categories for the category buttons
        $categories = \App\Models\Category::orderBy('name')->get();

        return view('welcome', compact('products', 'selectedCategory', 'categories'));
    }
}
