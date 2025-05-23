<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Models\Account;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    // Display all feedbacks
    public function index(Request $request)
    {
        $query = Feedback::query();
        $accounts = Account::all();

        if ($request->has('search')) {
            $searchTerm = strtolower($request->search);
            $query->where(function ($q) use ($searchTerm) {
                $q->whereRaw('LOWER(id) LIKE ?', ["%{$searchTerm}%"])
                    ->orWhereRaw('LOWER(account_id) LIKE ?', ["%{$searchTerm}%"])
                    ->orWhereRaw('LOWER(comment) LIKE ?', ["%{$searchTerm}%"]);
            });
        }

        // Apply sorting (default: id ascending)
        $sortBy = $request->get('sort_by', 'id');
        $sortDirection = $request->get('sort_direction', 'asc');
        $query->orderBy($sortBy, $sortDirection);

        $feedbacks = $query->get();

        return view('admin.feedbacks.index', compact('feedbacks', 'accounts'));
    }

    // Show form to create a feedback
    public function create(Feedback $feedback)
    {
        $accounts = Account::all();

        return view('admin.feedbacks.create', compact('feedback', 'accounts'));
    }

    // Store a new feedback
    public function store(Request $request)
    {
        $validated = $request->validate([
            'account_id' => 'required|integer',
            'comment'    => 'required|string|max:1000',
            'image'      => 'nullable|image|max:2048',
        ]);

        // Handle file upload
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('images/feedbacks', 'public');
        }

        Feedback::create($validated);

        return redirect()->route('feedbacks.index')->with('success', 'Feedback submitted successfully.');
    }

    // Show a single feedback
    public function show(Feedback $feedback)
    {
        $accounts = Account::all();

        return view('admin.feedbacks.show', compact('feedback', 'accounts'));
    }

    // Show form to edit feedback
    public function edit(Feedback $feedback)
    {
        $accounts = Account::all();

        return view('admin.feedbacks.edit', compact('feedback', 'accounts'));
    }

    // Update the feedback
    public function update(Request $request, Feedback $feedback)
    {
        $validated = $request->validate([
            'account_id' => 'required|integer',
            'comment'    => 'required|string|max:1000',
            'image'      => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('images/feedback', 'public');
        }

        $feedback->update($validated);

        return redirect()->route('feedbacks.index')->with('success', 'Feedback updated successfully.');
    }

    // Delete a feedback
    public function destroy(Feedback $feedback)
    {
        $feedback->delete();
        return redirect()->route('feedbacks.index')->with('success', 'Feedback deleted successfully.');
    }

    // Optional: Show feedback on public pages
    public function feedback_page(Feedback $feedback)
    {
        return view('Feedback', compact('feedback'));
    }
}
