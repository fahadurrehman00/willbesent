<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Checkout - WBS</title>
    <link rel="stylesheet" href="../assets/css/style.css" />
    <link href="{{ asset('images/WBS-Logo.png') }}" rel="shortcut icon" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <!-- Header -->
    @include('components.user-header')

    <!-- Main Content -->
    <main class="container mx-auto my-8 px-6 grid md:grid-cols-2 gap-6">
        <!-- Subscription Section -->
        <section class="bg-white shadow-lg rounded-lg p-6">
            <h2 class="text-2xl font-semibold text-gray-700 mb-4">
                Customize Your Subscription
            </h2>
            <p class="text-gray-600 mb-6">
                Select the services you want and choose a billing cycle. Each option
                includes detailed features to meet your needs.
            </p>
            <form id="subscriptionSubmit" class="space-y-6" method="GET" action="{{ route('paymentPage') }}">
                <!-- Billing Cycle Selection -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-800">
                        Choose Billing Cycle
                    </h3>
                    <div class="flex gap-4 mt-3">
                        <label class="flex items-center gap-2">
                            <input type="radio" name="billingCycle" value="monthly" class="hidden peer" checked />
                            <div
                                class="flex items-center justify-center py-2 px-4 border-2 border-gray-300 rounded-lg cursor-pointer text-gray-700 font-medium peer-checked:border-[#415a77] peer-checked:bg-[#415a77] peer-checked:text-white transition-all duration-300">
                                Monthly
                            </div>
                        </label>
                        <label class="flex items-center gap-2">
                            <input type="radio" name="billingCycle" value="yearly" class="hidden peer" />
                            <div
                                class="flex items-center justify-center py-2 px-4 border-2 border-gray-300 rounded-lg cursor-pointer text-gray-700 font-medium peer-checked:border-[#415a77] peer-checked:bg-[#415a77] peer-checked:text-white transition-all duration-300">
                                Yearly
                            </div>
                        </label>
                    </div>
                </div>

                <!-- Subscription Options -->
                <div class="grid md:grid-cols-1 gap-6">
                    <label
                        class="flex items-start gap-4 border p-4 rounded-lg hover:shadow-lg transition cursor-pointer ">
                        <input id="fullWill" type="checkbox" name="subscription[]" value="fullWill,10,100"
                            class="hidden peer" />
                        <div
                            class="w-5 h-5 border-2 border-gray-300 rounded-lg peer-checked:bg-[#415a77] peer-checked:border-[#415a77] transition-all duration-300">
                        </div>
                        <div>
                            <h3 class="font-semibold">Full Will</h3>
                            <p class="text-sm text-gray-500">
                                Create 1 full will and add up to 2 recipients.
                            </p>
                            <span class="text-gray-700 font-medium">$10/month or $100/year</span>
                        </div>
                    </label>

                    <label
                        class="flex items-start gap-4 border p-4 rounded-lg hover:shadow-lg transition cursor-pointer ">
                        <input type="checkbox" name="subscription[]" value="poa,1,10" class="hidden peer" />
                        <div
                            class="w-5 h-5 border-2 border-gray-300 rounded-lg peer-checked:bg-[#415a77] peer-checked:border-[#415a77] transition-all duration-300">
                        </div>
                        <div>
                            <h3 class="font-semibold">Power of Attorney (POA)</h3>
                            <p class="text-sm text-gray-500">
                                Add a power of attorney document to your plan.
                            </p>
                            <span class="text-gray-700 font-medium">+$1/month or $10/year</span>
                        </div>
                    </label>

                    <label
                        class="flex items-start gap-4 border p-4 rounded-lg hover:shadow-lg transition cursor-pointer ">
                        <input type="checkbox" name="subscription[]" value="executor,1,10" class="hidden peer" />
                        <div
                            class="w-5 h-5 border-2 border-gray-300 rounded-lg peer-checked:bg-[#415a77] peer-checked:border-[#415a77] transition-all duration-300">
                        </div>
                        <div>
                            <h3 class="font-semibold">Executor of Will</h3>
                            <p class="text-sm text-gray-500">
                                Assign an executor to manage your will.
                            </p>
                            <span class="text-gray-700 font-medium">+$1/month or $10/year</span>
                        </div>
                    </label>
                </div>

                <!-- Coupon Code Section -->
                <div class="border p-4 rounded-lg">
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">
                        Have a Coupon?
                    </h3>
                    <div class="flex gap-2">
                        <input type="text" id="couponCode" name="couponCode" placeholder="Enter coupon code"
                            class="flex-grow p-2 border border-gray-300 rounded-lg" />
                        <button type="button" id="applyCoupon"
                            class="bg-[#415a77] text-white py-2 px-4 rounded-lg hover:bg-[#f47d61] transition-all duration-300">
                            Apply
                        </button>
                    </div>
                    <div id="couponMessage" class="mt-2 text-sm"></div>
                </div>

                <!-- Hidden Input for Total and Discount -->
                <input type="hidden" name="totalAmount" id="totalAmount" />
                <input type="hidden" name="discountAmount" id="discountAmount" value="0" />
                <input type="hidden" name="appliedCoupon" id="appliedCoupon" value="" />

                <!-- Total and Subscribe Button -->
                <div class="text-right">
                    <div id="discountInfo" class="hidden mb-2">
                        <p class="text-gray-700">Original Price: $<span id="originalPrice">0</span></p>
                        <p class="text-green-600">Discount: $<span id="discountValue">0</span></p>
                    </div>
                    <h3 class="text-xl font-semibold">
                        Total: $<span id="subscriptionTotal">0</span>
                    </h3>
                    <button type="submit"
                        class="mt-4 bg-[#415a77] text-white py-2 px-6 rounded-lg hover:bg-[#f47d61] transition-all duration-300 cursor-not-allowed">
                        Subscribe
                    </button>
                </div>
            </form>
        </section>

        <!-- One-Time Payments -->
        <section class="bg-white shadow-lg rounded-lg p-6 flex flex-col justify-between">
            <form method="GET" action="{{ route('paymentPage') }}">
                <h2 class="text-2xl font-semibold text-gray-700 mb-4">
                    One-Time Payments
                </h2>
                <!-- Notarization -->
                <label
                    class="flex items-start gap-4 border rounded-lg p-4 hover:shadow-lg transition cursor-pointer  mb-6">
                    <input type="checkbox" class="hidden peer payment-checkbox" value="25" name="notarization"
                        onchange="updateTotal()" />
                    <div
                        class="w-5 h-5 border-2 border-gray-300 rounded-lg peer-checked:bg-[#415a77] peer-checked:border-[#415a77] transition-all duration-300">
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold text-gray-800">Notarization</h3>
                        <p class="text-sm text-gray-600">
                            Ensure your documents are notarized for $25 per document.
                        </p>
                        <h4 class="text-lg font-semibold mt-2">$25</h4>
                    </div>
                </label>

                <!-- Document Writer Drafted Will -->
                <label
                    class="flex items-start gap-4 border rounded-lg p-4 hover:shadow-lg transition cursor-pointer  mb-6">
                    <input type="checkbox" class="hidden peer payment-checkbox" value="250" name="writerWill"
                        onchange="updateTotal()" />
                    <div
                        class="w-5 h-5 border-2 border-gray-300 rounded-lg peer-checked:bg-[#415a77] peer-checked:border-[#415a77] transition-all duration-300">
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold text-gray-800">
                            Document Writer Drafted Will
                        </h3>
                        <p class="text-sm text-gray-600">
                            Get a professionally drafted will by a document writer for $250.
                        </p>
                        <h4 class="text-lg font-semibold mt-2">$250</h4>
                    </div>
                </label>

                <!-- Lawyer Drafted Will -->
                <label
                    class="flex items-start gap-4 border rounded-lg p-4 hover:shadow-lg transition cursor-pointer  mb-6">
                    <input type="checkbox" class="hidden peer payment-checkbox" value="450" name="lawyerWill"
                        onchange="updateTotal()" />
                    <div
                        class="w-5 h-5 border-2 border-gray-300 rounded-lg peer-checked:bg-[#415a77] peer-checked:border-[#415a77] transition-all duration-300">
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold text-gray-800">
                            Lawyer Drafted Will
                        </h3>
                        <p class="text-sm text-gray-600">
                            Receive a will drafted by a professional lawyer for $450.
                        </p>
                        <h4 class="text-lg font-semibold mt-2">$450</h4>
                    </div>
                </label>

                <!-- Total and Buy Button -->
                <div class="text-right flex-end mt-4">
                    <h3 class="text-xl font-semibold">
                        Total: $<span id="oneTimeTotal">0</span>
                    </h3>
                    <button type="submit"
                        class="mt-4 bg-[#415a77] text-white py-2 px-6 rounded-lg hover:bg-[#f47d61] transition-all duration-300"
                        id="buyButton">
                        Buy: $0
                    </button>
                    <input type="hidden" name="totalAmount" id="totalAmount1" />
                    <input type="hidden" name="billingCycle" value="one_time" />
                </div>
            </form>
        </section>

    </main>

    <!-- Footer -->
    @include('components.footer')
    @include('components.toast')
        <script src="//code.tidio.co/oohi4ck9zmzjoekpsft3cp6h9cnitwej.js" async></script>
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <script>
            const billingCycleRadios = document.querySelectorAll('input[name="billingCycle"]');
            const subscriptionCheckboxes = document.querySelectorAll('input[name="subscription[]"]');
            const totalAmountInput = document.getElementById('totalAmount');
            const totalAmountDisplay = document.getElementById('subscriptionTotal');
            const originalPriceDisplay = document.getElementById('originalPrice');
            const discountValueDisplay = document.getElementById('discountValue');
            const discountInfo = document.getElementById('discountInfo');
            const discountAmountInput = document.getElementById('discountAmount');
            const appliedCouponInput = document.getElementById('appliedCoupon');
            const couponMessageElement = document.getElementById('couponMessage');

            let originalTotal = 0;
            let discountPercentage = 0;
            let couponApplied = false;

            function calculateTotal() {
                let total = 0;
                const billingCycle = document.querySelector('input[name="billingCycle"]:checked').value;

                subscriptionCheckboxes.forEach((checkbox) => {
                    if (checkbox.checked) {
                        const [name, monthlyPrice, yearlyPrice] = checkbox.value.split(',');
                        total += billingCycle === 'monthly' ? parseFloat(monthlyPrice) : parseFloat(yearlyPrice);
                    }
                });

                originalTotal = total;
                originalPriceDisplay.textContent = total.toFixed(2);

                // Apply discount if coupon is valid
                if (couponApplied && discountPercentage > 0) {
                    const discountAmount = (total * discountPercentage) / 100;
                    total -= discountAmount;
                    discountValueDisplay.textContent = discountAmount.toFixed(2);
                    discountAmountInput.value = discountAmount.toFixed(2);
                    discountInfo.classList.remove('hidden');
                } else {
                    discountInfo.classList.add('hidden');
                    discountAmountInput.value = '0';
                }

                totalAmountInput.value = total.toFixed(2);
                totalAmountDisplay.textContent = total.toFixed(2);
            }

            // Event listeners for subscription options
            billingCycleRadios.forEach((radio) => radio.addEventListener('change', calculateTotal));
            subscriptionCheckboxes.forEach((checkbox) => checkbox.addEventListener('change', calculateTotal));

            // Apply coupon button click handler
            document.getElementById('applyCoupon').addEventListener('click', function() {
                const couponCode = document.getElementById('couponCode').value.trim();
                
                if (!couponCode) {
                    showCouponMessage('showCouponMessage('Please enter a coupon code', 'text-red-500');
                    return;
                }

                // Reset coupon state
                couponApplied = false;
                discountPercentage = 0;
                
                // Call API to validate coupon
                fetch(`/api/validate-coupon/${couponCode}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.valid) {
                            couponApplied = true;
                            discountPercentage = data.discount_percentage;
                            appliedCouponInput.value = couponCode;
                            showCouponMessage(`Coupon applied! ${discountPercentage}% discount`, 'text-green-600');
                            calculateTotal();
                        } else {
                            showCouponMessage('Invalid coupon code', 'text-red-500');
                            discountInfo.classList.add('hidden');
                            calculateTotal();
                        }
                    })
                    .catch(error => {
                        console.error('Error validating coupon:', error);
                        showCouponMessage('Error validating coupon', 'text-red-500');
                    });
            });

            function showCouponMessage(message, className) {
                couponMessageElement.textContent = message;
                couponMessageElement.className = 'mt-2 text-sm ' + className;
            }

            $(document).ready(function() {
                function checkCheckboxes() {
                    let isChecked = $('input[type="checkbox"]:checked').length > 0;
                    let $button = $('#subscriptionSubmit button');

                    if (isChecked) {
                        $button.prop('disabled', false).removeClass('cursor-not-allowed').addClass('cursor-pointer');
                    } else {
                        $button.prop('disabled', true).removeClass('cursor-pointer').addClass('cursor-not-allowed');
                    }
                }

                // Run check on page load
                checkCheckboxes();

                // Run check whenever any checkbox is clicked
                $('input[type="checkbox"]').on('change', checkCheckboxes);

                $('#subscriptionSubmit').submit(function(event) {
                    let $button = $('#subscriptionSubmit button');

                    if ($button.prop('disabled')) {
                        event.preventDefault(); // Stop submission
                    }

                    if (!$('#fullWill').prop('checked')) {
                        alert('Please check the Full Will option before proceeding.');
                        event.preventDefault(); // Prevent form submission
                    }
                });
            });

            // Initial calculation
            calculateTotal();

            function updateTotal() {
                // Get all checkboxes
                const checkboxes = document.querySelectorAll('.payment-checkbox');
                let total = 0;

                // Calculate total
                checkboxes.forEach((checkbox) => {
                    if (checkbox.checked && !isNaN(checkbox.value) && checkbox.value.trim() !== '') {
                        total += parseFloat(checkbox.value);
                    }
                });

                // Update total in the DOM
                document.getElementById("oneTimeTotal").innerText = total.toFixed(2);
                document.getElementById("buyButton").innerText = `Buy for $${total.toFixed(2)}`;
                document.getElementById("totalAmount1").value = total.toFixed(2);
            }
        </script>
    </body>
    </html>