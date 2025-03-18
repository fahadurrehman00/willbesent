<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>You’re Now A Recipient On Will Be Sent</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
<p class="text-lg font-medium">Hey {{ $recipient->name }},</p>
<p class="mt-4">
We wanted to reach out and introduce ourselves! Here at Will Be Sent, we offer our customers with the tools needed to not only build a will but to have state of the art will storage and distribution. We use a number of processes to offer customers with the ability to have their wills, trusts, power of attorney, or any other documents needed. 
</p>
<p class="mt-4">
    Much like the trust that {{ $customer->firstname }} {{ $customer->lastname }} has placed in you to make sure their wishes are followed, they trust us to ensure that, when needed, we get the documents over to you. 
    {{ $customer->firstname }} has added you as a recipient to their documents on our platform.
    For now, there’s nothing you need to do, however, if you would like to create an account and make sure that your family’s documents are protected, you can sign up by <a href="https://willbesent.com" target="_blank">[clicking here]</a>.

</p>
<p class="mt-6">You can also use this discount to get 10% off the subscription price! 
</p>
<p><strong>Discount Code: WBSRECPT25</strong></p>
<p>
    If you have any questions, please let me know! I’m here to help you protect your family!
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
