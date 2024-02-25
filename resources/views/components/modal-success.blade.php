
@props(['text' => ''])


<div id="success-modal" tabindex="-1" class="overflow-y-auto  h-screen overflow-x-hidden fixed top-0 flex z-50 justify-center items-center w-full max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full animate-modal-alert">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">

            <div class="p-4 md:p-5 text-center">
                    {!! $slot !!}
                   
                <h3 class="mb-5 text-lg font-normal text-gray-800 dark:text-gray-400">{{ $text }}</h3>
            </div>
        </div>
    </div>
</div>
