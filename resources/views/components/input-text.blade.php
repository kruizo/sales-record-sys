@props([
'disabled' => false,
'required' => false,
])

<input {{ $disabled ? 'disabled' : ''}} {{ $required ? 'required' : ''}} {{ $attributes->merge(['class' => 'bg-gray-900 border border-gray-700 text-gray-100 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white']) }}>