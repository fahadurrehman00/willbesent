<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>WBS | Forgot Password</title>
    <link href="{{ asset('images/WBS-Logo.png') }}" rel="shortcut icon" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
    <script src="https://cdn.tailwindcss.com"></script>
  </head>
  <body>
    <main class="bg-gray-100 min-h-screen flex items-center justify-center">
      <div class="bg-white shadow-lg rounded-lg overflow-hidden max-w-5xl w-full flex flex-col md:flex-row">
        <!-- Left Side: Form -->
        <div class="w-full md:w-1/2 p-8">
          <!-- Logo and Info -->
          <div class="mb-6 text-center md:text-left">
            <img src="{{ asset('images/WBS-Logo.png') }}" alt="WBS Logo" class="h-12 mb-2 mx-auto md:mx-0" />
            <h2 class="text-xl font-semibold text-gray-700">Forgot Your Password?</h2>
            <p class="text-sm text-gray-500 mt-2">
              No problem. Just let us know your email address and we will email you a password reset link.
            </p>
          </div>

          <!-- Session Status -->
          @if (session('status'))
            <div class="mb-4 text-green-500 text-sm">
              {{ session('status') }}
            </div>
          @endif

          <!-- Form -->
          <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
            @csrf
            <div>
              <input type="email" name="email" placeholder="E-mail address" class="px-4 py-3 border border-gray-300 rounded-lg w-full focus:outline-none focus:border-black" required />
              @error('email')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
              @enderror
            </div>
            <button type="submit" class="w-full bg-[#415a77] text-white font-medium py-3 rounded-lg hover:bg-[#f47d61] transition-all duration-300 ease-in-out">
              Email Password Reset Link
            </button>
            <p class="text-sm text-center text-gray-900 mt-4">
              Remember your password?
              <a href="{{ route('login') }}" class="text-[#415a77] underline font-medium hover:text-[#f47d61] transition-all duration-300 ease-in-out">
                Login here
              </a>
            </p>
          </form>
        </div>

        <!-- Right Side: Picture -->
        <div class="hidden md:block w-full md:w-1/2">
          <img src="{{ asset('images/login.png') }}" alt="Forgot Password Illustration" class="w-full h-full object-cover" />
        </div>
      </div>
    </main>
    <script src="//code.tidio.co/oohi4ck9zmzjoekpsft3cp6h9cnitwej.js" async></script>
  </body>
</html>
