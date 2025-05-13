@extends('admin.admin')

@section('content')
<div class="main p-4" style="height: 93vh; background-color: #f8f9fa;">
    <div class="container py-5 w-100 w-md-75 w-lg-70">
        <div class="card shadow-lg rounded-lg border-0">
            <div class="row g-0">
                <div class="col-md-5 bg-primary text-white p-4 rounded-4">
                    @foreach ($accounts as $account)
                        @if ($userProfiling->account_id == $account->id)
                            <div class="d-flex flex-column align-items-center justify-content-center h-100">
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
                                <p class="text-light text-center mb-0">Account ID: {{ $account->id }}</p>
                            </div>
                        @endif
                    @endforeach
                </div>
                <div class="col-md-7 p-4">
                    <h2 class="font-weight-semibold text-dark mb-4">Profile Details</h2>
                    <div class="row mb-3">
                        <div class="col-sm-6">
                            <strong class="text-muted">Account ID:</strong>
                            <p class="mb-0">{{ $userProfiling->id }}</p>
                        </div>
                        <div class="col-sm-6">
                            <strong class="text-muted">Birthdate:</strong>
                            <p class="mb-0">{{ $userProfiling->birthdate ?? 'N/A' }}</p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-6">
                            <strong class="text-muted">Sex:</strong>
                            <p class="mb-0">{{ $userProfiling->sex ?? 'N/A' }}</p>
                        </div>
                        <div class="col-sm-6">
                            <strong class="text-muted">Height:</strong>
                            <p class="mb-0">{{ $userProfiling->height ? $userProfiling->height . ' cm' : 'N/A' }}</p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-6">
                            <strong class="text-muted">Weight:</strong>
                            <p class="mb-0">{{ $userProfiling->weight ? $userProfiling->weight . ' kg' : 'N/A' }}</p>
                        </div>
                        <div class="col-sm-6">
                            <strong class="text-muted">Activity Type:</strong>
                            <p class="mb-0">
                                {{ is_array(json_decode($userProfiling->activity_type)) ? implode(', ', json_decode($userProfiling->activity_type)) : 'N/A' }}
                            </p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-6">
                            <strong class="text-muted">Preferred Terrain:</strong>
                            <p class="mb-0">
                                {{ is_array(json_decode($userProfiling->terrain)) ? implode(', ', json_decode($userProfiling->terrain)) : 'N/A' }}
                            </p>
                        </div>
                        <div class="col-sm-6">
                            <strong class="text-muted">Experience Level:</strong>
                            <p class="mb-0">{{ $userProfiling->experience_level ?? 'N/A' }}</p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-6">
                            <strong class="text-muted">Maintenance:</strong>
                            <p class="mb-0">{{ $userProfiling->maintenance ? 'Yes' : 'No' }}</p>
                        </div>
                        <div class="col-sm-6">
                            <strong class="text-muted">Uses Custom Parts:</strong>
                            <p class="mb-0">{{ $userProfiling->custom_parts ? 'Yes' : 'No' }}</p>
                        </div>
                    </div>

                    <hr class="my-4">

                    <div class="row d-flex justify-content-between align-items-center">
                        <div class="col-12 col-md-6">
                            <i class="bi bi-calendar3 text-muted me-1"></i>
                            <span class="text-muted">Created on:</span>
                            <span class="font-weight-medium">
                                {{ $userProfiling->created_at ? $userProfiling->created_at->format('F d, Y h:i A') : 'N/A' }}
                            </span>
                        </div>
                        <div class="col-12 col-md-6 d-md-flex justify-content-evenly">
                            <a href="{{ route('user_profilings.edit', $userProfiling) }}" class="btn btn-primary rounded-pill px-3 py-2 shadow-sm d-flex justify-content-center align-items-center w-50 mb-2 mb-md-0" style="height: 50px;">
                                <i class="bi bi-pencil me-1"></i> Edit
                            </a>
                            <a href="{{ route('user_profilings.index') }}" class="btn btn-outline-secondary rounded-pill px-3 py-2 shadow-sm ms-2 d-flex justify-content-center align-items-center w-50" style="height: 50px;">
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
