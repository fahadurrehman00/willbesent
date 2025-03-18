<header class="bg-[#415a77] shadow-lg px-6 py-4 flex justify-between items-center">
    <div class="flex items-center">
        <img src="{{ asset('images/WBS-Logo.png') }}" alt="Logo" class="h-14" />
    </div>
    <div class="flex items-center gap-4">
        <div>
            <p class="text-gray-100 font-medium hidden md:block">
                Welcome Back!
            </p>
            <span class="font-bold text-white">
                {{ Auth::check() ? Auth::user()->firstname . ' ' . Auth::user()->lastname : 'Guest' }}
            </span>
        </div>
        <img src="{{ Auth::check() && Auth::user()->profile_image ? asset('images/userProfile/' . Auth::user()->profile_image) : asset('images/user.png') }}" 
             alt="User Profile" 
             class="w-14 h-14 rounded-full object-cover"/>
        <!-- <img src="{{ auth()->user() && auth()->user()->profile_image ? asset('storage/' . auth()->user()->profile_image) : asset('images/user.png') }}"
        alt="Profile" class="w-14 h-14 rounded-full" /> -->
    </div>
</header>
