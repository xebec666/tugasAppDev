<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaction;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $transactions = $user->transactions()->latest()->take(5)->get();
        $notifications = $user->notifications()->take(5)->get();
        
        // Stats
        $pendingOrderCount = $user->transactions()->where('status', 'pending')->count();
        $processingOrderCount = $user->transactions()->where('status', 'processing')->count(); // Assuming 'processing' status exists or map appropriately
        $shippedOrderCount = $user->transactions()->where('status', 'shipped')->count();
        $completedOrderCount = $user->transactions()->where('status', 'completed')->count();
        
        $totalSpent = $user->transactions()->where('status', 'completed')->sum('total_price');

        return view('user.dashboard', compact(
            'user', 
            'transactions', 
            'notifications',
            'pendingOrderCount',
            'processingOrderCount',
            'shippedOrderCount',
            'completedOrderCount',
            'totalSpent'
        ));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        
        $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,'.$user->id,
            'phone' => 'nullable|string|max:20',
            // Add other fields as needed based on your users table migration
        ]);

        $user->update($request->all());

        return redirect()->back()->with('success', 'Profil berhasil diperbarui.');
    }
}
