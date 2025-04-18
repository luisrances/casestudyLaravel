@extends('admin')

@section('title', 'Products')

@section('content')
    <h1>products content</h1>
    <p>Welcome to the products section.</p>
    <div class="container">
        <h1>All Products</h1>
        <a href="{{ route('products.create') }}" class="btn btn-primary mb-3">Add Product</a>

        @foreach ($products as $product)
            <div class="card mb-2 p-3">
                <h4>{{ $product->name }}</h4>
                <p>{{ $product->description }}</p>
                <strong>₱{{ number_format($product->price, 2) }}</strong><br>
                <small>Stock: {{ $product->stock }}</small><br>
                <a href="{{ route('products.show', $product) }}" class="btn btn-sm btn-info mt-2">View</a>
                <a href="{{ route('products.edit', $product) }}" class="btn btn-sm btn-warning mt-2">Edit</a>
                <form action="{{ route('products.destroy', $product) }}" method="POST" style="display:inline;">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-danger mt-2">Delete</button>
                </form>
            </div>
        @endforeach
    </div>
@endsection
