@extends('frontend.layouts.app')

@section('title', 'TashleyHomes - Buy Properties')

@section('content')
    <!-- Hero Banner Section -->
    <header class="relative bg-slate-900 py-24 sm:py-32 overflow-hidden">
        <!-- Background Hero Image -->
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('images/hero.png') }}" alt="TashleyHomes Luxury Property" class="w-full h-full object-cover opacity-40 filter brightness-90">
            <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-900/60 to-transparent"></div>
        </div>
        
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-indigo-500/10 text-indigo-300 border border-indigo-500/20 mb-6">
                <span class="w-2 h-2 rounded-full bg-indigo-400 animate-pulse"></span>
                Discover Luxury Real Estate
            </span>
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-white tracking-tight leading-none">
                Find Your Perfect Home
            </h1>
            <p class="mt-6 max-w-2xl mx-auto text-lg text-slate-300">
                Explore curated, high-end residences matching your unique lifestyle. Welcome to TashleyHomes, where luxury meets simplicity.
            </p>
        </div>
    </header>

    <!-- Properties List Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 border-b border-slate-100 pb-8 mb-12">
            <div>
                <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight">Available Listings</h2>
                <p class="text-slate-500 mt-2">Browse the newest properties on the market.</p>
            </div>
            <div class="flex items-center gap-3">
                <span class="text-sm font-semibold text-slate-700 bg-slate-100 px-3 py-1.5 rounded-lg border border-slate-200">
                    Total: {{ count($properties) }} {{ Str::plural('property', count($properties)) }}
                </span>
            </div>
        </div>

        @if($properties->isEmpty())
            <!-- Empty State -->
            <div class="text-center py-20 bg-white border border-slate-100 rounded-2xl shadow-sm max-w-xl mx-auto px-6">
                <div class="w-16 h-16 bg-indigo-50 text-indigo-600 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 21v-4.875c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125V21m0 0h4.5V3.545M2.25 21h1.5m18 0h-18M2.25 9l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 9M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h3.75c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-slate-950">No properties available</h3>
                <p class="text-slate-500 mt-2">It looks like the database has not been seeded yet. Run the seeder to populate the list!</p>
                <div class="mt-8">
                    <div class="text-xs bg-slate-900 text-indigo-300 font-mono p-3 rounded-lg border border-slate-800 text-left inline-block max-w-full overflow-x-auto shadow-inner">
                        php artisan db:seed
                    </div>
                </div>
            </div>
        @else
            <!-- Grid Layout -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($properties as $property)
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition duration-300">
                        <!-- Property Image -->
                        <div class="relative h-56 overflow-hidden">
                            <img src="{{ $property->resolved_image_url }}" alt="{{ $property->title ?? 'Property' }}" class="w-full h-full object-cover hover:scale-105 transition duration-500">
                            
                            <!-- Buy-specific badge -->
                            <div class="absolute top-3 right-3 bg-blue-500 text-white px-3 py-1 rounded-full text-sm font-semibold">
                                For Sale
                            </div>
                            
                            <!-- Featured badge -->
                            @if($property->is_featured ?? false)
                            <div class="absolute top-3 left-3 bg-yellow-500 text-white px-3 py-1 rounded-full text-sm font-semibold">
                                <i class="fas fa-star mr-1"></i>Featured
                            </div>
                            @endif
                        </div>
                        
                        <!-- Property Details -->
                        <div class="p-5">
                            <div class="flex justify-between items-start mb-2">
                                <h3 class="text-xl font-bold text-gray-800">{{ $property->title ?? 'Luxury Property' }}</h3>
                                <div class="text-right">
                                    <span class="text-2xl font-bold text-blue-600">KSh {{ number_format($property->price ?? 0) }}</span>
                                </div>
                            </div>
                            
                            <!-- Location -->
                            <p class="text-gray-500 mb-3">
                                <i class="fas fa-map-marker-alt text-blue-500 mr-1"></i> 
                                {{ $property->address ?? 'Location not specified' }}
                            </p>
                            
                            <!-- Property features -->
                            <div class="flex justify-between text-gray-600 border-t border-b py-3 my-3">
                                <span><i class="fas fa-bed"></i> {{ $property->bedrooms ?? 0 }} beds</span>
                                <span><i class="fas fa-bath"></i> {{ $property->bathrooms ?? 0 }} baths</span>
                                <span><i class="fas fa-vector-square"></i> {{ number_format($property->area_sqft ?? 0) }} sqft</span>
                            </div>
                            
                            <!-- Description (Buy specific) -->
                            <p class="text-sm text-gray-500 mt-2 line-clamp-2 mb-4 leading-relaxed">
                                {{ $property->description ?? 'No description available for this property.' }}
                            </p>
                            
                            <!-- Buttons - Buy specific CTA -->
                            <div class="flex gap-3">
                                <a href="{{ route('buy.show', $property->id) }}" class="flex-1 text-center bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                                    <i class="fas fa-eye mr-1"></i> View Details
                                </a>
                                <button class="px-4 py-2 border border-blue-600 text-blue-600 rounded-lg hover:bg-blue-50 transition">
                                    <i class="fas fa-heart"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection