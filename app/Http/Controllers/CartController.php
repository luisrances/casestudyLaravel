<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Account;
use Illuminate\Http\Request;

class CartController extends Controller
{
    // Display all Carts
    public function index(Request $request)
    {
        $products = Product::all();
        $accounts = Account::all();

        $query = Cart::query();

        if ($request->has('search')) {
            $searchTerm = strtolower($request->search);
            $query->where(function ($q) use ($searchTerm) {
                $q->whereRaw('LOWER(id) LIKE ?', ["%{$searchTerm}%"])
                    ->orWhereRaw('LOWER(product_id) LIKE ?', ["%{$searchTerm}%"])
                    ->orWhereRaw('LOWER(account_id) LIKE ?', ["%{$searchTerm}%"])
                    ->orWhereRaw('LOWER(quantity) LIKE ?', ["%{$searchTerm}%"]);
            });
        }

        // Apply sorting (default: id ascending)
        $sortBy = $request->get('sort_by', 'id');
        $sortDirection = $request->get('sort_direction', 'asc');
        $query->orderBy($sortBy, $sortDirection);

        $carts = $query->get();

        return view('admin.carts.index', compact('carts', 'products', 'accounts'));
    }

    // Show form to create a new cart
    public function create()
    {
        $products = Product::all(); // Get all products
        $accounts = Account::all();   // Get all accounts

        return view('admin.carts.create', compact('products', 'accounts'));
    }

    // Store a new cart
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|integer',
            'account_id' => 'nullable|integer',
            'quantity' => 'nullable|integer',
        ]);

        Cart::create($validated);

        return redirect()->route('carts.index')->with('success', 'Cart created successfully.');
    }

    // Show a single cart
    public function show(Cart $cart)
    {
        $products = Product::all();
        $accounts = Account::all();

        return view('admin.carts.show', compact('cart', 'products', 'accounts'));
    }

    // Show form to edit an cart
    public function edit(Cart $cart)
    {
        $products = Product::all();
        $accounts = Account::all();

        return view('admin.carts.edit', compact('cart', 'products', 'accounts'));
    }

    // Update the cart
    public function update(Request $request, Cart $cart)
    {
        $validated = $request->validate([
            'product_id' => 'required|integer',
            'account_id' => 'nullable|integer',
            'quantity' => 'nullable|integer',
        ]);

        $cart->update($validated);

        return redirect()->route('carts.index')->with('success', 'Cart updated successfully.');
    }

    // Delete an cart
    public function destroy(Cart $cart)
    {
        $cart->delete();
        return redirect()->route('carts.index')->with('success', 'Cart deleted successfully.');
    }
}
