<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased">
        <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-vaapp bg-center">
            @if (Route::has('login'))
                <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                    @auth
                        <a href="{{ route('dashboard.' . Auth::user()->status)}}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</a>
                    @endauth
                </div>
            @endif
            
            <div class="max-w-7xl mx-auto p-6 lg:p-8">
                <div class="flex justify-center">
                    <svg width="100px" height="100px" viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" class="iconify iconify--emojione" preserveAspectRatio="xMidYMid meet" fill="#000000">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"/>

                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"/>

                        <g id="SVGRepo_iconCarrier"> <path d="M6.1 38.9S.6 49.5 2.4 59c1.8 9.5 23.4-5.3 39.6-20.1c16.2-14.8 21.3-22 19.8-36.7c0 0 1.5 17.5-21.6 30.1C17 44.8 7.9 41.4 6.1 38.9" fill="#eda454"> </path> <path d="M40.2 32.3C56 23.6 60.3 12.7 61.4 6.7c.4-2.5.4-4.2.4-4.5c0-1.5-5.6 7.2-12.4 11.5c-6.8 4.3-30.6 22.2-34.3 25.2c-3.7 3-9 0-9 0c1.8 2.5 10.9 5.9 34.1-6.6" fill="#f9b978"> </path> <g fill="#3e4347"> <path d="M32.4 27.2c-7.5 5.6-14.8 11.1-16.7 12.6c-.1.1-.2.2-.4.3c4.8-.4 12.6-2.4 24.4-8.8c2.4-1.3 4.5-2.7 6.4-4.1H32.4"> </path> <path d="M60.1 5.1c-2.3 2.6-6 6.9-10.3 9.6c-2.5 1.6-7.5 5.1-12.9 9.1h13.2c7.1-6.6 9.4-13.3 10.1-17.4c.1-.7.2-1.3.2-1.9c.1.2-.1.4-.3.6"> </path> <path d="M26.1 35.2c.6 1.2 2.2 8.6 4.2 12.6l.3.6c1.5-1.1 3-2.3 4.5-3.5c0-.1-.1-.2-.1-.2c-1.9-3.8-6.8-9.3-7.4-10.5c-.6-1.2-1.1-2.4-1.7-3.5c-.5.4-1.1.8-1.6 1.2c.6 1 1.2 2.1 1.8 3.3" opacity=".5"> </path> </g> <path d="M27.9 31.2l-13.5-27c.5-.3.7-1.1.4-1.6c-.3-.6-.9-.8-1.4-.4l-1.8 1.2c-.6.3-.7 1-.5 1.6c.3.6.9.8 1.4.4l13.5 27c.7 1.4 2.6 10 4.9 14.6c3.2 6.3 6.9 13.7 6.9 13.7c.6 1.2 1.9 1.6 2.9.9l1.8-1.2c1-.7 1.3-2.2.8-3.3c0 0-3.7-7.4-6.9-13.7c-2.2-4.4-7.8-10.8-8.5-12.2" fill="#a87d5d"> </path> </g>
                    </svg>
                </div>

                

                <div class="flex justify-center mt-16 px-0 sm:items-center sm:justify-between">
                    

                    <div class="ml-4 text-center text-sm text-white">
                        <h1><b>Welcome to VA'App</b></h1>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
