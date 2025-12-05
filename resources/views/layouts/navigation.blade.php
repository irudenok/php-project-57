<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('tasks.index')" :active="request()->routeIs('tasks.*')">
                        Задачи
                    </x-nav-link>
                    <x-nav-link :href="route('task_statuses.index')" :active="request()->routeIs('task_statuses.*')">
                        Статусы
                    </x-nav-link>
                    <x-nav-link :href="route('labels.index')" :active="request()->routeIs('labels.*')">
                        Метки
                    </x-nav-link>
                </div>
            </div>

            <!-- Logout Button -->
            @auth
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display: none;">
                    @csrf
                </form>
                <a href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                   class="text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 px-3 py-2 rounded-md text-sm font-medium">
                    {{ __('layouts.app.logout') }}
                </a>
            </div>
            @else
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <a href="{{ route('login') }}" class="text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 px-3 py-2 rounded-md text-sm font-medium">
                    {{ __('Log in') }}
                </a>
                <a href="{{ route('register') }}" class="ml-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    {{ __('Register') }}
                </a>
            </div>
            @endauth

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('tasks.index')" :active="request()->routeIs('tasks.*')">
                Задачи
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('task_statuses.index')" :active="request()->routeIs('task_statuses.*')">
                Статусы
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('labels.index')" :active="request()->routeIs('labels.*')">
                Метки
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Logout -->
        @auth
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 px-4">
                <form id="logout-form-mobile" method="POST" action="{{ route('logout') }}" style="display: none;">
                    @csrf
                </form>
                <a href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form-mobile').submit();"
                   class="block w-full text-left px-3 py-2 text-sm font-medium text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300">
                    {{ __('layouts.app.logout') }}
                </a>
            </div>
        </div>
        @else
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            <div class="px-4 space-y-1">
                <x-responsive-nav-link :href="route('login')">
                    {{ __('Log in') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('register')">
                    {{ __('Register') }}
                </x-responsive-nav-link>
            </div>
        </div>
        @endauth
    </div>
</nav>
