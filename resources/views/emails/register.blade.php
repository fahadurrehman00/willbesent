<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Will Be Sent</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="max-w-lg w-full bg-white shadow-lg rounded-xl overflow-hidden p-6">
        <!-- Header -->
        <!-- <div class="bg-[#415a77] text-white text-center py-4 rounded-t-xl">
            <h1 class="text-2xl font-semibold">Welcome to Will Be Sent</h1>
        </div> -->

        <!-- Content -->
        <div class="p-6 text-gray-700">
            <p class="text-lg font-medium">Hey dear{{ $user->name }},</p>
            <p class="mt-4">
                On behalf of the team here, I’d like to be the first to welcome you to
                <span class="font-semibold">Will Be Sent</span>, the only way to produce and manage your will!
            </p>
            <p class="mt-4">
                If you haven’t already, the next step will be to log into your account and select a plan.
                You can do that by clicking the button below.
            </p>

            <!-- CTA Button -->
            <div class="text-center mt-6">
                <a href="{{ route('dashboard') }}" class="inline-block bg-blue-600 text-white px-6 py-3 rounded-lg text-lg font-medium shadow-md hover:bg-blue-700 transition">
                    Get Started
                </a>
            </div>

            <p class="mt-6">If you need anything or have any questions, our team is here to help!</p>

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
