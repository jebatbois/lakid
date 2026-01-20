<nav x-data="{ open: false }" class="sticky top-0 z-50 w-full transition-all duration-300 bg-white/80 backdrop-blur-md border-b border-gray-100/50 supports-[backdrop-filter]:bg-white/60">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="group flex items-center gap-2">
                        <img src="{{ asset('img/logo-kepri.png') }}" class="block h-9 w-auto transition transform group-hover:scale-110" alt="Logo">
                        <span class="font-bold text-lg tracking-tight text-gray-800 hidden md:block">LAKID<span class="text-blue-600">.</span></span>
                    </a>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" 
                        class="text-sm font-bold {{ request()->routeIs('dashboard') ? 'text-blue-600' : 'text-gray-500 hover:text-blue-600' }} transition">
                        {{ __('Dashboard') }}
                    </x-nav-link>

                    <x-nav-link :href="route('bantuan')" :active="request()->routeIs('bantuan')" 
                        class="text-sm font-bold {{ request()->routeIs('bantuan') ? 'text-blue-600' : 'text-gray-500 hover:text-blue-600' }} transition">
                        {{ __('Pusat Bantuan') }}
                    </x-nav-link>
                    
                    {{-- Opsional: Menu Admin tetap disisipkan jika login sebagai admin --}}
                    @if(Auth::user()->email === 'admin@lakid.kepri.prov.go.id')
                        <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')"
                            class="text-sm font-bold text-blue-600">
                            {{ __('Panel Admin') }}
                        </x-nav-link>
                    @endif
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-bold rounded-full text-gray-600 bg-gray-50 hover:bg-gray-100 hover:text-gray-900 focus:outline-none transition ease-in-out duration-150 gap-2">
                            {{-- Avatar Inisial (Gen-Z Style) --}}
                            <div class="w-8 h-8 rounded-full bg-gradient-to-tr from-blue-500 to-indigo-600 text-white flex items-center justify-center text-xs shadow-sm">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </div>
                            
                            <div class="hidden md:block">{{ Auth::user()->name }}</div>

                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')" class="hover:bg-blue-50 hover:text-blue-600 font-medium">
                            {{ __('Profil Saya') }}
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')" class="text-red-600 hover:bg-red-50 hover:text-red-700 font-medium"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Keluar Aplikasi') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-white border-b border-gray-100 shadow-lg">
        <div class="pt-2 pb-3 space-y-1 px-2">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="rounded-lg">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('bantuan')" :active="request()->routeIs('bantuan')" class="rounded-lg">
                {{ __('Pusat Bantuan') }}
            </x-responsive-nav-link>
        </div>

        <div class="pt-4 pb-4 border-t border-gray-200 bg-gray-50">
            <div class="px-4 mb-3">
                <div class="font-bold text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="space-y-1 px-2">
                <x-responsive-nav-link :href="route('profile.edit')" class="bg-white rounded-lg">
                    {{ __('Profil Saya') }}
                </x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')" class="text-red-600 bg-white rounded-lg mt-2"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Keluar Aplikasi') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>