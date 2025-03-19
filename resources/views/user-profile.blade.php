<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>WBS | User Profile</title>
    <meta name="description" content="willbesent" />
    <meta name="keywords" content="willbesent" />
    <meta name="author" content="willbesent" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <link href="{{ asset('images/WBS-Logo.png') }}" rel="shortcut icon" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="assets/css/style.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    @include('components.user-header')
    @include('components.back-button')
    <main class="container mx-auto my-8 px-6 grid md:grid-cols-2 gap-6">
        <main id="myAccountSection" class="flex-1 tab-content">
            <section class="bg-white p-6 rounded-lg shadow-lg h-full">
                <div class="flex items-center mb-6 justify-between">
                    <div class="relative">
                        <img id="profileImage"
                        src="{{ auth()->user()->profile_image ? Storage::url(auth()->user()->profile_image) : asset('images/user.png') }}"
                        alt="Profile" class="w-24 h-24 rounded-full" />
                        <button id="editProfileImage"
                            class="absolute top-0 left-0 bg-gray-800 text-white text-sm px-2 py-1 rounded-full border">Edit</button>
                        <input id="fileInput" type="file" class="hidden" />
                    </div>
                </div>

                <form action="{{ route('user.update') }}" method="POST">
                    @csrf
                    <div id="profileFields" class="grid grid-cols-2 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-gray-600">First Name</label>
                            <input type="text" name="firstname" class="w-full p-2 border border-gray-300 rounded-lg"
                                value="{{ Auth::user()->firstname }}" />
                        </div>
                        <div>
                            <label class="block text-gray-600">Last Name</label>
                            <input type="text" name="lastname" class="w-full p-2 border border-gray-300 rounded-lg"
                                value="{{ Auth::user()->lastname }}" />
                        </div>
                        <div>
                            <label class="block text-gray-600">Email</label>
                            <input readonly type="email" name="email"
                                class="w-full p-2 border border-gray-300 rounded-lg"
                                value="{{ Auth::user()->email }}" />
                        </div>
                        <div>
                            <label class="block text-gray-600">Phone Number</label>
                            <input type="text" name="phone" class="w-full p-2 border border-gray-300 rounded-lg"
                                value="{{ Auth::user()->phone }}" />
                        </div>
                        <div>
                            <label class="block text-gray-600">City</label>
                            <input type="text" name="city" class="w-full p-2 border border-gray-300 rounded-lg"
                                value="{{ Auth::user()->city }}" />
                        </div>
                        <div>
                            <label class="block text-gray-600">State</label>
                            <input type="text" name="state" class="w-full p-2 border border-gray-300 rounded-lg"
                                value="{{ Auth::user()->state }}" />
                        </div>
                        <div>
                            <label class="block text-gray-600">Pin Code</label>
                            <input type="text" name="pincode" class="w-full p-2 border border-gray-300 rounded-lg"
                                value="{{ Auth::user()->pincode }}" />
                        </div>
                        <div>
                            <label class="block text-gray-600">Check-in Frequency</label>
                            <select name="frequency"
                                class="px-4 py-2 border border-gray-300 rounded-lg w-full focus:outline-none focus:border-black"
                                required>
                                <option value="" disabled {{ Auth::user()->frequency ? '' : 'selected' }}>
                                    Check-in Frequency</option>
                                <option value="daily" {{ Auth::user()->frequency === 'daily' ? 'selected' : '' }}>
                                    Daily</option>
                                <option value="weekly" {{ Auth::user()->frequency === 'weekly' ? 'selected' : '' }}>
                                    Weekly</option>
                                <option value="monthly" {{ Auth::user()->frequency === 'monthly' ? 'selected' : '' }}>
                                    Monthly</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-gray-600">Message Time</label>
                            <input type="time" name="message_time"
                                class="w-full p-2 border border-gray-300 rounded-lg"
                                value="{{ Auth::user()->message_time ? \Carbon\Carbon::parse(Auth::user()->message_time)->format('H:i') : '' }}"
                                required />
                        </div>
                    </div>
                    <div class="text-right mt-6">
                        <button type="submit"
                            class="bg-[#415A77] text-white px-6 py-2 rounded-lg hover:bg-[#F47D61] transition-all duration-300">Update</button>
                    </div>
                </form>
            </section>
        </main>

        <main id="packageDetailsSection" class="flex-1 tab-content">
            <section class="bg-white p-6 rounded-lg shadow-lg h-full">
                <h2 class="mb-6 border-b pb-4 text-3xl font-bold text-gray-800">
                    <span id="packageTitle">
                        @if (Auth::user()->subscriptions->isNotEmpty())
                            Subscription Details
                        @else
                            Package Details
                        @endif
                    </span>
                </h2>

                <div class="text-gray-700 space-y-6">
                    @if (Auth::user()->subscriptions->isNotEmpty())
                        <div class="p-4 bg-gray-100 rounded-lg">
                            <p id="subscriptionInfo" class="text-lg font-semibold">
                                Your current plan:
                                <strong class="text-[#415A77]">
                                    @if (Auth::user()->subscriptions->first()->type == 'monthly')
                                        Monthly ${{ Auth::user()->subscriptions[0]['total_amount'] }}
                                    @else
                                        Yearly
                                    @endif
                                </strong>
                            </p>
                        </div>
                        <ul id="packageFeatures" class="list-disc pl-6 space-y-2">
                            <li class="text-gray-800">You have
                                {{ Auth::user()->subscriptions->first()->fullWill == '1' ? 'a full will Subscription.' : 'no active full will.' }}
                            </li>
                            <li class="text-gray-800">You have
                                {{ Auth::user()->subscriptions->first()->poa == '1' ? 'a Power of Attorney Subscription.' : 'no active Power of Attorney Subscription.' }}
                            </li>
                            <li class="text-gray-800">You have
                                {{ Auth::user()->subscriptions->first()->executor == '1' ? 'an Executor Subscription.' : 'no active Executor Subscription.' }}
                            </li>
                        </ul>

                        <ul id="packageFeatures" class="list-disc pl-6 space-y-2">
                            <p id="subscriptionInfo" class="text-lg font-semibold">
                                <strong class="text-[#415A77]">One Time Paid
                                    {{ isset(Auth::user()->transactions[0]) ? '$' . Auth::user()->transactions[0]['amount'] : 'N/A' }}

                                </strong>
                            </p>
                            <li class="text-gray-800">
                                You have
                                {{ isset(Auth::user()->transactions[0]) && Auth::user()->transactions[0]['notarization'] == '1' ? 'Notarization Package' : 'no active Notarization Package' }}
                            </li>
                            <li class="text-gray-800">
                                You have
                                {{ isset(Auth::user()->transactions[0]) && Auth::user()->transactions[0]['winterwill'] == '1' ? 'Writer Will Package.' : 'no active winter Package.' }}
                            </li>
                            <li class="text-gray-800">
                                You have
                                {{ isset(Auth::user()->transactions[0]) && Auth::user()->transactions[0]['layer'] == '1' ? 'Lawyer Draft Will Package.' : 'no lawyer Package.' }}
                            </li>
                        </ul>

                        <div class="text-right mt-6">
                            <a id="cancelpackageButton"
                                class="mr-4 bg-[#415A77] cursor-pointer text-white py-3 px-6 rounded-lg hover:bg-[#F47D61] transition-all duration-300">
                                Cancel Subscription
                            </a>
                            <a id="packageButton"
                                class="bg-[#415A77] text-white py-3 px-6 rounded-lg hover:bg-[#F47D61] transition-all duration-300"
                                href="{{ route('checkout') }}">
                                Update Subscription
                            </a>
                        </div>
                    @else
                        <p id="packageDescription" class="text-lg text-gray-800">Choose a package that suits your
                            needs.</p>
                        <ul id="packageFeatures" class="list-disc pl-6 space-y-2">
                            <li class="text-gray-800">You can create 1 full will.</li>
                            <li class="text-gray-800">You can add up to 2 recipients.</li>
                        </ul>
                        <div class="text-right mt-6">
                            <a id="packageButton"
                                class="bg-[#415A77] text-white py-3 px-6 rounded-lg hover:bg-[#F47D61] transition-all duration-300"
                                href="{{ route('checkout') }}">
                                Get Started
                            </a>
                        </div>
                    @endif
                </div>
            </section>
        </main>
    </main>
    @include('components.toast')
    @include('components.cancel-popup')
    @include('components.footer')
    <script src="//code.tidio.co/oohi4ck9zmzjoekpsft3cp6h9cnitwej.js" async></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#editProfileImage").on("click", function() {
                $("#fileInput").click();
            });

            $("#fileInput").on("change", function() {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        $("#profileImage").attr("src", e.target.result);
                    };
                    reader.readAsDataURL(file);

                    const formData = new FormData();
                    formData.append("profile_image", file);
                    $("#profileImage").addClass("opacity-50");

                    $.ajax({
                        url: "/update-profile-image",
                        type: "POST",
                        data: formData,
                        contentType: false,
                        processData: false,
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                        },
                        success: function(response) {
                            $("#profileImage").removeClass("opacity-50");
                            $("#profileImage").attr("src", response.imageUrl);
                            showToast("Profile image uploaded successfully!");
                            setTimeout(() => location.reload(), 1000);
                        },
                        error: function() {
                            showToast("Failed to update profile image.", "error");
                        },
                    });
                }
            });
        });

        $(document).ready(function() {
            $('#cancelpackageButton').on('click', function(e) {
                cancelPopupSub('If you cancel, you will lose all your documents and recipients.');
            });
        });
    </script>
</body>

</html>
