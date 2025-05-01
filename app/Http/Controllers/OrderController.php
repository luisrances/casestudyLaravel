<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Customer;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // Display all orders
    public function index(Request $request)
    {
        $query = Order::query();

        if ($request->has('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('id', 'LIKE', '%' . $request->search . '%')
                    // ->orWhere('quantity', 'LIKE', '%' . $request->search . '%') fix
                    ->orWhere('order_status', 'LIKE', '%' . $request->search . '%');
            });
        }

        $orders = $query->get();

        return view('admin.orders.index', compact('orders'));
    }

    // Show form to create a new order
    public function create()
    {
        $products = Product::all(); // Get all products
        $customers = Customer::all();   // Get all users (customers)

        return view('admin.orders.create', compact('products', 'customers'));
    }

    // Store a new order
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'customer_id' => 'required|exists:customers,id',
            'quantity' => 'required|integer|min:1',
            'order_status' => 'required|in:to pay,to ship,to receive,completed,refund,cancelled',
        ]);

        Order::create($validated);

        return redirect()->route('orders.index')->with('success', 'Order created successfully.');
    }

    // Show a single order
    public function show(Order $order)
    {
        return view('admin.orders.show', compact('order'));
    }

    // Show form to edit an order
    public function edit(Order $order)
    {
        $products = Product::all();
        $customers = Customer::all();

        return view('admin.orders.edit', compact('order', 'products', 'customers'));
    }

    // Update the order
    public function update(Request $request, Order $order)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'customer_id' => 'required|exists:customer,id',
            'quantity' => 'required|integer|min:1',
            'order_status' => 'required|in:to pay,to ship,to receive,completed,refund,cancelled',
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
