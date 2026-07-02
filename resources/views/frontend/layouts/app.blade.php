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
    <nav class="bg-white shadow-sm border-b border-slate-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <!-- Left side: Logo & Links -->
                <div class="flex items-center space-x-10">
                    <!-- Text Logo -->
                    <a href="{{ route('properties.index') }}" class="flex items-center gap-2">
                        <span class="text-2xl font-extrabold bg-clip-text text-transparent bg-gradient-to-r from-indigo-600 to-indigo-500 tracking-tight">RealEstate.</span>
                    </a>
                    
                    <!-- Primary Navigation -->
                    <div class="flex space-x-8">
                        <a href="{{ route('properties.index') }}" 
                           class="{{ request()->routeIs('properties.index') ? 'text-indigo-600 font-semibold' : 'text-slate-600 hover:text-indigo-600' }} transition-colors">
                            Home
                        </a>
                        <a href="{{ route('rent.index') }}" 
                           class="{{ request()->routeIs('rent.index') ? 'text-indigo-600 font-semibold' : 'text-slate-600 hover:text-indigo-600' }} transition-colors">
                            Rent
                        </a>
                        <a href="{{ route('sell.index') }}" 
                           class="{{ request()->routeIs('sell.index') ? 'text-indigo-600 font-semibold' : 'text-slate-600 hover:text-indigo-600' }} transition-colors">
                            Sell
                        </a>
                        <a href="{{ route('agent.finder') }}" 
                           class="{{ request()->routeIs('agent.finder') ? 'text-indigo-600 font-semibold' : 'text-slate-600 hover:text-indigo-600' }} transition-colors">
                            Agent Finder
                        </a>
                    </div>
                </div>

                <!-- Right side: Auth & Contact -->
                <div class="flex items-center space-x-6">
                    @auth
                        @if(Auth::user()->role === 'admin')
                            <a href="{{ route('panel.dashboard') }}" class="text-sm font-medium text-slate-700 hover:text-indigo-600">Admin Panel</a>
                        @endif
                        <span class="text-sm font-medium text-slate-500">Hi, {{ Auth::user()->name }}</span>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="text-sm font-medium text-red-600 hover:text-red-800">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-medium text-slate-700 hover:text-indigo-600 transition-colors">Log in</a>
                    @endauth
                    
                    <a href="{{ route('contact.index') }}" class="inline-flex items-center justify-center px-5 py-2.5 border border-transparent rounded-full shadow-sm text-sm font-bold text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all hover:shadow-md">
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