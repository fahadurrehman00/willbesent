<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>You’re Now Protected With Will Be Sent</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

<div class="max-w-lg w-full bg-white shadow-lg rounded-xl overflow-hidden p-6">
    <!-- Content -->
    <div class="p-6 text-gray-700">
        <p class="text-lg font-medium">Hey {{ $user->firstname }},</p>
        <p class="mt-4">
       Great news, you just started your subscription! This means you and your loved ones have peace of mind regarding your will. 
        </p>
        <p class="mt-4">
        Now that you’re all set, you’ll need to upload your will if you haven't already done so. 
        </p>
        <p class="mt-4">
        You’ll also start receiving a text at your selected interval to confirm your well-being from here on out. Please note that 
        if you aren’t able to verify this text by clicking the link, our support team will reach out to you or your points of contact to verify your health. 
        </p>

        <!-- CTA Button -->
        <div class="text-center mt-6">
            <a href="{{ route('dashboard') }}" class="inline-block bg-blue-600 text-white px-6 py-3 rounded-lg text-lg font-medium shadow-md hover:bg-blue-700 transition">
            Login to update your will!
            </a>
        </div>

             <p class="mt-4">
        Please note: If you have any questions or need to modify your subscription, you can do so by contacting our team! 
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