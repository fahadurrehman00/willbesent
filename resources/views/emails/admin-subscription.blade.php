<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WBS New Customer Subscription</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

<div class="max-w-lg w-full bg-white shadow-lg rounded-xl overflow-hidden p-6">
    <!-- Content -->
    <div class="p-6 text-gray-700">
        <p class="text-lg font-medium">Hey team,</p>
        <p class="mt-4">
            We wanted to inform you that <span class="font-semibold"> {{ $user->firstname }}</span> has successfully purchased a subscription for <span class="font-semibold">Will Be Sent</span>.
        </p>
       
       <div class="mt-4 p-4 border rounded-lg bg-gray-50">
                <p><strong>Name:</strong> {{ $user->firstname }} {{ $user->lastname }}</p>
                <p><strong>Phone:</strong> {{ $user->phone }}</p>
                <p><strong>Email:</strong> {{ $user->email }}</p>
                <p><strong>Full Address:</strong> {{ $user->street }}, {{ $user->city }}, {{ $user->state }}, {{ $user->zip }}</p>
                <p><strong>State:</strong> {{ $user->state }}</p>
            </div>
       
        <!-- CTA Button -->
        <div class="text-center mt-6">
            <a href="{{ route('dashboard') }}" class="inline-block bg-blue-600 text-white px-6 py-3 rounded-lg text-lg font-medium shadow-md hover:bg-blue-700 transition">
                View Subscription Details
            </a>
        </div>

            <!-- Signature -->
            <p class="mt-4 font-medium">Cheers,</p>
            <p class="text-gray-600">Elizabeth H.</p>
            <p class="text-gray-600">Head of Customer Onboarding</p>
            <p class="text-gray-600">help@willbesent.com</p>
    </div>

    <!-- Footer -->
    <div class="bg-gray-100 text-center text-sm text-gray-500 py-4 rounded-b-xl">
        &copy; {{ date('Y') }} Will Be Sent. All rights reserved.
    </div>
</div>

</body>
</html>
