@extends('layouts.app')

@section('title')
<title>Adelflor</title>
@endsection
@section('content')
<div class="z-10 p-6 dark:bg-gray-950 min-h-screen sm:p-28">
        <x-section-header text="Your orders" />
        
    <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown" class="text-blue-600 h-fit mb-4 focus:outline-none  font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
        {{ $status ??'In progress'}} 
        <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
        </svg>
        </button>
        
        <!-- Dropdown menu -->
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
        <section id="item-list" class="w-full lg:w-4/6 space-y-3">
            @foreach ($orders  as $order)

            @foreach ($order->orderline as $orderline)
            <div class=" bg-gray-900 px-4 hover:cursor-pointer" id="item-{{$orderline->id}}" onclick="handleOrderLineClick({{ json_encode($order) }}, {{ json_encode($orderline) }})">
                <div class="flex items-center h-fit py-2">
                    <img src="{{ asset('assets/image/container1.png') }}" alt="" class="object-contain h-36 pt-3" draggable="false">
            
                    <div class="flex justify-between w-full">
                        <div class="flex flex-col justify-start h-full w-full md:w-1/4 ml-4">
                            <strong>
                                <h1 class="text-3xl">{{$orderline->water->name}}</h1>
                            </strong>
                            <h1 class="text-blue-600 text-2xl">₱{{$orderline->subtotal}}</h1>
                            <h1 class="text-xl w-full">{{$orderline->delivery->deliverystatus->status}}</h1>
                        </div>
                        <div class="justify-between hidden md:flex h-full space-x-4 w-1/2 ">
                            <div class="space-y-4 text-center">
                                <h1 class="text-lg">Quantity</h1>
                                <h1 class="text-xl">{{$orderline->quantity}}</h1>
                            </div>
                            <div class="space-y-4 text-center">
                                <h1 class="text-lg">Price</h1>
                                <h1 class="text-xl">₱{{$orderline->water->cost}}</h1>
                            </div>
                            <div class="space-y-4 text-center">
                                <h1 class="text-lg">Total</h1>
                                <h1 class="text-xl">₱{{$orderline->subtotal}}</h1>
                            </div>
                        </div>
                
                    </div>
                </div>
                {{-- <div class="px-5">
                    <h1 class="text-xl">Order Information</h1>
                <div class="grid grid-cols-2 space-y-1 py-5 w-full">
                    <h2 id="order-number-label">Order Number:</h2>
                    <h2 id="order-number">{{ $recent->id }}</h2>
        
                    <h2 id="date-ordered-label">Date ordered:</h2>
                    <h2 id="date-ordered">{{ $recent->created_at->format('m/d/y') }}</h2>
        
                    <h2 id="delivery-date-label">Delivery Date:</h2>
                    <h2 id="delivery-date">{{ optional($recent->delivery)->delivery_date->format('m/d/y') }}</h2>
        
                    <h2 id="delivery-address-label">Delivery Address:</h2>
                    <h2 id="delivery-address">{{ optional($recent->delivery)->delivery_address }}</h2>
        
                    <h2 id="delivery-status-label">Delivery Status:</h2>
                    <h2 id="delivery-status">{{ optional($recent->delivery)->delivery_status }}</h2>
        
                    <h2 id="payment-type-label">Mode of Payment:</h2>
                    <h2 id="payment-type">{{ $recent->payment_type }}</h2>
                </div>
                <x-button-link text="Cancel Order" class="text-red-600 p-0" />
                </div> --}}

            </div>
            
            @endforeach
            
            @endforeach
           
        </section>
        @if ($orders)  
        <aside class="min-w-1/3 w-1/3 max-w-1/3 hidden lg:block" id="order-information">
            <div class="sticky top-32 bg-gray-900 p-4">
                <h1 class="text-xl">Order Information</h1>
                <div class="grid grid-cols-2 space-y-1 py-5 w-full">
                    <h2 id="order-number-label">Order Number:</h2>
                    <h2 id="order-number">{{ $recent->id }}</h2>
        
                    <h2 id="date-ordered-label">Date ordered:</h2>
                    <h2 id="date-ordered">{{ $recent->created_at->format('m/d/y') }}</h2>
        
                    <h2 id="delivery-date-label">Delivery Date:</h2>
                    <h2 id="delivery-date">{{ $recent->delivery->delivery_date}} </h2>
                    
                    <h2 id="delivery-address-label">Delivery Address:</h2>
                    <h2 id="delivery-address">{{ $recent->delivery->delivery_address }}</h2>
                    
                    <h2 id="delivery-status-label">Delivery Status:</h2>
                    <h2 id="delivery-status">{{ $recent->delivery->getStatusText() }}</h2>
                    
                    <h2 id="payment-type-label">Mode of Payment:</h2>
                    <h2 id="payment-type">{{ $recent->payment_type }}</h2>
                </div>
                <x-button-link text="Cancel Order" href="{{$recent->id}}" class="text-red-600 p-0" />
            </div>
        </aside>
        @endif
    </div>
</div>
<script src="{{ asset('assets/js/myorders.js') }}"></script>
@endsection