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

<body class="bg-gray-100 min-h-screen font-sans ">
@include('components.header')
<div class="flex h-screen">
    @include('components.side-bar')
    <div class="w-full">
        <main class="flex-1 p-6">
            <section class="bg-white p-6 rounded-lg shadow-lg relative">
                <h2 class="text-xl font-bold mb-4">Profile</h2>

                <!-- Profile Image -->


                <!-- User Details Form -->
                <form id="basic-form" method="post" action="{{route('admin-profile-update',['id'=>$user->id])}}"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="relative w-24 h-24 mb-4">
                        <div class="relative">
                            <img
                                    src="{{asset('images/userProfile/'.$user->profile_image)}}"
                                    alt="{{asset('images/user.png')}}" class="w-full h-full rounded-full object-cover">
                            <div id="loader"
                                 class="hidden absolute inset-0 flex justify-center items-center bg-gray-500 bg-opacity-50 rounded-full">
                                <div
                                        class="w-12 h-12 border-4 border-white border-t-blue-500 rounded-full animate-spin">
                                </div>
                            </div>
                        </div>

                        <div>
                            <input type="file" name="profileImage"
                                   class=" bg-gray-800 text-white text-xs px-2 py-1 rounded-full">

                        </div>


                    </div>
                    <div class="grid grid-cols-4 md-grid-cols-2 gap-4 mt-12">
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
                            <span id="couponCodeError" class="text-red-500 text-sm"></span>
                        </div>
                        <div>
                            <label class="block text-gray-600">Discount Percentage</label>
                            <input type="number" id="discountPercentage" name="discount_percentage"
                                   class="w-full p-2 border border-gray-300 rounded-lg" required>
                            <span id="discountPercentageError" class="text-red-500 text-sm"></span>
                        </div>
                    </div>
                    <div class="text-right mt-6">
                        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-lg">Create</button>
                    </div>
                </form>

            </section>

            <section class="mt-6 bg-white p-6 rounded-lg shadow">
                <div class="flex justify-between items-center mb-4">
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full border-collapse border border-gray-200" id="clientTable">
                        <thead class="sticky top-0 bg-gray-200 z-10 border border-gray-300">
                        <tr class="bg-gray-100">
                            <th class="border border-gray-300 p-2">ID</th>
                            <th class="border border-gray-300 p-2">Discount</th>
                            <th class="border border-gray-300 p-2">Discount Percentage</th>
                            <th class="border border-gray-300 p-2">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($coupon as $c)
                            <tr>
                                <td class="border border-gray-300 p-2">{{ $c['id'] }}</td>
                                <td class="border border-gray-300 p-2">{{ $c['coupon_code'] }}</td>
                                <td class="border border-gray-300 p-2">{{ $c['discount_percentage'] }}%</td>
                                <td class="border border-gray-300 p-2">
                                    {{--                                    <button--}}
                                    {{--                                            class="editCouponButton bg-blue-500 text-white px-3 py-1 rounded"--}}
                                    {{--                                            data-id="{{ $c['id'] }}"--}}
                                    {{--                                            data-code="{{ $c['coupon_code'] }}"--}}
                                    {{--                                            data-percentage="{{ $c['discount_percentage'] }}">--}}
                                    {{--                                        Edit--}}
                                    {{--                                    </button>--}}
                                    <a
                                            href="{{ isset($c->id) ? route('delete-coupon', $c->id) : '#' }}"><i
                                                class="fas fa-trash-alt text-red-500"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

            </section>

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

    function saveCoupon() {
        const formData = new FormData();
        formData.append("coupon_code", document.getElementById("couponCode").value);
        formData.append("discount_percentage", document.getElementById("discountPercentage").value);

        fetch("/api/admin/save-coupon", {
            method: "POST",
            body: formData,
            headers: {
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
            }
        })
            .then(async response => {
                if (!response.ok) {
                    // Convert response to JSON and throw error to be caught in catch()
                    let errorData = await response.json();
                    throw errorData;
                }
                return response.json();
            })
            .then(data => {
                showToast("Discount coupon created successfully.", "success");
                document.getElementById("createCouponForm").reset();
                window.location.reload();
            })
            .catch(error => {
                console.error("Error:", error);

                if (error.errors) {
                    if (error.errors.coupon_code) {
                        document.getElementById("couponCodeError").textContent = error.errors.coupon_code[0];
                    }
                    if (error.errors.discount_percentage) {
                        document.getElementById("discountPercentageError").textContent = error.errors.discount_percentage[0];
                    }
                } else {
                    showToast("Something went wrong. Please try again.", "error");
                }
            });
    }


    document.getElementById("createCouponForm").addEventListener("submit", function (event) {
        event.preventDefault();
        saveCoupon();
        // showToast("Discount coupon created successfully.", "success");

    });

    document.getElementById("saveNotes").addEventListener("click", function () {
        showToast("Admin notes saved successfully.", "success");
    });


    document.addEventListener("DOMContentLoaded", function () {
        // Get modal elements
        const modal = document.getElementById("editCouponModal");
        const closeModalButton = document.getElementById("closeModal");

        // Function to open the edit modal and populate it with coupon details
        function openEditModal(couponId, couponCode, discountPercentage) {
            document.getElementById("editCouponId").value = couponId;
            document.getElementById("editCouponCode").value = couponCode;
            document.getElementById("editDiscountPercentage").value = discountPercentage;
            modal.classList.remove("hidden");
        }

        // Close modal on clicking "Cancel" button
        closeModalButton.addEventListener("click", function () {
            modal.classList.add("hidden");
        });

        // Attach click event to each "Edit" button
        document.querySelectorAll(".editCouponButton").forEach(button => {
            button.addEventListener("click", function () {
                const couponId = this.getAttribute("data-id");
                const couponCode = this.getAttribute("data-code");
                const discountPercentage = this.getAttribute("data-percentage");

                openEditModal(couponId, couponCode, discountPercentage);
            });
        });

        // Handle form submission
        document.getElementById("editCouponForm").addEventListener("submit", function (event) {
            event.preventDefault();

            const couponId = document.getElementById("editCouponId").value;
            const couponCode = document.getElementById("editCouponCode").value;
            const discountPercentage = document.getElementById("editDiscountPercentage").value;

            fetch(`/api/admin/update-coupon/${couponId}`, {
                method: "PUT",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
                },
                body: JSON.stringify({
                    coupon_code: couponCode,
                    discount_percentage: discountPercentage,
                }),
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showToast("Coupon updated successfully!", "success");
                        modal.classList.add("hidden"); // Close modal
                        location.reload(); // Refresh to show updated data
                    } else {
                        showToast("Failed to update coupon.", "error");
                    }
                })
                .catch(error => {
                    console.error("Error:", error);
                    showToast("Something went wrong. Please try again.", "error");
                });
        });
    });


</script>
</body>

</html>
