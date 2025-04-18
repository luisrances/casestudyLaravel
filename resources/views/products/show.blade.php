@extends('admin')

@section('content')
<div class="container">
    <h1>{{ $product->name }}</h1>
    <p>{{ $product->description }}</p>
    <strong>₱{{ number_format($product->price, 2) }}</strong><br>
    <p>Stock: {{ $product->stock }}</p>
    <p>Category: {{ $product->category }}</p>
    @if ($product->image_path)
        <img src="{{ asset('storage/' . $product->image_path) }}" width="200">
    @endif
    <br><br>
    <a href="{{ route('products.edit', $product) }}" class="btn btn-warning">Edit</a>
    <a href="{{ route('products.index') }}" class="btn btn-secondary">Back</a>
</div>
@endsection
