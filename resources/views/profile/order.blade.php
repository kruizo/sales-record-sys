@extends('layouts.app')

@section('title')
    <title>Adelflor</title>
@endsection

@section('content')
<div class="z-10 p-6 dark:bg-gray-950 min-h-screen max-w-screen-xl mx-auto sm:py-40 relative">
    <x-section-header text="Your orders" />
    <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown" 
        class="text-blue-600 h-fit mb-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
        {{ session('filter_order_by') ?? 'In progress' }}
        <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
        </svg>
    </button>

    <div id="dropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
            <li>
                <a href="{{route('profile.myorders', ['status=inprogress'])}}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">In progress</a>
            </li>
            <li>
                <a href="{{route('profile.myorders', ['status=completed'])}}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Completed</a>
            </li>
            <li>
                <a href="{{route('profile.myorders', ['status=cancelled'])}}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Cancelled</a>
            </li>
        </ul>
    </div>

    </button>
    <div class="flex w-full h-full space-x-3">
        <section id="item-list" class="w-full lg:w-full space-y-3 transition-all ease-in-out">
            @if ($orders->isEmpty())
                <div class="w-full px-2">
                    <h1>You have no orders.</h1>
                </div>
            @else
                @foreach ($orders as $order)
                    <div class="w-full border border-gray-800 rounded-lg p-4 bg-gray-900 shadow-lg">
                        <div class="flex justify-between items-center border-b border-gray-700 pb-2">
                            <h1 class="text-lg font-bold text-white">Order #{{$order->id}}</h1>
                            <h2 class="text-gray-400">{{$order->getFormattedCreatedAt()}}</h2>
                        </div>

                        <div class="mt-3">
                            @foreach ($order->orderline as $orderline)
                                <div class="flex items-center justify-between bg-gray-800 p-3 rounded-md mb-2">
                                    <div class="flex items-center">
                                        <img src="{{ asset('assets/image/container1.png') }}" class="object-contain h-16 w-16 mr-4" draggable="false">
                                        <div>
                                            <h1 class="text-white text-lg font-semibold">{{$orderline->water->name}}</h1>
                                            <p class="text-gray-400">Qty. x{{$orderline->quantity}}</p>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <h2 class="text-white font-semibold">₱{{$orderline->water->cost}}</h2>
                                        <h2 class="text-blue-500">Subtotal: ₱{{$orderline->subtotal}}</h2>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="mt-4 pt-6 border-t border-gray-700">
                            <h1 class="text-lg font-light text-white">ORDER SUMMARY</h1>
                            <div class="grid grid-cols-2 pt-3 items-start gap-y-2 text-gray-400">
                                <div>Delivery Date: <span class="font-semibold text-white">{{ $order->delivery->getFormattedDeliveryDate()  }}</span></div>
                                <div>Payment: <span class="font-semibold text-white">{{$order->payment_type}}</span></div>
                                <div>Status: <span class="font-semibold text-white">{{$order->getDeliveryStatus()[0]}}</span></div>
                                <div>Delivery Fee: <span class="font-semibold text-white">P {{$fee}}</span></div>
                                <div>Delivery Address: <span class="font-semibold text-white">{{$order->customer->getFullAddress()}}</span></div>
                            </div>
                        </div>

                        <div class="flex items-center justify-between mt-4">
                            <h2 class="text-white font-bold ">TOTAL: <span class="font-semibold text-white">₱{{$order->total}}</span></h2>
                            <div class="flex space-x-2 items-center h-full">
                                @if ($order->getDeliveryStatus()[1] === 'completed')
                                    <button 
                                        class="w-fit bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg"
                                        onclick="openReceiptModal('{{ route('receipt.show', ['id' => $order->id]) }}')">
                                        Generate Receipt
                                    </button>
                                @endif
                                @if ($order->getDeliveryStatus()[1] === 'inprogress')
                                    <form action="{{ route('order.destroy', $order->id) }}" method="POST" class="ml-2">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-full border border-red-500 text-red-500 hover:bg-red-500 hover:text-white font-bold py-2 px-2 rounded-lg">
                                            Cancel Order
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </section>
    </div>
</div>

<!-- Receipt Modal -->
<dialog id="receiptModal" class="w-[90%] max-w-2xl bg-white rounded-lg shadow-lg p-4">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-lg font-semibold text-gray-900">Receipt</h2>
        <button onclick="closeReceiptModal()" class="text-gray-600 hover:text-gray-900">&times;</button>
    </div>
    
    <iframe id="receiptFrame" class="w-full h-[500px] border"></iframe>
    
    <div class="flex justify-end space-x-2 mt-4">
        <button onclick="printReceipt()" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg">Print</button>
        <button onclick="closeReceiptModal()" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded-lg">Close</button>
    </div>
</dialog>

<script>
    function openReceiptModal(receiptUrl) {
        const modal = document.getElementById("receiptModal");
        const frame = document.getElementById("receiptFrame");
        frame.src = receiptUrl;
        modal.showModal();
    }

    function closeReceiptModal() {
        const modal = document.getElementById("receiptModal");
        modal.close();
    }

    function printReceipt() {
        const frame = document.getElementById("receiptFrame").contentWindow;
        frame.focus();
        frame.print();
    }
</script>

@endsection
