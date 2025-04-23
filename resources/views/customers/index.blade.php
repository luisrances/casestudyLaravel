@extends('admin')

@section('title', 'Customers')

@section('content')
<div class="tab-pane fade {{ request()->is('admin/customers*') ? 'show active' : '' }}" id="customers">
    <div class="container px-4 main">
        <h1 class="text-right mb-4 px-1">Customers</h1>

        <div class="row justify-content-md-between mb-3">
            <div class="col-12 col-md-5 col-lg-3 mb-2 mb-md-0">
                <a href="{{ route('customers.create') }}" class="btn btn-primary w-100">Add Customer</a>
            </div>
            <div class="col-12 col-md-5 col-lg-3">
                <form method="GET" action="{{ route('customers.index') }}">
                    <input type="text" name="search" class="form-control w-100" placeholder="Search..." value="{{ request('search') }}">
                </form>
            </div>
        </div>

            <table class="table text-center desktop-content" style="width: 98.5%; margin: 0 10px; border-radius: 10px;">
                <thead class="bg-white shadow-sm" style="border-radius: 10px;">
                    <tr>
                        <th style="width: 5%;">ID</th>
                        <th style="width: 10%;">Profile</th>    
                        <th style="width: 20%;">Name</th>
                        <th style="width: 15%;">Sex</th>
                        <th style="width: 10%;">Age</th>
                        <th style="width: 15%;">Email</th>
                        <th style="width: 25%;">Action</th>
                    </tr>
                </thead>
            </table>

        <div class="submain">
            <div class="d-flex justify-content-center flex-column custom-scroll">
                @foreach ($customers as $customer)
                    <table class="table text-center desktop-content" style="width: 100%; margin-bottom: 10px; border-radius: 10px;">
                        <thead class="bg-white shadow-sm">
                            <tr style="vertical-align: middle; height: 100px;">
                                <td style="width: 5%; vertical-align: middle;">{{ $customer->id }}</td>
                                <td style="width: 10%; vertical-align: middle;">
                                    @if ($customer->image_path)
                                        <img src="{{ asset('storage/' . $customer->image_path) }}" style="width: 80px; height: 80px; object-fit: cover;">
                                    @else
                                        <i class="bi bi-bag-dash" style="font-size: 55px; color: #000000;"></i>
                                    @endif
                                </td>
                                <td style="width: 20%; vertical-align: middle;">
                                    <p class="mb-0">{{ $customer->name }}</p>
                                </td>
                                <td style="width: 15%; vertical-align: middle;">
                                    <p class="mb-0">{{ $customer->sex }}</p>
                                </td>
                                <td style="width: 10%; vertical-align: middle;">
                                    <p class="mb-0">{{ $customer->age }}</p>
                                </td>
                                <td style="width: 15%; vertical-align: middle;">
                                    <p class="mb-0">{{ $customer->email }}</p>
                                </td>
                                <td style="width: 25%; vertical-align: middle;">
                                    <div class="row d-flex justify-content-evenly d-flex align-items-center gx-0">
                                        <div class="col-3">
                                            <a href="{{ route('customers.show', $customer) }}" class="btn btn-sm btn-info my-1 w-100">View</a>
                                        </div>
                                        <div class="col-3">
                                            <a href="{{ route('customers.edit', $customer) }}" class="btn btn-sm btn-warning w-100">Edit</a>
                                        </div>
                                        <div class="col-3">
                                            <form action="{{ route('customers.destroy', $customer) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-danger w-100">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </thead>
                    </table>


                    <div class="card p-1 mb-3 align-self-center px-2 shadow w-100 mobile-content" style="max-width: 590px;">
                        <div class="row align-items-center gx-1 my-0">
                            <div class="col-sm-4 d-flex justify-content-center">
                                @if ($customer->image_path)
                                    <img src="{{ asset('storage/' . $customer->image_path) }}" class="img-fluid" width="100">
                                @else
                                    <i class="bi bi-bag-dash" style="font-size: 80px; color: #000000;"></i>
                                @endif
                            </div>
                            <div class="col-sm-6">
                                <div class="card-body pt-1 pb-0 px-2 lh-1">
                                    <p class="fw-medium" style="margin-bottom: 0.5rem; font-size: 1.25rem;">{{ $customer->name }}</p>
                                    <p class="fw-normal" style="margin-bottom: 0.5rem; font-size: .9rem;">{{ $customer->sex }}</p>
                                    <p class="fw-medium" style="margin-bottom: 0.5rem; font-size: 1rem;">₱{{ $customer->age }}</p>
                                    <p class="fw-normal" style="margin-bottom: 0.5rem; font-size: .8rem;">Stock: {{ $customer->email }}</p>
                                </div>
                            </div>
                            <div class="col-sm-2 d-flex flex-column">
                                <a href="{{ route('customers.show', $customer) }}" class="btn btn-sm btn-info my-1 w-100">View</a>
                                <a href="{{ route('customers.edit', $customer) }}" class="btn btn-sm btn-warning my-1 w-100">Edit</a>
                                <form action="{{ route('customers.destroy', $customer) }}" method="POST">
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





{{-- hhhh --}}
{{-- <div class="tab-pane fade {{ request()->is('admin/customers*') ? 'show active' : '' }}" id="customers">
    <h1>Customers content</h1>
    <p>Welcome to the customers section.</p>

    <div class="container mt-4">
        <div class="d-flex justify-content-between mb-3">
            <a href="{{ route('customers.create') }}" class="btn btn-success">Add Customer</a>
            <form method="GET" action="{{ route('customers.index') }}">
                <input type="text" name="search" class="form-control" placeholder="Search..." value="{{ request('search') }}">
            </form>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>Name</th>
                        <th>Age</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($customers as $customer)
                    <tr>
                        <td>{{ $customer->name }}</td>
                        <td>{{ $customer->age }}</td>
                        <td>{{ $customer->email }}</td>
                        <td>
                            <a href="{{ route('customers.edit', $customer->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('customers.destroy', $customer->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div> --}}
@endsection