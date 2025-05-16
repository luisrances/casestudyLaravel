@extends('admin.admin')

@section('content')
<div class="d-flex justify-content-center align-items-center vh-100 bg-light">
    <div class="bg-white rounded shadow-lg p-5 w-lg-75 w-xl-75 w-md-90">
        <div class="d-flex flex-column flex-md-row align-items-center gap-4 mb-4">
            <div class="flex-shrink-0">
                @if ($account->image)
                    <div class="overflow-hidden rounded-circle border border-primary" style="width: 150px; height: 150px;">
                        <img src="{{ asset('storage/' . $account->image) }}" alt="{{ $account->first_name }} {{ $account->last_name }}" class="w-100 h-100 object-cover">
                    </div>
                @else
                    <div class="bg-secondary text-white rounded-circle d-flex justify-content-center align-items-center" style="width: 150px; height: 150px; font-size: 70px;">
                        <i class="bi bi-person-fill"></i>
                    </div>
                @endif
            </div>
            <div>
                <h2 class="mb-2 fw-bold text-dark">{{ $account->first_name }} {{ $account->last_name }}</h2>
                <p class="mb-1 text-muted fs-5">{{ $account->email }}</p>
            </div>
        </div>

        <hr class="my-4 border-secondary">

        <div class="gap-3 d-md-flex justify-content-evenly">
            <a href="{{ route('accounts.edit', $account) }}" class="btn btn-primary rounded-pill d-flex justify-content-center align-items-center shadow fs-6 w-100 mb-2 mb-md-0" style="height: 50px;">
                <i class="bi bi-pencil me-2"></i> Edit
            </a>
            <a href="{{ route('accounts.index') }}" class="btn btn-outline-secondary d-flex justify-content-center align-items-center rounded-pill px-4 py-3 shadow fs-6 w-100  " style="height: 50px;">
                <i class="bi bi-arrow-left me-2"></i> Back
            </a>
        </div>
    </div>
</div>

<style>
    .object-cover {
        object-fit: cover;
    }
    .rounded-circle {
        border: 4px solid #007bff;
    }
    .shadow-lg {
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    }
    .bg-light {
        background-color: #f8f9fa !important;
    }
    .text-muted {
        color: #6c757d !important;
    }
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
