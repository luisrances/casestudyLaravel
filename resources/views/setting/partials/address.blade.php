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