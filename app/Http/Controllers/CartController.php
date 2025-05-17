<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Account;

class CartController extends Controller
{
    // ==== FRONT-END DISPLAY METHODS ====

    public function showCart()
    {
        $cartItems = collect([
            (object)[
                'id' => 1,
                'name' => 'MICHELIN TIRES',
                'description' => 'Power Gravel 700x40c',
                'price' => 10000.89,
                'quantity' => 2,
                'image_url' => asset('images/tire.jpg')
            ],
        ]);

        return view('cart', compact('cartItems'));
    }

    public function showWishlist()
    {
        $wishlistItems = collect([
            (object)[
                'id' => 1,
                'name' => 'MICHELIN TIRES',
                'description' => 'Power Gravel 700x40c',
                'price' => 10000.89,
                'image_url' => asset('images/tire.jpg')
            ],
            (object)[
                'id' => 2,
                'name' => 'MICHELIN TIRES',
                'description' => 'Power Gravel 700x40c',
                'price' => 10000.89,
                'image_url' => asset('images/tire.jpg')
            ],
            (object)[
                'id' => 3,
                'name' => 'MICHELIN TIRES',
                'description' => 'Power Gravel 700x40c',
                'price' => 10000.89,
                'image_url' => asset('images/tire.jpg')
            ],
        ]);

        return view('wishlist', compact('wishlistItems'));
    }

    public function showPurchaseHistory()
    {
        $purchaseHistory = collect([
            (object)[
                'id' => 1,
                'name' => 'MICHELIN TIRES',
                'description' => 'Power Gravel 700x40c',
                'price' => 10000.89,
                'quantity' => 2,
                'purchased_at' => now()->subDays(10),
                'image_url' => asset('images/tire.jpg')
            ],
            (object)[
                'id' => 2,
                'name' => 'MICHELIN TIRES',
                'description' => 'Power Gravel 700x40c',
                'price' => 10000.89,
                'quantity' => 1,
                'purchased_at' => now()->subDays(30),
                'image_url' => asset('images/tire.jpg')
            ],
        ]);

        return view('purchase_history', compact('purchaseHistory'));
    }

    public function addToCart($id)
    {
        return redirect()->route('wishlist.show')->with('success', "Item with ID $id added to cart.");
    }

    public function showCheckout()
    {
        $cartItems = collect([
            (object)[
                'id' => 1,
                'name' => 'MICHELIN TIRES',
                'description' => 'Power Gravel 700x40c',
                'price' => 10000.89,
                'quantity' => 2,
                'image_url' => asset('images/tire.jpg')
            ],
            (object)[
                'id' => 2,
                'name' => 'MICHELIN TIRES',
                'description' => 'Power Gravel 700x40c',
                'price' => 10000.89,
                'quantity' => 2,
                'image_url' => asset('images/tire.jpg')
            ],
            (object)[
                'id' => 3,
                'name' => 'MICHELIN TIRES',
                'description' => 'Power Gravel 700x40c',
                'price' => 10000.89,
                'quantity' => 2,
                'image_url' => asset('images/tire.jpg')
            ]
        ]);

        $subtotal = $cartItems->sum(fn($item) => $item->price * $item->quantity);
        $tax = 80;
        $total = $subtotal + $tax;

        $user = (object)[
            'name' => 'Francis Frances',
            'address' => 'Block 15, Lot 8, Sampaguita Street',
            'contact' => '09999999999'
        ];

        return view('checkout', compact('cartItems', 'subtotal', 'tax', 'total', 'user'));
    }

    // ==== ADMIN BACKEND METHODS ====

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

        $sortBy = $request->get('sort_by', 'id');
        $sortDirection = $request->get('sort_direction', 'asc');
        $query->orderBy($sortBy, $sortDirection);

        $carts = $query->get();

        return view('admin.carts.index', compact('carts', 'products', 'accounts'));
    }

    public function create()
    {
        $products = Product::all();
        $accounts = Account::all();

        return view('admin.carts.create', compact('products', 'accounts'));
    }

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

    public function show(Cart $cart)
    {
        $products = Product::all();
        $accounts = Account::all();

        return view('admin.carts.show', compact('cart', 'products', 'accounts'));
    }

    public function edit(Cart $cart)
    {
        $products = Product::all();
        $accounts = Account::all();

        return view('admin.carts.edit', compact('cart', 'products', 'accounts'));
    }

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
    
    public function destroy(Cart $cart)
    {
        $cart->delete();
        return redirect()->route('carts.index')->with('success', 'Cart deleted successfully.');
    }
}
