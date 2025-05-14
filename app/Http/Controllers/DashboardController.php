<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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

        // Monthly Revenue (last 12 months)
        $monthlyRevenue = DB::table('orders')
            ->selectRaw("DATE_FORMAT(orders.created_at, '%Y-%m') as month, SUM(products.price * orders.quantity) as revenue")
            ->join('products', 'orders.product_id', '=', 'products.id')
            ->where('orders.order_status', 'completed')
            ->groupBy('month')
            ->orderBy('month')
            ->take(15)
            ->get();

        return view('admin.dashboard.index', compact(
            'pendings',
            'totalProducts',
            'totalUsers',
            'totalOrders',
            'totalRevenue',
            'products',
            'accounts',
            'monthlyRevenue'
        ));
    }
}
