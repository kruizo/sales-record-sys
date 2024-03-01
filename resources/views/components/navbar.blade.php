<nav id="navbar"
    {{ $attributes->merge(['class' => 'backdrop-blur-lg transition-all sm:fixed z-20 bg-transparent text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 py-6']) }}>
    <div class="max-w-screen-2xl flex flex-wrap items-center justify-between mx-auto p-4 sm:px-20">
        <div class="flex items-center ">
            <button data-collapse-toggle="navbar-sticky" type="button"
                class="md:hidden mr-2 inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg hover:text-blue-500 aria-controls="navbar-sticky"
                aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <svg class="w-10 h-10" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 17 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M1 1h15M1 7h15M1 13h15" />
                </svg>
            </button>

            <a href="{{ route('/') }}" class="items-center space-x-3 rtl:space-x-reverse flex">
                <img src="{{ asset('assets/image/logo.png') }}" alt="logo" class="w-10 object-cover" srcset="">
                <span
                    class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white text-gray-300 font-raleway">adelflor.xyz</span>
            </a>
        </div>

        <div class="md:order-2 space-x-3 md:flex md:space-x-0 rtl:space-x-reverse">
            @guest
                @if (Route::has('login'))
                    <button type="button" data-modal-target="authentication-modal" data-modal-toggle="authentication-modal"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Login</button>
                @endguest
            @else
                @auth
                    <div class="flex items-center md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
                        <div class="flex justify-end items-center gap-2 text-gray-300">

                            <button type="button"
                                class="flex text-sm items-center font-poppins font-semibold rounded-full md:me-0 dark:focus:ring-gray-600"
                                id="user-menu-button2" aria-expanded="false" data-dropdown-toggle="user-dropdown"
                                data-dropdown-placement="bottom">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle hidden lg:block" href="#"
                                    role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    @if (Auth::user()->registeredcustomer && Auth::user()->registeredcustomer->customer->firstname)
                                        Hi {{ Auth::user()->registeredcustomer->customer->firstname }}
                                    @else
                                        {{ Auth::user()->email }}
                                    @endif
                                </a>

                                <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 10 6">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 4 4 4-4" />
                                </svg>
                            </button>
                        </div>

                        <div class="z-50 hidden my-4 text-base list-none bg-gray-900 divide-y divide-gray-600 rounded-lg shadow dark:bg-gray-700 dark:divide-gray-600"
                            id="user-dropdown">
                            <div class="px-4 py-3">
                                @if (Auth::user()->registeredcustomer)
                                    <span class="block text-sm text-gray-300 dark:text-white">
                                        {{ Auth::user()->fullname() }}
                                    </span>
                                @endif
                                <span
                                    class="block text-sm  text-gray-300 truncate dark:text-gray-400">{{ Auth::user()->email }}</span>
                            </div>
                            <ul class="py-2" aria-labelledby="user-menu-button">
                                <li>
                                    <a href="{{ route('profile') }}"
                                        class="block px-4 py-2 text-sm text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Profile</a>
                                </li>
                                <li>
                                    <a href="{{ route('profile/myorders') }}"
                                        class="block px-4 py-2 text-sm text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">My
                                        orders</a>
                                </li>
                                <li>
                                    <a href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                            document.getElementById('logout-form').submit();"
                                        class="block px-4 py-2 text-sm text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Sign
                                        out</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                @endauth
            @endif
        </div>
        <div class="absolute top-24 md:top-0 items-center justify-between bg-gray-900 sm:bg-transparent hidden w-1/2 rounded-lg md:relative md:flex md:w-auto md:order-1"
            id="navbar-sticky">
            <ul
                class="flex font-poppins flex-col p-4 md:p-0 font-medium bg-gray-900 sm:bg-transparent rounded-lg  md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 ">
                <li>
                    <a href="{{ route('/') }}#home"
                        class=" block py-2 px-3 hover:hover:text-blue-500 text-gray-300 rounded bg-gray-900 md:bg-transparent sm:hover:text-blue-600 md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500">Home</a>
                </li>
                <li>
                    <a href="{{ route('/') }}#services"
                        class="block py-2 px-3 text-gray-300 hover:hover:text-blue-500 bg-gray-900 rounded md:bg-transparent sm:hover:text-blue-600 md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500">Services</a>
                </li>
                <li>
                    <a href="{{ route('/') }}#about"
                        class="block py-2 px-3 text-gray-300 hover:hover:text-blue-500 bg-gray-900 rounded md:bg-transparent sm:hover:text-blue-600 md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500">About</a>
                </li>
                <li>
                    <a href="{{ route('/') }}#contact"
                        class="block py-2 px-3 text-gray-300 hover:hover:text-blue-500 bg-gray-900 rounded md:bg-transparent sm:hover:text-blue-600 md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500">Contact</a>
                </li>
            </ul>
        </div>
    </div>
    </div>

</nav>
