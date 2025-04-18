@extends('admin')

@section('content')
<div class="container mt-4">
    <h2>Add Customer</h2>

    <form method="POST" action="{{ route('customers.store') }}">
        @csrf
        <div class="form-group">
            <label>Name:</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Age:</label>
            <input type="number" name="age" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Email:</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Save</button>
    </form>
</div>
@endsection
