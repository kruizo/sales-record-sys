@props(['error' => 'Something went wrong :()' ])

<div id="toast-simple" class="animate-toast flex fixed top-40 left-0 right-0 mx-auto z-20 items-center w-full max-w-xs p-4 space-x-4 rtl:space-x-reverse text-gray-500 bg-gray-900 border border-red-600 divide-x rtl:divide-x-reverse divide-red-600 rounded-lg shadow " role="alert">
    <svg class="flex-shrink-0 text-red-600 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
    </svg>
    <div class="ps-4 text-sm font-normal text-red-600">{{ $error }}</div>
</div>