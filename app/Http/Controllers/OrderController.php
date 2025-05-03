<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Account;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // Display all orders
    public function index(Request $request)
    {
        $products = Product::all();
        $accounts = Account::all();

        $query = Order::query();

        if ($request->has('search')) {
            $searchTerm = strtolower($request->search);
            $query->where(function ($q) use ($searchTerm) {
                $q->whereRaw('LOWER(id) LIKE ?', ["%{$searchTerm}%"])
                    ->orWhereRaw('LOWER(product_id) LIKE ?', ["%{$searchTerm}%"])
                    ->orWhereRaw('LOWER(customer_id) LIKE ?', ["%{$searchTerm}%"])
                    ->orWhereRaw('LOWER(quantity) LIKE ?', ["%{$searchTerm}%"])
                    ->orWhereRaw('LOWER(order_status) LIKE ?', ["%{$searchTerm}%"]);
            });
        }

        // Apply sorting (default: id ascending)
        $sortBy = $request->get('sort_by', 'id');
        $sortDirection = $request->get('sort_direction', 'asc');
        $query->orderBy($sortBy, $sortDirection);

        $orders = $query->get();

        return view('admin.orders.index', compact('orders', 'products', 'accounts'));
    }

    // Show form to create a new order
    public function create()
    {
        $products = Product::all(); // Get all products
        $accounts = Account::all();   // Get all users (accounts)

        return view('admin.orders.create', compact('products', 'accounts'));
    }

    // Store a new order
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|integer',
            'customer_id' => 'nullable|integer',
            'quantity' => 'nullable|integer',
            'order_status' => 'nullable|string',
        ]);

        Order::create($validated);

        return redirect()->route('orders.index')->with('success', 'Order created successfully.');
    }

    // Show a single order
    public function show(Order $order)
    {
        $products = Product::all();
        $accounts = Account::all();

        return view('admin.orders.show', compact('order', 'products', 'accounts'));
    }

    // Show form to edit an order
    public function edit(Order $order)
    {
        $products = Product::all();
        $accounts = Account::all();

        return view('admin.orders.edit', compact('order', 'products', 'accounts'));
    }

    // Update the order
    public function update(Request $request, Order $order)
    {
        $validated = $request->validate([
            'product_id' => 'required|integer',
            'customer_id' => 'nullable|integer',
            'quantity' => 'nullable|integer',
            'order_status' => 'nullable|string',
        ]);

        $order->update($validated);

        return redirect()->route('orders.index')->with('success', 'Order updated successfully.');
    }

    // Delete an order
    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('orders.index')->with('success', 'Order deleted successfully.');
    }
}
