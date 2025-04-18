<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// class CustomerController extends Controller
// {
//     public function index()
//     {
//         // Sample data array
//         $names = ['John Doe', 'Jane Smith', 'Alice Johnson'];
//         $ages = [25, 30, 22];
//         $emails = ['johndoe@example.com', 'janesmith@example.com', 'alicejohnson@example.com'];

//         // Now, if you want to structure them together dynamically:
//         $customers = [];
//         for ($i = 0; $i < count($names); $i++) {
//             $customers[] = [
//                 'name' => $names[$i],
//                 'age' => $ages[$i],
//                 'email' => $emails[$i],
//             ];
//         }

//         // Pass data to the view
//         return view('customers.index', compact('customers'));
//     }
// }


// sample if used in database
// class CustomerController extends Controller
// {
//     public function index()
//     {
//         // Retrieve data from the database
//         $names = Customer::pluck('name')->toArray();
//         $ages = Customer::pluck('age')->toArray();
//         $emails = Customer::pluck('email')->toArray();

//         // Pass the variables to the view
//         return view('customers.index', compact('names', 'ages', 'emails'));
//     }
// }

// @for($i = 0; $i < count($names); $i++)
// <tr>
//     <td>{{ $names[$i] }}</td>
//     <td>{{ $ages[$i] }}</td>
//     <td>{{ $emails[$i] }}</td>
// </tr>
// @endfor



// database usage
use App\Models\Customer;
class CustomerController extends Controller
{
    public function index(Request $request)
    {
        // Retrieve customer data from the database with optional search
        $query = Customer::query();

        if ($request->has('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'LIKE', '%' . $request->search . '%')
                    ->orWhere('email', 'LIKE', '%' . $request->search . '%')
                    ->orWhere('age', 'LIKE', '%' . $request->search . '%');
            });
        }

        $customers = $query->get();

        return view('customers.index', compact('customers'));
    }

    public function create()
    {
        return view('customers.create');
    }

    public function store(Request $request)
    {
        Customer::create($request->validate([
            'name' => 'required|string|max:255',
            'age' => 'required|integer',
            'email' => 'required|email|unique:customers',
        ]));

        return redirect()->route('customers.index')->with('success', 'Customer added successfully!');
    }

    public function edit(Customer $customer)
    {
        return view('customers.edit', compact('customer'));
    }

    public function update(Request $request, Customer $customer)
    {
        $customer->update($request->validate([
            'name' => 'required|string|max:255',
            'age' => 'required|integer',
            'email' => 'required|email|unique:customers,email,' . $customer->id,
        ]));

        return redirect()->route('customers.index')->with('success', 'Customer updated successfully!');
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();
        return redirect()->route('customers.index')->with('success', 'Customer deleted successfully!');
    }
}