@extends('admin.admin')

@section('title', 'Feedbacks')

@section('content')
<div class="tab-pane fade {{ request()->is('admin/feedbacks*') ? 'show active' : '' }}" id="feedbacks">
    <div class="container px-4 main">
        <div class="mb-3 mt-4">
            <h1>Feedbacks</h1>
        </div>
        <div class="card-body desktop-content">
            <div class="table-responsive">
                <table id="modern_datatable" class="table table-borderless">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Account</th>
                            <th>Comment</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($feedbacks as $feedback)
                            <tr style="cursor: pointer;" onclick="window.location='{{ route('feedbacks.show', $feedback->id) }}';">
                                <td>{{ $feedback->id }}</td>
                                <td>
                                    @foreach ($accounts as $account)
                                        @if ($feedback->account_id == $account->id)
                                            <p class="mb-0">{{ $account->first_name }} {{ $account->last_name }}</p>
                                        @endif
                                    @endforeach
                                </td>
                                <td>{{ $feedback->comment }}</td>
                                <td style="width: 100px;">
                                    <div class="row gx-0 justify-content-center align-items-center">
                                        <div class="col-6">
                                            <a href="{{ route('feedbacks.edit', $feedback) }}" class="btn btn-sm w-100 p-0"><i class="bi bi-pencil-square text-info fs-5"></i></a>
                                        </div>
                                        <div class="col-6">
                                            <form action="{{ route('feedbacks.destroy', $feedback) }}" method="POST">
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
                            <a href="{{ route('feedbacks.create') }}" class="btn w-100 w-lg-auto" style="background: #82C3EC;">
                                <i class="bi bi-plus"></i> Add Feedback
                            </a>
                        </div>
                        <div class="col-12 col-lg-5">
                            <form method="GET" action="{{ route('feedbacks.index') }}" class="w-100">
                                <div class="input-group">
                                    <input type="text" name="search" class="form-control border-black border-1" placeholder="Search..." value="{{ request('search') }}">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                @foreach ($feedbacks as $feedback)
                    <div class="card p-1 mb-3 align-self-center px-2 shadow w-100" onclick="window.location='{{ route('feedbacks.show', $feedback->id) }}';" style="max-width: 590px; cursor: pointer;">
                        <div class="row align-items-center gx-1 my-0">
                            <div class="col-sm-8">
                                <div class="card-body pt-1 pb-0 px-2 lh-1">
                                    <p class="fw-medium mb-1 fs-5">Feedback #{{ $feedback->id }}</p>
                                    <p class="fw-normal mb-1 fs-6">Account ID: {{ $feedback->account_id }}</p>
                                    <p class="fw-normal mb-1 fs-6">Comment: {{ $feedback->comment }}</p>
                                </div>
                            </div>
                            <div class="col-sm-4 d-flex flex-column">
                                <a href="{{ route('feedbacks.edit', $feedback) }}" class="btn btn-sm btn-info my-1 w-100">Edit</a>
                                <form action="{{ route('feedbacks.destroy', $feedback) }}" method="POST">
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

        $('.dataTables_filter').prepend(`
            <a href="{{ route('feedbacks.create') }}" class="btn pt-1 px-4 ps-3 me-3 mb-3 mb-md-0" id="add" style="background: #82C3EC;"><i class="bi bi-plus"></i> Add Feedback</a>
        `);
    });
</script>
@endsection
