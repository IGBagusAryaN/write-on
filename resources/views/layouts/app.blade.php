<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.8/dist/trix.css">
    <script type="text/javascript" src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script>
</head>

</head>

<body class="font-sans antialiased">
    <div class="min-h-screen">
        @include('layouts.navigation')
              {{-- @session('success') --}}
                {{-- <div class="max-w-4xl mx-auto mb-4 rounded-lg shadow-md overflow-hidden">
                    <!-- Bar hijau tebal -->
                    <div class="h-1 bg-green-600"></div>

                    <!-- Konten alert -->
                    <div class="p-4 text-sm text-green-800 bg-green-100 flex items-start justify-between">
                        <div class="flex">
                            <!-- Icon centang -->
                            <svg class="w-5 h-5 mr-3 mt-1 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-7.364 7.364-3.536-3.536a1 1 0 111.414-1.414l2.122 2.121 6.657-6.657a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>

                            <div>
                                <p class="font-semibold">Congratulations</p>
                                <p>{{ session('success') }}</p>
                            </div>
                        </div>

                        <!-- Tombol close -->
                        <button type="button" onclick="this.parentElement.parentElement.remove();"
                            class="text-green-700 hover:text-green-900">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                </div> --}}
                {{-- @endsession --}}

        <!-- Page Heading -->
        @isset($header)
            <header class="bg-white ">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 mt-5 lg:px-12">
                    <div class="block md:flex justify-between items-center">
                        <div> {{ $header }}</div>
                        <div>
                            @isset($headerRight)
                                {{ $headerRight }}
                            @endisset
                        </div>
                    </div>
                </div>

          
            </header>
        @endisset

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>
</body>

</html>
