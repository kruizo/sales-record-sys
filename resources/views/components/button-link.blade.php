@props(['text' => 'Button','href' => ''])

<button {{ $attributes->merge(['class' => 'bg-transparent text-blue-700 inline-block hover:border-b-blue-700 dark:hover:text-gray-300']) }} id="register-tab" data-tabs-target="#register" type="button" role="tab" aria-controls="register" aria-selected="false">
    <a href="{{$href}}">{{ $text}}</a>
</button>