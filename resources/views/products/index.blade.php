@extends('admin')

@section('title', 'Products')

@section('content')
<div class="tab-pane fade {{ request()->is('admin/products*') ? 'show active' : '' }}" id="products">
    <div class="container px-4">
        <h1 class="text-center mb-4">All Products</h1>

        <div class="row justify-content-md-between mb-3">
            <div class="col-12 col-md-5 col-lg-3 mb-2 mb-md-0">
                <a href="{{ route('products.create') }}" class="btn btn-primary w-100">Add Product</a>
            </div>
            <div class="col-12 col-md-5 col-lg-3">
                <form method="GET" action="{{ route('products.index') }}">
                    <input type="text" name="search" class="form-control w-100" placeholder="Search..." value="{{ request('search') }}">
                </form>
            </div>
        </div>

        <div class="row d-flex justify-content-around overflow-y-auto custom-scroll main" style="min-height: 75vh; margin: 10px;">
            @foreach ($products as $product)
                <div class="card p-1 mb-3 align-self-center px-2 shadow" style="max-width: 590px;">
                    <div class="row align-items-center gx-1 my-0">
                        <div class="col-sm-4 d-flex justify-content-center">
                            @if ($product->image_path)
                                <img src="{{ asset('storage/' . $product->image_path) }}" class="img-fluid" width="100">
                            @else
                                <i class="bi bi-person" style="font-size: 80px; color: #000000;"></i>
                            @endif
                        </div>
                        <div class="col-sm-6">
                            <div class="card-body pt-1 pb-0 px-2 lh-1">
                                <p class="fw-medium" style="margin-bottom: 0.5rem; font-size: 1.25rem;">{{ $product->name }}</p>
                                <p class="fw-normal" style="margin-bottom: 0.5rem; font-size: .9rem;">{{ $product->description }}</p>
                                <p class="fw-normal" style="margin-bottom: 0.5rem; font-size: 1rem;">Category</p>
                                <p class="fw-medium" style="margin-bottom: 0.5rem; font-size: 1rem;">₱{{ number_format($product->price, 2) }}</p>
                                <p class="fw-normal" style="margin-bottom: 0.5rem; font-size: .8rem;">Stock: {{ $product->stock }}</p>
                            </div>
                        </div>
                        <div class="col-sm-2 d-flex flex-column">
                            <a href="{{ route('products.show', $product) }}" class="btn btn-sm btn-info my-1 w-100">View</a>
                            <a href="{{ route('products.edit', $product) }}" class="btn btn-sm btn-warning my-1 w-100">Edit</a>
                            <form action="{{ route('products.destroy', $product) }}" method="POST">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-danger my-1 w-100">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
<style>
    .custom-scroll {
        max-height: 200px;
        overflow-y: scroll;
        padding-right: -8px; /* Optional: space so content doesn't get hidden under scrollbar */
        scrollbar-width: thin;
        scrollbar-color: rgba(0,0,0,0.2) transparent;
        position: relative;
        border-radius: 10px;
    }
    @media (max-width: 767px) {
        .main{
            min-height: 20vh !important;
            max-height: 60vh !important;
            overflow-y: scroll !important;
            margin: 0px !important;
        }
    }
</style>
@endsection
