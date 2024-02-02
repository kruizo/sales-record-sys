@props(['name' => '', 'id' => '', 'productName' => '', 'price' => '' , 'size' => ''])

<div class="card transition-all hover:cursor-pointer hover: w-full" id="{{ $id }}-card" onclick="toggleCard('{{ $id }}')">
    <div class="bg-gray-800 flex p-4 rounded-lg w-full">
        <div class="p-2 flex flex-col relative shadow-2xl w-full">
            <div class="relative">
                <h1 class="absolute text-2xl right-0 flex"><span class="">{{$size}}</span></h1>
                <h1 class="absolute text-2xl font-bold">₱{{$price}}</h1>
                <h1 class="absolute bottom-0 left-0 right-0 text-center text-3xl font-bold font-poppins">{{$productName}}</h1>

                <img src="{{ asset('assets/image/container1.png') }}" alt="" srcset="" class="object-contain justify-center items-center self-center w-full h-64 py-2" draggable="false">
            </div>
            <div id="{{ $id }}-hidden" class="hidden text-center mt-3" onclick="event.stopPropagation();">
                <h1 class="text-xl">Qty.</h1>
                <div class="flex justify-center items-center mt-3 gap-4">
                    <button type="button" class="bg-gray-900 p-4 rounded-lg" aria-label="Decrease quantity of Alkaline" onclick="decrementInput('{{ $id }}')"><i class="fa fa-minus" aria-hidden="true"></i></button>
                    <x-input-label for="{{$name}}" text="{{$productName}} Quantity" class='sr-only' />
                    <input name="product_{{$name}}" id="{{$id}}" value="0" class="bg-transparent min-w-6 w-auto max-w-10 text-center word-wrap" onchange="updateSubtotal('{{$id}}')"></input>
                    <button type="button" class="bg-gray-900 p-4 rounded-lg hover:scale-110 hover:transition-all " aria-label="Increase quantity of Alkaline" onclick="incrementInput('{{ $id }}')">
                        <i class="fa fa-plus" aria-hidden="true"></i>
                    </button>

                </div>
            </div>
        </div>
    </div>

</div>