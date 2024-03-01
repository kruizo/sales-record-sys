
@props(['message' => ''])
<div {{ $attributes->merge(['class' => 'text-red-500 text-sm h-full flex items-center']) }}> <p>{{ $message }}</p> </div>
