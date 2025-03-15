<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm Password</title>
    <link rel="stylesheet" href="https://cdn.tailwindcss.com">
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white shadow-lg rounded-lg p-6 max-w-md w-full">
        <h1 class="text-2xl font-semibold text-gray-700 text-center mb-4">Confirm Your Password</h1>
        <p class="text-sm text-gray-600 text-center mb-6">
            This is a secure area of the application. Please confirm your password before continuing.
        </p>

        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf

            <!-- Password -->
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input
                    id="password"
                    type="password"
                    name="password"
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-[#415a77] focus:border-[#415a77]"
                    required
                    autocomplete="current-password"
                />
                @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-6">
                <button
                    type="submit"
                    class="w-full bg-[#415a77] text-white font-medium py-2 px-4 rounded-lg hover:bg-[#f47d61] transition-all duration-300">
                    Confirm
                </button>
            </div>
        </form>
    </div>
    <script src="//code.tidio.co/oohi4ck9zmzjoekpsft3cp6h9cnitwej.js" async></script>
</body>
</html>
