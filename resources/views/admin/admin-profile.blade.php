<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Profile</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="{{ asset('images/WBS-Logo.png') }}" rel="shortcut icon">
</head>

<body class="bg-gray-100 min-h-screen font-sans overflow-hidden">
    @include('components.header')
    <div class="flex h-screen">
        @include('components.side-bar')
        <div class="w-full">
            <main class="flex-1 p-6">
                <section class="bg-white p-6 rounded-lg shadow-lg relative">
                    <h2 class="text-xl font-bold mb-4">Profile</h2>
                    
                    <!-- Profile Image -->
                    <div class="relative w-24 h-24 mb-4">
                        <div class="relative">
                            <img id="profileImage"
                                src="{{ auth()->user() && auth()->user()->profile_image ? asset('storage/' . auth()->user()->profile_image) : asset('images/user.png') }}"
                                alt="Profile" class="w-full h-full rounded-full object-cover">
                            <div id="loader"
                                class="hidden absolute inset-0 flex justify-center items-center bg-gray-500 bg-opacity-50 rounded-full">
                                <div
                                    class="w-12 h-12 border-4 border-white border-t-blue-500 rounded-full animate-spin">
                                </div>
                            </div>
                        </div>
                        <button id="editProfileImage"
                            class="absolute bottom-0 right-0 bg-gray-800 text-white text-xs px-2 py-1 rounded-full">Edit</button>
                        <input id="fileInput" type="file" class="hidden">
                    </div>

                    <!-- User Details Form -->
                    <form id="editUserProfile" class="mt-6">
                        <div class="grid grid-cols-4 md-grid-cols-2 gap-4">
                            <div>
                                <label class="block text-gray-600">First Name</label>
                                <input type="text" id="firstName" name="firstname"
                                    class="w-full p-2 border border-gray-300 rounded-lg">
                            </div>
                            <div>
                                <label class="block text-gray-600">Last Name</label>
                                <input type="text" id="lastName" name="lastname"
                                    class="w-full p-2 border border-gray-300 rounded-lg">
                            </div>
                            <div>
                                <label class="block text-gray-600">Email</label>
                                <input type="email" id="email" name="email"
                                    class="w-full p-2 border border-gray-300 rounded-lg">
                            </div>
                            <div>
                                <label class="block text-gray-600">Phone Number</label>
                                <input type="text" id="phoneNumber" name="phone"
                                    class="w-full p-2 border border-gray-300 rounded-lg">
                            </div>
                        </div>
                        <div class="text-right mt-6">
                            <button type="submit" class="bg-[#415a77] text-white px-4 py-2 rounded-lg">Save</button>
                        </div>
                    </form>
                </section>

                <!-- Discount Coupon Section -->
                <section class="bg-white p-6 rounded-lg shadow-lg mt-6">
                    <h2 class="text-xl font-bold mb-4">Create Discount Coupons</h2>
                    <form id="createCouponForm">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-gray-600">Coupon Code</label>
                                <input type="text" id="couponCode" name="coupon_code"
                                    class="w-full p-2 border border-gray-300 rounded-lg" required>
                            </div>
                            <div>
                                <label class="block text-gray-600">Discount Percentage</label>
                                <input type="number" id="discountPercentage" name="discount_percentage"
                                    class="w-full p-2 border border-gray-300 rounded-lg" required>
                            </div>
                        </div>
                        <div class="text-right mt-6">
                            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-lg">Create</button>
                        </div>
                    </form>
                </section>

                <!-- Notes Section -->
                <!-- <section class="bg-white p-6 rounded-lg shadow-lg mt-6">
                    <h2 class="text-xl font-bold mb-4">Admin Notes</h2>
                    <textarea id="adminNotes" class="w-full p-2 border border-gray-300 rounded-lg h-40"></textarea>
                    <div class="text-right mt-4">
                        <button id="saveNotes" class="bg-blue-600 text-white px-4 py-2 rounded-lg">Save Notes</button>
                    </div>
                </section> -->
            </main>
        </div>
    </div>
    @include('components.toast')

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            fetchLoggedInUser();
            setupProfileImageUpload();
        });

        function fetchLoggedInUser() {
            fetch("/api/logged-in-user")
                .then(response => response.json())
                .then(data => {
                    document.getElementById("firstName").value = data.firstname;
                    document.getElementById("lastName").value = data.lastname;
                    document.getElementById("email").value = data.email;
                    document.getElementById("phoneNumber").value = data.phone;
                })
                .catch(error => showToast("Error fetching user data.", "error"));
        }

        function setupProfileImageUpload() {
            const fileInput = document.getElementById("fileInput");
            document.getElementById("editProfileImage").addEventListener("click", () => fileInput.click());
        }

        document.getElementById("createCouponForm").addEventListener("submit", function(event) {
            event.preventDefault();
            showToast("Discount coupon created successfully.", "success");
        });

        document.getElementById("saveNotes").addEventListener("click", function() {
            showToast("Admin notes saved successfully.", "success");
        });
    </script>
</body>

</html>
