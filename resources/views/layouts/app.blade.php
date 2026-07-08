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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased relative bg-white">
        <style>[x-cloak]{display:none!important}</style>
        <script>document.body.classList.remove('overflow-y-hidden','overflow-hidden');</script>
        <div class="min-h-screen bg-gray-100 relative z-10">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>

            <!-- Footer -->
            <footer class="bg-slate-900 text-slate-300 mt-16">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8 md:gap-12">
                        <div class="sm:col-span-2 md:col-span-1">
                            <span class="text-2xl font-extrabold text-white">TashleyHomes</span>
                            <p class="mt-3 text-sm text-slate-400 leading-relaxed">Your trusted partner for buying, selling, and renting premium real estate in Kenya.</p>
                        </div>
                        <div>
                            <h4 class="text-white font-semibold mb-4">Quick Links</h4>
                            <ul class="space-y-2 text-sm">
                                <li><a href="{{ route('properties.index') }}" class="hover:text-white transition-colors">Buy Properties</a></li>
                                <li><a href="{{ route('rent.index') }}" class="hover:text-white transition-colors">Rent</a></li>
                                <li><a href="{{ route('sell.index') }}" class="hover:text-white transition-colors">Sell Your Property</a></li>
                                <li><a href="{{ route('agent.finder') }}" class="hover:text-white transition-colors">Find an Agent</a></li>
                                <li><a href="{{ route('contact.index') }}" class="hover:text-white transition-colors">Contact Us</a></li>
                            </ul>
                        </div>
                        <div>
                            <h4 class="text-white font-semibold mb-4">Contact</h4>
                            <ul class="space-y-2 text-sm">
                                <li><a href="mailto:support@tashleyhomes.com" class="hover:text-white transition-colors"><i class="fas fa-envelope mr-2"></i>support@tashleyhomes.com</a></li>
                                <li><a href="tel:+254792051974" class="hover:text-white transition-colors"><i class="fas fa-phone mr-2"></i>+254 792 051 974</a></li>
                                <li><i class="fas fa-map-marker-alt mr-2"></i>Westlands, Nairobi, Kenya</li>
                            </ul>
                        </div>
                    </div>
                    <div class="border-t border-slate-800 mt-8 pt-8 text-center text-sm text-slate-500">
                        &copy; {{ date('Y') }} TashleyHomes. All rights reserved.
                    </div>
                </div>
            </footer>
        </div>
    </body>
</html>
