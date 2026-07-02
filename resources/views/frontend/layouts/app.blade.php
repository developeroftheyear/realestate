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
                        <a href="{{ route('inbox.index') }}" class="relative inline-flex items-center justify-center p-2 text-slate-600 hover:text-indigo-600 transition-colors" title="My Inbox">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                            </svg>
                            @if(Auth::user()->hasUnreadInbox())
                                <span class="absolute top-1 right-1 h-2.5 w-2.5 rounded-full bg-red-500 ring-2 ring-white" aria-hidden="true"></span>
                                <span class="sr-only">New reply</span>
                            @endif
                        </a>
                        @if(Auth::user()->isAdmin())
                            <a href="{{ route('panel.dashboard') }}" class="inline-flex items-center justify-center px-4 py-2 rounded-full text-sm font-semibold text-white bg-indigo-600 hover:bg-indigo-700 transition-colors">Admin Panel</a>
                        @endif
                        <span class="text-sm font-medium text-slate-500">Hi, {{ Auth::user()->name }}</span>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="text-sm font-medium text-red-600 hover:text-red-800">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-medium text-slate-700 hover:text-indigo-600 transition-colors">Sign in</a>
                        <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-4 py-2 border border-indigo-600 rounded-full text-sm font-semibold text-indigo-600 hover:bg-indigo-50 transition-colors">Sign up</a>
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
        @if (session('error'))
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
                <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl text-sm">
                    {{ session('error') }}
                </div>
            </div>
        @endif

        @if (session('success'))
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
                <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-xl text-sm">
                    {{ session('success') }}
                </div>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Footer -->
    <footer>
        <!-- Your footer here -->
    </footer>

    @stack('scripts')
</body>
</html>