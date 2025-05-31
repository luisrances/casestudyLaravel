<!--ADDRESS-->
<div id="address" class="section hidden px-4">
    <h2 class="text-2xl font-bold mb-4">ADDRESS BOOK</h2>

    <!-- View Address -->
    <div>
        <div id="address-view">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold">My Address</h3>
                <button onclick="showAddForm()" class="border border-gray-400 px-4 py-1 rounded">+ Add address</button>
            </div>
            <div class="space-y-4">
                <div class="">
                    @php
                        $userPaymentDetails = $paymentDetails->where('account_id', Auth::id());
                    @endphp
                    @if ($paymentDetails->isEmpty() || $userPaymentDetails->isEmpty())
                        <div class="w-full py-8 text-center bg-gray-50 border border-gray-300 text-gray-700 rounded-md">
                            ⚠️ No Address Detail available.
                        </div>
                    @else
                        @foreach ($paymentDetails as $detail)
                        @if ($detail->account_id == Auth::user()->id)
                            <div class="border p-4 mb-4 rounded relative">
                                <div class="flex justify-between items-start">
                                    <div class="flex items-start space-x-4">
                                        <img src="https://cdn-icons-png.flaticon.com/512/684/684908.png" class="w-6 h-6 mt-1" alt="Location Icon" />
                                        <div>
                                            <p><strong>{{$detail->recipient_name}}</strong> {{$detail->phone_number}}</p>
                                            <p>{{$detail->street}},  {{$detail->district}},  {{$detail->city}}, {{$detail->region}}</p>
                                            <div class="mt-2 mb-2 space-x-2">
                                                <span class="border px-2 py-1 text-xs">{{$detail->address_category}}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex justify-center">
                                        <button 
                                            class="font-medium text-sm text-blue-600 hover:underline mr-4"
                                            onclick="ShowEditForm({{ json_encode($detail) }})"
                                        >Edit</button>
                                        <form onsubmit="handleRemoveAddress(event, {{ $detail->id }})" class="inline">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="font-medium text-sm text-red-600 hover:underline">Remove</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @endforeach
                    @endif
                </div>
            </div>
        </div>

        <div class="space-y-4">
            {{-- for add --}}
            <div id="address-add" class="hidden">
                <form id="address-add-form" method="POST" action="{{ route('address.add') }}" onsubmit="handleAddAddress(event)">
                    @csrf
        
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-5">
                        {{-- Recipient Name --}}
<div>
    <label for="recipient_name" class="block text-gray-700 text-sm font-medium mb-1">Recipient Name</label>
    <input type="text" 
        class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 bg-gray-100
            focus:ring-2 focus:ring-blue-500 focus:border-transparent focus:outline-none
            @error('recipient_name') border-red-500 ring-red-200 @enderror"
        id="recipient_name" name="recipient_name"
        value="{{ Auth::user()->first_name . ' ' . Auth::user()->last_name }}"
        placeholder="e.g., John Doe" readonly>
    @error('recipient_name')
        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>
        
                        {{-- Phone Number --}}
                        <div>
                            <label for="phone_number" class="block text-gray-700 text-sm font-medium mb-1">Phone Number</label>
                            <input type="text"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400
                                            focus:ring-2 focus:ring-blue-500 focus:border-transparent focus:outline-none
                                            @error('phone_number') border-red-500 ring-red-200 @enderror"
                                    id="phone_number" name="phone_number" placeholder="e.g., 0917xxxxxxx"  min="11" max="11" required>
                            @error('phone_number')
                                <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
        
                        {{-- District --}}
                        <div>
                            <label for="district" class="block text-gray-700 text-sm font-medium mb-1">District</label>
                            <input type="text"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400
                                            focus:ring-2 focus:ring-blue-500 focus:border-transparent focus:outline-none
                                            @error('district') border-red-500 ring-red-200 @enderror"
                                    id="district" name="district" placeholder="e.g., Poblacion" required>
                            @error('district')
                                <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
        
                        {{-- City --}}
                        <div>
                            <label for="city" class="block text-gray-700 text-sm font-medium mb-1">City</label>
                            <input type="text"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400
                                            focus:ring-2 focus:ring-blue-500 focus:border-transparent focus:outline-none
                                            @error('city') border-red-500 ring-red-200 @enderror"
                                    id="city" name="city" placeholder="e.g., Taytay" required>
                            @error('city')
                                <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
        
                        {{-- Region --}}
                        <div>
                            <label for="region" class="block text-gray-700 text-sm font-medium mb-1">Region</label>
                            <input type="text"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400
                                            focus:ring-2 focus:ring-blue-500 focus:border-transparent focus:outline-none
                                            @error('region') border-red-500 ring-red-200 @enderror"
                                    id="region" name="region" placeholder="e.g., CALABARZON" required>
                            @error('region')
                                <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
        
                        {{-- Street --}}
                        <div>
                            <label for="street" class="block text-gray-700 text-sm font-medium mb-1">Street Address</label>
                            <input type="text"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400
                                            focus:ring-2 focus:ring-blue-500 focus:border-transparent focus:outline-none
                                            @error('street') border-red-500 ring-red-200 @enderror"
                                    id="street" name="street" placeholder="e.g., 123 Main Street" required>
                            @error('street')
                                <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
        
                        {{-- Address Category --}}
                        <div class="md:col-span-2"> {{-- Occupy full width on medium screens and up --}}
                            <label for="address_category" class="block text-gray-700 text-sm font-medium mb-1">Address Category</label>
                            <div class="relative">
                                <select class="block appearance-none w-full bg-white border border-gray-300 text-gray-700
                                                py-2 px-4 pr-8 rounded-lg shadow-sm leading-tight
                                                focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent
                                                @error('address_category') border-red-500 ring-red-200 @enderror"
                                        id="address_category" name="address_category" required>
                                    <option>Select address type</option>
                                    <option value="home address">Home Address</option>
                                    <option value="office address">Office Address</option>
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-gray-700">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                                </div>
                            </div>
                            @error('address_category')
                                <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
        
                    {{-- Form Actions --}}
                    <div class="flex flex-col sm:flex-row justify-end space-y-3 sm:space-y-0 sm:space-x-4 mt-8 pt-6 border-t border-gray-200">
                        <button type="button" onclick="HideAddForm()"
                                class="px-5 py-2 border border-blue-600 text-blue-600 font-semibold rounded-lg hover:bg-blue-50 transition duration-300 ease-in-out">
                            Cancel
                        </button>
                        <button type="submit"
                                class="w-full sm:w-auto px-6 py-2 bg-blue-600 text-white font-semibold rounded-lg shadow-md
                                        hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2
                                        transition duration-200 ease-in-out">
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>
            {{-- for edit --}}
            <div id="address-edit" class="hidden">
                <div class="">
                    <!-- Form will be dynamically inserted here -->
                    <div id="editFormContainer"></div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- for edititing the address details --}}
<script>
    function ShowEditForm(detail) {
    const formContainer = document.getElementById('editFormContainer');
        
        // Default values for the form
        const defaultValues = {
            id: '',
            recipient_name: '',
            phone_number: '',
            district: '',
            city: '',
            region: '',
            street: '',
            address_category: ''
        };
        
        // Merge passed details with default values
        detail = detail ? { ...defaultValues, ...detail } : defaultValues;
        
        // Check if detail is empty
        if (!detail || Object.keys(detail).length === 0) {
            formContainer.innerHTML = `
                <div class="w-full py-8 text-center bg-gray-50 border border-gray-300 text-gray-700 rounded-md">
                    ⚠️ No address details available to edit.
                </div>
            `;
            return;
        }

        const formHTML = `
            <form id="address-edit-form" method="POST" action="/account-setting/address/${detail.id}" onsubmit="handleEditAddress(event)">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-5">
                    <input type="hidden" id="edit-id" value="${detail.id}">
                    
                    <!-- Recipient Name -->
                    <div>
                        <label for="recipient_name" class="block text-gray-700 text-sm font-medium mb-1">Recipient Name</label>
                        <input type="text" value="${detail.recipient_name}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400
                                    focus:ring-2 focus:ring-blue-500 focus:border-transparent focus:outline-none"
                            id="recipient_name" name="recipient_name" required>
                    </div>
                    
                        {{-- Phone Number --}}
                        <div>
                            <label for="phone_number" class="block text-gray-700 text-sm font-medium mb-1">Phone Number</label>
                            <input type="text" value="${detail.phone_number}"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400
                                            focus:ring-2 focus:ring-blue-500 focus:border-transparent focus:outline-none
                                            @error('phone_number') border-red-500 ring-red-200 @enderror"
                                    id="phone_number" name="phone_number" placeholder="e.g., 0917xxxxxxx" minlength="11" maxlength="11" required>
                            @error('phone_number')
                                <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
        
                        {{-- District --}}
                        <div>
                            <label for="district" class="block text-gray-700 text-sm font-medium mb-1">District</label>
                            <input type="text" value="${detail.district}"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400
                                            focus:ring-2 focus:ring-blue-500 focus:border-transparent focus:outline-none
                                            @error('district') border-red-500 ring-red-200 @enderror"
                                    id="district" name="district" placeholder="e.g., Poblacion" required>
                            @error('district')
                                <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
        
                        {{-- City --}}
                        <div>
                            <label for="city" class="block text-gray-700 text-sm font-medium mb-1">City</label>
                            <input type="text" value="${detail.city}"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400
                                            focus:ring-2 focus:ring-blue-500 focus:border-transparent focus:outline-none
                                            @error('city') border-red-500 ring-red-200 @enderror"
                                    id="city" name="city" placeholder="e.g., Taytay" required>
                            @error('city')
                                <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
        
                        {{-- Region --}}
                        <div>
                            <label for="region" class="block text-gray-700 text-sm font-medium mb-1">Region</label>
                            <input type="text" value="${detail.region}"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400
                                            focus:ring-2 focus:ring-blue-500 focus:border-transparent focus:outline-none
                                            @error('region') border-red-500 ring-red-200 @enderror"
                                    id="region" name="region" placeholder="e.g., CALABARZON" required>
                            @error('region')
                                <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
        
                        {{-- Street --}}
                        <div>
                            <label for="street" class="block text-gray-700 text-sm font-medium mb-1">Street Address</label>
                            <input type="text" value="${detail.street}"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400
                                            focus:ring-2 focus:ring-blue-500 focus:border-transparent focus:outline-none
                                            @error('street') border-red-500 ring-red-200 @enderror"
                                    id="street" name="street" placeholder="e.g., 123 Main Street" required>
                            @error('street')
                                <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
        
                        {{-- Address Category --}}
                        <div class="md:col-span-2"> {{-- Occupy full width on medium screens and up --}}
                            <label for="address_category" class="block text-gray-700 text-sm font-medium mb-1">Address Category</label>
                            <div class="relative">
                                <select class="block appearance-none w-full bg-white border border-gray-300 text-gray-700
                                            py-2 px-4 pr-8 rounded-lg shadow-sm leading-tight
                                            focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent
                                            @error('address_category') border-red-500 ring-red-200 @enderror"
                                        id="address_category" name="address_category" required>
                                    <option value="">Select address type</option>
                                    <option value="home address" {{ old('address_category', $detail->address_category ?? '') == 'home address' ? 'selected' : '' }}>Home Address</option>
                                    <option value="office address" {{ old('address_category', $detail->address_category ?? '') == 'office address' ? 'selected' : '' }}>Office Address</option>
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-gray-700">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                                </div>
                            </div>
                            @error('address_category')
                                <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
        
                    {{-- Form Actions --}}
                    <div class="flex flex-col sm:flex-row justify-end space-y-3 sm:space-y-0 sm:space-x-4 mt-8 pt-6 border-t border-gray-200">
                        <button type="button" onclick="HideAddForm()"
                                class="px-5 py-2 border border-blue-600 text-blue-600 font-semibold rounded-lg hover:bg-blue-50 transition duration-300 ease-in-out">
                            Cancel
                        </button>
                        <button type="submit"
                                class="w-full sm:w-auto px-6 py-2 bg-blue-600 text-white font-semibold rounded-lg shadow-md
                                        hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2
                                        transition duration-200 ease-in-out">
                            Save Changes
                        </button>
                    </div>
                </div>
            </form>
        `;
    
    // Insert the form HTML
    formContainer.innerHTML = formHTML;
    // Show the edit page
    document.getElementById("address-view").classList.add("hidden");
    document.getElementById("address-add").classList.add("hidden");
    document.getElementById("address-edit").classList.remove("hidden");
}

// Update the handle edit function
function handleEditAddress(event) {
    event.preventDefault();
    const form = event.target;
    const formData = new FormData(form);

    fetch(form.action, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        closeEditModal();
        addressalert('Success', data.message);
    })
    .catch(error => {
        console.error('Error:', error);
        addressalert('Error', 'Address Detail Edited unsuccessfully.');
    });
}
</script>

<script>
    function showAddForm() {
        document.getElementById("address-view").classList.add("hidden");
        document.getElementById("address-add").classList.remove("hidden");
        document.getElementById("address-edit").classList.add("hidden");
    }
    function HideAddForm() {
        document.getElementById("address-view").classList.remove("hidden");
        document.getElementById("address-add").classList.add("hidden");
        document.getElementById("address-edit").classList.add("hidden");
    }
</script> 

<script>
    // add address handler
    function handleAddAddress(event) {
        event.preventDefault();
        const form = event.target;
        const formData = new FormData(form);

        fetch(`{{ route('address.add') }}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            addressalert('Success', data.message);
        })
        .catch(error => {
            console.error('Error:', error);
            addressalert('Error', error.message);
        });
    }
</script>

<script>
    // remove address handler
    function handleRemoveAddress(event, id) {
        event.preventDefault();
        const form = event.target;
        const formData = new FormData(form);

        fetch(`/account-setting/address/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            addressalert('Success', data.message);
        })
        .catch(error => {
            console.error('Error:', error);
            addressalert('Error', error.message);
        });
    }
</script>

<script>
    // edit address handler
    function handleEditAddress(event) {
        event.preventDefault();
        const form = event.target;
        const formData = new FormData(form);

        fetch(form.action, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
                addressalert('Success', data.message);
        })
        .catch(error => {
            console.error('Error:', error);
            addressalert('Error', 'Address Detail Edited unsuccessfully.');
        });
    }
</script>

<script>
    function addressalert(title, message) {
        document.getElementById('success-alert-title').innerText = title;
        document.getElementById('success-alert-message').innerText = message;
        const alert = document.getElementById('success-alert');
        alert.style.display = 'block';
        setTimeout(() => {
            alert.style.display = 'none';
            window.location.href = '{{ route('account.setting') }}';
        }, 1000);
    }
</script>

<style>
    .modal-backdrop {
        background-color: rgba(0, 0, 0, 0.5);
    }
    
    .modal-content {
        max-height: calc(100vh - 2rem);
        overflow-y: auto;
    }
</style>