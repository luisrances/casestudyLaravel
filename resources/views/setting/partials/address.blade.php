<!--ADDRESS-->
<div id="address" class="section hidden px-4">
    <h2 class="text-2xl font-bold mb-4">ADDRESS BOOK</h2>

    <!-- View Address -->
    <div id="address-view">
        {{-- <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold">My Address</h3>
            <button onclick="showAddForm()" class="border border-gray-400 px-4 py-1 rounded">+ Add address</button>
        </div> --}}

        <div class="space-y-4">
            <!-- Dynamic addresses will be injected here -->
            @foreach ($paymentDetails as $detail)
                 <!-- Add/Edit Address Form -->
                    <div id="address-form" class="">
                        <form id="address-edit-form" method="POST" action="{{ route('address.update', $detail->id) }}">
                            @csrf
                            @method('PUT')
                
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-5">
                                {{-- Recipient Name --}}
                                <div>
                                    <label for="recipient_name" class="block text-gray-700 text-sm font-medium mb-1">Recipient Name</label>
                                    <input type="text" value="{{ old('recipient_name', $detail->recipient_name) }}"
                                           class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400
                                                  focus:ring-2 focus:ring-blue-500 focus:border-transparent focus:outline-none
                                                  @error('recipient_name') border-red-500 ring-red-200 @enderror"
                                           id="recipient_name" name="recipient_name" placeholder="e.g., John Doe" required readonly>
                                    @error('recipient_name')
                                        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                
                                {{-- Phone Number --}}
                                <div>
                                    <label for="phone_number" class="block text-gray-700 text-sm font-medium mb-1">Phone Number</label>
                                    <input type="tel" value="{{ old('phone_number', $detail->phone_number) }}"
                                           class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400
                                                  focus:ring-2 focus:ring-blue-500 focus:border-transparent focus:outline-none
                                                  @error('phone_number') border-red-500 ring-red-200 @enderror"
                                           id="phone_number" name="phone_number" placeholder="e.g., +63917xxxxxxx" required readonly>
                                    @error('phone_number')
                                        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                
                                {{-- District --}}
                                <div>
                                    <label for="district" class="block text-gray-700 text-sm font-medium mb-1">District</label>
                                    <input type="text" value="{{ old('district', $detail->district) }}"
                                           class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400
                                                  focus:ring-2 focus:ring-blue-500 focus:border-transparent focus:outline-none
                                                  @error('district') border-red-500 ring-red-200 @enderror"
                                           id="district" name="district" placeholder="e.g., Poblacion" required readonly>
                                    @error('district')
                                        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                
                                {{-- City --}}
                                <div>
                                    <label for="city" class="block text-gray-700 text-sm font-medium mb-1">City</label>
                                    <input type="text" value="{{ old('city', $detail->city) }}"
                                           class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400
                                                  focus:ring-2 focus:ring-blue-500 focus:border-transparent focus:outline-none
                                                  @error('city') border-red-500 ring-red-200 @enderror"
                                           id="city" name="city" placeholder="e.g., Taytay" required readonly>
                                    @error('city')
                                        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                
                                {{-- Region --}}
                                <div>
                                    <label for="region" class="block text-gray-700 text-sm font-medium mb-1">Region</label>
                                    <input type="text" value="{{ old('region', $detail->region) }}"
                                           class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400
                                                  focus:ring-2 focus:ring-blue-500 focus:border-transparent focus:outline-none
                                                  @error('region') border-red-500 ring-red-200 @enderror"
                                           id="region" name="region" placeholder="e.g., CALABARZON" required readonly>
                                    @error('region')
                                        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                
                                {{-- Street --}}
                                <div>
                                    <label for="street" class="block text-gray-700 text-sm font-medium mb-1">Street Address</label>
                                    <input type="text" value="{{ old('street', $detail->street) }}"
                                           class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400
                                                  focus:ring-2 focus:ring-blue-500 focus:border-transparent focus:outline-none
                                                  @error('street') border-red-500 ring-red-200 @enderror"
                                           id="street" name="street" placeholder="e.g., 123 Main Street" required readonly>
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
                                            <option value="" disabled {{ old('address_category', $detail->address_category) == '' ? 'selected' : '' }}>Select address type</option>
                                            <option value="home address" {{ old('address_category', $detail->address_category) == 'home address' ? 'selected' : '' }}>Home Address</option>
                                            <option value="office address" {{ old('address_category', $detail->address_category) == 'office address' ? 'selected' : '' }}>Office Address</option>
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
                                <button type="button" onclick="enableEditing()"
                                        class="w-full sm:w-auto px-6 py-2 bg-white text-gray-700 font-semibold border border-gray-300 rounded-lg shadow-sm
                                               hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2
                                               transition duration-200 ease-in-out">
                                    Edit
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
                {{-- <div class="border p-4 rounded relative"  id="view">
                    <div class="flex justify-between items-start">
                        <div class="flex items-start space-x-4">
                            <img src="https://cdn-icons-png.flaticon.com/512/684/684908.png" class="w-6 h-6 mt-1" alt="Location Icon" />
                            <div>
                                <p><strong>{{$detail->recipient_name}}</strong> {{$detail->phone_number}}</p>
                                <p>{{$detail->street}},  {{$detail->district}},  {{$detail->city}}, {{$detail->region}}</p>
                                <div class="mt-2 space-x-2">
                                    <span class="border px-2 py-1 text-xs">{{$detail->address_category}}</span>
                                </div>
                            </div>
                        </div>
                        <div>
                            <button 
                                class="text-blue-600 hover:underline text-sm"
                                onclick="editAddress({{ $detail->id }}, '{{ addslashes($detail->recipient_name) }}', '{{ addslashes($detail->phone_number) }}', '{{ addslashes($detail->district) }}', '{{ addslashes($detail->city) }}', '{{ addslashes($detail->region) }}', '{{ addslashes($detail->street) }}', '{{ addslashes($detail->address_category) }}')"
                            >Edit</button>
                        </div>
                    </div>
                </div> --}}
            @endforeach
        </div>
    </div>
</div>

<script>
    function enableEditing() {
        document.querySelectorAll('#address-form input').forEach(input => {
            input.removeAttribute('readonly');

            if (input.type === 'password') {
                input.classList.remove('bg-gray-100', 'cursor-not-allowed');
            }

            // alert
            document.getElementById('success-alert-title').innerText = 'Allowed';
            document.getElementById('success-alert-message').innerText = 'You can now edit the fields';
            const alert = document.getElementById('success-alert');

            // hide after some time
            alert.style.display = 'block';
            setTimeout(() => {
                alert.style.display = 'none';
            }, 2000);
        });
    
        document.getElementById('edit-button').classList.add('hidden');
        document.getElementById('save-button').classList.remove('hidden');
    }
</script> 