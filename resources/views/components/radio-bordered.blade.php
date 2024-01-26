@props(['name'=> '', 'id'=>'', 'value'=> '' ,'checked' => false])

<div class="flex items-center ps-4 border border-gray-700 rounded ">
    <input {{$checked ? 'checked' : '' }}id="{{$id}}" type="radio" value="" name="{{$name}}" class="w-4 h-4 text-blue-600 bg-gray-700  focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
    <label for="{{$id}}" class="w-full py-4 ms-2 text-sm font-medium text-gray-300 hover:cursor-pointer">{{$value}}</label>
</div>