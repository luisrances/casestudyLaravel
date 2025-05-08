@extends('admin.admin')

@section('title', 'Wislists')

@section('content')
<div class="tab-pane fade {{ request()->is('admin/wishlists*') ? 'show active' : '' }}" id="wishlists">
    <div class="container px-4 main">

        <div class="row align-items-center mb-4 mt-0 mt-md-4">
            <div class="col-md-12 col-lg-4 mb-3 mb-lg-0">
                <h1 class="mb-0">Wislists</h1>
            </div>
            <div class="col-md-12 col-lg-8">
                <div class="row gx-2 justify-content-end align-items-center">
                    <div class="col-12 col-lg-auto mb-3 mb-lg-0">
                        <a href="{{ route('wishlists.create') }}" class="btn w-100 w-lg-auto" style="background: #82C3EC;"><i class="bi bi-plus"></i> Add Wislist</a>
                    </div>
                    <div class="col-12 col-lg-5">
                        <form method="GET" action="{{ route('wishlists.index') }}" class="w-100">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control border-black border-1" placeholder="Search..." value="{{ request('search') }}">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <table class="text-center desktop-content" style="width: 99.5%; margin: 0 10px;">
            <thead>
                <tr>
                    @php
                        $currentSortBy = request('sort_by');
                        $currentSortDirection = request('sort_direction', 'asc');
                        $sortableColumns = [
                            'id' => 'ID',
                            'product_id' => 'Product',
                            'account_id' => 'Customer',
                        ];
                    @endphp

                    @foreach ($sortableColumns as $field => $label)
                        @php
                            $direction = 'asc';
                            $icon = '<i class="bi bi-arrow-down-up" style="font-size: .8rem;"></i>';
                            $isActive = ($currentSortBy === $field);

                            if ($isActive) {
                                $direction = ($currentSortDirection === 'asc') ? 'desc' : 'asc';
                                $icon = $currentSortDirection === 'asc' ? ' ↑' : ' ↓';
                            }

                            $sortUrl = route('wishlists.index', array_merge(request()->except(['sort_by', 'sort_direction']), ['sort_by' => $field, 'sort_direction' => $direction]));
                        @endphp
                        <td style="width: {{ match($field) {
                                'id' => '5%',
                                'product_id' => '40%',
                                'account_id' => '40%',
                                default => '15%',
                            } }};">
                            <a href="{{ $sortUrl }}" class="{{ $isActive ? 'active-sort' : '' }}" style="text-decoration: none; color: inherit; display: block">
                                <span>{{ $label }}</span>
                                {!! $icon !!}
                            </a>
                        </td>
                    @endforeach
                    <td style="width: 15%;">Action</td>
                </tr>
            </thead>
        </table>

        <div class="submain">
            <div class="d-flex justify-content-center flex-column custom-scroll">
                @foreach ($wishlists as $wishlist)
                    <div class="desktop-content" style="width: 100%; margin-bottom: 10px; border-radius: 10px; border: 1px solid #000000;">
                        <table class="text-center desktop-content" style="width: 100%; height: 70px;">
                            <thead>
                                <tr style="vertical-align: middle; cursor: pointer;" onclick="window.location='{{ route('wishlists.show', $wishlist->id) }}';">
                                    <td style="width: 5%; vertical-align: middle;">{{ $wishlist->id }}</td>
                                    <td style="width: 40%; vertical-align: middle;">
                                        @foreach ($products as $product)
                                            @if ($wishlist->product_id == $product->id)
                                                <p class="mb-0">{{ $product->name }}</p>
                                            @endif
                                        @endforeach
                                    </td>
                                    <td style="width: 40%; vertical-align: middle;">
                                        @foreach ($accounts as $account)
                                            @if ($wishlist->account_id == $account->id)
                                                <p class="mb-0">{{ $account->first_name }} {{ $account->last_name }}</p>
                                            @endif
                                        @endforeach
                                    </td>
                                    <td style="width: 15%; vertical-align: middle;">
                                        <div class="row d-flex justify-content-evenly d-flex align-items-center gx-0">
                                            <div class="col-3">
                                                <a href="{{ route('wishlists.edit', $wishlist) }}" class="btn btn-sm w-100"><i class="bi bi-pencil-square text-info fs-4"></i></a>
                                            </div>
                                            <div class="col-3">
                                                <form action="{{ route('wishlists.destroy', $wishlist) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-sm w-100"><i class="bi bi-trash text-info fs-4"></i></button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </thead>
                        </table>
                    </div>

                    <div class="card p-1 mb-3 align-self-center px-2 shadow w-100 mobile-content" onclick="window.location='{{ route('wishlists.show', $wishlist->id) }}';" style="max-width: 590px; cursor: pointer;">
                        <div class="row align-items-center gx-1 my-0">
                            <div class="col-sm-8">
                                <div class="card-body pt-1 pb-0 px-2 lh-1">
                                    <p class="fw-medium" style="margin-bottom: 0.5rem; font-size: 1.25rem;">Wislist #{{ $wishlist->id }}</p>
                                    <p class="fw-normal" style="margin-bottom: 0.5rem; font-size: .9rem;">Product: {{ $wishlist->product_id }}</p>
                                    <p class="fw-normal" style="margin-bottom: 0.5rem; font-size: .9rem;">Customer: {{ $wishlist->customer_id }}</p>
                                    <p class="fw-normal" style="margin-bottom: 0.5rem; font-size: 1rem;">Quantity: {{ $wishlist->quantity }}</p>
                                </div>
                            </div>
                            <div class="col-sm-4 d-flex flex-column">
                                <a href="{{ route('wishlists.edit', $wishlist) }}" class="btn btn-sm btn-info my-1 w-100">Edit</a>
                                <form action="{{ route('wishlists.destroy', $wishlist) }}" method="POST">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-info my-1 w-100">Delete</button>
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
        max-height: 69vh;
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
