<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WBS Recipient Added”</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

<div class="max-w-lg w-full bg-white shadow-lg rounded-xl overflow-hidden p-6">
    <!-- Content -->
    <div class="p-6 text-gray-700">
        <p class="text-lg font-medium">Hey team,</p>
        <p class="mt-4">
        We just had the following recipient added. Please check the information below and let’s get started! 
        </p>
        <p class="mt-4">
            This means {{ $user->name  }} has been designated to receive important information and documents in the future.
        </p>

        <p class="mt-6">Name: (FIRST LAST) </p>
        <p class="mt-6">Email: (Email) </p>
        <p class="mt-6">Phone: (Phone) </p>
        <p class="mt-6">Address: (Address) </p>

            <!-- Signature -->
            <p class="mt-6 font-medium">Cheers,</p>
            <p class="text-gray-600">Elizabeth H.</p>
            <p class="text-gray-600">Head of Customer Onboarding</p>
            <p class="text-gray-600">help@willbesent.com</p>
        </div>
    </div>

    <!-- Footer -->
    <div class="bg-gray-100 text-center text-sm text-gray-500 py-4 rounded-b-xl">
        &copy; {{ date('Y') }} Will Be Sent. All rights reserved.
    </div>
</div>

</body>
</html>
