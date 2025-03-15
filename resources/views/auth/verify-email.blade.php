<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification</title>
    <link rel="stylesheet" href="https://cdn.tailwindcss.com">
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white shadow-lg rounded-lg p-6 max-w-md w-full">
        <h1 class="text-2xl font-semibold text-gray-700 text-center mb-4">Verify Your Email Address</h1>
        <p class="text-sm text-gray-600 text-center mb-6">
            Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn’t receive the email, we will gladly send you another.
        </p>

        <!-- Session Status -->
        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 font-medium text-sm text-green-600 text-center">
                A new verification link has been sent to the email address you provided during registration.
            </div>
        @endif

        <div class="mt-4 flex items-center justify-between">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf

                <button
                    type="submit"
                    class="w-full bg-[#415a77] text-white font-medium py-2 px-4 rounded-lg hover:bg-[#f47d61] transition-all duration-300">
                    Resend Verification Email
                </button>
            </form>

            <form method="POST" action="{{ route('logout') }}" class="mt-4">
                @csrf
                <button
                    type="submit"
                    class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#415a77]">
                    Log Out
                </button>
            </form>
        </div>
    </div>
    <script src="//code.tidio.co/oohi4ck9zmzjoekpsft3cp6h9cnitwej.js" async></script>
</body>
</html>
