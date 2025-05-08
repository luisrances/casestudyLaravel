@extends('admin.admin')

@section('content')
<div class="p-0 m-0 main" style="min-height: 93vh; display: flex; justify-content: center; align-items: center;">
    <div class="rounded-3 w-lg-75 w-xl-60 w-md-90 overflow-y-auto submain" style="max-width: 90%;">
        @foreach ($products as $product)
            @foreach ($accounts as $account)
                @if ($wishlist->account_id == $account->id && $wishlist->product_id == $product->id)
                    <div class="row g-0 flex-column flex-md-row">
                        <div class="col-md-5 p-4 pb-md-4 border-md-right d-flex justify-content-center align-items-md-center align-items-end picture">
                            @if ($wishlist->product_id == $product->id && $product->image_path)
                                <div class="rounded-lg overflow-hidden d-flex justify-content-center align-items-md-center align-items-end" style="width: 100%; height: auto; aspect-ratio: 4 / 3; max-height: 400px; min-height: 200px;">
                                    <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}" class="img-fluid" style="object-fit: contain; max-height: 100%; max-width: 100%;">
                                </div>
                            @else
                                <i class="bi bi-cart rounded-lg overflow-hidden d-flex justify-content-center align-items-md-center align-items-end" style="font-size: 200px; color: black;"></i>
                            @endif
                        </div>

                        <div class="col-md-7 p-4 pt-0 pt-md-4">
                            <h2 class="font-weight-semibold text-dark mb-3">wishlist #{{ $wishlist->id }}</h2>
                            <p class="text-secondary mb-2"><strong>Product:</strong> {{ $product->name }}</p>
                            <p class="text-secondary mb-2"><strong>Account:</strong> {{ $account->first_name ?? 'Guest' }} {{ $account->last_name }}</p>
                            <p class="text-secondary mb-2"><strong>Unit Price:</strong> {{ $product->price }}</p>
                            <hr class="my-4">
                            <div class="d-flex align-items-center mb-3">
                                <span class="text-muted me-2"><i class="bi bi-calendar3 mr-1"></i> Created on: </span>
                                <span class="font-weight-medium">{{ $wishlist->created_at ? $wishlist->created_at->format('F d, Y h:i A') : 'N/A' }}</span>
                            </div>

                            <div class="mt-4 row gx-3">
                                <div class="col-6">
                                    <a href="{{ route('wishlists.edit', $wishlist) }}" class="btn btn-primary w-100 h-100 rounded-pill px-1 py-2 shadow-sm text-justify d-block">
                                        <i class="bi bi-pencil me-1"></i> Edit Wishlist
                                    </a>
                                </div>
                                <div class="col-6">
                                    <a href="{{ route('wishlists.index') }}" class="btn btn-outline-secondary w-100 h-100 rounded-pill px-1 py-2 shadow-sm text-justify d-block">
                                        <i class="bi bi-arrow-left me-1"></i> Back to Wishlists
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        @endforeach
    </div>
</div>

<style>
    @media (max-width: 767px) {
        .main {
            max-height: calc(100vh - 100px) !important;
            overflow-y: scroll;
        }
        .submain {
            max-height: 80vh !important;
        }
    }
    @media (max-height: 700px) {
        .main {
            margin-top: 5vw !important;
        }
    }
</style>
@endsection
