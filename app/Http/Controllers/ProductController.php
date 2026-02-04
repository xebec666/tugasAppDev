<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of all products.
     */
    public function index(Request $request)
    {
        $query = Product::withAvg('reviews', 'rating');
        
        // Search functionality
        if ($request->has('search') && $request->search) {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
        }
        
        // Category filter (if needed in the future)
        if ($request->has('category') && $request->category) {
            $query->where('category', $request->category);
        }
        
        // Order by latest
        $query->orderBy('created_at', 'desc');
        
        // Paginate results
        $products = $query->paginate(12);
        
        // Fetch all categories for the category filter
        $categories = \App\Models\Category::orderBy('name')->get();
        
        return view('products.index', compact('products', 'categories'));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $product = Product::with(['reviews.user'])->withAvg('reviews', 'rating')->findOrFail($id);
        
        // Setup related products or other view data if needed
        $relatedProducts = Product::where('id', '!=', $id)->withAvg('reviews', 'rating')->inRandomOrder()->take(4)->get();

        return view('products.show', compact('product', 'relatedProducts'));
    }
}
