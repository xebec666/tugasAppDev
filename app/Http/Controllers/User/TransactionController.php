<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Auth::user()->transactions()->latest()->paginate(10);
        return view('user.transaksi.index', compact('transactions'));
    }

    public function create()
    {
        return view('user.transaksi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'receiver_name' => 'nullable|string|max:255',
            'receiver_phone' => 'nullable|string|max:20',
            'shipping_address' => 'nullable|string',
        ]);

        $cartItems = [];

        if ($request->has('cart_data')) {
            // Checkout Flow
            $cartItems = json_decode($request->cart_data, true);
        } elseif ($request->has('product_id')) {
            // Direct Buy Flow
            $product = \App\Models\Product::findOrFail($request->product_id);
            $quantity = $request->quantity ?? 1;
            $cartItems[] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $quantity,
            ];
        }

        if (!$cartItems || count($cartItems) === 0) {
            return back()->with('error', 'Tidak ada produk yang dibeli!');
        }

        $totalPrice = 0;
        foreach ($cartItems as $item) {
            $totalPrice += $item['price'] * $item['quantity'];
        }
        
        // Add Tax
        $tax = $totalPrice * 0.11;
        $total = $totalPrice + $tax;

        $transaction = Transaction::create([
            'user_id' => Auth::id(),
            'total_price' => $total,
            'status' => 'pending', 
        ]);

        foreach ($cartItems as $item) {
            \App\Models\TransactionItem::create([
                'transaction_id' => $transaction->id,
                'product_id' => $item['id'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);
        }

        return redirect()->route('user.transactions.show', $transaction);
    }

    public function show(Transaction $transaction)
    {
        if ($transaction->user_id !== Auth::id()) {
            abort(403);
        }
        $transaction->load('items.product');
        return view('user.transaksi.show', compact('transaction'));
    }

    public function payment(Transaction $transaction)
    {
        if ($transaction->user_id !== Auth::id()) {
            abort(403);
        }
        $transaction->load('items.product');
        return view('user.transaksi.payment-detail', compact('transaction'));
    }
}
