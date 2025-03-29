@extends('layouts.admin')
@section('title')
    <link rel="shortcut icon" href="{{ asset('assets/image/logo.png') }}" type="image/x-icon">
    <title>Dashboard</title>
@endsection
@section('content')
    <div class="overflow-hidden sm:ml-64 p-4 shadow-md sm:rounded-lg">
        <div class="flex gap-4 mb-10 justify-around flex-wrap">
            <x-sales-card id="order-card" title="Total Order" countId="order-text" count="{{ $totalorder }}">
                <slot name="icon">
                    <svg class="fill-green-500" clip-rule="evenodd" fill-rule="evenodd" width="28" height="28"
                        stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="m2.394 15.759s7.554 4.246 9.09 5.109c.165.093.333.132.492.132.178 0 .344-.049.484-.127 1.546-.863 9.155-5.113 9.155-5.113.246-.138.385-.393.385-.656 0-.566-.614-.934-1.116-.654 0 0-7.052 3.958-8.539 4.77-.211.115-.444.161-.722.006-1.649-.928-8.494-4.775-8.494-4.775-.502-.282-1.117.085-1.117.653 0 .262.137.517.382.655zm0-3.113s7.554 4.246 9.09 5.109c.165.093.333.132.492.132.178 0 .344-.049.484-.127 1.546-.863 9.155-5.113 9.155-5.113.246-.138.385-.393.385-.656 0-.566-.614-.934-1.116-.654 0 0-7.052 3.958-8.539 4.77-.211.115-.444.161-.722.006-1.649-.928-8.494-4.775-8.494-4.775-.502-.282-1.117.085-1.117.653 0 .262.137.517.382.655zm10.271-9.455c-.246-.128-.471-.191-.692-.191-.223 0-.443.065-.675.191l-8.884 5.005c-.276.183-.414.444-.414.698 0 .256.139.505.414.664l8.884 5.006c.221.133.447.203.678.203.223 0 .452-.065.689-.203l8.884-5.006c.295-.166.451-.421.451-.68 0-.25-.145-.503-.451-.682zm-8.404 5.686 7.721-4.349 7.72 4.349-7.72 4.35z"
                            fill-rule="nonzero" />
                    </svg>
                </slot>
            </x-sales-card>
            <x-sales-card id="proft-card" title="Total Earnings" countId="profit-text" count="₱ {{ $totalearning }}">
                <slot name="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="fill-yellow-500" width="24" height="24"
                        viewBox="0 0 24 24">
                        <path
                            d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm4 14.083c0-2.145-2.232-2.742-3.943-3.546-1.039-.54-.908-1.829.581-1.916.826-.05 1.675.195 2.443.465l.362-1.647c-.907-.276-1.719-.402-2.443-.421v-1.018h-1v1.067c-1.945.267-2.984 1.487-2.984 2.85 0 2.438 2.847 2.81 3.778 3.243 1.27.568 1.035 1.75-.114 2.011-.997.226-2.269-.168-3.225-.54l-.455 1.644c.894.462 1.965.708 3 .727v.998h1v-1.053c1.657-.232 3.002-1.146 3-2.864z" />
                    </svg>
                </slot>
            </x-sales-card>
            <x-sales-card id="water-card" title="Waters Sold" countId="water-text" count="{{ $watersold }}">
                <slot name="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="fill-blue-500" width="24" height="24"
                        viewBox="0 0 24 24">
                        <path
                            d="M15.613 21.719c-1.443 1.409-3.424 2.281-5.613 2.281-4.421 0-8-3.547-8-7.925 0-4.376 3.13-8.878 8-16.075 2.473 3.653 4.493 6.61 5.887 9.211-.665.171-1.289.442-1.854.801-1.021-1.886-2.384-3.989-4.033-6.441-3.658 5.437-6 9.223-6 12.503 0 3.268 2.691 5.926 6 5.926 1.387 0 2.661-.471 3.678-1.254.581.424 1.231.759 1.935.973zm6.387-6.219c0 2.485-2.017 4.5-4.5 4.5s-4.5-2.015-4.5-4.5 2.017-4.5 4.5-4.5 4.5 2.015 4.5 4.5zm-2-.5h-2v-2h-1v2h-2v1h2v2h1v-2h2v-1z" />
                    </svg>
                </slot>
            </x-sales-card>
            <x-sales-card id="deliveries-card" title="Pending Deliveries Today" countId="deliveries-text"
                count="{{ $deliveries->count() }}">
                <slot name="icon">
                    <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" class="fill-pink-500"
                        fill-rule="evenodd" clip-rule="evenodd">
                        <path
                            d="M5 11v1h8v-7h-10v-1c0-.552.448-1 1-1h10c.552 0 1 .448 1 1v2h4.667c1.117 0 1.6.576 1.936 1.107.594.94 1.536 2.432 2.109 3.378.188.312.288.67.288 1.035v4.48c0 1.089-.743 2-2 2h-1c0 1.656-1.344 3-3 3s-3-1.344-3-3h-4c0 1.656-1.344 3-3 3s-3-1.344-3-3h-1c-.552 0-1-.448-1-1v-6h-2v-2h7v2h-3zm3 5.8c.662 0 1.2.538 1.2 1.2 0 .662-.538 1.2-1.2 1.2-.662 0-1.2-.538-1.2-1.2 0-.662.538-1.2 1.2-1.2zm10 0c.662 0 1.2.538 1.2 1.2 0 .662-.538 1.2-1.2 1.2-.662 0-1.2-.538-1.2-1.2 0-.662.538-1.2 1.2-1.2zm-3-2.8h-10v2h.765c.549-.614 1.347-1 2.235-1 .888 0 1.686.386 2.235 1h5.53c.549-.614 1.347-1 2.235-1 .888 0 1.686.386 2.235 1h1.765v-4.575l-1.711-2.929c-.179-.307-.508-.496-.863-.496h-4.426v6zm1-5v3h5l-1.427-2.496c-.178-.312-.509-.504-.868-.504h-2.705zm-16-3h8v2h-8v-2z" />
                    </svg>
                </slot>
            </x-sales-card>

        </div>
        <div>
            <h1 class="text-xl text-black font-bold">You have <span class="text-green-600"
                    id="order-count">{{ $data->count() }} </span>
                @if (!$request->has('delivery') && !$request->has('status'))
                    order(s) today
                @else
                    filtered order(s)
                @endif
            </h1>
        </div>
        <div
            class="flex items-center justify-between flex-column flex-wrap md:flex-row space-y-4 md:space-y-0 pb-4 bg-white dark:bg-gray-900">
            <div class="flex gap-10 justify-center items-center ">
                <div class="flex">
                    <div class="flex items-center justify-center p-4">
                        <button id="dropdownActionButton" data-dropdown-toggle="dropdownAction"
                            class="inline-flex items-center text-gray-500 bg-white border border-gray-300 focus:outline-none hover:bg-gray-200 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-3 py-1.5 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700"
                            type="button">
                            <span class="sr-only">Action button</span>
                            Action
                            <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m1 1 4 4 4-4" />
                            </svg>
                        </button>

                    </div>
                    <form action="{{ route('admin.dashboard') }}" method="GET">
                        <div class="flex  ">
                            <div class="flex items-center justify-center p-4">
                                <button id="dropdownDefault" data-dropdown-toggle="dropdown"
                                    class="text-gray-600 border focus:outline-none hover:bg-gray-200 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-4 py-2.5 text-center inline-flex items-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800"
                                    type="button">
                                    Filter by category
                                    <svg class="w-4 h-4 ml-2" aria-hidden="true" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </button>

                                <!-- Dropdown menu -->
                                <div id="dropdown"
                                    class="z-10 hidden absolute w-56 p-4 border bg-white rounded-lg shadow dark:bg-gray-700">
                                    <h6 class="mb-3 text-sm font-bold text-gray-900 dark:text-white">
                                        Delivery
                                    </h6>
                                    <ul class="space-y-2 text-sm" aria-labelledby="dropdownDefault">
                                        <li class="flex items-center">
                                            <input id="today" name="delivery[]" type="checkbox" value="today"
                                                class="category-checkbox w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" />

                                            <label for="today"
                                                class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">
                                                Today
                                            </label>
                                        </li>
                                        <li class="flex items-center">
                                            <input id="tomorrow" type="checkbox" name="delivery[]" value="tomorrow"
                                                class="category-checkbox w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" />

                                            <label for="tomorrow"
                                                class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">
                                                Tomorrow
                                            </label>
                                        </li>

                                        <li class="flex items-center">
                                            <input id="week" type="checkbox" name="delivery[]" value="week"
                                                class="category-checkbox w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" />

                                            <label for="ThisWeek"
                                                class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">
                                                This week
                                            </label>
                                        </li>

                                        <li class="flex items-center">
                                            <input id="month" type="checkbox" name="delivery[]" value="month"
                                                class="category-checkbox w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" />

                                            <label for="ThisMonth"
                                                class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">
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

                                            <label for="inprogress"
                                                class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">
                                                In progress
                                            </label>
                                        </li>

                                        <li class="flex items-center">
                                            <input id="completed" type="checkbox" name="status[]" value="completed"
                                                class="category-checkbox w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" />

                                            <label for="completed"
                                                class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">
                                                Completed
                                            </label>
                                        </li>

                                        <li class="flex items-center">
                                            <input id="cancelled" type="checkbox" name="status[]" value="cancelled"
                                                class="category-checkbox w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" />

                                            <label for="cancelled"
                                                class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">
                                                Cancelled
                                            </label>
                                        </li>
                                    </ul>
                                    <x-button-primary text="Filter" class="w-full text-white mt-4" type="submit" />
                                </div>
                            </div>
                            <div id="dropdownAction"
                                class="z-10 w-fit hidden bg-white divide-y p-4 border divide-gray-100 rounded-lg shadow dark:bg-gray-700 dark:divide-gray-600">
                                <ul class="py-1 text-sm text-gray-700 dark:text-gray-200"
                                    aria-labelledby="dropdownActionButton">
                                    <li>
                                        <button data-modal-target="confirm-modal" data-modal-toggle="confirm-modal"
                                            type="button" data-action="archive" data-status="1"
                                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                                            id="markAllArchive">Move to archive</button>
                                    </li>
                                    <li>
                                        <button data-modal-target="confirm-modal" data-modal-toggle="confirm-modal"
                                            type="button" data-action="complete" data-status="2"
                                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                                            id="markAllCompleteBtn">Mark as complete</button>

                                    </li>
                                </ul>
                            </div>
                            <div class="flex items-center justify-center p-4">
                                <button id="dropdownHelperRadioButton" data-dropdown-toggle="dropdownHelperRadio"
                                    class="text-gray-600 border focus:outline-none hover:bg-gray-200 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-4 py-2.5 text-center inline-flex items-center "
                                    type="button">Table Size <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m1 1 4 4 4-4" />
                                    </svg></button>
                                <!-- Dropdown menu -->
                                <div id="dropdownHelperRadio"
                                    class="z-10 hidden border p-4 text-gray-600 divide-y bg-white divide-gray-100 rounded-lg shadow w-60 dark:bg-gray-700 dark:divide-gray-600"
                                    data-popper-reference-hidden="" data-popper-escaped="" data-popper-placement="top"
                                    style="position: absolute; inset: auto auto 0px 0px; margin: 0px; transform: translate3d(522.5px, 6119.5px, 0px);">
                                    <div class="flex justify-between">
                                        <label for="minmax-range"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Rows</label>
                                        <p id="maxrow">10</p>
                                    </div>
                                    <input id="minmax-range" type="range" name="rowSize" min="5"
                                        max="20" value="10"
                                        class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer dark:bg-gray-700">
                                    <x-button-primary class="w-full text-white mt-4" type="button" id="rowrange"
                                        text="Apply" />
                                </div>

                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <label for="table-search" class="sr-only">Search</label>
            <div class="relative">
                <div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                </div>
                <input type="text" id="table-search"
                    class="block pt-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Search for items">
            </div>
        </div>
        <div class="overflow-x-auto">


            <table id="dataTable"
                class="w-full overflow-x-scroll text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="p-4">
                            <div class="flex items-center">
                                <input id="checkbox-all-search" type="checkbox"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
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
                                Payment Method
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
                    <form id="mark-orders-form" action="{{ route('update-orders') }}" method="POST">
                        @csrf
                        <input type="hidden" name="action" id="actionInput">
                        <!-- Add a hidden input field for the action -->
                        <input type="hidden" name="status" id="statusInput">
                        <input type="hidden" name="orderId" id="orderIdInput">
                        @foreach ($paginatedData as $order)
                            <tr
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <td class="w-4 p-4 ">
                                    <div class="flex items-center">
                                        <input id="checkbox-table-search-{{ $order->id }}"
                                            data-order-id="{{ $order->id }}" value="{{ $order->id }}"
                                            name="selectedOrders[]" type="checkbox"
                                            class="checkbox w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                        <label for="checkbox-table-search-{{ $order->id }}"
                                            class="sr-only">checkbox</label>
                                    </div>
                                </td>

                                <td class="px-2 py-4">
                                    {{ $order->id }}
                                </td>
                                <th scope="row" class="px-2 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                                    <div class="text-base font-semibold">{{ $order->customer->firstname }}</div>
                                    <div class="font-normal text-gray-500">{{ $order->customer->email }}</div>
                                </th>
                                <td class="px-2 py-4">
                                    {{ $order->customer->contactnum }}
                                </td>
                                <td class="px-2 py-4">
                                    {{ $order->orderline->where('water_id', 1)->sum('quantity') ?? 0}}
                                </td>
                                <td class="px-2 py-4">
                                    {{ $order->orderline->where('water_id', 2)->sum('quantity') ?? 0}}
                                </td>
                                <td class="px-2 py-4 ">
                                    {{ $order->orderline->where('water_id', 3)->sum('quantity') ?? 0}}
                                </td>

                                <td class="px-2 py-4">
                                    {{ $order->total }} PHP
                                </td>
                                <td class="px-2 py-4">
                                    {{ $order->orderline->first()->delivery->delivery_address }}
                                </td>
                                <td class="px-2 py-4 text-ellipsis overflow-hidden max-w-14">
                                    @if ($order->orderline->first()->delivery->map_reference != null)
                                        <button class="text-blue-600" id="table-map-{{ $order->orderline->first()->id }}"
                                            type="button"data-modal-target="mapmodal" data-modal-toggle="mapmodal"
                                            id="openModal"
                                            data-loc="{{ $order->orderline->first()->delivery->map_reference }}">Show
                                            map</button>
                                    @endif
                                </td>
                                <td class="px-2 py-4 text-center ">
                                    {{ \Carbon\Carbon::parse($order->orderline->first()->delivery->delivery_date)->format('Y-m-d') }}

                                    @php
                                        $hasInProgress = false;
                                        $completed = false;
                                        $deliveryDate = \Carbon\Carbon::parse(
                                            $order->orderline->first()->delivery->delivery_date,
                                        )->startOfDay();
                                        $now = \Carbon\Carbon::now()->startOfDay();
                                        $daysUntilDelivery = $now->diffInDays($deliveryDate, false);
                                    @endphp

                                    @foreach ($order->orderline as $orderline)
                                        @if ($orderline->delivery->delivery_status == 1)
                                            @php
                                                $hasInProgress = true;
                                            @endphp
                                        
                                        @elseif ($orderline->delivery->delivery_status == 2)
                                            @php
                                                $completed = true;
                                            @endphp
                                        @endif
                                    @endforeach
                                    @if ($hasInProgress)
                                        @if ($daysUntilDelivery == 1)
                                            <div
                                                class="mx-auto badge bg-blue-500 rounded-full p-1 text-xs w-fit text-white">
                                                Tomorrow</div>
                                        @elseif ($daysUntilDelivery == 0)
                                            <div
                                                class="mx-auto badge bg-green-500 rounded-full p-1 text-xs w-fit text-white">
                                                Today</div>
                                        @elseif ($daysUntilDelivery < 0)
                                            <div
                                                class="mx-auto badge bg-red-500 rounded-full p-1 text-xs w-fit text-white">
                                                Overdue</div>
                                        @endif
                                    @endif
                                </td>
                                
                                <td class="px-2 py-4">
                                    {{$orderline->order->payment_type}}
                                </td>
                                <td class="px-2 py-4">
                                    {{$orderline->delivery->special_instruction}}
                                </td>
                                <td class="px-2 py-4 ">
                                    <div class="flex flex-col justify-start">

                                        @if ($hasInProgress)
                                            <div class="flex items-center w-28">
                                                <div class="h-2.5 w-2.5 rounded-full bg-green-500 me-2"></div>
                                                {{ $orderline->delivery->deliverystatus->find(1)->name }}
                                            </div>
                                        @elseif ($completed)
                                                <div class="flex items-center">
                                                    <div class="h-2.5 w-2.5 rounded-full bg-blue-500 me-2"></div>
                                                    {{ $orderline->delivery->deliverystatus->find(2)->name }}
                                                </div>
                                        @else
                                            <div class="flex items-center">
                                                <div class="h-2.5 w-2.5 rounded-full bg-red-500 me-2"></div>
                                                {{ $orderline->delivery->deliverystatus->name }}
                                            </div>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-2 py-4 ">
                                    <div class="flex gap-4 items-center justify-center">
                                        <button type="button" data-modal-target="confirm-modal"
                                            data-modal-toggle="confirm-modal" class="order-mark-btn"
                                            data-id="{{ $order->id }}" data-action="complete" data-status="2">
                                            <i class="fas fa-check text-xl text-green-400" aria-hidden="true"></i>
                                        </button>

                                        <!-- <button type="button" class="print-btn" onclick="PrintReceiptContent('print')">
                                            <i class="fas fa-download text-xl text-blue-500" aria-hidden="true"></i>
                                        </button> -->
                                        <button type="button" class="print-btn" onclick="generateAndPrintReceipt({{ $order->id }})">
                                            <i class="fas fa-download text-xl text-blue-500" aria-hidden="true"></i>
                                        </button>

                                        <button type="button" data-modal-target="edit-order-modal-{{ $order->id }}"
                                            data-modal-toggle="edit-order-modal-{{ $order->id }}" class="edit-btn"
                                            data-id="{{ $order->id }}">
                                            <i class="fas fa-edit text-xl text-sky-300"></i>
                                        </button>
                                    </div>
                                </td>

                            </tr>
                            {{-- Modal --}}
                            <div id="edit-order-modal-{{ $order->id }}" tabindex="-1"
                                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                <div class="relative p-4 w-full max-w-screen-md max-h-full">
                                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                        <button type="button"
                                            class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                            data-modal-hide="edit-order-modal-{{ $order->id }}">
                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 14 14">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2"
                                                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                            </svg>
                                            <span class="sr-only">Close modal</span>
                                        </button>
                                        
                                        <div class="p-4 md:p-5 text-center">
                                            <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">
                                                Order #{{ $order->id }}</h3>
                                            @foreach ($order->orderline as $orderline)
                                                @if($orderline->is_archived != 1)
                                                <div class="orderline-item border flex w-full text-gray-900 object-fill"  id="orderline-item-{{$orderline->id}}">
                                                    <div>
                                                        <img src="{{ asset('assets/image/container1.png') }}"
                                                            height="50" class="h-full pt-2 min-w-14 max-w-14"
                                                            alt="" srcset="">
                                                    </div>

                                                    <div class="flex flex-col justify-between w-full p-1 py-3">
                                                        <h1 class="text-start text-xl font-bold">
                                                            {{ $orderline->water->name }}
                                                            <span>
                                                                P
                                                                {{ $orderline->water->cost }}
                                                            </span>
                                                        </h1>
                                                        <div class="flex gap-2 justify-start items-center">
                                                            <h1>QTY. </h1>
                                                            <button type="button" class="rounded-lg w-fit"
                                                                aria-label="Decrease quantity of Alkaline">
                                                                <svg width="24" height="24"
                                                                    xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd"
                                                                    class="fill-blue-800" clip-rule="evenodd">
                                                                    <path
                                                                        d="M11.5 0c6.347 0 11.5 5.153 11.5 11.5s-5.153 11.5-11.5 11.5-11.5-5.153-11.5-11.5 5.153-11.5 11.5-11.5zm0 1c5.795 0 10.5 4.705 10.5 10.5s-4.705 10.5-10.5 10.5-10.5-4.705-10.5-10.5 4.705-10.5 10.5-10.5zm-6.5 10h13v1h-13v-1z" />
                                                                </svg>
                                                            </button>
                                                            <input name="product_{{ $orderline->water->name }}"
                                                                id="{{ $orderline->id }}"
                                                                value="{{ $orderline->quantity }}"
                                                                class="bg-transparent min-w-6 w-auto max-w-10 text-center word-wrap"></input>
                                                            <button type="button" class="rounded-lg w-8"
                                                                aria-label="Decrease quantity of Alkaline">
                                                                <svg width="24" height="24" class="fill-blue-800"
                                                                    xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd"
                                                                    clip-rule="evenodd">
                                                                    <path
                                                                        d="M11.5 0c6.347 0 11.5 5.153 11.5 11.5s-5.153 11.5-11.5 11.5-11.5-5.153-11.5-11.5 5.153-11.5 11.5-11.5zm0 1c5.795 0 10.5 4.705 10.5 10.5s-4.705 10.5-10.5 10.5-10.5-4.705-10.5-10.5 4.705-10.5 10.5-10.5zm.5 10h6v1h-6v6h-1v-6h-6v-1h6v-6h1v6z" />
                                                                </svg>
                                                            </button>

                                                        </div>
                                                    </div>
                                                    <div class="flex items-center gap-4 px-4">
                                                        @if ($orderline->delivery->delivery_status == 1)
                                                            <button type="button"
                                                                class="rounded-2xl w-fit h-10 flex items-center bg-green-400 text-white px-3 py-2 gap-2">
                                                                <!-- Icon -->
                                                                <svg clip-rule="evenodd" class="fill-white w-7"
                                                                    fill-rule="evenodd" stroke-linejoin="round"
                                                                    stroke-miterlimit="2" viewBox="0 0 23 23"
                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                    <path
                                                                        d="m2.25 12.321 7.27 6.491c.143.127.321.19.499.19.206 0 .41-.084.559-.249l11.23-12.501c.129-.143.192-.321.192-.5 0-.419-.338-.75-.749-.75-.206 0-.411.084-.559.249l-10.731 11.945-6.711-5.994c-.144-.127-.322-.19-.5-.19-.417 0-.75.336-.75.749 0 .206.084.412.25.56"
                                                                        fill-rule="nonzero" />
                                                                </svg>
                                                                <h1 class="ml-2 complete-btn" id="complete-btn-{{$orderline->id}}" data-id="{{$orderline->id}}">Complete</h1>
                                                            </button>
                                                        {{-- <button type="button"
                                                            class="rounded-2xl w-fit h-10 bg-red-500 flex items-center justify-center text-white px-3 py-2 gap-2">
                                                            <div class="flex items-center w-full">
                                                                <!-- Icon -->
                                                                <svg clip-rule="evenodd" fill-rule="evenodd"
                                                                    class="fill-white w-7" stroke-linejoin="round"
                                                                    stroke-miterlimit="2" viewBox="0 0 30 30"
                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                    <path
                                                                        d="m4.015 5.494h-.253c-.413 0-.747-.335-.747-.747s.334-.747.747-.747h5.253v-1c0-.535.474-1 1-1h4c.526 0 1 .465 1 1v1h5.254c.412 0 .746.335.746.747s-.334.747-.746.747h-.254v15.435c0 .591-.448 1.071-1 1.071-2.873 0-11.127 0-14 0-.552 0-1-.48-1-1.071zm14.5 0h-13v15.006h13zm-4.25 2.506c-.414 0-.75.336-.75.75v8.5c0 .414.336.75.75.75s.75-.336.75-.75v-8.5c0-.414-.336-.75-.75-.75zm-4.5 0c-.414 0-.75.336-.75.75v8.5c0 .414.336.75.75.75s.75-.336.75-.75v-8.5c0-.414-.336-.75-.75-.75zm3.75-4v-.5h-3v.5z"
                                                                        fill-rule="nonzero" />
                                                                </svg>
                                                                <p class="ml-2 cancel-btn"  data-id="{{$orderline->id}}">Cancel</p>
                                                            </div>
                                                        </button> --}}
                                                        <button type="button"
                                                            class="rounded-2xl w-fit h-10 bg-red-500 flex items-center justify-center text-white px-3 py-2 gap-2">
                                                            <div class="flex items-center w-full">
                                                                <!-- Icon -->
                                                                <svg clip-rule="evenodd" fill-rule="evenodd"
                                                                    class="fill-white w-7" stroke-linejoin="round"
                                                                    stroke-miterlimit="2" viewBox="0 0 23 23"
                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                    <path
                                                                        d="m4.015 5.494h-.253c-.413 0-.747-.335-.747-.747s.334-.747.747-.747h5.253v-1c0-.535.474-1 1-1h4c.526 0 1 .465 1 1v1h5.254c.412 0 .746.335.746.747s-.334.747-.746.747h-.254v15.435c0 .591-.448 1.071-1 1.071-2.873 0-11.127 0-14 0-.552 0-1-.48-1-1.071zm14.5 0h-13v15.006h13zm-4.25 2.506c-.414 0-.75.336-.75.75v8.5c0 .414.336.75.75.75s.75-.336.75-.75v-8.5c0-.414-.336-.75-.75-.75zm-4.5 0c-.414 0-.75.336-.75.75v8.5c0 .414.336.75.75.75s.75-.336.75-.75v-8.5c0-.414-.336-.75-.75-.75zm3.75-4v-.5h-3v.5z"
                                                                        fill-rule="nonzero" />
                                                                </svg>
                                                                <h1 class="ml-2 remove-btn"  data-id="{{$orderline->id}}">Remove</h1>
                                                            </div>
                                                        </button>
                                                        @elseif ($orderline->delivery->delivery_status == 2)
                                                        
                                                        <div class="rounded-2xl w-fit h-10 flex items-center bg-blue-500 text-white px-3 py-2 gap-2">
                                                            <h1>{{$orderline->delivery->deliverystatus->name}}</h1>
                                                        </div>
                                                        @else 
                                                        <div class="rounded-2xl w-fit h-10 flex items-center bg-red-500 text-white px-3 py-2 gap-2">
                                                            <h1>{{$orderline->delivery->deliverystatus->name}}</h1>
                                                        </div>
                                                        @endif
                                                    </div>
                                                </div>
                                                @endif
                                            @endforeach
                                            
                                            <div class="mt-4">
                                                 <button id="save-btn" type="button" data-modal-hide="edit-order-modal-{{ $order->id }}"
                                                    class="text-white bg-green-600 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                                    Save Changes
                                                </button>
                                                <button id="cancel-btn" data-modal-hide="edit-order-modal-{{ $order->id }}" type="button"
                                                    class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                                                    Cancel</button>
                                            </div>
                           
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </form>
                </tbody>
            </table>
        </div>

        <nav class="flex items-center flex-column flex-wrap md:flex-row justify-between pt-4"
            aria-label="Table navigation">
            <span
                class="text-sm font-normal text-gray-500 dark:text-gray-400 mb-4 md:mb-0 block w-full md:inline md:w-auto">
                Showing <span class="font-semibold text-gray-900 dark:text-white">{{ $paginatedData->firstItem() }}</span>
                to <span class="font-semibold text-gray-900 dark:text-white">{{ $paginatedData->lastItem() }}</span>
                of <span class="font-semibold text-gray-900 dark:text-white">{{ $paginatedData->total() }}</span>
            </span>
            <ul class="inline-flex -space-x-px rtl:space-x-reverse text-sm h-8">
                <li>
                    <a href="{{ $paginatedData->previousPageUrl() }}"
                        class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">Previous</a>
                </li>
                @for ($i = 1; $i <= $paginatedData->lastPage(); $i++)
                    <li>
                        <a href="{{ $paginatedData->url($i) }}"
                            class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white {{ $paginatedData->currentPage() == $i ? 'text-blue-600 border-blue-300 bg-blue-50 hover:bg-blue-100 hover:text-blue-700' : '' }}">
                            {{ $i }}
                        </a>
                    </li>
                @endfor
                <li>
                    <a href="{{ $paginatedData->nextPageUrl() }}"
                        class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">Next</a>
                </li>
            </ul>
        </nav>
    </div>

    <x-modal.modal-confirm text="Are you sure to mark this order as complete?" variant="confirm" />

    <div id="print" class="hidden">
        @include('reports.receipt')
    </div>
    <div id="print-receipt" class="hidden">
        <div id="receipt-content" class="p-4">
            <!-- Receipt content will be populated dynamically -->
        </div>
    </div>
    @include('modals/map')

    <script>
        function generateAndPrintReceipt(orderId) {
    // Fetch the order data (e.g., via an API or DOM dataset)
    const orderData = fetchOrderData(orderId); // Replace with your actual fetching logic.

    // Populate receipt content
    const receiptContent = `
        <div class="receipt-header">
            <h2>Order Receipt</h2>
            <p>Order ID: ${orderData.id}</p>
            <p>Date: ${orderData.date}</p>
        </div>
        <hr>
        <div class="receipt-body">
            <h3>Customer Details</h3>
            <p>Name: ${orderData.customer.firstname} ${orderData.customer.lastname}</p>
            <p>Email: ${orderData.customer.email}</p>
            <p>Contact: ${orderData.customer.contactnum}</p>
        </div>
        <hr>
        <div class="receipt-items">
            <h3>Order Items</h3>
            <ul>
                ${orderData.items.map(item => `
                    <li>${item.quantity} x ${item.name} - ${item.price} PHP</li>
                `).join('')}
            </ul>
        </div>
        <hr>
        <div class="receipt-footer">
            <p>Total: ${orderData.total} PHP</p>
            <p>Payment Type: ${orderData.payment_type}</p>
        </div>
    `;

    // Insert the receipt content into the container
    document.getElementById('receipt-content').innerHTML = receiptContent;

    // Print the receipt
    printReceipt();
}

async function fetchOrderData(orderId) {
    try {
        // Use the fetch API to call the backend endpoint
        const response = await fetch(`/orders/${orderId}`);
        
        // Check if the response is successful
        if (!response.ok) {
            throw new Error(`Error fetching order data: ${response.statusText}`);
        }

        // Parse the JSON data
        const orderData = await response.json();

        // Format the data appropriately for use in the receipt
        return {
            id: orderData.id,
            date: new Date(orderData.created_at).toLocaleDateString(), // Assuming `created_at` field exists
            customer: {
                firstname: orderData.customer.firstname || "N/A",
                lastname: orderData.customer.lastname || "N/A",
                email: orderData.customer.email || "N/A",
                contactnum: orderData.customer.contactnum || "N/A"
            },
            items: orderData.items.map(item => ({
                name: item.name,
                quantity: item.quantity,
                price: item.price
            })),
            total: orderData.total || 0,
            payment_type: orderData.payment_type || "Unknown"
        };
    } catch (error) {
        alert("Failed to fetch order data:", error);
        return null; // Return null in case of an error
    }
}

function printReceipt() {
    const receiptContent = document.getElementById('print-receipt').innerHTML;
    const printWindow = window.open('', '_blank', 'width=800,height=600');
    printWindow.document.open();
    printWindow.document.write(`
        <html>
        <head>
            <title>Order Receipt</title>
            <style>
                body { font-family: Arial, sans-serif; line-height: 1.6; margin: 20px; }
                .receipt-header, .receipt-body, .receipt-footer { margin-bottom: 20px; }
                h2, h3 { margin: 0 0 10px; }
                hr { border: 0; border-top: 1px solid #ccc; margin: 20px 0; }
            </style>
        </head>
        <body>
            ${receiptContent}
        </body>
        </html>
    `);
    printWindow.document.close();
    printWindow.focus();
    printWindow.print();
    printWindow.close();
}

        
        // function PrintReceiptContent(el) {
        //     var data =
        //         '<input onClick="window.print()" type="button" id="printPageButton" style="width: 100%; background: blue; border: none; color:white; bottom: 0; position: absolute; padding: 10px; font-size: 1rem; text-alignment:center; z-index: 10;" value="Print Receipt">';
        //     data += document.getElementById(el).innerHTML;


        //     document.getElementById(el).innerHTML;
        //     receipt = window.open("", "win", "left=150", "top=130", "width=100", "height=100%");
        //     receipt.document.write(data);
        //     receipt.document.title = "Print Receipt";
        //     receipt.focus();


        // };
        
    </script>
@endsection
