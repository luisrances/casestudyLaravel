@extends('admin.admin')

@section('content')
<div class="main p-4 d-flex align-items-center" style="height: 93vh; background-color: #f8f9fa;">
    <div class="container py-5 w-100 w-md-75 w-lg-70">
        <div class="card shadow-lg rounded-lg border-0">
            <div class="row g-0">
                <div class="col-md-5 bg-info text-white p-4 rounded-4 d-flex flex-column align-items-center justify-content-center">
                    @foreach ($accounts as $account)
                        @if ($feedback->account_id == $account->id)
                            @if ($account->image)
                                <div class="overflow-hidden rounded-circle border border-primary" style="width: 150px; height: 150px;">
                                    <img src="{{ asset('storage/' . $account->image) }}" alt="{{ $account->first_name }} {{ $account->last_name }}" class="w-100 h-100 object-cover">
                                </div>
                            @else
                                <div class="bg-secondary text-white rounded-circle d-flex justify-content-center align-items-center" style="width: 150px; height: 150px; font-size: 70px;">
                                    <i class="bi bi-person-fill"></i>
                                </div>
                            @endif
                            <h4 class="mt-3 text-center">{{ $account->first_name ?? 'Guest' }} {{ $account->last_name ?? '' }}</h4>
                        @endif
                    @endforeach
                    <p class="text-light text-center mb-0">Account ID: {{ $feedback->account_id }}</p>
                </div>

                <div class="col-md-7 p-4">
                    <h2 class="font-weight-semibold text-dark mb-4">Feedback Details</h2>

                    <div class="mb-3">
                        <strong class="text-muted">Comment:</strong>
                        <p class="mb-0">{{ $feedback->comment ?? 'No message provided' }}</p>
                    </div>

                    @if ($feedback->image)
                        <strong class="text-muted">Image:</strong>
                        <div class="overflow-hidden border border-light mt-2" style="width: 200px; height: 200px;">
                            <img src="{{ asset('storage/' . $feedback->image) }}" alt="feedback image" class="d-flex justify-content-center align-items-md-center align-items-end w-100 h-100 object-cover">
                        </div>
                    @else
                        <i class="bi bi-chat-square-quote rounded-lg overflow-hidden d-flex justify-content-center align-items-md-center align-items-end" style="font-size: 200px; color: black;"></i>
                    @endif

                    <div class="row d-flex justify-content-between align-items-center">
                        <hr class="my-4">
                        <div class="col-12 col-md-6">
                            <i class="bi bi-calendar3 text-muted me-1"></i>
                            <span class="text-muted">Submitted on:</span>
                            <span class="font-weight-medium">
                                {{ $feedback->created_at ? $feedback->created_at->format('F d, Y h:i A') : 'N/A' }}
                            </span>
                        </div>
                        <div class="col-12 col-md-6 d-md-flex justify-content-evenly">
                            <a href="{{ route('feedbacks.edit', $feedback) }}" class="btn btn-primary rounded-pill px-3 py-2 shadow-sm d-flex justify-content-center align-items-center w-50 mb-2 mb-md-0" style="height: 50px;">
                                <i class="bi bi-pencil me-1"></i> Edit
                            </a>
                            <a href="{{ route('feedbacks.index') }}" class="btn btn-outline-secondary rounded-pill px-3 py-2 shadow-sm ms-2 d-flex justify-content-center align-items-center w-50" style="height: 50px;">
                                <i class="bi bi-arrow-left me-1"></i> Back
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<style>
    @media (max-width: 767px) {
        .main {
            max-height: calc(100vh - 100px) !important;
            overflow: scroll !important;
        }
    }
    @media (max-height: 700px) {
        .main {
            margin-top: 5vw !important;
        }
    }
</style>
@endsection
