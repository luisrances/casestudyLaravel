@extends('admin.admin')

@section('title', 'Products')

@section('content')
<div class="tab-pane fade {{ request()->is('admin/products*') ? 'show active' : '' }}" id="products">
    <div class="container px-4 main">
        <h1 class="text-right mb-4 px-1">Products</h1>

        <div class="row justify-content-md-between mb-3">
            <div class="col-12 col-md-5 col-lg-3 mb-2 mb-md-0">
                <a href="{{ route('products.create') }}" class="btn w-100" style="background: #82C3EC;">Add Product</a>
            </div>
            <div class="col-12 col-md-5 col-lg-3">
                <form method="GET" action="{{ route('products.index') }}">
                    <input type="text" name="search" class="form-control w-100 text-black border-black border-2" placeholder="Search..." value="{{ request('search') }}">
                </form>
            </div>
        </div>

            <table class="text-center desktop-content" style="width: 99.5%; margin: 0 10px;">
                <tr>
                    <td style="width: 5%;">ID</td>
                    <td style="width: 25%;">Name</td>
                    <td style="width: 15%;">Category</td>
                    <td style="width: 10%;">Stock</td>
                    <td style="width: 15%;">Price</td>
                    <td style="width: 30%;">Action</td>
                </tr>
            </table>

        <div class="submain">
            <div class="d-flex justify-content-center flex-column custom-scroll">
                @foreach ($products as $product)
                    <div class="desktop-content" style="width: 100%; margin-bottom: 10px; border-radius: 10px; border: 1px solid #000000;">
                        <table class="text-center desktop-content" style="width: 100%; height: 70px;">
                            <thead>
                                <tr style="vertical-align: middle;">
                                    <td style="width: 5%; vertical-align: middle;">{{ $product->id }}</td>
                                    <td style="width: 25%; vertical-align: middle;">
                                        <p class="mb-0">{{ $product->name }}</p>
                                    </td>
                                    <td style="width: 15%; vertical-align: middle;">
                                        <p class="mb-0">{{ $product->category }}</p>
                                    </td>
                                    <td style="width: 10%; vertical-align: middle;">
                                        <p class="mb-0">Stock: {{ $product->stock }}</p>
                                    </td>
                                    <td style="width: 15%; vertical-align: middle;">
                                        <p class="mb-0">₱{{ number_format($product->price, 2) }}</p>
                                    </td>
                                    <td style="width: 30%; vertical-align: middle;">
                                        <div class="row d-flex justify-content-evenly d-flex align-items-center gx-0">
                                            <div class="col-3">
                                                <a href="{{ route('products.show', $product) }}" class="btn btn-sm my-1 w-100" style="background: #82C3EC;">View</a>
                                            </div>
                                            <div class="col-3">
                                                <a href="{{ route('products.edit', $product) }}" class="btn btn-sm w-100" style="background: #82C3EC;">Edit</a>
                                            </div>
                                            <div class="col-3">
                                                <form action="{{ route('products.destroy', $product) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-sm w-100" style="background: #82C3EC;">Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </thead>
                        </table>
                    </div>

                    <div class="card p-1 mb-3 align-self-center px-2 shadow w-100 mobile-content" style="max-width: 590px;">
                        <div class="row align-items-center gx-1 my-0">
                            <div class="col-sm-4 d-flex justify-content-center">
                                @if ($product->image_path)
                                    <img src="{{ asset('storage/' . $product->image_path) }}" class="img-fluid" width="100">
                                @else
                                    <i class="bi bi-bag-dash" style="font-size: 80px; color: #000000;"></i>
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
</div>
<style>
    .submain {
        max-height: 65vh; 
        /* height: min-content;   */
        margin: 10px;
        overflow-x: hidden;
        overflow-y: auto;
        margin-right: -2px;
        scrollbar-width: thin;
        scrollbar-color: rgba(0,0,0,0.2) transparent;
    }
    .custom-scroll {
        position: relative;
        border-radius: 10px;
    }
    @media (max-width: 767px) {
        .main{
            min-width: 90vw !important;
            min-height: 20vh !important;
            max-height: calc(100vh - 100px) !important;
            margin: 0px !important;
            overflow: hidden;
        }.submain{
            min-height: 10vh !important;
            max-height: calc(75vh - 130px) !important;
            overflow-y: scroll !important;
            margin: 0px !important;
            font-size:inherit;
        }
    }

    .mobile-content {
        display: none;
    }.desktop-content {
            display: auto;
        }
    @media (max-width: 1024px) {
        .desktop-content {
            display: none;
        }

        .mobile-content {
            display: block;
        }
    }
</style>
@endsection
