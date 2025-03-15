<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Success - WBS</title>
    <link rel="stylesheet" href="../assets/css/style.css" />
    <link href="{{ asset('images/WBS-Logo.png') }}" rel="shortcut icon" />
    <script src="https://cdn.tailwindcss.com"></script>
  </head>
  <body>
    <main class="bg-gray-100 min-h-screen flex items-center justify-center">
      <div
        class="bg-white shadow-lg rounded-lg overflow-hidden max-w-lg w-full"
      >
        <div class="p-8 text-center">
          <!-- Logo -->
          <img
            src="{{ asset('images/WBS-Logo.png') }}"
            alt="WBS Logo"
            class="h-12 w-12 mx-auto mb-4"
          />
          <!-- Success Message -->
          <h2 class="text-2xl font-semibold text-gray-700">
            Subscription Successful!
          </h2>
          <p class="text-sm text-gray-500 mt-2">
            Thank you for subscribing to WBS. We’re excited to help you secure
            your legacy with our professional services.
          </p>
          <!-- Success Icon -->
          <div class="mt-6">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              fill="none"
              viewBox="0 0 24 24"
              stroke-width="2"
              stroke="currentColor"
              class="text-green-500 h-16 w-16 mx-auto"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                d="M9 12l2 2l4-4M21 12a9 9 0 11-18 0a9 9 0 0118 0z"
              />
            </svg>
          </div>
          <!-- Navigation Buttons -->
          <div class="mt-8 space-y-4">
            <a
              href="{{ route('dashboard') }}"
              class="w-full inline-block text-white bg-[#415a77] py-3 rounded-lg font-medium hover:bg-[#f47d61] transition-all duration-300 ease-in-out"
            >
              Go to Dashboard
            </a>
            <a
              href="{{ url('/') }}"
              class="w-full inline-block text-[#415a77] underline font-medium hover:text-[#f47d61] transition-all duration-300 ease-in-out"
            >
              Back to Homepage
            </a>
          </div>
        </div>
      </div>
    </main>
    <script src="//code.tidio.co/oohi4ck9zmzjoekpsft3cp6h9cnitwej.js" async></script>
  </body>
</html>
