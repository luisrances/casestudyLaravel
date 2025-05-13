<div class="card shadow p-3 custom-scroll submain">
    <div class="mb-3">
        <label for="account_id" class="form-label">Customer</label>
        <select class="form-control form-control-md" id="account_id" name="account_id" required>
            <option value="">Select</option>
            @foreach ($accounts as $account)
                <option value="{{ $account->id }}" {{ old('account_id', $paymentDetail->account_id ?? '') == $account->id ? 'selected' : '' }}>
                    [ID: {{ $account->id }}] {{ $account->first_name }} {{ $account->last_name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="recipient_name" class="form-label">Recipient Name</label>
        <input type="text" class="form-control form-control-md" id="recipient_name" name="recipient_name" 
               value="{{ old('recipient_name', $paymentDetail->recipient_name ?? '') }}" 
               placeholder="Enter recipient name" required>
    </div>

    <div class="mb-3">
        <label for="phone_number" class="form-label">Phone Number</label>
        <input type="text" class="form-control form-control-md" id="phone_number" name="phone_number" 
               value="{{ old('phone_number', $paymentDetail->phone_number ?? '') }}" 
               placeholder="Enter phone number" required>
    </div>

    <div class="mb-3">
        <label for="district" class="form-label">District</label>
        <input type="text" class="form-control form-control-md" id="district" name="district" 
               value="{{ old('district', $paymentDetail->district ?? '') }}" 
               placeholder="Enter district" required>
    </div>

    <div class="mb-3">
        <label for="city" class="form-label">City</label>
        <input type="text" class="form-control form-control-md" id="city" name="city" 
               value="{{ old('city', $paymentDetail->city ?? '') }}" 
               placeholder="Enter city" required>
    </div>

    <div class="mb-3">
        <label for="region" class="form-label">Region</label>
        <input type="text" class="form-control form-control-md" id="region" name="region" 
               value="{{ old('region', $paymentDetail->region ?? '') }}" 
               placeholder="Enter region" required>
    </div>

    <div class="mb-3">
        <label for="street" class="form-label">Street</label>
        <input type="text" class="form-control form-control-md" id="street" name="street" 
               value="{{ old('street', $paymentDetail->street ?? '') }}" 
               placeholder="Enter street address" required>
    </div>

    <div class="mb-3">
        <label for="address_category" class="form-label">Address Category</label>
        <select class="form-control form-control-md" id="address_category" name="address_category" required>
            <option value="home address" {{ old('address_category', $paymentDetail->address_category ?? '') == 'home address' ? 'selected' : '' }}>Home Address</option>
            <option value="office address" {{ old('address_category', $paymentDetail->address_category ?? '') == 'office address' ? 'selected' : '' }}>Office Address</option>
        </select>
    </div>
</div>

<style>
    .submain {
        min-height: 70vh;
        overflow-y: auto; 
        margin: 15px; 
        background: #ffffff ; 
        border-radius: 5px;
    } 
    
    .custom-scroll {
        max-height: 200px;
        overflow-y: scroll;
        padding-right: -8px;
        scrollbar-width: thin;
        scrollbar-color: rgba(0,0,0,0.2) transparent;
        position: relative;
        border-radius: 10px;
    }
    @media (max-width: 767px) {
        .submain{
            min-height: 10vh !important;
            max-height: calc(85vh - 130px) !important;
            overflow-y: scroll !important;
            margin: 0px !important;
        }
    }
    @media (max-height: 700px) and (max-width: 767px) {
        .submain{
            min-height: 10vh !important;
            max-height: calc(85vh - 150px) !important;
        }
    }
</style>
