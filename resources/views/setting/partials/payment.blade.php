<!--PAYMENT-->
<div id="payment" class="section hidden px-4">
    <h2 class="text-2xl font-bold mb-2">PAYMENT DETAILS</h2>
    <p class="text-sm text-gray-600 mb-6">(This is for default payment)</p>

    <div class="border-b mb-10">
        <div class="flex flex-col md:flex-row gap-4 mb-5">
            <label class="flex items-center border px-4 rounded cursor-pointer w-full md:w-auto h-[50px]">
                <input type="radio" name="payment_method" value="cod" class="mr-2" checked>
                <img src="./Images/COD.png" alt="COD" width="60" height="30" class="object-contain"
                    title="Cash on Delivery" />
            </label>
            <label class="flex items-center border px-4 rounded cursor-pointer w-full md:w-auto h-[50px]">
                <input type="radio" name="payment_method" value="gcash" class="mr-2">
                <img src="./Images/Gcash.png" alt="Gcash" width="60" height="30" class="object-contain" title="GCash" />
            </label>
            <label class="flex items-center border px-4 rounded cursor-pointer w-full md:w-auto h-[50px]">
                <input type="radio" name="payment_method" value="credit_card" class="mr-2">
                <img src="./Images/Card.png" alt="Card" width="60" height="30" class="object-contain"
                    title="Credit Card" />
            </label>
        </div>
    </div>

    <div id="gcash-fields" class="grid md:grid-cols-2 gap-4 mb-10 hidden">
        <div>
            <label class="block text-sm font-semibold mb-1">GCash account name</label>
            <input type="text" class="w-full border px-3 py-2 rounded" placeholder="GCash account name">
        </div>
        <div>
            <label class="block text-sm font-semibold mb-1">GCash number</label>
            <input type="text" class="w-full border px-3 py-2 rounded" placeholder="GCash number">
        </div>
        <div class="md:col-span-2">
            <label class="block text-sm font-semibold mb-1">Linked email (optional)</label>
            <input type="email" class="w-full border px-3 py-2 rounded" placeholder="Linked email">
        </div>
    </div>

    <div id="credit-fields" class="grid md:grid-cols-2 gap-4 mb-10 hidden">
        <div>
            <label class="block text-sm font-semibold mb-1">Cardholder name</label>
            <input type="text" class="w-full border px-3 py-2 rounded" placeholder="Cardholder name">
        </div>
        <div>
            <label class="block text-sm font-semibold mb-1">Card number</label>
            <input type="text" class="w-full border px-3 py-2 rounded" placeholder="Card number">
        </div>
        <div>
            <label class="block text-sm font-semibold mb-1">Expiration date</label>
            <input type="text" class="w-full border px-3 py-2 rounded" placeholder="MM/YY">
        </div>
        <div>
            <label class="block text-sm font-semibold mb-1">Linked email (optional)</label>
            <input type="email" class="w-full border px-3 py-2 rounded" placeholder="Linked email">
        </div>
    </div>

    <div id="cod-fields" class="grid md:grid-cols-1 h-[147.5px] gap-4 mb-10">
        <div class="w-full py-[60px] text-center bg-gray-50 border border-gray-300 text-gray-700 rounded-md">
            Default payment set to COD.
        </div>
    </div>

    <div class="flex justify-end gap-3 pt-6 border-t">
        <button type="submit"
            class="px-5 py-2 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition duration-300 ease-in-out">
            Save Changes
        </button>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // PAYMENT METHOD FIELD TOGGLING
        const gcashFields = document.getElementById('gcash-fields');
        const creditFields = document.getElementById('credit-fields');
        const codFields = document.getElementById('cod-fields');
        const radios = document.querySelectorAll('input[name="payment_method"]');
        const actionButtons = document.querySelector('#payment .flex.justify-end');

        function toggleFields(value) {
            if (value === 'gcash') {
                gcashFields.classList.remove('hidden');
                creditFields.classList.add('hidden');
                codFields.classList.add('hidden');
                actionButtons.classList.remove('hidden');
            } else if (value === 'credit_card') {
                gcashFields.classList.add('hidden');
                codFields.classList.add('hidden');
                creditFields.classList.remove('hidden');
                actionButtons.classList.remove('hidden');
            } else if (value === 'cod') {
                codFields.classList.remove('hidden');
                gcashFields.classList.add('hidden');
                creditFields.classList.add('hidden');
                actionButtons.classList.remove('hidden');
            } else {
                gcashFields.classList.add('hidden');
                creditFields.classList.add('hidden');
                actionButtons.classList.add('hidden'); // Hide for COD
            }
        }

        radios.forEach(radio => {
            radio.addEventListener('change', function () {
                toggleFields(this.value);
            });
        });

        const selected = document.querySelector('input[name="payment_method"]:checked');
        if (selected) toggleFields(selected.value);
    });
</script>