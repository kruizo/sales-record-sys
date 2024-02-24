@extends('layouts.admin')
@section('title')
    <title>Dashboard</title>
@endsection
@section('content')
<div class="relative overflow-hidden sm:ml-64 p-4 shadow-md sm:rounded-lg">
    <div class="flex gap-4 mb-10 justify-around flex-wrap">
        <x-sales-card id="order-count" title="Total Order" count="{{$data->count()}}"/>
        <x-sales-card id="proft-count" title="Total Earnings" count="₱ {{$watersold->sum('subtotal')}}"/>
        <x-sales-card id="water-count" title="Waters Sold" count="{{$watersold->sum('quantity')}}"/>
        <x-sales-card id="order-count" title="Pending Deliveries Today " count="{{$deliveries->count()}}"/>

    </div>
    <div>
        <h1 class="text-xl text-black font-bold">You have <span class="text-green-600">{{$data->count()}} </span> order(s) today</h1>
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
                <div class="flex items-center justify-center p-4">
                    <button id="dropdownDefault" data-dropdown-toggle="dropdown"
                      class="text-gray-600 border hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2.5 text-center inline-flex items-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800"
                      type="button">
                      Filter by category
                      <svg class="w-4 h-4 ml-2" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                      </svg>
                    </button>
                  
                    <!-- Dropdown menu -->
                    <form action="{{route('admin.dashboard')}}" method="GET">
                    <div id="dropdown" class="z-10 hidden w-56 p-4 border bg-white rounded-lg shadow dark:bg-gray-700">
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
                              <input id="ThisWeek" type="checkbox" name="delivery[]" value="week"
                                class="category-checkbox w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" />
                      
                              <label for="ThisWeek" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">
                                This week
                              </label>
                            </li>
                      
                            <li class="flex items-center">
                              <input id="ThisMonth" type="checkbox" name="delivery[]" value="month"
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
                          <input id="inProgress" type="checkbox" name="status[]" value="1"
                            class="category-checkbox w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" />
                  
                          <label for="inProgress" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">
                            In progress
                          </label>
                        </li>
                  
                        <li class="flex items-center">
                          <input id="completed" type="checkbox" name="status[]" value="2"
                            class="category-checkbox w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" />
                  
                          <label for="completed" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">
                            Completed
                          </label>
                        </li>
                  
                        <li class="flex items-center">
                          <input id="cancelled" type="checkbox" name="status[]" value="3"
                            class="category-checkbox w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" />
                  
                          <label for="cancelled" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">
                            Cancelled
                          </label>
                        </li>
                      </ul>
                      <x-button-primary text="Filter" class="w-full" type="submit"/>
                    </div>
                    </form>
                </div>
                <div class="flex items-center justify-center p-4">

                    <button id="dropdownHelperRadioButton" data-dropdown-toggle="dropdownHelperRadio" class="text-gray-600 border hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2.5 text-center inline-flex items-center " type="button">Table Size <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                      </svg></button>
                    
                    <!-- Dropdown menu -->
                    <div id="dropdownHelperRadio" class="z-10 hidden border p-4 text-gray-600 divide-y bg-white divide-gray-100 rounded-lg shadow w-60 dark:bg-gray-700 dark:divide-gray-600" data-popper-reference-hidden="" data-popper-escaped="" data-popper-placement="top" style="position: absolute; inset: auto auto 0px 0px; margin: 0px; transform: translate3d(522.5px, 6119.5px, 0px);">
                        <div class="flex justify-between">
                            <label for="minmax-range" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Rows</label>
                            <p id="maxrow">5</p>
                        </div>
                        <input id="minmax-range" type="range" min="1" max="10" value="5" class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer dark:bg-gray-700">
                    </div>
                </div>
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
                @foreach ($paginatedData as $item)
    
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <td class="w-4 p-4 ">
                        <div class="flex items-center">
                            <input id="checkbox-table-search-{{$item->id}}" type="checkbox" class="checkbox w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="checkbox-table-search-{{$item->id}}" class="sr-only">checkbox</label>
                        </div>
                    </td>
                    <td class="px-2 py-4">
                        {{$item->id}}
                    </td>
                    <th scope="row" class="px-2 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                            <div class="text-base font-semibold">{{$item->customer->firstname}}</div>
                            <div class="font-normal text-gray-500">{{$item->customer->email}}</div>
                    </th>
                    <td class="px-2 py-4">
                        {{$item->customer->contactnum}}
                    </td>
                    <td class="px-2 py-4">
                        {{ $item->orderline->where('water_id', 1)->sum('quantity') }}
                    </td>
                    <td class="px-2 py-4">
                        {{ $item->orderline->where('water_id', 2)->sum('quantity') }}
                    </td>
                    <td class="px-2 py-4">
                        {{ $item->orderline->where('water_id', 3)->sum('quantity') }}
                    </td>
                                    
                    <td class="px-2 py-4">
                        {{$item->total}} PHP
                    </td>
                    <td class="px-2 py-4">
                        {{$item->orderline->first()->delivery->delivery_address}}
                    </td>
                    <td class="px-2 py-4 text-ellipsis overflow-hidden max-w-14">
                        @if ($item->orderline->first()->delivery->map_reference != null)
                            <button class="text-blue-600">Show map</button>
                            
                        @endif
                    </td>
                    <td class="px-2 py-4 flex flex-col items-center">
                        {{ \Carbon\Carbon::parse($item->orderline->first()->delivery->delivery_date)->format('Y-m-d') }}

                        @php
                        $hasInProgress = false;
                        $deliveryDate = \Carbon\Carbon::parse($item->orderline->first()->delivery->delivery_date)->startOfDay();
                        $now = \Carbon\Carbon::now()->startOfDay();
                        $daysUntilDelivery = $now->diffInDays($deliveryDate, false); 
                    @endphp

                    @foreach($item->orderline as $orderline)
                        @if($orderline->delivery->delivery_status == 1)
                            @php
                                $hasInProgress = true;
                            @endphp
                        @endif
                    @endforeach
                    <script>console.log({{$daysUntilDelivery}})</script>
                    @if ($hasInProgress)
                        @if ($daysUntilDelivery == 1)
                            <span class="badge bg-blue-500 rounded-full p-1 text-xs text-white">Tomorrow</span>
                        @elseif ($daysUntilDelivery == 0)
                            <span class="badge bg-green-500 rounded-full p-1 text-xs text-white">Today</span>
                        @elseif ($daysUntilDelivery < 0)
                            <span class="badge bg-red-500 rounded-full p-1 text-xs text-white">Overdue</span>
                    
                        @endif
                    @endif
                    
                    </td>
                    <td class="px-2 py-4">
                        
                    </td>
                    <td class="px-4 py-4">
                        <div class="flex flex-col justify-start">
                            
                            @if ($hasInProgress)
                            <div class="flex">
                                <div class="h-2.5 w-2.5 rounded-full bg-green-500 me-2"></div>
                                In Progress
                            </div>

                            @else
                                @foreach($item->orderline as $orderline)
                                    @if($orderline->delivery->delivery_status == 2)
                                    <div class="flex">
                                        <div class="h-2.5 w-2.5 rounded-full bg-blue-500 me-2"></div>
                                        {{$orderline->delivery->deliverystatus->status}}
                                    </div>

                                    @else
                                    <div class="flex">
                                        <div class="h-2.5 w-2.5 rounded-full bg-red-500 me-2"></div>
                                        {{$orderline->delivery->deliverystatus->status}}                                        
                                    </div>

                                    @endif
                                @endforeach
                            @endif
                        </div>
                    </td>
    
                    <td class="px-2 py-4 ">
                        <div class="flex gap-4 items-center justify-center">
                            <i class="fa fa-check text-xl text-green-400" aria-hidden="true"></i>
                            <i class="fa fa-download text-xl text-blue-500" aria-hidden="true"></i>
                            <i class="fas fa-edit text-xl text-sky-300"></i>
    
                            {{-- <i class="fas fa-trash-alt text-xl text-red-500"></i> --}}
                            {{-- <i class="fa fa-info-circle text-xl text-blue-500"></i> --}}
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
@endsection
