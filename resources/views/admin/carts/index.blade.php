@extends('admin.admin')

@section('title', 'Carts')

@section('content')
<div class="tab-pane fade {{ request()->is('admin/carts*') ? 'show active' : '' }}" id="carts">
    <div class="container px-4 main">

        <div class="row align-items-center mb-4 mt-0 mt-md-4">
            <div class="col-md-12 col-lg-4 mb-3 mb-lg-0">
                <h1 class="mb-0">Carts</h1>
            </div>
            <div class="col-md-12 col-lg-8">
                <div class="row gx-2 justify-content-end align-items-center">
                    <div class="col-12 col-lg-auto mb-3 mb-lg-0">
                        <a href="{{ route('carts.create') }}" class="btn w-100 w-lg-auto" style="background: #82C3EC;"><i class="bi bi-plus"></i> Add Cart</a>
                    </div>
                    <div class="col-12 col-lg-5">
                        <form method="GET" action="{{ route('carts.index') }}" class="w-100">
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
                        $currentSortDirection = request('sort_direction', 'asc'); // Default to asc
                        $sortableColumns = [
                            'id' => 'ID',
                            'product_id' => 'Product',
                            'account_id' => 'Customer',
                            'quantity' => 'Quantity',
                        ];
                    @endphp

                    {{-- Loop through sortable columns to create headers with sort links --}}
                    @foreach ($sortableColumns as $field => $label)
                        @php
                            $direction = 'asc';
                            $icon = '<i class="bi bi-arrow-down-up" style="font-size: .8rem;"></i>';
                            $isActive = ($currentSortBy === $field);

                            if ($isActive) {
                                // If already sorted by this field, toggle direction
                                $direction = ($currentSortDirection === 'asc') ? 'desc' : 'asc';
                                $icon = $currentSortDirection === 'asc' ? ' ↑' : ' ↓'; // Indicate current sort direction
                            }

                            // Construct the URL for the next sort state
                            $sortUrl = route('carts.index', array_merge(request()->except(['sort_by', 'sort_direction']), ['sort_by' => $field, 'sort_direction' => $direction]));
                        @endphp
                        {{-- Apply styles or classes to the td as needed --}}
                        <td style="width: {{ match($field) {
                                'id' => '5%',
                                'quantity' => '10%',
                                default => '15%',
                            } }};">
                            {{-- <a href="{{ $sortUrl }}" class="{{ $isActive ? 'active-sort' : '' }}" style="text-decoration: none; color: inherit; display: block;">
                                {{ $label }}{{ $icon }}
                            </a> --}}
                            <a href="{{ $sortUrl }}" class="{{ $isActive ? 'active-sort' : '' }}" style="text-decoration: none; color: inherit; display: block">
                                <span>{{ $label }}</span>
                                {!! $icon !!}
                            </a>
                        </td>
                    @endforeach
                    <td style="width: 10%;">Action</td>
                </tr>
            </thead>
        </table>

        <div class="submain">
            <div class="d-flex justify-content-center flex-column custom-scroll">
                @foreach ($carts as $cart)
                    <div class="desktop-content" style="width: 100%; margin-bottom: 10px; border-radius: 10px; border: 1px solid #000000;">
                        <table class="text-center desktop-content" style="width: 100%; height: 70px;">
                            <thead>
                                <tr style="vertical-align: middle; cursor: pointer;" onclick="window.location='{{ route('carts.show', $cart->id) }}';">
                                    <td style="width: 5%; vertical-align: middle;">{{ $cart->id }}</td>
                                    <td style="width: 15%; vertical-align: middle;">
                                        @foreach ($products as $product)
                                            @if ($cart->product_id == $product->id)
                                                <p class="mb-0">{{ $product->name }}</p>
                                            @endif
                                        @endforeach
                                        {{-- <p class="mb-0">{{ $cart->product_id }}</p> --}}
                                    </td>
                                    <td style="width: 15%; vertical-align: middle;">
                                        @foreach ($accounts as $account)
                                            @if ($cart->account_id == $account->id)
                                                <p class="mb-0">{{ $account->first_name }} {{ $account->last_name }}</p>
                                            @endif
                                        @endforeach
                                        {{-- <p class="mb-0">{{ $cart->account_id }}</p> --}}
                                    </td>
                                    <td style="width: 10%; vertical-align: middle;">
                                        <p class="mb-0">{{ $cart->quantity }}</p>
                                    </td>
                                    <td style="width: 10%; vertical-align: middle;">
                                        <div class="row d-flex justify-content-evenly d-flex align-items-center gx-0">
                                            {{-- <div class="col-3">
                                                <a href="{{ route('carts.show', $cart) }}" class="btn btn-sm my-1 w-100" style="background: #82C3EC;">View</a>
                                            </div> --}}
                                            <div class="col-3">
                                                <a href="{{ route('carts.edit', $cart) }}" class="btn btn-sm w-100"><i class="bi bi-pencil-square text-info fs-4"></i></a>
                                            </div>
                                            <div class="col-3">
                                                <form action="{{ route('carts.destroy', $cart) }}" method="POST">
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

                    <div class="card p-1 mb-3 align-self-center px-2 shadow w-100 mobile-content" onclick="window.location='{{ route('carts.show', $cart->id) }}';" style="max-width: 590px; cursor: pointer;">
                        <div class="row align-items-center gx-1 my-0">
                            <div class="col-sm-8">
                                <div class="card-body pt-1 pb-0 px-2 lh-1">
                                    <p class="fw-medium" style="margin-bottom: 0.5rem; font-size: 1.25rem;">Cart #{{ $cart->id }}</p>
                                    <p class="fw-normal" style="margin-bottom: 0.5rem; font-size: .9rem;">Product: {{ $cart->product_id }}</p>
                                    <p class="fw-normal" style="margin-bottom: 0.5rem; font-size: .9rem;">Customer: {{ $cart->customer_id }}</p>
                                    <p class="fw-normal" style="margin-bottom: 0.5rem; font-size: 1rem;">Quantity: {{ $cart->quantity }}</p>
                                </div>
                            </div>
                            <div class="col-sm-4 d-flex flex-column">
                                <a href="{{ route('carts.edit', $cart) }}" class="btn btn-sm btn-info my-1 w-100">Edit</a>
                                <form action="{{ route('carts.destroy', $cart) }}" method="POST">
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
