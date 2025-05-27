<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Account;
use App\Models\Cart;
use App\Models\PaymentDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
                    ->orWhereRaw('LOWER(account_id) LIKE ?', ["%{$searchTerm}%"])
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
            'account_id' => 'nullable|integer',
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
            'account_id' => 'nullable|integer',
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


    // purchase history user page
    public function purchase_history_user(Request $request)
    {
        $products = Product::all();
        $accounts = Account::all();
        $orders = Order::where('account_id', Auth::user()->id)->get();

        return view('order-flow.purchase_history', compact('orders', 'products', 'accounts'));
    }

    //checkout buyAgain
    public function checkout_buyAgain(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|integer'
        ]);

        $account = Auth::user();
        $validated['account_id'] = Auth::user()->id;

        // Check if product already exists in user's cart
        $existingCart = Cart::where([
            'product_id' => $validated['product_id'],
            'account_id' => $validated['account_id']
        ])->first();

        if ($existingCart) {
            // If exists, increment quantity by 1
            $existingCart->quantity += 1;
            $existingCart->save();
            $cartItem = $existingCart;
            $message = 'Product quantity updated in cart';
        } else {
            // If doesn't exist, create new cart item
            // $cartItem = Cart::create($validated);
            $cartItem = Cart::create([
                'product_id' => $validated['product_id'],
                'account_id' => $account->id,
                'quantity' => 1
            ]);
            $message = 'Product added to cart successfully';
        }

        // Create a temporary cart item for checkout
        // $cartItem = Cart::create([
        //     'product_id' => $validated['product_id'],
        //     'account_id' => $account->id,
        //     'quantity' => 1
        // ]);

        // Get necessary data for checkout
        $cartItems = Cart::where('id', $cartItem->id)->get();
        $products = Product::where('id', $validated['product_id'])->get();
        $paymentDetails = PaymentDetail::where('account_id', $account->id)->get();

        return view('order-flow.checkout', compact('cartItems', 'products', 'account', 'paymentDetails'));
    }
    public function refundOrder(Request $request)
    {
        try {
            $order = Order::where([
                'product_id' => $request->product_id,
                'account_id' => Auth::user()->id,
                'order_status' => 'Completed'
            ])->first();

            if ($order) {
                $order->order_status = 'Refunded';
                $order->save();

                return response()->json([
                    'success' => true,
                    'message' => 'Order has been refunded'
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'Order not found'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to process refund'
            ], 500);
        }
    }
    public function cancelOrder(Request $request)
    {
        try {
            $order = Order::where([
                'product_id' => $request->product_id,
                'account_id' => Auth::user()->id,
            ])
                ->whereNotIn('order_status', ['Completed', 'Cancelled', 'Refunded'])
                ->first();

            if ($order) {
                $order->order_status = 'Cancelled';
                $order->save();

                return response()->json([
                    'success' => true,
                    'message' => 'Order has been cancelled'
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'Order not found or cannot be cancelled'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to cancel order'
            ], 500);
        }
    }
}
