@extends('layouts')

@section('title', 'TashleyHomes - Rent Properties')

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
                Luxury Homes for Rent with Flexible Lease Terms
            </span>
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-white tracking-tight leading-none">
                Find Your Perfect Rental 
            </h1>
            <p class="mt-6 max-w-2xl mx-auto text-lg text-slate-300">
                Explore curated, high-end residences matching your unique lifestyle. Welcome to TashleyHomes, where luxury meets simplicity.
            </p>
            <p class="text-md mt-4 opacity-75">
                <i class="fas fa-tag"></i> No hidden fees | <i class="fas fa-tools"></i> 24/7 maintenance | <i class="fas fa-check-circle"></i> Instant approval available
            </p>
        </div>
    </header>

    <!-- Filter/Search Bar (Modern way for rent page) -->
    <div class="container mx-auto px-6 -mt-8 relative z-20">
        <div class="bg-white rounded-lg shadow-lg p-6">
            <form action="{{ route('rent.search') }}" method="GET" class="grid grid-cols-1 md:grid-cols-5 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Min Rent</label>
                    <input type="number" name="min_rent" placeholder="KSh 100,000" class="w-full border rounded-lg px-3 py-2">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Max Rent</label>
                    <input type="number" name="max_rent" placeholder="KSh 1,000,000" class="w-full border rounded-lg px-3 py-2">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Bedrooms</label>
                    <select name="bedrooms" class="w-full border rounded-lg px-3 py-2">
                        <option value="">Any</option>
                        <option>1</option><option>2</option><option>3</option><option>4+</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Pet Friendly</label>
                    <select name="pet_friendly" class="w-full border rounded-lg px-3 py-2">
                        <option value="">Any</option>
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                    </select>
                </div>
                <div class="flex items-end">
                    <button type="submit" class="w-full bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                        <i class="fas fa-search mr-2"></i>Search
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Available Listings Section - SAME layout as your design -->
    <div class="container mx-auto px-6 py-12">
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-3xl font-bold text-gray-800">Available Rentals</h2>
            <p class="text-gray-500">Total: {{ $totalProperties ?? 0 }} properties</p>
        </div>

        <!-- Property Grid - 2 or 3 columns -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($rentProperties ?? [] as $property)
            <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition duration-300">
                <!-- Property Image -->
                <div class="relative h-56 overflow-hidden">
                    <img src="{{ $property->image_url ?? 'https://via.placeholder.com/400x300' }}" alt="{{ $property->title ?? 'Property' }}" class="w-full h-full object-cover hover:scale-105 transition duration-500">
                    
                    <!-- Rent-specific badge -->
                    <div class="absolute top-3 right-3 bg-green-500 text-white px-3 py-1 rounded-full text-sm font-semibold">
                        <i class="fas fa-calendar-alt mr-1"></i>Available {{ $property->available_from ? $property->available_from->format('M d, Y') : 'Now' }}
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
                    <!-- Rent price - Different from buy page -->
                    <div class="flex justify-between items-start mb-2">
                        <h3 class="text-xl font-bold text-gray-800">{{ $property->title ?? 'Property Title' }}</h3>
                        <div class="text-right">
                            <span class="text-2xl font-bold text-blue-600">KSh {{ number_format($property->monthly_rent ?? 0) }}</span>
                            <span class="text-gray-500 text-sm">/month</span>
                        </div>
                    </div>
                    
                    <!-- Location -->
                    <p class="text-gray-500 mb-3">
                        <i class="fas fa-map-marker-alt text-blue-500 mr-1"></i> 
                        {{ $property->location ?? 'Location not specified' }}
                    </p>
                    
                    <!-- Rent-specific info: Deposit and Lease -->
                    <div class="flex justify-between items-center bg-gray-50 p-2 rounded-lg mb-3 text-sm">
                        <span class="text-gray-600">
                            <i class="fas fa-shield-alt text-green-500 mr-1"></i> Deposit: KSh {{ number_format($property->security_deposit ?? 0) }}
                        </span>
                        <span class="text-gray-600">
                            <i class="fas fa-file-signature text-blue-500 mr-1"></i> Lease: {{ $property->lease_term ?? '12 months' }}
                        </span>
                    </div>
                    
                    <!-- Property features -->
                    <div class="flex justify-between text-gray-600 border-t border-b py-3 my-3">
                        <span><i class="fas fa-bed"></i> {{ $property->bedrooms ?? 0 }} beds</span>
                        <span><i class="fas fa-bath"></i> {{ $property->bathrooms ?? 0 }} baths</span>
                        <span><i class="fas fa-vector-square"></i> {{ number_format($property->area_sqft ?? 0) }} sqft</span>
                    </div>
                    
                    <!-- Rent-specific amenities -->
                    <div class="flex gap-3 mb-4 text-sm">
                        @if($property->is_pet_friendly ?? false)
                        <span class="bg-green-100 text-green-700 px-2 py-1 rounded"><i class="fas fa-paw"></i> Pet Friendly</span>
                        @endif
                        @if($property->is_furnished ?? false)
                        <span class="bg-blue-100 text-blue-700 px-2 py-1 rounded"><i class="fas fa-couch"></i> Furnished</span>
                        @endif
                    </div>
                    
                    <!-- Buttons - Rent specific CTA -->
                    <div class="flex gap-3">
                        <a href="{{ route('rent.show', $property->id ?? '#') }}" class="flex-1 text-center bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                            <i class="fas fa-calendar-check mr-1"></i> Schedule Tour
                        </a>
                        <button class="px-4 py-2 border border-blue-600 text-blue-600 rounded-lg hover:bg-blue-50 transition">
                            <i class="fas fa-heart"></i>
                        </button>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-3 text-center py-12">
                <i class="fas fa-home text-6xl text-gray-300 mb-4"></i>
                <p class="text-gray-500 text-lg">No rental properties available at the moment.</p>
                <p class="text-gray-400">Check back soon for new listings!</p>
            </div>
            @endforelse
        </div>
    </div>

@endsection