@extends('admin.layout')

@section('title', 'Dashboard')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
    <!-- Stat Card 1 -->
    <div class="bg-white rounded-lg shadow p-6 border-t-4 border-indigo-500">
        <h3 class="text-gray-500 text-sm uppercase tracking-wider">Properties</h3>
        <p class="text-3xl font-bold text-gray-800 mt-2">{{ $stats['properties_count'] }}</p>
    </div>

    <!-- Stat Card 2 -->
    <div class="bg-white rounded-lg shadow p-6 border-t-4 border-blue-500">
        <h3 class="text-gray-500 text-sm uppercase tracking-wider">Rentals</h3>
        <p class="text-3xl font-bold text-gray-800 mt-2">{{ $stats['rent_properties_count'] }}</p>
    </div>

    <!-- Stat Card 3 -->
    <div class="bg-white rounded-lg shadow p-6 border-t-4 border-green-500">
        <h3 class="text-gray-500 text-sm uppercase tracking-wider">Agents</h3>
        <p class="text-3xl font-bold text-gray-800 mt-2">{{ $stats['agents_count'] }}</p>
    </div>

    <!-- Stat Card 4 -->
    <div class="bg-white rounded-lg shadow p-6 border-t-4 border-yellow-500">
        <h3 class="text-gray-500 text-sm uppercase tracking-wider">Inquiries</h3>
        <p class="text-3xl font-bold text-gray-800 mt-2">{{ $stats['contact_messages_count'] + $stats['sell_inquiries_count'] }}</p>
    </div>
</div>

<div class="mt-8 bg-white rounded-lg shadow p-6">
    <h2 class="text-lg font-semibold text-gray-800 mb-4">Welcome to the Admin Panel</h2>
    <p class="text-gray-600">Use the sidebar to manage your real estate listings, rentals, and team members. 
    Changes made here will be reflected immediately on the public website.</p>
</div>
@endsection
