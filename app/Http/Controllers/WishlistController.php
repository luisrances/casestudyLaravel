<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use App\Models\Product;
use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    // Display all Wishlists
    public function index(Request $request)
    {
        $products = Product::all();
        $accounts = Account::all();

        $query = Wishlist::query();

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

        $wishlists = $query->get();

        return view('admin.wishlists.index', compact('wishlists', 'products', 'accounts'));
    }

    // Show form to create a new wishlist
    public function create()
    {
        $products = Product::all(); // Get all products
        $accounts = Account::all();   // Get all accounts

        return view('admin.wishlists.create', compact('products', 'accounts'));
    }

    // Store a new wishlist
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|integer',
            'account_id' => 'nullable|integer',
            'quantity' => 'nullable|integer',
        ]);

        Wishlist::create($validated);

        return redirect()->route('wishlists.index')->with('success', 'Wishlist created successfully.');
    }

    // Show a single wishlist
    public function show(Wishlist $wishlist)
    {
        $products = Product::all();
        $accounts = Account::all();

        return view('admin.wishlists.show', compact('wishlist', 'products', 'accounts'));
    }

    // Show form to edit an wishlist
    public function edit(Wishlist $wishlist)
    {
        $products = Product::all();
        $accounts = Account::all();

        return view('admin.wishlists.edit', compact('wishlist', 'products', 'accounts'));
    }

    // Update the wishlist
    public function update(Request $request, Wishlist $wishlist)
    {
        $validated = $request->validate([
            'product_id' => 'required|integer',
            'account_id' => 'nullable|integer',
            'quantity' => 'nullable|integer',
        ]);

        $wishlist->update($validated);

        return redirect()->route('wishlists.index')->with('success', 'Wishlist updated successfully.');
    }

    // Delete an wishlist
    public function destroy(Wishlist $wishlist)
    {
        $wishlist->delete();
        return redirect()->route('wishlists.index')->with('success', 'Wishlist deleted successfully.');
    }

    // shop to add wislist
    public function add_wishlist(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|integer',
        ]);

        $validated['account_id'] = Auth::user()->id;

        Wishlist::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Product added to wishlist successfully'
        ]);
    }

    // wishlist user page
    public function wishlist_user(Request $request)
    {
        $products = Product::all();
        $accounts = Account::all();
        $wishlists = Wishlist::where('account_id', Auth::user()->id)->get();

        return view('order-flow.wishlist', compact('wishlists', 'products', 'accounts'));
    }
    public function remove($id)
    {
        Wishlist::destroy($id);
        return redirect()->route('wishlist.user');
    }
}
