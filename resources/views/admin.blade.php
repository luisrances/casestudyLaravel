<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        .sidebar {
            background-color: #82C3EC !important ;
            margin:1em;
            border-radius: 20px;
        }
        .nav .nav-item a.nav-link, .nav-item, .nav-link {
            padding: 10px 15px;
            border: unset !important;
        }
        .nav .nav-item a.nav-link.active {
            color: black;
            background: white;
            border-radius: 20px; 
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
        @media (max-width: 767px) {
            .sidebar {
                position: fixed;
                bottom: 0;
                left: 0;
                margin: .5em 5vw !important;
                min-width: 90vw !important;
                height: 70px !important;
                z-index: 999;
                background-color: #4B56D2 !important;
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

        }
    </style>
</head>
<body>
    <div class="container-fluid p-0 d-flex vh-100 text-right">
        <div class="d-flex flex-column bg-body-tertiary sidebar expanded" id="sidebar">
            <ul class="nav nav-pills flex-column vh-100">
                <li class="nav-item">
                    <a href="#" class="nav-link active py-3 border-bottom text-black" data-bs-toggle="tab" data-bs-target="#dashboard">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-house-door" viewBox="0 0 16 16"><path d="M8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4.5a.5.5 0 0 0 .5-.5v-4h2v4a.5.5 0 0 0 .5.5H14a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293zM2.5 14V7.707l5.5-5.5 5.5 5.5V14H10v-4a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v4z"/></svg>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link py-3 border-bottom text-black" data-bs-toggle="tab" data-bs-target="#customers">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-people" viewBox="0 0 16 16"><path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1zm-7.978-1L7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002-.014.002zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4m3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0M6.936 9.28a6 6 0 0 0-1.23-.247A7 7 0 0 0 5 9c-4 0-5 3-5 4q0 1 1 1h4.216A2.24 2.24 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816M4.92 10A5.5 5.5 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275ZM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0m3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4"/></svg>
                        <span>Customers</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link py-3 border-bottom text-black" data-bs-toggle="tab" data-bs-target="#products">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-basket" viewBox="0 0 16 16"><path d="M5.757 1.071a.5.5 0 0 1 .172.686L3.383 6h9.234L10.07 1.757a.5.5 0 1 1 .858-.514L13.783 6H15a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1v4.5a2.5 2.5 0 0 1-2.5 2.5h-9A2.5 2.5 0 0 1 1 13.5V9a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h1.217L5.07 1.243a.5.5 0 0 1 .686-.172zM2 9v4.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V9zM1 7v1h14V7zm3 3a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 4 10m2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 6 10m2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 8 10m2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 1 .5-.5m2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 1 .5-.5"/></svg>
                        <span>Products</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link py-3 border-bottom text-black" data-bs-toggle="tab" data-bs-target="#transactions">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-card-list" viewBox="0 0 16 16"><path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2z"/><path d="M5 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 5 8m0-2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5m0 5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5m-1-5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0M4 8a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0m0 2.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0"/></svg>
                        <span>Transactions</span>
                    </a>
                </li>
                <li class="nav-item mt-auto" id="toggleSidebar">
                    <button class="nav-link btn btn-link p-3 text-dark text-decoration-none w-100">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5"/></svg>
                        <span>Collapse</span>
                    </button>
                </li>
                <li class="nav-item dropend">
                    <a href="#" class="border-top nav-link p-3 text-black" data-bs-toggle="dropdown" aria-expanded="false">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16"><path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/><path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/></svg>
                        <span>Admin</span>
                        <!-- <small class="text-muted">email@gmail.com</small> -->
                    </a>
                    <ul class="dropdown-menu text-small shadow">
                        <li><a class="dropdown-item" href="#">Setting</a></li>
                        <li><a class="dropdown-item" href="#">Setting</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#">Setting</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <div class="tab-content w-100 p-4">
            <div class="tab-pane fade show active" id="dashboard">
                <h1>Dashboard content</h1>
                <p>Welcome to the Dashboard section.</p>
            </div>
            <div class="tab-pane fade show" id="customers">
                <h1>customers content</h1>
                <p>Welcome to the customers section.</p>
                @include('subpages.table')
            </div>
            <div class="tab-pane fade show" id="products">
                <h1>products content</h1>
                <p>Welcome to the products section.</p>
            </div>
            <div class="tab-pane fade show" id="transactions">
                <h1>transactions content</h1>
                <p>Welcome to the transactions section.</p>
            </div>
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
</body>

<style>
</style>

</html>