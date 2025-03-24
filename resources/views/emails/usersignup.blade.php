<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WBS New Customer Sign Up</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="max-w-lg w-full bg-white shadow-lg rounded-xl overflow-hidden p-6">
        <!-- Header -->
        <div class="bg-[#415a77] text-white text-center py-4 rounded-t-xl">
            <h1 class="text-2xl font-semibold">WBS New Customer Sign Up</h1>
        </div>

        <!-- Content -->
        <div class="p-6 text-gray-700">
            <p class="text-lg font-medium">Hey team,</p>
            <p class="mt-4">
                We just got a new sign-up for WBS. Please make sure that the account gets added to the tracker.
            </p>

            <!-- User Details -->
            <div class="mt-4 p-4 border rounded-lg bg-gray-50">
                <p><strong>Name:</strong> {{ $user->firstname }} {{ $user->lastname }}</p>
                <p><strong>Phone:</strong> {{ $user->phone }}</p>
                <p><strong>Email:</strong> {{ $user->email }}</p>
                <p><strong>Full Address:</strong> {{ $user->street }}, {{ $user->city }}, {{ $user->state }}, {{ $user->zip }}</p>
                <p><strong>State:</strong> {{ $user->state }}</p>
            </div>

            <!-- Signature -->
            <p class="mt-6 font-medium">Cheers,</p>
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
