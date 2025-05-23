<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\PaymentDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    public function index(Request $request)
    {
        $query = Account::query();

        if ($request->has('search')) {
            $searchTerm = strtolower($request->search);
            $query->where(function ($q) use ($searchTerm) {
                $q->whereRaw('LOWER(id) LIKE ?', ["%{$searchTerm}%"])
                    ->orWhereRaw('LOWER(first_name) LIKE ?', ["%{$searchTerm}%"])
                    ->orWhereRaw('LOWER(last_name) LIKE ?', ["%{$searchTerm}%"])
                    ->orWhereRaw('LOWER(email) LIKE ?', ["%{$searchTerm}%"]);
            });
        }

        // Apply sorting (default: id ascending)
        $sortBy = $request->get('sort_by', 'id');
        $sortDirection = $request->get('sort_direction', 'asc');
        $query->orderBy($sortBy, $sortDirection);

        $accounts = $query->get();

        return view('admin.accounts.index', compact('accounts'));
    }

    public function create()
    {
        return view('admin.accounts.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'email'      => 'required|email|unique:accounts,email',
            'password'       => 'required|string|min:6',
            'image'      => 'nullable|image|max:2048',
        ]);

        $validated['password'] = Hash::make($validated['password']);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('images/accounts', 'public');
        }

        Account::create($validated);

        return redirect()->route('accounts.index')->with('success', 'Account added successfully!');
    }

    public function show(Account $account)
    {
        return view('admin.accounts.show', compact('account'));
    }

    public function edit(Account $account)
    {
        return view('admin.accounts.edit', compact('account'));
    }

    public function update(Request $request, Account $account)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'email'      => 'required|email|unique:accounts,email,' . $account->id,
            'password'       => 'nullable|string|min:6',
            'image'      => 'nullable|image|max:2048',
        ]);

        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']); // Avoid overwriting password with null
        }

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('images/accounts', 'public');
        }

        $account->update($validated);

        return redirect()->route('accounts.index')->with('success', 'Account updated successfully!');
    }

    public function destroy(Account $account)
    {
        $account->delete();

        return redirect()->route('accounts.index')->with('success', 'Account deleted successfully!');
    }

    public function account_show(Request $request)
    {
        $account = Auth::user();
        $paymentDetails = PaymentDetail::all();

        return view('setting.account_setting', compact('account', 'paymentDetails'));
    }

    public function updateProfile(Request $request, Account $account)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'email'      => 'required|email|unique:accounts,email,' . $account->id,
            'password'   => 'nullable|string|min:6',
            'image'      => 'nullable|image|max:2048',
            'remove_image' => 'nullable|boolean'
        ]);
    
        // Handle password
        if ($request->filled('password')) {
            $validated['password'] = Hash::make($request->password);
        } else {
            unset($validated['password']);
        }
    
        // Handle image
        if ($request->boolean('remove_image')) {
            // Delete the existing image
            if ($account->image && \Storage::disk('public')->exists($account->image)) {
                \Storage::disk('public')->delete($account->image);
            }
            $validated['image'] = null;
        } elseif ($request->hasFile('image')) {
            // Delete old image if exists
            if ($account->image && \Storage::disk('public')->exists($account->image)) {
                \Storage::disk('public')->delete($account->image);
            }
            $validated['image'] = $request->file('image')->store('images/accounts', 'public');
        }
    
        // Remove remove_image from validated data before update
        unset($validated['remove_image']);
        
        $account->update($validated);
    
        return response()->json([
            'success' => true,
            'message' => 'Profile updated successfully!'
        ]);
    }
}
