<?php

namespace App\Http\Controllers;

use App\Models\PaymentDetail;
use App\Models\Account;
use Illuminate\Http\Request;

class PaymentDetailsController extends Controller
{
    // Display all payment details
    public function index(Request $request)
    {
        $accounts = Account::all();

        $query = PaymentDetail::query();

        if ($request->has('search')) {
            $searchTerm = strtolower($request->search);
            $query->where(function ($q) use ($searchTerm) {
                $q->whereRaw('LOWER(account_id) LIKE ?', ["%{$searchTerm}%"])
                    ->orWhereRaw('LOWER(recipient_name) LIKE ?', ["%{$searchTerm}%"])
                    ->orWhereRaw('LOWER(phone_number) LIKE ?', ["%{$searchTerm}%"])
                    ->orWhereRaw('LOWER(district) LIKE ?', ["%{$searchTerm}%"])
                    ->orWhereRaw('LOWER(city) LIKE ?', ["%{$searchTerm}%"])
                    ->orWhereRaw('LOWER(region) LIKE ?', ["%{$searchTerm}%"])
                    ->orWhereRaw('LOWER(street) LIKE ?', ["%{$searchTerm}%"])
                    ->orWhereRaw('LOWER(address_category) LIKE ?', ["%{$searchTerm}%"]);
            });
        }

        $sortBy = $request->get('sort_by', 'id');
        $sortDirection = $request->get('sort_direction', 'asc');
        $query->orderBy($sortBy, $sortDirection);

        $paymentDetails = $query->get();

        return view('admin.payment_details.index', compact('paymentDetails', 'accounts'));
    }

    // Show form to create a new payment detail
    public function create()
    {
        $accounts = Account::all();
        return view('admin.payment_details.create', compact('accounts'));
    }

    // Store a new payment detail
    public function store(Request $request)
    {
        $validated = $request->validate([
            'account_id' => 'required|integer',
            'recipient_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'district' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'region' => 'required|string|max:255',
            'street' => 'required|string|max:255',
            'address_category' => 'required|in:home address,office address',
        ]);

        PaymentDetail::create($validated);

        return redirect()->route('payment_details.index')->with('success', 'Payment detail created successfully.');
    }

    // Show a single payment detail
    public function show(PaymentDetail $paymentDetail)
    {
        $accounts = Account::all();
        return view('admin.payment_details.show', compact('paymentDetail', 'accounts'));
    }

    // Show form to edit a payment detail
    public function edit(PaymentDetail $paymentDetail)
    {
        $accounts = Account::all();
        return view('admin.payment_details.edit', compact('paymentDetail', 'accounts'));
    }

    // Update the payment detail
    public function update(Request $request, PaymentDetail $paymentDetail)
    {
        $validated = $request->validate([
            'account_id' => 'required|integer',
            'recipient_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'district' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'region' => 'required|string|max:255',
            'street' => 'required|string|max:255',
            'address_category' => 'required|in:home address,office address',
        ]);

        $paymentDetail->update($validated);

        return redirect()->route('payment_details.index')->with('success', 'Payment detail updated successfully.');
    }

    // Delete a payment detail
    public function destroy(PaymentDetail $paymentDetail)
    {
        $paymentDetail->delete();
        return redirect()->route('payment_details.index')->with('success', 'Payment detail deleted successfully.');
    }
}
