@extends('layouts.admin')

@section('title')
    <title>
        Dashboard</title>
@endsection

@section('content')
<div class="bg-gray-900 min-h-screen text-gray-200 ">

    <!-- Header -->
    <div class="border-b border-gray-800  ">
        <div class="mx-auto max-w-screen-2xl py-5 px-4 sm:px-6 lg:px-8 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-white">Dashboard</h1>
            <div class="flex items-center space-x-4">
                <span class="text-sm text-gray-400">{{ now()->format('F d, Y') }}</span>
                <div class="relative">
                    <button class="p-1 rounded-full text-gray-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                        </svg>
                    </button>
                    <span class="absolute top-0 right-0 block h-2 w-2 rounded-full bg-blue-500 ring-2 ring-gray-900"></span>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="mx-auto max-w-screen-2xl  px-4 sm:px-6 lg:px-8 py-8">
        <!-- Key Metrics -->
        <div  class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">
            
            <!-- Total Orders -->
            <div class="bg-gray-800 rounded-lg shadow-lg border border-gray-700 overflow-hidden ">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-blue-500 bg-opacity-20 rounded-md p-3">
                            <svg class="h-6 w-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                        </div>
                        <div class="ml-5">
                            <p class="text-sm font-medium text-gray-400">Orders This Month</p>
                            <p class="text-2xl font-bold text-white">{{ $currentMonthOrders }}</p>
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="flex items-center text-sm">
                            <span class="{{ $orderGrowth >= 0 ? 'text-green-400' : 'text-red-400' }} flex items-center">
                                <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="{{ $orderGrowth >= 0 ? 'M5 10l7-7m0 0l7 7m-7-7v18' : 'M19 14l-7 7m0 0l-7-7m7 7V3' }}"></path>
                                </svg>
                                {{ number_format($orderGrowth, 2) }}%
                            </span>
                            <span class="text-gray-500 ml-2">from last month</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Total Earnings -->
            <div class="bg-gray-800 rounded-lg shadow-lg overflow-hidden border border-gray-700">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-green-500 bg-opacity-20 rounded-md p-3">
                            <svg class="h-6 w-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="ml-5">

                            <p class="text-sm font-medium text-gray-400">Earnings This Month</p>
                            <p class="text-2xl font-bold text-white">₱{{ $currentMonthEarnings }}</p>
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="flex items-center text-sm">
                            <span class="{{ $earningsGrowth >= 0 ? 'text-green-400' : 'text-red-400' }} flex items-center">
                                <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="{{ $earningsGrowth >= 0 ? 'M5 10l7-7m0 0l7 7m-7-7v18' : 'M19 14l-7 7m0 0l-7-7m7 7V3' }}"></path>
                                </svg>
                                {{ number_format($earningsGrowth, 2) }}%
                            </span>
                            <span class="text-gray-500 ml-2">from last month</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Waters Sold -->
            <div class="bg-gray-800 rounded-lg shadow-lg overflow-hidden border border-gray-700">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-purple-500 bg-opacity-20 rounded-md p-3">
                            <svg class="h-6 w-6 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                            </svg>
                        </div>
                        <div class="ml-5">
                            <p class="text-sm font-medium text-gray-400">Products Sold This Month</p>
                            <p class="text-2xl font-bold text-white">{{ $currentMonthWatersSold }}</p>
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="flex items-center text-sm">
                            <span class="{{ $watersSoldGrowth >= 0 ? 'text-green-400' : 'text-red-400' }} flex items-center">
                                <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="{{ $watersSoldGrowth >= 0 ? 'M5 10l7-7m0 0l7 7m-7-7v18' : 'M19 14l-7 7m0 0l-7-7m7 7V3' }}"></path>
                                </svg>
                                {{ number_format($watersSoldGrowth, 2) }}%
                            </span>
                            <span class="text-gray-500 ml-2">from last month</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Pending Deliveries -->
            <div class="bg-gray-800 rounded-lg shadow-lg overflow-hidden border border-gray-700">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-yellow-500 bg-opacity-20 rounded-md p-3">
                            <svg class="h-6 w-6 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="ml-5">
                            <p class="text-sm font-medium text-gray-400">Pending Deliveries</p>
                            <p class="text-2xl font-bold text-white">{{ $pendingDeliveries }}</p>
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="flex items-center text-sm">
                        <div class="flex items-center text-sm">
                            <span class="text-yellow-400">
                                Estimated:
                                <strong class="text-white">{{ now()->addDays(1)->format('M d') }} - {{ now()->addDays(3)->format('M d, Y') }}</strong>
                            </span>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Charts Section -->

        <div class="mt-8 grid grid-cols-1 gap-5 lg:grid-cols-2">
            <!-- Monthly Sales Chart -->
            <div class="grid grid-rows-1 lg:grid-rows-1 grid-cols-1">
                <div class="bg-gray-800 rounded-lg shadow-lg overflow-hidden border border-gray-700 row-span-1">
                    <div class="p-5">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-medium text-white">Yearly Sales</h3>
                       
                        </div>
                        <div class="mt-6 h-72">
                            <canvas id="yearlySalesChart"></canvas>
                        </div>
                    </div>
                </div>
                <!-- Top Selling Products -->
                <div class="mt-8">
                    <div class="bg-gray-800 border border-gray-700 lg:col-span-2 rounded-xl shadow-lg overflow-hidden">
                        <div class="px-6 py-5">
                            <h3 class="text-lg font-semibold text-white">Top Selling Products</h3>
                            <div class="mt-6 grid grid-cols-1 gap-6 xl:grid-cols-3">
                                @foreach($topSellingProducts as $index => $product)
                                <div class="rounded-lg p-4">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 rounded-lg  p-3 {{ ['bg-blue-100', 'bg-green-100', 'bg-purple-100'][$index] }}">
                                            <svg class="h-6 w-6 {{ ['text-blue-600', 'text-green-600', 'text-purple-600'][$index] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                            </svg>
                                        </div>
                                        <div class="ml-4">
                                            <p class="text-lg font-medium text-white">{{ $product['product_name'] }}</p>
                                            <p class="text-sm text-gray-300">{{ $product['total_quantity'] }} units sold</p>
                                        </div>
                                    </div>
                                    <div class="mt-4">
                                        <div class="relative pt-1">
                                            <div class="overflow-hidden h-2 text-xs flex rounded {{ ['bg-gray-700', 'bg-gray-700', 'bg-gray-700'][$index] }}">
                                                <div style="width: {{ $watersSold != 0 ? ($product['total_quantity'] / $watersSold) * 100 : 0 }}%" 
                                                    class="{{ ['bg-blue-500', 'bg-green-500', 'bg-purple-500'][$index] }} shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center">
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Orders by Hour Chart -->
            <div class="grid lg:grid-cols-2 gap-6">
                <!-- Orders By Hour Chart -->
                <div class="bg-gray-800 rounded-lg shadow-lg overflow-hidden border border-gray-700 col-span-2">
                    <div class="px-4 py-5 sm:p-6">
                        <h3 class="text-lg leading-6 font-medium text-white">Orders By Hour</h3>
                        <div class="mt-4 h-30">
                            <canvas id="ordersByHourChart"></canvas>
                        </div>
                    </div>
                </div>

                <div class="grid lg:grid-rows-3 gap-5 col-span-2 xl:col-span-1">
                <!-- Average Delivery Time -->
                    <div class="bg-gray-800 rounded-lg shadow-lg overflow-hidden border border-gray-700 col-span-1">
                        <div class="px-4 py-5 sm:p-6">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 bg-purple-500 bg-opacity-30 rounded-md p-3">
                                    <svg class="h-6 w-6 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div class="ml-5 w-0 flex-1">
                                    <dl>
                                        <dt class="text-sm font-medium text-gray-500 truncate">Average Delivery Time</dt>
                                        <dd class="flex items-baseline">
                                            <div class="text-2xl font-semibold text-white">
                                                {{ $averageDeliveryTime ? round($averageDeliveryTime, 2) : 0 }} min
                                            </div>
                                        </dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- Orders Completed Today --}}
                    <div class="bg-gray-800 rounded-lg shadow-lg overflow-hidden border border-gray-700 col-span-1">
                        <div class="px-4 py-5 sm:p-6">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 bg-green-500 bg-opacity-30 rounded-md p-3">
                                    <svg class="h-6 w-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                    </svg>
                                </div>
                                <div class="ml-5 w-0 flex-1">
                                    <dl>
                                        <dt class="text-sm font-medium text-gray-500 truncate">Orders Completed Today</dt>
                                        <dd class="flex items-baseline">
                                            <div class="text-2xl font-semibold text-white">
                                                {{ $ordersCompletedToday ?? 0 }} 
                                            </div>
                                        </dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- New Customers This Month --}}
                    <div class="bg-gray-800 rounded-lg shadow-lg overflow-hidden border border-gray-700 col-span-1">
                        <div class="px-4 py-5 sm:p-6">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 bg-cyan-500 bg-opacity-30 rounded-md p-3">
                                    <svg class="h-6 w-6 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5.121 17.804A4.002 4.002 0 018 15h8a4.002 4.002 0 012.879 2.804M12 14a5 5 0 100-10 5 5 0 000 10z" />
                                    </svg>
                                </div>
                                <div class="ml-5 w-0 flex-1">
                                    <dl>
                                        <dt class="text-sm font-medium text-gray-500 truncate">New Customers This Month</dt>
                                        <dd class="flex items-baseline">
                                            <div class="text-2xl font-semibold text-white">
                                                {{ $newCustomersThisMonth }} 
                                            </div>
                                        </dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Order Status Chart -->
                <div class="bg-gray-800 rounded-lg shadow-lg overflow-hidden border border-gray-700 col-span-2 xl:col-span-1">
                    <div class="p-5">
                        <h3 class="text-lg font-medium text-white">Order Status</h3>
                    <div class="mt-6 h-full">
                        <canvas id="orderStatusChart"></canvas>
                    </div>

                </div>
            </div>
            </div>
        </div>
        
        <!-- Order Details and Recent Orders -->
        <div x-data="orderState()" x-init="initOrder(); initProducts()" class="grid grid-cols-4 gap-5 mt-8 grid-rows-3">
                @csrf
                <!-- Recent Orders Table -->
                <div class="bg-gray-800 rounded-lg shadow-lg overflow-hidden border border-gray-700 col-span-4 xl:col-span-2 row-span-1">
                    <div class="p-5">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-medium text-white">Recent Orders</h3>
                            <button type="button" class="text-sm font-medium text-white hover:text-gray-200 bg-blue-600 px-2 py-2 rounded-lg hover:bg-blue-500 ">Add Order</button>
                        </div>

                        <div class="mt-6 overflow-hidden">
                            <table class="min-w-full divide-y divide-gray-700">
                                <thead>
                                    <tr>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Order ID</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Customer</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Order Total</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Date</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Status</th>
                                    </tr>
                                </thead>
                                
                                <tbody class="divide-y divide-gray-700">
                                    @foreach($recentOrders->items() as $order)
                                    <tr class="hover:bg-gray-700 cursor-pointer"
                                        :class="selectedOrder.id === {{ $order->id }} ? 'bg-gray-700' : ''"
                                        @click="
                                            if (selectedOrder.id !== {{ $order->id }}) {
                                                selectOrder({{ $order->id }});
                                            } else {
                                                revertToDefault();
                                            }
                                        "
                                    >
                                        <td class="px-4 py-4 whitespace-nowrap text-sm font-medium text-gray-300">#{{ $order->id }}</td>
                                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-400">
                                            {{ $order->customer->firstname }} {{ $order->customer->lastname }}
                                        </td>
                                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-400">
                                            ₱{{ number_format($order->total, 2) }}
                                        </td>
                                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-400">
                                            {{ \Carbon\Carbon::parse($order->created_at)->format('M d, Y') }}
                                        </td>
                                        <td class="px-4 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                                {{ $order->delivery && $order->delivery->delivery_status == 1 ? 'bg-yellow-900 text-yellow-300' : '' }}
                                                {{ $order->delivery && $order->delivery->delivery_status == 2 ? 'bg-green-900 text-green-300' : '' }}
                                                {{ $order->delivery && $order->delivery->delivery_status == 3 ? 'bg-red-900 text-red-300' : '' }}"
                                            >
                                                {{ $order->delivery && $order->delivery->deliverystatus ? $order->delivery->deliverystatus->name : 'On-site' }}
                                            </span>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination Controls -->
                        <div class="mt-4 flex items-center justify-between text-gray-400 text-sm">
                            <span>
                                Page {{ $recentOrders->currentPage() }} of {{ $recentOrders->lastPage() }}
                            </span>
                            
                            <div class="flex space-x-2">
                                <a 
                                    href="{{ $recentOrders->url(1) }}" 
                                    class="px-3 py-1 bg-gray-700 text-white rounded-md hover:bg-gray-600 {{ $recentOrders->onFirstPage() ? 'opacity-50 pointer-events-none' : '' }}"
                                >
                                    First
                                </a>
                                <a 
                                    href="{{ $recentOrders->previousPageUrl() }}" 
                                    class="px-3 py-1 bg-gray-700 text-white rounded-md hover:bg-gray-600 {{ $recentOrders->onFirstPage() ? 'opacity-50 pointer-events-none' : '' }}"
                                >
                                    Prev
                                </a>
                                <a 
                                    href="{{ $recentOrders->nextPageUrl() }}" 
                                    class="px-3 py-1 bg-gray-700 text-white rounded-md hover:bg-gray-600 {{ $recentOrders->hasMorePages() ? '' : 'opacity-50 pointer-events-none' }}"
                                >
                                    Next
                                </a>
                                <a 
                                    href="{{ $recentOrders->url($recentOrders->lastPage()) }}" 
                                    class="px-3 py-1 bg-gray-700 text-white rounded-md hover:bg-gray-600 {{ $recentOrders->currentPage() === $recentOrders->lastPage() ? 'opacity-50 pointer-events-none' : '' }}"
                                >
                                    Last
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
    
                <!-- Order Details Panel -->
                <div class="bg-gray-800 rounded-lg shadow-lg overflow-hidden border border-gray-700 col-span-4 xl:col-span-2 row-span-2 h-fit">
                    <div class="px-4 py-5 sm:p-6">
                        <div class="flex items-center justify-between ">
                            <h3 class="text-lg leading-6 font-medium text-white">Order ID: <span x-text="selectedOrder.id"></span></h3>
                            <span class="text-sm font-medium text-blue-400 hover:text-blue-300" x-text="selectedOrder.delivery?.deliverystatus.name"></span>
                        </div>
                       
                        <div class="mt-4 space-y-4">
                            <div class="grid grid-cols-2 gap-4 mt-4 text-sm text-gray-400">
    
                                <div>
                                    <strong>Purchase Type: </strong>
                                    <span x-text="selectedOrder.purchase_type"></span>
                                </div>
                                <div>
                                    <strong>Payment Type:</strong>
                                    <span x-text="selectedOrder.payment_type"></span>
                                </div>
    
                                <div>
                                    <strong>Contact Number:</strong>
                                    <span x-text="selectedOrder.customer?.contactnum || 'N/A'"></span>
                                </div>
                                <div>
                                    <strong>Email:</strong>
                                    <span x-text="selectedOrder.customer?.email || 'N/A'"></span>
                                </div>
    
                                <div class="col-span-2">
                                    <strong><span x-text="selectedOrder.delivery ? 'Delivery Address' : 'Customer Address'"></span></strong>
                                    <span x-text="selectedOrder.delivery?.delivery_address || selectedOrder.customer.address?.streetaddress + selectedOrder.customer.address?.barangay + selectedOrder.customer.address?.city"></span>
                                </div>
                                <div 
                                    x-show="selectedOrder.delivery" 
                                    class="col-span-2"
                                >
                                    <strong>Special Instructions:</strong>
                                    <span x-text="selectedOrder.delivery?.special_instruction || 'N/A'"></span>

                                </div>
    
                                <!-- Contact Number -->
       
                            </div>
    
                            <!-- Order Items / Water Ordered -->
                            <div class="mt-4">
                                <div class="flex items-center justify-between">
                                    <h4 class="text-md font-semibold text-white">Order Items</h4>
                                    <button type="button" 
                                        @click="
                                            if (isEditingItems) { 
                                                revertOrderItems(); 
                                            } else {
                                                isEditingItems = true;
                                            }
                                        " 
                                        class="bg-blue-600 text-white text-sm px-4 py-2 rounded-lg hover:bg-blue-500"
                                    >
                                        <span x-text="isEditingItems ? 'Revert Changes' : 'Edit'">Edit</span>
                                    </button>
                                </div>
    
                                <table class="min-w-full divide-y divide-gray-700 mt-4">
                                    <thead>
                                        <tr>
                                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Product</th>
                                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Unit Cost</th>
                                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Subtotal</th>
                                            <th x-show="isEditingItems" class="px-4 py-2 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Quantity</th>
                                            <th x-show="isEditingItems" class="px-4 py-2 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-700">
                                        <template x-for="line in selectedOrder.orderline" :key="line.id">
                                            <tr>
                                                <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-300" x-text="line.water.name + ' x' + line.quantity"></td>
    
                                                <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-400">
                                                    ₱<span x-text="Number(line.water.cost).toFixed(2)"></span>
                                                </td>
    
                                                <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-400">
                                                    ₱<span x-text="Number(line.subtotal).toFixed(2)"></span>
                                                </td>
    
                                                <td x-show="isEditingItems" class="px-4 py-2 whitespace-nowrap text-sm text-gray-300">
                                                    <div class="flex space-x-2">
                                                        <button type="button"
                                                            @click="if (line.quantity > 1) { line.quantity--; updateOrderItems(line); }" 
                                                            class="bg-red-600 text-white px-2 py-1 text-xs rounded hover:bg-red-700"
                                                        >
                                                            -
                                                        </button>
                                                        
                                                        <span x-text="line.quantity" class="text-gray-300 px-2"></span>
    
                                                        <button type="button"
                                                        
                                                            @click="line.quantity++; updateOrderItems(line)" 
                                                            class="bg-green-600 text-white px-2 py-1 text-xs rounded hover:bg-green-700"
                                                        >
                                                            +
                                                        </button>
                                                      
                                                    </div>
                                                </td>
                                                <td x-show="isEditingItems" class="px-4 py-2 whitespace-nowrap text-sm text-gray-400">
                                                    <button  type="button"
                                                        @click="selectedOrder.orderline = selectedOrder.orderline.filter(item => item.id !== line.id); updateOrderItems();" 
                                                        class="bg-red-600 text-white px-2 py-1 text-xs rounded hover:bg-red-700"
                                                    >
                                                        Remove
                                                    </button>
                                                </td>
                                                
                                            </tr>
                                        </template>
                                        <tr x-show="isEditingItems" x-cloak>
                                            <td colspan="5" class="text-center py-4">
                                                <button 
                                                    type="button"
                                                    @click="showAddItemModal = true"
                                                    class="bg-blue-600 text-white px-4 py-2 text-sm rounded hover:bg-blue-700"
                                                >
                                                    + Add Item
                                                </button>
                                            </td>
                                        </tr>

                                        <tr x-show="selectedOrder.delivery">
                                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Charges</th>
                                        </tr>
                                        <tr x-show="selectedOrder.delivery">
                                            <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-300">Delivery Fee</td>
                                            <td ></td>
                                             <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-400" >₱<span x-text="selectedOrder.delivery_fee"></span></td>
                                        </tr>
                                        <tr>
                                            <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-400">
                                                TOTAL
                                            </td>
                                            <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-400">
                                            </td>
                                            <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-400">
                                                ₱<span x-text="selectedOrder.total"></span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
    
                            <div class="mt-6 space-y-2" >
                                <!-- Mark As Button -->
                                <div class="flex items-center justify-between gap-2">
                                    <button type="button"
                                        @click.prevent="showPopup = true"
                                        class="bg-blue-600 bg-opacity-30 text-blue-400 w-full text-sm px-4 py-2 rounded-lg hover:bg-blue-800 hover:bg-opacity-30 hover:text-blue-500 "
                                    >
                                        <span x-text="selectedStatus != null ? `Marked as ${statusText}` : 'Mark as'">Mark as</span>
                                    </button>
                                    <button type="button"
                                    x-cloak
                                        @click.prevent="showReceipt = true; console.log(selectedOrder.id)"
                                        x-show="selectedOrder.delivery == null || selectedOrder.delivery.delivery_status == 2"
                                        class="bg-gray-600 bg-opacity-30 text-gray-300 w-full text-sm px-4 py-2 rounded-lg hover:bg-gray-700 hover:bg-opacity-30 hover:text-gray-200"
                                    >
                                        <span > Generate Receipt</span>
                                    </button>
    
                                </div>
                                
    
                                
                                <!-- Save Changes Button -->
                                <button 
                                    @click.prevent="saveOrderChanges()" 
                                    :disabled="selectedOrder.orderline.length === 0" 
                                    class="bg-green-600 bg-opacity-30 text-green-400 w-full text-sm px-4 py-2 rounded-lg hover:bg-green-800 hover:bg-opacity-30 hover:text-green-500 disabled:bg-gray-700 disabled:text-gray-300"
                                >
                                    Save Changes
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            <!-- Add item MOdALS -->
                <div 
                    x-show="showAddItemModal" 
                    x-cloak
                    class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50"
                >
                    <div class="bg-gray-800 text-white rounded-lg shadow-lg w-1/3 p-6">
                        <h2 class="text-lg font-semibold mb-4">Add Item</h2>
                        
                        <!-- Select Product and Unit Price -->
                        <!-- Select Product and Unit Price -->
                        <div class="mb-4 grid grid-cols-2 gap-4">
                            <!-- Select Product -->
                            <div>
                                <label class="block text-sm font-medium text-gray-500">Select Product</label>
                                <select 
                                    x-model="newItem.water_id" 
                                    @change="updateNewItemCost()" 
                                    class="w-full bg-gray-700 text-white text-sm px-4 py-2 rounded-lg"
                                >
                                    <option value="" disabled>Select a product</option>
                                    <template x-for="product in productList" :key="product.id">
                                        <option :value="product.id" x-text="product.name"></option>
                                    </template>
                                </select>
                            </div>

                            <!-- Unit Price -->
                            <div>
                                <label class="block text-sm font-medium text-gray-500">Unit Price</label>
                                    <span 
                                        class="block text-xl font-medium text-white"
                                        x-text="newItem.water_id ? `₱${productList.find(p => p.id == newItem.water_id)?.cost || 0}` : 'Select a product'"
                                    ></span>
                            </div>
                        </div>


                        <!-- Quantity -->
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-500">Quantity</label>
                            <input 
                                type="number" 
                                x-model.number="newItem.quantity" 
                                @input="updateNewItemCost()"
                                min="1"
                                class="w-full border bg-gray-700 text-white text-sm px-4 py-2 rounded-lg"
                            />
                        </div>

                        <!-- Subtotal (Calculated) -->
                        <div class="mb-4" x-show="newItem.subtotal > 0">
                            <label class="block text-sm font-medium text-gray-500">Subtotal</label>
                            <input 
                                type="text" 
                                
                                x-model="newItem.subtotal" 
                                readonly 
                                class="w-full border bg-gray-700 text-white text-sm px-4 py-2 rounded-lg"
                            />
                        </div>

                        <!-- Modal Actions -->
                        <div class="flex justify-end space-x-2">
                            <button 
                                @click="showAddItemModal = false"
                                class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500"
                            >
                                Cancel
                            </button>
                            <button 
                                @click="addNewItem()"
                                class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700"
                            >
                                Add Item
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Receipt Modal -->
                <div x-cloak x-show="showReceipt" id="receiptModal" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center">
                    <div class="w-[90%] max-w-2xl bg-white rounded-lg shadow-lg p-4 ">
                        <div class="flex justify-between items-center mb-4">
                            <h2 class="text-lg font-semibold text-gray-900">Receipt</h2>
                            <button type="button" onclick="closeReceiptModal()" class="text-gray-600 hover:text-gray-900">&times;</button>
                        </div>
                        
                        <iframe id="receiptFrame" class="w-full h-[500px] border" :src="`/receipt/${selectedOrder.id}`"></iframe>
                        
                        <div class="flex justify-end space-x-2 mt-4">
                            <button type="button" @click="window.print()" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg">Print</button>
                            <button type="button" @click="showReceipt = false" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded-lg">Close</button>
                        </div>
                    </div>
                </div>

                <!-- Status Popup/Modal -->
                <div 
                    x-show="showPopup" 
                    x-cloak
                    @click.away="showPopup = false"
                    class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center"
                >
                    <div class="bg-gray-800 text-white rounded-lg shadow-lg w-1/3 p-6">
                        <h2 class="text-lg font-semibold mb-4">Select Order Status</h2>

                        <!-- Status Options -->
                        <select 
                            x-model="selectedStatus"
                            @change="
                                statusText = selectedStatus == 1 ? 'In Progress' : 
                                            selectedStatus == 2 ? 'Completed' : 
                                            selectedStatus == 3 ? 'Cancelled' : 'Mark As';
                                showPopup = false;
                            "
                            class="w-full bg-gray-700 text-white text-sm px-4 py-2 rounded-lg"
                        >
                            <option 
                                value="1" 
                            >
                                In Progress
                            </option>
                            
                            <option 
                                value="2" 
                            >
                                Completed
                            </option>
                            
                            
                            <option 
                                value="3" 
                            >
                                Cancelled
                            </option>
                        </select>

                        <div class="mt-4 flex justify-end space-x-2">
                            <button type="button" @click="showPopup = false" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600">Cancel</button>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.10.5/dist/cdn.min.js" defer></script>

    <script>
        window.ordersData = @json($recentOrders);

        function orderState() {
            return {
                // STATES
                orders: [], 
                selectedOrder: {},
                originalOrder: {},
                showAddItemModal : false,
                isEditingItems: false,
                showReceipt: false,
                showPopup: false,
                showAddOrderModal: false,
                selectedStatus: null,
                statusText: '',
                productList: [],
                showAddItemModal: false,
                newItem: {},
                
                initOrder() {
                    
                    this.orders = window.ordersData.data || []; 

                    console.log('order: ', this.order);

                    if (this.orders.length > 0) {
                        this.selectOrder(this.orders[0].id); 

                    }
                },

                async initProducts() {    
                    const response = await fetch('/api/products')
                        .then(response => response.json())
                        .then(data => data); 

                    if(response) {
                        this.productList = response;
                    }
                    else {
                        alert('Error fetching products');
                    }
                    newItem = this.productList[0];
                },

                updateNewItemCost() {
                    const product = this.productList.find(p => p.id == this.newItem.water_id);
                    if (product) {
                        this.newItem.subtotal = this.newItem.quantity * product.cost;
                    } else {
                        this.newItem.subtotal = 0;
                    }
                },

                addNewItem() {
                    const product = this.productList.find(p => p.id == this.newItem.water_id);
                    if (product) {
                        this.selectedOrder.orderline.push({
                            id: Date.now(), 
                            water: product,
                            quantity: this.newItem.quantity,
                            subtotal: this.newItem.subtotal,
                        });
                        this.updateOrderItems();
                        this.showAddItemModal = false; 
                        this.resetNewItem(); 
                    }
                },

                resetNewItem() {
                    this.newItem = {
                        water_id: null,
                        quantity: 1,
                        subtotal: 0,
                    };
                },

                selectOrder(orderId) {

                    const order = this.orders.find(o => o.id === orderId);

                    if (order) {
                        if (this.selectedOrder.id !== orderId) {
                            this.selectedOrder = JSON.parse(JSON.stringify(order));
                            this.originalOrder = JSON.parse(JSON.stringify(order));
                            this.revertToDefault();
                        } else {
                            this.revertOrderItems();
                        }
                    }


                },

                revertOrderItems() {
                    this.selectedOrder = JSON.parse(JSON.stringify(this.originalOrder));
                    this.isEditingItems = false;
                },
                updateOrderItems() {
                    this.selectedOrder.orderline.forEach(line => {
                        line.subtotal = line.quantity * line.water.cost;
                    });
                    this.selectedOrder.total = this.selectedOrder.orderline.reduce((acc, line) => acc + line.subtotal, 0) + this.selectedOrder.delivery_fee;
                },
                revertToDefault() {
                    this.revertOrderItems();
                    this.statusText = '';
                    this.selectedStatus = null;
                },

                async saveOrderChanges() {
                    const payload = {
                        order_id: this.selectedOrder.id,
                        purchase_type: this.selectedOrder.purchase_type,
                        payment_type: this.selectedOrder.payment_type,
                        delivery_fee: this.selectedOrder.delivery_fee,
                        total: this.selectedOrder.total,
                        orderlines: this.selectedOrder.orderline.map(line => ({
                            id: line.id,
                            water_id: line.water.id,
                            quantity: line.quantity,
                            subtotal: line.subtotal,
                        })),
                        delivery: this.selectedOrder.delivery
                            ? {
                                id: this.selectedOrder.delivery.id,
                                delivery_address: this.selectedOrder.delivery.delivery_address,
                                delivery_status: this.selectedStatus,
                                special_instruction: this.selectedOrder.delivery.special_instruction,
                            }
                            : null,
                    };

                    console.log(payload);

                    const response = await fetch(`/admin/orders/${this.selectedOrder.id}`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        },
                        body: JSON.stringify(payload),
                    });

                    if (response.ok) {
                        window.location.reload(), 5000;
                    } else {
                        alert('Error saving changes');
                    }
                },

            };
        }

        function paginationHandler() {
            return {
                orders: window.ordersData.data || [],
                currentPage: initialData.current_page,
                lastPage: initialData.last_page,

                async fetchPage(page) {
                    // Fetch data from server without full reload
                    const response = await fetch(`?page=${page}`);
                    const data = await response.json();

                    // Update orders and pagination info
                    this.orders = data.data;
                    this.currentPage = data.current_page;
                    this.lastPage = data.last_page;

                    // Scroll to the order table after updating
                    this.$nextTick(() => {
                        document.querySelector('#orderTable').scrollIntoView({
                            behavior: 'smooth',
                            block: 'start',
                        });
                    });
                }
            }
        }


            // Monthly Sales Chart
        const yearlySalesCtx = document.getElementById('yearlySalesChart').getContext('2d');
        const maxMonth = new Date().getMonth() + 1;

        const currentYearData = Array(maxMonth).fill(0);
        const previousYearData = Array(maxMonth).fill(0);

        @foreach($currentYearSales as $sale)
            currentYearData[{{ $sale->month }} - 1] = {{ $sale->total }};
        @endforeach

        @foreach($previousYearSales as $sale)
            previousYearData[{{ $sale->month }} - 1] = {{ $sale->total }};
        @endforeach

        const labels = [];
        for (let i = 1; i <= maxMonth; i++) {
            labels.push(new Date(2000, i - 1, 1).toLocaleString('default', { month: 'long' }));
        }

        const yearlySalesChart = new Chart(yearlySalesCtx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [
                    {
                        label: 'This Year',
                        data: currentYearData,
                        backgroundColor: 'rgba(59, 130, 246, 0.2)',
                        borderColor: 'rgba(59, 130, 246, 1)',
                        borderWidth: 2,
                        tension: 0.3
                    },
                    {
                        label: 'Last Year',
                        data: previousYearData,
                        backgroundColor: 'rgba(34, 197, 94, 0.2)',
                        borderColor: 'rgba(34, 197, 94, 1)',
                        borderWidth: 2,
                        tension: 0.3
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });


        // Top Selling Products Chart
        const orderStatusCtx = document.getElementById('orderStatusChart').getContext('2d');

        const statusColors = {
            'Completed': {
                bg: 'rgba(16, 185, 129, 0.6)',  
                border: 'rgba(16, 185, 129, 1)'
            },
            'In progress': {
                bg: 'rgba(59, 130, 246, 0.6)',  
                border: 'rgba(59, 130, 246, 1)'
            },
            'Cancelled': {
                bg: 'rgba(239, 68, 68, 0.6)',  
                border: 'rgba(239, 68, 68, 1)'
            }
        };
        const orderStatusChart = new Chart(orderStatusCtx, {
            type: 'doughnut',
            data: {
                labels: [
                    @foreach($orderDeliveryStatusBreakdown as $status)
                        '{{ $status['status_name'] }}',
                    @endforeach
                ],
                datasets: [{
                    data: [
                        @foreach($orderDeliveryStatusBreakdown as $status)
                            {{ $status['count'] }},
                        @endforeach
                    ],
                    backgroundColor: [
                        @foreach($orderDeliveryStatusBreakdown as $status)
                            statusColors['{{ $status['status_name'] }}']?.bg ?? 'rgba(156, 163, 175, 0.6)', 
                        @endforeach
                    ],
                    borderColor: [
                        @foreach($orderDeliveryStatusBreakdown as $status)
                            statusColors['{{ $status['status_name'] }}']?.border ?? 'rgba(156, 163, 175, 1)', 
                        @endforeach
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });


        // Orders By Hour Chart
        const ordersByHourCtx = document.getElementById('ordersByHourChart').getContext('2d');
        const ordersByHourChart = new Chart(ordersByHourCtx, {
            type: 'line',
            data: {
                labels: [
                    @foreach($ordersByHour as $hourData)
                        '{{ $hourData['hour'] }}:00',
                    @endforeach
                ],
                datasets: [{
                    label: 'Orders',
                    data: [
                        @foreach($ordersByHour as $hourData)
                            {{ $hourData['count'] }},
                        @endforeach
                    ],
                    backgroundColor: 'rgba(16, 185, 129, 0.2)',
                    borderColor: 'rgba(16, 185, 129, 1)',
                    borderWidth: 2,
                    tension: 0.3,
                    pointBackgroundColor: 'rgba(16, 185, 129, 1)',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    pointRadius: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0
                        }
                    }
                }
            }
        });

    </script>
@endpush
@endsection