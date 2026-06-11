<nav class="bg-[#1565c0] border-b border-gray-200 sticky top-0 z-20">
    <div class="px-6 py-3 flex items-center justify-between">

        {{-- Left: hamburger + logo --}}
        <div class="flex items-center">
            <button class="text-white focus:outline-none mr-4" onclick="toggleSidebar()">
                <i class="fa-solid fa-bars text-xl"></i>
            </button>
            <div class="flex items-center">
                @if(file_exists(public_path('images/logo.png')))
                    <img src="{{ asset('images/logo.png') }}" alt="{{ config('app.name') }}" class="h-8">
                    <h1 class="text-white font-semibold ml-2 text-l">Touchstar Medical Enterprise Inc.</h1>
                @else
                    <div class="logo-placeholder">{{ substr(config('app.name', 'L'), 0, 1) }}</div>
                    <span class="ml-2 text-xl font-semibold text-white">{{ 'Laravel' }}</span>
                @endif
            </div>
        </div>

        {{-- Right: search + bell + avatar --}}
        <div class="flex items-center gap-3">

            {{-- Search --}}
            <div class="relative hidden md:block">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fa-solid fa-search text-gray-400"></i>
                </div>
                <input type="text" placeholder="Search..."
                       class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg
                              focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>

            {{-- ── CSAT Bell — single source of truth via include ── --}}
            @include('clientbar.csat-notification')

            {{-- Avatar --}}
            <div class="relative">
                <button class="flex items-center focus:outline-none space-x-2">
                    <div class="h-8 w-8 rounded-full overflow-hidden shadow-md">
                        @auth
                            @if(auth()->user()->profile_picture)
                                <img src="{{ asset('storage/' . auth()->user()->profile_picture) }}"
                                     alt="Profile Picture"
                                     class="h-full w-full object-cover">
                            @else
                                <div class="h-full w-full bg-gradient-to-r from-indigo-500 to-purple-600
                                            flex items-center justify-center text-white font-semibold text-sm">
                                    {{ auth()->user()->initials }}
                                </div>
                            @endif
                        @else
                            <div class="h-full w-full bg-gray-500 flex items-center justify-center
                                        text-white font-semibold text-sm">U</div>
                        @endauth
                    </div>
                    @auth
                        <p class="text-sm font-medium text-white">
                            {{ auth()->user()->first_name }} {{ auth()->user()->last_name }}
                        </p>
                    @endauth
                </button>
            </div>

        </div>
    </div>
</nav>

{{-- ── Notification sound ── --}}
<audio id="globalNotificationSound" preload="auto">
    <source src="https://cdn.pixabay.com/audio/2021/08/04/audio_0625c1539c.mp3" type="audio/mpeg">
</audio>