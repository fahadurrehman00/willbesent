<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subscription Purchased</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

<div class="max-w-lg w-full bg-white shadow-lg rounded-xl overflow-hidden p-6">
    <!-- Content -->
    <div class="p-6 text-gray-700">
        <p class="text-lg font-medium">Hello Admin,</p>
        <p class="mt-4">
            We wanted to inform you that <span class="font-semibold"> {{ $user->firstname }}</span> has successfully purchased a subscription for <span class="font-semibold">Will Be Sent</span>.
        </p>
        <p class="mt-4">
            This subscription grants them access to premium features and ensures their documents are securely managed.
        </p>

        <!-- CTA Button -->
        <div class="text-center mt-6">
            <a href="{{ route('dashboard') }}" class="inline-block bg-blue-600 text-white px-6 py-3 rounded-lg text-lg font-medium shadow-md hover:bg-blue-700 transition">
                View Subscription Details
            </a>
        </div>

        <p class="mt-6">You can manage user subscriptions from the admin dashboard.</p>

        <!-- Signature -->
        <p class="mt-4 font-medium">Best Regards,</p>
        <p class="text-gray-600">Will Be Sent Team</p>
        <p class="text-gray-600">admin@willbesent.com</p>
    </div>

    <!-- Footer -->
    <div class="bg-gray-100 text-center text-sm text-gray-500 py-4 rounded-b-xl">
        &copy; {{ date('Y') }} Will Be Sent. All rights reserved.
    </div>
</div>

</body>
</html>
