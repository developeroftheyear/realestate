@extends('frontend.layouts.app')

@section('title', $property->title . ' - Buy | TashleyHomes')

@section('content')
    @php
        $agent = $property->agent;
        $agentName = $agent?->name ?? 'TashleyHomes Team';
        $agentEmail = $agent?->email ?? 'support@tashleyhomes.com';
        $agentPhone = $agent?->phone ?? '+254 792 051 974';
        $emailSubject = 'Inquiry about: ' . ($property->title ?? 'Property');
        $emailBody = 'Hi, I am interested in buying the property "' . ($property->title ?? 'Property') . '" (ID: #' . ($property->id ?? 'N/A') . '). Please contact me with more details.';
    @endphp
    <!-- Property Detail Section -->
    <div class="container mx-auto px-6 py-12">
        <a href="{{ route('properties.index') }}" class="text-blue-600 mb-6 inline-block hover:text-blue-800 transition">
            <i class="fas fa-arrow-left mr-2"></i>Back to Properties
        </a>
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Image & Details -->
            <div class="lg:col-span-2">
                <img src="{{ $property->resolved_image_url }}" alt="{{ $property->title ?? 'Property' }}" class="w-full h-96 object-cover rounded-xl shadow-lg">
                
                <div class="mt-6">
                    <h1 class="text-3xl font-bold text-gray-800">{{ $property->title ?? 'Property Title' }}</h1>
                    <p class="text-gray-500 mt-1">
                        <i class="fas fa-map-marker-alt text-blue-500 mr-1"></i> 
                        {{ $property->address ?? 'Location not specified' }}
                    </p>
                    
                    <div class="grid grid-cols-3 gap-4 mt-6 py-4 border-y">
                        <div>
                            <span class="text-gray-500">Bedrooms:</span> 
                            <span class="font-semibold">{{ $property->bedrooms ?? 0 }}</span>
                        </div>
                        <div>
                            <span class="text-gray-500">Bathrooms:</span> 
                            <span class="font-semibold">{{ $property->bathrooms ?? 0 }}</span>
                        </div>
                        <div>
                            <span class="text-gray-500">Area:</span> 
                            <span class="font-semibold">{{ number_format($property->area_sqft ?? 0) }} sqft</span>
                        </div>
                    </div>
                    
                    <div class="mt-6">
                        <h3 class="text-xl font-semibold mb-3">Description</h3>
                        <p class="text-gray-600 leading-relaxed">{{ $property->description ?? 'No description available for this property.' }}</p>
                    </div>

                    <!-- Amenities -->
                    @if(isset($property->is_pet_friendly) || isset($property->is_furnished))
                    <div class="mt-6 pt-4 border-t">
                        <h3 class="text-xl font-semibold mb-3">Amenities</h3>
                        <div class="flex flex-wrap gap-3">
                            @if($property->is_pet_friendly ?? false)
                            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">
                                <i class="fas fa-paw mr-1"></i> Pet Friendly
                            </span>
                            @endif
                            @if($property->is_furnished ?? false)
                            <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm">
                                <i class="fas fa-couch mr-1"></i> Furnished
                            </span>
                            @endif
                            @if($property->has_parking ?? false)
                            <span class="bg-purple-100 text-purple-700 px-3 py-1 rounded-full text-sm">
                                <i class="fas fa-parking mr-1"></i> Parking Available
                            </span>
                            @endif
                            @if($property->has_pool ?? false)
                            <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm">
                                <i class="fas fa-swimmer mr-1"></i> Pool
                            </span>
                            @endif
                            @if($property->has_gym ?? false)
                            <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm">
                                <i class="fas fa-dumbbell mr-1"></i> Gym
                            </span>
                            @endif
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            
            <!-- Buy Specific Sidebar -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-xl shadow-lg p-6 sticky top-6">
                    <div class="border-b pb-4 mb-4">
                        <p class="text-gray-500">Asking Price</p>
                        <p class="text-4xl font-bold text-blue-600">
                            KSh {{ number_format($property->price ?? 0) }} 
                        </p>
                    </div>
                    
                    <div class="space-y-3 mb-6">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Status:</span>
                            <span class="font-semibold text-green-600">For Sale</span>
                        </div>
                    </div>

                    <!-- Buy Features -->
                    <div class="border-t pt-4 mb-6">
                        <div class="flex justify-between text-sm mt-2">
                            <span class="text-gray-500">Property ID:</span>
                            <span class="font-semibold">#{{ $property->id ?? 'N/A' }}</span>
                        </div>
                    </div>
                    
                    <!-- Action Form -->
                    <a href="mailto:{{ $agentEmail }}?subject={{ rawurlencode($emailSubject) }}&body={{ rawurlencode($emailBody) }}" class="w-full flex items-center justify-center bg-indigo-600 text-white py-3 rounded-lg hover:bg-indigo-700 transition mb-3 shadow-lg hover:shadow-indigo-100 font-semibold">
                        <i class="fas fa-envelope text-xl mr-2"></i>Email Agent
                    </a>
                    
                    <a href="{{ route('contact.index', ['subject' => 'Schedule a Viewing', 'message' => 'I would like to schedule a viewing for the property: ' . ($property->title ?? 'Property') . ' (ID: #' . ($property->id ?? 'N/A') . ').', 'property_id' => $property->id]) }}" class="w-full flex items-center justify-center border border-blue-600 text-blue-600 py-3 rounded-lg hover:bg-blue-50 transition font-semibold">
                        <i class="fas fa-calendar-alt mr-2"></i>Schedule Viewing
                    </a>

                    <!-- Contact Agent -->
                    <div class="mt-4 p-4 bg-gray-50 rounded-lg">
                        <p class="text-sm text-gray-600 mb-2">
                            <i class="fas fa-user-circle mr-2 text-blue-600"></i>Listed by:
                        </p>
                        <div class="space-y-2">
                            <span class="font-semibold text-gray-800 block">{{ $agentName }}</span>
                            <a href="mailto:{{ $agentEmail }}" class="text-sm text-indigo-600 hover:text-indigo-800 block">
                                <i class="fas fa-envelope mr-1"></i>{{ $agentEmail }}
                            </a>
                            <a href="tel:{{ preg_replace('/\s+/', '', $agentPhone) }}" class="text-sm text-gray-500 hover:text-gray-700 block">
                                <i class="fas fa-phone mr-1"></i>{{ $agentPhone }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
