@extends('admin')

@section('content')
<div class="container">
    <h1>Edit Product</h1>
    <form action="{{ route('products.update', $product) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')
        @include('products.form')
        <button class="btn btn-primary">Update</button>
    </form>
</div>
@endsection