<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Coding Test</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->

        <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
        <style>
            body {
                font-family: 'Nunito';
            }
        </style>
    </head>
    <body class="antialiased">
        <div class="relative flex items-top justify-center min-h-screen dark:bg-gray-900 sm:items-center sm:pt-0">
            @if (Route::has('login'))
                <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 underline">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm text-gray-700 underline">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 bg-teal-300">
                <!-- This is an example component -->
                <div class="flex items-center">
                    <div class="container flex flex-col md:flex-row items-center justify-center px-5 text-gray-700">
                        <div class="max-w-md">
                            <div class="text-5xl font-dark font-bold pb-7">Dxc's ToDo List</div>
                            <p
                                class="text-2xl md:text-3xl font-light leading-normal"
                            >Another attempt for a todo list. </p>
                            <p class="mb-8">Laravel Jetstream, Inertia JS, Vue</p>
                        </div>
                        <div class="max-w-lg">
                            <img src="{{url('/images/undraw_Taking_notes_re_bnaf.svg')}}" alt="Image"/>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
