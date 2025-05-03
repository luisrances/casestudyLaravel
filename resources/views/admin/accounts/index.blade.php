@extends('admin.admin')

@section('title', 'Accounts')

@section('content')
<div class="tab-pane fade {{ request()->is('admin/accounts*') ? 'show active' : '' }}" id="accounts">
    <div class="container px-4 main">
        <div class="row align-items-center mb-4 mt-0 mt-md-4">
            <div class="col-md-12 col-lg-4 mb-3 mb-lg-0">
                <h1 class="mb-0">Accounts</h1>
            </div>
            <div class="col-md-12 col-lg-8">
                <div class="row gx-2 justify-content-end align-items-center">
                    <div class="col-12 col-lg-auto mb-3 mb-lg-0">
                        <a href="{{ route('accounts.create') }}" class="btn w-100 w-lg-auto" style="background: #82C3EC;"><i class="bi bi-plus"></i> Add Account</a>
                    </div>
                    <div class="col-12 col-lg-5">
                        <form method="GET" action="{{ route('accounts.index') }}" class="w-100">
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
                            'first_name' => 'First Name',
                            'last_name' => 'Last Name',
                            'email' => 'Email',
                            // 'password' => 'Password',
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

                            $sortUrl = route('accounts.index', array_merge(request()->except(['sort_by', 'sort_direction']), ['sort_by' => $field, 'sort_direction' => $direction]));
                        @endphp
                        <td style="width: {{
                            match($field) {
                                'id' => '5%',
                                'first_name' => '20%',
                                'last_name' => '20%',
                                'email' => '20%',
                                // 'password' => '15%',
                                default => '15%',
                            }
                        }};">
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
                @foreach ($accounts as $account)
                    <div class="desktop-content" style="width: 100%; margin-bottom: 10px; border-radius: 10px; border: 1px solid #000000;">
                        <table class="text-center desktop-content" style="width: 100%; height: 70px;">
                            <thead>
                                <tr style="vertical-align: middle; cursor: pointer;" onclick="window.location='{{ route('accounts.show', $account->id) }}';">
                                    <td style="width: 5%; vertical-align: middle;">{{ $account->id }}</td>
                                    <td style="width: 20%; vertical-align: middle;">
                                        <p class="mb-0">{{ $account->first_name }}</p>
                                    </td>
                                    <td style="width: 20%; vertical-align: middle;">
                                        <p class="mb-0">{{ $account->last_name }}</p>
                                    </td>
                                    <td style="width: 20%; vertical-align: middle;">
                                        <p class="mb-0">{{ $account->email }}</p>
                                    </td>
                                    {{-- <td style="width: 15%; vertical-align: middle;">
                                        <p class="mb-0">{{ $account->password }}</p>
                                    </td> --}}
                                    <td style="width: 10%; vertical-align: middle;">
                                        <div class="row d-flex justify-content-evenly d-flex align-items-center gx-0">
                                            {{-- <div class="col-3">
                                                <a href="{{ route('accounts.show', $account) }}" class="btn btn-sm my-1 w-100" style="background: #82C3EC;">View</a>
                                            </div> --}}
                                            <div class="col-3">
                                                <a href="{{ route('accounts.edit', $account) }}" class="btn btn-sm w-100"><i class="bi bi-pencil-square text-info fs-4"></i></a>
                                            </div>
                                            <div class="col-3">
                                                <form action="{{ route('accounts.destroy', $account) }}" method="POST">
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


                    <div class="card p-1 mb-3 align-self-center px-2 shadow w-100 mobile-content" onclick="window.location='{{ route('accounts.show', $account->id) }}';" style="max-width: 590px; cursor: pointer;">
                        <div class="row align-items-center gx-1 my-0">
                            <div class="col-sm-4 d-flex justify-content-center">
                                @if ($account->image_path)
                                    <img src="{{ asset('storage/' . $account->image_path) }}" class="img-fluid" width="100">
                                @else
                                    <i class="bi bi-person" style="font-size: 80px; color: #000000;"></i>
                                @endif
                            </div>
                            <div class="col-sm-6">
                                <div class="card-body pt-1 pb-0 px-2 lh-1">
                                    <p class="fw-medium" style="margin-bottom: 0.5rem; font-size: 1.25rem;">{{ $account->first_name }} {{ $account->last_name }}</p>
                                    <p class="fw-medium" style="margin-bottom: 0.5rem; font-size: 1rem;">{{ $account->email }}</p>
                                    {{-- <p class="fw-medium" style="margin-bottom: 0.5rem; font-size: 1rem;">{{ $account->password }}</p> --}}
                                </div>
                            </div>
                            <div class="col-sm-2 d-flex flex-column">
                                <a href="{{ route('accounts.edit', $account) }}" class="btn btn-sm btn-info my-1 w-100">Edit</a>
                                <form action="{{ route('accounts.destroy', $account) }}" method="POST">
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