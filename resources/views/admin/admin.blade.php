<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
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
                    {{-- <li class="nav-item" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Accounts">
                        <a href="{{ url('admin/accounts') }}" class="nav-link text-black {{ request()->is('admin/accounts*') ? 'active' : '' }}">
                            <i class="bi bi-people fs-4"></i> <span>Accounts</span>
                        </a>
                    </li> --}}
                    <li class="nav-item" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Products">
                        <a href="{{ url('admin/products') }}" class="nav-link text-black {{ request()->is('admin/products*') ? 'active' : '' }}">
                            <i class="bi bi-basket fs-4"></i> <span>Products</span>
                        </a>
                    </li>
                    {{-- <li class="nav-item" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Orders">
                        <a href="{{ url('admin/orders') }}" class="nav-link text-black {{ request()->is('admin/orders*') ? 'active' : '' }}">
                            <i class="bi bi-card-list fs-4"></i> <span>Orders</span>
                        </a>
                    </li> --}}

                    <li class="nav-item dropdown" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Order Flow">
                        <a class="nav-link text-black {{ request()->is('admin/orders*') || request()->is('admin/carts*') || request()->is('admin/wishlists*') ? 'active' : '' }}" href="#" id="ordersDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-box2 fs-4"></i> <span>Order Flow</span>
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

                    <li class="nav-item dropdown" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Account Flow">
                        <a class="nav-link text-black {{ request()->is('admin/accounts*') ? 'active' : '' }}" href="#" id="accountDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-rolodex fs-4"></i> <span>Account Flow</span>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="accountDropdown">
                            <li><a class="dropdown-item" href="{{ url('admin/accounts') }}">
                                <i class="bi bi-people fs-4"></i> Accounts
                            </a></li>
                            <li><a class="dropdown-item" href="{{ url('admin/payment-details') }}">
                                <i class="bi bi-credit-card fs-4"></i> Payment Details
                            </a></li>
                        </ul>
                    </li>
                    
                    <li class="nav-item mt-auto" id="toggleSidebar" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Collapse">
                        <button id="nav-footer" class="nav-link btn btn-link p-3 text-dark text-decoration-none w-100">
                            <i class="bi bi-list fs-4"></i>
                            <span>Collapse</span>
                        </button>
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

</html>