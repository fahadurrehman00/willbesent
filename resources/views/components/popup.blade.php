<!-- Popup Modal -->
<div id="popupModalSub" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white p-6 rounded-lg shadow-lg w-96">
        <p id="popupMessage" class="text-gray-600 mb-6"></p> <!-- Dynamic Message -->
        <h2 class="text-lg font-semibold mb-4">Are you sure?</h2>
        <p class="text-gray-600 mb-6">Do you want to continue to the next page?</p>
        <div class="flex justify-end space-x-4">
            <button onclick="closeModalSub()" class="px-4 py-2 bg-gray-300 rounded-lg hover:bg-gray-400">
                Cancel
            </button>
            <button onclick="redirectToPage()" class="px-4 py-2 bg-[#415a77] text-white rounded-lg hover:bg-blue-700">
                Go
            </button>
        </div>
    </div>
</div>

<script>
    function openPopupSub(message) {
        document.getElementById("popupMessage").textContent = message; // Set message dynamically
        document.getElementById("popupModalSub").classList.remove("hidden");
    }

    function closeModalSub() {
        document.getElementById("popupModalSub").classList.add("hidden");
    }

    function redirectToPage() {
        window.location.href = "/checkout";
    }
</script>
