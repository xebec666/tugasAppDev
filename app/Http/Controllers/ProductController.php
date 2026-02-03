<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
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
