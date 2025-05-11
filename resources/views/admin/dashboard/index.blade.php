@extends('admin.admin')

@section('title', 'Dashboard')

@section('content')
<div class="tab-pane fade {{ request()->is('admin/dashboard*') || request()->is('admin') ? 'show active' : '' }}" id="dashboard">
    <div class="container px-4 main">
        <div class="row align-items-center mb-4 mt-0 mt-md-4">
            <div class="col-md-12 col-lg-4 mb-3 mb-lg-0">
                <h1 class="mb-0">Dashboard</h1>
            </div>
        <div class="col-md-12 col-lg-8">
            <div class="row gx-2 justify-content-end align-items-center">
                <div class="col-12 col-lg-auto mb-3 mb-lg-0">
                    {{-- <a href="{{ route('orders.create') }}" class="btn w-100 w-lg-auto" style="background: #82C3EC;"><i class="bi bi-plus"></i> Add Order</a> --}}
                </div>
                <div class="col-12 col-lg-5">
                    {{-- <form method="GET" action="{{ route('orders.index') }}" class="w-100"> --}}
                        <div class="input-group">
                            <input type="text" name="search" class="form-control border-black border-1" placeholder="Search..." value="{{ request('search') }}">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <table id="basic-datatable" class="table dt-responsive nowrap w-100">
        <thead>
            <tr>
                <th>Name</th>
                <th>Position</th>
                <th>Office</th>
                <th>Age</th>
                <th>Start date</th>
                <th>Salary</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Tiger Nixon</td>
                <td>System Architect</td>
                <td>Edinburgh</td>
                <td>61</td>
                <td>2011/04/25</td>
                <td>$320,800</td>
            </tr>
            <tr>
                <td>Garrett Winters</td>
                <td>Accountant</td>
                <td>Tokyo</td>
                <td>63</td>
                <td>2011/07/25</td>
                <td>$170,750</td>
            </tr>
        </tbody>
    </table>
</div>
<script>
    $(document).ready(function() {
        $('#basic-datatable').DataTable(); // Initialize the DataTable
    });
</script>


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