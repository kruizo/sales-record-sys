@props(['title' => '', 'count' => '', 'id' => ''])

<div id="{{$id}}" {{$attributes->merge(['class' => 'shadow-lg rounded-lg p-6 text-black min-w-80 h-40'])}} >
    <div class="flex gap-2 text-lg h-fit">
        <img src="" alt="" srcset="">
        <h1>{{$title}}</h1>
    </div>
    <div class="text-6xl font-bold flex justify-end items-center h-full pb-6">
        {{ $count }}
    </div>

</div>