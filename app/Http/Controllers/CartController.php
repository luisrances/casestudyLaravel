<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Account;
use App\Models\Order;
use App\Models\PaymentDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    // shop to add cart
    public function add_cart(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|integer',
        ]);

        $validated['account_id'] = Auth::user()->id;
        $validated['quantity'] = 1;

        // Check if product already exists in user's cart
        $existingCart = Cart::where([
            'product_id' => $validated['product_id'],
            'account_id' => $validated['account_id']
        ])->first();

        if ($existingCart) {
            // If exists, increment quantity by 1
            $existingCart->quantity += 1;
            $existingCart->save();
            $message = 'Product quantity updated in cart';
        } else {
            // If doesn't exist, create new cart item
            Cart::create($validated);
            $message = 'Product added to cart successfully';
        }

        return response()->json([
            'success' => true,
            'message' => $message
        ]);
    }


    // cart user page
    public function cart_user(Request $request)
    {
        $products = Product::all();
        $carts = Cart::query()->get();

        return view('order-flow.cart', compact('carts', 'products'));
    }
    public function remove($id)
    {
        Cart::destroy($id);
        return redirect()->route('cart.user');
    }
    public function update_quantity(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $cart = Cart::findOrFail($id);
        $cart->quantity = $request->quantity;
        $cart->save();

        return redirect()->route('cart.user');
    }



    //checkout page
    public function checkout(Request $request)
    {
        // Get the logged in account
        $account = Auth::user();
        $paymentDetails = PaymentDetail::where('account_id', $account->id)->get();

        // Get the selected cart item IDs as an array
        $selectedCartItems = $request->input('selected_cart_items', []);

        // Fetch only the selected cart items for the current user
        $cartItems = Cart::whereIn('id', $selectedCartItems)
            ->where('account_id', $account->id)
            ->get();

        // Fetch only the products related to the selected cart items
        $productIds = $cartItems->pluck('product_id')->unique();
        $products = Product::whereIn('id', $productIds)->get();

        // Pass account data along with cart items and products
        return view('order-flow.checkout', compact('cartItems', 'products', 'account', 'paymentDetails'));
    }
    public function update_quantity_ajax(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $cart = Cart::findOrFail($id);
        $cart->quantity = $request->quantity;
        $cart->save();

        return response()->json([
            'success' => true,
            'quantity' => $cart->quantity,
            'product_id' => $cart->product_id
        ]);
    }
    public function processCheckout(Request $request)
    {
        // Get current user
        $account = Auth::user();

        // Get selected cart items from the form data
        $selectedCartItems = $request->input('selected_cart_items');

        // Get cart items for the current user
        $cartItems = Cart::whereIn('id', $selectedCartItems)
            ->where('account_id', $account->id)
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->back()->with('error', 'No items in cart');
        }

        // Create orders for each cart item
        foreach ($cartItems as $cartItem) {
            $validated = [
                'product_id' => $cartItem->product_id,
                'account_id' => $account->id,
                'quantity' => $cartItem->quantity,
                'order_status' => 'To pay'
            ];

            // Create the order first
            $order = Order::create($validated);

            if ($order) {
                // Delete from carts table if order was created successfully
                Cart::where('id', $cartItem->id)->delete();
            }
        }

        return redirect()->route('Shop')->with('success', 'Order placed successfully! Please complete the payment.');
    }
    
}
