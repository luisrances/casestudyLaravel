
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