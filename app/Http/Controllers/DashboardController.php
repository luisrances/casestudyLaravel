<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {

        $pendings = Order::whereIn('order_status', ['to ship', 'to receive'])->get();
        $products = Product::all();
        $accounts = Account::all();
        
        $totalProducts = Product::count();
        $totalUsers = Account::count();
        $totalOrders = Order::count();
        $totalRevenue = DB::table('orders')
            ->join('products', 'orders.product_id', '=', 'products.id')
            ->where('orders.order_status', 'completed')
            ->sum(DB::raw('products.price * orders.quantity'));

        return view('admin.dashboard.index', compact('pendings', 'totalProducts', 'totalUsers', 'totalOrders', 'totalRevenue', 'products', 'accounts'));
    }
}
