<div id="edit-profile" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 bottom-0 left-0 z-50 justify-center items-center w-full">
    <div class="relative p-4 w-full max-w-xl">
        <div class="relative bg-gray-900 flex flex-col rounded-lg shadow ">
            <button type="button" data-modal-hide="edit-profile" class="float-right text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center " data-modal-hide="authentication-modal">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
            </button>
            
            <div class="p-5">
                <div class="w-full py-1">
                    <div class="w-full sm:max-w-xl sm:rounded-lg">
                    <form action="{{ route('customer.update', $customer->id) }}" method="POST">

                        @csrf
                        @method('PUT')  {{-- Spoofing PUT method --}}
                        <div class="items-center text-gray-400 space-y-4" >
                            <div>
                                <x-input-label for="first_name" text="First Name" class="text-gray-300 w-1/3" />
                                <x-input-text id="first_name" name="first_name" class="" value="{{$customer->firstname ?? ''}}" />
                            </div>
                            <div>
                                <x-input-label for="last_name" text="Last Name" class="text-gray-300 w-1/3" />
                                <x-input-text id="last_name" name="last_name" class="" value="{{$customer->lastname ?? ''}}" />
                            </div>
                            
                               
                            <div>
                                <x-input-label for="contact-number" text="Contact Number" class="text-gray-300 w-1/3" />
                                <x-input-text id="contact_number" name="contact_number" value="{{$customer->contactnum ?? ''}}" />
                            </div>
                            {{-- <div>
                                <x-input-label for="emailaccount" text="Email" class="text-gray-300 w-1/3" />
                                <div class="w-full h-fit items-center flex relative">
                                    <x-input-text id="emailaccount" name="email" value="{{Auth::user()->email}}" />
                                    @if (!Auth::user()->isVerified())
                                    <x-button-primary type="submit" text="Verify" class="w-24 bg-transparent absolute right-0 hover:bg-transparent text-blue-500" />
                                    @else
                                    <x-input-label text="Verified" class="absolute right-5 mt-1 text-green-500" />
                                    @endif
                                </div>
                            </div> --}}
                            <div>
                                <x-input-label for="street_address" text="Street address" class="text-gray-300 w-1/3" />
                                <x-input-text id="street_address" name="street_address" value="{{$customer->address->streetaddress ?? ''}}" />
                            </div>
                            <div>
                                <x-input-label for="province" text="Province" class="text-gray-300 w-1/3" />
                                <x-input-text id="province" name="province" value="{{$customer->address->province ?? ''}}" />
                            </div>
                            <div>
                                <x-input-label for="barangay" text="Barangay" class="text-gray-300 w-1/3" />
                                <x-input-text id="barangay" name="barangay" value="{{$customer->address->barangay ?? ''}}" />
                            </div>
                            <div>
                                <x-input-label for="city" text="City" class="text-gray-300 w-1/3" />
                                <x-input-text id="city" name="city" value="{{$customer->address->city ?? ''}}" />
                            </div>
                            <div>
                                <x-input-label for="zip" text="Postal / Zip" class="text-gray-300 w-1/3" />
                                <x-input-text id="zip" name="zip" value="{{$customer->address->zip ?? ''}}" />
                            </div>

                            <div class="flex justify-end">
                                <button type="submit" class="text-white bg-blue-700  hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-indigo-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-indigo-800">Save</button>
                            </div>
                        </div>
                        <input type="hidden" name="redirect_to" value="{{ route('/') }}">
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

