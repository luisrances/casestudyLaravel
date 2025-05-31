<!--DELETE ACCOUNT-->
<div id="delete_account" class="section hidden px-4">
    <h2 class="text-2xl font-bold mb-4">Delete Account</h2>
    
    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    <p class="text-red-600">Warning: This action cannot be undone. All your data will be permanently deleted.</p>
    <form method="POST" action="{{ route('account.delete') }}" onsubmit="handleRemoveAccount(event)" class="mt-4">
        @csrf
        @method('DELETE')
        <div class="mt-4 space-x-2">
            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Delete Account</button>
            <button type="button" onclick="window.location.href='{{ route('account.setting') }}'" class="bg-gray-300 px-4 py-2 rounded hover:bg-gray-400">Cancel</button>        </div>
    </form>
</div>

<script>
    // remove account handler
    function handleRemoveAccount(event) {
        event.preventDefault();
        const form = event.target;
        const formData = new FormData(form);

        fetch('{{ route('account.delete') }}', {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            showAccountSuccess('Success', 'Account successfully deleted');
            setTimeout(() => {
                window.location.href = '{{ route('Home') }}';
            }, 2000);
        })
        .catch(error => {
            console.error('Error:', error);
            showAccountSuccess('Error', 'Failed to delete account');
        });
    }

    function showAccountSuccess(title, message) {
        document.getElementById('success-alert-title').innerText = title;
        document.getElementById('success-alert-message').innerText = message;
        const alert = document.getElementById('success-alert');
        alert.style.display = 'block';
        setTimeout(() => {
            alert.style.display = 'none';
        }, 1000);
    }
</script>