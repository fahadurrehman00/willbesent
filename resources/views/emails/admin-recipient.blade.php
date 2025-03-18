<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>You’re Now A Recipient On Will Be Sent</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
<p class="text-lg font-medium">Hey team,</p>
<p class="mt-4">
We just had the following recipient added. Please check the information below and let’s get started!  
</p>
<!-- Display recipient details -->
<ul class="mt-2">
    <li><strong>Name:</strong> {{ $recipient->name }}</li>
    <li><strong>Email:</strong> {{ $recipient->email }}</li>
    <li><strong>Phone:</strong> {{ $recipient->mobile }}</li>
</ul>

<p class="mt-6">Use this discount code to get 10% off the subscription price:</p>
<p><strong>Discount Code: WBSRECPT25</strong></p>
<p>
Please make sure the recipient is added to the tracker.
</p>
<p class="mt-6 font-medium">Cheers,</p>
<p class="text-gray-600">Elizabeth H.</p>
<p class="text-gray-600">Head of Customer Onboarding</p>
<p class="text-gray-600">help@willbesent.com</p>

<!-- Footer -->
<div class="bg-gray-100 text-center text-sm text-gray-500 py-4 rounded-b-xl">
    &copy; {{ date('Y') }} Will Be Sent. All rights reserved.
</div>

</body>
</html>
