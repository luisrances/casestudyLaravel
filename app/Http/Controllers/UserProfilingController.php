<?php

namespace App\Http\Controllers;

use App\Models\UserProfiling;
use App\Models\Account;
use Illuminate\Http\Request;

class UserProfilingController extends Controller
{
    public function index(Request $request)
    {
        $accounts = Account::all();

        $query = UserProfiling::query();

        if ($request->has('search')) {
            $searchTerm = strtolower($request->search);
            $query->where(function ($q) use ($searchTerm) {
                $q->whereRaw('LOWER(account_id) LIKE ?', ["%{$searchTerm}%"])
                    ->orWhereRaw('LOWER(sex) LIKE ?', ["%{$searchTerm}%"])
                    ->orWhereRaw('LOWER(experience_level) LIKE ?', ["%{$searchTerm}%"]);
            });
        }

        $sortBy = $request->get('sort_by', 'id');
        $sortDirection = $request->get('sort_direction', 'asc');
        $query->orderBy($sortBy, $sortDirection);

        $userProfiling = $query->get();

        return view('admin.user_profilings.index', compact('userProfiling', 'accounts'));
    }

    public function create()
    {
        $accounts = Account::all();
        return view('admin.user_profilings.create', compact('accounts'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'account_id' => 'required|integer',
            'birthdate' => 'nullable|date',
            'sex' => 'nullable|string',
            'height' => 'nullable|numeric',
            'weight' => 'nullable|numeric',
            'activity_type' => 'nullable|array',
            'terrain' => 'nullable|array',
            'experience_level' => 'nullable|string',
            'maintenance' => 'nullable|in:yes,no',
            'custom_parts' => 'nullable|in:yes,no',
        ]);

        $validated['activity_type'] = json_encode($request->activity_type ?? []);
        $validated['terrain'] = json_encode($request->terrain ?? []);
        $validated['maintenance'] = $request->maintenance === 'yes';
        $validated['custom_parts'] = $request->custom_parts === 'yes';

        UserProfiling::create($validated);

        return redirect()->route('user_profilings.index')->with('success', 'User profile created successfully.');
    }

    public function show(UserProfiling $userProfiling)
    {
        $accounts = Account::all();
        return view('admin.user_profilings.show', compact('userProfiling', 'accounts'));
    }

    public function edit(UserProfiling $userProfiling)
    {
        $accounts = Account::all();
        return view('admin.user_profilings.edit', compact('userProfiling', 'accounts'));
    }

    public function update(Request $request, UserProfiling $userProfiling)
    {
        $validated = $request->validate([
            'account_id' => 'required|integer',
            'birthdate' => 'nullable|date',
            'sex' => 'nullable|string',
            'height' => 'nullable|numeric',
            'weight' => 'nullable|numeric',
            'activity_type' => 'nullable|array',
            'terrain' => 'nullable|array',
            'experience_level' => 'nullable|string',
            'maintenance' => 'nullable|in:yes,no',
            'custom_parts' => 'nullable|in:yes,no',
        ]);

        $validated['activity_type'] = json_encode($request->activity_type ?? []);
        $validated['terrain'] = json_encode($request->terrain ?? []);
        $validated['maintenance'] = $request->maintenance === 'yes';
        $validated['custom_parts'] = $request->custom_parts === 'yes';

        $userProfiling->update($validated);

        return redirect()->route('user_profilings.index')->with('success', 'User profile updated successfully.');
    }

    public function destroy(UserProfiling $userProfiling)
    {
        $userProfiling->delete();
        return redirect()->route('user_profilings.index')->with('success', 'User profile deleted successfully.');
    }

    // create a user-profile after signup
    public function createFromRegistration($account_id)
    {
        $accounts = Account::all();
        return view('create_user_profiling.index', compact('accounts', 'account_id'));
    }
    public function storeFormRegistration(Request $request)
    {
        $validated = $request->validate([
            'account_id' => 'required|integer',
            'birthdate' => 'nullable|date',
            'sex' => 'nullable|string',
            'height' => 'nullable|numeric',
            'weight' => 'nullable|numeric',
            'activity_type' => 'nullable|array',
            'terrain' => 'nullable|array',
            'experience_level' => 'nullable|string',
            'maintenance' => 'nullable|in:yes,no',
            'custom_parts' => 'nullable|in:yes,no',
        ]);

        $validated['activity_type'] = json_encode($request->activity_type ?? []);
        $validated['terrain'] = json_encode($request->terrain ?? []);
        $validated['maintenance'] = $request->maintenance === 'yes';
        $validated['custom_parts'] = $request->custom_parts === 'yes';

        UserProfiling::create($validated);

        // Clear the profiling session flag
        session()->forget('needs_profiling');
        return redirect()->route('Home')->with('success', 'User profile created successfully.');
    }
}
