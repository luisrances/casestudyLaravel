@extends('admin.admin')

@section('title', 'Payment Details')

@section('content')
<div class="tab-pane fade show active" id="payment-details">
    <div class="container px-4 main">
        <div class="mb-3 mt-4">
            <h1>Payment Details</h1>
        </div>
        <div class="card-body desktop-content">
            <div class="table-responsive">
                <table id="modern_datatable" class="table table-borderless">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Customer</th>
                            <th>Recipient Name</th>
                            <th>City</th>
                            <th>Address Category</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($paymentDetails as $detail)
                            <tr style="cursor: pointer;" onclick="window.location='{{ route('payment_details.show', $detail->id) }}';">
                                <td class="name-cell">{{ $detail->id }}</td>
                                <td>
                                    @foreach ($accounts as $account)
                                        @if ($detail->account_id == $account->id)
                                            <p class="mb-0">{{ $account->first_name }} {{ $account->last_name }}</p>
                                        @endif
                                    @endforeach
                                </td>
                                <td>{{ $detail->recipient_name }}</td>
                                <td>{{ $detail->city }}</td>
                                <td>{{ ucfirst($detail->address_category) }}</td>
                                <td style="width: 100px;">
                                    <div class="row d-flex justify-content-center d-flex align-items-center gx-0">
                                        <div class="col-6">
                                            <a href="{{ route('payment_details.edit', $detail) }}" class="btn btn-sm w-100 p-0"><i class="bi bi-pencil-square text-info fs-5"></i></a>
                                        </div>
                                        <div class="col-6">
                                            <form action="{{ route('payment_details.destroy', $detail) }}" method="POST">
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
                            <a href="{{ route('payment_details.create') }}" class="btn w-100 w-lg-auto" style="background: #82C3EC;">
                                <i class="bi bi-plus"></i> Add Address
                            </a>
                        </div>
                        <div class="col-12 col-lg-5">
                            <form method="GET" action="{{ route('payment_details.index') }}" class="w-100">
                                <div class="input-group">
                                    <input type="text" name="search" class="form-control border-black border-1" placeholder="Search..." value="{{ request('search') }}">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                @foreach ($paymentDetails as $detail)
                    <div class="card p-1 mb-3 align-self-center px-2 shadow w-100" onclick="window.location='{{ route('payment_details.show', $detail->id) }}';" style="max-width: 590px; cursor: pointer;">
                        <div class="row align-items-center gx-1 my-0">
                            <div class="col-sm-8">
                                <div class="card-body pt-1 pb-0 px-2 lh-1">
                                    <p class="fw-medium" style="margin-bottom: 0.5rem; font-size: 1.25rem;">Address #{{ $detail->id }}</p>
                                    <p class="fw-normal" style="margin-bottom: 0.5rem; font-size: .9rem;">Customer: {{ $account->first_name }} {{ $account->last_name }}</p>
                                    <p class="fw-normal" style="margin-bottom: 0.5rem; font-size: .9rem;">Recipient: {{ $detail->recipient_name }}</p>
                                    <p class="fw-normal" style="margin-bottom: 0.5rem; font-size: .9rem;">City: {{ $detail->city }}</p>
                                    <p class="fw-normal" style="margin-bottom: 0.5rem; font-size: .9rem;">Category: {{ ucfirst($detail->address_category) }}</p>
                                </div>
                            </div>
                            <div class="col-sm-4 d-flex flex-column">
                                <a href="{{ route('payment_details.edit', $detail->id) }}" class="btn btn-sm btn-info my-1 w-100">Edit</a>
                                <form action="{{ route('payment_details.destroy', $detail->id) }}" method="POST">
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
            <a href="{{ route('payment_details.create') }}" class="btn pt-1 px-4 ps-3 me-3 mb-3 mb-md-0" id="add" style="background: #82C3EC;"><i class="bi bi-plus"></i> Add </a>
        `);
    });
</script>
@endsection