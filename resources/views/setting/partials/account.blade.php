<div id="account" class="section px-4">
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center mb-6">
        <h2 class="text-2xl font-bold mb-2 mb-4 sm:mb-0">Personal Info</h2>
    </div>

    {{-- <div class="mb-3">
        <label for="image" class="form-label">Image</label>
        <input type="file" class="form-control form-control-md" id="image" name="image">
        @if (!empty($account->image))
            <img src="{{ asset('storage/' . $account->image) }}" alt="Account Image" class="img-thumbnail mt-3" style="max-width: 150px;">
        @endif
    </div> --}}
    
    <form action="{{ route('account.update', $account) }}" method="POST" enctype="multipart/form-data" onsubmit="handleAccountSetting(event)">
        @csrf @method('PATCH')

        <div class="flex flex-col md:flex-row items-center gap-6 mb-4 border-b pb-4">
            <div class="w-24 h-24 bg-gray-200 rounded-full flex items-center justify-center overflow-hidden shadow-inner">
                @if (!empty($account->image))
                    <img src="{{ asset('storage/' . $account->image) }}" alt="Profile Photo" class="w-full h-full object-cover">
                @else
                    <span class="text-gray-500 text-4xl">👤</span>
                @endif
            </div>
            <div class="flex flex-col items-center md:items-start">
                <h3 class="text-xl font-semibold text-gray-700 mb-2">Profile Photo</h3>
                <div class="flex gap-4">
                    <a href="#" class="text-blue-600 font-medium hover:underline text-sm" onclick="document.getElementById('image').click(); return false;">Upload new photo</a>
                    <input type="file" class="hidden block text-sm font-medium text-gray-700 mb-1" id="image" name="image" accept="image/*" onchange="previewImage(event)">
                    <a href="#" class="text-red-500 font-medium hover:underline text-sm" onclick="removePhoto(event)">Remove photo</a>
                    <input type="hidden" name="remove_image" id="remove_image" value="0">
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-4 mb-4">
            <div>
                <label for="first_name" class="block text-sm font-medium text-gray-700 mb-1">First Name</label>
                <input type="text" id="first_name" name="first_name" value="{{ old('first_name', $account->first_name ?? '') }}" placeholder="Enter your first name" class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 p-3" readonly>
            </div>
            <div>
                <label for="last_name" class="block text-sm font-medium text-gray-700 mb-1">Last Name</label>
                <input type="text" id="last_name" name="last_name" value="{{ old('last_name', $account->last_name ?? '') }}" placeholder="Enter your last name" class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 p-3" readonly>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6 mb-4"> {{-- Added mb-10 for spacing before buttons --}}
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                <input type="email" id="email" name="email" value="{{ old('email', $account->email ?? '') }}" placeholder="Enter your email address" class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 p-3" readonly>
            </div>
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <input type="password" id="password" name="password" value="" placeholder="********" class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 p-3 bg-gray-100 cursor-not-allowed" readonly>
            </div>
        </div>

        <div class="flex justify-end gap-3 pt-6 border-t">
            <button type="button" onclick="enableEditing()" class="px-5 py-2 border border-blue-600 text-blue-600 font-semibold rounded-lg hover:bg-blue-50 transition duration-300 ease-in-out">
                Edit Profile
            </button>
            <button type="submit" class="px-5 py-2 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition duration-300 ease-in-out">
                Save Changes
            </button>
        </div>
    </form>

    <SCript>
        function previewImage(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const container = document.querySelector('.w-24.h-24');
                    container.innerHTML = `<img src="${e.target.result}" alt="Profile Photo" class="w-full h-full object-cover">`;
                };
                reader.readAsDataURL(file);
                document.getElementById('remove_image').value = "0";
            }
        }

        function removePhoto(event) {
            event.preventDefault();
            const container = document.querySelector('.w-24.h-24');
            container.innerHTML = '<span class="text-gray-500 text-4xl">👤</span>';
            document.getElementById('image').value = '';
            document.getElementById('remove_image').value = "1";
        }
    </SCript>

    <script>
        function enableEditing() {
            document.querySelectorAll('#account input').forEach(input => {
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
    
    <script>
        // Account setting handler
        function handleAccountSetting(event) {
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
                if (data.success) {
                    showAccountSuccess('Profile Updated', data.message);
                } else {
                    showAccountSuccess('Error', 'Failed to update profile. Please try again.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showAccountSuccess('Error', 'An unexpected error occurred.');
            });
        }

        function showAccountSuccess(title, message) {
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
</div>