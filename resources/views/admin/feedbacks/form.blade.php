<div class="card shadow p-3 custom-scroll submain">
    {{-- Account selection --}}
    <div class="mb-3">
        <label for="account_id" class="form-label">Account<span class="text-danger"> *</span></label>
        <select class="form-control form-control-md" id="account_id" name="account_id" required>
            <option value="">Select</option>
            @foreach($accounts as $account)
                <option value="{{ $account->id }}" {{ old('account_id', $feedback->account_id ?? '') == $account->id ? 'selected' : '' }}>
                    [ID: {{ $account->id }}] {{ $account->first_name }} {{ $account->last_name }}
                </option>
            @endforeach
        </select>
    </div>

    {{-- Comment --}}
    <div class="mb-3">
        <label for="comment" class="form-label">Comment<span class="text-danger"> *</span></label>
        <textarea class="form-control form-control-md" id="comment" name="comment" rows="4" required>{{ old('comment', $feedback->comment ?? '') }}</textarea>
    </div>

    {{-- Image Upload --}}
    <div class="mb-3">
        <label for="image" class="form-label">Image (optional)</label>
        <input type="file" class="form-control form-control-md" id="image" name="image" accept="image/*">
        @if (!empty($feedback->image))
            <div class="mt-2">
                <p class="mb-1">Current Image:</p>
                <img src="{{ asset('storage/' . $feedback->image) }}" alt="Current Feedback Image" style="max-height: 150px;">
            </div>
        @endif
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
