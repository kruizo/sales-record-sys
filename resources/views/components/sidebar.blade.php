<aside id="logo-sidebar" class="fixed  top-0 left-0 z-40 w-64 h-screen  transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700" aria-label="Sidebar">
    <div class="px-3  py-5 ">
        <a href="#" class="flex">
            <img src="{{ asset('assets/image/logo.png')}}" class="h-12 me-3" alt="Adelfor Logo" />
            <div class="w-full text-gray-700">
                <span class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap dark:text-white">
                    Adelflor
                </span>
                <p>Water Refilling Station</p>
            </div>


        </a>
    </div>
    <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">

        <ul class="space-y-2 font-medium">
            <li>
                <a data-section="dashboard" href="{{ route('admin.dashboard') }}" class="sidebar-link hover:cursor-pointer flex items-center p-2 text-gray-600 rounded-lg hover:border-l-2 hover:border-blue-700 ">
                    <svg id="sidebar-icon" class="w-5 h-5  transition duration-75 dark:text-gray-400 group- dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
                        <path d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z" />
                        <path d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z" />
                    </svg>
                    <span class="ms-3">Overview</span>
                </a>
            </li>
            <li>
                <button type="button" class="flex items-center w-full p-2 text-base text-gray-600 transition duration-75 rounded-lg group hover:border-l-2 hover:border-blue-700 " aria-controls="dropdown-example" data-collapse-toggle="dropdown-example">
                    <i class="fa fa-bar-chart" style="font-size:19px;" class=" text-gray-500"></i>
                    <span id="sidebar-icon" class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap ">Analytics</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                    </svg>
                </button>
                <ul id="dropdown-example" class="hidden hover:cursor-pointer py-2 space-y-2">
                    <li>
                        <a href="#" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Customers</a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Sales</a>
                    </li>

                </ul>
            </li>
            <li>
                <a data-section="orders" href="{{ route('admin.orders') }}" class="sidebar-link hover:cursor-pointer flex items-center p-2 text-gray-600 rounded-lg hover:border-l-2 hover:border-blue-700  group">
                    <i id="sidebar-icon" class="fas fa-shopping-cart" class=" "></i>
                    <span class="flex-1 ms-3 whitespace-nowrap ">Orders</span>
                </a>
            </li>
            <li>
                <a data-section="delivery" href="{{ route('admin.delivery') }}" class="sidebar-link hover:cursor-pointer flex items-center text-gray-600 p-2 rounded-lg hover:border-l-2 hover:border-blue-700  group">
                    <i id="sidebar-icon" class='fas fa-shipping-fast' aria-hidden="true" class=" "></i>
                    <span class="flex-1 ms-3 whitespace-nowrap ">Deliveries</span>
                    <!-- <span class="inline-flex items-center justify-center w-3 h-3 p-3 ms-3 text-sm font-medium text-blue-800 bg-blue-100 rounded-full dark:bg-blue-900 dark:text-blue-300">3</span> -->
                </a>
            </li>
            <li>
                <a data-section="customers" href="{{ route('admin.customers') }}" class="sidebar-link hover:cursor-pointer flex items-center p-2 text-gray-600 rounded-lg hover:border-l-2 hover:border-blue-700  group">
                    <svg id="sidebar-icon" class="flex-shrink-0 w-5 h-5 transition duration-75 dark:text-gray-400 group- dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                        <path d="M14 2a3.963 3.963 0 0 0-1.4.267 6.439 6.439 0 0 1-1.331 6.638A4 4 0 1 0 14 2Zm1 9h-1.264A6.957 6.957 0 0 1 15 15v2a2.97 2.97 0 0 1-.184 1H19a1 1 0 0 0 1-1v-1a5.006 5.006 0 0 0-5-5ZM6.5 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9ZM8 10H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Z" />
                    </svg>
                    <span class="flex-1 ms-3 whitespace-nowrap ">Customers</span>
                </a>
            </li>
            <li>
                <a data-section="reports" href="{{ route('admin.reports') }}" class="sidebar-link hover:cursor-pointer flex items-center p-2 text-gray-600 rounded-lg hover:border-l-2 hover:border-blue-700  group">
                    <svg id="sidebar-icon" class="flex-shrink-0 w-5 h-5  transition duration-75 dark:text-gray-400 group- dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 20">
                        <path d="M17 5.923A1 1 0 0 0 16 5h-3V4a4 4 0 1 0-8 0v1H2a1 1 0 0 0-1 .923L.086 17.846A2 2 0 0 0 2.08 20h13.84a2 2 0 0 0 1.994-2.153L17 5.923ZM7 9a1 1 0 0 1-2 0V7h2v2Zm0-5a2 2 0 1 1 4 0v1H7V4Zm6 5a1 1 0 1 1-2 0V7h2v2Z" />
                    </svg>
                    <span class="flex-1 ms-3 whitespace-nowrap ">Reports</span>
                </a>
            </li>

        </ul>
    </div>
</aside>