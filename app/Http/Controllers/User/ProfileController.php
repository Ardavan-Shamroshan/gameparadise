<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    public function index()
    {
        $orders = auth()->user()->orders;
        $payments = auth()->user()->payments;
        $transactions = auth()->user()->transactions;
        $ordersCreatedAt = $orders->pluck('created_at', 'id');

        return view('home.user.profile', compact('orders', 'payments', 'transactions', 'ordersCreatedAt'));
    }
}
