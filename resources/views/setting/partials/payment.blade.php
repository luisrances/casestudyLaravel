<!--PAYMENT-->
<div id="payment" class="section hidden">
    <h2 class="text-2xl font-bold mb-2">PAYMENT DETAILS</h2>
    <p class="text-sm text-gray-600 mb-6">(This is for default payment)</p>

    <div class="flex flex-col md:flex-row gap-4 mb-6">
        <label class="flex items-center border px-4 py-2 rounded cursor-pointer w-full md:w-auto">
            <input type="radio" name="payment_method" value="gcash" class="mr-2" checked>
            <img src="https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.pngwing.com%2Fen%2Ffree-png-vcsaa&psig=AOvVaw0gDYXIlis2uoB9Tk62aRXU&ust=1747842210240000&source=images&cd=vfe&opi=89978449&ved=0CBEQjRxqFwoTCMCoueKxso0DFQAAAAAdAAAAABAE" alt="GCash" class="h-5 mr-2">
        </label>
        <label class="flex items-center border px-4 py-2 rounded cursor-pointer w-full md:w-auto">
            <input type="radio" name="payment_method" value="credit_card" class="mr-2">
            Credit Card
        </label>
        <label class="flex items-center border px-4 py-2 rounded cursor-pointer w-full md:w-auto">
            <input type="radio" name="payment_method" value="cod" class="mr-2">
            Cash on Delivery
        </label>
    </div>

    <div id="gcash-fields" class="grid md:grid-cols-2 gap-4 mb-4">
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

    <div id="credit-fields" class="grid md:grid-cols-2 gap-4 mb-4 hidden">
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

    <div class="flex justify-end gap-4 mt-6">
        <button class="text-blue-600 font-semibold hover:underline">Edit</button>
        <button class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Save</button>
    </div>
</div>