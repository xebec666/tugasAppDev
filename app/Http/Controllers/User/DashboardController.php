<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $transactions = $user->orders()->latest()->take(5)->get();
        $notifications = $user->notifications()->take(5)->get();
        
        // Stats
        $pendingOrderCount = $user->orders()->where('status', 'pending')->count();
        $processingOrderCount = $user->orders()->where('status', 'processing')->count();
        $shippedOrderCount = $user->orders()->where('status', 'shipped')->count();
        $completedOrderCount = $user->orders()->where('status', 'completed')->count();
        
        $totalSpent = $user->orders()->where('status', 'completed')->sum('total_price');

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
