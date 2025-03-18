<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>WBS | Dashboard</title>
    <meta name="description" content="willbesent" />
    <meta name="keywords" content="willbesent" />
    <meta name="author" content="willbesent" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('images/WBS-Logo.png') }}" type="image/png">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    @include('components.user-header')
    <!-- Dasboard Start -->
    <section class="bg-[#E2E8F0] p-6">
        <!-- Main Grid Section -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Loader -->
            <div id="loader" class="hidden fixed inset-0 bg-gray-500 bg-opacity-50 flex justify-center items-center">
                <div class="w-16 h-16 border-4 border-white border-t-blue-500 rounded-full animate-spin"></div>
            </div>
            <!-- First Row -->
            <div class="bg-white p-6 rounded shadow">
                <h2 class="text-lg font-semibold">Will</h2>
                <div class="flex gap-4 pt-4">
                    <div class="border-2 border-dashed border-gray-300 rounded h-40 flex flex-col items-center justify-center text-gray-500 cursor-pointer w-1/4 p-4"
                        onclick="document.getElementById('willUpload').click()">
                        <i class="fas fa-plus"></i>
                        <p>Click to upload.</p>
                        <p class="text-sm">Must be a Word or PDF document.</p>
                        <input type="file" id="willUpload" accept=".pdf,.doc,.docx" class="hidden"
                            onchange="uploadDocumentAjax(this)" />
                    </div>
                    <div id="willDocuments" class="space-y-2 w-3/4"></div>
                </div>
            </div>

            <div class="bg-white p-6 rounded shadow space-y-4">
                <h2 class="text-lg font-semibold">Will Recipients</h2>
                <ul id="willRecipients" class="space-y-2">
                    <li class="flex items-center space-x-2">
                        <button
                            class="bg-[#415a77] text-white px-3 py-1 rounded hover:bg-[#f47d61] transition-all duration-300"
                            onclick="openPopup('will-popup', 'will')">
                            +
                        </button>
                        <p>Click here to add recipient</p>
                    </li>
                    <!-- Recipients will be added here -->
                    @if (isset($recipients) && !empty($recipients))
                        @foreach ($recipients as $recipient)
                            @if (isset($recipient->type) && $recipient->type == 'will')
                                <li id="will-recipient" class="space-y-2 flex justify-between">
                                    <div>
                                        <p class="recipient-name font-semibold">{{ $recipient->name ?? 'N/A' }}</p>
                                        <p class="recipient-mobile text-sm text-gray-600">
                                            {{ $recipient->mobile ?? 'N/A' }}</p>
                                        <p class="recipient-email text-sm text-gray-600">
                                            {{ $recipient->email ?? 'N/A' }}</p>
                                    </div>
                                    <div class="space-x-2">
                                        <a href="javascript:void(0);" class="text-blue-500 editRecipient"
                                            data-id="{{ $recipient->id ?? '' }}">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a
                                            href="{{ isset($recipient->id) ? route('recipients.delete', $recipient->id) : '#' }}"><i
                                                class="fas fa-trash-alt text-red-500"></i></a>
                                    </div>
                                </li>
                            @endif
                        @endforeach
                    @else
                        <p class="text-gray-500">No recipients found.</p>
                    @endif

                </ul>
            </div>

            <!-- Second Row -->
            <div class="bg-white p-6 rounded shadow space-y-4">
                <h2 class="text-lg font-semibold">Power of Attorney</h2>
                <div id="poaContainer" class="flex gap-4">
                    <div class="border-2 border-dashed border-gray-300 rounded h-40 flex flex-col items-center justify-center text-gray-500 cursor-pointer w-1/4 p-4"
                        onclick="document.getElementById('poaUpload').click()">
                        <i class="fas fa-plus"></i>
                        <p>Click to upload.</p>
                        <p class="text-sm">Must be a Word or PDF document.</p>
                        <input type="file" id="poaUpload" accept=".pdf,.doc,.docx" class="hidden"
                            onchange="uploadAttornyAjax(this)" />
                    </div>
                    <div id="poaDocuments" class="space-y-2 w-3/4"></div>
                </div>
            </div>

            <div class="bg-white p-6 rounded shadow space-y-4">
                <h2 class="text-lg font-semibold">Power of Attorney Recipients</h2>
                <ul id="poaRecipients" class="space-y-2">
                    <li class="flex items-center space-x-2">
                        <button
                            class="bg-[#415a77] text-white px-3 py-1 rounded hover:bg-[#f47d61] transition-all duration-300"
                            onclick="openPopup('poa-popup', 'attorny')">
                            +
                        </button>
                        <p>Click here to add recipient</p>
                    </li>
                    @if (isset($recipients) && !empty($recipients))
                        @foreach ($recipients as $recipient)
                            @if (isset($recipient->type) && $recipient->type == 'attorny')
                                <li id="will-recipient" class="space-y-2 flex justify-between">
                                    <div>
                                        <p class="recipient-name font-semibold">{{ $recipient->name ?? 'N/A' }}</p>
                                        <p class="recipient-mobile text-sm text-gray-600">
                                            {{ $recipient->mobile ?? 'N/A' }}</p>
                                        <p class="recipient-email text-sm text-gray-600">
                                            {{ $recipient->email ?? 'N/A' }}</p>
                                    </div>
                                    <div class="space-x-2 flex items-center">
                                        <a href="javascript:void(0);" class="text-blue-500 editRecipient"
                                            data-id="{{ $recipient->id ?? '' }}">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <a
                                            href="{{ isset($recipient->id) ? route('recipients.delete', $recipient->id) : '#' }}">
                                            <i class="fas fa-trash-alt text-red-500"></i>
                                        </a>
                                    </div>
                                </li>
                            @endif
                        @endforeach
                    @else
                        <p class="text-gray-500">No recipients found.</p>
                    @endif

                </ul>
            </div>
        </div>

        <!-- Popup Modal -->
        <div id="popupModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center hidden">
            <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-lg">
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Add Recipient</h3>
                <form id="recipientForm" class="grid grid-cols-2 gap-4">
                    @csrf
                    <input id="will-recipient" type="hidden" name="will-recipient">
                    <input id="poa-recipient" type="hidden" name="poa-recipient">
                    <input type="hidden" name="id" id="recipientId">
                    <div>
                        <label for="recipientFirstName" class="block text-sm font-medium text-gray-700">First
                            Name</label>
                        <input name="firstname" type="text" id="recipientFirstName"
                            class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                            required />
                    </div>
                    <div>
                        <label for="recipientLastName" class="block text-sm font-medium text-gray-700">Last
                            Name</label>
                        <input name="lastname" type="text" id="recipientLastName"
                            class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                            required />
                    </div>
                    <div>
                        <label for="recipientMobile" class="block text-sm font-medium text-gray-700">Mobile
                            Number</label>
                        <input name="phone" type="text" id="recipientMobile"
                            class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                            required />
                    </div>
                    <div>
                        <label for="recipientEmail" class="block text-sm font-medium text-gray-700">Email</label>
                        <input name="email" type="email" id="recipientEmail"
                            class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                            required />
                    </div>
                    <div>
                        <label for="recipientStreet" class="block text-sm font-medium text-gray-700">Street
                            </label>
                        <input name="street" type="text" id="recipientStreet"
                            class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                            required />
                    </div>
                    <div>
                        <label for="recipientCity" class="block text-sm font-medium text-gray-700">City
                        </label>
                        <input name="city" type="text" id="recipientCity"
                            class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                            required />
                    </div>
                    <div>
                        <label for="recipientState" class="block text-sm font-medium text-gray-700">State</label>
                        <input name="state" type="text" id="recipientState"
                            class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                            required />
                    </div>
                    <div>
                        <label for="recipientZip" class="block text-sm font-medium text-gray-700">Zip</label>
                        <input name="zip" type="text" id="recipientZip"
                            class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                            required />
                    </div>
                    <div class="col-span-2 flex justify-end space-x-4 mt-4">
                        <button type="button"
                            class="bg-gray-300 px-4 py-2 rounded-lg text-gray-700 hover:bg-gray-400"
                            onclick="closePopup()">Cancel</button>
                        <button type="submit" id="recipientformsubmit"
                            class="bg-[#415a77] text-white px-4 py-2 rounded-lg hover:bg-[#f47d61]">Save</button>
                    </div>
                </form>
            </div>
        </div>

    </section>
    <!-- Dasboard End -->

    @include('components.footer')
    @include('components.toast')
    @include('components.popup')
    <script src="//code.tidio.co/oohi4ck9zmzjoekpsft3cp6h9cnitwej.js" async></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        fetchDocuments();
        fetchAttorny();

        function openPopup(popupType, recipientType) {
            // Update the hidden input value
            if (recipientType === 'attorny') {
                document.getElementById('poa-recipient').value = 'attorny';
                document.getElementById('will-recipient').value = null;
            } else {
                document.getElementById('will-recipient').value = 'will';
                document.getElementById('poa-recipient').value = null;
            }

            // Show the modal
            document.getElementById('popupModal').classList.remove('hidden');
        }

        function closePopup() {
            document.getElementById('popupModal').classList.add('hidden');
            currentListId = "";
            editingIndex = null;
        }

        document.getElementById("recipientForm").addEventListener("submit", function(event) {

            event.preventDefault();
            const POA = {{ Auth::user()->subscriptions[0]['poa'] ?? 0 }};
            console.log(document.getElementById("poa-recipient").value)
            if (document.getElementById("poa-recipient").value === "attorny") {
                if (POA !== 1) {
                    openPopupSub("You don't have a subssssssscription plan.", 'error');
                    return;
                }
                console.log("attorny click")
            } else {
                const fullWill = {{ Auth::user()->subscriptions[0]['fullWill'] ?? 0 }};
                console.log("will before click")
                if (fullWill !== 1) {
                    openPopupSub("You don't have a subscription plan.", 'error');
                    return;
                }
                console.log("will after click")
            }
            console.log("okay");
            let formData = new FormData(this);
            formData.append("will-recipient", document.getElementById("will-recipient").value);
            formData.append("poa-recipient", document.getElementById("poa-recipient").value);
            fetch("{{ route('recipients.store') }}", {
                    method: "POST",
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showToast("Recipient update successfully!");
                        setTimeout(() => {
                            window.location.reload();
                        }, 500);
                    } else {
                        alert("Error: " + data.message);
                    }
                })
                .catch(error => {
                    console.error("Error:", error);
                    // alert("Something went wrong. Please try again.");
                });
        });

        $(document).ready(function() {
            $(".editRecipient").click(function() {
                let recipientId = $(this).data("id");

                // Make AJAX request to get recipient data
                $.ajax({
                    url: "{{ route('recipients.edit') }}",
                    type: "GET",
                    data: {
                        id: recipientId
                    },
                    success: function(response) {
                        if (response.success) {
                            let recipient = response.recipient;
                            let nameParts = recipient.name.split(" ");
                            // Populate modal fields with recipient data
                            $("#recipientId").val(recipient.id);
                            $("#recipientFirstName").val(nameParts[0]); // First name
                            $("#recipientLastName").val(nameParts.slice(1).join(" "));
                            $("#recipientMobile").val(recipient.mobile);
                            $("#recipientEmail").val(recipient.email);
                            $("#recipientState").val(recipient.state);
                            $("#recipientZip").val(recipient.zip);
                            $("#recipientCity").val(recipient.city);
                            $("#recipientStreet").val(recipient.street);
                            // Show the modal
                            document.getElementById('popupModal').classList.remove('hidden');
                        } else {
                            alert("Error fetching recipient data.");
                        }
                    },
                    error: function() {
                        alert("Something went wrong.");
                    }
                });
            });

            // Function to close modal
            function closePopup() {
                $("#popupModal").addClass("hidden");
            }

            $(".bg-gray-300").click(closePopup);
        });

        function showLoader() {
            document.getElementById('loader').classList.remove('hidden');
        }

        function hideLoader() {
            document.getElementById('loader').classList.add('hidden');
        }

        function uploadDocumentAjax(input) {
            const file = input.files[0];
            if (!file) return;
            const fullWill = {{ Auth::user()->subscriptions[0]['fullWill'] ?? 0 }};

            if (fullWill !== 1) {
                openPopupSub("You don't have a subscription plan.", 'error');
                return;
            }

            const formData = new FormData();
            formData.append("document", file);
            formData.append("document_type", 'will');
            showLoader();

            fetch("/documents", {
                    method: "POST",
                    body: formData,
                    headers: {
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
                    },
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        hideLoader();
                        window.location.reload();
                    } else {
                        showToast(data.message || "Document upload failed.");
                        hideLoader();
                    }
                })
                .catch(error => {
                    showToast("Unexpected response format.");
                    hideLoader();
                });
        }

        function uploadAttornyAjax(input) {
            const file = input.files[0];
            if (!file) return;

            const fullWill = {{ Auth::user()->subscriptions[0]['fullWill'] ?? 0 }};
            const poa = {{ Auth::user()->subscriptions[0]['poa'] ?? 0 }};

            if (fullWill !== 1 || poa !== 1) {
                openPopupSub("You don't have a subscription plan.", 'error');
                return;
            }

            const formData = new FormData();
            formData.append("document", file);
            formData.append("document_type", 'attorny');
            showLoader();

            fetch("/documents", {
                    method: "POST",
                    body: formData,
                    headers: {
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
                    },
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showToast(data.message || "Document upload Succesfully.");
                        hideLoader();
                        window.location.reload();
                    } else {
                        showToast(data.message || "Document upload failed.");
                        hideLoader();
                    }
                })
                .catch(error => {
                    showToast("Unexpected response format.");
                    hideLoader();
                });
        }

        async function fetchDocuments() {
            const response = await fetch('/all/documents');
            const documents = await response.json();

            const container = document.getElementById("willDocuments");
            container.innerHTML = "";

            documents.forEach(doc => {
                const div = document.createElement("div");
                div.className = "flex items-center justify-between bg-gray-100 p-2 rounded";
                div.innerHTML = `
                <p class="truncate w-3/4">${doc.name}</p>
                <button class="text-blue-500" onclick="viewDocument('${doc.path}')">
                    <i class="fas fa-eye"></i>
                </button>
                <button class="text-red-500" onclick="deleteDocument(${doc.id})">
                    <i class="fas fa-trash-alt"></i>
                </button>
            `;
                container.appendChild(div);
            });
        }

        async function fetchAttorny() {
            const response = await fetch('/all/attorny/documents');
            const documents = await response.json();

            const container = document.getElementById("poaDocuments");
            container.innerHTML = "";

            documents.forEach(doc => {
                const div = document.createElement("div");
                div.className = "flex items-center justify-between bg-gray-100 p-2 rounded";
                div.innerHTML = `
                <p class="truncate w-3/4">${doc.name}</p>
                <button class="text-blue-500" onclick="viewDocument('${doc.path}')">
                    <i class="fas fa-eye"></i>
                </button>
                <button class="text-red-500" onclick="deleteDocument(${doc.id})">
                    <i class="fas fa-trash-alt"></i>
                </button>
            `;
                container.appendChild(div);
            });
        }

        function viewDocument(path) {
            window.open(`/storage/${path}`, "_blank");
        }

        async function deleteDocument(id) {
            showLoader();
            await fetch(`/documents/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });
            fetchDocuments();
            fetchAttorny();
            showToast("Deleted successfully");
            hideLoader();
        }
    </script>
</body>

</html>
