<x-layout>
    <a class="text-lg font-semibold px-4 mt-4 ml-[30px]" href="{{ route('account.setting') }}">Account Setting</a>
    <section class="flex justify-center flex-col md:flex-row max-w-7xl mx-auto py-4 gap-6">
        <!-- Sidebar -->
        <aside class="w-[250px] bg-white p-5 rounded-lg text-sm lg:min-h-[520px] [box-shadow:0_0_10px_rgba(0,0,0,0.2)]">
            <ul class="space-y-5 py-4 px-4 font-normal text-[17px]" id="sidebar">
                <li class="cursor-pointer text-blue-600" onclick="showSection('account')">Account Information</li>
                <li class="cursor-pointer" onclick="showSection('payment')">Payment Details</li>
                <li class="cursor-pointer" onclick="showSection('address')">Address Book</li>
                <li class="cursor-pointer" onclick="showSection('terms')">Terms and Condition</li>
                <li class="cursor-pointer" onclick="showSection('purchases')">My Purchases</li>
                <li class="text-red-600 mt-8 cursor-pointer" onclick="showSection('delete_account')">Delete Account</li>
            </ul>
        </aside>

        <main class="md:w-3/4 w-full bg-white p-6 rounded-lg lg:max-h-[520px] [box-shadow:0_0_10px_rgba(0,0,0,0.2)] overflow-y-auto">
            @include('setting.partials.account')
            @include('setting.partials.payment')
            @include('setting.partials.address')
            @include('setting.partials.terms')
            @include('setting.partials.purchases')
            @include('setting.partials.delete_account')
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