@extends('admin.admin')

@section('content')
<div class="p-4 main" style="min-height: 93vh; display: flex; justify-content: center; align-items: center;">
    <div class="card rounded-3 shadow-sm w-lg-75 w-xl-60 w-md-90" style="max-width: 90%;">
        <div class="card-body p-4">
            <h2 class="font-weight-semibold text-dark mb-4">Payment Detail #{{ $paymentDetail->id }}</h2>
            @foreach ($accounts as $account)
                @if ($paymentDetail->account_id == $account->id)
                <div class="row g-0 flex-column flex-md-row">
                    <div class="col-md-5">
                        <h5 class="text-secondary mb-3"><i class="bi bi-person-fill me-2"></i> Customer Information</h5>
                        <p class="mb-2"><strong>Name:</strong> {{ $account->first_name ?? 'Guest' }} {{ $account->last_name ?? '' }}</p>
                        <hr class="my-3">

                        <h5 class="text-secondary mb-3"><i class="bi bi-receipt me-2"></i> Recipient Details</h5>
                        <p class="mb-2"><strong>Recipient Name:</strong> {{ $paymentDetail->recipient_name }}</p>
                        <p class="mb-2"><strong>Phone Number:</strong> {{ $paymentDetail->phone_number }}</p>
                    </div>
                    <div class="col-md-7 p-4 py-1 pt-0 pt-md-4">
                        <h5 class="text-secondary mb-3"><i class="bi bi-geo-alt-fill me-2"></i> Address Information</h5>
                        <p class="mb-2"><strong>District:</strong> {{ $paymentDetail->district }}</p>
                        <p class="mb-2"><strong>City:</strong> {{ $paymentDetail->city }}</p>
                        <p class="mb-2"><strong>Region:</strong> {{ $paymentDetail->region }}</p>
                        <p class="mb-2"><strong>Street:</strong> {{ $paymentDetail->street }}</p>
                        <p class="mb-2"><strong>Address Category:</strong> {{ ucfirst($paymentDetail->address_category) }}</p>
                    </div>
                    <hr class="my-3">
                </div>


                    <div class="d-flex align-items-center mb-3">
                        <span class="text-muted me-2"><i class="bi bi-calendar3 me-1"></i> Added on: </span>
                        <span class="font-weight-medium">{{ $paymentDetail->created_at ? $paymentDetail->created_at->format('F d, Y h:i A') : 'N/A' }}</span>
                    </div>

                    <div class="mt-4 d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('payment_details.edit', $paymentDetail) }}" class="btn btn-primary rounded-pill px-3 py-2 shadow-sm">
                            <i class="bi bi-pencil me-1"></i> Edit
                        </a>
                        <a href="{{ route('payment_details.index') }}" class="btn btn-outline-secondary rounded-pill px-3 py-2 shadow-sm">
                            <i class="bi bi-arrow-left me-1"></i> Back
                        </a>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</div>



<style>
    @media (max-width: 767px) {
        .main {
            max-height: calc(100vh - 100px) !important;
            overflow-y: scroll;
        }
        .submain {
            max-height: 80vh !important;
        }
    }
    @media (max-height: 700px) {
        .main {
            margin-top: 5vw !important;
        }
    }
</style>
@endsection
