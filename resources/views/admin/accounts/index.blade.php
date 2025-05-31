@extends('admin.admin')

@section('title', 'Accounts')

@section('content')
<div class="tab-pane fade {{ request()->is('admin/accounts*') ? 'show active' : '' }}" id="accounts">
    <div class="container px-4 main">
        <div class="mb-3 mt-4">
            <h1>Accounts</h1>
        </div>
        <div class="card-body desktop-content">
            <div class="table-responsive">
                <table id="modern_datatable" class="table table-borderless">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($accounts as $account)
                            <tr style="cursor: pointer;" onclick="window.location='{{ route('accounts.show', $account->id) }}';">
                                <td class="name-cell">{{ $account->id }}</td>
                                <td>{{ $account->first_name }}</td>
                                <td>{{ $account->last_name }}</td>
                                <td>{{ $account->email }}</td>
                                <td style="width: 100px;">
                                    <div class="row d-flex justify-content-center d-flex align-items-center gx-0">
                                        <div class="col-6">
                                            <a href="{{ route('accounts.edit', $account) }}" class="btn btn-sm w-100 p-0"><i class="bi bi-pencil-square text-info fs-5"></i></a>
                                        </div>
                                        <div class="col-6">
                                            <form action="{{ route('accounts.destroy', $account) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm w-100 p-0"><i class="bi bi-trash text-info fs-5"></i></button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>


        <div class="submain mobile-content">
            <div class="d-flex justify-content-center flex-column custom-scroll">
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
                @foreach ($accounts as $account)
                    <div class="card p-1 mb-3 align-self-center px-2 shadow w-100" onclick="window.location='{{ route('accounts.show', $account->id) }}';" style="max-width: 590px; cursor: pointer;">
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
<script>
    $(document).ready(function() {
        $('#modern_datatable').DataTable({
            language: {
                search: "",
                searchPlaceholder: "Search...",
                paginate: {
                    next: '<i class="fas fa-chevron-right"></i>',
                    previous: '<i class="fas fa-chevron-left"></i>'
                }
            },
            dom: '<"row mb-3"<"col-md-6 d-flex align-items-center"B l><"col-md-6 d-flex justify-content-end align-items-center"f>>rtip',
            buttons: [
                {
                    extend: 'csvHtml5',
                    text: '<i class="bi bi-download"></i> Export CSV',
                    className: 'btn btn-export-csv border-0'
                }
            ],
            lengthMenu: [[5, 10, 25, -1], [5, 10, 25, "All"]],
            pageLength: 5,
            ordering: true,
            responsive: true
        });

        // Inject Add button beside the length dropdown
        $('.dataTables_filter').prepend(`
            <a href="{{ route('accounts.create') }}" class="btn pt-1 px-4 ps-3 me-3 mb-3 mb-md-0" id="add" style="background: #82C3EC;"><i class="bi bi-plus"></i> Add Account</a>
        `);
    });
</script>
@endsection