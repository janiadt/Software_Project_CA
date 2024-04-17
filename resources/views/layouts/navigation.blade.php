<nav x-data="{ open: false }" class="bg-purple border-b border-gray-100 drop-shadow-3xl">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="flex items-center">
                    <div class="lg:ms-10 ">
                        <a href="{{route('dashboard')}}" class="drop-shadow-3xl text-white no-underline text-3xl font-semibold">
                            {{ __('Solarray Control Panel') }}
                        </a>
                    </div>
                </div>
                
                
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div> Account </div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-100 hover:text-purple hover:bg-white focus:outline-none focus:bg-gray-100 focus:text-purple transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden" 
    {{-- If the user is a guest, make these unclickable and add a blur --}}
    @guest style="pointer-events: none; filter: blur(3px); background: rgb(28, 44, 136)" @endguest> 
        <div class="pt-2 pb-3 space-y-1 d-flex align-items-start flex-column">
            <a href="{{route('dashboard')}}"  class="drop-shadow-3xl w-100 no-underline text-center text-2xl align-self-center font-semibold text-gray-100 hover:text-purple hover:bg-white focus:outline-none focus:bg-gray-100 focus:text-purple transition duration-150 ease-in-out py-3">
                {{ __('Dashboard') }}
            </a>
            {{-- <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="drop-shadow-3xl w-100 no-underline text-center text-2xl align-self-center font-semibold text-gray-100 hover:text-purple hover:bg-white focus:outline-none focus:bg-gray-100 focus:text-purple transition duration-150 ease-in-out py-3">
                {{ __('Detailed Statistics') }}
            </x-responsive-nav-link> --}}
            <a href="{{route('panels.index')}}"  class="drop-shadow-3xl w-100 no-underline text-center text-2xl align-self-center font-semibold text-gray-100 hover:text-purple hover:bg-white focus:outline-none focus:bg-gray-100 focus:text-purple transition duration-150 ease-in-out py-3">
                {{ __('Solar Panel Array') }}
            </a>
            <a href="{{route('profile.edit')}}"  class="drop-shadow-3xl w-100 no-underline text-center text-2xl align-self-center font-semibold text-gray-100 hover:text-purple hover:bg-white focus:outline-none focus:bg-gray-100 focus:text-purple transition duration-150 ease-in-out py-3">
                {{ __('Account') }}
            </a>
            {{-- Log out form --}}
            <form method="POST" action="{{ route('logout') }}" class="w-100 no-underline text-center text-2xl align-self-center font-semibold text-gray-100 hover:text-purple hover:bg-white focus:outline-none focus:bg-gray-100 focus:text-purple transition duration-150 ease-in-out py-3">
                @csrf
                <a class="drop-shadow-3xl no-underline text-gray-100 font-semibold text-gray-100 hover:text-purple  focus:outline-none focus:bg-gray-100 focus:text-purple transition duration-150 ease-in-out" href="{{route('profile.edit')}}" onclick="event.preventDefault();
                this.closest('form').submit();">
                    {{ __('Log Out') }}
                </a>
            </form>
            @auth
            @if (Auth::user()->user_type === "Developer")
            <a href="{{route('companies.index')}}"  class="drop-shadow-3xl w-100 no-underline text-center text-2xl align-self-center font-semibold text-gray-100 hover:text-purple hover:bg-white focus:outline-none focus:bg-gray-100 focus:text-purple transition duration-150 ease-in-out py-3">
                {{ __('Register Company') }}
            </a>
            @endif
            @endauth
        </div>
    </div>
</nav>
