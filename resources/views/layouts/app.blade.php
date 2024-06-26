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

        <script src="https://cdn.jsdelivr.net/npm/p5@1.9.2/lib/p5.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @vite(['resources/sass/app.scss', 'resources/js/app.js'])
        @laravelPWA
    </head>
    <body class="font-sans antialiased">
        @if(session('status')) 
    {{-- If we passed a status key to this page, we will create the following div --}}                        
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{session('status')}} {{-- Here we display the currect status message in the session --}}
        <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
            {{-- Close button --}}
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
        <div class="min-h-screen bg-white">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                @yield('content')
            </main>
        </div>
        @yield('javascript');
    </body>
    
</html>
