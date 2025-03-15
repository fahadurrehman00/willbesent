<header class="bg-[#f47d61] shadow-lg px-6 py-4 flex justify-between items-center">
    <div class="flex items-center">
        <img src="{{ asset('images/WBS-Logo.png') }}" alt="Profile" class="h-14" />
    </div>

    <div class="relative">
        <button id="dropdownButton" class="flex items-center gap-2 transition">
            <img src="{{ optional(auth()->user())->profile_image ? asset('storage/' . auth()->user()->profile_image) : asset('images/user.png') }}"
                alt="Profile" class="w-8 h-8 rounded-full" />
            <span class="font-medium text-gray-100">
                {{ Auth::user()->firstname }} {{ Auth::user()->lastname }}
            </span>
        </button>

        <!-- Dropdown Menu -->
        <div id="dropdownMenu" class="hidden absolute right-0 mt-2 w-48 bg-white shadow-lg rounded-lg overflow-hidden">
            <a href="/dashboard" class="block px-4 py-2 hover:bg-gray-200">
                <i class="fas fa-tachometer-alt text-green-500 mr-4"></i>My Dashboard
            </a>
            <a href="{{ route('user.profile') }}" id="myAccountLink" class="block px-4 py-2 hover:bg-gray-200">
                <i class="fas fa-user text-blue-500 mr-4"></i>My Account
            </a>

            <form method="POST" action="{{ route('logout') }}" class="block">
                @csrf
                <a href="route('logout')"
                    class="block px-4 py-2 hover:bg-gray-200 text-red-500 transition-all duration-300"
                    onclick="event.preventDefault(); this.closest('form').submit();">
                    <i class="fas fa-sign-out-alt text-red-500 mr-4"></i>{{ __('Log Out') }}
                </a>
            </form>
        </div>
    </div>
</header>

<script>
    document.getElementById("dropdownButton").addEventListener("click", () => {
        document.getElementById("dropdownMenu").classList.toggle("hidden");
    });
</script>
