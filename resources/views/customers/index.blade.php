@extends('admin')

@section('title', 'Customers')

@section('content')
<div class="tab-pane fade {{ request()->is('admin/customers*') ? 'show active' : '' }}" id="customers">
    <h1>Customers content</h1>
    <p>Welcome to the customers section.</p>

    <div class="container mt-4">
        <div class="d-flex justify-content-between mb-3">
            <a href="{{ route('customers.create') }}" class="btn btn-success">Add Customer</a>
            <form method="GET" action="{{ route('customers.index') }}">
                <input type="text" name="search" class="form-control" placeholder="Search..." value="{{ request('search') }}">
            </form>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>Name</th>
                        <th>Age</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($customers as $customer)
                    <tr>
                        <td>{{ $customer->name }}</td>
                        <td>{{ $customer->age }}</td>
                        <td>{{ $customer->email }}</td>
                        <td>
                            <a href="{{ route('customers.edit', $customer->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('customers.destroy', $customer->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection