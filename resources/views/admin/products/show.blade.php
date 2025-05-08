@extends('admin.admin')

@section('content')
<div class="p-0 m-0 main" style="min-height: 93vh; display: flex; justify-content: center; align-items: center;">
    <div class="rounded-3  w-lg-75 w-xl-60 w-md-90 overflow-y-auto submain" style="max-width: 100%;">
        <div class="row g-0 flex-column flex-md-row">
            <div class="col-md-5 p-4  pb-md-4 border-md-right d-flex justify-content-center align-items-md-center align-items-end picture">
                @if ($product->image_path)
                    <div class="rounded-lg overflow-hidden d-flex justify-content-center align-items-md-center align-items-end" style="width: 100%; height: auto; aspect-ratio: 4 / 3; max-height: 400px; min-height: 200px;">
                        <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}" class="img-fluid" style="object-fit: contain; max-height: 100%; max-width: 100%;">
                    </div>
                @else
                    <i class="bi bi-bag-dash rounded-lg overflow-hidden d-flex justify-content-center align-items-md-center align-items-end" style="font-size: 200px; color: black;"></i>
                @endif
            </div>
            <div class="col-md-7 p-4 pt-0 pt-md-4">
                <h2 class="font-weight-semibold text-dark mb-3">{{ $product->name }}</h2>
                <h4 class="text-primary mb-3">₱{{ number_format($product->price, 2) }}</h4>
                <p class="text-secondary mb-4" style="line-height: 1.7;">{{ $product->description }}</p>
                <hr class="my-4">
                <div class="d-flex align-items-center mb-3">
                    <span class="text-muted me-2"><i class="bi bi-box-seam mr-1"></i> Stock:</span>
                    <span class="font-weight-medium">{{ $product->stock }}</span>
                    <span class="mx-3 text-muted">|</span>
                    <span class="text-muted me-2"><i class="bi bi-tag mr-1"></i> Category:</span>
                    <span class="font-weight-medium">{{ $product->category }}</span>
                </div>

                <div class="mt-4 row gx-3">
                    <div class="col-6">
                        <a href="{{ route('products.edit', $product) }}" class="btn btn-primary w-100 h-100 rounded-pill px-1 py-2 shadow-sm text-justify d-block">
                            <i class="bi bi-pencil me-1"></i> Edit
                        </a>
                    </div>
                    <div class="col-6">
                        <a href="{{ route('products.index') }}" class="btn btn-outline-secondary w-100 h-100 rounded-pill px-1 py-2 shadow-sm text-justify d-block">
                            <i class="bi bi-arrow-left me-1"></i> Back
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    @media (max-width: 767px) {
        .main{
            max-height: calc(100vh - 100px) !important;
            overflow-y: scroll;
        }.submain{
            max-height: 80vh !important;
        }
    }
    @media (max-height: 700px) {
        .main{
            margin-top: 5vw !important;
        }
    }
</style>
@endsection