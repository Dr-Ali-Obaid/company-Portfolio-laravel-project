<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ url('/') }}" class="flex items-center text-decoration-none">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                        <span class="ms-3 font-bold text-lg text-gray-800 tracking-wider">
                            {{ __('Digital Horizons') }}
                        </span>
                    </a>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6 space-x-4">
                {{-- Language Switcher --}}
                <a href="{{ route('lang.switch', app()->getLocale() === 'ar' ? 'en' : 'ar') }}"
                    class="inline-flex items-center px-3 py-2 text-sm font-bold text-gray-500 hover:text-slate-800 transition duration-150">
                    @if (app()->getLocale() === 'ar')
                        <i class="fa-solid fa-globe me-2" style="color: #2EBBD3;"></i>
                        <span class="font-sans">English</span>
                    @else
                        @include('partials.arabic-icon')
                        <span class="ms-2">العربية</span>
                    @endif
                </a>

                {{-- User Dropdown --}}
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center focus:outline-none">
                            <div
                                class="flex items-center justify-center w-10 h-10 rounded-full bg-slate-500 text-white font-bold text-lg shadow-sm border-2 border-white hover:bg-slate-600 transition-all">
                                {{ mb_substr(Auth::user()->name, 0, 1, 'utf-8') }}
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">{{ __('Profile') }}</x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none transition duration-150">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden bg-gray-50 border-t border-gray-100">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>

            {{-- --- Start Management Links for Mobile --- --}}
            <div class="border-t border-gray-200 my-2"></div>
            <div class="px-4 py-2 text-xs font-semibold text-gray-400 uppercase tracking-wider">
                {{ __('Management') }}
            </div>

            <x-responsive-nav-link :href="route('admin.subscribers.index')" :active="request()->routeIs('admin.subscribers.*')">
                <i class="fa-solid fa-users me-2 text-gray-400"></i> {{ __('Subscribers') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('admin.newsletters.index')" :active="request()->routeIs('admin.newsletters.*')">
                <i class="fa-solid fa-envelope-open-text me-2 text-gray-400"></i> {{ __('Newsletters') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('admin.projects.index')" :active="request()->routeIs('admin.projects.index')">
                <i class="fa-solid fa-briefcase me-2 text-gray-400"></i> {{ __('Projects') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('admin.projects.create')" :active="request()->routeIs('admin.projects.create')">
                <i class="fa-solid fa-plus-circle me-2 text-gray-400"></i> {{ __('Add New Project') }}
            </x-responsive-nav-link>
            {{-- --- End Management Links --- --}}

            <div class="border-t border-gray-200 my-2"></div>

            {{-- Language Switcher Mobile --}}
            <x-responsive-nav-link :href="route('lang.switch', app()->getLocale() === 'ar' ? 'en' : 'ar')">
                <div class="flex items-center">
                    @if (app()->getLocale() === 'ar')
                        <i class="fa-solid fa-globe me-2 text-cyan-600"></i>
                        <span>English</span>
                    @else
                        @include('partials.arabic-icon')
                        <span class="ms-2">العربية</span>
                    @endif
                </div>
            </x-responsive-nav-link>
        </div>

        <div class="pt-4 pb-1 border-t border-gray-200 bg-white">
            <div class="flex items-center px-4">
                <div class="flex-shrink-0">
                    <div
                        class="flex items-center justify-center w-10 h-10 rounded-full bg-slate-500 text-white font-bold">
                        {{ mb_substr(Auth::user()->name, 0, 1, 'utf-8') }}
                    </div>
                </div>
                <div class="ms-3">
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
