@props(['title' => '', 'count' => '','color' => '', 'id' => '','countId' => ''])

<div id="{{$id}}" {{$attributes->merge(['class' => 'shadow-lg rounded-lg p-6 text-black min-w-80 h-40'])}} >
    <div class="flex gap-2 text-lg h-fit items-center">
        {{ $slot }}
        <h1 class="text-{{$color}}">{{$title}}</h1>
    </div>
    <div class="text-6xl font-bold flex justify-end items-center h-full pb-6">
        <span id="{{$countId}}"></span>{{ $count }}
    </div>

</div>