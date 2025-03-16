@extends('layouts.app')

@include('receipt', ['order' => $recent])


@section('title')
<title>Adelflor</title>
@endsection
@section('content')
<div class="z-10 p-6 dark:bg-gray-950 min-h-screen max-w-screen-xl mx-auto sm:py-40">
        <x-section-header text="Your orders" />
        
    <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown" class="text-blue-600 h-fit mb-4 focus:outline-none  font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
        {{ $status ? $status :'In progress'}} 
        <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
        </svg>
        </button>
        
        <div id="dropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
            <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
            <li>
                <a href="{{route('profile/myorders', ['filter&status=inprogress'])}}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">In progress</a>
            </li>
            <li>
                <a href="{{route('profile/myorders', ['filter&status=completed'])}}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Completed</a>
            </li>
            <li>
                <a href="{{route('profile/myorders', ['filter&status=cancelled'])}}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Cancelled</a>
            </li>
    
            </ul>
        </div>
    <div class="flex w-full h-full space-x-3">
        <section id="item-list" class="w-full lg:w-full space-y-3 transition-all ease-in-out">
            @if (!$orders->isEmpty())
                @foreach ($orders  as $order)
                <div class="hover:cursor-pointer space-y-2 border-l-4 border-gray-800 hover:border-blue-500" id="order-{{$order->id}}">
                    @foreach ($order->orderline as $orderline)
                    <div class=" shadow-lg px-4 hover:cursor-pointer h-28 bg-gray-900 border-gray-900 border overflow-hidden transition-all duration-200 ease-in-out" id="item-{{$orderline->id}}" onclick="handleOrderLineClick({{$order}},{{$orderline}})">
                        <div class="flex items-center h-full py-2">
                            <img src="{{ asset('assets/image/container1.png') }}" alt="" class="object-contain h-24 w-20 pt-3" draggable="false">
                    
                            <div class="flex justify-between w-full">
                                <div class="flex flex-col justify-start h-full w-full md:w-1/4 ml-4">
                                    <strong>
                                        <h1 class="text-xl">{{$orderline->water->name}}</h1>
                                    </strong>
                                    <h1 class="text-md w-full">Qty. x{{$orderline->quantity}}</h1>
                                    <h1 class="text-blue-600 text-xl">{{$orderline->delivery->deliverystatus->name}}</h1>
                                </div>
                                <div class="justify-between hidden md:flex h-full space-x-4 w-1/2 ">
                                    <div class="space-y-4 text-center">
                                        <h1 class="text-sm">Quantity</h1>
                                        <h1 class="text-xl">{{$orderline->quantity}}</h1>
                                    </div>
                                    <div class="space-y-4 text-center">
                                        <h1 class="text-sm">Price</h1>
                                        <h1 class="text-xl">₱{{$orderline->water->cost}}</h1>
                                    </div>
                                    <div class="space-y-4 text-center">
                                        <h1 class="text-sm">Total</h1>
                                        <h1 class="text-xl">₱{{$orderline->subtotal}}</h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="block w-full py-2" id="item-info-{{$orderline->id}}">
                            <div class="grid grid-cols-2 w-fit px-5">
                                    <h2 ">Order Number:</h2>
                                    <h2 >{{ $order->id }}</h2>

                                    <h2 >Reference Number:</h2>
                                    <h2 >{{ $orderline->id }}</h2>

                                    <h2 >Date ordered:</h2>
                                    <h2 >{{ $orderline->created_at->format('m/d/y') }}</h2>

                                    <h2 >Delivery Status:</h2>
                                    <h2 >{{ optional($orderline->delivery)->deliverystatus->description }}</h2>

                                    <h2 >Delivery Date:</h2>
                                    <h2 >{{ optional($orderline->delivery)->delivery_date->format('m/d/y') }}</h2>
                        
                                    <h2 >Delivery Address:</h2>
                                    <h2 >{{ optional($orderline->delivery)->delivery_address }}</h2>

                                    <h2 >Mode of Payment:</h2>
                                    <h2 >{{ $order->payment_type }}</h2>

                            </div>
                            <div onclick="event.stopPropagation();">
                                <x-button-link text="Cancel" :href="route('cancel.order', ['id' => $orderline->id])" class="float-right py-6 text-red-600"/>

                            </div>

                            {{-- <button id="deleteButton" data-modal-target="deleteModal" data-modal-toggle="deleteModal" class="deleteButton float-right mb-10 p-4 text-red-600 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 text-end" type="button">
                                Cancel
                            </button> --}}
                        </div>

                    </div>
                    @endforeach
                </div>
                @endforeach
            @else
                @php
                    $statusText = $status ? $status . ' orders' : 'orders';
                @endphp

                <div class="w-full px-2">
                    <h1>You have no {{lcfirst($statusText)}}</h1>
                </div>
            @endif
           
        </section>
        @if ($orders && $recent)  
        <aside class="min-w-1/3 w-1/3 max-w-1/3 hidden lg:block" id="order-information">
            <div class="sticky top-32 bg-gray-900 p-4">
                <h1 class="text-xl font-bold">Order Information</h1>
                <div class="grid grid-cols-2 space-y-1 py-5 w-full">
                    <h2 id="order-number-label">Order Number:</h2>
                    <h2 id="order-number">{{ $recent->id }}</h2>
                    <h2 id="order-total-label">Order Total:</h2>
                    <h2 id="order-total">₱{{ $recent->total }}</h2>
        
                    <h2 id="date-ordered-label">Date ordered:</h2>
                    <h2 id="date-ordered">{{ $recent->orderline->first()->created_at->format('m/d/y') }}</h2>
        
                    <h2 id="delivery-date-label">Delivery Date:</h2>
                    <h2 id="delivery-date">{{ $recent->orderline->first()->delivery->delivery_date}} </h2>
                    
                    <h2 id="delivery-address-label">Delivery Address:</h2>
                    <h2 id="delivery-address">{{ $recent->orderline->first()->delivery->delivery_address }}</h2>
                    
                    <h2 id="payment-type-label">Mode of Payment:</h2>
                    <h2 id="payment-type">{{ $recent->payment_type }}</h2>
                    @if ($recent->orderline->first()->delivery->delivery_status != 3)
                        {{-- <h2 id="delivery-status-label">Delivery Status:</h2>
                        <h2 id="delivery-status">{{ $recent->orderline->first()->delivery->deliverystatus->description }}</h2> --}}
                    
                </div>


                
                    <button id="generate-receipt" class="w-full my-4 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Generate Receipt
                    </button>


                <a href="{{$recent->orderline->first()->id}}" >
                    <x-button-primary text="Cancel Order" id="cancel-order-btn" class="rounded-lg text-gray-300 py-2 bg-transparent p-0 w-full border border-gray-300 hover:bg-transparent" />
                </a>
                @else
            </div>
            @endif
            </div>
        </aside>
        @endif
    </div>
</div>

    
<div id="receipt-modal" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-gray-300 rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-medium text-gray-900 dark:text-white">
                    Receipt
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="receipt-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-4 md:p-5 space-y-4">
                <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                    <div id="receipt-modal"></div>
                </p>
            </div>
            <!-- Modal footer -->
            <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                <button data-modal-hide="receipt-modal" type="button" class="w-full bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 ">Generate</button>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('assets/js/myorders.js') }}"></script>
<script src="../js/app.js"></script>
@endsection