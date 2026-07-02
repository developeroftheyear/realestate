<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Panel - @yield('title', 'Dashboard')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-100 min-h-screen font-sans antialiased flex">

    <!-- Sidebar -->
    <aside class="w-64 bg-indigo-900 text-white flex-shrink-0 min-h-screen">
        <div class="p-6">
            <h2 class="text-2xl font-bold tracking-wider">Admin Panel</h2>
        </div>
        <nav class="mt-6">
            <a href="{{ route('panel.dashboard') }}" class="block px-6 py-3 {{ request()->routeIs('admin.dashboard') ? 'bg-indigo-800' : 'hover:bg-indigo-800' }}">Dashboard</a>
            <a href="{{ route('panel.properties.index') }}" class="block px-6 py-3 {{ request()->routeIs('admin.properties.*') ? 'bg-indigo-800' : 'hover:bg-indigo-800' }}">Properties (Buy/Sell)</a>
            <a href="{{ route('panel.rent-properties.index') }}" class="block px-6 py-3 {{ request()->routeIs('admin.rent-properties.*') ? 'bg-indigo-800' : 'hover:bg-indigo-800' }}">Rent Properties</a>
            <a href="{{ route('panel.agents.index') }}" class="block px-6 py-3 {{ request()->routeIs('admin.agents.*') ? 'bg-indigo-800' : 'hover:bg-indigo-800' }}">Agents</a>
            <div class="mt-8 px-6 border-t border-indigo-800 pt-4">
                <a href="{{ url('/') }}" class="text-indigo-300 hover:text-white flex items-center gap-2">
                    &larr; Back to Site
                </a>
            </div>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 flex flex-col h-screen overflow-hidden">
        <!-- Top Header -->
        <header class="bg-white shadow-sm py-4 px-6 flex justify-between items-center">
            <h1 class="text-xl font-semibold text-gray-800">@yield('title', 'Dashboard')</h1>
            <div>
                <span class="text-gray-500">Admin</span>
            </div>
        </header>

        <!-- Content Area -->
        <div class="flex-1 overflow-auto p-6">
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            @yield('content')
        </div>
    </main>

    @stack('scripts')
</body>
</html>
