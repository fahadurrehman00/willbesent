<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Payment - WBS</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="{{ asset('images/WBS-Logo.png') }}" rel="shortcut icon" />
</head>

<body class="bg-gray-100">
    <!-- Header -->

    @include('components.user-header')

    <!-- Main Content -->
    <main class="container mx-auto my-8 px-6 grid md:grid-cols-2 gap-6">
        <!-- Illustration Section -->
        <section class="hidden md:flex items-center justify-center bg-white shadow-lg rounded-lg p-8">
            <img src="{{ asset('images/payment.jpg') }}" alt="Payment Illustration" class="w-3/4" />
        </section>

        <!-- Payment Section -->
        <section class="bg-white shadow-lg rounded-lg p-8">
            <h2 class="text-2xl font-semibold text-gray-700 mb-6">Payment Details</h2>

            <!-- Stripe Card Element -->
            <div id="card-element" class="p-4 border rounded-lg bg-gray-50"></div>
            <div id="card-errors" role="alert" class="text-red-500 text-sm mt-2"></div>

            <!-- Total Amount -->
            <div class="flex justify-between items-center bg-gray-50 p-4 rounded-lg shadow-sm border mt-4">
                <span class="text-gray-700 font-medium">Total Amount:</span>
                <span class="text-xl font-bold text-gray-800">
                    $<span id="totalAmount">{{ $request['totalAmount'] }}</span>
                </span>
            </div>

            <!-- Pay Button -->
            <button id="payNowButton"
                class="w-full bg-[#415a77] text-white py-3 rounded-lg hover:bg-[#f47d61] transition-all duration-300 mt-4">
                Pay Now
            </button>
        </section>
    </main>

    <!-- Footer -->
    @include('components.footer')

    <!-- Stripe JS -->
    <script src="//code.tidio.co/oohi4ck9zmzjoekpsft3cp6h9cnitwej.js" async></script>
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const stripe = Stripe("{{ env('STRIPE_KEY') }}");
            const payNowButton = document.getElementById('payNowButton');
            const billingCycle = "{{ $request['billingCycle'] }}";
            const totalAmount = "{{ $request['totalAmount'] }}";

            let elements;
            let paymentData; // Define paymentData at the top level for scope

            async function initializePayment() {
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                try {
                    // Disable button during initialization
                    payNowButton.disabled = true;
                    console.log('Billing Cycle:', billingCycle);

                    const response = await fetch(@json(route('paymentIntent')), {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                        },
                        body: JSON.stringify({
                            totalAmount,
                            billingCycle,
                        }),
                    });

                    if (!response.ok) {
                        throw new Error('Failed to initialize payment');
                    }

                    const data = await response.json();

                    // Create Elements instance
                    const appearance = {
                        theme: 'flat'
                    };
                    elements = stripe.elements({
                        appearance,
                        clientSecret: data.clientSecret,
                    });

                    // Create and mount the Payment Element
                    const paymentElement = elements.create('payment');
                    paymentElement.mount("#card-element");

                    // Re-enable button after initialization
                    payNowButton.disabled = false;

                    return {
                        clientSecret: data.clientSecret,
                        type: data.type,
                        subscriptionId: data.subscriptionId,
                    };
                } catch (error) {
                    console.error('Payment initialization error:', error);
                    document.getElementById('card-errors').textContent =
                        'Unable to initialize payment. Please try again.';
                    payNowButton.disabled = false;
                    throw error;
                }
            }

            // Initialize the payment when the page loads
            initializePayment().then(data => {
                paymentData = data; // Assign data to paymentData
            });

            // Handle payment submission
            payNowButton.addEventListener('click', async (e) => {
                e.preventDefault();

                // Prevent double submission
                payNowButton.disabled = true;
                payNowButton.textContent = 'Processing...';
                document.getElementById('card-errors').textContent = '';

                try {
                    if (!paymentData) {
                        paymentData = await initializePayment();
                    }

                    const paymentType = billingCycle;
                    const subscriptionId = paymentData.subscriptionId;
                    const subscription = @json($request['subscription'] ?? null);
                    const writerWill = @json($request['writerWill'] ?? null);
                    const lawyerWill = @json($request['lawyerWill'] ?? null);
                    const notarization = @json($request['notarization'] ?? null);


                    // Confirm the payment
                    const {
                        error
                    } = await stripe.confirmPayment({
                        elements,
                        confirmParams: {
                            payment_method_data: {
                                type: 'card',
                            },
                            return_url: `${window.location.origin}/payment/success?payment_type=${encodeURIComponent(paymentType)}&subscription_id=${encodeURIComponent(subscriptionId)}&subscriptions=${encodeURIComponent(subscription)}&totalAmount=${encodeURIComponent(totalAmount)}&writerWill=${encodeURIComponent(writerWill)}&lawyerWill=${encodeURIComponent(lawyerWill)}&notarization=${encodeURIComponent(notarization)}`,
                        },
                    });

                    if (error) {
                        throw error;
                    }

                    payNowButton.textContent = 'Payment Successful!';
                } catch (error) {
                    console.error('Payment error:', error);
                    document.getElementById('card-errors').textContent =
                        error.message || 'Payment failed. Please try again.';
                    payNowButton.disabled = false;
                    payNowButton.textContent = 'Pay Now';
                }
            });
        });
    </script>
</body>

</html>
