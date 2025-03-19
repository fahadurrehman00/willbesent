<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Signup - WBS</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
    <!-- favicon -->
    <link href="{{ asset('images/WBS-Logo.png') }}" rel="shortcut icon" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <main class="bg-gray-100 min-h-screen flex items-center justify-center">
        <div class="bg-white shadow-lg rounded-lg overflow-hidden max-w-6xl w-full flex flex-col md:flex-row">
            <!-- Left Side: Form -->
            <!-- Logo and Info -->
            <div class="w-full md:w-1/2 p-8">
                <div class="mb-6 text-center md:text-left">
                    <img src="{{ asset('images/WBS-Logo.png') }}" alt="WBS Logo" class="h-12 mb-2 mx-auto md:mx-0" />
                    <h2 class="text-xl font-semibold text-gray-700">Ready to Start</h2>
                    <p class="text-sm text-gray-500 mt-2">
                        Secure your legacy by registering your will and power of attorney
                        with WBS. After your passing, we’ll ensure your family receives
                        these documents with care and professionalism.
                    </p>
                </div>
                <!-- Form -->
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li class="text-red-500">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form class="space-y-4" method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="flex flex-col md:flex-row md:space-x-4">
                        <input type="text" name="firstName" placeholder="First Name"
                            class="px-4 py-3 border border-gray-300 rounded-lg w-full md:w-1/2 focus:outline-none focus:border-black"
                            required />
                        <input type="text" name="lastName" placeholder="Last Name"
                            class="px-4 py-3 border border-gray-300 rounded-lg w-full md:w-1/2 focus:outline-none focus:border-black mt-4 md:mt-0"
                            required />
                    </div>
                    <div class="flex flex-col md:flex-row md:space-x-4">
                        <input type="email" name="email" placeholder="E-mail address (verified)"
                            class="px-4 py-3 border border-gray-300 rounded-lg w-full md:w-1/2 focus:outline-none focus:border-black"
                            required />
                            <input type="tel" name="phone" placeholder="Phone"
       class="px-4 py-3 border border-gray-300 rounded-lg w-full md:w-1/2 focus:outline-none focus:border-black mt-4 md:mt-0"
       required
       value="+"
       pattern="^\+\d{11}$"
       maxlength="12"
       title="Phone number must start with '+' and be 12 digits long." />

                    </div>
                    <div class="flex flex-col md:flex-row md:space-x-4">
                    <input type="password" name="password" placeholder="Password"
                        class="px-4 py-3 border border-gray-300 rounded-lg w-full focus:outline-none focus:border-black"
                        required />
                        <input type="pincode" name="pincode" placeholder="Pin Code"
                        class="px-4 py-3 border border-gray-300 rounded-lg w-full focus:outline-none focus:border-black"
                        required />
                    </div>
                    <div>
                        <input type="text" name="street" placeholder="Street"
                            class="px-4 py-3 border border-gray-300 rounded-lg w-full focus:outline-none focus:border-black"
                            required />
                    </div>
                    <div class="flex flex-col md:flex-row md:space-x-4">
                        <input type="text" name="city" placeholder="City"
                            class="px-4 py-3 border border-gray-300 rounded-lg w-full md:w-1/3 focus:outline-none focus:border-black"
                            required />
                        <input type="text" name="state" placeholder="State"
                            class="px-4 py-3 border border-gray-300 rounded-lg w-full md:w-1/3 focus:outline-none focus:border-black mt-4 md:mt-0"
                            required />
                        <input type="text" name="zip" placeholder="Zip"
                            class="px-4 py-3 border border-gray-300 rounded-lg w-full md:w-1/3 focus:outline-none focus:border-black mt-4 md:mt-0"
                            required />
                    </div>
                    <select name="frequency"
                        class="px-4 py-3 border border-gray-300 rounded-lg w-full focus:outline-none focus:border-black"
                        required>
                        <option value="" disabled selected>Check-in Frequency</option>
                        <option value="daily">Daily</option>
                        <option value="weekly">Weekly</option>
                        <option value="monthly">Monthly</option>
                    </select>
                    <div>
                        <label class="block text-gray-600">Message Time</label>
                        <input type="time" name="message_time" class="w-full p-2 border border-gray-300 rounded-lg"
                            {{-- value="{{ Auth::user()->message_time ? \Carbon\Carbon::parse(Auth::user()->message_time)->format('H:i') : '' }}" --}} required />

                        <p class="text-xs text-gray-600">Time will be set in your current time zone at the
                            time of signup.</p>
                    </div>
                    <!-- reCAPTCHA -->
                    <div class="g-recaptcha" data-sitekey="{{ env('NOCAPTCHA_SITEKEY') }}" data-callback="enableSubmit">
                    </div>
                    @error('g-recaptcha-response')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                    <!-- Privacy Policy -->
                    <div>
                        <p class="text-xs text-gray-500 mb-2">
                            By checking this, you agree to the
                            <a target="blank"
                                href="https://docs.google.com/document/d/1mnM6R-CoCWYnjYKJHh9t9kuvvT8Nw_dyeWYkXo0zEb4/edit?tab=t.0"
                                class="text-black underline hover:text-[#f47d61]">Terms & Conditions</a> and the
                            <a target="blank"
                                href="https://docs.google.com/document/d/1F7-ASspLqayxzppP7S72uzk7Vk5F-Bf5xF4IGRpfczM/edit?tab=t.0"
                                class="text-black underline hover:text-[#f47d61]">Privacy Policy</a>.
                        </p>
                        <label
                            class="flex items-start gap-4 border rounded-lg p-4 hover:shadow-md transition cursor-pointer mb-2">
                            <input type="checkbox" class="hidden peer" name="terms" />
                            <div
                                class="w-5 h-5 border-2 border-gray-300 rounded-lg peer-checked:bg-[#415a77] peer-checked:border-[#415a77] transition-all duration-300">
                            </div>
                            <div>
                                <p class="text-gray-600 text-sm ">
                                    I agree to the Terms & Conditions and the Privacy Policy.
                                </p>
                            </div>
                        </label>
                        <label
                            class="flex items-start gap-4 border rounded-lg p-4 hover:shadow-md transition cursor-pointer mb-2">
                            <input type="checkbox" class="hidden peer" name="twillio" />
                            <div
                                class="w-5 h-5 border-2 border-gray-300 rounded-lg peer-checked:bg-[#415a77] peer-checked:border-[#415a77] transition-all duration-300">
                            </div>
                            <div>
                                <p class="text-gray-600 text-sm ">
                                I consent to receive texts and calls related to your account.
                                </p>
                            </div>
                        </label>
                    </div>
                    <!-- Submit Button -->
                    <button type="submit" id="submitBtn" disabled
                        class="w-full bg-gray-400 cursor-not-allowed text-white font-medium py-3 rounded-lg hover:bg-[#f47d61] transition-all duration-300 ease-in-out">
                        Sign Up
                    </button>
                    <p class="text-sm text-center text-gray-900 mt-4">
                        Already have an account?
                        <a href="{{ route('login') }}"
                            class="text-[#415a77] underline font-medium hover:text-[#f47d61] transition-all duration-300 ease-in-out">Login</a>
                    </p>
                </form>
            </div>
            <!-- Right Side: Picture -->
            <div class="hidden md:block w-full md:w-1/2 bg-cover bg-center"
                style="background-image: url('{{ asset('images/signup.png') }}')"></div>
        </div>
    </main>
</body>
<!-- reCAPTCHA Script -->
<!--<script src="https://www.google.com/recaptcha/api.js" async defer></script>-->
<script src="//code.tidio.co/oohi4ck9zmzjoekpsft3cp6h9cnitwej.js" async></script>
<script src="https://www.google.com/recaptcha/enterprise.js" async defer></script>

<!-- JavaScript to Enable Button on reCAPTCHA Check -->
<script>
    document.querySelector('input[name="phone"]').addEventListener('input', function (e) {
    this.value = this.value.replace(/[^+\d]/g, ''); // Remove non-numeric characters except +
});

    function enableSubmit() {
        checkFormCompletion();
    }

    function checkFormCompletion() {
        let termsChecked = document.querySelector("input[name='terms']").checked;
        let twillioChecked = document.querySelector("input[name='twillio']").checked;
        let recaptchaChecked = grecaptcha.enterprise.getResponse().length > 0;

        let submitBtn = document.getElementById("submitBtn");
        if (twillioChecked && termsChecked && recaptchaChecked) {
            submitBtn.disabled = false;
            submitBtn.classList.remove("bg-gray-400", "cursor-not-allowed");
            submitBtn.classList.add("bg-[#415a77]", "hover:bg-[#f47d61]");
        } else {
            submitBtn.disabled = true;
            submitBtn.classList.add("bg-gray-400", "cursor-not-allowed");
            submitBtn.classList.remove("bg-[#415a77]", "hover:bg-[#f47d61]");
        }
    }

    // Add event listeners to checkboxes
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelector("input[name='terms']").addEventListener("change", checkFormCompletion);
        document.querySelector("input[name='twillio']").addEventListener("change", checkFormCompletion);
    });
</script>


</html>
