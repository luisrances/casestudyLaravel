<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
</head>
<body>
    <div class="container-fluid p-0 d-flex vh-100 text-right">
        <div class="main-sidebar">
            <div class="d-flex flex-column bg-body-tertiary sidebar shadow" id="sidebar">
                <ul class="nav nav-pills flex-column vh-100">
                    <li class="nav-item" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Dashboard">
                        <a href="{{ url('admin/dashboard') }}" class="nav-link text-black {{ request()->is('admin/dashboard*') || request()->is('admin') ? 'active' : '' }}">
                            <i class="bi bi-house-door fs-4"></i> <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Products">
                        <a href="{{ url('admin/products') }}" class="nav-link text-black {{ request()->is('admin/products*') ? 'active' : '' }}">
                            <i class="bi bi-basket fs-4"></i> <span>Products</span>
                        </a>
                    </li>

                    <li class="nav-item dropdown" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Order Processes">
                        <a class="nav-link text-black {{ request()->is('admin/orders*') || request()->is('admin/carts*') || request()->is('admin/wishlists*') ? 'active' : '' }}" href="#" id="ordersDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-box2 fs-4"></i> <span>Order Processes</span>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="ordersDropdown">
                            <li><a class="dropdown-item" href="{{ url('admin/orders') }}">
                                <i class="bi bi-card-list fs-4"></i> Orders
                            </a></li>
                            <li><a class="dropdown-item" href="{{ url('admin/carts') }}">
                                <i class="bi bi-cart fs-4"></i> Carts
                            </a></li>
                            <li><a class="dropdown-item" href="{{ url('admin/wishlists') }}">
                                <i class="bi bi-heart fs-4"></i> Wishlists
                            </a></li>
                        </ul>
                    </li>

                    <li class="nav-item dropdown" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Account Processes">
                        <a class="nav-link text-black {{ request()->is('admin/accounts*') || request()->is('admin/payment_details*') || request()->is('admin/user_profilings*') || request()->is('admin/feedbacks*') ? 'active' : '' }}" href="#" id="accountDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-rolodex fs-4"></i> <span>Account Processes</span>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="accountDropdown">
                            <li><a class="dropdown-item" href="{{ url('admin/accounts') }}">
                                <i class="bi bi-people fs-4"></i> Accounts
                            </a></li>
                            <li><a class="dropdown-item" href="{{ url('admin/payment_details') }}">
                                <i class="bi bi-credit-card fs-4"></i> Payment Details
                            </a></li>
                            <li><a class="dropdown-item" href="{{ url('admin/user_profilings') }}">
                                <i class="bi bi-person fs-4"></i> User Profiling
                            </a></li>
                            <li><a class="dropdown-item" href="{{ url('admin/feedbacks') }}">
                                <i class="bi bi-chat-text fs-4"></i> Feedback
                            </a></li>
                        </ul>
                    </li>
                    
                    <li class="nav-item mt-auto" id="toggleSidebar" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Collapse">
                        <button id="nav-footer" class="nav-link btn btn-link p-3 text-dark text-decoration-none w-100">
                            <i class="bi bi-list fs-4"></i>
                            <span>Collapse</span>
                        </button>
                    </li>
                    <li class="nav-item" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Logout">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a href="{{ route('logout') }}" 
                               onclick="event.preventDefault(); this.closest('form').submit();" 
                               class="nav-link text-black">
                                <i class="bi bi-box-arrow-left fs-4"></i> <span>Logout</span>
                            </a>
                        </form>
                    </li>
                </ul>
            </div>
        </div>


        <div id="main" class="tab-content w-100 my-3 py-2 shadow">
            @yield('content')
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const sidebar = document.getElementById("sidebar");
            const toggleButton = document.getElementById("toggleSidebar");

            toggleButton.addEventListener("click", function () {
                sidebar.classList.toggle("expanded");
            })
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
        });
    </script>
</body>

{{-- main page --}}
<style>
    body {
        box-sizing: border-box;
        background-color: rgb(208, 210, 210) !important ;
    }
    #main {
        /* background-color: #F1F6F5 !important ; */
        background-color: #ffffff !important ;
        margin: 0 1em 0 0;
        overflow: hidden;
        max-height: 95vh;
        border-radius: 10px;
        /* border: 1px solid red !important;  */
        /* overflow: auto; */
    }
    .main-sidebar {
        background-color: #ffffff !important ;
        margin: 1em -1em 1em 1em;
        /* margin-right: -2em; */
        border-radius: 10px;
        /* border: 1em solid #ffffff; */
        max-height: 95vh;
        z-index: 999;
    }
    .sidebar {
        background-color: #82C3EC !important ;
        margin: 1em;
        /* margin-right: -2em; */
        border-radius: 10px;
        /* border: 1em solid #ffffff; */
        max-height: 90vh;
        z-index: 999;
    }
    .nav .nav-item a.nav-link, .nav-item, .nav-link {
        padding: 10px 15px;
        border: unset !important;
    }
    #nav-footer {
        padding: 10px 10px !important;
    }
    .nav .nav-item a.nav-link.active {
        color: black;
        background: white;
        border-radius: 10px; 
        border-color: #82C3EC;
    }
    .sidebar.expanded {
        width: 250px;
    }
    .sidebar .nav-link span, .sidebar .nav-link small {
        display: none;
    }
    .sidebar.expanded .nav-link span, .sidebar.expanded .navlink small {
        display: inline;
    }
    .sidebar .nav-link {
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .sidebar.expanded .nav-link {
        flex-direction: row;
        justify-content: flex-start;
        gap: 10px;
    }
    #nav-footer:hover {
        color: white;
        background: #70a8cb;
        border-radius: 10px;
        /* border-color: #82C3EC; */
        transition: all 0.1s ease;
    }.nav .nav-item a.nav-link:hover {
        color: white;
        background: #70a8cb;
        border-radius: 10px;
        /* border-color: #82C3EC; */
        transition: all 0.1s ease;
    }.nav .nav-item a.nav-link.active:hover {
        color: black;
        background: white;
        border-radius: 10px; 
        border-color: #82C3EC;
    }
    @media (max-width: 767px) {
        .sidebar {
            position: fixed;
            bottom: 0;
            left: 0;
            margin: 2vw 3vw !important;
            min-width: 94vw !important;
            /* max-height: 10vh !important; */
            /* min-height: 70px !important; */
            max-height: 70px !important;
            z-index: 999;
            background-color: #82C3EC !important;
        }
        .sidebar .nav {
            display: flex;
            flex-direction: row !important;
            align-items: center;
            justify-content: space-around;
            width: 100%;
        }
        .sidebar .nav-link span, .sidebar .nav-link small {
            display: none !important;
        }
        .border-top {
            border-top: unset !important;
        }
        .border-bottom {
            border-bottom: unset !important;
        }
        #toggleSidebar {
            display: none !important;
        }
        .nav .nav-item a.nav-link.active {
            color: whitesmoke !important;
            background: none !important;
            border-bottom: 5px solid whitesmoke !important;
            padding: 10px 0 !important;
            border-radius: 0 !important;
        }
        .nav .nav-item a.nav-link, .nav-item, .nav-link {
            padding: 0 !important;
            border: unset !important;
        }
        #main {
            /* background-color: #F1F6F5 !important ; */
            background-color: #ffffff !important ;
            margin: 2vw 3vw 0 3vw !important;
            padding: .5em 0 10px 0 !important;
            border-radius: 10px;
            min-height: 50vh !important;
            max-height: calc(100% - 100px) !important;
            display: flex; 
            justify-content: center; 
            align-items: center;
            overflow-y: hidden; 
        }

    }
</style>

{{-- table --}}
<style>
    body {
        background-color: #f8f9fa;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    
    .card {
        border-radius: 16px;
        border: none;
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.08);
        margin-bottom: 30px;
    }
    
    .card-header {
        background-color: #fff;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        border-top-left-radius: 16px !important;
        border-top-right-radius: 16px !important;
        padding: 20px 25px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
    .card-header h2 {
        margin: 0;
        font-size: 1.5rem;
        font-weight: 600;
        color: #343a40;
    }
    
    .card-body {
        padding: 25px;
        padding-top: 0;
        max-height: 83vh;
        overflow: auto;
    }

    #modern_datatable{
        /* overflow-x: scroll; */
    }
    
    table.dataTable {
        border-collapse: separate !important;
        border-spacing: 0 8px !important;
        margin-top: 0 !important;
        margin-bottom: 0 !important;
    }
    
    table.dataTable thead th {
        font-weight: 600;
        color: #000000;
        border-bottom: none;
        padding: 12px 15px;
        font-size: 0.875rem;
        letter-spacing: 0.5px;
    }
    
    table.dataTable tbody tr {
        background-color: #fff;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.04);
        border-radius: 10px;
        margin-bottom: 10px;
        transition: transform 0.2s, box-shadow 0.2s;
    }
    
    table.dataTable tbody tr:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 12px rgba(0, 0, 0, 0.08);
    }
    
    table.dataTable tbody td {
        padding: 16px 15px;
        border-top: none;
        vertical-align: middle;
    }
    
    table.dataTable tbody tr td:first-child {
        border-top-left-radius: 10px;
        border-bottom-left-radius: 10px;
    }
    
    table.dataTable tbody tr td:last-child {
        border-top-right-radius: 10px;
        border-bottom-right-radius: 10px;
    }
    
    /* Search and length control styling */
    div.dataTables_wrapper div.dataTables_length label,
    div.dataTables_wrapper div.dataTables_filter label {
        font-weight: 500;
        color: #6c757d;
    }
    div.dataTables_wrapper div.dataTables_length,
    div.dataTables_wrapper div.dataTables_filter {
        width: 100%;
    }
    div.dataTables_wrapper div.dataTables_length label {
        margin-left: 20px;
    }
    div.dataTables_wrapper {
    }
    #add {
        margin: -2px 0 15px 0;
        padding: 0 20px;
        height: 40px;
    }
    
    div.dataTables_wrapper div.dataTables_length select:focus,
    div.dataTables_wrapper div.dataTables_filter input:focus {
        outline: none;
        border: 1px solid black;
        box-shadow: none;
    }
    
    div.dataTables_wrapper div.dataTables_length select {
        border-radius: 8px;
        padding: 8px 30px 8px 15px;
        border: 1px solid #dee2e6;
        background-color: #fff;
        margin: 0 10px;
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='%236c757d' viewBox='0 0 16 16'%3E%3Cpath d='M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: calc(100% - 12px) center;
    }
    
    div.dataTables_wrapper div.dataTables_filter input {
        border-radius: 8px;
        padding: 8px 15px;
        border: 1px solid #dee2e6;
        background-color: #fff;
        margin-left: 10px;
        width: 220px;
    }
    
    /* Pagination styling */
    div.dataTables_wrapper div.dataTables_paginate {
        margin-top: 20px;
    }
    
    div.dataTables_wrapper div.dataTables_paginate ul.pagination {
        margin: 0;
        margin-top: -50px;
    }
    
    div.dataTables_wrapper div.dataTables_paginate .page-item .page-link {
        border: none;
        border-radius: 8px;
        padding: 8px 14px;
        margin: 0 3px;
        color: #6c757d;
        font-weight: 500;
        transition: all 0.2s;
    }
    
    div.dataTables_wrapper div.dataTables_paginate .page-item.active .page-link {
        background-color: #82C3EC;
        color: white;
    }
    
    div.dataTables_wrapper div.dataTables_paginate .page-item .page-link:hover {
        background-color: #e9ecef;
    }
    
    div.dataTables_info {
        color: #6c757d;
        padding-top: 20px;
        font-size: 0.9rem;
    }

    @media (max-width: 768px) {
        div.dataTables_wrapper div.dataTables_paginate ul.pagination {
            margin: 0;
        }
    }
</style>

{{-- desktop mobile content --}}
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
            max-height: calc(90vh - 150px) !important;
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

</html>