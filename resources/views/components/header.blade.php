<header class="bg-[#f47d61] shadow-lg px-6 py-4 flex justify-between items-center">
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
        <img id="profileImage"
    src="{{ auth()->user()->profile_image 
        ? (Str::startsWith(auth()->user()->profile_image, 'http') 
            ? auth()->user()->profile_image 
            : asset('storage/' . auth()->user()->profile_image)) 
        : asset('images/user.png') }}" 
    alt="Profile" class="w-24 h-24 rounded-full" />

    </div>
</header>
