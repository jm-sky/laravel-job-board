<header class="text-gray-600 body-font border-b border-gray-100">
    <div class="container mx-auto flex flex-wrap p-5 flex-col md:flex-row items-center">
        <x-logo-link />
        <nav class="md:ml-auto flex flex-wrap items-center text-base justify-center">
            @guest
                <a href="{{ route('login') }}" class="mr-5 btn-outline">Employers</a>
            @endguest
            @auth
            <div class="pr-4">
                <x-dropdown class="mr-4">
                    <x-slot name="trigger">
                        <a href="#" class="btn-outline">{{ \Auth::user()->name }}</a>
                    </x-slot>
                    <x-slot name="content">
                        <x-dropdown-link href="{{ route('dashboard') }}">Dashboard</x-dropdown-link>
                        <x-dropdown-link href="{{ route('logout') }}">Logout</x-dropdown-link>
                    </x-slot>
                </x-dropdown>
            </div>
            @endauth
        </nav>
        <a href="{{ route('listings.create') }}" class="inline-flex items-center bg-indigo-500 text-white border-0 py-1 px-3 focus:outline-none hover:bg-indigo-600 rounded text-base mt-4 md:mt-0">Post Job
            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 ml-1" viewBox="0 0 24 24">
                <path d="M5 12h14M12 5l7 7-7 7"></path>
            </svg>
        </a>
    </div>
</header>
