@extends('layouts.admin')
@section('title')
    <title>Dashboard</title>
@endsection
@section('content')
@if (session('success'))
    <x-modal-success text="{{ session('success') }}">
        <slot name="icon" class="flex justify-center">
            <svg class="fill-green-400" width="50px" height="50px" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd"><path d="M12 0c6.623 0 12 5.377 12 12s-5.377 12-12 12-12-5.377-12-12 5.377-12 12-12zm0 1c6.071 0 11 4.929 11 11s-4.929 11-11 11-11-4.929-11-11 4.929-11 11-11zm7 7.457l-9.005 9.565-4.995-5.865.761-.649 4.271 5.016 8.24-8.752.728.685z"/></svg>
        </slot>
    </x-modal-success>
@endif

<div class="overflow-hidden sm:ml-64 p-4 shadow-md sm:rounded-lg">


    <div class="flex gap-4 mb-10 justify-around flex-wrap">
        <x-sales-card id="order-card" title="Total Order" countId="order-text" count="{{$totalorder}}"/>
        <x-sales-card id="proft-card" title="Total Earnings" countId="profit-text" count="₱ {{$watersold->sum('subtotal')}}"/>
        <x-sales-card id="water-card" title="Waters Sold" countId="water-text" count="{{$watersold->sum('quantity')}}"/>
        <x-sales-card id="deliveries-card" title="Pending Deliveries Today " countId="deliveries-text" count="{{$deliveries->count()}}"/>

    </div>
    <div>
        <h1 class="text-xl text-black font-bold">You have <span class="text-green-600" id="order-count" >{{$data->count()}} </span>        
        @if (!$request->has('delivery') && !$request->has('status'))
             order(s) today
        @else
            filtered order(s)  
        @endif</h1>
    </div>
    <div class="flex items-center justify-between flex-column flex-wrap md:flex-row space-y-4 md:space-y-0 pb-4 bg-white dark:bg-gray-900">
        <div class="flex gap-10 justify-center items-center ">
            <div class="flex">
                <div class="flex items-center justify-center p-4">
                    <button id="dropdownActionButton" data-dropdown-toggle="dropdownAction" class="inline-flex items-center text-gray-500 bg-white border border-gray-300 focus:outline-none hover:bg-gray-200 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-3 py-1.5 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700" type="button">
                        <span class="sr-only">Action button</span>
                        Action
                        <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                        </svg>
                    </button>
                    <!-- Dropdown menu -->
                    <div id="dropdownAction" class="z-10 w-fit hidden bg-white divide-y p-4 border divide-gray-100 rounded-lg shadow dark:bg-gray-700 dark:divide-gray-600">
                        <ul class="py-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownActionButton">
                            <li>
                                <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Move to archive</a>
                            </li>
                            <li>
                                <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Mark as complete</a>
                            </li>
                        </ul>
            
                    </div>
                </div>
                <form action="{{route('admin.dashboard')}}" method="GET">
                    <div class="flex  ">
                        <div class="flex items-center justify-center p-4">
                            <button id="dropdownDefault" data-dropdown-toggle="dropdown"
                            class="text-gray-600 border focus:outline-none hover:bg-gray-200 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-4 py-2.5 text-center inline-flex items-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800"
                            type="button">
                            Filter by category
                            <svg class="w-4 h-4 ml-2" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                            </button>
                        
                            <!-- Dropdown menu -->
                            <div id="dropdown" class="z-10 hidden absolute w-56 p-4 border bg-white rounded-lg shadow dark:bg-gray-700">
                                <h6 class="mb-3 text-sm font-bold text-gray-900 dark:text-white">
                                    Delivery
                                </h6>
                                <ul class="space-y-2 text-sm" aria-labelledby="dropdownDefault">
                                    <li class="flex items-center">
                                        <input id="today" name="delivery[]" type="checkbox" value="today"
                                        class="category-checkbox w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" />
                                
                                        <label for="today" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">
                                        Today
                                        </label>
                                    </li>
                                    <li class="flex items-center">
                                    <input id="tomorrow" type="checkbox" name="delivery[]" value="tomorrow"
                                        class="category-checkbox w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" />
                            
                                    <label for="tomorrow" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">
                                        Tomorrow
                                    </label>
                                    </li>
                            
                                    <li class="flex items-center">
                                    <input id="week" type="checkbox" name="delivery[]" value="week"
                                        class="category-checkbox w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" />
                            
                                    <label for="ThisWeek" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">
                                        This week
                                    </label>
                                    </li>
                            
                                    <li class="flex items-center">
                                    <input id="month" type="checkbox" name="delivery[]" value="month"
                                        class="category-checkbox w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" />
                            
                                    <label for="ThisMonth" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">
                                        This month
                                    </label>
                                    </li>
                                </ul>
                            <h6 class="mb-3  pt-4 text-sm font-bold text-gray-900 dark:text-white">
                                Status
                            </h6>
                            <ul class="space-y-2 text-sm" aria-labelledby="dropdownDefault">
                                <li class="flex items-center">
                                <input id="inprogress" type="checkbox" name="status[]" value="inprogress"
                                    class="category-checkbox w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" />
                        
                                <label for="inprogress" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">
                                    In progress
                                </label>
                                </li>
                        
                                <li class="flex items-center">
                                <input id="completed" type="checkbox" name="status[]" value="completed"
                                    class="category-checkbox w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" />
                        
                                <label for="completed" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">
                                    Completed
                                </label>
                                </li>
                        
                                <li class="flex items-center">
                                <input id="cancelled" type="checkbox" name="status[]" value="cancelled"
                                    class="category-checkbox w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" />
                        
                                <label for="cancelled" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">
                                    Cancelled
                                </label>
                                </li>
                            </ul>
                            <x-button-primary text="Filter" class="w-full text-white mt-4" type="submit"/>
                            </div>
                        </div>
                        <div class="flex items-center justify-center p-4">
                            <button id="dropdownHelperRadioButton" data-dropdown-toggle="dropdownHelperRadio" class="text-gray-600 border focus:outline-none hover:bg-gray-200 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-4 py-2.5 text-center inline-flex items-center " type="button">Table Size <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                            </svg></button>
                                <!-- Dropdown menu -->
                                <div id="dropdownHelperRadio" class="z-10 hidden border p-4 text-gray-600 divide-y bg-white divide-gray-100 rounded-lg shadow w-60 dark:bg-gray-700 dark:divide-gray-600" data-popper-reference-hidden="" data-popper-escaped="" data-popper-placement="top" style="position: absolute; inset: auto auto 0px 0px; margin: 0px; transform: translate3d(522.5px, 6119.5px, 0px);">
                                    <div class="flex justify-between">
                                        <label for="minmax-range" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Rows</label>
                                        <p id="maxrow">10</p>
                                    </div>
                                    <input id="minmax-range" type="range" name="rowSize" min="5" max="20" value="10" class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer dark:bg-gray-700">
                                    <x-button-primary class="w-full text-white mt-4" type="button" id="rowrange" text="Apply" />
                                </div>

                        </div>
                    </div>
                </form>
            </div>
        </div>

        <label for="table-search" class="sr-only">Search</label>
        <div class="relative">
            <div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                </svg>
            </div>
            <input type="text" id="table-search" class="block pt-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search for items">
        </div>
    </div>
    <div class="overflow-x-auto">
        <table id="dataTable" class="w-full overflow-x-scroll text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="p-4">
                        <div class="flex items-center">
                            <input id="checkbox-all-search" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="checkbox-all-search" class="sr-only">checkbox</label>
                        </div>
                    </th>
                    <th scope="col" class="pl-2 pr-10 py-3">
                          <div class="flex items-center">
                         #
                        </div>
                    </th>
                    <th scope="col" class="px-2 py-3">
                          <div class="flex items-center">
                            Name
    
                        </div>
                    </th>
                    <th scope="col" class="px-2 py-3">
                            <div class="flex items-center">
                            Contact Number
                        </div>
                    </th>
                    <th scope="col" class="px-2 py-3">
                            <div class="flex items-center">
                            Alkaline Qty.
                        </div>
                    </th>
                    <th scope="col" class="px-2 py-3">
                            <div class="flex items-center">
                            Mineral Qty.
                        </div>
                    </th>
                    <th scope="col" class="px-2 py-3">
                            <div class="flex items-center">
                            Distilled Qty.
                        </div>
                    </th>
                    <th scope="col" class="px-2 py-3">
                        <div class="flex items-center">
                        Total
                    </div>
                </th>
                    <th scope="col" class="px-2 py-3">
                        <div class="flex items-center">
                        Delivery Address
                        </div>
                    </th>
                    <th scope="col" class="px-2 py-3 text-ellipsis w-fit">
                        <div class="flex items-center text-ellipsis w-20">
                        Map Reference
                        </div>
                    </th>
    
                    <th scope="col" class="px-2 py-3">
                            <div class="flex items-center">
                            Delivery Date
                        </div>
                    </th>
                    <th scope="col" class="px-2 py-3">
                            <div class="flex items-center">
                            Special Instruction
                        </div>
                    </th>
    
                    <th scope="col" class="px-2 py-3">
                        <div class="flex items-center">
                            Status
                        </div>
                    </th>
    
                    <th scope="col" class="px-2 py-3">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($paginatedData as $order)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <td class="w-4 p-4 ">
                        <div class="flex items-center">
                            <input id="checkbox-table-search-{{$order->id}}" type="checkbox" class="checkbox w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="checkbox-table-search-{{$order->id}}" class="sr-only">checkbox</label>
                        </div>
                    </td>
                    <td class="px-2 py-4">
                        {{$order->id}}
                    </td>
                    <th scope="row" class="px-2 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                            <div class="text-base font-semibold">{{$order->customer->firstname}}</div>
                            <div class="font-normal text-gray-500">{{$order->customer->email}}</div>
                    </th>
                    <td class="px-2 py-4">
                        {{$order->customer->contactnum}}
                    </td>
                    <td class="px-2 py-4">
                        {{ $order->orderline->where('water_id', 1)->sum('quantity') }}
                    </td>
                    <td class="px-2 py-4">
                        {{ $order->orderline->where('water_id', 2)->sum('quantity') }}
                    </td>
                    <td class="px-2 py-4 ">
                        {{ $order->orderline->where('water_id', 3)->sum('quantity') }}
                    </td>
                                    
                    <td class="px-2 py-4">
                        {{$order->total}} PHP
                    </td>
                    <td class="px-2 py-4">
                        {{$order->orderline->first()->delivery->delivery_address}}
                    </td>
                    <td class="px-2 py-4 text-ellipsis overflow-hidden max-w-14">
                        @if ($order->orderline->first()->delivery->map_reference != null)
                            <button class="text-blue-600" id="table-map-{{$order->orderline->first()->id}}" data-modal-target="mapmodal" data-modal-toggle="mapmodal" id="openModal" data-loc="{{$order->orderline->first()->delivery->map_reference}}">Show map</button>
                        @endif
                    </td>
                    <td class="px-2 py-4 text-center ">
                        {{ \Carbon\Carbon::parse($order->orderline->first()->delivery->delivery_date)->format('Y-m-d') }}

                    @php
                        $hasInProgress = false;
                        $deliveryDate = \Carbon\Carbon::parse($order->orderline->first()->delivery->delivery_date)->startOfDay();
                        $now = \Carbon\Carbon::now()->startOfDay();
                        $daysUntilDelivery = $now->diffInDays($deliveryDate, false); 
                    @endphp

                    @foreach($order->orderline as $orderline)
                        @if($orderline->delivery->delivery_status == 1)
                            @php
                                $hasInProgress = true;
                            @endphp
                        @endif  
                    @endforeach
                    @if ($hasInProgress)
                        @if ($daysUntilDelivery == 1)
                            <div class="mx-auto badge bg-blue-500 rounded-full p-1 text-xs w-fit text-white">Tomorrow</div>
                        @elseif ($daysUntilDelivery == 0)
                            <div class="mx-auto badge bg-green-500 rounded-full p-1 text-xs w-fit text-white">Today</div>
                        @elseif ($daysUntilDelivery < 0)
                            <div class="mx-auto badge bg-red-500 rounded-full p-1 text-xs w-fit text-white">Overdue</div>
                        @endif
                    @endif
                    </td>
                    <td class="px-2 py-4">
                        
                    </td>
                    <td class="px-2 py-4 ">
                        <div class="flex flex-col justify-start">
                            
                            @if ($hasInProgress)
                            <div class="flex items-center w-28">
                                <div class="h-2.5 w-2.5 rounded-full bg-green-500 me-2"></div>
                                {{$orderline->delivery->deliverystatus->name}}
                            </div>
                            @else
                                    @if($orderline->delivery->delivery_status == 2)
                                    <div class="flex items-center">
                                        <div class="h-2.5 w-2.5 rounded-full bg-blue-500 me-2"></div>
                                        {{$orderline->delivery->deliverystatus->name}}
                                    </div>
                                    @else
                                    <div class="flex items-center">
                                        <div class="h-2.5 w-2.5 rounded-full bg-red-500 me-2"></div>
                                        {{$orderline->delivery->deliverystatus->name}}                                        
                                    </div>
                                    @endif
                            @endif
                        </div>
                    </td>
    
                    <td class="px-2 py-4 ">
                        <div class="flex gap-4 items-center justify-center">
                            <form action="{{ route('mark-order', ['id' => $order->id, 'status' => 2]) }}" method="post" id="form-complete-{{ $order->id }}">
                                @csrf
                                <button type="button" 
                                        data-modal-target="confirm-modal" 
                                        data-modal-toggle="confirm-modal" 
                                        class="order-mark-btn" 
                                        data-id="{{$order->id}}">
                                    <i class="fa fa-check text-xl text-green-400" aria-hidden="true"></i>
                                </button>
                            </form>
                            <button type="button" onclick="PrintReceiptContent('print')">
                            
                            </button>
                            <i class="fa fa-download text-xl text-blue-500" aria-hidden="true"></i>
                            <i class="fas fa-edit text-xl text-sky-300"></i>
                        </div>
                    </td>
                </tr>
                 @endforeach
            </tbody>
        </table>
    </div>

    <nav class="flex items-center flex-column flex-wrap md:flex-row justify-between pt-4" aria-label="Table navigation">
        <span class="text-sm font-normal text-gray-500 dark:text-gray-400 mb-4 md:mb-0 block w-full md:inline md:w-auto">
            Showing <span class="font-semibold text-gray-900 dark:text-white">{{ $paginatedData->firstItem() }}</span>
            to <span class="font-semibold text-gray-900 dark:text-white">{{ $paginatedData->lastItem() }}</span>
            of <span class="font-semibold text-gray-900 dark:text-white">{{ $paginatedData->total() }}</span>
        </span>
        <ul class="inline-flex -space-x-px rtl:space-x-reverse text-sm h-8">
            <li>
                <a href="{{ $paginatedData->previousPageUrl() }}" class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">Previous</a>
            </li>
            @for ($i = 1; $i <= $paginatedData->lastPage(); $i++)
                <li>
                    <a href="{{ $paginatedData->url($i) }}" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white {{ $paginatedData->currentPage() == $i ? 'text-blue-600 border-blue-300 bg-blue-50 hover:bg-blue-100 hover:text-blue-700' : '' }}">
                        {{ $i }}
                    </a>
                </li>
            @endfor
            <li>
                <a href="{{ $paginatedData->nextPageUrl() }}" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">Next</a>
            </li>
        </ul>
    </nav>
    
</div>
<x-modal-confirm text="Are you sure to mark this order as complete?" variant="confirm" />

<div id="print">
    @include('reports/receipt')
</div>

@include('modals/map')

<script>
    function PrintReceiptContent(id){
        const data = '<input type="button" id="printPageButton" class="w-full bg-blue-700 border-none text-white p-4 text-lg text-center" value="Print Receipt" onClick="window.print()">';
        data += document.getElementById(id).innerHtml;
        receipt = window.open("","win","left=150","top=130", "width=400", "height=400")
            receipt.screenX =0;
            receipt.screenY =0;
            receipt.document.write(data);
            receipt.document.title = "Print Receipt";
            receipt.focus();

            setTimeout(() => {
               receipt.close(); 
            }, 8000);
    }
</script>
@endsection
