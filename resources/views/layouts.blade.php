<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Your Property Site')</title>
    
    <!-- Your CSS links here -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <!-- Navigation -->
    <nav class="bg-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between items-center h-16">
                <div class="flex space-x-8">
                    <a href="{{ route('properties.index') }}" 
                       class="{{ request()->routeIs('properties.index') ? 'text-indigo-600 font-semibold' : 'hover:text-slate-900' }} transition-colors">
                        Buy
                    </a>
                    <a href="{{ route('rent.index') }}" 
                       class="{{ request()->routeIs('rent.index') ? 'text-indigo-600 font-semibold' : 'hover:text-slate-900' }} transition-colors">
                        Rent
                    </a>
                    <a href="{{ route('sell.index') }}" 
                       class="{{ request()->routeIs('sell.index') ? 'text-indigo-600 font-semibold' : 'hover:text-slate-900' }} transition-colors">
                        Sell
                    </a>
                    <a href="{{ route('agent.finder') }}" 
                       class="{{ request()->routeIs('agent.finder') ? 'text-indigo-600 font-semibold' : 'hover:text-slate-900' }} transition-colors">
                        Agent Finder
                    </a>
                </div>
                <div>
                    <a href="{{ url('/contact') }}" class="inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-bold text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                        Contact Us
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Page Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer>
        <!-- Your footer here -->
    </footer>

    @stack('scripts')
</body>
</html>