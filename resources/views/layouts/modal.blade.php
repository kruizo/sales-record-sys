@props(['id' => '', 'logo' => false])

<div id="{{ $id }}" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">

        <div class="relative bg-gray-900 flex flex-col rounded-lg shadow ">
            @if ($logo)
                <img src="{{ asset('assets/image/logo.png') }}" alt="logo"
                    class="w-16 absolute left-0 right-0 m-auto -top-10" srcset="">
            @endif
            <button type="button"
                class="float-right text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center "
                data-modal-hide="authentication-modal">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
            </button>
            <div class="border-b border-gray-900 w-full">
                <ul class="flex flex-wrap justify-around -mb-px text-sm font-medium text-center" id="default-tab"
                    data-tabs-toggle="#default-tab-content" role="tablist">
                    <li class="me-2" role="presentation">
                        <button
                            class="inline-block p-4 border-b-2 rounded-t-lg  border-gray-900 hover:text-gray-600 hover:border-gray-500"
                            id="signin-tab" data-tabs-target="#signin" type="button" role="tab"
                            aria-controls="signin" aria-selected="true">Sign in</button>
                    </li>
                    <li class="me-2" role="presentation">
                        <button
                            class="inline-block p-4 border-b-2 rounded-t-lg border-gray-900 hover:text-gray-600 hover:border-gray-500"
                            id="register-tab" data-tabs-target="#register" type="button" role="tab"
                            aria-controls="register" aria-selected="false">Register</button>
                    </li>
                </ul>
            </div>
            <div class="p-5">
                @yield('content')
            </div>
        </div>
    </div>
</div>
