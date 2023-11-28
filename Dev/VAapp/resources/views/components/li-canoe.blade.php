
<input {{$attributes->class(["w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500"])
    ->merge(['id' => $component->$canoe->name, 'type' => 'checkbox', 'value' => ''])}}>
<label {{$attributes->class(["ms-2 text-sm font-medium text-gray-900 dark:text-gray-300"])
    ->merge(['for' => $component->$canoe->name])}}>{{ $slot }}</label>
