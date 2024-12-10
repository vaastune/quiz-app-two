<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <!-- Existing code... -->

    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Existing Logo and Links... -->

                <!-- Additional Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <!-- Dashboard Link -->
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>

                    <!-- Quizzes by Category -->
                    <x-nav-link :href="route('quizzes.index')" :active="request()->routeIs('quizzes.index')">
                        {{ __('Quizzes by Category') }}
                    </x-nav-link>

                    <!-- My Quizzes (visible only to logged-in users) -->
                    @if(auth()->check())
                        <x-nav-link :href="route('my-quizzes')" :active="request()->routeIs('my-quizzes')">
                            {{ __('My Quizzes') }}
                        </x-nav-link>
                    @endif

                    <!-- Results -->
                    @if(auth()->check())
                        <x-nav-link :href="route('results.index')" :active="request()->routeIs('results.index')">
                            {{ __('Results') }}
                        </x-nav-link>
                    @endif

                    <!-- Create Quiz (only visible to admins) -->
                    @if(auth()->user()->is_admin)
                        <x-nav-link :href="route('quizzes.create')" :active="request()->routeIs('quizzes.create')">
                            {{ __('Create Quiz') }}
                        </x-nav-link>
                    @endif
                </div>
            </div>

            <!-- Existing Dropdown and Hamburger Menu... -->
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('quizzes.index')" :active="request()->routeIs('quizzes.index')">
                {{ __('Quizzes by Category') }}
            </x-responsive-nav-link>

            @if(auth()->check())
                <x-responsive-nav-link :href="route('my-quizzes')" :active="request()->routeIs('my-quizzes')">
                    {{ __('My Quizzes') }}
                </x-responsive-nav-link>
            @endif

            @if(auth()->check())
                <x-responsive-nav-link :href="route('results.index')" :active="request()->routeIs('results.index')">
                    {{ __('Results') }}
                </x-responsive-nav-link>
            @endif

            @if(auth()->user()->is_admin)
                <x-responsive-nav-link :href="route('quizzes.create')" :active="request()->routeIs('quizzes.create')">
                    {{ __('Create Quiz') }}
                </x-responsive-nav-link>
            @endif
        </div>

        <!-- Existing Responsive Settings Options... -->
    </div>
</nav>
