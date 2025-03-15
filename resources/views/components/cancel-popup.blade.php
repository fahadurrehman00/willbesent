<!-- Popup Modal -->
<div id="popupModalSub" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white p-6 rounded-lg shadow-lg w-96">
        <p id="popupMessage" class="text-gray-700 mb-4"></p>
        <h2 class="text-lg font-semibold">Are you sure?</h2>
        <p class="text-gray-700">By canceling, you agree to the terms and conditions of the cancelation. Please review
            the document here prior
            to canceling.</p>
        <div class="flex justify-end space-x-4 mt-6">
            <button onclick="closeModalSub()" class="px-4 py-2 bg-gray-300 rounded-lg hover:bg-gray-400">
                No
            </button>
            <a href="{{ route('cancel.subscription') }}"
                class="px-4 py-2 bg-[#415a77] text-white rounded-lg hover:bg-[#f47d61]">
                Yes, cancel subscription
            </a>
        </div>
    </div>
</div>

<script>
    function cancelPopupSub(message) {
        document.getElementById("popupMessage").textContent = message;
        document.getElementById("popupModalSub").classList.remove("hidden");
    }

    function closeModalSub() {
        document.getElementById("popupModalSub").classList.add("hidden");
    }
</script>
