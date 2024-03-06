@if (session('success'))
    <x-modal.modal-success text="{{ session('success') }}">
        <slot name="icon" class="flex justify-center">
            <svg class="fill-green-400" width="50px" height="50px" viewBox="0 0 30 30" fill="none"
                xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd">
                <path
                    d="M12 0c6.623 0 12 5.377 12 12s-5.377 12-12 12-12-5.377-12-12 5.377-12 12-12zm0 1c6.071 0 11 4.929 11 11s-4.929 11-11 11-11-4.929-11-11 4.929-11 11-11zm7 7.457l-9.005 9.565-4.995-5.865.761-.649 4.271 5.016 8.24-8.752.728.685z" />
            </svg>
        </slot>
    </x-modal.modal-success>
@endif
@if (session('error'))
    <x-modal.modal-success text="{{ session('error')}}">
        <slot name="icon" class="flex justify-center">
            <svg class="fill-red-500" clip-rule="evenodd" fill-rule="evenodd" height="50px" width="50px"
                stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 30 30" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="m12.002 2.005c5.518 0 9.998 4.48 9.998 9.997 0 5.518-4.48 9.998-9.998 9.998-5.517 0-9.997-4.48-9.997-9.998 0-5.517 4.48-9.997 9.997-9.997zm0 1.5c-4.69 0-8.497 3.807-8.497 8.497s3.807 8.498 8.497 8.498 8.498-3.808 8.498-8.498-3.808-8.497-8.498-8.497zm0 7.425 2.717-2.718c.146-.146.339-.219.531-.219.404 0 .75.325.75.75 0 .193-.073.384-.219.531l-2.717 2.717 2.727 2.728c.147.147.22.339.22.531 0 .427-.349.75-.75.75-.192 0-.384-.073-.53-.219l-2.729-2.728-2.728 2.728c-.146.146-.338.219-.53.219-.401 0-.751-.323-.751-.75 0-.192.073-.384.22-.531l2.728-2.728-2.722-2.722c-.146-.147-.219-.338-.219-.531 0-.425.346-.749.75-.749.192 0 .385.073.531.219z"
                    fill-rule="nonzero" />
            </svg>
        </slot>
    </x-modal.modal-success>
@endif
