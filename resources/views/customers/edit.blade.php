@extends('admin')

@section('content')
<div class="container mt-4">
    <h2>Edit Customer</h2>

    <form method="POST" action="{{ route('customers.update', $customer->id) }}">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label>Name:</label>
            <input type="text" name="name" class="form-control" value="{{ $customer->name }}" required>
        </div>
        <div class="form-group">
            <label>Age:</label>
            <input type="number" name="age" class="form-control" value="{{ $customer->age }}" required>
        </div>
        <div class="form-group">
            <label>Email:</label>
            <input type="email" name="email" class="form-control" value="{{ $customer->email }}" required>
        </div>
        <button type="submit" class="btn btn-warning">Update</button>
    </form>
</div>
@endsection
