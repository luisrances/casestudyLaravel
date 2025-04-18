@extends('admin')

@section('content')
<div class="container">
    <h1>Add New Product</h1>
    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('products.form')
        <button class="btn btn-success">Save</button>
    </form>
</div>
@endsection
