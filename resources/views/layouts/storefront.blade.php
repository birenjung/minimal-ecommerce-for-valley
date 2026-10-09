<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="theme-color" content="#FFFFFF">
        <meta name="description" content="@yield('description', 'Saiwons Collection brings fashion and electronics together with a simpler shopping experience.')">
        <title>@yield('title', 'Saiwons Collection')</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @stack('head')
    </head>
    <body class="flex min-h-screen flex-col bg-canvas font-sans text-ink antialiased">
        <a href="#main-content" class="skip-link">Skip to content</a>
        <x-storefront.header />
        <main id="main-content" class="flex-1" tabindex="-1">
            @yield('content')
        </main>
        <x-storefront.footer />
    </body>
</html>
