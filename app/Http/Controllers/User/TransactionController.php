<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index()
    {
        $orders = Auth::user()->orders()->latest()->paginate(10);
        return view('user.transaksi.index', compact('orders'));
    }

    public function create()
    {
        return view('user.transaksi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'receiver_name' => 'required|string|max:255',
            'receiver_phone' => 'required|string|max:20',
            'shipping_address' => 'required|string',
            'payment_method' => 'required|string',
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

        // Validate stock availability
        foreach ($cartItems as $item) {
            $product = \App\Models\Product::find($item['id']);
            if (!$product) {
                return back()->with('error', 'Produk tidak ditemukan!');
            }
            if ($product->stock < $item['quantity']) {
                return back()->with('error', "Stok produk {$product->name} tidak mencukupi. Sisa stok: {$product->stock}");
            }
        }

        $totalPrice = 0;
        foreach ($cartItems as $item) {
            $totalPrice += $item['price'] * $item['quantity'];
        }
        
        // Add Tax
        $tax = $totalPrice * 0.11;
        $total = $totalPrice + $tax;

        $order = Order::create([
            'user_id' => Auth::id(),
            'total_price' => $total,
            'status' => 'pending', 
            'receiver_name' => $request->receiver_name,
            'receiver_phone' => $request->receiver_phone,
            'shipping_address' => $request->shipping_address,
            'payment_method' => $request->payment_method,
        ]);

        foreach ($cartItems as $item) {
            \App\Models\OrderDetail::create([
                'order_id' => $order->id,
                'product_id' => $item['id'],
                'qty' => $item['quantity'],
                'price' => $item['price'],
            ]);
            
            // Decrement stock
            $product = \App\Models\Product::find($item['id']);
            $product->decrement('stock', $item['quantity']);
        }

        return redirect()->route('user.transactions.payment', $order);
    }

    public function show(Order $transaction)
    {
        if ($transaction->user_id !== Auth::id()) {
            abort(403);
        }
        $transaction->load('details.product');
        return view('user.transaksi.show', compact('transaction'));
    }

    public function payment(Order $transaction)
    {
        if ($transaction->user_id !== Auth::id()) {
            abort(403);
        }
        $transaction->load('details.product');
        return view('user.transaksi.payment-detail', compact('transaction'));
    }

    public function confirmPayment(Request $request, Order $transaction)
    {
        if ($transaction->user_id !== Auth::id()) {
            abort(403);
        }

        $transaction->update(['status' => 'success']);

        return redirect()->route('user.transactions.index')->with('success', 'Pembayaran Berhasil! Terima kasih.');
    }
}
