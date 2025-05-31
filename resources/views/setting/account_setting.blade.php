<x-layout>
    <a class="text-lg font-semibold px-4 mt-4 ml-[30px]" href="{{ route('account.setting') }}">Account Setting</a>
    <section class="flex justify-center flex-col md:flex-row max-w-7xl mx-auto py-4 gap-6">
        <!-- Sidebar -->
        <aside class="w-[250px] bg-white p-5 rounded-lg text-sm lg:min-h-[520px] [box-shadow:0_0_10px_rgba(0,0,0,0.2)]">
            <ul class="space-y-5 py-4 px-4 font-normal text-[17px]" id="sidebar">
                <li class="cursor-pointer text-blue-600" onclick="showSection('account')">Account Information</li>
                <li class="cursor-pointer" onclick="showSection('payment')">Payment Details</li>
                <li class="cursor-pointer" onclick="showSection('address')">Address Book</li>
                <li class="cursor-pointer" onclick="showSection('purchases')">My Purchases</li>
                <li class="cursor-pointer" onclick="showSection('terms')">Terms and Condition</li>
                <li class="text-red-600 mt-8 cursor-pointer" onclick="showSection('delete_account')">Delete Account</li>
            </ul>
        </aside>

        <main class="md:w-3/4 w-full bg-white p-6 rounded-lg lg:max-h-[520px] [box-shadow:0_0_10px_rgba(0,0,0,0.2)] overflow-y-auto">
            @include('setting.partials.account')
            @include('setting.partials.payment')
            @include('setting.partials.address')
            @include('setting.partials.purchases')
            @include('setting.partials.terms')
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