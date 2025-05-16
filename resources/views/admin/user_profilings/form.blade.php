<div class="card shadow p-3 custom-scroll submain">
    {{-- Account selection --}}
    <div class="mb-3">
        <label for="account_id" class="form-label">Account</label>
        <select class="form-control form-control-md" id="account_id" name="account_id" required>
            <option value="">Select</option>
            @foreach($accounts as $account)
                <option value="{{ $account->id }}" {{ old('account_id', $userProfiling->account_id ?? '') == $account->id ? 'selected' : '' }}>
                    [ID: {{ $account->id }}] {{ $account->first_name }} {{ $account->last_name }}
                </option>
            @endforeach
        </select>
    </div>

    {{-- Birthdate --}}
    <div class="mb-3">
        <label for="birthdate" class="form-label">Birthdate</label>
        <input type="date" class="form-control form-control-md" id="birthdate" name="birthdate"
               value="{{ old('birthdate', $userProfiling->birthdate ?? '') }}">
    </div>

    {{-- Sex --}}
    <div class="mb-3">
        <label for="sex" class="form-label">Sex</label>
        <select class="form-control form-control-md" id="sex" name="sex">
            <option value="">Select</option>
            <option value="Male" {{ old('sex', $userProfiling->sex ?? '') == 'Male' ? 'selected' : '' }}>Male</option>
            <option value="Female" {{ old('sex', $userProfiling->sex ?? '') == 'Female' ? 'selected' : '' }}>Female</option>
        </select>
    </div>

    {{-- Height --}}
    <div class="mb-3">
        <label for="height" class="form-label">Height (cm)</label>
        <input type="number" class="form-control form-control-md" id="height" name="height"
               value="{{ old('height', $userProfiling->height ?? '') }}" step="0.1" placeholder="e.g. 170">
    </div>

    {{-- Weight --}}
    <div class="mb-3">
        <label for="weight" class="form-label">Weight (kg)</label>
        <input type="number" class="form-control form-control-md" id="weight" name="weight"
               value="{{ old('weight', $userProfiling->weight ?? '') }}" step="0.1" placeholder="e.g. 65">
    </div>

    {{-- Activity Type --}}
    <div class="mb-3">
        <label class="form-label">Activity Type</label><br>
        @php
            $activityOptions = ['Recreational', 'Commuting', 'Racing', 'Adventure'];
            $selectedActivities = old('activity_type', json_decode($userProfiling->activity_type ?? '[]', true));
        @endphp
        @foreach ($activityOptions as $activity)
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="activity_{{ $activity }}" name="activity_type[]" value="{{ $activity }}"
                    {{ in_array($activity, $selectedActivities) ? 'checked' : '' }}>
                <label class="form-check-label" for="activity_{{ $activity }}">{{ $activity }}</label>
            </div>
        @endforeach
    </div>

    {{-- Terrain --}}
    <div class="mb-3">
        <label class="form-label">Preferred Terrain</label><br>
        @php
            $terrainOptions = ['Road', 'Trail', 'Mountain', 'Urban'];
            $selectedTerrains = old('terrain', json_decode($userProfiling->terrain ?? '[]', true));
        @endphp
        @foreach ($terrainOptions as $terrain)
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="terrain_{{ $terrain }}" name="terrain[]" value="{{ $terrain }}"
                    {{ in_array($terrain, $selectedTerrains) ? 'checked' : '' }}>
                <label class="form-check-label" for="terrain_{{ $terrain }}">{{ $terrain }}</label>
            </div>
        @endforeach
    </div>

    {{-- Experience Level --}}
    <div class="mb-3">
        <label for="experience_level" class="form-label">Experience Level</label>
        <select class="form-control form-control-md" id="experience_level" name="experience_level">
            <option value="">Select</option>
            <option value="Beginner" {{ old('experience_level', $userProfiling->experience_level ?? '') == 'Beginner' ? 'selected' : '' }}>Beginner</option>
            <option value="Intermediate" {{ old('experience_level', $userProfiling->experience_level ?? '') == 'Intermediate' ? 'selected' : '' }}>Intermediate</option>
            <option value="Advanced" {{ old('experience_level', $userProfiling->experience_level ?? '') == 'Advanced' ? 'selected' : '' }}>Advanced</option>
        </select>
    </div>

    {{-- Maintenance --}}
    <div class="mb-3">
        <label class="form-label">Do you do your own maintenance?</label><br>
        @php
            $maintenance = old('maintenance', isset($userProfiling->maintenance) && $userProfiling->maintenance ? 'yes' : 'no');
        @endphp
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="maintenance" id="maintenance_yes" value="yes"
                   {{ $maintenance == 'yes' ? 'checked' : '' }}>
            <label class="form-check-label" for="maintenance_yes">Yes</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="maintenance" id="maintenance_no" value="no"
                   {{ $maintenance == 'no' ? 'checked' : '' }}>
            <label class="form-check-label" for="maintenance_no">No</label>
        </div>
    </div>

    {{-- Custom Parts --}}
    <div class="mb-3">
        <label class="form-label">Do you use custom parts?</label><br>
        @php
            $customParts = old('custom_parts', isset($userProfiling->custom_parts) && $userProfiling->custom_parts ? 'yes' : 'no');
        @endphp
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="custom_parts" id="custom_parts_yes" value="yes"
                   {{ $customParts == 'yes' ? 'checked' : '' }}>
            <label class="form-check-label" for="custom_parts_yes">Yes</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="custom_parts" id="custom_parts_no" value="no"
                   {{ $customParts == 'no' ? 'checked' : '' }}>
            <label class="form-check-label" for="custom_parts_no">No</label>
        </div>
    </div>
</div>

<style>
    .submain {
        min-height: 70vh;
        overflow-y: auto; 
        margin: 15px; 
        background: #ffffff; 
        border-radius: 5px;
    } 
    
    .custom-scroll {
        max-height: 200px;
        overflow-y: scroll;
        scrollbar-width: thin;
        scrollbar-color: rgba(0,0,0,0.2) transparent;
        border-radius: 10px;
    }
    
    @media (max-width: 767px) {
        .submain {
            min-height: 10vh !important;
            max-height: calc(85vh - 130px) !important;
            overflow-y: scroll !important;
            margin: 0px !important;
        }
    }

    @media (max-height: 700px) and (max-width: 767px) {
        .submain {
            min-height: 10vh !important;
            max-height: calc(85vh - 150px) !important;
        }
    }
</style>
