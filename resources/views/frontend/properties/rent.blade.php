@extends('frontend.layouts.app')

@section('title', 'TashleyHomes - Rent Properties')

@section('content')
    <!-- Hero Banner Section -->
    <header class="relative bg-slate-900 py-24 sm:py-32 overflow-hidden">
        <div class="absolute inset-0 z-0 pointer-events-none" aria-hidden="true">
            <img src="https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?auto=format&fit=crop&w=1920&q=80" alt="" class="w-full h-full object-cover opacity-40 filter brightness-90">
            <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-900/60 to-transparent"></div>
        </div>
        
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-indigo-500/10 text-indigo-300 border border-indigo-500/20 mb-6">
                <span class="w-2 h-2 rounded-full bg-indigo-400 animate-pulse"></span>
                Luxury Homes for Rent
            </span>
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-white tracking-tight leading-none">
                Find Your Perfect Rental
            </h1>
            <p class="mt-6 max-w-2xl mx-auto text-lg text-slate-300">
                Explore curated, high-end residences matching your unique lifestyle. Welcome to TashleyHomes, where luxury meets simplicity.
            </p>
        </div>
    </header>

    <!-- Search / Filter Bar -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-10 relative z-20">
        <div class="bg-white rounded-2xl shadow-xl border border-slate-100 p-6 sm:p-8">
            @if(!empty($isSearching))
                <div class="mb-5 flex flex-wrap items-center justify-between gap-3 rounded-xl bg-indigo-50 border border-indigo-100 px-4 py-3 text-sm text-indigo-800">
                    <span>
                        Showing <strong>{{ $totalProperties }}</strong> {{ Str::plural('property', $totalProperties) }}
                        matching at least <strong>{{ $requiredMatches }}</strong> of your {{ count($activeFilters) }} selected {{ Str::plural('filter', count($activeFilters)) }}.
                    </span>
                    <a href="{{ route('rent.index') }}" class="font-semibold text-indigo-600 hover:text-indigo-800">Clear search</a>
                </div>
            @endif

            <form action="{{ route('rent.search') }}" method="GET" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-6 gap-4">
                <div class="lg:col-span-2">
                    <label for="q" class="block text-sm font-semibold text-slate-700 mb-1.5">Search</label>
                    <div class="relative">
                        <svg class="pointer-events-none absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                        </svg>
                        <input type="text" name="q" id="q" value="{{ request('q') }}" placeholder="Location, title, or keyword..." class="w-full rounded-xl border-slate-200 pl-10 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 transition-colors shadow-sm">
                    </div>
                </div>
                <div>
                    <label for="price_range" class="block text-sm font-semibold text-slate-700 mb-1.5">Monthly Rent</label>
                    <select name="price_range" id="price_range" class="w-full rounded-xl border-slate-200 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 transition-colors shadow-sm">
                        <option value="">Any Price</option>
                        <option value="0-50000" @selected(request('price_range') === '0-50000')>Under KSh 50K</option>
                        <option value="50000-100000" @selected(request('price_range') === '50000-100000')>KSh 50K – 100K</option>
                        <option value="100000-250000" @selected(request('price_range') === '100000-250000')>KSh 100K – 250K</option>
                        <option value="250000-500000" @selected(request('price_range') === '250000-500000')>KSh 250K – 500K</option>
                        <option value="500000+" @selected(request('price_range') === '500000+')>KSh 500K+</option>
                    </select>
                </div>
                <div>
                    <label for="bedrooms" class="block text-sm font-semibold text-slate-700 mb-1.5">Bedrooms</label>
                    <select name="bedrooms" id="bedrooms" class="w-full rounded-xl border-slate-200 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 transition-colors shadow-sm">
                        <option value="">Any</option>
                        <option value="1" @selected(request('bedrooms') == '1')>1</option>
                        <option value="2" @selected(request('bedrooms') == '2')>2</option>
                        <option value="3" @selected(request('bedrooms') == '3')>3</option>
                        <option value="4+" @selected(request('bedrooms') == '4+')>4+</option>
                    </select>
                </div>
                <div>
                    <label for="pet_friendly" class="block text-sm font-semibold text-slate-700 mb-1.5">Pet Friendly</label>
                    <select name="pet_friendly" id="pet_friendly" class="w-full rounded-xl border-slate-200 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 transition-colors shadow-sm">
                        <option value="">Any</option>
                        <option value="1" @selected(request('pet_friendly') === '1')>Yes</option>
                        <option value="0" @selected(request('pet_friendly') === '0')>No</option>
                    </select>
                </div>
                <div class="flex items-end">
                    <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2.5 px-4 rounded-xl transition-all shadow-lg shadow-indigo-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 inline-flex items-center justify-center gap-2">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                        </svg>
                        Search
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Available Listings -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 border-b border-slate-100 pb-8 mb-12">
            <div>
                <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight">
                    {{ !empty($isSearching) ? 'Search Results' : 'Available Rentals' }}
                </h2>
                <p class="text-slate-500 mt-2">Flexible leases, premium locations.</p>
            </div>
            <span class="text-sm font-semibold text-slate-700 bg-slate-100 px-3 py-1.5 rounded-lg border border-slate-200">
                Total: {{ $totalProperties ?? 0 }} {{ Str::plural('property', $totalProperties ?? 0) }}
            </span>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($rentProperties ?? [] as $property)
            <div class="group bg-white rounded-2xl border border-slate-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 overflow-hidden flex flex-col">
                <div class="relative h-56 overflow-hidden bg-slate-100">
                    <img src="{{ $property->resolved_image_url }}" alt="{{ $property->title ?? 'Property' }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    <div class="absolute top-3 right-3 bg-emerald-600 text-white px-3 py-1 rounded-full text-xs font-bold shadow-sm">
                        Available {{ $property->available_from ? $property->available_from->format('M d') : 'Now' }}
                    </div>
                    @if($property->is_featured ?? false)
                    <div class="absolute top-3 left-3 bg-amber-500 text-white px-3 py-1 rounded-full text-xs font-bold shadow-sm">
                        Featured
                    </div>
                    @endif
                </div>
                
                <div class="p-6 flex-1 flex flex-col">
                    <div class="flex justify-between items-start gap-3 mb-2">
                        <h3 class="text-lg font-bold text-slate-900 line-clamp-1">{{ $property->title ?? 'Property Title' }}</h3>
                        <div class="text-right shrink-0">
                            <span class="text-lg font-extrabold text-indigo-600">KSh {{ number_format($property->monthly_rent ?? 0) }}</span>
                            <span class="text-slate-400 text-xs block">/month</span>
                        </div>
                    </div>
                    
                    <p class="text-sm text-slate-500 mb-4 flex items-center gap-1.5">
                        <svg class="w-4 h-4 text-indigo-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                        </svg>
                        <span class="line-clamp-1">{{ $property->location ?? 'Location not specified' }}</span>
                    </p>
                    
                    <div class="flex justify-between items-center bg-slate-50 border border-slate-100 p-2.5 rounded-xl mb-4 text-xs text-slate-600">
                        <span>Deposit: KSh {{ number_format($property->security_deposit ?? 0) }}</span>
                        <span>Lease: {{ $property->lease_term ?? '12 months' }}</span>
                    </div>
                    
                    <div class="flex justify-between text-sm text-slate-600 border-y border-slate-100 py-3 mb-4">
                        <span>{{ $property->bedrooms ?? 0 }} beds</span>
                        <span>{{ $property->bathrooms ?? 0 }} baths</span>
                        <span>{{ number_format($property->area_sqft ?? 0) }} sqft</span>
                    </div>
                    
                    <div class="flex flex-wrap gap-2 mb-5">
                        @if($property->is_pet_friendly ?? false)
                        <span class="bg-emerald-50 text-emerald-700 border border-emerald-100 px-2 py-1 rounded-full text-xs font-medium">Pet Friendly</span>
                        @endif
                        @if($property->is_furnished ?? false)
                        <span class="bg-indigo-50 text-indigo-700 border border-indigo-100 px-2 py-1 rounded-full text-xs font-medium">Furnished</span>
                        @endif
                    </div>
                    
                    <div class="flex gap-3 mt-auto">
                        <a href="{{ route('rent.show', $property->id ?? '#') }}" class="flex-1 text-center bg-indigo-600 text-white px-4 py-2.5 rounded-xl hover:bg-indigo-700 transition font-semibold text-sm">
                            Schedule Tour
                        </a>
                        <a href="{{ route('contact.index', ['subject' => 'Rental Inquiry', 'message' => 'I am interested in renting: ' . ($property->title ?? 'Property') . ' (ID: #' . ($property->id ?? 'N/A') . ').', 'rent_property_id' => $property->id]) }}" class="px-4 py-2.5 border border-indigo-200 text-indigo-600 rounded-xl hover:bg-indigo-50 transition" title="Contact about this rental">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-full text-center py-20 bg-white border border-slate-100 rounded-2xl shadow-sm max-w-xl mx-auto px-6">
                <div class="w-16 h-16 bg-indigo-50 text-indigo-600 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 21v-4.875c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125V21m0 0h4.5V3.545M2.25 21h1.5m18 0h-18M2.25 9l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 9M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h3.75c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                    </svg>
                </div>
                @if(!empty($isSearching))
                    <h3 class="text-xl font-bold text-slate-950">No matching rentals</h3>
                    <p class="text-slate-500 mt-2">No rentals match at least {{ $requiredMatches }} of your selected filters. <a href="{{ route('rent.index') }}" class="text-indigo-600 hover:text-indigo-800 font-medium">View all listings</a>.</p>
                @else
                    <h3 class="text-xl font-bold text-slate-950">No rentals available</h3>
                    <p class="text-slate-500 mt-2">Check back soon for new listings!</p>
                @endif
            </div>
            @endforelse
        </div>
    </div>
@endsection
