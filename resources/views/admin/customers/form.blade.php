<div class="card shadow p-3 custom-scroll submain">
    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control form-control-md" id="name" name="name" value="{{ old('name', $customer->name ?? '') }}" placeholder="Enter customer name">
    </div>

    <div class="mb-3">
        <label for="age" class="form-label">Age</label>
        <input type="number" class="form-control form-control-md" id="age" name="age" value="{{ old('age', $customer->age ?? '') }}" placeholder="Enter customer age">
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control form-control-md" id="email" name="email" value="{{ old('email', $customer->email ?? '') }}" placeholder="Enter customer email">
    </div>

    <div class="mb-3">
        <label for="sex" class="form-label">Sex</label>
        <select class="form-control form-control-md" id="sex" name="sex">
            <option value="Male" {{ old('sex', $customer->sex ?? '') == 'Male' ? 'selected' : '' }}>Male</option>
            <option value="Female" {{ old('sex', $customer->sex ?? '') == 'Female' ? 'selected' : '' }}>Female</option>
            <option value="Other" {{ old('sex', $customer->sex ?? '') == 'Other' ? 'selected' : '' }}>Other</option>
        </select>
    </div>

    <div class="mb-3">
        <label for="image_path" class="form-label">Image</label>
        <input type="file" class="form-control form-control-md" id="image_path" name="image_path">
        @if (!empty($customer->image_path))
            <img src="{{ asset('storage/' . $customer->image_path) }}" alt="Customer Image" class="img-thumbnail mt-3" style="max-width: 150px;">
        @endif
    </div>
</div>

<style>
    .submain {
        min-height: 75vh;
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
            border: 1px solid red;
        }
    }
</style>
