<div class="card shadow p-3 custom-scroll submain">
    <div class="mb-3">
        <label for="first_name" class="form-label">First Name<span class="text-danger"> *</span></label>
        <input type="text" class="form-control form-control-md" id="first_name" name="first_name" value="{{ old('first_name', $account->first_name ?? '') }}" placeholder="Enter first name" required>
    </div>

    <div class="mb-3">
        <label for="last_name" class="form-label">Last Name<span class="text-danger"> *</span></label>
        <input type="text" class="form-control form-control-md" id="last_name" name="last_name" value="{{ old('last_name', $account->last_name ?? '') }}" placeholder="Enter last name" required>
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">Email<span class="text-danger"> *</span></label>
        <input type="email" class="form-control form-control-md" id="email" name="email" value="{{ old('email', $account->email ?? '') }}" placeholder="Enter email address" required>
    </div>

    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control form-control-md" id="password" name="password" placeholder="Enter password">
    </div>

    <div class="mb-3">
        <label for="image" class="form-label">Image</label>
        <input type="file" class="form-control form-control-md" id="image" name="image">
        @if (!empty($account->image))
            <img src="{{ asset('storage/' . $account->image) }}" alt="Account Image" class="img-thumbnail mt-3" style="max-width: 150px;">
        @endif
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
            border: 1px solid red;
        }
    }
</style>
