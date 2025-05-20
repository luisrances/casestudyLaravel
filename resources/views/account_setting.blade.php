<x-layout>
    <a href="{{ route('account.setting') }}">Account Setting</a>
    <section class="flex flex-col md:flex-row max-w-7xl mx-auto p-6 gap-6">
        <!-- Sidebar -->
        <aside class="w-50 bg-white p-5 rounded shadow text-sm">
            <ul class="space-y-4 font-semibold" id="sidebar">
                <li class="cursor-pointer text-blue-600" onclick="showSection('account')">ACCOUNT INFORMATION</li>
                <li class="cursor-pointer" onclick="showSection('payment')">PAYMENT DETAILS</li>
                <li class="cursor-pointer" onclick="showSection('address')">ADDRESS BOOK</li>
                <li class="cursor-pointer" onclick="showSection('terms')">TERMS AND CONDITION</li>
                <li class="cursor-pointer" onclick="showSection('purchases')">MY PURCHASES</li>
                <li class="text-red-600 mt-8 cursor-pointer" onclick="showSection('logout')">LOG OUT</li>
            </ul>
        </aside>

        <main class="md:w-3/4 w-full bg-white p-6 rounded shadow">
            <!--ACCOUNT-->
            <div id="account" class="section">
                <div class="flex justify-between mb-6">
                    <h2 class="text-2xl font-bold">PERSONAL INFO</h2>
                    <div class="flex gap-4">
                        <button class="text-blue-600 font-medium hover:underline">Edit</button>
                        <button class="text-green-600 font-medium hover:underline">Save</button>
                    </div>
                </div>

                <div class="flex items-center space-x-4 mb-6">
                    <div class="w-20 h-20 bg-gray-300 rounded-full flex items-center justify-center">
                        <span class="text-gray-600 text-xl">👤</span>
                    </div>
                    <div>
                        <a href="#" class="text-blue-600 text-sm block hover:underline">Upload new photo</a>
                        <a href="#" class="text-red-500 text-sm block hover:underline">Remove photo</a>
                    </div>
                </div>

                <form>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                        <div>
                            <label class="block text-sm font-semibold mb-1">Full Name</label>
                            <input type="text" class="w-full border border-gray-300 px-4 py-2 rounded" placeholder="Full Name">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold mb-1">Birthday</label>
                            <input type="date" class="w-full border border-gray-300 px-4 py-2 rounded">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold mb-1">E-mail</label>
                            <input type="email" class="w-full border border-gray-300 px-4 py-2 rounded" placeholder="E-mail">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold mb-1">Height</label>
                            <div class="flex items-center gap-3">
                                <input type="number" class="w-20 border border-gray-300 px-2 py-2 rounded" placeholder="##">
                                <label class="text-sm"><input type="radio" name="unit" class="mr-1" checked> ft.</label>
                                <label class="text-sm"><input type="radio" name="unit" class="mr-1"> in.</label>
                            </div>
                        </div>
                    </div>

                    <h3 class="text-lg font-bold mb-4">ACCOUNT INFO</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-semibold mb-1">Username</label>
                            <input type="text" class="w-full border border-gray-300 px-4 py-2 rounded" placeholder="Username">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold mb-1">Password</label>
                            <input type="password" class="w-full border border-gray-300 px-4 py-2 rounded" value="********">
                        </div>
                    </div>
                </form>
            </div>

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

            <!--ADDRESS-->
            <div id="address" class="section hidden">
                <h2 class="text-2xl font-bold mb-4">ADDRESS BOOK</h2>

                <!-- View Address -->
                <div id="address-view">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold">MY ADDRESS</h3>
                        <button onclick="showAddForm()" class="border border-gray-400 px-4 py-1 rounded">+ Add address</button>
                    </div>

                    <div id="address-container" class="space-y-4">
                        <!-- Dynamic addresses will be injected here -->
                    </div>
                </div>

                <!-- Add/Edit Address Form -->
                <div id="address-form" class="hidden mt-4">
                    <h3 id="form-title" class="text-lg font-semibold mb-4">ADD NEW ADDRESS</h3>
                    <form class="space-y-4" onsubmit="saveAddress(event)">
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
                    </form>
                </div>
            </div>

            <!--TERMS-->
            <div id="terms" class="section hidden">
                <h2 class="text-2xl font-bold mb-4">TERMS AND CONDITIONS</h2>
                <div class="space-y-4 text-justify text-sm leading-relaxed">
                    <p>Welcome to <strong>GoPedalPh</strong> – your trusted partner in cycling essentials and gear.</p>

                    <p>By using our website, you agree to comply with and be bound by the following Terms and Conditions. Please read them carefully. If you do not agree, we kindly ask that you refrain from using our site or services.</p>

                    <h3 class="font-semibold mt-6 text-base">1. General</h3>
                    <ul class="list-disc ml-6">
                        <li>You must be 18 years or older to use this site, or have the consent of a parent or guardian.</li>
                        <li>We reserve the right to update these terms at any time. Changes will be published on this page with immediate effect.</li>
                    </ul>

                    <h3 class="font-semibold mt-6 text-base">2. Products & Pricing</h3>
                    <ul class="list-disc ml-6">
                        <li>We make every effort to ensure product descriptions and prices are accurate and up to date.</li>
                        <li>Prices are displayed in PHP and are subject to change without prior notice.</li>
                        <li>All items offered are subject to stock availability.</li>
                    </ul>

                    <h3 class="font-semibold mt-6 text-base">3. Orders & Payment</h3>
                    <ul class="list-disc ml-6">
                        <li>By placing an order, you confirm that all information provided is true and complete.</li>
                        <li>Orders will only be processed upon full payment confirmation.</li>
                        <li>We accept various payment methods including Credit/Debit Cards, PayPal, GCash, and more.</li>
                    </ul>

                    <h3 class="font-semibold mt-6 text-base">4. Shipping & Delivery</h3>
                    <ul class="list-disc ml-6">
                        <li>All orders are processed within 1–3 business days, excluding weekends and holidays.</li>
                        <li>Delivery time may vary based on your location and courier efficiency.</li>
                        <li>We are not liable for delays caused by third-party shipping providers.</li>
                    </ul>

                    <h3 class="font-semibold mt-6 text-base">5. Returns & Refunds</h3>
                    <ul class="list-disc ml-6">
                        <li>If you are not completely satisfied, you may return your item within 7–14 days, as long as it is unused and in its original condition.</li>
                        <li>Once the return is approved, a refund will be processed to your original payment method.</li>
                        <li>Note: Customized bikes and special orders are non-returnable unless defective.</li>
                    </ul>

                    <h3 class="font-semibold mt-6 text-base">6. Warranty Coverage</h3>
                    <ul class="list-disc ml-6">
                        <li>Most bicycles come with a manufacturer’s warranty of 6 to 12 months.</li>
                        <li>This warranty covers manufacturing defects only and excludes normal wear, misuse, or damage caused by accidents.</li>
                    </ul>

                    <h3 class="font-semibold mt-6 text-base">7. Limitation of Liability</h3>
                    <p>GoPedalPh is not responsible for any indirect, incidental, or consequential damages arising from the use of our website or products.</p>

                    <h3 class="font-semibold mt-6 text-base">8. Need Help?</h3>
                    <p>For inquiries, feedback, or support, feel free to contact our customer service team:</p>
                    <ul class="ml-6">
                        <li>📧 Email: <a href="mailto:support@gopedalph.com" class="text-blue-600 underline">support@gopedalph.com</a></li>
                        <li>📞 Phone: +63 912 345 6789</li>
                    </ul>

                    <p class="mt-6 font-semibold text-center">Thank you for choosing GoPedalPh — Ride Smart. Ride Strong.</p>
                </div>
            </div>

            <!-- PURCHASES -->
            <div id="purchases" class="section hidden">
                <h2 class="text-2xl font-bold mb-4">MY PURCHASES</h2>

                <!-- Tabs -->
                <div class="flex border-b mb-4 space-x-4 text-sm font-semibold">
                    <button class="purchase-tab text-blue-600 border-b-2 border-blue-600 py-2" data-tab="to-pay">TO PAY</button>
                    <button class="purchase-tab text-gray-600 py-2" data-tab="to-ship">TO SHIP</button>
                    <button class="purchase-tab text-gray-600 py-2" data-tab="to-receive">TO RECEIVE</button>
                    <button class="purchase-tab text-gray-600 py-2" data-tab="completed">COMPLETED</button>
                    <button class="purchase-tab text-gray-600 py-2" data-tab="return-refund">RETURN/REFUND</button>
                    <button class="purchase-tab text-gray-600 py-2" data-tab="canceled">CANCELED</button>
                </div>

                <!-- Tab Content Wrapper -->
                <div id="purchase-contents" class="space-y-6">

                    <!-- TO PAY -->
                    <div class="purchase-pane" data-content="to-pay">
                        <!-- Example Items -->
                        <div class="flex items-start justify-between border rounded p-4 bg-white shadow-sm mb-2">
                            <div class="flex items-start gap-4">
                                <img src="https://i.imgur.com/UXX45qK.jpg" class="w-20 h-20 object-cover rounded">
                                <div>
                                    <h3 class="font-semibold text-lg">MICHELIN TIRES</h3>
                                    <p class="text-sm text-gray-500">Power Gravel 700x40c</p>
                                    <p class="text-sm">Qty: <strong>2</strong></p>
                                    <p class="font-bold text-lg mt-1">₱6,999.98</p>
                                </div>
                            </div>
                            <div>
                                <button class="border border-blue-600 text-blue-600 px-4 py-1 rounded hover:bg-blue-50">Cancel Order</button>
                            </div>
                        </div>

                        <div class="flex items-start justify-between border rounded p-4 bg-white shadow-sm mb-2">
                            <div class="flex items-start gap-4">
                                <img src="https://i.imgur.com/UXX45qK.jpg" class="w-20 h-20 object-cover rounded">
                                <div>
                                    <h3 class="font-semibold text-lg">MAXXIS DETONATOR</h3>
                                    <p class="text-sm text-gray-500">700x28c</p>
                                    <p class="text-sm">Qty: <strong>1</strong></p>
                                    <p class="font-bold text-lg mt-1">₱1,499.00</p>
                                </div>
                            </div>
                            <div>
                                <button class="border border-blue-600 text-blue-600 px-4 py-1 rounded hover:bg-blue-50">Cancel Order</button>
                            </div>
                        </div>
                    </div>

                    <!-- TO SHIP -->
                    <div class="purchase-pane hidden" data-content="to-ship">
                        <div class="flex items-start justify-between border rounded p-4 bg-white shadow-sm mb-2">
                            <div class="flex items-start gap-4">
                                <img src="https://i.imgur.com/UXX45qK.jpg" class="w-20 h-20 object-cover rounded">
                                <div>
                                    <h3 class="font-semibold text-lg">SCHWALBE TIRES</h3>
                                    <p class="text-sm text-gray-500">Marathon Plus Tour 700x38c</p>
                                    <p class="text-sm">Qty: <strong>1</strong></p>
                                    <p class="font-bold text-lg mt-1">₱2,899.00</p>
                                </div>
                            </div>
                            <div>
                                <button class="border border-gray-400 text-gray-600 px-4 py-1 rounded cursor-not-allowed">Waiting for Shipment</button>
                            </div>
                        </div>
                    </div>

                    <!-- TO RECEIVE -->
                    <div class="purchase-pane hidden" data-content="to-receive">
                        <div class="flex items-start justify-between border rounded p-4 bg-white shadow-sm mb-2">
                            <div class="flex items-start gap-4">
                                <img src="https://i.imgur.com/UXX45qK.jpg" class="w-20 h-20 object-cover rounded">
                                <div>
                                    <h3 class="font-semibold text-lg">MICHELIN TIRES</h3>
                                    <p class="text-sm text-gray-500">Power Gravel 800x40c</p>
                                    <p class="text-sm">Qty: <strong>1</strong></p>
                                    <p class="font-bold text-lg mt-1">₱3,499.99</p>
                                </div>
                            </div>
                            <div>
                                <button class="border border-blue-600 text-blue-600 px-4 py-1 rounded hover:bg-blue-50">Confirm Receipt</button>
                            </div>
                        </div>
                    </div>

                    <!-- COMPLETED -->
                    <div class="purchase-pane hidden" data-content="completed">
                        <div class="flex items-start justify-between border rounded p-4 bg-white shadow-sm mb-2">
                            <div class="flex items-start gap-4">
                                <img src="https://i.imgur.com/UXX45qK.jpg" class="w-20 h-20 object-cover rounded">
                                <div>
                                    <h3 class="font-semibold text-lg">CONTINENTAL TIRE</h3>
                                    <p class="text-sm text-gray-500">Terra Speed 650b x 40</p>
                                    <p class="text-sm">Qty: <strong>2</strong></p>
                                    <p class="font-bold text-lg mt-1">₱4,599.00</p>
                                </div>
                            </div>
                            <div>
                                <button class="bg-green-100 text-green-700 px-4 py-1 rounded">Order Completed</button>
                            </div>
                        </div>
                    </div>

                    <!-- RETURN/REFUND -->
                    <div class="purchase-pane hidden" data-content="return-refund">
                        <div class="flex items-start justify-between border rounded p-4 bg-white shadow-sm mb-2">
                            <div class="flex items-start gap-4">
                                <img src="https://i.imgur.com/UXX45qK.jpg" class="w-20 h-20 object-cover rounded">
                                <div>
                                    <h3 class="font-semibold text-lg">KENDA TIRE</h3>
                                    <p class="text-sm text-gray-500">All-Terrain 700x32c</p>
                                    <p class="text-sm">Qty: <strong>1</strong></p>
                                    <p class="font-bold text-lg mt-1">₱1,299.00</p>
                                </div>
                            </div>
                            <div>
                                <button class="bg-yellow-100 text-yellow-700 px-4 py-1 rounded">Pending Refund</button>
                            </div>
                        </div>
                    </div>

                    <!-- CANCELED -->
                    <div class="purchase-pane hidden" data-content="canceled">
                        <div class="flex items-start justify-between border rounded p-4 bg-white shadow-sm mb-2">
                            <div class="flex items-start gap-4">
                                <img src="https://i.imgur.com/UXX45qK.jpg" class="w-20 h-20 object-cover rounded">
                                <div>
                                    <h3 class="font-semibold text-lg">MAXXIS TIRE</h3>
                                    <p class="text-sm text-gray-500">Re-Fuse 700x25c</p>
                                    <p class="text-sm">Qty: <strong>1</strong></p>
                                    <p class="font-bold text-lg mt-1">₱1,899.00</p>
                                </div>
                            </div>
                            <div>
                                <button class="bg-red-100 text-red-700 px-4 py-1 rounded">Order Canceled</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!--LOGOUT-->
            <div id="logout" class="section hidden">
                <h2 class="text-2xl font-bold mb-4">LOG OUT</h2>
                <p>Are you sure you want to log out?</p>
                <div class="mt-4 space-x-2">
                    <button class="bg-red-500 text-black px-4 py-2 rounded">Yes</button>
                    <button class="bg-gray-300 px-4 py-2 rounded">No</button>
                </div>
            </div>
        </main>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // SECTION TOGGLE (Sidebar navigation)
            window.showSection = function (id) {
                document.querySelectorAll('.section').forEach(section => section.classList.add('hidden'));
                document.getElementById(id).classList.remove('hidden');

                document.querySelectorAll('#sidebar li').forEach(item => item.classList.remove('text-blue-600'));
                event.target.classList.add('text-blue-600');
            };

            // PAYMENT METHOD FIELD TOGGLING
            const gcashFields = document.getElementById('gcash-fields');
            const creditFields = document.getElementById('credit-fields');
            const radios = document.querySelectorAll('input[name="payment_method"]');
            const actionButtons = document.querySelector('#payment .flex.justify-end');

            function toggleFields(value) {
                if (value === 'gcash') {
                    gcashFields.classList.remove('hidden');
                    creditFields.classList.add('hidden');
                    actionButtons.classList.remove('hidden');
                } else if (value === 'credit_card') {
                    gcashFields.classList.add('hidden');
                    creditFields.classList.remove('hidden');
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


            // ADDRESS BOOK SECTION
            let addresses = [
                {
                    id: 1,
                    name: "Mariel Perin",
                    phone: "091234567890",
                    region: "Kapasigan/Pasig City/ Metro Manila",
                    street: "Blk 1 lot 2 Pamantasan street, PLP",
                    category: "Home",
                    default: true
                }
            ];

            let editingId = null;

            function renderAddresses() {
                const container = document.getElementById('address-container');
                container.innerHTML = '';

                addresses.forEach(address => {
                    const div = document.createElement('div');
                    div.className = "border p-4 rounded relative";
                    div.innerHTML = `
                        <div class="flex justify-between items-start">
                            <div class="flex items-start space-x-4">
                                <img src="https://cdn-icons-png.flaticon.com/512/684/684908.png" class="w-6 h-6 mt-1" alt="Location Icon" />
                                <div>
                                    <p><strong>${address.name}</strong> ${address.phone}</p>
                                    <p>${address.street}, ${address.region}</p>
                                    <div class="mt-2 space-x-2">
                                        <span class="border px-2 py-1 text-xs">${address.category}</span>
                                        ${address.default ? '<span class="border px-2 py-1 text-xs">Default Address</span>' : ''}
                                    </div>
                                </div>
                            </div>
                            <div>
                                <button class="text-blue-600 hover:underline text-sm" onclick="editAddress(${address.id})">Edit</button>
                            </div>
                        </div>
                    `;
                    container.appendChild(div);
                });
            }

            window.showAddForm = function () {
                document.getElementById('form-title').innerText = 'ADD NEW ADDRESS';
                document.getElementById('address-view').classList.add('hidden');
                document.getElementById('address-form').classList.remove('hidden');
                editingId = null;
                document.querySelector('#address-form form').reset();
            };

            window.editAddress = function (id) {
                const address = addresses.find(a => a.id === id);
                if (!address) return;

                editingId = id;
                document.getElementById('form-title').innerText = 'EDIT MY ADDRESS';
                document.getElementById('address-view').classList.add('hidden');
                document.getElementById('address-form').classList.remove('hidden');

                document.getElementById('recipient-name').value = address.name;
                document.getElementById('phone-number').value = address.phone;
                document.getElementById('region').value = address.region;
                document.getElementById('street').value = address.street;
                document.querySelector(`input[name="category"][value="${address.category}"]`).checked = true;
            };

            window.cancelAddEdit = function () {
                document.getElementById('address-form').classList.add('hidden');
                document.getElementById('address-view').classList.remove('hidden');
            };

            window.saveAddress = function (e) {
                e.preventDefault();

                const name = document.getElementById('recipient-name').value;
                const phone = document.getElementById('phone-number').value;
                const region = document.getElementById('region').value;
                const street = document.getElementById('street').value;
                const category = document.querySelector('input[name="category"]:checked').value;

                if (editingId) {
                    const idx = addresses.findIndex(a => a.id === editingId);
                    addresses[idx] = { ...addresses[idx], name, phone, region, street, category };
                } else {
                    addresses.push({
                        id: Date.now(),
                        name,
                        phone,
                        region,
                        street,
                        category,
                        default: addresses.length === 0
                    });
                }

                cancelAddEdit();
                renderAddresses();
            };

            // Initial load
            renderAddresses();
        });

        // PURCHASE TABS
        document.addEventListener("DOMContentLoaded", function () {
            const tabs = document.querySelectorAll(".purchase-tab");
            const panes = document.querySelectorAll(".purchase-pane");

            tabs.forEach(tab => {
                tab.addEventListener("click", () => {
                    const target = tab.getAttribute("data-tab");

                    // Update tab styles
                    tabs.forEach(t => {
                        t.classList.remove("text-blue-600", "border-b-2", "border-blue-600");
                        t.classList.add("text-gray-600");
                    });
                    tab.classList.remove("text-gray-600");
                    tab.classList.add("text-blue-600", "border-b-2", "border-blue-600");

                    // Show corresponding pane
                    panes.forEach(pane => {
                        if (pane.getAttribute("data-content") === target) {
                            pane.classList.remove("hidden");
                        } else {
                            pane.classList.add("hidden");
                        }
                    });
                });
            });
        });

    </script>

</x-layout>