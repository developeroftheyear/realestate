@extends('frontend.layouts.app')

@section('title', ($property->title ?? 'Property') . ' - Buy | TashleyHomes')

@section('content')
    @php
        $agent = $property->agent;
        $agentName = $agent?->name ?? 'TashleyHomes Team';
        $agentEmail = $agent?->email ?? 'support@tashleyhomes.com';
        $agentPhone = $agent?->phone ?? '+254 792 051 974';
        $emailSubject = 'Inquiry about: ' . ($property->title ?? 'Property');
        $emailBody = 'Hi, I am interested in buying the property "' . ($property->title ?? 'Property') . '" (ID: #' . ($property->id ?? 'N/A') . '). Please contact me with more details.';
    @endphp

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 sm:py-14">
        <a href="{{ route('properties.index') }}" class="inline-flex items-center gap-2 text-sm font-semibold text-indigo-600 hover:text-indigo-800 transition-colors mb-8">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
            </svg>
            Back to Properties
        </a>
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 lg:gap-10">
            <!-- Main Image & Details -->
            <div class="lg:col-span-2 space-y-8">
                <div class="relative rounded-2xl overflow-hidden bg-slate-100 shadow-lg border border-slate-100">
                    <img src="{{ $property->resolved_image_url }}" alt="{{ $property->title ?? 'Property' }}" class="w-full h-72 sm:h-96 object-cover">
                    <div class="absolute top-4 left-4 flex flex-wrap gap-2">
                        <span class="bg-indigo-600 text-white px-3 py-1 rounded-full text-xs font-bold shadow-sm">For Sale</span>
                        @if($property->is_featured ?? false)
                            <span class="bg-amber-500 text-white px-3 py-1 rounded-full text-xs font-bold shadow-sm">Featured</span>
                        @endif
                    </div>
                </div>
                
                <div>
                    <h1 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight">{{ $property->title ?? 'Property Title' }}</h1>
                    <p class="text-slate-500 mt-2 flex items-center gap-2">
                        <svg class="w-5 h-5 text-indigo-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                        </svg>
                        {{ $property->address ?? 'Location not specified' }}
                    </p>
                    
                    <div class="grid grid-cols-3 gap-4 mt-8 py-6 border-y border-slate-100">
                        <div class="text-center sm:text-left">
                            <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Bedrooms</p>
                            <p class="mt-1 text-xl font-bold text-slate-900">{{ $property->bedrooms ?? 0 }}</p>
                        </div>
                        <div class="text-center sm:text-left">
                            <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Bathrooms</p>
                            <p class="mt-1 text-xl font-bold text-slate-900">{{ $property->bathrooms ?? 0 }}</p>
                        </div>
                        <div class="text-center sm:text-left">
                            <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Area</p>
                            <p class="mt-1 text-xl font-bold text-slate-900">{{ number_format($property->area_sqft ?? 0) }} <span class="text-sm font-medium text-slate-500">sqft</span></p>
                        </div>
                    </div>
                    
                    <div class="mt-8">
                        <h3 class="text-xl font-bold text-slate-900 mb-3">Description</h3>
                        <p class="text-slate-600 leading-relaxed">{{ $property->description ?? 'No description available for this property.' }}</p>
                    </div>

                    @if(($property->is_pet_friendly ?? false) || ($property->is_furnished ?? false) || ($property->has_parking ?? false) || ($property->has_pool ?? false) || ($property->has_gym ?? false))
                    <div class="mt-8 pt-8 border-t border-slate-100">
                        <h3 class="text-xl font-bold text-slate-900 mb-4">Amenities</h3>
                        <div class="flex flex-wrap gap-2">
                            @if($property->is_pet_friendly ?? false)
                            <span class="inline-flex items-center gap-1.5 bg-emerald-50 text-emerald-700 border border-emerald-100 px-3 py-1.5 rounded-full text-sm font-medium">Pet Friendly</span>
                            @endif
                            @if($property->is_furnished ?? false)
                            <span class="inline-flex items-center gap-1.5 bg-indigo-50 text-indigo-700 border border-indigo-100 px-3 py-1.5 rounded-full text-sm font-medium">Furnished</span>
                            @endif
                            @if($property->has_parking ?? false)
                            <span class="inline-flex items-center gap-1.5 bg-violet-50 text-violet-700 border border-violet-100 px-3 py-1.5 rounded-full text-sm font-medium">Parking</span>
                            @endif
                            @if($property->has_pool ?? false)
                            <span class="inline-flex items-center gap-1.5 bg-amber-50 text-amber-700 border border-amber-100 px-3 py-1.5 rounded-full text-sm font-medium">Pool</span>
                            @endif
                            @if($property->has_gym ?? false)
                            <span class="inline-flex items-center gap-1.5 bg-rose-50 text-rose-700 border border-rose-100 px-3 py-1.5 rounded-full text-sm font-medium">Gym</span>
                            @endif
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            
            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-2xl shadow-xl border border-slate-100 p-6 sm:p-8 sticky top-6">
                    <div class="border-b border-slate-100 pb-5 mb-5">
                        <p class="text-sm font-semibold text-slate-500 uppercase tracking-wide">Asking Price</p>
                        <p class="text-3xl sm:text-4xl font-extrabold text-indigo-600 mt-1">
                            KSh {{ number_format($property->price ?? 0) }}
                        </p>
                    </div>
                    
                    <div class="space-y-3 mb-6 text-sm">
                        <div class="flex justify-between items-center">
                            <span class="text-slate-500">Status</span>
                            <span class="font-semibold text-emerald-600">For Sale</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-slate-500">Property ID</span>
                            <span class="font-semibold text-slate-900">#{{ $property->id ?? 'N/A' }}</span>
                        </div>
                    </div>
                    
                    <div class="space-y-3">
                        <a href="mailto:{{ $agentEmail }}?subject={{ rawurlencode($emailSubject) }}&body={{ rawurlencode($emailBody) }}" class="w-full flex items-center justify-center gap-2 bg-indigo-600 text-white py-3 rounded-xl hover:bg-indigo-700 transition shadow-lg shadow-indigo-200 font-semibold">
                            Email Agent
                        </a>
                        
                        <a href="{{ route('contact.index', ['subject' => 'Schedule a Viewing', 'message' => 'I would like to schedule a viewing for the property: ' . ($property->title ?? 'Property') . ' (ID: #' . ($property->id ?? 'N/A') . ').', 'property_id' => $property->id]) }}" class="w-full flex items-center justify-center gap-2 border border-indigo-200 text-indigo-600 py-3 rounded-xl hover:bg-indigo-50 transition font-semibold">
                            Schedule Viewing
                        </a>
                    </div>

                    <div class="mt-6 p-4 bg-slate-50 rounded-xl border border-slate-100">
                        <p class="text-xs font-semibold uppercase tracking-wide text-slate-400 mb-3">Listed by</p>
                        <div class="space-y-2">
                            <span class="font-bold text-slate-900 block">{{ $agentName }}</span>
                            <a href="mailto:{{ $agentEmail }}" class="text-sm text-indigo-600 hover:text-indigo-800 block truncate">{{ $agentEmail }}</a>
                            <a href="tel:{{ preg_replace('/\s+/', '', $agentPhone) }}" class="text-sm text-slate-500 hover:text-slate-700 block">{{ $agentPhone }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
