<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $customers = User::where('is_admin', 0)->get();
        $totalProducts = Product::get();
        $activeProducts = Product::where('status', 1)->get();
        $inactiveProducts = Product::where('status', 0)->get();
        return view('dashboard', compact('customers', 'totalProducts', 'activeProducts', 'inactiveProducts'));
    }
}
