<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ $title ?? 'E-Commerce' }}</title>
        @vite(['resources/css/app.css', 'resources/js/app.js']) 
        @livewireStyles
    </head>
    
    <body class=" dark:bg-slate-600">
        @livewire('partials.navbar')
        <main >
        {{ $slot }}
    </main>
        @livewire('partials.footer')
        @livewireScripts
        
    </body> 
</html>
