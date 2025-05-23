<!--ADDRESS-->
<div id="address" class="section hidden px-4">
    <h2 class="text-2xl font-bold mb-4">ADDRESS BOOK</h2>

    <!-- View Address -->
    <div id="address-view">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold">My Address</h3>
            <button onclick="showAddForm()" class="border border-gray-400 px-4 py-1 rounded">+ Add address</button>
        </div>

        <div id="" class="space-y-4">
            <!-- Dynamic addresses will be injected here -->
            @foreach ($paymentDetails as $detail)
                <div class="border p-4 rounded relative">
                    <div class="flex justify-between items-start">
                        <div class="flex items-start space-x-4">
                            <img src="https://cdn-icons-png.flaticon.com/512/684/684908.png" class="w-6 h-6 mt-1" alt="Location Icon" />
                            <div>
                                <p><strong>{{$detail->recipient_name}}</strong> {{$detail->phone_number}}</p>
                                <p>{{$detail->street}},  {{$detail->district}},  {{$detail->city}}, {{$detail->region}}</p>
                                <div class="mt-2 space-x-2">
                                    <span class="border px-2 py-1 text-xs">{{$detail->address_category}}</span>
                                    {{-- ${detail.default ? '<span class="border px-2 py-1 text-xs">Default Address</span>' : ''} --}}
                                </div>
                            </div>
                        </div>
                        <div>
                            <button class="text-blue-600 hover:underline text-sm">Edit</button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Add/Edit Address Form -->
    <div id="address-form" class="hidden mt-4">
        <h3 id="form-title" class="text-lg font-semibold mb-4">ADD NEW ADDRESS</h3>
        <form action="{{ route('address.update', $paymentDetail) }}" method="POST">
            @csrf @method('PUT')
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
            <div class="flex justify-end space-x-4 mt-4">
                <button type="button" onclick="cancelAddEdit()" class="border px-4 py-1 rounded">Cancel</button>
                <button type="submit" class="border px-4 py-1 rounded bg-blue-600 text-white">Save</button>
            </div>
        </form>
        {{-- <form class="space-y-4" onsubmit="saveAddress(event)">
            <div class="flex flex-col md:flex-row md:space-x-4">
                <input id="recipient-name" type="text" placeholder="Recipient’s Name" class="w-full border p-2 rounded" required />
                <input id="phone-number" type="text" placeholder="Phone Number" class="w-full border p-2 rounded" required />
            </div>
            <input id="region" type="text" placeholder="District/City/Region" class="w-full border p-2 rounded" required />
            <input id="street" type="text" placeholder="Street/Building Name" class="w-full border p-2 rounded" required />
            <div class="flex space-x-4">
                <label><input type="radio" name="category" value="Home" checked /> Home</label>
                <label><input type="radio" name="category" value="Office" /> Office</label>
            </div>
            <div class="flex justify-end space-x-4 mt-4">
                <button type="button" onclick="cancelAddEdit()" class="border px-4 py-1 rounded">Cancel</button>
                <button type="submit" class="border px-4 py-1 rounded bg-blue-600 text-white">Save</button>
            </div>
        </form> --}}
    </div>
</div>