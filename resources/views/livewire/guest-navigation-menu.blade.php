<nav x-data="{ open: false }" class="bg-white shadow">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
      <div class="flex h-16 justify-between">
        <div class="flex">
          <div class="flex flex-shrink-0 items-center">
            <img class="h-8 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600" alt="Your Company">
          </div>
          <div class="hidden sm:ml-6 sm:flex sm:space-x-8">
            <x-nav-link href="{{ route('home') }}" :active="request()->routeIs('home')">
                {{ __('Home') }}
            </x-nav-link>
            <x-nav-link href="{{ route('products') }}" :active="request()->routeIs('products')">
                {{ __('Products') }}
            </x-nav-link>
            <x-nav-link href="{{ route('about') }}" :active="request()->routeIs('about')">
                {{ __('About') }}
            </x-nav-link>
            <x-nav-link href="{{ route('contact') }}" :active="request()->routeIs('contact')">
                {{ __('Contact') }}
            </x-nav-link>
          </div>
        </div>
        <div class="hidden sm:ml-6 sm:flex sm:items-center">
            @if (Route::has('login'))
                <div class="">
                    @auth
                        <a href="{{ url('/dashboard') }}" class=" text-gray-700 ">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class=" text-gray-700 ">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4  text-gray-700 ">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
        </div>
        <div class="-mr-2 flex items-center sm:hidden">
          <!-- Mobile menu button -->
          <button type="button" @click="open = ! open" class="relative inline-flex items-center justify-center rounded-md p-2 text-gray-400 hover:bg-gray-100 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500" aria-controls="mobile-menu" aria-expanded="false">
            <span class="absolute -inset-0.5"></span>
            <span class="sr-only">Open main menu</span>
            <!--
              Icon when menu is closed.

              Menu open: "hidden", Menu closed: "block"
            -->
            <svg class="block h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
            </svg>
            <!--
              Icon when menu is open.

              Menu open: "block", Menu closed: "hidden"
            -->
            <svg class="hidden h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>
        </div>
      </div>
    </div>

    <!-- Mobile menu, show/hide based on menu state. -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden lg:hidden divide-y-2 divide-gray-50" id="mobile-menu">
      <div class="space-y-1 pb-3 pt-2">
        <x-responsive-nav-link href="{{ route('home') }}" :active="request()->routeIs('home')">
            {{ __('Home') }}
        </x-responsive-nav-link>
        <x-responsive-nav-link href="{{ route('products') }}" :active="request()->routeIs('products')">
            {{ __('Products') }}
        </x-responsive-nav-link>
        <x-responsive-nav-link href="{{ route('about') }}" :active="request()->routeIs('about')">
            {{ __('About') }}
        </x-responsive-nav-link>
        <x-responsive-nav-link href="{{ route('contact') }}" :active="request()->routeIs('contact')">
            {{ __('Contact') }}
        </x-responsive-nav-link>

        @if (Route::has('login'))
                <div class="pb-3 space-y-6">
                    @auth
                    <x-responsive-nav-link href="{{ url('/dashboard') }}">
                        {{ __('Dashboard') }}
                    </x-responsive-nav-link>
                    @else
                        {{-- <a href="{{ route('login') }}" class=" text-gray-700 ">Log in</a> --}}

                        <x-responsive-nav-link href="{{ route('login') }}">
                            {{ __('Log in') }}
                        </x-responsive-nav-link>

                        @if (Route::has('register'))
                            <x-responsive-nav-link href="{{ route('register') }}">
                                {{ __('Register') }}
                            </x-responsive-nav-link>
                        @endif
                    @endauth
                </div>
            @endif
      </div>

    </div>
  </nav>
