<nav id="sidebar"
    class="bg-[#415a77] text-gray-100 w-48 h-full flex-shrink-0 transition-all duration-300 flex flex-col justify-between">
    <div>
        <button id="sidebarToggle" class="text-white hover:scale-110 transition-all duration-300 p-4">
            <i id="toggleArrow" class="fas fa-arrow-left"></i>
        </button>
        <ul>
            <a href="{{ route('admin.dashboard') }}">
                <li id="dashboardLink"
                    class="hover:bg-gray-700 px-4 flex items-center gap-4 cursor-pointer transition-all duration-300">
                    <i class="fas fa-tachometer-alt text-green-500 text-lg py-2"></i>
                    <span class="sidebar-text">Dashboard</span>
                </li>
            </a>
            <a href="{{ route('admin.profile') }}">
                <li id="myAccountLink"
                    class="hover:bg-gray-700 px-4 flex items-center gap-4 cursor-pointer transition-all duration-300">
                    <i class="fas fa-user-circle text-blue-500 text-lg py-2"></i>
                    <span class="sidebar-text">My Account</span>
                </li>
            </a>
            <form method="POST" action="{{ route('logout') }}">
                <button type="submit" class="w-full">
                    <li id="logoutLink"
                        class="hover:bg-gray-700 px-4 flex items-center gap-4 cursor-pointer transition-all duration-300">
                        <i class="fas fa-sign-out-alt text-red-500 text-lg py-2"></i>
                        <span class="sidebar-text">
                            @csrf
                            Logout
                        </span>
                    </li>
                </button>
            </form>
        </ul>
    </div>
</nav>
