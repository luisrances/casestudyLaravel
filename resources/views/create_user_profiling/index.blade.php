<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
    {{-- <div class="container">
        <h2>Complete Your Profile</h2>

        <form action="{{ route('user_profilings.store') }}" method="POST">
            @csrf
            <input type="hidden" name="account_id" value="{{ $account_id }}">
            @foreach ($accounts as $account)
                @if ($account_id == $account->id)
                    <h2 class="mb-0">{{ $account->first_name }} {{ $account->last_name }}</h2>
                @endif
            @endforeach
        </form> --}}


<div class="container d-flex justify-content-center vh-100 py-5">
    <div class="card p-3 px-5 shadow-lg" style="height:600px; width:550px">
        <h3 class="mb-2 fw-bold">User Profiling</h3>
        <form action="{{ route('storeFormRegistration.index') }}" method="POST">
            @csrf
            <input type="hidden" name="account_id" value="{{ $account_id }}">
    
            <div class="row mb-0">
                <div class="col-md-6">
                    <div>
                        <label for="birthdate" class="form-label" style="margin-bottom: -5px">Birthday</label>
                        <input type="date" class="form-control" name="birthdate" id="birthdate">
                    </div>
                    <div>
                        <label class="form-label d-block">Gender</label>
                        <div class="form-check form-check-inline ps-5">
                            <input class="form-check-input" type="radio" name="sex" id="female" value="female">
                            <label class="form-check-label" for="female">Female</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="sex" id="male" value="male">
                            <label class="form-check-label" for="male">Male</label>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div>
                        <label for="height" class="form-label" style="margin-bottom: -5px">Height (cm)</label>
                        <input type="number" class="form-control" name="height" id="height" min="0">
                    </div>
                    <div>
                        <label for="weight" class="form-label" style="margin-bottom: -5px">Weight (kg)</label>
                        <input type="number" class="form-control" name="weight" id="weight" min="0">
                    </div>
                </div>
            </div>

            <hr class="my-2">
    
            <h3 class="fw-bold mb-2 mt-0">Ride Preference</h3>
    
            <div class="row mb-2">
                <div class="col-md-6">
                    <label class="form-label fw-bold">Activity Type</label>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="activity_type[]" value="Commuting" id="commuting">
                        <label class="form-check-label" for="commuting">Commuting</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="activity_type[]" value="Leisure" id="leisure">
                        <label class="form-check-label" for="leisure">Leisure</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="activity_type[]" value="Racing" id="racing">
                        <label class="form-check-label" for="racing">Racing</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="activity_type[]" value="Off-roading" id="offroading">
                        <label class="form-check-label" for="offroading">Off-roading</label>
                    </div>
                </div>
    
                <div class="col-md-6">
                    <label class="form-label fw-bold">Primary Riding Terrain</label>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="terrain[]" value="Off-road trails" id="trails">
                        <label class="form-check-label" for="trails">Off-road trails</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="terrain[]" value="Mountains" id="mountains">
                        <label class="form-check-label" for="mountains">Mountains</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="terrain[]" value="Coastal Roads" id="coastal">
                        <label class="form-check-label" for="coastal">Coastal Roads</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="terrain[]" value="Mixed" id="mixed">
                        <label class="form-check-label" for="mixed">Mixed</label>
                    </div>
                </div>
            </div>
    
            <div class="mb-2">
                <label class="form-label d-block fw-bold">Experience Level</label>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="experience_level" id="beginner" value="Beginner">
                    <label class="form-check-label" for="beginner">Beginner</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="experience_level" id="intermediate" value="Intermediate">
                    <label class="form-check-label" for="intermediate">Intermediate</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="experience_level" id="skilled" value="Skilled">
                    <label class="form-check-label" for="skilled">Skilled</label>
                </div>
            </div>
            
            <hr class="my-1">
    
            <div class="row mb-2">
                <label class="col-8 form-label d-block">Performs Own Maintenance?</label>
                <div class="col-4">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="maintenance" id="maintenance_yes" value="yes">
                        <label class="form-check-label" for="maintenance_yes">Yes</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="maintenance" id="maintenance_no" value="no">
                        <label class="form-check-label" for="maintenance_no">No</label>
                    </div>
                </div>
            </div>
    
            <div class="row mb-0">
                <label class="col-8 form-label d-block">Interested in Upgrades/Custom Parts?</label>
                <div class="col-4">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="custom_parts" id="custom_yes" value="yes">
                        <label class="form-check-label" for="custom_yes">Yes</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="custom_parts" id="custom_no" value="no">
                        <label class="form-check-label" for="custom_no">No</label>
                    </div>
                </div>
            </div>

            <hr class="my-1">
    
            <div class="text-end">
                <button type="submit" class="btn py-2 px-0">
                    <h5 class="text-primary">
                        Continue <i class="bi bi-arrow-right ms-2"></i>
                    </h5>
                </button>
            </div>
        </form>
    </div>
</div>
            
            <div class="main p-4" style="height: 93vh; background-color: #f8f9fa;">
                <div class="container py-5 w-100 w-md-75 w-lg-70">
                    <div class="card shadow-lg rounded-lg border-0">
                        <div class="row g-0">
                            <div class="col-md-5 bg-primary text-white p-4 rounded-4">
                                @foreach ($accounts as $account)
                                    @if ($account_id == $account->id)
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
                                        <p class="mb-0">{{ $account_id }}</p>
                                    </div>
                                    <div class="col-sm-6">
                                        <strong class="text-muted">Birthdate:</strong>
                                        <div>
                                            <label for="birthdate" class="block text-gray-700 text-sm font-semibold mb-2">Birthday</label>
                                            <input type="date" name="birthdate" id="birthdate" class="form-input w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500 focus:border-blue-500">
                                            @error('birthdate')
                                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-6">
                                        <strong class="text-muted">Sex:</strong>
                                        {{-- <p class="mb-0">{{ $userProfiling->sex ?? 'N/A' }}</p> --}}
                                    </div>
                                    <div class="col-sm-6">
                                        <strong class="text-muted">Height:</strong>
                                        {{-- <p class="mb-0">{{ $userProfiling->height ? $userProfiling->height . ' cm' : 'N/A' }}</p> --}}
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-6">
                                        <strong class="text-muted">Weight:</strong>
                                        {{-- <p class="mb-0">{{ $userProfiling->weight ? $userProfiling->weight . ' kg' : 'N/A' }}</p> --}}
                                    </div>
                                    <div class="col-sm-6">
                                        <strong class="text-muted">Activity Type:</strong>
                                        <p class="mb-0">
                                            {{-- {{ is_array(json_decode($userProfiling->activity_type)) ? implode(', ', json_decode($userProfiling->activity_type)) : 'N/A' }} --}}
                                        </p>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-6">
                                        <strong class="text-muted">Preferred Terrain:</strong>
                                        <p class="mb-0">
                                            {{-- {{ is_array(json_decode($userProfiling->terrain)) ? implode(', ', json_decode($userProfiling->terrain)) : 'N/A' }} --}}
                                        </p>
                                    </div>
                                    <div class="col-sm-6">
                                        <strong class="text-muted">Experience Level:</strong>
                                        {{-- <p class="mb-0">{{ $userProfiling->experience_level ?? 'N/A' }}</p> --}}
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-6">
                                        <strong class="text-muted">Maintenance:</strong>
                                        {{-- <p class="mb-0">{{ $userProfiling->maintenance ? 'Yes' : 'No' }}</p> --}}
                                    </div>
                                    <div class="col-sm-6">
                                        <strong class="text-muted">Uses Custom Parts:</strong>
                                        {{-- <p class="mb-0">{{ $userProfiling->custom_parts ? 'Yes' : 'No' }}</p> --}}
                                    </div>
                                </div>
            
                                <hr class="my-4">
            
                                <div class="row d-flex justify-content-between align-items-center">
                                    <div class="col-12 col-md-6">
                                        <i class="bi bi-calendar3 text-muted me-1"></i>
                                        <span class="text-muted">Created on:</span>
                                        <span class="font-weight-medium">
                                            {{-- {{ $userProfiling->created_at ? $userProfiling->created_at->format('F d, Y h:i A') : 'N/A' }} --}}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- The rest of your form fields go here -->
        </form>
    </div>
</body>

</html>