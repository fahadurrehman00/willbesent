<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin - Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <link href="{{ asset('images/WBS-Logo.png') }}" rel="shortcut icon" />
</head>

<body class="bg-gray-100 min-h-screen font-sans">
    @include('components.header')
    <div class="flex h-screen">
        @include('components.side-bar')

        <div class="w-full">
            <!-- Main Content -->
            <main id="dashboardContent" class="flex-1 p-6 ">
                <!-- Cards Section -->
                <section class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="bg-[#E2E8F0] p-6 rounded-lg shadow hover:shadow-lg transition">
                        <h2 class="text-gray-600 font-bold">Total Client</h2>
                        <p class="text-gray-800 text-2xl mt-2" id="totalclient"></p>
                    </div>
                    <div class="bg-[#E2E8F0] p-6 rounded-lg shadow hover:shadow-lg transition">
                        <h2 class="text-gray-600 font-bold">Total Documents</h2>
                        <p class="text-gray-800 text-2xl mt-2" id="totaldocument"></p>
                    </div>
                    <div class="bg-[#E2E8F0] p-6 rounded-lg shadow hover:shadow-lg transition">
                        <h2 class="text-gray-600 font-bold">Total Recipients</h2>
                        <p class="text-gray-800 text-2xl mt-2" id="totalrecipent"></p>
                    </div>
                </section>

                <!-- Table Section -->
                <section class="mt-6 bg-white p-6 rounded-lg shadow">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-gray-700 font-bold">Clients</h2>
                        <div class="relative">
                            <input type="text" id="searchInput" placeholder="Search clients..." 
                                class="border rounded py-2 px-4 pr-10 focus:outline-none focus:ring-2 focus:ring-blue-500 w-64">
                            <span class="absolute right-3 top-2.5 text-gray-400">
                                <i class="fas fa-search"></i>
                            </span>
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full border-collapse border border-gray-200" id="clientTable">
                            <thead class="sticky top-0 bg-gray-200 z-10 border border-gray-300">
                                <tr class="bg-gray-100">
                                    <th class="border border-gray-300 p-2">ID</th>
                                    <th class="border border-gray-300 p-2">First Name</th>
                                    <th class="border border-gray-300 p-2">Last Name</th>
                                    <th class="border border-gray-300 p-2">Email</th>
                                    <th class="border border-gray-300 p-2">Mobile Number</th>
                                    <th class="border border-gray-300 p-2">Date of Joining</th>
                                    <th class="border border-gray-300 p-2">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Dynamically generated rows -->
                            </tbody>
                        </table>
                    </div>
                    <!-- Pagination -->
                    <div class="mt-4 flex justify-between items-center">
                        <div class="text-sm text-gray-600">
                            Showing <span id="startRecord">1</span> to <span id="endRecord">20</span> of <span id="totalRecords">0</span> entries
                        </div>
                        <div class="flex space-x-1">
                            <button id="prevPage" class="px-3 py-1 rounded border bg-gray-200 hover:bg-gray-300 disabled:opacity-50 disabled:cursor-not-allowed">
                                <i class="fas fa-chevron-left"></i>
                            </button>
                            <div id="paginationNumbers" class="flex space-x-1">
                                <!-- Pagination numbers generated dynamically -->
                            </div>
                            <button id="nextPage" class="px-3 py-1 rounded border bg-gray-200 hover:bg-gray-300 disabled:opacity-50 disabled:cursor-not-allowed">
                                <i class="fas fa-chevron-right"></i>
                            </button>
                        </div>
                    </div>
                </section>
            </main>
        </div>
    </div>
    @include('components.toast')

    <script>
        // Global variables for pagination and search
        let allUsers = [];
        let currentPage = 1;
        let usersPerPage = 20;
        let filteredUsers = [];
        let totalPages = 0;

        document.addEventListener("DOMContentLoaded", () => {
            fetchLoggedInUser();
            fetchUsers();

            // Add event listener for search input
            document.getElementById('searchInput').addEventListener('input', handleSearch);
            
            // Add event listeners for pagination
            document.getElementById('prevPage').addEventListener('click', () => navigateToPage(currentPage - 1));
            document.getElementById('nextPage').addEventListener('click', () => navigateToPage(currentPage + 1));
        });

        // Sidebar Toggle Functionality
        const sidebar = document.getElementById("sidebar");
        const sidebarToggle = document.getElementById("sidebarToggle");
        const toggleArrow = document.getElementById("toggleArrow");
        const sidebarText = document.querySelectorAll(".sidebar-text");

        sidebarToggle.addEventListener("click", () => {
            sidebar.classList.toggle("w-48");
            sidebar.classList.toggle("w-16");
            toggleArrow.classList.toggle("rotate-180");
            sidebarText.forEach((text) => text.classList.toggle("hidden"));
        });

        // Search functionality
        function handleSearch(e) {
            const searchTerm = e.target.value.toLowerCase();
            
            // Filter users based on search term
            filteredUsers = allUsers.filter(user => 
                user.id.toString().includes(searchTerm) ||
                user.firstname.toLowerCase().includes(searchTerm) ||
                user.lastname.toLowerCase().includes(searchTerm) ||
                user.email.toLowerCase().includes(searchTerm) ||
                user.phone.toLowerCase().includes(searchTerm)
            );
            
            // Reset to first page when searching
            currentPage = 1;
            
            // Update table with filtered results
            updateTable();
        }

        // Pagination navigation
        function navigateToPage(pageNumber) {
            if (pageNumber >= 1 && pageNumber <= totalPages) {
                currentPage = pageNumber;
                updateTable();
            }
        }

        // Generate pagination numbers
        function generatePaginationControls() {
            const paginationContainer = document.getElementById('paginationNumbers');
            paginationContainer.innerHTML = '';
            
            // Calculate total pages
            totalPages = Math.ceil(filteredUsers.length / usersPerPage);
            
            // Enable/disable prev/next buttons
            document.getElementById('prevPage').disabled = currentPage === 1;
            document.getElementById('nextPage').disabled = currentPage === totalPages || totalPages === 0;
            
            // Calculate which page numbers to show
            let startPage = Math.max(1, currentPage - 2);
            let endPage = Math.min(totalPages, startPage + 4);
            
            if (endPage - startPage < 4 && totalPages > 5) {
                startPage = Math.max(1, endPage - 4);
            }
            
            // Add "1" and ellipsis if needed
            if (startPage > 1) {
                addPageButton(1);
                if (startPage > 2) {
                    addEllipsis();
                }
            }
            
            // Add page numbers
            for (let i = startPage; i <= endPage; i++) {
                addPageButton(i);
            }
            
            // Add ellipsis and last page if needed
            if (endPage < totalPages) {
                if (endPage < totalPages - 1) {
                    addEllipsis();
                }
                addPageButton(totalPages);
            }
            
            // Update records info
            const start = (currentPage - 1) * usersPerPage + 1;
            const end = Math.min(currentPage * usersPerPage, filteredUsers.length);
            document.getElementById('startRecord').textContent = filteredUsers.length > 0 ? start : 0;
            document.getElementById('endRecord').textContent = end;
            document.getElementById('totalRecords').textContent = filteredUsers.length;
        }
        
        function addPageButton(pageNum) {
            const paginationContainer = document.getElementById('paginationNumbers');
            const button = document.createElement('button');
            button.textContent = pageNum;
            button.classList.add('px-3', 'py-1', 'rounded', 'border');
            
            if (pageNum === currentPage) {
                button.classList.add('bg-blue-500', 'text-white');
            } else {
                button.classList.add('bg-gray-200', 'hover:bg-gray-300');
            }
            
            button.addEventListener('click', () => navigateToPage(pageNum));
            paginationContainer.appendChild(button);
        }
        
        function addEllipsis() {
            const paginationContainer = document.getElementById('paginationNumbers');
            const ellipsis = document.createElement('span');
            ellipsis.textContent = '...';
            ellipsis.classList.add('px-3', 'py-1', 'text-gray-600');
            paginationContainer.appendChild(ellipsis);
        }

        // Fetch Logged-In User Data
        function fetchLoggedInUser() {
            fetch("/api/logged-in-user")
                .then((response) => response.json())
                .then((data) => {
                    document.getElementById("firstName").value = data.firstname;
                    document.getElementById("lastName").value = data.lastname;
                    document.getElementById("email").value = data.email;
                    document.getElementById("phoneNumber").value = data.phone;
                })
                .catch((error) => console.error("Error fetching user data:", error));
        }

        // Fetch and Display Users
        function fetchUsers() {
            fetch("/api/users")
                .then((response) => response.json())
                .then((data) => {
                    // Store all users
                    allUsers = data.users;
                    filteredUsers = [...allUsers];
                    
                    // Update table with first page of data
                    updateTable();
                    
                    // Update stats
                    document.getElementById("totalclient").textContent = data.users.length;
                    document.getElementById("totaldocument").textContent = data.totalDocuments;
                    document.getElementById("totalrecipent").textContent = data.totalRecipients;
                })
                .catch((error) => console.error("Error fetching users:", error));
        }
        
        // Update table with current page data
        function updateTable() {
            const clientTable = document.querySelector("#clientTable tbody");
            clientTable.innerHTML = "";
            
            const startIndex = (currentPage - 1) * usersPerPage;
            const endIndex = Math.min(startIndex + usersPerPage, filteredUsers.length);
            const currentPageUsers = filteredUsers.slice(startIndex, endIndex);
            
            if (currentPageUsers.length === 0) {
                const row = document.createElement("tr");
                row.innerHTML = `<td colspan="7" class="border border-gray-300 p-4 text-center text-gray-500">No matching records found</td>`;
                clientTable.appendChild(row);
            } else {
                currentPageUsers.forEach((client) => {
                    const row = document.createElement("tr");
                    row.innerHTML = `
                    <td class="border border-gray-300 p-2">${client.id}</td>
                    <td class="border border-gray-300 p-2">${client.firstname}</td>
                    <td class="border border-gray-300 p-2">${client.lastname}</td>
                    <td class="border border-gray-300 p-2">${client.email}</td>
                    <td class="border border-gray-300 p-2">${client.phone}</td>
                    <td class="border border-gray-300 p-2">${new Date(client.created_at).toLocaleDateString()}</td>
                    <td class="border border-gray-300 p-2 flex justify-center gap-4">
                        <button class="bg-green-500 text-white px-2 py-1 rounded hover:bg-green-600 edit-button" data-id="${client.id}">
                        <i class="fas fa-info-circle"></i>
                        </button>
                        <button class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600 delete-button" data-id="${client.id}">
                        <i class="fas fa-trash-alt"></i>
                        </button>
                    </td>`;
                    clientTable.appendChild(row);
                });
            }
            
            // Add event listeners to buttons
            document.querySelectorAll(".delete-button").forEach((button) =>
                button.addEventListener("click", () => {
                    const clientId = button.getAttribute("data-id");
                    deleteUser(clientId);
                })
            );
            
            document.querySelectorAll(".edit-button").forEach((button) => {
                button.addEventListener("click", () => {
                    const userId = button.getAttribute("data-id");
                    const routeUrl = `{{ route('user.details', ':id') }}`.replace(':id', userId);
                    window.location.href = routeUrl;
                });
            });
            
            // Update pagination controls
            generatePaginationControls();
        }

        // Delete User
        function deleteUser(clientId) {
            if (confirm("Are you sure you want to delete this user?")) {
                fetch(`/api/users/${clientId}`, {
                        method: "DELETE",
                        headers: {
                            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
                        },
                    })
                    .then((response) => {
                        if (response.ok) {
                            showToast("User deleted successfully.");
                            // Remove user from array and update table
                            allUsers = allUsers.filter(user => user.id != clientId);
                            filteredUsers = filteredUsers.filter(user => user.id != clientId);
                            
                            // Check if current page is now empty
                            if (currentPage > 1 && (currentPage - 1) * usersPerPage >= filteredUsers.length) {
                                currentPage--;
                            }
                            
                            updateTable();
                        } else {
                            showToast("Failed to delete user.");
                        }
                    })
                    .catch((error) => {
                        console.error("Error deleting user:", error);
                        showToast("Error deleting user. Please try again.");
                    });
            }
        }
    </script>
</body>

</html>