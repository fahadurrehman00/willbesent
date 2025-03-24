<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset Link Sent</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="max-w-lg w-full bg-white shadow-lg rounded-xl overflow-hidden p-6">
        <!-- Header -->
        <!-- <div class="bg-[#415a77] text-white text-center py-4 rounded-t-xl">
            <h1 class="text-2xl font-semibold">Password Reset Link Sent</h1>
        </div> -->

        <!-- Content -->
        <div class="p-6 text-gray-700">
            <p class="text-lg font-medium">Hey  {{ $user->firstname }},</p>
            <p class="mt-4">
                We’ve received a request to reset your password for your account with 
                <span class="font-semibold">Will Be Sent</span>.
            </p>
            <p class="mt-4">
                To reset your password, click the button below and follow the instructions. The link will expire in 30 minutes.
            </p>

            <!-- CTA Button -->
            <div class="text-center mt-6">
                <a href="{{ $actionUrl }}" class="inline-block bg-blue-600 text-white px-6 py-3 rounded-lg text-lg font-medium shadow-md hover:bg-blue-700 transition">
                    Reset Your Password
                </a>
            </div>

            <p class="mt-6">
                If you did not request this change, you can simply ignore this email. Your password will not be changed.
            </p>

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
